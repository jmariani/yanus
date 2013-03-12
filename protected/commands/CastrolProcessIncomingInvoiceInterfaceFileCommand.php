<?php

/**
 * Description of CastrolProcessIncomingInvoiceInterfaceFileCommand:
 *
 * This process performs the following tasks:
 *  1) Reads the table IncomingInvoiceInterfaceFile for record with status = IncomingInvoiceInterfaceFile::PENDING_VALIDATION
 *  2) Foreach record, validate it
 *  3) Reads the table IncomingInvoiceInterfaceFile for record with status = IncomingInvoiceInterfaceFile::PENDING_PROCESSING
 *  4) Foreach record, process it
 *
 * @author jmariani
 */
class CastrolProcessIncomingInvoiceInterfaceFileCommand extends CConsoleCommand {

    const DEFAULT_PAYMENT_TYPE = 'PAGO EN UNA SOLA EXHIBICION';
    const DEFAULT_PAYMENT_METHOD = 'NO IDENTIFICADO';
    const DEFAULT_CURRENCY_CODE = 'MXN';
    const DEFAULT_EXCHANGE_RATE = 1;
    const DEFAULT_FISCAL_REGIME = 'Régimen General de Ley Personas Morales';

    // Columns from the input file
    const COL_COUNT = 91;
    const INVOICE_VERSION_COL = 0;  // IGNORED
    const INVOICE_NUMBER_COL = 1;   // REQUIRED. INVOICE SERIAL & FOLIO
    const FOLIO_APPROVAL_YEAR_COL = 2;  // IGNORED
    const INVOICE_PAYMENT_TYPE = 3; // IGNORED. REPLACED BY 'PAGO EN UNA SOLA EXHIBICION'
    const INVOICE_PAYMENT_TERM = 4; // REQUIRED. MUST EXIST ON PaymentTerm OBJECT.
    const INVOICE_PAYMENT_COL = 5;  // IGNORED
    const INVOICE_DOC_TYPE = 6; // OPTIONAL. IF IT'S EMPTY, IT'S A COMMENT LINE. IF IT'S NOT, MUST BE 'INGRESO' OR 'EGRESO'.
    // VENDOR DATA
    const VENDOR_RFC_COL = 7;   // REQUIRED. MUST BE A VALLID RFC
    const VENDOR_NAME_COL = 8;  // REQUIRED.
    // VENDOR FISCAL ADDRESS
    const VENDOR_ADDRESS_STREET_COL = 9;    // REQUIRED
    const VENDOR_ADDRESS_EXTNUM_COL = 10;   // OPTIONAL
    const VENDOR_ADDRESS_INTNUM_COL = 11;   // OPTIONAL
    const VENDOR_ADDRESS_NEIGHBOURHOOD_COL = 12;    // REQUIRED. MUNICIPALITY
    const VENDOR_ADDRESS_CITY_COL = 13; // OPTIONAL
    const VENDOR_ADDRESS_STATE_COL = 14;    // REQUIRED
    const VENDOR_ADDRESS_COUNTRY_COL = 15;  // REQUIRED
    const VENDOR_ADDRESS_ZIPCODE_COL = 16;  // REQUIRED
    // VENDOR INVOICED FROM ADDRESS
    // OPTIONAL
    const INVOICE_FROM_NAME_COL = 17;
    const INVOICE_FROM_ADDRESS_STREET_COL = 18;
    const INVOICE_FROM_ADDRESS_EXTNUM_COL = 19;
    const INVOICE_FROM_ADDRESS_INTNUM_COL = 20;
    const INVOICE_FROM_ADDRESS_NEIGHBOURHOOD_COL = 21;
    const INVOICE_FROM_ADDRESS_CITY_COL = 22;
    const INVOICE_FROM_ADDRESS_STATE_COL = 23;
    const INVOICE_FROM_ADDRESS_COUNTRY_COL = 24;
    const INVOICE_FROM_ADDRESS_ZIPCODE_COL = 25;

    // CUSTOMER DATA
    const CUSTOMER_RFC_COL = 26;
    const CUSTOMER_NAME_COL = 27;
    // CUSTOMER ADDRESS
    const CUSTOMER_SOLD_TO_ADDRESS_STREET_COL = 28; // OPTIONAL
    const CUSTOMER_SOLD_TO_ADDRESS_EXTNUM_COL = 29; // OPTIONAL
    const CUSTOMER_SOLD_TO_ADDRESS_INTNUM_COL = 30; // OPTIONAL
    const CUSTOMER_SOLD_TO_ADDRESS_NEIGHBOURHOOD_COL = 31;  // OPTIONAL
    const CUSTOMER_SOLD_TO_ADDRESS_CITY_COL = 32;   // OPTIONAL
    const CUSTOMER_SOLD_TO_ADDRESS_STATE_COL = 33;  // OPTIONAL
    const CUSTOMER_SOLD_TO_ADDRESS_COUNTRY_COL = 34;    // REQUIRED
    const CUSTOMER_SOLD_TO_ADDRESS_ZIPCODE_COL = 35;    // OPTIONAL
    // Item
    const ITEM_QTY = 36;    // REQUIRED
    const PRODUCT_UOM_COL = 37; // OPTIONAL. DEFAULT TO EA
    const PRODUCT_CODE_COL = 38;    // OPTIONAL
    const PRODUCT_DESCRIPTION_COL_1 = 39;   // REQUIRED
    const PRODUCT_DESCRIPTION_COL_2 = 40;   // OPTIONAL
    const ITEM_UNIT_PRICE = 41; // REQUIRED
    const ITEM_TOTAL_PRICE = 42;    // REQUIRED
    // Pedimento
    const CUSTOMS_DOCUMENT_NUMBER_COL = 43;
    const CUSTOMS_DOCUMENT_DATE_COL = 44;
    const CUSTOMS_NAME_COL = 45;

