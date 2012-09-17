<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CastrolProcessIncomingInvoiceFile:
 *
 * This process performs the following tasks:
 *  1) Opens the file in Castrol format.
 *  2) Validates the contents of the file.
 *  3) Produces a Native XML file to be processed
 *
 * @author jmariani
 */
class CastrolProcessIncomingInvoiceFileCommand extends CConsoleCommand {

    const PARTY_RFC = 'TME1109123E9';
    const MASTER_ACCOUNT_ALIAS = 'TAMA';
    const DEFAULT_PAYMENT_TYPE = 'PAGO EN UNA SOLA EXHIBICION';
    const DEFAULT_PAYMENT_METHOD = 'NO IDENTIFICADO';
    const DEFAULT_CURRENCY_CODE = 'MXN';
    const DEFAULT_EXCHANGE_RATE = 1;
    const DEFAULT_FISCAL_REGIME = 'Régimen General de Ley Personas Morales';

    // Columns from the input file
    const COL_COUNT = 91;
    const INVOICE_VERSION_COL = 0;
    const INVOICE_NUMBER_COL = 1;
    const FOLIO_APPROVAL_YEAR_COL = 2;
    const INVOICE_PAYMENT_TYPE = 3;
    const INVOICE_PAYMENT_TERM = 4;
    const INVOICE_PAYMENT_COL = 5;
    const INVOICE_DOC_TYPE = 6;
    // Owner data (Castrol)
    const OWNER_RFC_COL = 7;
    const OWNER_NAME_COL = 8;
    const OWNER_ADDRESS_STREET_COL = 9;
    const OWNER_ADDRESS_EXTNUM_COL = 10;
    const OWNER_ADDRESS_INTNUM_COL = 11;
    const OWNER_ADDRESS_NEIGHBOURHOOD_COL = 12;
    const OWNER_ADDRESS_CITY_COL = 13;
    const OWNER_ADDRESS_STATE_COL = 14;
    const OWNER_ADDRESS_COUNTRY_COL = 15;
    const OWNER_ADDRESS_ZIPCODE_COL = 16;
    const INVOICE_FROM_NAME_COL = 17;
    const INVOICE_FROM_ADDRESS_STREET_COL = 18;
    const INVOICE_FROM_ADDRESS_EXTNUM_COL = 19;
    const INVOICE_FROM_ADDRESS_INTNUM_COL = 20;
    const INVOICE_FROM_ADDRESS_NEIGHBOURHOOD_COL = 21;
    const INVOICE_FROM_ADDRESS_CITY_COL = 22;
    const INVOICE_FROM_ADDRESS_STATE_COL = 23;
    const INVOICE_FROM_ADDRESS_COUNTRY_COL = 24;
    const INVOICE_FROM_ADDRESS_ZIPCODE_COL = 25;

    // Customer address
    const CUSTOMER_RFC_COL = 26;
    const CUSTOMER_NAME_COL = 27;
    const CUSTOMER_SOLD_TO_ADDRESS_STREET_COL = 28;
    const CUSTOMER_SOLD_TO_ADDRESS_EXTNUM_COL = 29;
    const CUSTOMER_SOLD_TO_ADDRESS_INTNUM_COL = 30;
    const CUSTOMER_SOLD_TO_ADDRESS_NEIGHBOURHOOD_COL = 31;
    const CUSTOMER_SOLD_TO_ADDRESS_CITY_COL = 32;
    const CUSTOMER_SOLD_TO_ADDRESS_STATE_COL = 33;
    const CUSTOMER_SOLD_TO_ADDRESS_COUNTRY_COL = 34;
    const CUSTOMER_SOLD_TO_ADDRESS_ZIPCODE_COL = 35;

    // Item
    const ITEM_QTY = 36;
    const PRODUCT_UOM_COL = 37;
    const PRODUCT_CODE_COL = 38;
    const PRODUCT_DESCRIPTION_COL_1 = 39;
    const PRODUCT_DESCRIPTION_COL_2 = 40;
    const ITEM_UNIT_PRICE = 41;
    const ITEM_TOTAL_PRICE = 42;

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

    private $fileName;
    private $logFile;
    private $fileError;
    private $nativeXMLFile;
    private $errors = array();

    const LOG_CATEGORY = 'IncomingInvoiceInterfaceFileProcessor';

    /**
     * Processes a file with CASTROL format.
     * @param array $args arguments for the process.
     * The first parameter is the invoice file with path.
     * @return string the translated message
     */
    private function log($msg, $level = CLogger::LEVEL_INFO, $category = self::LOG_CATEGORY) {
        yii::log($msg, $level, $category);
        error_log(date(DateTime::ISO8601) . ' - ' . '[' . $level . '] ' . $msg . PHP_EOL, 3, "$this->logFile");
        echo date(DateTime::ISO8601) . ' - ' . '[' . $level . '] ' . $msg . PHP_EOL;
    }

