<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GamaProcessIncomingInvoiceFile
 *
 * @author jmariani
 */
class GamaProcessIncomingInvoiceFileCommand extends CConsoleCommand {

    const PARTY_RFC = 'TME1109123E9';
    const MASTER_ACCOUNT_ALIAS = 'TAMA';
    const DEFAULT_PAYMENT_TYPE_VALUE = 'PAGO EN UNA SOLA EXHIBICION';
    const DEFAULT_PAYMENT_METHOD = 'NO DEFINIDO';
    const DEFAULT_CURRENCY_CODE = 'MXN';
    const DEFAULT_EXCHANGE_RATE = 1;

    // Columns from the input file
    const INVOICE_DOC_TYPE = 0;
    const INVOICE_NUMBER_COL = 1;
    const INVOICE_DATE_COL = 2;
    const INVOICE_PAYMENT_TERM = 3;
    const VEHICLE = 4;
    const KM = 5;
    const LICENSE_PLATE = 6;

    // Owner data
    const OWNER_RFC_COL = 7;
    const OWNER_NAME_COL = 8;
    const OWNER_ADDRESS_STREET_COL = 9;
    const OWNER_ADDRESS_NEIGHBOURHOOD_COL = 10;
    const OWNER_ADDRESS_CITY_COL = 11;
    const OWNER_ADDRESS_REFERENCE_COL = 12;
    const OWNER_ADDRESS_MUNICIPALITY_COL = 13;
    const OWNER_ADDRESS_STATE_COL = 14;
    const OWNER_ADDRESS_COUNTRY_COL = 15;
    const OWNER_ADDRESS_ZIPCODE_COL = 16;
    const OWNER_PHONE_NBR_COL = 17;
    const CUSTOMER_RFC_COL = 19;
    const CUSTOMER_NAME_COL = 20;
    const CUSTOMER_CODE_COL = 21;

    // Customer address
    const CUSTOMER_SOLD_TO_ADDRESS_STREET_COL = 22;
    const CUSTOMER_SOLD_TO_ADDRESS_NEIGHBOURHOOD_COL = 23;
    const CUSTOMER_SOLD_TO_ADDRESS_CITY_COL = 24;
    const CUSTOMER_SOLD_TO_ADDRESS_MUNICIPALITY_COL = 25;
    const CUSTOMER_SOLD_TO_ADDRESS_STATE_COL = 26;
    const CUSTOMER_SOLD_TO_ADDRESS_COUNTRY_COL = 27;
    const CUSTOMER_SOLD_TO_ADDRESS_ZIPCODE_COL = 28;

    // Item
    const ITEM_QTY = 29;
    const ITEM_DESCRIPTION_COL = 30;
    const ITEM_UNIT_PRICE = 31;
    const ITEM_TOTAL_PRICE = 32;

    // TAX
    const TAX_TYPE = 33;
    const TAX_RATE = 34;
    const TAX_AMOUNT = 35;
    const USER = 36;
    const ENGINE_NBR = 37;
    const SERIAL_NBR = 38;
    const INVENTORY_NBR = 39;
    const AUTH_NBR = 40;

    private $fileName;
    private $fileLog;
    private $fileError;
    private $nativeXMLFile;
    private $errors = array();

    private function log($msg, $logFile = NULL) {
        // Always save to process log.
        yii::log($msg, CLogger::LEVEL_INFO, $this->name);
        error_log('[' . date(DateTime::ISO8601) . '] ' . $msg . PHP_EOL, 3, (($logFile) ? : '/tmp/' . $this->name . '.log'));
    }