    // TAX
    const TAX_TYPE = 46;
    const TAX_RATE = 47;
    const TAX_AMOUNT = 48;
    const TAX_TOTAL_AMOUNT = 49;
    const TOTAL_BEFORE_DISCOUNT = 50;
    const DISCOUNT_AMOUNT = 51;
    const DISCOUNT_REASON = 52;
    const TOTAL_AFTER_DISCOUNT = 53;
    const DISCOUNT_AMOUNT_2 = 54;
    const DISCOUNT_REASON_2 = 55;
    const DISCOUNT_AMOUNT_3 = 56;
    const DISCOUNT_REASON_3 = 57;
    const DISCOUNT_AMOUNT_4 = 58;
    const DISCOUNT_REASON_4 = 59;
    const CURRENCY_COL = 60;
    const CURRENCY_RATE_COL = 61;
    const QUANTITY_IN_LT_COL = 62;
    const PROMISED_DATE_COL = 63;
    const TIME_OF_DAY_COL = 64;
    const BP_ORDER_NBR_COL = 65;
    const CUSTOMER_ORDER_NBR_COL = 66;
    const BP_CUSTOMER_CODE_COL = 67;
    const EMAIL_ADDRESS_COL = 68;


    // Customer Ship To address
    const CUSTOMER_SHIP_TO_RFC_COL = 69;
    const CUSTOMER_SHIP_TO_NAME_COL = 70;
    const CUSTOMER_SHIP_TO_ADDRESS_STREET_COL = 71;
    const CUSTOMER_SHIP_TO_ADDRESS_EXTNUM_COL = 72;
    const CUSTOMER_SHIP_TO_ADDRESS_INTNUM_COL = 73;
    const CUSTOMER_SHIP_TO_ADDRESS_NEIGHBOURHOOD_COL = 74;
    const CUSTOMER_SHIP_TO_ADDRESS_CITY_COL = 75;
    const CUSTOMER_SHIP_TO_ADDRESS_STATE_COL = 76;
    const CUSTOMER_SHIP_TO_ADDRESS_COUNTRY_COL = 77;
    const CUSTOMER_SHIP_TO_ADDRESS_ZIPCODE_COL = 78;
    const INVOICE_DATE_COL = 79;
    const AGENT_COL = 80;
    const TRANSPORT_COL = 81;
    const TRANSACTION_ORDER_DATE_COL = 82;
    const FOREIGN_UNIT_PRICE_COL = 83;
    const FOREIGN_EXTENDED_PRICE_COL = 84;
    const FOREIGN_TAX_COL = 85;
    const FOREIGN_DISCOUNT = 86;
    const FOREIGN_DISCOUNT_2 = 87;
    const FOREIGN_DISCOUNT_3 = 88;
    const FOREIGN_DISCOUNT_4 = 89;

    public function run($args) {
        yii::trace(yii::t('yanus', 'Starting validation and processing of files'), __METHOD__);
//        $runProcess = new RunProcess();
//        $runProcess->name = $this->name;
//        $runProcess->save();
//
        try {
            $pendingValidationFiles = IncomingInvoiceInterfaceFile::model()->findAll('status = :status', array(':status' => 'swIncomingInvoiceInterfaceFile/' . IncomingInvoiceInterfaceFile::PENDING_VALIDATION));
            echo count($pendingValidationFiles) . PHP_EOL;
            foreach ($pendingValidationFiles as $pendingValidationFile) {
                // Validate files
                $this->validate($pendingValidationFile);
            }
            $pendingProcessFiles = IncomingInvoiceInterfaceFile::model()->findAll('status = :status', array(':status' => 'swIncomingInvoiceInterfaceFile/' . IncomingInvoiceInterfaceFile::PENDING_PROCESSING));
            echo count($pendingProcessFiles) . PHP_EOL;
            foreach ($pendingProcessFiles as $pendingProcessFile) {
                // Process files
//                $this->process($pendingProcessFile);
            }
//            $runProcess->swNextStatus(array('status' => RunProcess::STATUS_SUCCESS));
//            $runProcess->endDttm = date(DateTime::ISO8601);
//            $runProcess->save();
        } catch (Exception $e) {
//            $runProcess->swNextStatus(array('status' => RunProcess::STATUS_ERROR));
//            $runProcess->endDttm = date(DateTime::ISO8601);
//            $runProcess->msg = $e->getMessage();
//            $runProcess->save();
        }
    }

    public static function getInvoiceDt($dt) {
        return new DateTime(trim(str_replace(' ', '', $dt)), new DateTimeZone('America/Mexico_City'));
    }

    private static function normalizeDataRow($data) {
        // Normalize UTF8
        foreach ($data as $key => $value) {
            $data[$key] = trim(mb_convert_encoding($value, 'utf8'));
        }
        return $data;
    }

