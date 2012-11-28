<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SatRfc
 *
 * @author jmariani
 */
class GamaHelper {

    const COL_COUNT = 43;
    const DOCUMENT_TYPE_COL = 0;
    const INVOICE_NBR_COL = 1;
    const INVOICE_DATE_COL = 2;
    const PAYMENT_TERM_COL = 3;
    const CAR_COL = 4;
    const CAR_KM_COL = 5;
    const LICENSE_PLATE_COL = 6;
    const VENDOR_RFC_COL = 7;
    const VENDOR_NAME_COL = 8;
    const VENDOR_ADDRESS_STREET_COL = 9;
    const VENDOR_ADDRESS_COLONY_COL = 10;
    const VENDOR_ADDRESS_CITY_COL = 11;
    const VENDOR_ADDRESS_REFERENCE_COL = 12;
    const VENDOR_ADDRESS_MUNICIPALITY_COL = 13;
    const VENDOR_ADDRESS_STATE_COL = 14;
    const VENDOR_ADDRESS_COUNTRY_COL = 15;
    const VENDOR_ADDRESS_ZIPCODE_COL = 16;
    const VENDOR_PHONE_NBR_COL = 17;
    const BILLABLE_COUNTRY_COL = 18;
    const CUSTOMER_RFC_COL = 19;
    const CUSTOMER_NAME_COL = 20;
    const CUSTOMER_VENDOR_NBR_COL = 21;
    const CUSTOMER_ADDRESS_STREET_COL = 22;
    const CUSTOMER_ADDRESS_COLONY_COL = 23;
    const CUSTOMER_ADDRESS_CITY_COL = 24;
    const CUSTOMER_ADDRESS_MUNICIPALITY_COL = 25;
    const CUSTOMER_ADDRESS_STATE_COL = 26;
    const CUSTOMER_ADDRESS_COUNTRY_COL = 27;
    const CUSTOMER_ADDRESS_ZIPCODE_COL = 28;
    const ITEM_QTY_COL = 29;
    const ITEM_DESCRIPTION_COL = 30;
    const ITEM_UNIT_PRICE_COL = 31;
    const ITEM_AMOUNT_COL = 32;
    const TAX_NAME_COL = 33;
    const TAX_RATE_COL = 34;
    const TAX_AMOUNT_COL = 35;
    const CAR_USERNAME_COL = 36;
    const CAR_ENGINE_NBR_COL = 37;
    const CAR_SERIAL_NBR_COL = 38;
    const CAR_INVENTORY_NBR_COL = 39;
    const AUTH_NBR_COL = 40;
    const PAYMENT_METHOD_COL = 41;
    const BANK_ACCT_COL = 42;
    const ITEM_CHAR_VEHICLE = 'VEHICLE';
    const ITEM_CHAR_KM = 'KM';
    const ITEM_CHAR_LICENSE_PLATE = 'LICENSE_PLATE';
    const ITEM_CHAR_USERNAME = 'USERNAME';
    const ITEM_CHAR_ENGINE_NBR = 'ENGINE_NBR';
    const ITEM_CHAR_CAR_SERIAL_NBR = 'CAR_SERIAL_NBR';
    const ITEM_CHAR_INVENTORY_NBR = 'INVENTORY_NBR';
    const ITEM_CHAR_AUTH_NBR = 'AUTH_NBR';
    const ITEM_CHAR_GROUP = 'GROUP';

    public static function getInvoiceDt($dt) {
        return new DateTime(trim(str_replace(' ', '', $dt)), new DateTimeZone('America/Mexico_City'));
    }

    private static function normalizeDataRow($data) {
        // Normalize UTF8
        foreach ($data as $key => $value) {
            $data[$key] = trim(mb_convert_encoding($value, 'utf8'));
        }
//        for ($i = 0; $i < self::COL_COUNT; $i++) {
//            $data[$i] = trim(mb_convert_encoding($data[$i], 'utf8'));
//        }
        return $data;
    }

    private static function saveCfd($cfd) {
        $cfd->total = $cfd->tax + $cfd->subTotal;
        $cfd->save();
        // Create XML
        $cfd->runCreateXml();
    }

    /*
     * Validates a GAMA formatted file.
     * Input paramenters:
     *  $model  ->  An IncomingInvoiceInterfaceFile instance
     *
     * Returns:
     *
     */