    public function run($args) {
        // - LOCK FILE
        // - When file is locked, try to open it.
        // - Castrol file is a CSV file.
        // - Produce a native XML and save it to NATIVE_XML_PATH

        $this->fileName = $args[0];
        $pathInfo = pathinfo($this->fileName);

        $logPath = SystemConfig::getValue(SystemConfig::LOG_PATH);
        if (!file_exists($logPath))
            mkdir($logPath, 0777, true);

        $this->logFile = $logPath . DIRECTORY_SEPARATOR . $pathInfo['filename'] . '.log';
        @unlink($this->logFile);

        $nativeXmlPath = SystemConfig::getValue(SystemConfig::NATIVE_XML_STORAGE_PATH);
        if (!file_exists($nativeXmlPath))
            mkdir($nativeXmlPath, 0777, true);
        $nativeXmlFile = $nativeXmlPath . DIRECTORY_SEPARATOR . $pathInfo['filename'] . '.xml';
        @unlink($nativeXmlFile);

        // Try to lock file to ensure is not still be written.
        $fp = fopen($this->fileName, 'r');
        while (!flock($fp, LOCK_EX)) {
            $this->log(yii::t('app', 'Waiting to lock file {file}', array('{file}' => $this->fileName)));
        }
        flock($fp, LOCK_UN);

        $this->log(yii::t('app', 'Processing file {file}', array('{file}' => $this->fileName)), CLogger::LEVEL_INFO);

        try {
            // Check if it exists in IncomingInvoiceInterfaceFile
            $model = IncomingInvoiceInterfaceFile::model()->find('fileName = :name', array(':name' => $pathInfo['basename']));
            // If the file name was not found
            if (!$model) {
                // Create new file in model
                $model = new IncomingInvoiceInterfaceFile();
                $model->fileName = $pathInfo['basename'];
            }
            $model->receptionDttm = new CDbExpression('NOW()');
            $model->processDttm = null;
            $model->note = null;
            $model->save();

            // Open file
            $fHandle = fopen($this->fileName, "r");

            // Setup
            $invoiceNbr = "XXX";

            // Update file status to processing.
            $model->IncomingInvoiceInterfaceFileStatus_id = IncomingInvoiceInterfaceFileStatus::model()->find('code = :code', array(':code' => IncomingInvoiceInterfaceFileStatus::PROCESSING))->id;
            $model->save();

            // Create Native XML file
            $nativeXml = new DOMDocument("1.0", "UTF-8");
            $root = $nativeXml->createElement('Comprobantes');
            $root = $nativeXml->appendChild($root);

            $invoice = false;
            $discount = 0;
            $subTotal = 0;
            $discounts = array();
            $row = 0;
            $isPemexInvoiceWithPreInvoice = false;
            $vendorRec = false;
            $noteCount = 1;
            $taxes = array();

            while (($data = fgetcsv($fHandle, 0, '|')) !== FALSE) {
                $row++;
                $colCount = count($data);
                if ($colCount <= 1)
                    continue;
                if ($colCount != self::COL_COUNT)
                    throw new CException(yii::t('app', 'Row {row} has {colCount} columns and must have {col_count}.', array('{row}' => $row, '{colCount}' => $colCount, '{col_count}' => self::COL_COUNT)));

                // Normalize UTF8
                for ($i = 0; $i < self::COL_COUNT; $i++) {
                    $data[$i] = trim(mb_convert_encoding($data[$i], 'utf8'));
                }

                if ($invoiceNbr != trim($data[self::INVOICE_NUMBER_COL])) {
                    if ($invoice) {
                        $descuentos = $invoice->appendChild($nativeXml->createElement('Descuentos'));
                        foreach ($discounts as $reason => $amt) {
                            $descuento = $descuentos->appendChild($nativeXml->createElement('Descuento'));
                            $descuento->setAttribute('motivo', $reason);
                            $descuento->setAttribute('importe', $amt);
                        }
                        $discounts = array();
                        foreach ($taxes as $type => $tax) {
                            $traslado = $traslados->appendChild($nativeXml->createElement('Traslado'));
                            $traslado->setAttribute('impuesto', $type);
                            foreach ($tax as $rate => $amt) {
                                $traslado->setAttribute('tasa', $rate * 100);
                                $traslado->setAttribute('importe', $amt);
                            }
                        }
                        $taxes = array();
//                        $invoice->setAttribute('subTotal', $subTotal);
//                        $subTotal = 0;
//                        $invoice = false;
//                        $isPemexInvoiceWithPreInvoice = false;
//                        $noteCount = 1;
                    }

                    $invoiceNbr = trim($data[self::INVOICE_NUMBER_COL]);
                    // InvoiceNbr validations
                    if (!$invoiceNbr)
                        throw new CException(yii::t('app', '[{row},{col}] Invoice number cannot be null', array('{row}' => $row,
                                    '{col}' => self::INVOICE_NUMBER_COL)));

                    $this->log(yii::t('app', 'Processing invoice {invoice}', array('{invoice}' => $invoiceNbr)), CLogger::LEVEL_INFO, self::LOG_CATEGORY);
                    $serie = substr($invoiceNbr, 0, 1);
                    $folio = substr($invoiceNbr, 1);

                    // Vendor validations
                    $vendorRfc = trim($data[self::OWNER_RFC_COL]);
                    if (!$vendorRfc)
                        throw new CException(yii::t('app', '[{row},{col}][{invoice}] Vendor RFC cannot be null', array('{row}' => $row,
                                    '{col}' => self::OWNER_RFC_COL, '{invoice}' => $invoiceNbr)));
                    try {
                        SatRfc::validate($vendorRfc);
                    } catch (CException $e) {
                        throw new CException(yii::t('app', '[{row},{col}][{invoice}] Invalid vendor RFC "{rfc}".', array('{row}' => $row,
                                    '{col}' => self::OWNER_RFC_COL, '{rfc}' => $vendorRfc, '{invoice}' => $invoiceNbr)));
                    }
                    $vendorName = trim(mb_convert_encoding($data[self::OWNER_NAME_COL], 'utf8'));
                    if (!$vendorName)
                        throw new CException(yii::t('app', '[{row},{col}][{invoice}] Vendor name cannot be null', array('{row}' => $row,
                                    '{col}' => self::OWNER_NAME_COL, '{invoice}' => $invoiceNbr)));

                    // Customer validations
                    $customerRfc = trim($data[self::CUSTOMER_RFC_COL]);
                    if (!$customerRfc)
                        throw new CException(yii::t('app', '[{row},{col}][{invoice}] Customer RFC cannot be null', array('{row}' => $row,
                                    '{col}' => self::CUSTOMER_RFC_COL, '{invoice}' => $invoiceNbr)));
                    try {
                        SatRfc::validate($customerRfc);
                    } catch (CException $e) {
                        throw new CException(yii::t('app', '[{row},{col}][{invoice}] Invalid customer RFC "{rfc}".', array('{row}' => $row,
                                    '{col}' => self::CUSTOMER_RFC_COL, '{rfc}' => $customerRfc, '{invoice}' => $invoiceNbr)));
                    }

                    $customerCode = trim($data[self::BP_CUSTOMER_CODE_COL]);
                    if (!$customerCode)
                        throw new CException(yii::t('app', '[{row},{col}][{invoice}] Customer code cannot be null', array('{row}' => $row,
                                    '{col}' => self::BP_CUSTOMER_CODE_COL, '{invoice}' => $invoiceNbr)));

                    $customerName = trim(mb_convert_encoding($data[self::CUSTOMER_NAME_COL], 'utf8'));
                    if (!$customerName)
                        throw new CException(yii::t('app', '[{row},{col}][{invoice}] Customer name cannot be null', array('{row}' => $row,
                                    '{col}' => self::CUSTOMER_NAME_COL, '{invoice}' => $invoiceNbr)));
//
//                    // Find invoice in database
//                    // If invoice already found, skip
//
//                    if (cfd::model()->find('vendorRfc = :vendorRfc and serial = :serial and folio = :folio', array(
//                                ':vendorRfc' => $vendorRfc,
//                                ':serial' => $serie,
//                                ':folio' => $folio))) {
//                        $this->log(yii::t('app', '[{row},{col}][{invoice}] Invoice Nº "{invoice}" already exists.', array(
//                                    '{row}' => $row, '{col}' => self::INVOICE_NUMBER_COL, '{invoice}' => $invoiceNbr
//                                )), CLogger::LEVEL_WARNING, self::LOG_CATEGORY);
//                        continue;
//                    }
//
                    $invoiceType = trim($data[self::INVOICE_DOC_TYPE]);
                    // Check Invoice Type
                    if (!$invoiceType)
                        throw new CException(yii::t('app', '[{row},{col}][{invoice}] Invoice type cannot be null.', array('{row}' => $row, '{col}' => self::INVOICE_DOC_TYPE, '{invoice}' => $invoiceNbr)));
                    switch ($invoiceType) {
                        case 'INGRESO':
                        case 'EGRESO':
                            break;
                        default:
                            throw new CException(yii::t('app', '[{row},{col}][{invoice}] Invalid invoice type "{type}". Valid types are INGRESO or EGRESO', array('{row}' => $row, '{col}' => self::INVOICE_DOC_TYPE,
                                        '{type}' => $invoiceType, '{invoice}' => $invoiceNbr)));
                    }
                    $customerOrderNbr = $data[self::CUSTOMER_ORDER_NBR_COL];

                    if (!trim($data[self::BP_ORDER_NBR_COL]))
                        throw new CException(yii::t('app', '[{row},{col}][{invoice}] BP Order Nº cannot be null.', array('{row}' => $row, '{col}' => self::BP_ORDER_NBR_COL, '{invoice}' => $invoiceNbr
                                )));

                    // Validate invoice date time
                    if (!trim($data[self::TIME_OF_DAY_COL]))
                        throw new CException(yii::t('app', '[{row},{col}][{invoice}] Invoice time cannot be null', array('{row}' => $row,
                                    '{col}' => self::TIME_OF_DAY_COL, '{invoice}' => $invoiceNbr)));

                    $invoiceTmStr = trim($data[self::TIME_OF_DAY_COL]);
                    if (strlen($invoiceTmStr) == 5)
                        $invoiceTmStr = '0' . $invoiceTmStr;

                    $invoiceTm = DateTime::createFromFormat("His", $invoiceTmStr);
                    if (!$invoiceTm)
                        throw new CException(yii::t('app', '[{row},{col}][{invoice}] Invalid invoice time "{tm}".', array('{row}' => $row,
                                    '{col}' => self::TIME_OF_DAY_COL, '{tm}' => trim($data[self::TIME_OF_DAY_COL]), '{invoice}' => $invoiceNbr)));

                    if (!trim($data[self::INVOICE_DATE_COL]))
                        throw new CException(yii::t('app', '[{row},{col}][{invoice}] Invoice date cannot be null', array('{row}' => $row,
                                    '{col}' => self::INVOICE_DATE_COL, '{invoice}' => $invoiceNbr)));

                    $invoiceDt = new DateTime(trim($data[self::INVOICE_DATE_COL]));
                    if (!$invoiceDt)
                        throw new CException(yii::t('app', '[{row},{col}][{invoice}] Invalid invoice date "{dt}".', array('{row}' => $row,
                                    '{col}' => self::INVOICE_DATE_COL, '{dt}' => trim($data[self::INVOICE_DATE_COL]), '{invoice}' => $invoiceNbr)));

                    $invoiceDttm = DateTime::createFromFormat("Y-m-d H:i:s", $invoiceDt->format("Y-m-d") . " " . $invoiceTm->format("H:i:s"), new DateTimeZone('EDT'));
                    $invoiceDttm->setTimeZone(new DateTimeZone('CDT'));

                    // Validate payment term
                    $paymentTerm = trim($data[self::INVOICE_PAYMENT_TERM]);
                    if (!$paymentTerm)
                        throw new CException(yii::t('app', '[{row},{col}][{invoice}] Payment term cannot be null', array('{row}' => $row,
                                    '{col}' => self::INVOICE_PAYMENT_TERM, '{invoice}' => $invoiceNbr)));

                    // Check if payment term exists
                    $paymentTermRec = PaymentTerm::model()->find('name = :name', array(':name' => $paymentTerm));
                    if (!$paymentTermRec)
                        throw new CException(yii::t('app', '[{row},{col}][{invoice}] Payment term "{term}" does not exists.', array('{row}' => $row, '{col}' => self::INVOICE_PAYMENT_TERM,
                                    '{term}' => $paymentTerm, '{invoice}' => $invoiceNbr)));

                    // Validate invoice currency
                    if (!trim($data[self::CURRENCY_COL]))
                        throw new CException(yii::t('app', '[{row},{col}][{invoice}] Invoice currency cannot be null', array('{row}' => $row,
                                    '{col}' => self::CURRENCY_COL, '{invoice}' => $invoiceNbr)));

                    // Validate currency exchange rate
                    if (trim($data[self::CURRENCY_COL]) != 'MXP')
                        if (!trim($data[self::CURRENCY_RATE_COL]))
                            throw new CException(yii::t('app', '[{row},{col}][{invoice}] Invoice currency exchange rate cannot be null', array('{row}' => $row,
                                        '{col}' => self::CURRENCY_RATE_COL, '{invoice}' => $invoiceNbr)));

                    // Validate promised date
                    $promisedDate = new DateTime(trim($data[self::PROMISED_DATE_COL]));
                    if (!$promisedDate)
                        throw new CException(yii::t('app', '[{row},{col}][{invoice}] Promised date format is invalid: "{promisedDt}"', array('{row}' => $row,
                                    '{col}' => self::PROMISED_DATE_COL, '{promisedDt}' => trim($data[self::PROMISED_DATE_COL]), '{invoice}' => $invoiceNbr)));

                    // Validate transaction order date
                    $transactionOrderDt = new DateTime(trim($data[self::TRANSACTION_ORDER_DATE_COL]));
                    if (!$transactionOrderDt)
                        throw new CException(yii::t('app', '[{row},{col}][{invoice}] Transaction order date format is invalid: "{transactionOrderDt}"', array('{row}' => $row,
                                    '{col}' => self::TRANSACTION_ORDER_DATE_COL, '{transactionOrderDt}' => trim($data[self::TRANSACTION_ORDER_DATE_COL]), '{invoice}' => $invoiceNbr)));


                    // New Invoice
                    $invoice = $root->appendChild($nativeXml->createElement('Comprobante'));
                    $version = SystemConfig::getValue(SystemConfig::CURRENT_CFD_VERSION);

                    $invoice->setAttribute('version', $version);
                    $invoice->setAttribute('invoice', $invoiceNbr);
                    $invoice->setAttribute('serie', substr($invoiceNbr, 0, 1));
                    $invoice->setAttribute('folio', substr($invoiceNbr, 1));
                    $invoice->setAttribute('fecha', $invoiceDttm->format("Y-m-d\TH:i:s"));
                    if (trim($data[self::INVOICE_PAYMENT_TYPE]) == 'PAGO EN UNA SOLA EHXIBICION') {
                        $invoice->setAttribute('formaDePago', self::DEFAULT_PAYMENT_TYPE);
                    } else {
                        $invoice->setAttribute('formaDePago', trim($data[self::INVOICE_PAYMENT_TYPE]));
                    }
                    $invoice->setAttribute('condicionesDePago', trim($data[self::INVOICE_PAYMENT_TERM]));
                    $invoice->setAttribute('Moneda', trim($data[self::CURRENCY_COL]));
                    if (trim($data[self::CURRENCY_COL]) != 'MXP')
                        $invoice->setAttribute('TipoCambio', trim($data[self::CURRENCY_RATE_COL]));
                    $invoice->setAttribute('tipoDeComprobante', strtolower(trim($data[self::INVOICE_DOC_TYPE])));
                    $invoice->setAttribute('metodoDePago', self::DEFAULT_PAYMENT_METHOD);

                    if ($paymentTermRec->days != 0)
                        $invoiceDttm->add(new DateInterval('P' . $paymentTermRec->days . 'D'));
                    $invoice->setAttribute('dueDt', $invoiceDttm->format('Y-m-d'));
                    $invoice->setAttribute('promisedDt', $promisedDate->format("Y-m-d"));
                    $invoice->setAttribute('orderNbr', trim($data[self::BP_ORDER_NBR_COL]));
                    if ($customerOrderNbr) $invoice->setAttribute('customerOrderNbr', $customerOrderNbr);
                    $invoice->setAttribute('emailAddress', trim($data[self::EMAIL_ADDRESS_COL]));
                    $invoice->setAttribute('agent', trim($data[self::AGENT_COL]));
                    $invoice->setAttribute('transport', trim($data[self::TRANSPORT_COL]));
                    $invoice->setAttribute('transactionOrderDt', $transactionOrderDt->format("Y-m-d"));

//
//                    // Find current certificate
//                    $certificate = SatCertificate::model()->current()->find('rfc = :rfc', array(':rfc' => $vendorRfc));
//                    if (!$certificate)
//                        throw new CException(yii::t('app', 'Valid certificate for RFC "{rfc}" cannot be found.', array('{rfc}' => $vendorRfc)));
//                    $invoice->setAttribute('noCertificado', $certificate->nbr);
//                    $invoice->setAttribute('certificado', $certificate->pem);
//
//
//
                    // PROCESS VENDOR
                    $vendor = $invoice->appendChild($nativeXml->createElement('Emisor'));

                    $vendor->setAttribute('rfc', $vendorRfc);
                    $vendor->setAttribute('nombre', trim($data[self::OWNER_NAME_COL]));
                    // PROCESS VENDOR FISCAL ADDRESS
                    if (!trim($data[self::OWNER_ADDRESS_STREET_COL]))
                        throw new CException(yii::t('app', '[{row},{col}][{invoice}] Vendor primary address street cannot be null.', array('{row}' => $row,
                                    '{col}' => self::OWNER_ADDRESS_STREET_COL, '{invoice}' => $invoiceNbr)));
                    if (!trim($data[self::OWNER_ADDRESS_NEIGHBOURHOOD_COL]))
                        throw new CException(yii::t('app', '[{row},{col}][{invoice}] Vendor primary address municipality cannot be null.', array('{row}' => $row,
                                    '{col}' => self::OWNER_ADDRESS_NEIGHBOURHOOD_COL, '{invoice}' => $invoiceNbr)));
                    if (!trim($data[self::OWNER_ADDRESS_ZIPCODE_COL]))
                        throw new CException(yii::t('app', '[{row},{col}][{invoice}] Vendor primary address zip code cannot be null.', array('{row}' => $row,
                                    '{col}' => self::OWNER_ADDRESS_ZIPCODE_COL, '{invoice}' => $invoiceNbr)));
                    if (!trim($data[self::OWNER_ADDRESS_COUNTRY_COL]))
                        throw new CException(yii::t('app', '[{row},{col}][{invoice}] Vendor primary address country cannot be null.', array('{row}' => $row,
                                    '{col}' => self::OWNER_ADDRESS_COUNTRY_COL, '{invoice}' => $invoiceNbr)));
                    if (!trim($data[self::OWNER_ADDRESS_STATE_COL]))
                        throw new CException(yii::t('app', '[{row},{col}][{invoice}] Vendor primary address state cannot be null.', array('{row}' => $row,
                                    '{col}' => self::OWNER_ADDRESS_STATE_COL, '{invoice}' => $invoiceNbr)));

                    $vendorFiscalAddressNode = $vendor->appendChild($nativeXml->createElement('DomicilioFiscal'));
                    $vendorFiscalAddressNode->setAttribute('calle', $data[self::OWNER_ADDRESS_STREET_COL]);
                    if ($data[self::OWNER_ADDRESS_EXTNUM_COL]) $vendorFiscalAddressNode->setAttribute('noExterior', $data[self::OWNER_ADDRESS_EXTNUM_COL]);
                    if ($data[self::OWNER_ADDRESS_INTNUM_COL]) $vendorFiscalAddressNode->setAttribute('noInterior', $data[self::OWNER_ADDRESS_INTNUM_COL]);
                    $vendorFiscalAddressNode->setAttribute('colonia', $data[self::OWNER_ADDRESS_NEIGHBOURHOOD_COL]);
                    if ($data[self::OWNER_ADDRESS_CITY_COL]) $vendorFiscalAddressNode->setAttribute('municipio', $data[self::OWNER_ADDRESS_CITY_COL]);
                    $vendorFiscalAddressNode->setAttribute('codigoPostal', $data[self::OWNER_ADDRESS_ZIPCODE_COL]);
                    $vendorFiscalAddressNode->setAttribute('estado', $data[self::OWNER_ADDRESS_STATE_COL]);
                    $vendorFiscalAddressNode->setAttribute('pais', $data[self::OWNER_ADDRESS_COUNTRY_COL]);

                    // PROCESS VENDOR ISSUING ADDRESS
                    $invoicedFromName = $data[self::INVOICE_FROM_NAME_COL];
                    if ($invoicedFromName) {
                        // Check vendor invoicing from address
                        if (!trim($data[self::INVOICE_FROM_ADDRESS_COUNTRY_COL]))
                            throw new CException(yii::t('app', '[{row},{col}][{invoice}] Vendor invoicing address country cannot be null.', array('{row}' => $row, '{col}' => self::INVOICE_FROM_ADDRESS_COUNTRY_COL, '{invoice}' => $invoiceNbr
                                    )));
                        $vendorIssuingAddressNode = $vendor->appendChild($nativeXml->createElement('ExpedidoEn'));
                        $vendorIssuingAddressNode->setAttribute('name', $invoicedFromName);
                        if (trim($data[self::INVOICE_FROM_ADDRESS_STREET_COL]))
                            $vendorIssuingAddressNode->setAttribute('calle', $data[self::INVOICE_FROM_ADDRESS_STREET_COL]);
                        if (trim($data[self::INVOICE_FROM_ADDRESS_EXTNUM_COL]))
                            $vendorIssuingAddressNode->setAttribute('noExterior', $data[self::INVOICE_FROM_ADDRESS_EXTNUM_COL]);
                        if ($data[self::INVOICE_FROM_ADDRESS_INTNUM_COL])
                            $vendorIssuingAddressNode->setAttribute('municipio', $data[self::INVOICE_FROM_ADDRESS_INTNUM_COL]);
                        if ($data[self::INVOICE_FROM_ADDRESS_NEIGHBOURHOOD_COL])
                            $vendorIssuingAddressNode->setAttribute('colonia', $data[self::INVOICE_FROM_ADDRESS_NEIGHBOURHOOD_COL]);
                        if ($data[self::INVOICE_FROM_ADDRESS_CITY_COL])
                            $vendorIssuingAddressNode->setAttribute('localidad', $data[self::INVOICE_FROM_ADDRESS_CITY_COL]);
                        if ($data[self::INVOICE_FROM_ADDRESS_ZIPCODE_COL])
                            $vendorIssuingAddressNode->setAttribute('codigoPostal', $data[self::INVOICE_FROM_ADDRESS_ZIPCODE_COL]);
                        if ($data[self::INVOICE_FROM_ADDRESS_STATE_COL])
                            $vendorIssuingAddressNode->setAttribute('estado', $data[self::INVOICE_FROM_ADDRESS_STATE_COL]);
                        $vendorIssuingAddressNode->setAttribute('pais', $data[self::INVOICE_FROM_ADDRESS_COUNTRY_COL]);
                    }
                    $fiscalRegimeNode = $vendor->appendChild($nativeXml->createElement('RegimenFiscal'));
                    $fiscalRegimeNode->setAttribute('Regimen', self::DEFAULT_FISCAL_REGIME);

                    // PROCESS CUSTOMER
                    $customer = $invoice->appendChild($nativeXml->createElement('Receptor'));
                    $customer->setAttribute('rfc', $customerRfc);
                    $customer->setAttribute('nombre', $customerName);
                    $customer->setAttribute('customerCode', trim($data[self::BP_CUSTOMER_CODE_COL]));
                    if ($data[self::EMAIL_ADDRESS_COL]) $customer->setAttribute('eMail', $data[self::EMAIL_ADDRESS_COL]);

                    // PROCESS CUSTOMER BILL TO ADDRESS
                    $customerBillToAddressNode = $customer->appendChild($nativeXml->createElement('Domicilio'));
                    if ($data[self::CUSTOMER_SOLD_TO_ADDRESS_STREET_COL])
                        $customerBillToAddressNode->setAttribute('calle', $data[self::CUSTOMER_SOLD_TO_ADDRESS_STREET_COL]);
                    if ($data[self::CUSTOMER_SOLD_TO_ADDRESS_EXTNUM_COL])
                        $customerBillToAddressNode->setAttribute('noExterior', $data[self::CUSTOMER_SOLD_TO_ADDRESS_EXTNUM_COL]);
                    if ($data[self::CUSTOMER_SOLD_TO_ADDRESS_INTNUM_COL] != $data[self::CUSTOMER_SOLD_TO_ADDRESS_NEIGHBOURHOOD_COL]) {
                        if ($data[self::CUSTOMER_SOLD_TO_ADDRESS_INTNUM_COL])
                            $customerBillToAddressNode->setAttribute('noInterior', $data[self::CUSTOMER_SOLD_TO_ADDRESS_INTNUM_COL]);
                    }
                    if ($data[self::CUSTOMER_SOLD_TO_ADDRESS_NEIGHBOURHOOD_COL])
                        $customerBillToAddressNode->setAttribute('colonia', $data[self::CUSTOMER_SOLD_TO_ADDRESS_NEIGHBOURHOOD_COL]);
                    if ($data[self::CUSTOMER_SOLD_TO_ADDRESS_CITY_COL])
                        $customerBillToAddressNode->setAttribute('localidad', $data[self::CUSTOMER_SOLD_TO_ADDRESS_CITY_COL]);
                    if ($data[self::CUSTOMER_SOLD_TO_ADDRESS_ZIPCODE_COL]) {
                        if ($data[self::CUSTOMER_SOLD_TO_ADDRESS_COUNTRY_COL] == 'MX')
                            $customerBillToAddressNode->setAttribute('codigoPostal', substr('00000' . $data[self::CUSTOMER_SOLD_TO_ADDRESS_ZIPCODE_COL], -5));
                        else
                            $customerBillToAddressNode->setAttribute('codigoPostal', $data[self::CUSTOMER_SOLD_TO_ADDRESS_ZIPCODE_COL]);
                    }
                    if ($data[self::CUSTOMER_SOLD_TO_ADDRESS_STATE_COL])
                        $customerBillToAddressNode->setAttribute('estado', $data[self::CUSTOMER_SOLD_TO_ADDRESS_STATE_COL]);
                    // Check customer billing address
                    if (!$data[self::CUSTOMER_SOLD_TO_ADDRESS_COUNTRY_COL])
                        throw new CException(yii::t('app', '[{row},{col}][{invoice}] Customer billing country address cannot be null.', array('{row}' => $row, '{col}' => self::CUSTOMER_SOLD_TO_ADDRESS_COUNTRY_COL, '{invoice}' => $invoiceNbr
                                )));
                    else
                        $customerBillToAddressNode->setAttribute('pais', $data[self::CUSTOMER_SOLD_TO_ADDRESS_COUNTRY_COL]);

                    // PROCESS CUSTOMER SHIP TO ADDRESS
                    if (trim($data[self::CUSTOMER_SHIP_TO_NAME_COL])) {
                        $customerShipToAddressNode = $customer->appendChild($nativeXml->createElement('DomicilioDeEnvio'));
                        $customerShipToAddressNode->setAttribute('name', $data[self::CUSTOMER_SHIP_TO_NAME_COL]);
                        if ($data[self::CUSTOMER_SHIP_TO_ADDRESS_STREET_COL])
                            $customerShipToAddressNode->setAttribute('calle', $data[self::CUSTOMER_SHIP_TO_ADDRESS_STREET_COL]);
                        if ($data[self::CUSTOMER_SHIP_TO_ADDRESS_EXTNUM_COL])
                            $customerShipToAddressNode->setAttribute('noExterior', $data[self::CUSTOMER_SHIP_TO_ADDRESS_EXTNUM_COL]);
                        if ($data[self::CUSTOMER_SHIP_TO_ADDRESS_INTNUM_COL] != $data[self::CUSTOMER_SHIP_TO_ADDRESS_NEIGHBOURHOOD_COL]) {
                            if ($data[self::CUSTOMER_SHIP_TO_ADDRESS_INTNUM_COL])
                                $customerShipToAddressNode->setAttribute('noInterior', $data[self::CUSTOMER_SHIP_TO_ADDRESS_INTNUM_COL]);
                        }
                        if ($data[self::CUSTOMER_SHIP_TO_ADDRESS_NEIGHBOURHOOD_COL])
                            $customerShipToAddressNode->setAttribute('colonia', $data[self::CUSTOMER_SHIP_TO_ADDRESS_NEIGHBOURHOOD_COL]);
                        if ($data[self::CUSTOMER_SHIP_TO_ADDRESS_CITY_COL])
                            $customerShipToAddressNode->setAttribute('localidad', $data[self::CUSTOMER_SHIP_TO_ADDRESS_CITY_COL]);
                        if ($data[self::CUSTOMER_SHIP_TO_ADDRESS_ZIPCODE_COL])
                            $customerShipToAddressNode->setAttribute('codigoPostal', $data[self::CUSTOMER_SHIP_TO_ADDRESS_ZIPCODE_COL]);
                        if ($data[self::CUSTOMER_SHIP_TO_ADDRESS_STATE_COL])
                            $customerShipToAddressNode->setAttribute('estado', $data[self::CUSTOMER_SHIP_TO_ADDRESS_STATE_COL]);
                        if ($data[self::CUSTOMER_SHIP_TO_ADDRESS_COUNTRY_COL])
                            $customerShipToAddressNode->setAttribute('pais', $data[self::CUSTOMER_SHIP_TO_ADDRESS_COUNTRY_COL]);
                    }
                    $items = $invoice->appendChild($nativeXml->createElement('Conceptos'));
                    $notes = $invoice->appendChild($nativeXml->createElement('Notas'));
                    $impuestos = $invoice->appendChild($nativeXml->createElement('Impuestos'));
                    $traslados = $impuestos->appendChild($nativeXml->createElement('Traslados'));

                    // Check for addenda
                    // If Customer RFC is one that requires addenda, find if an addenda was loaded.
                    if (trim($data[self::INVOICE_DOC_TYPE]) == 'INGRESO') {
                        switch ($customerRfc) {
                            case 'PEP9207167XA':
                            case 'PRE9207163T7':
                                // Check if it has a PO nbr
                                if ($customerOrderNbr) {
                                    // Has a PO. Find the PO in Pemex Addendas.
                                    $pemexPreInvoice = PemexPreInvoice::model()->find('poNbr = :poNbr', array(':poNbr' => $customerOrderNbr));
                                    if (!$pemexPreInvoice) {
                                        throw new CException(yii::t('app', '[{row},{col}][{invoice}] Pemex PreInvoice for Customer Order Nº "{customerOrder}" not found.', array('{row}' => $row, '{col}' => self::CUSTOMER_ORDER_NBR_COL,
                                                    '{customerOrder}' => $customerOrderNbr, '{invoice}' => $invoiceNbr)));
                                    } else {
                                        // Create item from Pemex preinvoice
                                        foreach ($pemexPreInvoice->pemexPreInvoiceItems as $pemexItem) {
                                            $item = $items->appendChild($nativeXml->createElement('Concepto'));
                                            $item->setAttribute('cantidad', $pemexItem->qty);
                                            $item->setAttribute('unidad', $pemexItem->uom);
                                            $item->setAttribute('descripcion', $pemexItem->description);
                                            $item->setAttribute('noIdentificacion', $data[self::PRODUCT_CODE_COL]);
                                            $item->setAttribute('valorUnitario', $pemexItem->unitPrice);
                                            $item->setAttribute('lts', (float) $data[self::QUANTITY_IN_LT_COL]);
                                        }
                                        $isPemexInvoiceWithPreInvoice = true;
                                    }
                                }
                                break;
                        }
                    }

//                    $discounts = array();
//                    $discount = 0;
//                    $subTotal = 0;
                }
                if ($invoice) {
                    // ITEMS
                    if (trim($data[self::INVOICE_DOC_TYPE])) {
                        if (!$isPemexInvoiceWithPreInvoice) {
                            $qty = trim($data[self::ITEM_QTY]);
                            if (!$qty)
                                throw new CException(yii::t('app', '[{row},{col}] Item quantity cannot be null', array('{row}' => $row,
                                            '{col}' => self::ITEM_QTY)));

                            $description = $data[self::PRODUCT_DESCRIPTION_COL_1] . " " . $data[self::PRODUCT_DESCRIPTION_COL_2];
                            if (!$description)
                                throw new CException(yii::t('app', '[{row},{col}] Item description cannot be null', array('{row}' => $row,
                                            '{col}' => self::PRODUCT_DESCRIPTION_COL_1)));

                            $item = $items->appendChild($nativeXml->createElement('Concepto'));
                            $item->setAttribute('cantidad', (float) $qty);
                            if (trim($data[self::PRODUCT_UOM_COL]))
                                $item->setAttribute('unidad', trim($data[self::PRODUCT_UOM_COL]));
                            else
                                $item->setAttribute('unidad', 'EA');

                            $item->setAttribute('descripcion', $description);

                            if (trim($data[self::PRODUCT_CODE_COL]))
                                $item->setAttribute('noIdentificacion', trim($data[self::PRODUCT_CODE_COL]));

                            if (trim($data[self::CURRENCY_COL]) == "MXP") {
                                if (!trim($data[self::ITEM_UNIT_PRICE]))
                                    throw new CException(yii::t('app', '[{row},{col}] Item unit price cannot be null', array('{row}' => $row,
                                                '{col}' => self::ITEM_UNIT_PRICE)));
                                $unitPrice = (float) trim($data[self::ITEM_UNIT_PRICE]);
                            } else {
                                if (!trim($data[self::FOREIGN_UNIT_PRICE_COL]))
                                    throw new CException(yii::t('app', '[{row},{col}] Item unit price cannot be null', array('{row}' => $row,
                                                '{col}' => self::FOREIGN_UNIT_PRICE_COL)));
                                $unitPrice = (float) trim($data[self::FOREIGN_UNIT_PRICE_COL]);
                            }
                            $item->setAttribute('valorUnitario', $unitPrice);
                            $totalPrice = (float) trim($data[self::ITEM_QTY]) * $unitPrice;
                            $subTotal += $totalPrice;

    //                        $item->setAttribute('importe', $totalPrice);
                            $item->setAttribute('lts', (float) trim($data[self::QUANTITY_IN_LT_COL]));
                            // Process customs permit
                            if ($data[self::CUSTOMS_DOCUMENT_NUMBER_COL]) {
                                // Find customs permit in DB
                                $custPermit = CustomsPermit::model()->find('nbr = :nbr', array(':nbr' => trim($data[self::CUSTOMS_DOCUMENT_NUMBER_COL])));
                                if (!$custPermit) {
                                    $custPermit = new CustomsPermit();
                                    $custPermit->nbr = trim($data[self::CUSTOMS_DOCUMENT_NUMBER_COL]);
                                    if (!trim($data[self::CUSTOMS_DOCUMENT_DATE_COL]))
                                        throw new CException(yii::t('app', '[{row},{col}] Date for customs permit Nº "{nbr}" cannot be null.', array('{row}' => $row,
                                                    '{col}' => self::CUSTOMS_DOCUMENT_DATE_COL,
                                                    '{nbr}' => $custPermit->nbr)));
                                    $customsDt = DateTime::createFromFormat("Y/m/d", trim($data[self::CUSTOMS_DOCUMENT_DATE_COL]));
                                    if (!$customsDt)
                                        throw new CException(yii::t('app', '[{row},{col}] Invalid date "{date}" for customs permit Nº "{nbr}".', array('{row}' => $row,
                                                    '{col}' => self::CUSTOMS_DOCUMENT_DATE_COL, '{date}' => trim($data[self::CUSTOMS_DOCUMENT_DATE_COL]),
                                                    '{nbr}' => $custPermit->nbr)));
                                    else
                                        $custPermit->dt = $customsDt->format("Y-m-d");
                                    if (trim($data[self::CUSTOMS_NAME_COL]))
                                        $custPermit->office = trim($data[self::CUSTOMS_NAME_COL]);
                                    $custPermit->save();
                                }
                                $customsPermit = $item->appendChild($nativeXml->createElement('InformacionAduanera'));
                                $customsPermit->setAttribute('numero', $custPermit->nbr);
                                $customsPermit->setAttribute('fecha', $custPermit->dt);
                                $customsPermit->setAttribute('aduana', $custPermit->office);
                            }
                        }

                        $lineDiscount = 0;
                        if ($data[self::DISCOUNT_REASON]) {
                            if (!isset($discounts[$data[self::DISCOUNT_REASON]]))
                                $discounts[$data[self::DISCOUNT_REASON]] = 0;
                            if ($data[self::CURRENCY_COL] == 'MXP') {
                                $lineDiscount += (float) $data[self::DISCOUNT_AMOUNT];
                                $discounts[$data[self::DISCOUNT_REASON]] += (float) $data[self::DISCOUNT_AMOUNT];
                            } else {
                                $lineDiscount += (float) $data[self::FOREIGN_DISCOUNT];
                                $discounts[$data[self::DISCOUNT_REASON]] += (float) $data[self::FOREIGN_DISCOUNT];
                            }
                        }
                        if ($data[self::DISCOUNT_REASON_2]) {
                            if (!isset($discounts[$data[self::DISCOUNT_REASON_2]]))
                                $discounts[$data[self::DISCOUNT_REASON_2]] = 0;
                            if ($data[self::CURRENCY_COL] == 'MXP') {
                                $lineDiscount += (float) $data[self::DISCOUNT_AMOUNT_2];
                                $discounts[$data[self::DISCOUNT_REASON_2]] += (float) $data[self::DISCOUNT_AMOUNT_2];
                            } else {
                                $lineDiscount += (float) $data[self::FOREIGN_DISCOUNT_2];
                                $discounts[$data[self::DISCOUNT_REASON_2]] += (float) $data[self::FOREIGN_DISCOUNT_2];
                            }
                        }
                        if ($data[self::DISCOUNT_REASON_3]) {
                            if (!isset($discounts[$data[self::DISCOUNT_REASON_3]]))
                                $discounts[$data[self::DISCOUNT_REASON_3]] = 0;
                            if ($data[self::CURRENCY_COL] == 'MXP') {
                                $lineDiscount += (float) $data[self::DISCOUNT_AMOUNT_3];
                                $discounts[$data[self::DISCOUNT_REASON_3]] += (float) $data[self::DISCOUNT_AMOUNT_3];
                            } else {
                                $lineDiscount += (float) $data[self::FOREIGN_DISCOUNT_3];
                                $discounts[$data[self::DISCOUNT_REASON_3]] += (float) $data[self::FOREIGN_DISCOUNT_3];
                            }
                        }
                        if ($data[self::DISCOUNT_REASON_4]) {
                            if (!isset($discounts[$data[self::DISCOUNT_REASON_4]]))
                                $discounts[$data[self::DISCOUNT_REASON_4]] = 0;
                            if ($data[self::CURRENCY_COL] == 'MXP') {
                                $lineDiscount += (float) $data[self::DISCOUNT_AMOUNT_4];
                                $discounts[$data[self::DISCOUNT_REASON_4]] += (float) $data[self::DISCOUNT_AMOUNT_4];
                            } else {
                                $lineDiscount += (float) $data[self::FOREIGN_DISCOUNT_4];
                                $discounts[$data[self::DISCOUNT_REASON_4]] += (float) $data[self::FOREIGN_DISCOUNT_4];
                            }
                        }
//
//                        $discount += $lineDiscount;
//
                        // Check tax type
                        if (!trim($data[self::TAX_TYPE]))
                            throw new CException(yii::t('app', '[{row},{col}] Item tax type cannot be null', array('{row}' => $row,
                                        '{col}' => self::TAX_TYPE)));
                        // Check tax rate
                        if (!trim($data[self::TAX_RATE]))
                            throw new CException(yii::t('app', '[{row},{col}] Item tax rate cannot be null', array('{row}' => $row,
                                        '{col}' => self::TAX_RATE)));

                        $taxAmt = ($totalPrice - $lineDiscount) * (float) trim($data[self::TAX_RATE]);
                        if (!isset($taxes[$data[self::TAX_TYPE]]) || !isset($taxes[$data[self::TAX_TYPE]][$data[self::TAX_RATE]]))
                            $taxes[$data[self::TAX_TYPE]][$data[self::TAX_RATE]] = 0;

                        $taxes[$data[self::TAX_TYPE]][$data[self::TAX_RATE]] += $taxAmt;
                    } else {
                        $note = $notes->appendChild($nativeXml->createElement('Nota'));
                        $note->setAttribute('nota', $data[self::PRODUCT_DESCRIPTION_COL_1] . " " . $data[self::PRODUCT_DESCRIPTION_COL_2]);
                    }
                }
            }
            // Save native XML
            $nativeXml->save($nativeXmlFile);

            $model->processDttm = new CDbExpression('NOW()');
            $model->IncomingInvoiceInterfaceFileStatus_id = IncomingInvoiceInterfaceFileStatus::model()->find('code = :code', array(':code' => IncomingInvoiceInterfaceFileStatus::PROCESSED))->id;
            $model->save();

            yii::app()->end();
        } catch (Exception $e) {
            $this->log($e->getMessage(), CLogger::LEVEL_ERROR, self::LOG_CATEGORY);
            $model->processDttm = new CDbExpression('NOW()');
            $model->IncomingInvoiceInterfaceFileStatus_id = IncomingInvoiceInterfaceFileStatus::model()->find('code = :code', array(':code' => IncomingInvoiceInterfaceFileStatus::ERROR))->id;
            $model->save();
            @unlink($nativeXmlFile);
//            $this->log('[ERROR] ' . $e->getMessage());
//            $this->log('[ERROR] ' . $e->getMessage(), $this->logFile);
//            // Create error file
//            error_log('[' . date(DateTime::ISO8601) . '] ' . $e->getMessage() . PHP_EOL, 3, $this->fileError);
        }
    }

    private function testVendor($data) {
        // Vendor validations

        // Test RFC
        $vendorRfc = $data[self::OWNER_RFC_COL];
        if (!$vendorRfc)
            throw new CException(yii::t('app', 'Vendor RFC cannot be null'));

        try {
            SatRfc::validate($vendorRfc);
        } catch (CException $e) {
            throw new CException(yii::t('app', 'Invalid vendor RFC "{rfc}".', array('{rfc}' => $vendorRfc)));
        }

        $vendorName = $data[self::OWNER_NAME_COL];
        if (!$vendorName)
            throw new CException(yii::t('app', 'Vendor name cannot be null'));

        // Vendor data is correct.
        // Find if vendor exists in DB.
        $vendorRfc = PartyIdentifier::model()->find('code = :code and value = :value', array(':code' => 'RFC', ':value' => $vendorRfc));
    }
}

?>