    private static function saveCfd($cfd) {
        $cfd->total = $cfd->tax + $cfd->subTotal;
        $cfd->save();
        // Create XML
//        $cfd->runCreateXml();
    }

    private function validate(IncomingInvoiceInterfaceFile $model) {
        yii::trace(yii::t('yanus', 'Validating file "{file}"', array('{file}' => $model->fileLocation)), __METHOD__);
        try {
//            $log = new YanusLog($model->getLogFileName(), true);
//            $log->log(yii::t('yanus', 'Validating file "{file}"', array('{file}' => $model->fileName)));
//            $log->log(yii::t('yanus', 'Waiting to lock file "{file}"', array('{file}' => $model->fileName)));
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
                    $prevPT = 'XXX';
                    while (($data = fgetcsv($fHandle, 0, '|')) !== FALSE) {
//                            $log->log(yii::t('yanus', 'Validating row {row}', array('{row}' => $row)));
                        if (count($data) != self::COL_COUNT)
                            continue; // IGNORE ROWS WITH MORE OR LESS COLUMNS THAN EXPECTED
//                        if (count($data) != self::COL_COUNT)
//                            throw new CException(yii::t('yanus', 'Row {row}: Invalid column count. Row contains {count} rows.', array('{row}' => $row,
//                                        '{count}' => count($data))));
                        // TEST INVOICE_NUMBER_COL
                        if (!$data[self::INVOICE_NUMBER_COL])
                            throw new CException(yii::t('yanus', 'Row {row}, column {col}: Invoice folio cannot be null.', array('{row}' => $row,
                                        '{col}' => self::INVOICE_NBR_COL)));
                        // TEST PAYMENT TERM COLUMN
                        if (!$data[self::INVOICE_PAYMENT_TERM])
                            throw new CException(yii::t('yanus', 'Row {row}, column {col}: Payment term cannot be null.', array('{row}' => $row,
                                        '{col}' => self::INVOICE_PAYMENT_TERM)));
                        if ($prevPT != $data[self::INVOICE_PAYMENT_TERM]) {
                            $prevPT = $data[self::INVOICE_PAYMENT_TERM];
                            if (!PaymentTerm::model()->find('name = :name', array(':name' => $data[self::INVOICE_PAYMENT_TERM])))
                                throw new CException(yii::t('yanus', 'Row {row}, column {col}: Payment term "{term}" not found.', array('{row}' => $row,
                                            '{col}' => self::INVOICE_PAYMENT_TERM, '{term}' => $data[self::INVOICE_PAYMENT_TERM])));
                        }

                        // TEST INVOICE_DOC_TYPE
                        if ($data[self::INVOICE_DOC_TYPE])
                            if ($data[self::INVOICE_DOC_TYPE] != 'INGRESO' && $data[self::INVOICE_DOC_TYPE] != 'EGRESO')
                                throw new CException(yii::t('yanus', 'Row {row}, column {col}: Invoice document type "{type}" is invalid.', array('{row}' => $row,
                                            '{col}' => self::INVOICE_DOC_TYPE, '{type}' => $data[self::INVOICE_DOC_TYPE])));

                        // TEST VENDOR RFC
                        if (!$data[self::VENDOR_RFC_COL])
                            throw new CException(yii::t('yanus', 'Row {row}, column {col}: Vendor RFC cannot be null.', array('{row}' => $row,
                                        '{col}' => self::VENDOR_RFC_COL)));
                        $vendorRfc = new SatRfc($data[self::VENDOR_RFC_COL]);
                        if ($vendorRfc->hasError)
                            throw new CException(yii::t('yanus', 'Row {row}, column {col}: Vendor RFC has errors: ', array('{row}' => $row,
                                        '{col}' => self::VENDOR_RFC_COL)) . $vendorRfc->error);

                        // TEST VENDOR NAME
                        if (!$data[self::VENDOR_NAME_COL])
                            throw new CException(yii::t('yanus', 'Row {row}, column {col}: Vendor name cannot be null.', array('{row}' => $row,
                                        '{col}' => self::VENDOR_NAME_COL)));

                        // TEST VENDOR FISCAL ADDRESS
                        // TEST VENDOR FISCAL ADDRESS STREET
                        if (!$data[self::VENDOR_ADDRESS_STREET_COL])
                            throw new CException(yii::t('yanus', 'Row {row}, column {col}: Vendor primary address street cannot be null.', array('{row}' => $row,
                                        '{col}' => self::VENDOR_ADDRESS_STREET_COL)));
                        // TEST VENDOR FISCAL ADDRESS MUNICIPALITY
                        if (!$data[self::VENDOR_ADDRESS_NEIGHBOURHOOD_COL])
                            throw new CException(yii::t('yanus', 'Row {row}, column {col}: Vendor primary address municipality cannot be null.', array('{row}' => $row,
                                        '{col}' => self::VENDOR_ADDRESS_NEIGHBOURHOOD_COL)));
                        // TEST VENDOR FISCAL ADDRESS ZIP CODE
                        if (!$data[self::VENDOR_ADDRESS_ZIPCODE_COL])
                            throw new CException(yii::t('yanus', 'Row {row}, column {col}: Vendor primary address zip code cannot be null.', array('{row}' => $row,
                                        '{col}' => self::VENDOR_ADDRESS_ZIPCODE_COL)));
                        // TEST VENDOR FISCAL ADDRESS COUNTRY
                        if (!$data[self::VENDOR_ADDRESS_COUNTRY_COL])
                            throw new CException(yii::t('yanus', 'Row {row}, column {col}: Vendor primary address country cannot be null.', array('{row}' => $row,
                                        '{col}' => self::VENDOR_ADDRESS_COUNTRY_COL)));
                        // TEST VENDOR FISCAL ADDRESS STATE
                        if (!$data[self::VENDOR_ADDRESS_STATE_COL])
                            throw new CException(yii::t('yanus', 'Row {row}, column {col}: Vendor primary address state cannot be null.', array('{row}' => $row,
                                        '{col}' => self::VENDOR_ADDRESS_STATE_COL)));

                        // TEST CUSTOMER ADDRESS COUNTRY
                        if (!$data[self::CUSTOMER_SOLD_TO_ADDRESS_COUNTRY_COL])
                            throw new CException(yii::t('yanus', 'Row {row}, column {col}: Customer address country cannot be null.', array('{row}' => $row,
                                        '{col}' => self::CUSTOMER_SOLD_TO_ADDRESS_COUNTRY_COL)));

                        // TEST BP CUSTOMER CODE
                        if (!$data[self::BP_CUSTOMER_CODE_COL])
                            throw new CException(yii::t('yanus', 'Row {row}, column {col}: BP Customer code cannot be null.', array('{row}' => $row,
                                        '{col}' => self::BP_CUSTOMER_CODE_COL)));
                        if (!$data[self::TIME_OF_DAY_COL])
                            throw new CException(yii::t('yanus', 'Row {row}, column {col}: Invoice time cannot be null.', array('{row}' => $row,
                                        '{col}' => self::TIME_OF_DAY_COL)));
                        if (!$data[self::INVOICE_DATE_COL])
                            throw new CException(yii::t('yanus', 'Row {row}, column {col}: Invoice date cannot be null.', array('{row}' => $row,
                                        '{col}' => self::INVOICE_DATE_COL)));

                        // TEST ITEM
                        if ($data[self::INVOICE_DOC_TYPE]) {
                            // TEST ITEM QTY
                            if (!$data[self::ITEM_QTY])
                                throw new CException(yii::t('yanus', 'Row {row}, column {col}: Item quantity cannot be null.', array('{row}' => $row,
                                            '{col}' => self::ITEM_QTY)));
                            // TEST ITEM DESCRIPTION
                            if (!trim($data[self::PRODUCT_DESCRIPTION_COL_1] . ' ' . $data[self::PRODUCT_DESCRIPTION_COL_2]))
                                throw new CException(yii::t('yanus', 'Row {row}, column {col}: Item description cannot be null.', array('{row}' => $row,
                                            '{col}' => self::PRODUCT_DESCRIPTION_COL_1)));
                            switch ($data[self::BP_CUSTOMER_CODE_COL]) {
                                // S3 customers
                                case '124443':
                                    if (!trim($data[self::TOTAL_AFTER_DISCOUNT]))
                                        throw new CException(yii::t('yanus', 'Row {row}, column {col}: Item total price after discount cannot be null.', array('{row}' => $row,
                                                    '{col}' => self::TOTAL_AFTER_DISCOUNT)));
                                    break;
                                default:
                                    // TEST ITEM UNIT PRICE
                                    if (!$data[self::ITEM_UNIT_PRICE])
                                        throw new CException(yii::t('yanus', 'Row {row}, column {col}: Item unit price cannot be null.', array('{row}' => $row,
                                                    '{col}' => self::ITEM_UNIT_PRICE)));
                            }
                            if (!$data[self::TAX_TYPE])
                                throw new CException(yii::t('yanus', 'Row {row}, column {col}: Item tax type cannot be null.', array('{row}' => $row,
                                            '{col}' => self::TAX_TYPE)));
                            // Check tax rate
                            if (!$data[self::TAX_RATE])
                                throw new CException(yii::t('yanus', 'Row {row}, column {col}: Item tax rate cannot be null.', array('{row}' => $row,
                                            '{col}' => self::TAX_RATE)));
                            // TEST CUSTOMS PERMIT
                            if ($data[self::CUSTOMS_DOCUMENT_NUMBER_COL]) {
                                if (!CustomsPermit::model()->find('nbr = :nbr', array(':nbr' => $data[self::CUSTOMS_DOCUMENT_NUMBER_COL]))) {
                                    if (!$data[self::CUSTOMS_DOCUMENT_DATE_COL])
                                        throw new CException(yii::t('app', '[{row},{col}] Date for customs permit Nº "{nbr}" cannot be null.', array('{row}' => $row,
                                                    '{col}' => self::CUSTOMS_DOCUMENT_DATE_COL,
                                                    '{nbr}' => $data[self::CUSTOMS_DOCUMENT_NUMBER_COL])));
                                    $customsDt = DateTime::createFromFormat("Y/m/d", $data[self::CUSTOMS_DOCUMENT_DATE_COL]);
                                    if (!$customsDt)
                                        throw new CException(yii::t('app', '[{row},{col}] Invalid date "{date}" for customs permit Nº "{nbr}".', array('{row}' => $row,
                                                    '{col}' => self::CUSTOMS_DOCUMENT_DATE_COL, '{date}' => $data[self::CUSTOMS_DOCUMENT_DATE_COL],
                                                    '{nbr}' => $data[self::CUSTOMS_DOCUMENT_NUMBER_COL])));
                                }
                            }
                        }
//                        // TEST INVOICE DATE
//                        if (!$data[self::INVOICE_DATE_COL])
//                            throw new CException(yii::t('yanus', 'Row {row}, column {col}: Invoice date cannot be null.', array('{row}' => $row,
//                                        '{col}' => self::INVOICE_DATE_COL)));
//
//                        $invoiceDt = self::getInvoiceDt($data[self::INVOICE_DATE_COL]);
//                        if (!$invoiceDt)
//                            throw new CException(yii::t('yanus', 'Row {row}, column {col}: Invalid invoice date "{date}".', array('{row}' => $row,
//                                        '{col}' => self::INVOICE_DATE_COL,
//                                        '{date}' => $data[self::INVOICE_DATE_COL])));
//                        if ($runMode == SystemConfig::RUN_MODE_PRODUCTION) {
//                            // test date older than 72 Hs.
//                            $now = new DateTime(null, new DateTimeZone('America/Mexico_City'));
//                            $dateDiff = abs($now->format('U') - $invoiceDt->format('U'));
//                            if ($dateDiff >= 259200)
//                                throw new CException(yii::t('yanus', 'Row {row}, column {col}: Invoice date "{date}" is more than 72 Hs old.', array('{row}' => $row,
//                                            '{col}' => self::INVOICE_DATE_COL,
//                                            '{date}' => $data[self::INVOICE_DATE_COL])));
//                        }
//
//
//                        // TEST VENDOR NAME
//                        if (!$data[self::VENDOR_NAME_COL])
//                            throw new CException(yii::t('yanus', 'Row {row}, column {col}: Vendor name cannot be null.', array('{row}' => $row,
//                                        '{col}' => self::VENDOR_NAME_COL)));
//
//                        // TEST VENDOR ADDRESS
//                        if (!$data[self::VENDOR_ADDRESS_STREET_COL])
//                            throw new CException(yii::t('yanus', 'Row {row}, column {col}: Vendor address street cannot be null.', array('{row}' => $row,
//                                        '{col}' => self::VENDOR_ADDRESS_STREET_COL)));
//                        if (!$data[self::VENDOR_ADDRESS_MUNICIPALITY_COL])
//                            throw new CException(yii::t('yanus', 'Row {row}, column {col}: Vendor address municipality cannot be null.', array('{row}' => $row,
//                                        '{col}' => self::VENDOR_ADDRESS_MUNICIPALITY_COL)));
//                        if (!$data[self::VENDOR_ADDRESS_STATE_COL])
//                            throw new CException(yii::t('yanus', 'Row {row}, column {col}: Vendor address state cannot be null.', array('{row}' => $row,
//                                        '{col}' => self::VENDOR_ADDRESS_STATE_COL)));
//                        if (!$data[self::VENDOR_ADDRESS_COUNTRY_COL])
//                            throw new CException(yii::t('yanus', 'Row {row}, column {col}: Vendor address country cannot be null.', array('{row}' => $row,
//                                        '{col}' => self::VENDOR_ADDRESS_COUNTRY_COL)));
//                        if (!$data[self::VENDOR_ADDRESS_ZIPCODE_COL])
//                            throw new CException(yii::t('yanus', 'Row {row}, column {col}: Vendor address zip code cannot be null.', array('{row}' => $row,
//                                        '{col}' => self::VENDOR_ADDRESS_ZIPCODE_COL)));
//
//                        // TEST CUSTOMER RFC
//                        if (!$data[self::CUSTOMER_RFC_COL])
//                            throw new CException(yii::t('yanus', 'Row {row}, column {col}: Customer RFC cannot be null.', array('{row}' => $row,
//                                        '{col}' => self::CUSTOMER_RFC_COL)));
//                        $customerRfc = new SatRfc($data[self::CUSTOMER_RFC_COL]);
//                        if ($customerRfc->hasError)
//                            throw new CException(yii::t('yanus', 'Row {row}, column {col}: Customer RFC has errors: ', array('{row}' => $row,
//                                        '{col}' => self::CUSTOMER_RFC_COL)) . $customerRfc->error);
//
//                        // TEST CUSTOMER NAME
//                        if (!$data[self::CUSTOMER_RFC_COL])
//                            throw new CException(yii::t('yanus', 'Row {row}, column {col}: Customer name cannot be null.', array('{row}' => $row,
//                                        '{col}' => self::VENDOR_NAME_COL)));
//
//                        // TEST CUSTOMER ADDRESS
//                        if (!$data[self::CUSTOMER_ADDRESS_COUNTRY_COL])
//                            throw new CException(yii::t('yanus', 'Row {row}, column {col}: Customer address country cannot be null.', array('{row}' => $row,
//                                        '{col}' => self::CUSTOMER_ADDRESS_COUNTRY_COL)));
//
//                        // TEST TAX
//                        if (!$data[self::TAX_NAME_COL])
//                            throw new CException(yii::t('yanus', 'Row {row}, column {col}: Tax name cannot be null.', array('{row}' => $row,
//                                        '{col}' => self::TAX_NAME_COL)));
//                        if (!$data[self::TAX_RATE_COL])
//                            throw new CException(yii::t('yanus', 'Row {row}, column {col}: Tax rate cannot be null.', array('{row}' => $row,
//                                        '{col}' => self::TAX_RATE_COL)));
//                        if (!$data[self::TAX_AMOUNT_COL])
//                            throw new CException(yii::t('yanus', 'Row {row}, column {col}: Tax amount cannot be null.', array('{row}' => $row,
//                                        '{col}' => self::TAX_AMOUNT_COL)));
//
//                        // TEST ITEM
//                        if (!$data[self::ITEM_DESCRIPTION_COL])
//                            throw new CException(yii::t('yanus', 'Row {row}, column {col}: Item description cannot be null.', array('{row}' => $row,
//                                        '{col}' => self::ITEM_DESCRIPTION_COL)));
                    }
                    $row++;
//                    $log->log(yii::t('yanus', 'Validation ended successfully. {rows} rows validated.', array('{rows}' => $row - 1)));
                    fclose($fHandle);
                    // Move to next step
                    $model->swNextStatus(array('status' => IncomingInvoiceInterfaceFile::PENDING_PROCESSING));
                    $model->validationDttm = new CDbExpression('NOW()');
                    $model->save();
//                    self::processIncomingInvoiceInterfaceFile($model);
                    return true;
                } catch (Exception $e) {
//                    $log->log($e->getMessage(), CLogger::LEVEL_ERROR);
                    yii::log($e->getMessage(), CLogger::LEVEL_ERROR, __METHOD__);
                    $model->note = $e->getMessage();
                    $model->swNextStatus(array('status' => IncomingInvoiceInterfaceFile::VALIDATION_ERROR));
                    $model->save();
                    @fclose($fHandle);
                    return false;
                }
            } else
                throw new CException(yii::t('yanus', 'Failed to open file "{file}"', array('{file}' => $model->fileLocation)));
        } catch (CException $e) {
            yii::log($e->getMessage(), CLogger::LEVEL_ERROR, __METHOD__);
//            yii::log('[' . __METHOD__ . '] (' . $e->getLine() . ') ' . $e->getMessage(), CLogger::LEVEL_ERROR);
            $model->swNextStatus(array('status' => IncomingInvoiceInterfaceFile::ERROR));
//            $model->note = '[' . __METHOD__ . '] (' . $e->getLine() . ') ' . $e->getMessage();
            $model->save();
            @fclose($fHandle);
            return false;
        }
    }

    private function process(IncomingInvoiceInterfaceFile $model) {
        yii::trace(yii::t('yanus', 'Processing file "{file}"', array('{file}' => $model->fileLocation)), __METHOD__);
        try {
//            $log = new YanusLog($model->getLogFileName());

            $model->swNextStatus(IncomingInvoiceInterfaceFile::PROCESSING);
            $model->save();
//            $log->log(yii::t('yanus', 'Processing file "{file}"', array('{file}' => $model->fileName)));
//            $log->log(yii::t('yanus', 'Waiting to lock file "{file}"', array('{file}' => $model->fileName)));
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
                    while (($data = fgetcsv($fHandle, 0, '|')) !== FALSE) {
                        if ($row == 1) {
                            // Skip first row
//                            $log->log(yii::t('yanus', 'Skipping row {row}', array('{row}' => $row)));
                        } else {
                            $data = self::normalizeDataRow($data);
                            if ($invoiceNbr != $data[self::INVOICE_NBR_COL]) {
                                // Save previous invoice if any.

                                if ($cfd)
                                    self::saveCfd($cfd);

                                $invoiceNbr = $data[self::INVOICE_NBR_COL];
//                                $log->log(yii::t('yanus', 'Processing invoice {nbr}', array('{nbr}' => $invoiceNbr)));
                                $md5 = md5($data[self::VENDOR_RFC_COL] . '|' . $invoiceNbr . '|' . $data[self::CUSTOMER_RFC_COL]);
//                            // Find if invoice already exists.
                                if (cfd::model()->find('md5 = :md5', array(':md5' => $md5))) {
                                    // Invoice already exists, so we skip until next invoice
//                                    $log->log(yii::t('yanus', 'Invoice {invoice} already exists', array('{invoice}' => $invoiceNbr)));
                                    $cfd = false;
                                    continue;
                                }
                                $cfd = new Cfd();
                                $cfd->invoice = $invoiceNbr;
                                $cfd->version = SystemConfig::getValue(SystemConfig::CURRENT_CFD_VERSION);
                                $cfd->folio = $invoiceNbr;
                                $cfd->dttm = self::getInvoiceDt($data[self::INVOICE_DATE_COL])->format(DateTime::ISO8601);
                                $cfd->paymentType = 'PAGO EN UNA SOLA EXHIBICION';
                                $cfd->paymentTerm = $data[self::PAYMENT_TERM_COL];
                                $cfd->currency = 'MXP';
                                if ($currency)
                                    $cfd->currency0 = $currency;
                                $cfd->voucherType = ($data[self::DOCUMENT_TYPE_COL] == 0 ? 'ingreso' : 'egreso');
                                $cfd->paymentMethod = $data[self::PAYMENT_METHOD_COL];

                                if (isset($data[self::BANK_ACCT_COL])) {
                                    if ($data[self::BANK_ACCT_COL]) {
                                        if ($data[self::BANK_ACCT_COL] != 'XXXX')
                                            $cfd->paymentAcctNbr = $data[self::BANK_ACCT_COL];
                                    }
                                }
                                $cfd->md5 = $md5;

                                // Preprocess invoice.
                                // First create vendor phone nbr if not exists.
                                $phoneNbr = PhoneNbr::model()->find('value = :value', array(':value' => PhoneNbr::cleanUpNbr($data[self::VENDOR_PHONE_NBR_COL])));
                                if (!$phoneNbr) {
                                    $phoneNbr = new PhoneNbr();
                                    $phoneNbr->value = PhoneNbr::cleanUpNbr($data[self::VENDOR_PHONE_NBR_COL]);
                                    $phoneNbr->save();
                                }

                                // Test vendor.
                                $vendor = Party::model()->findByPartyIdentifierAndNumber(PartyIdentifierNameBehavior::RFC, $data[self::VENDOR_RFC_COL]);
                                if (!$vendor) {
                                    // Create new vendor
                                    $vendor = new Party();
                                    $vendor->person = FALSE;

                                    $vendor->addIdentifier($data[self::VENDOR_RFC_COL]);

                                    $vendor->addName($data[self::VENDOR_NAME_COL]);

                                    $vendor->addLocator($phoneNbr, PartyLocatorTypeBehavior::PRIMARY);

                                    $vendor->save();
                                } else {
                                    if ($vendor->name != $data[self::VENDOR_NAME_COL])
                                        $vendor->addName($data[self::VENDOR_NAME_COL]);
                                    // Test vendor phone nbr
                                    if ($vendor->primaryPhone != $phoneNbr->value)
                                        $vendor->addLocator($phoneNbr);
                                    if ($vendor->isDirty())
                                        $vendor->save();
                                }

                                // Add vendor to CFD
                                $cfd->addParty($vendor);

                                // Test customer.
                                $customer = Party::model()->findByPartyIdentifierAndNumber(PartyIdentifierNameBehavior::RFC, $data[self::CUSTOMER_RFC_COL]);
                                if (!$customer) {
                                    // Create new customer
                                    $customer = new Party();
                                    $customer->person = (strlen($data[self::CUSTOMER_RFC_COL]) == 13);

                                    // Save Party Identifier
                                    $customer->addIdentifier($data[self::CUSTOMER_RFC_COL]);

                                    // Save Party Name
                                    $customer->addName($data[self::CUSTOMER_NAME_COL]);

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
                                    if ($customer->name != $data[self::CUSTOMER_NAME_COL]) {
                                        $customer->addName($data[self::VENDOR_NAME_COL]);
                                        $customer->save();
                                    }
                                }
                                // Add customer to CFD
                                $cfd->addParty($customer, CfdPartyTypeBehavior::CUSTOMER);

                                // Test vendor primary address
                                $tmpVendorPrimaryAddress = new Address();
                                $tmpVendorPrimaryAddress->street = $data[self::VENDOR_ADDRESS_STREET_COL];
                                $tmpVendorPrimaryAddress->neighbourhood = $data[self::VENDOR_ADDRESS_COLONY_COL];
                                $tmpVendorPrimaryAddress->city = $data[self::VENDOR_ADDRESS_CITY_COL];
                                $tmpVendorPrimaryAddress->municipality = $data[self::VENDOR_ADDRESS_MUNICIPALITY_COL];
                                $tmpVendorPrimaryAddress->state = $data[self::VENDOR_ADDRESS_STATE_COL];
                                $tmpVendorPrimaryAddress->country = $data[self::VENDOR_ADDRESS_COUNTRY_COL];
                                $tmpVendorPrimaryAddress->zipCode = substr('00000' . $data[self::VENDOR_ADDRESS_ZIPCODE_COL], -5);
                                $vendorPrimaryAddress = Address::model()->find('md5 = :md5', array(':md5' => $tmpVendorPrimaryAddress->getMd5()));
                                if (!$vendorPrimaryAddress) {
                                    $tmpVendorPrimaryAddress->save();
                                    $vendorPrimaryAddress = $tmpVendorPrimaryAddress;
                                }
                                // Add vendor address to CFD
                                $cfd->addAddress($vendorPrimaryAddress, null, $data[self::VENDOR_ADDRESS_REFERENCE_COL]);

                                $cfd->expeditionPlace = $vendorPrimaryAddress->street . ', ' .
                                        $vendorPrimaryAddress->neighbourhood . ', ' .
                                        $vendorPrimaryAddress->municipality . ', ' .
                                        $vendorPrimaryAddress->city . ', ' .
                                        $vendorPrimaryAddress->state . ', ' .
                                        $vendorPrimaryAddress->zipCode . ', ' .
                                        $vendorPrimaryAddress->country;

                                // Test customer address
                                $tmpCustomerAddress = new Address();
                                $tmpCustomerAddress->street = $data[self::CUSTOMER_ADDRESS_STREET_COL];
                                $tmpCustomerAddress->neighbourhood = $data[self::CUSTOMER_ADDRESS_COLONY_COL];
                                $tmpCustomerAddress->city = $data[self::CUSTOMER_ADDRESS_CITY_COL];
                                $tmpCustomerAddress->municipality = $data[self::CUSTOMER_ADDRESS_MUNICIPALITY_COL];
                                $tmpCustomerAddress->state = $data[self::CUSTOMER_ADDRESS_STATE_COL];
                                $tmpCustomerAddress->country = $data[self::CUSTOMER_ADDRESS_COUNTRY_COL];
                                $tmpCustomerAddress->zipCode = substr('00000' . $data[self::CUSTOMER_ADDRESS_ZIPCODE_COL], -5);
                                $customerAddress = Address::model()->find('md5 = :md5', array(':md5' => $tmpCustomerAddress->getMd5()));
                                if (!$customerAddress) {
                                    $tmpCustomerAddress->save();
                                    $customerAddress = $tmpCustomerAddress;
                                }
                                // Add customer address to CFD
                                $cfd->addAddress($customerAddress, null, null, AddressTypeBehavior::BILL_TO);

                                // Process Tax
                                $tax = new CfdTax();
                                $tax->name = $data[self::TAX_NAME_COL];
                                $tax->rate = $data[self::TAX_RATE_COL];
                                $tax->amt = $data[self::TAX_AMOUNT_COL];
                                $tax->local = false;
                                $tax->withHolding = false;
                                $cfd->addRelatedObject($tax);

                                $cfd->total = $data[self::TAX_AMOUNT_COL];
                                $cfd->tax = $tax->amt;

                                // Tax regimes
                                $taxRegime = new CfdTaxRegime();
                                $taxRegime->name = 'Régimen General de Ley Personas Morales';
                                $cfd->addRelatedObject($taxRegime);

                                // Find certificate
                                $certificate = SatCertificate::model()->valid()->find('rfc = :rfc', array(':rfc' => ($runMode == SystemConfig::RUN_MODE_PRODUCTION ? $data[self::VENDOR_RFC_COL] : SystemConfig::getValue(SystemConfig::DEMO_RFC))));
                                if (!$certificate)
                                    throw new Exception(yii::t('yanus', 'Valid certificate not found for vendor RFC "{rfc}"', array('{rfc}' => $data[self::VENDOR_RFC_COL])));
                                else
                                    $cfd->satCertificate = $certificate;
                            }

                            if ($cfd) {
                                // Process items if there's a CFD.
                                $cfdItem = new CfdItem();
                                $cfdItem->qty = $data[self::ITEM_QTY_COL];
                                $cfdItem->uom = 'EA';
                                $cfdItem->description = $data[self::ITEM_DESCRIPTION_COL];
                                $cfdItem->unitPrice = $data[self::ITEM_UNIT_PRICE_COL];
                                $cfdItem->amt = $data[self::ITEM_AMOUNT_COL];

                                // Add attributes to CFD Item
                                $cfdItem->authNbr = $data[self::AUTH_NBR_COL];
                                $cfdItem->serialNbr = $data[self::CAR_SERIAL_NBR_COL];
                                $cfdItem->engineNbr = $data[self::CAR_ENGINE_NBR_COL];
                                $cfdItem->group = $data[self::LICENSE_PLATE_COL];
                                $cfdItem->inventoryNbr = $data[self::CAR_INVENTORY_NBR_COL];
                                $cfdItem->km = $data[self::CAR_KM_COL];
                                $cfdItem->licensePlate = $data[self::LICENSE_PLATE_COL];
                                $cfdItem->userName = $data[self::CAR_USERNAME_COL];
                                $cfdItem->vehicle = $data[self::CAR_COL];
                                ;

                                $cfd->subTotal += $cfdItem->amt;
                                $cfd->addRelatedObject($cfdItem);
                            }
                        }
                        $row++;
                    }
                    if ($cfd)
                        self::saveCfd($cfd);
//                    $log->log(yii::t('yanus', 'Processing ended successfully. {rows} rows procesed.', array('{rows}' => $row - 1)));
                    fclose($fHandle);
                    // Move to next step
                    $model->swNextStatus(array('status' => IncomingInvoiceInterfaceFile::PROCESSED));
                    $model->processDttm = new CDbExpression('NOW()');
                    $model->save();
                    return true;
                } catch (Exception $e) {
//                    $log->log($e->getMessage(), CLogger::LEVEL_ERROR);
                    yii::log($e->getMessage() . ' - File: "' . $model->fileName . '"', CLogger::LEVEL_ERROR, __METHOD__);
                    $model->note = '[' . __METHOD__ . '] (' . $e->getLine() . ') ' . $e->getMessage();
                    $model->swNextStatus(array('status' => IncomingInvoiceInterfaceFile::PROCESSING_ERROR));
                    $model->save();
                    @fclose($fHandle);
                    return false;
                }
            } else
                throw new CException(yii::t('yanus', 'Failed to open file "{file}"', array('{file}' => $model->fileLocation)));
        } catch (Exception $e) {
//            $log->log($e->getMessage(), CLogger::LEVEL_ERROR);
            yii::log($e->getMessage() . ' - File: "' . $model->fileName . '"', CLogger::LEVEL_ERROR, __METHOD__);
            $model->note = $e->getMessage();
            $model->swNextStatus(array('status' => IncomingInvoiceInterfaceFile::ERROR));
            $model->save();
            @fclose($fHandle);
            return false;
        }
    }

//    public function actionValidate($modelId) {
//        try {
//            $model = IncomingInvoiceInterfaceFile::model()->findByPk($modelId);
//            self::validateIncomingInvoiceInterfaceFile($model);
//        } catch (Exception $e) {
//            yii::trace('[error] ' . $e->getMessage(), __METHOD__);
//        }
//    }
//
//    public function actionProcess($modelId) {
//        $model = IncomingInvoiceInterfaceFile::model()->findByPk($modelId);
//        self::processIncomingInvoiceInterfaceFile($model);
//    }
}

?>