    public static function processIncomingInvoiceInterfaceFile(IncomingInvoiceInterfaceFile $model) {
        yii::trace(yii::t('app', 'Processing file "{file}"', array('{file}' => $model->fileLocation)), __METHOD__);
        try {
            $log = new YanusLog($model->getLogFileName());

            $model->swNextStatus(IncomingInvoiceInterfaceFile::PROCESSING);
            $model->save();
            $log->log(yii::t('app', 'Processing file "{file}"', array('{file}' => $model->fileName)));
            $log->log(yii::t('app', 'Waiting to lock file "{file}"', array('{file}' => $model->fileName)));
            $fHandle = YFileHelper::openExclusive($model->fileLocation);
            if ($fHandle) {
                try {
                    // PROCESS FILE
                    // GAMA file is a CSV file
                    // Iterate through file
                    $row = 1;
                    $runMode = SystemConfig::getValue(SystemConfig::RUN_MODE);
                    $currency = Currency::model()->find('code = :code', array(':code' => 'MXP'));
                    $invoiceNbr = 'XXXX';
                    $cfd = false;
                    $vendor = false;
                    $customer = false;
                    while (($data = fgetcsv($fHandle, 0, ',')) !== FALSE) {
                        if ($row == 1) {
                            // Skip first row
                            $log->log(yii::t('app', 'Skipping row {row}', array('{row}' => $row)));
                        } else {
                            $data = GamaHelper::normalizeDataRow($data);
                            if ($invoiceNbr != $data[GamaHelper::INVOICE_NBR_COL]) {
                                // Save previous invoice if any.

                                if ($cfd) self::saveCfd($cfd);

                                $invoiceNbr = $data[GamaHelper::INVOICE_NBR_COL];
                                $log->log(yii::t('app', 'Processing invoice {nbr}', array('{nbr}' => $invoiceNbr)));
                                $md5 = md5($data[GamaHelper::VENDOR_RFC_COL] . '|' . $invoiceNbr . '|' . $data[GamaHelper::CUSTOMER_RFC_COL]);
                                //                            // Find if invoice already exists.
                                if (cfd::model()->find('md5 = :md5', array(':md5' => $md5))) {
                                    $log->log(yii::t('app', 'Invoice {invoice} already exists', array('{invoice}' => $invoiceNbr)));
                                    $cfd = false;
                                    continue;
                                }
                                $cfd = new Cfd();
                                $cfd->invoice = $invoiceNbr;
                                $cfd->version = SystemConfig::getValue(SystemConfig::CURRENT_CFD_VERSION);
                                $cfd->folio = $invoiceNbr;
                                $cfd->dttm = GamaHelper::getInvoiceDt($data[GamaHelper::INVOICE_DATE_COL])->format(DateTime::ISO8601);
                                $cfd->paymentType = 'PAGO EN UNA SOLA EXHIBICION';
                                $cfd->paymentTerm = $data[GamaHelper::PAYMENT_TERM_COL];
                                $cfd->currency = 'MXP';
                                if ($currency) $cfd->currency0 = $currency;
                                $cfd->voucherType = ($data[GamaHelper::DOCUMENT_TYPE_COL] == 0 ? 'ingreso' : 'egreso');
                                $cfd->paymentMethod = $data[GamaHelper::PAYMENT_METHOD_COL];

                                if (isset($data[GamaHelper::BANK_ACCT_COL])) {
                                    if ($data[GamaHelper::BANK_ACCT_COL]) {
                                        if ($data[GamaHelper::BANK_ACCT_COL] != 'XXXX')
                                            $cfd->paymentAcctNbr = $data[GamaHelper::BANK_ACCT_COL];
                                    }
                                }
                                $cfd->md5 = $md5;

                                // Preprocess invoice.
                                // First create phone nbr if not exists.
                                $phoneNbr = PhoneNbr::model()->find('value = :value', array(':value' => PhoneNbr::cleanUpNbr($data[GamaHelper::VENDOR_PHONE_NBR_COL])));
                                if (!$phoneNbr) {
                                    $phoneNbr = new PhoneNbr();
                                    $phoneNbr->value = PhoneNbr::cleanUpNbr($data[GamaHelper::VENDOR_PHONE_NBR_COL]);
                                    $phoneNbr->save();
                                }

                                // Test vendor.
                                $vendor = Party::model()->findByPartyIdentifierAndNumber(PartyIdentifierNameBehavior::RFC, $data[GamaHelper::VENDOR_RFC_COL]);
                                if (!$vendor) {
                                    // Create new vendor
                                    $vendor = new Party();
                                    $vendor->person = FALSE;

                                    $vendor->addIdentifier($data[GamaHelper::VENDOR_RFC_COL]);

                                    $vendor->addName($data[GamaHelper::VENDOR_NAME_COL]);

                                    $vendor->addLocator($phoneNbr);

                                    $vendor->save();
                                } else {
                                    if ($vendor->name != $data[GamaHelper::VENDOR_NAME_COL]) {
                                        $vendor->addName($data[GamaHelper::VENDOR_NAME_COL]);
//                                        $vendorName = new PartyName();
//                                        $vendorName->fullName = $data[GamaHelper::VENDOR_NAME_COL];
//                                        $vendor->addName($vendorName);
                                    }
                                    // Test vendor phone nbr
                                    if ($vendor->primaryPhone != $phoneNbr->value)
                                        $vendor->addLocator($phoneNbr);
                                    if ($vendor->isDirty())
                                        $vendor->save();
                                }

                                // Add vendor to CFD
                                $cfd->addParty($vendor);

                                // Test customer.
                                $customer = Party::model()->findByPartyIdentifierAndNumber(PartyIdentifierNameBehavior::RFC, $data[GamaHelper::CUSTOMER_RFC_COL]);
                                if (!$customer) {
                                    // Create new customer
                                    $customer = new Party();
                                    $customer->person = (strlen($data[GamaHelper::CUSTOMER_RFC_COL]) == 13);

                                    // Save Party Identifier
                                    $customer->addIdentifier($data[GamaHelper::CUSTOMER_RFC_COL]);

                                    // Save Party Name
                                    $customer->addName($data[GamaHelper::CUSTOMER_NAME_COL]);

                                    // Create relationship with vendor.
                                    $customerRelationship = new PartyHasRelationship();
                                    $customerRelationship->type = PartyRelationshipTypeBehavior::SUPPLIER;
                                    if ($data[self::CUSTOMER_VENDOR_NBR_COL])
                                        $customerRelationship->supplierCode = $data[self::CUSTOMER_VENDOR_NBR_COL];
                                    $customerRelationship->relatedParty = $vendor;
                                    $customer->addRelatedObject($customerRelationship);
                                    $customer->save();


                                    // Create relationship with customer.
                                    $vendorRelationship = new PartyHasRelationship();
                                    $vendorRelationship->type = PartyRelationshipTypeBehavior::CUSTOMER;
                                    $vendorRelationship->relatedParty = $customer;
                                    $vendor->addRelatedObject($vendorRelationship);
                                    $vendor->save();
                                } else {
                                    if ($customer->name != $data[GamaHelper::CUSTOMER_NAME_COL]) {
                                        $customer->addName($data[GamaHelper::VENDOR_NAME_COL]);
                                        $customer->save();
                                    }
                                }
                                // Add customer to CFD
                                $cfd->addParty($customer, CfdPartyTypeBehavior::CUSTOMER);

                                // Test vendor primary address
                                $tmpVendorPrimaryAddress = new Address();
                                $tmpVendorPrimaryAddress->street = $data[GamaHelper::VENDOR_ADDRESS_STREET_COL];
                                $tmpVendorPrimaryAddress->neighbourhood = $data[GamaHelper::VENDOR_ADDRESS_COLONY_COL];
                                $tmpVendorPrimaryAddress->city = $data[GamaHelper::VENDOR_ADDRESS_CITY_COL];
                                $tmpVendorPrimaryAddress->municipality = $data[GamaHelper::VENDOR_ADDRESS_MUNICIPALITY_COL];
                                $tmpVendorPrimaryAddress->state = $data[GamaHelper::VENDOR_ADDRESS_STATE_COL];
                                $tmpVendorPrimaryAddress->country = $data[GamaHelper::VENDOR_ADDRESS_COUNTRY_COL];
                                $tmpVendorPrimaryAddress->zipCode = substr('00000' . $data[GamaHelper::VENDOR_ADDRESS_ZIPCODE_COL], -5);
                                $vendorPrimaryAddress = Address::model()->find('md5 = :md5', array(':md5' => $tmpVendorPrimaryAddress->getMd5()));
                                if (!$vendorPrimaryAddress) {
                                    $tmpVendorPrimaryAddress->save();
                                    $vendorPrimaryAddress = $tmpVendorPrimaryAddress;
                                }
                                // Add vendor address to CFD
                                $cfd->addAddress($vendorPrimaryAddress, null, $data[GamaHelper::VENDOR_ADDRESS_REFERENCE_COL]);

                                $cfd->expeditionPlace = $vendorPrimaryAddress->street . ', ' .
                                        $vendorPrimaryAddress->neighbourhood . ', ' .
                                        $vendorPrimaryAddress->municipality . ', ' .
                                        $vendorPrimaryAddress->city . ', ' .
                                        $vendorPrimaryAddress->state . ', ' .
                                        $vendorPrimaryAddress->zipCode . ', ' .
                                        $vendorPrimaryAddress->country;

                                // Test customer address
                                $tmpCustomerAddress = new Address();
                                $tmpCustomerAddress->street = $data[GamaHelper::CUSTOMER_ADDRESS_STREET_COL];
                                $tmpCustomerAddress->neighbourhood = $data[GamaHelper::CUSTOMER_ADDRESS_COLONY_COL];
                                $tmpCustomerAddress->city = $data[GamaHelper::CUSTOMER_ADDRESS_CITY_COL];
                                $tmpCustomerAddress->municipality = $data[GamaHelper::CUSTOMER_ADDRESS_MUNICIPALITY_COL];
                                $tmpCustomerAddress->state = $data[GamaHelper::CUSTOMER_ADDRESS_STATE_COL];
                                $tmpCustomerAddress->country = $data[GamaHelper::CUSTOMER_ADDRESS_COUNTRY_COL];
                                $tmpCustomerAddress->zipCode = substr('00000' . $data[GamaHelper::CUSTOMER_ADDRESS_ZIPCODE_COL], -5);
                                $customerAddress = Address::model()->find('md5 = :md5', array(':md5' => $tmpCustomerAddress->getMd5()));
                                if (!$customerAddress) {
                                    $tmpCustomerAddress->save();
                                    $customerAddress = $tmpCustomerAddress;
                                }
                                // Add customer address to CFD
                                $cfd->addAddress($customerAddress, null, null, AddressTypeBehavior::BILL_TO);

                                // Process Tax
                                $tax = new CfdTax();
                                $tax->name = $data[GamaHelper::TAX_NAME_COL];
                                $tax->rate = $data[GamaHelper::TAX_RATE_COL];
                                $tax->amt = $data[GamaHelper::TAX_AMOUNT_COL];
                                $tax->local = false;
                                $tax->withHolding = false;
                                $cfd->addRelatedObject($tax);

                                $cfd->total = $data[GamaHelper::TAX_AMOUNT_COL];
                                $cfd->tax = $tax->amt;

                                // Tax regimes
                                $taxRegime = new CfdTaxRegime();
                                $taxRegime->name = 'Régimen General de Ley Personas Morales';
                                $cfd->addRelatedObject($taxRegime);

                                // Find certificate
                                $certificate = SatCertificate::model()->valid()->find('rfc = :rfc', array(':rfc' => ($runMode == SystemConfig::RUN_MODE_PRODUCTION ? $data[GamaHelper::VENDOR_RFC_COL] : SystemConfig::getValue(SystemConfig::DEMO_RFC))));
                                if (!$certificate)
                                    throw new Exception(yii::t('app', 'Valid certificate not found for vendor RFC "{rfc}"', array('{rfc}' => $data[GamaHelper::VENDOR_RFC_COL])));
                                else
                                    $cfd->satCertificate = $certificate;
                            }

                            if ($cfd) {
                                // Process items if there's a CFD.
                                $cfdItem = new CfdItem();
                                $cfdItem->qty = $data[GamaHelper::ITEM_QTY_COL];
                                $cfdItem->uom = 'EA';
                                $cfdItem->description = $data[GamaHelper::ITEM_DESCRIPTION_COL];
                                $cfdItem->unitPrice = $data[GamaHelper::ITEM_UNIT_PRICE_COL];
                                $cfdItem->amt = $data[GamaHelper::ITEM_AMOUNT_COL];

                                // Add attributes to CFD Item
                                $cfdItem->authNbr = $data[GamaHelper::AUTH_NBR_COL];
                                $cfdItem->serialNbr = $data[GamaHelper::CAR_SERIAL_NBR_COL];
                                $cfdItem->engineNbr = $data[GamaHelper::CAR_ENGINE_NBR_COL];
                                $cfdItem->group = $data[GamaHelper::LICENSE_PLATE_COL];
                                $cfdItem->inventoryNbr = $data[GamaHelper::CAR_INVENTORY_NBR_COL];
                                $cfdItem->km = $data[GamaHelper::CAR_KM_COL];
                                $cfdItem->licensePlate = $data[GamaHelper::LICENSE_PLATE_COL];
                                $cfdItem->userName = $data[GamaHelper::CAR_USERNAME_COL];
                                $cfdItem->vehicle = $data[GamaHelper::CAR_COL];
                                ;

                                $cfd->subTotal += $cfdItem->amt;
                                $cfd->addRelatedObject($cfdItem);
                            }
                        }
                        $row++;
                    }
                    if ($cfd) self::saveCfd($cfd);
                    $log->log(yii::t('app', 'Processing ended successfully. {rows} rows procesed.', array('{rows}' => $row - 1)));
                    fclose($fHandle);
                    // Move to next step
                    $model->swNextStatus(array('status' => IncomingInvoiceInterfaceFile::PROCESSED));
                    $model->processDttm = new CDbExpression('NOW()');
                    $model->save();
                    return true;
                } catch (Exception $e) {
                    $log->log($e->getMessage(), CLogger::LEVEL_ERROR);
                    $model->note = '[' . __METHOD__ . '] (' . $e->getLine() . ') ' . $e->getMessage();
                    $model->swNextStatus(array('status' => IncomingInvoiceInterfaceFile::PROCESSING_ERROR));
                    $model->save();
                    @fclose($fHandle);
                    return false;
                }
            } else
                throw new CException(yii::t('app', 'Failed to open file "{file}"', array('{file}' => $model->fileLocation)));
        } catch (Exception $e) {
            $log->log($e->getMessage(), CLogger::LEVEL_ERROR);
            $model->note = $e->getMessage();
            $model->swNextStatus(array('status' => IncomingInvoiceInterfaceFile::ERROR));
            $model->save();
            @fclose($fHandle);
            return false;
        }
    }