    public function run($args) {

        // 1) LOCK FILE
        // 2) When file is locked, try to open it.
        // 3) Tama file is a XML file. Validate the file against a schema found in INCOMING_INVOICE_FILE_XSD
        // 4) Run additional validations that cannot be performed with the schema.
        // 5) Produce a native XML and save it to NATIVE_XML_PATH
//        print_r($args);

        if (!isset($args[0]))
            die('No file was set at command line');

        $this->fileName = $args[0];
        $pathInfo = pathinfo($args[0]);

        yii::log(yii::t('app', 'Processing file {file}', array('{file}' => $args[0])), CLogger::LEVEL_INFO, 'ProcessIncomingInvoiceFile');

        // Find IncomingInvoiceInterfaceFile record.
        $incomingInvoiceInterfaceFile = IncomingInvoiceInterfaceFile::model()->find('fileName = :fileName', array(':fileName' => $pathInfo['basename']));
        if (!$incomingInvoiceInterfaceFile) {
            // Create new
            $incomingInvoiceInterfaceFile = new IncomingInvoiceInterfaceFile();
            $incomingInvoiceInterfaceFile->fileName = $pathInfo['basename'];
        }
        $incomingInvoiceInterfaceFile->receptionDttm = new CDbExpression(new CDbExpression('NOW()'));
        $incomingInvoiceInterfaceFile->processDttm = null;
        $incomingInvoiceInterfaceFile->note = null;
        $incomingInvoiceInterfaceFile->IncomingInvoiceInterfaceFileStatus_id = IncomingInvoiceInterfaceFileStatus::model()->find('code = :code', array(':code' => IncomingInvoiceInterfaceFileStatus::PROCESSING))->id;
        $incomingInvoiceInterfaceFile->save();
        $invoiceNbrs = array();
        try {
            // Open file
            $fHandle = fopen($args[0], "r");
            if (!$fHandle)
                throw new Exception(yii::t('app', 'Cannot open file {file}', array('{file}' => $args[0])));

            // Setup
            $invoiceNbr = "XXX";

            // Create Native XML file
            $nativeXml = new DOMDocument("1.0", "UTF-8");
            $root = $nativeXml->appendChild($nativeXml->createElement('Cfds'));
            $invoice = false;
            $subTotal = 0;
            $tax = 0;
            $total = 0;
            $row = 0;
            while (($data = fgetcsv($fHandle, 0, ',')) !== FALSE) {
                if ($row > 0) { // Skip first row: Titles
                    $colCount = count($data);
                    if ($colCount == 41) {
                        if ($invoiceNbr != trim($data[self::INVOICE_NUMBER_COL])) {
                            if ($invoice) {
                                $invoice->setAttribute('subTotal', $subTotal);
                                $invoice->setAttribute('total', $subTotal + $tax);
                            }
                            // New Invoice
                            $invoiceNbr = trim($data[self::INVOICE_NUMBER_COL]);

                            // Find invoice
                            $cfd = Cfd::model()->find('folio = :folio and vendorRfc = :rfc', array(':folio' => $invoiceNbr, ':rfc' => trim($data[self::OWNER_RFC_COL])));
                            if ($cfd) {
                                if ($cfd->cfdStatus->code == CfdStatus::ERROR)
                                    $cfd->delete();
                                else
                                    throw new Exception(yii::t('app', 'Folio {folio} already exists.', array('{folio}' => $invoiceNbr)));
                            }
                            $invoice = $root->appendChild($nativeXml->createElement('Cfd'));

                            // CFD Version
                            $invoice->setAttribute('version', '3.2');
                            // Folio
                            $invoice->setAttribute('folio', $invoiceNbr);
                            // Invoice date time

                            // Test invoice date
                            $processInvoiceDttm = new DateTime($data[self::INVOICE_DATE_COL]);
                            if (!$processInvoiceDttm)
                                throw new Exception(yii::t('app', 'Invalid invoice date "{date}"', array('{date}' => $data[self::INVOICE_DATE_COL])));
                            if (Yii::app()->params['runmode'] == 'PRODUCTION') {
                                $now = new DateTime();
                                $dateDiff = $now->format('U') - $processInvoiceDttm->format('U');
                                if ($dateDiff >= 0) {
                                    if ($dateDiff >= Yii::app()->params['72HS_IN_SECONDS']) {
                                        throw new Exception(yii::t('app', 'Invoice date "{date}" is more than 72 Hs old. Current date "{cdate}"',
                                                array('{date}' => $data[self::INVOICE_DATE_COL],
                                                    '{cdate}' => $now->format(DateTime::ISO8601))));
                                    }
                                }
                            }
                            $invoice->setAttribute('dttm', trim(str_replace(' ', '', $data[self::INVOICE_DATE_COL])));
                            // Payment type
                            $invoice->setAttribute('paymentType', 'PAGO EN UNA SOLA EXHIBICION');
                            // Cert Nbr
                            // Find current certificate for vendor RFC
                            $satCertificate = SatCertificate::model()->current(trim(str_replace(' ', '', $data[self::INVOICE_DATE_COL])))->find('rfc = :rfc', array(':rfc' => trim($data[self::OWNER_RFC_COL])));
                            if (!$satCertificate)
                                throw new Exception(yii::t('app', 'Cannot find a valid certificate for RFC "{rfc}"', array('{rfc}' => trim($data[self::OWNER_RFC_COL]))));
                            $invoice->setAttribute('certNbr', $satCertificate->nbr);
                            $invoice->setAttribute('certificate', $satCertificate->pem);
                            // Payment term
                            $invoice->setAttribute('paymentTerm', trim($data[self::INVOICE_PAYMENT_TERM]));
                            // Currency
                            $invoice->setAttribute('currency', 'MXP');
                            // Voucher type
                            switch (trim($data[self::INVOICE_DOC_TYPE])) {
                                case '0':
                                    $invoice->setAttribute('voucherType', 'ingreso');
                                    break;
                                case '1':
                                    $invoice->setAttribute('voucherType', 'egreso');
                                    break;
                                default:
                                    throw new Exception(yii::t('app', 'Invalid document type "{type}".', array('{type}' => trim($data[self::INVOICE_DOC_TYPE]))));
                                    break;
                            }
                            // Payment method
                            $invoice->setAttribute('paymentMethod', 'NO DEFINIDO');
                            // Payment account nbr
//                            $invoice->setAttribute('paymentAcctNbr', '0000');
                            // Expedition place
//                            echo utf8_encode(trim($data[self::OWNER_ADDRESS_STREET_COL])) . PHP_EOL;
//                            echo utf8_encode(trim($data[self::OWNER_ADDRESS_NEIGHBOURHOOD_COL])) . PHP_EOL;
//                            echo utf8_encode(trim($data[self::OWNER_ADDRESS_MUNICIPALITY_COL])) . PHP_EOL;
//                            echo utf8_encode(trim($data[self::OWNER_ADDRESS_CITY_COL])) . PHP_EOL;
//                            echo utf8_encode(trim($data[self::OWNER_ADDRESS_STATE_COL])) . PHP_EOL;
//                            echo utf8_encode(trim($data[self::OWNER_ADDRESS_COUNTRY_COL])) . PHP_EOL;
                            $invoice->setAttribute('expeditionPlace', utf8_encode(trim($data[self::OWNER_ADDRESS_STREET_COL])) . ', ' .
                                    trim($data[self::OWNER_ADDRESS_NEIGHBOURHOOD_COL]) . ', ' .
                                    trim($data[self::OWNER_ADDRESS_MUNICIPALITY_COL]) . ', ' .
                                    utf8_encode(trim($data[self::OWNER_ADDRESS_CITY_COL])) . ', ' .
                                    trim($data[self::OWNER_ADDRESS_STATE_COL]) . ', ' .
                                    substr('00000' . trim($data[self::OWNER_ADDRESS_ZIPCODE_COL]), -5) . ', ' .
                                    utf8_encode(trim($data[self::OWNER_ADDRESS_COUNTRY_COL]))
                            );

                            // Vendor
                            $vendor = $invoice->appendChild($nativeXml->createElement('vendor'));
                            // Vendor RFC
                            $vendorRfc = SatRfc::normalize(utf8_encode(trim($data[self::OWNER_RFC_COL])));
                            SatRfc::validate($vendorRfc);
                            $vendor->setAttribute('rfc', $vendorRfc);

                            $invoiceNbrs[$invoiceNbr] = $vendorRfc;

                            // Vendor Name
                            $vendor->setAttribute('name', utf8_encode(trim($data[self::OWNER_NAME_COL])));
                            // Vendor phone nbr
                            $vendorPhone = $vendor->appendChild($nativeXml->createElement('PartyPhoneLocator'));
                            $vendorPhone->setAttribute('value', str_replace(')', '', str_replace('(', '', str_replace(' ', '', trim($data[self::OWNER_PHONE_NBR_COL])))));

                            // Customer
                            $customer = $invoice->appendChild($nativeXml->createElement('customer'));
                            // Customer RFC
                            $customerRfc = SatRfc::normalize(utf8_encode(trim($data[self::CUSTOMER_RFC_COL])));
                            SatRfc::validate($customerRfc);
                            $customer->setAttribute('rfc', $customerRfc);
                            // Customer Name
                            $customer->setAttribute('name', utf8_encode(trim($data[self::CUSTOMER_NAME_COL])));
                            // Customer Nbr
                            $customer->setAttribute('nbr', trim($data[self::CUSTOMER_CODE_COL]));

                            // tax Amt
                            $invoice->setAttribute('taxAmt', trim($data[self::TAX_AMOUNT]));

                            // Address
                            $CfdAddresses = $invoice->appendChild($nativeXml->createElement('CfdAddresses'));
                            $cfdAddress = $CfdAddresses->appendChild($nativeXml->createElement('CfdAddress'));
                            $cfdAddress->setAttribute('type', AddressTypeBehavior::FISCAL);
                            $cfdAddress->setAttribute('reference', utf8_encode(trim($data[self::OWNER_ADDRESS_REFERENCE_COL])));
                            $address = $cfdAddress->appendChild($nativeXml->createElement('Address'));
                            $address->setAttribute('street', utf8_encode(trim($data[self::OWNER_ADDRESS_STREET_COL])));
                            $address->setAttribute('neighbourhood', utf8_encode(trim($data[self::OWNER_ADDRESS_NEIGHBOURHOOD_COL])));
                            $address->setAttribute('city', utf8_encode(trim($data[self::OWNER_ADDRESS_CITY_COL])));
                            $address->setAttribute('municipality', utf8_encode(trim($data[self::OWNER_ADDRESS_MUNICIPALITY_COL])));
                            $address->setAttribute('state', utf8_encode(trim($data[self::OWNER_ADDRESS_STATE_COL])));
                            $address->setAttribute('country', utf8_encode(trim($data[self::OWNER_ADDRESS_COUNTRY_COL])));
                            $address->setAttribute('zipCode', substr('00000' . trim($data[self::OWNER_ADDRESS_ZIPCODE_COL]), -5));


                            $cfdAddress = $CfdAddresses->appendChild($nativeXml->createElement('CfdAddress'));
                            $cfdAddress->setAttribute('type', AddressTypeBehavior::BILL_TO);
                            $address = $cfdAddress->appendChild($nativeXml->createElement('Address'));
                            $address->setAttribute('street', utf8_encode(trim($data[self::CUSTOMER_SOLD_TO_ADDRESS_STREET_COL])));
                            $address->setAttribute('neighbourhood', utf8_encode(trim($data[self::CUSTOMER_SOLD_TO_ADDRESS_NEIGHBOURHOOD_COL])));
                            $address->setAttribute('city', utf8_encode(trim($data[self::CUSTOMER_SOLD_TO_ADDRESS_CITY_COL])));
                            $address->setAttribute('municipality', utf8_encode(trim($data[self::CUSTOMER_SOLD_TO_ADDRESS_MUNICIPALITY_COL])));
                            $address->setAttribute('state', utf8_encode(trim($data[self::CUSTOMER_SOLD_TO_ADDRESS_STATE_COL])));
                            $address->setAttribute('country', utf8_encode(trim($data[self::CUSTOMER_SOLD_TO_ADDRESS_COUNTRY_COL])));
                            $address->setAttribute('zipCode', substr('00000' . trim($data[self::CUSTOMER_SOLD_TO_ADDRESS_ZIPCODE_COL]), -5));

                            // Tax regime
                            $taxRegimes = $invoice->appendChild($nativeXml->createElement('CfdTaxRegimes'));
                            $taxRegime = $taxRegimes->appendChild($nativeXml->createElement('CfdTaxRegime'));
                            $taxRegime->setAttribute('name', 'Régimen General de Ley Personas Morales');

                            // Tax
                            $CfdTaxes = $invoice->appendChild($nativeXml->createElement('CfdTaxes'));
                            $cfdTax = $CfdTaxes->appendChild($nativeXml->createElement('CfdTax'));
                            $cfdTax->setAttribute('name', trim($data[self::TAX_TYPE]));
                            $cfdTax->setAttribute('rate', trim($data[self::TAX_RATE]));
                            $cfdTax->setAttribute('amt', trim($data[self::TAX_AMOUNT]));
                            $cfdTax->setAttribute('local', 0);
                            $cfdTax->setAttribute('withHolding', 0);
                            $tax = (float) trim($data[self::TAX_AMOUNT]);
                            $invoice->setAttribute('taxAmt', trim($data[self::TAX_AMOUNT]));

                            // CFD Items
                            $CfdItems = $invoice->appendChild($nativeXml->createElement('CfdItems'));
                        }
                        $cfdItem = $CfdItems->appendChild($nativeXml->createElement('CfdItem'));
                        if (!trim($data[self::ITEM_DESCRIPTION_COL]))
                            throw new Exception(yii::t('app', 'Item description is required. At line {row}', array('{row}' => $row)));
                        $qty = (float) trim($data[self::ITEM_QTY]);
                        $unitPrice = (float) trim($data[self::ITEM_UNIT_PRICE]);
                        $amt = (float) trim($data[self::ITEM_TOTAL_PRICE]);
                        if ($qty * $unitPrice != $amt)
                            throw new Exception(yii::t('app', 'Item amount must be {ramt} and is {amt}. At line {row}', array(
                                        '{ramt}' => number_format($amt, 2),
                                        '{amt}' => number_format((float) trim($data[self::ITEM_TOTAL_PRICE]), 2),
                                        '{row}' => $row)));
                        $cfdItem->setAttribute('qty', trim($data[self::ITEM_QTY]));
                        $cfdItem->setAttribute('uom', 'EA');
                        $cfdItem->setAttribute('description', utf8_encode(trim($data[self::ITEM_DESCRIPTION_COL])));
                        $cfdItem->setAttribute('unitPrice', trim($data[self::ITEM_UNIT_PRICE]));
                        $cfdItem->setAttribute('amt', trim($data[self::ITEM_TOTAL_PRICE]));
                        $cfdItem->setAttribute('vehicle', utf8_encode(trim($data[self::VEHICLE])));
                        $cfdItem->setAttribute('km', trim($data[self::KM]));
                        $cfdItem->setAttribute('licensePlate', trim($data[self::LICENSE_PLATE]));
                        $cfdItem->setAttribute('user', utf8_encode(trim($data[self::USER])));
                        $cfdItem->setAttribute('engineNbr', utf8_encode(trim($data[self::ENGINE_NBR])));
                        $cfdItem->setAttribute('serialNbr', utf8_encode(trim($data[self::SERIAL_NBR])));
                        $cfdItem->setAttribute('inventoryNbr', utf8_encode(trim($data[self::INVENTORY_NBR])));
                        $cfdItem->setAttribute('authNbr', utf8_encode(trim($data[self::AUTH_NBR])));
                        $cfdItem->setAttribute('group', trim($data[self::LICENSE_PLATE]));

                        $subTotal += (float) trim($data[self::ITEM_TOTAL_PRICE]);
                    } else {
                        throw new Exception(yii::t('app', 'Invalid file format. Rows must have 41 columns.'));
                    }
                }
                $row++;
            }
            if ($invoice) {
                $invoice->setAttribute('subTotal', $subTotal);
                $invoice->setAttribute('total', number_format($subTotal + $tax, 2, '.', ''));
            }

            // Save native XML file
            $nativeXmlPath = IncomingInvoiceInterfaceFile::getNativeXmlPath();
//            $nativeXmlPath = yii::app()->getBasePath() . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'nativeXml';
            if (!file_exists($nativeXmlPath))
                mkdir($nativeXmlPath, 0777, true);
            $nativeXmlFilename = $nativeXmlPath . DIRECTORY_SEPARATOR . $pathInfo['filename'] . '.xml';
            $nativeXmlLog = $nativeXmlPath . DIRECTORY_SEPARATOR . $pathInfo['filename'] . '.log';
            $nativeXml->save($nativeXmlFilename);

            // Update record
            $incomingInvoiceInterfaceFile->processDttm = new CDbExpression('NOW()');
            $incomingInvoiceInterfaceFile->IncomingInvoiceInterfaceFileStatus_id = IncomingInvoiceInterfaceFileStatus::model()->find('code = :code', array(':code' => IncomingInvoiceInterfaceFileStatus::PROCESSED))->id;
            $incomingInvoiceInterfaceFile->nativeXmlFile = $pathInfo['filename'] . '.xml';
            $incomingInvoiceInterfaceFile->save();

            // Run process incoming native xml
            $console = new CConsole();
            $console->runCommand('processincominginvoicenativexml', array('"' . $nativeXmlFilename . '"'), false, '"' . $nativeXmlLog . '"');

            // Run PDF creation.
            foreach ($invoiceNbrs as $folio => $rfc) {
                $cfd = Cfd::model()->find('folio = :folio and vendorRfc = :rfc', array(':folio' => $folio, ':rfc' => $rfc));
                if ($cfd && $cfd->cfdStatus->code == CfdStatus::ISSUED) {
                    $console->runCommand('gamacreatepdffromcfd', array($cfd->id));
                }
            }

            yii::app()->end();
        } catch (Exception $e) {
            yii::log($e->getMessage(), CLogger::LEVEL_ERROR, 'ProcessIncomingInvoiceFile');
            $incomingInvoiceInterfaceFile->processDttm = new CDbExpression('NOW()');
            $incomingInvoiceInterfaceFile->note = $e->getMessage();
            $incomingInvoiceInterfaceFile->IncomingInvoiceInterfaceFileStatus_id = IncomingInvoiceInterfaceFileStatus::model()->find('code = :code', array(':code' => IncomingInvoiceInterfaceFileStatus::ERROR))->id;
            $incomingInvoiceInterfaceFile->nativeXmlFile = null;
            $incomingInvoiceInterfaceFile->save();
            yii::app()->end();
        }
    }

}

?>