    /*
     * Validates a GAMA formatted file.
     * Input paramenters:
     *  $model  ->  An IncomingInvoiceInterfaceFile instance
     *
     * Returns:
     *
     */

    public static function validateIncomingInvoiceInterfaceFile(IncomingInvoiceInterfaceFile $model) {
        yii::trace(yii::t('app', 'Validating file "{file}"', array('{file}' => $model->fileLocation)), __METHOD__);
        try {
            $log = new YanusLog($model->getLogFileName(), true);
            $log->log(yii::t('app', 'Validating file "{file}"', array('{file}' => $model->fileName)));
            $log->log(yii::t('app', 'Waiting to lock file "{file}"', array('{file}' => $model->fileName)));
            $fHandle = YFileHelper::openExclusive($model->fileLocation);
            if ($fHandle) {
                try {
                    $model->swNextStatus(array('status' => IncomingInvoiceInterfaceFile::VALIDATING));
                    $model->save();

                    // VALIDATE FILE
                    // GAMA file is a CSV file
                    // Iterate through file
                    $row = 1;
                    $runMode = SystemConfig::getValue(SystemConfig::RUN_MODE);
                    while (($data = fgetcsv($fHandle, 0, ',')) !== FALSE) {
                        if ($row == 1) {
                            // Skip first row
                            $log->log(yii::t('app', 'Skipping row {row}', array('{row}' => $row)));
                        } else {
                            $log->log(yii::t('app', 'Validating row {row}', array('{row}' => $row)));
                            if (count($data) != GamaHelper::COL_COUNT)
                                throw new CException(yii::t('app', 'Row {row}: Invalid column count. Row contains {count} rows.', array('{row}' => $row,
                                            '{count}' => count($data))));

                            // TEST INVOICE_NBR_COL
                            if (!$data[GamaHelper::INVOICE_NBR_COL])
                                throw new CException(yii::t('app', 'Row {row}, column {col}: Invoice folio cannot be null.', array('{row}' => $row,
                                            '{col}' => GamaHelper::INVOICE_NBR_COL)));
                            // TEST INVOICE DATE
                            if (!$data[GamaHelper::INVOICE_DATE_COL])
                                throw new CException(yii::t('app', 'Row {row}, column {col}: Invoice date cannot be null.', array('{row}' => $row,
                                            '{col}' => GamaHelper::INVOICE_DATE_COL)));

                            $invoiceDt = GamaHelper::getInvoiceDt($data[GamaHelper::INVOICE_DATE_COL]);
                            if (!$invoiceDt)
                                throw new CException(yii::t('app', 'Row {row}, column {col}: Invalid invoice date "{date}".', array('{row}' => $row,
                                            '{col}' => GamaHelper::INVOICE_DATE_COL,
                                            '{date}' => $data[GamaHelper::INVOICE_DATE_COL])));
                            if ($runMode == SystemConfig::RUN_MODE_PRODUCTION) {
                                // test date older than 72 Hs.
                                $now = new DateTime(null, new DateTimeZone('America/Mexico_City'));
                                $dateDiff = abs($now->format('U') - $invoiceDt->format('U'));
                                if ($dateDiff >= 259200)
                                    throw new CException(yii::t('app', 'Row {row}, column {col}: Invoice date "{date}" is more than 72 Hs old.', array('{row}' => $row,
                                                '{col}' => GamaHelper::INVOICE_DATE_COL,
                                                '{date}' => $data[GamaHelper::INVOICE_DATE_COL])));
                            }

                            // TEST VENDOR RFC
                            if (!$data[GamaHelper::VENDOR_RFC_COL])
                                throw new CException(yii::t('app', 'Row {row}, column {col}: Vendor RFC cannot be null.', array('{row}' => $row,
                                            '{col}' => GamaHelper::VENDOR_RFC_COL)));
                            $vendorRfc = new SatRfc($data[GamaHelper::VENDOR_RFC_COL]);
                            if ($vendorRfc->hasError)
                                throw new CException(yii::t('app', 'Row {row}, column {col}: Vendor RFC has errors: ', array('{row}' => $row,
                                            '{col}' => GamaHelper::VENDOR_RFC_COL)) . $vendorRfc->error);

                            // TEST VENDOR NAME
                            if (!$data[GamaHelper::VENDOR_NAME_COL])
                                throw new CException(yii::t('app', 'Row {row}, column {col}: Vendor name cannot be null.', array('{row}' => $row,
                                            '{col}' => GamaHelper::VENDOR_NAME_COL)));

                            // TEST VENDOR ADDRESS
                            if (!$data[GamaHelper::VENDOR_ADDRESS_STREET_COL])
                                throw new CException(yii::t('app', 'Row {row}, column {col}: Vendor address street cannot be null.', array('{row}' => $row,
                                            '{col}' => GamaHelper::VENDOR_ADDRESS_STREET_COL)));
                            if (!$data[GamaHelper::VENDOR_ADDRESS_MUNICIPALITY_COL])
                                throw new CException(yii::t('app', 'Row {row}, column {col}: Vendor address municipality cannot be null.', array('{row}' => $row,
                                            '{col}' => GamaHelper::VENDOR_ADDRESS_MUNICIPALITY_COL)));
                            if (!$data[GamaHelper::VENDOR_ADDRESS_STATE_COL])
                                throw new CException(yii::t('app', 'Row {row}, column {col}: Vendor address state cannot be null.', array('{row}' => $row,
                                            '{col}' => GamaHelper::VENDOR_ADDRESS_STATE_COL)));
                            if (!$data[GamaHelper::VENDOR_ADDRESS_COUNTRY_COL])
                                throw new CException(yii::t('app', 'Row {row}, column {col}: Vendor address country cannot be null.', array('{row}' => $row,
                                            '{col}' => GamaHelper::VENDOR_ADDRESS_COUNTRY_COL)));
                            if (!$data[GamaHelper::VENDOR_ADDRESS_ZIPCODE_COL])
                                throw new CException(yii::t('app', 'Row {row}, column {col}: Vendor address zip code cannot be null.', array('{row}' => $row,
                                            '{col}' => GamaHelper::VENDOR_ADDRESS_ZIPCODE_COL)));

                            // TEST CUSTOMER RFC
                            if (!$data[GamaHelper::CUSTOMER_RFC_COL])
                                throw new CException(yii::t('app', 'Row {row}, column {col}: Customer RFC cannot be null.', array('{row}' => $row,
                                            '{col}' => GamaHelper::CUSTOMER_RFC_COL)));
                            $customerRfc = new SatRfc($data[GamaHelper::CUSTOMER_RFC_COL]);
                            if ($customerRfc->hasError)
                                throw new CException(yii::t('app', 'Row {row}, column {col}: Customer RFC has errors: ', array('{row}' => $row,
                                            '{col}' => GamaHelper::CUSTOMER_RFC_COL)) . $customerRfc->error);

                            // TEST CUSTOMER NAME
                            if (!$data[GamaHelper::CUSTOMER_RFC_COL])
                                throw new CException(yii::t('app', 'Row {row}, column {col}: Customer name cannot be null.', array('{row}' => $row,
                                            '{col}' => GamaHelper::VENDOR_NAME_COL)));

                            // TEST CUSTOMER ADDRESS
                            if (!$data[GamaHelper::CUSTOMER_ADDRESS_COUNTRY_COL])
                                throw new CException(yii::t('app', 'Row {row}, column {col}: Customer address country cannot be null.', array('{row}' => $row,
                                            '{col}' => GamaHelper::CUSTOMER_ADDRESS_COUNTRY_COL)));

                            // TEST TAX
                            if (!$data[GamaHelper::TAX_NAME_COL])
                                throw new CException(yii::t('app', 'Row {row}, column {col}: Tax name cannot be null.', array('{row}' => $row,
                                            '{col}' => GamaHelper::TAX_NAME_COL)));
                            if (!$data[GamaHelper::TAX_RATE_COL])
                                throw new CException(yii::t('app', 'Row {row}, column {col}: Tax rate cannot be null.', array('{row}' => $row,
                                            '{col}' => GamaHelper::TAX_RATE_COL)));
                            if (!$data[GamaHelper::TAX_AMOUNT_COL])
                                throw new CException(yii::t('app', 'Row {row}, column {col}: Tax amount cannot be null.', array('{row}' => $row,
                                            '{col}' => GamaHelper::TAX_AMOUNT_COL)));

                            // TEST ITEM
                            if (!$data[GamaHelper::ITEM_DESCRIPTION_COL])
                                throw new CException(yii::t('app', 'Row {row}, column {col}: Item description cannot be null.', array('{row}' => $row,
                                            '{col}' => GamaHelper::ITEM_DESCRIPTION_COL)));
                        }
                        $row++;
                    }
                    $log->log(yii::t('app', 'Validation ended successfully. {rows} rows validated.', array('{rows}' => $row - 1)));
                    fclose($fHandle);
                    // Move to next step
                    $model->swNextStatus(array('status' => IncomingInvoiceInterfaceFile::PENDING_PROCESSING));
                    $model->validationDttm = new CDbExpression('NOW()');
                    $model->save();
                    GamaHelper::processIncomingInvoiceInterfaceFile($model);
                    return true;
                } catch (Exception $e) {
                    $log->log($e->getMessage(), CLogger::LEVEL_ERROR);
                    $model->note = $e->getMessage();
                    $model->swNextStatus(array('status' => IncomingInvoiceInterfaceFile::VALIDATION_ERROR));
                    $model->save();
                    @fclose($fHandle);
                    return false;
                }
            } else
                throw new CException(yii::t('app', 'Failed to open file "{file}"', array('{file}' => $model->fileLocation)));
        } catch (CException $e) {
            yii::log('[' . __METHOD__ . '] (' . $e->getLine() . ') ' . $e->getMessage(), CLogger::LEVEL_ERROR);
            $model->swNextStatus(array('status' => IncomingInvoiceInterfaceFile::ERROR));
            $model->note = '[' . __METHOD__ . '] (' . $e->getLine() . ') ' . $e->getMessage();
            $model->save();
            @fclose($fHandle);
            return false;
        }
    }

}

?>
