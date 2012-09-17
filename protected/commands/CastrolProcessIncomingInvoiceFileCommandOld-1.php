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

    private $fileName;  // The file name to be processed
    private $pathInfo;  // The filen name pathInfo
    private $fileLog;   // The log file name ($this->fileName.log)

    private $customerRec; // Object holding vendor record.
    private $customerBillToAddress; // Object holding customer bill to address
    private $customerShipToAddress; // Object holding customer ship to address

    private $vendorRec; // Object holding vendor record.
    private $vendorFiscalAddress; // Object holding vendor fiscal address
    private $vendorIssuingAddress; // Object holding vendor issuing address

    private $invoice = false; // Object holding current processing invoice

    const LOG_CATEGORY = 'IncomingInvoiceInterfaceFileProcessor';

    const DEFAULT_PAYMENT_TYPE = 'PAGO EN UNA SOLA EXHIBICION';
    const DEFAULT_PAYMENT_METHOD = 'NO IDENTIFICADO';
    const DEFAULT_CURRENCY_CODE = 'MXN';
    const DEFAULT_EXCHANGE_RATE = 1;
    const DEFAULT_FISCAL_REGIME = 'Régimen General de Ley Personas Morales';

    /**
     * Processes a file with CASTROL format.
     * @param array $args arguments for the process.
     * The first parameter is the invoice file with path.
     * @return string the translated message
     */
    private function log($msg, $level = CLogger::LEVEL_INFO, $category = self::LOG_CATEGORY) {
        yii::log($msg, $level, $category);
        error_log(date(DateTime::ISO8601) . ' - ' . '[' . $level . '] ' . $msg . PHP_EOL, 3, "$this->fileLog");
        echo date(DateTime::ISO8601) . ' - ' . '[' . $level . '] ' . $msg . PHP_EOL;
    }

    public function run($args) {
        // - LOCK FILE
        // - When file is locked, try to open it.
        // - Castrol file is a CSV file.
        // - Produce a native XML and save it to NATIVE_XML_PATH

        $this->fileName = $args[0];
        $this->pathInfo = pathinfo($this->fileName);

        $this->fileLog = SystemConfig::getLogPath() . DIRECTORY_SEPARATOR . $this->pathInfo['filename'] . '.log';
        @unlink($this->fileLog);

        // Try to lock file to ensure is not still be written.
        $fp = fopen($this->fileName, 'r');
        while (!flock($fp, LOCK_EX)) {
            $this->log(yii::t('app', 'Waiting to lock file {file}', array('{file}' => $this->fileName)), CLogger::LEVEL_INFO);
        }
        flock($fp, LOCK_UN);

        $this->log(yii::t('app', 'Processing file {file}', array('{file}' => $this->fileName)), CLogger::LEVEL_INFO);

        try {
            // Check if it exists in IncomingInvoiceInterfaceFile
            $fileRec = IncomingInvoiceInterfaceFile::model()->find('fileName = :name', array(':name' => $this->pathInfo['basename']));
            // If the file name was not found
            if (!$fileRec) {
                // Create new file in model
                $fileRec = new IncomingInvoiceInterfaceFile();
                $fileRec->fileName = $this->pathInfo['basename'];
            }
            $fileRec->receptionDttm = new CDbExpression('NOW()');
            $fileRec->processDttm = null;
            $fileRec->note = null;
            $fileRec->IncomingInvoiceInterfaceFileStatus_id = IncomingInvoiceInterfaceFileStatus::model()->find('code = :code', array(':code' => IncomingInvoiceInterfaceFileStatus::PROCESSING))->id;
            $fileRec->save();

            // Open file
            $fHandle = fopen($this->fileName, "r");
            if (!$fHandle)
                throw new CException(yii::t('app', 'Cannot open file "{file}".', array('{file}' => $this->fileName)));

            // Setup
            $invoiceNbr = "XXX";

            // Create Native XML file
            $nativeXml = new DOMDocument("1.0", "UTF-8");
            $root = $nativeXml->createElement('Comprobantes');
            $root = $nativeXml->appendChild($root);

            $discount = 0;
            $subTotal = 0;
            $discounts = array();
            $row = 0;
            $isPemexInvoiceWithPreInvoice = false;
            $vendorRec = false;
            $noteCount = 1;

            while (($data = fgetcsv($fHandle, 0, '|')) !== FALSE) {
                $row++;
                $colCount = count($data);
                if ($colCount <= 1)
                    continue;
                if ($colCount != self::COL_COUNT)
                    throw new CException(yii::t('app', 'Row {row} has {colCount} columns and must have {col_count}.', array('{row}' => $row, '{colCount}' => $colCount, '{col_count}' => self::COL_COUNT)));

                // Normalize UTF8
                for ($i = 0; $i < count($data); $i++) {
                    $data[$i] = trim(mb_convert_encoding($data[$i], 'utf8'));
                }
                // Test if invoice nbr is null
                if (!$data[self::INVOICE_NUMBER_COL])
                    throw new CException(yii::t('app', '[{row},{col}] Invoice number cannot be null', array('{row}' => $row,
                                '{col}' => self::INVOICE_NUMBER_COL)));

                // Test if it's a new invoice
                if ($invoiceNbr != $data[self::INVOICE_NUMBER_COL]) {
                    $invoiceNbr = $data[self::INVOICE_NUMBER_COL];
                    // Test if there's an invoice being processed
                    if ($this->invoice) $this->saveInvoice();

                    $this->invoice = new Cfd();
                    $isPemexInvoiceWithPreInvoice = false;
                    $this->invoice->invoice = $data[self::INVOICE_NUMBER_COL];
                    // InvoiceNbr validations
                    $this->log(yii::t('app', 'Processing invoice {invoice}', array('{invoice}' => $this->invoice->invoice)), CLogger::LEVEL_INFO, self::LOG_CATEGORY);
                    // Get invoice serie and folio
                    $this->invoice->serial = substr($this->invoice->invoice, 0, 1);
                    $this->invoice->folio = substr($this->invoice->invoice, 1);

                    // Test and/or create vendor
                    $this->invoice->vendor = $this->testVendor($data);
                    $this->invoice->addresses[AddressType::PRIMARY] = $this->testAddress($data, AddressType::PRIMARY, $this->vendorFiscalAddress);
                    if ($this->vendorFiscalAddress->state0)
                        $this->invoice->expeditionPlace = $this->vendorFiscalAddress->state0->name;
                    else
                        $this->invoice->expeditionPlace = $this->vendorFiscalAddress->state;
                    if ($this->vendorFiscalAddress->country0)
                        $this->invoice->expeditionPlace .= ', ' . $this->vendorFiscalAddress->country0->name;
                    else
                        $this->invoice->expeditionPlace .= ', ' . $this->vendorFiscalAddress->country;

                    if ($data[self::INVOICE_FROM_NAME_COL]) {
                        $this->invoice->addresses[AddressType::ISSUING] = $this->testAddress($data, AddressType::ISSUING, $this->vendorIssuingAddress);
                        if ($this->vendorIssuingAddress->state0)
                            $this->invoice->expeditionPlace = $this->vendorIssuingAddress->state0->name;
                        else
                            $this->invoice->expeditionPlace = $this->vendorIssuingAddress->state;
                        if ($this->vendorIssuingAddress->country0)
                            $this->invoice->expeditionPlace .= ', ' . $this->vendorIssuingAddress->country0->name;
                        else
                            $this->invoice->expeditionPlace .= ', ' . $this->vendorIssuingAddress->country;
                    }

                    // Test and/or create customer
                    $this->invoice->customer = $this->testCustomer($data);
                    $this->invoice->addresses[AddressType::BILL_TO] = $this->testAddress($data, AddressType::BILL_TO, $this->customerBillToAddress);
                    if ($data[self::CUSTOMER_SHIP_TO_NAME_COL])
                        $this->invoice->addresses[AddressType::SHIP_TO] = $this->testAddress($data, AddressType::SHIP_TO, $this->customerShipToAddress);

                    $invoiceType = $data[self::INVOICE_DOC_TYPE];
                    // Check Invoice Type
                    if (!$invoiceType)
                        throw new CException(yii::t('app', '[{row},{col}][{invoice}] Invoice type cannot be null.', array('{row}' => $row, '{col}' => self::INVOICE_DOC_TYPE, '{invoice}' => $invoiceNbr)));
                    else
                        $this->invoice->voucherType = strtolower ($invoiceType);

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

                    $invoiceDttm = DateTime::createFromFormat("Y-m-d H:i:s", $invoiceDt->format("Y-m-d") . " " . $invoiceTm->format("H:i:s"), new DateTimeZone(SystemConfig::getValue('VENDOR_TIMEZONE')));
                    $invoiceDttm->setTimeZone(new DateTimeZone(SystemConfig::getValue(SystemConfig::SYSTEM_TIMEZONE)));
                    $this->invoice->dttm = $invoiceDttm->format(DateTime::ISO8601);

                    // Payment type
                    if ($data[self::INVOICE_PAYMENT_TYPE] == 'PAGO EN UNA SOLA EHXIBICION') {
                        $this->invoice->paymentType = self::DEFAULT_PAYMENT_TYPE;
                    } else {
                        $this->invoice->paymentType = $data[self::INVOICE_PAYMENT_TYPE];
                    }

                    // Find current certificate
                    $certificate = SatCertificate::model()->current()->find('rfc = :rfc', array(':rfc' => $this->invoice->vendor->rfc));
                    if (!$certificate)
                        throw new CException(yii::t('app', 'Valid certificate for RFC "{rfc}" cannot be found.', array('{rfc}' => $this->invoice->vendor->rfc)));


                    // Validate payment term
                    if ($data[self::INVOICE_PAYMENT_TERM]) {
                        $this->invoice->paymentTerm = $data[self::INVOICE_PAYMENT_TERM];
                        // Check if payment term exists
                        $paymentTermRec = PaymentTerm::model()->find('name = :name', array(':name' => $data[self::INVOICE_PAYMENT_TERM]));
                        if ($paymentTermRec) {
                            $this->invoice->PaymentTerm_id = $paymentTermRec->id;
                            if ($paymentTermRec->days != 0) $invoiceDttm->add(new DateInterval('P' . $paymentTermRec->days . 'D'));
                        }
                    }
                    $this->invoice->chars['DUE_DT'] = $invoiceDttm->format('Y-m-d');

                    // Validate invoice currency
                    if (!$data[self::CURRENCY_COL])
                        throw new CException(yii::t('app', '[{row},{col}][{invoice}] Invoice currency cannot be null', array('{row}' => $row,
                                    '{col}' => self::CURRENCY_COL, '{invoice}' => $invoiceNbr)));
                    else {
                        $this->invoice->currency = $data[self::CURRENCY_COL];
                        // Find currency
                        $currency = Currency::model()->find('code = :code', array(':code' => $data[self::CURRENCY_COL]));
                        if ($currency)
                            $this->invoice->Currency_id = $currency->id;

                        // Validate currency exchange rate
                        if ($data[self::CURRENCY_COL] != 'MXP')
                            if (!$data[self::CURRENCY_RATE_COL])
                                throw new CException(yii::t('app', '[{row},{col}][{invoice}] Invoice currency exchange rate cannot be null', array('{row}' => $row,
                                            '{col}' => self::CURRENCY_RATE_COL, '{invoice}' => $invoiceNbr)));
                            else
                                $this->invoice->exchangeRate = $data[self::CURRENCY_RATE_COL];

                    }

                    $this->invoice->paymentMethod = self::DEFAULT_PAYMENT_METHOD;

                    if (!$data[self::BP_ORDER_NBR_COL])
                        throw new CException(yii::t('app', '[{row},{col}][{invoice}] BP Order Nº cannot be null.', array('{row}' => $row, '{col}' => self::BP_ORDER_NBR_COL, '{invoice}' => $invoiceNbr)));
                    else
                        $this->invoice->chars['BP_ORDER_NBR'] = $data[self::BP_ORDER_NBR_COL];
                    if ($data[self::CUSTOMER_ORDER_NBR_COL]) $this->invoice->chars['CUSTOMER_ORDER_NBR'] = $data[self::CUSTOMER_ORDER_NBR_COL];
                    if ($data[self::EMAIL_ADDRESS_COL]) $this->invoice->chars['EMAIL_ADDRESS'] = $data[self::EMAIL_ADDRESS_COL];
                    if ($data[self::AGENT_COL]) $this->invoice->chars['AGENT'] = $data[self::AGENT_COL];
                    if ($data[self::TRANSPORT_COL]) $this->invoice->chars['TRANSPORT'] = $data[self::TRANSPORT_COL];

                    // Validate promised date
                    if ($data[self::PROMISED_DATE_COL]) {
                        $promisedDate = new DateTime($data[self::PROMISED_DATE_COL]);
                        if (!$promisedDate)
                            throw new CException(yii::t('app', '[{row},{col}][{invoice}] Promised date format is invalid: "{promisedDt}"', array('{row}' => $row,
                                        '{col}' => self::PROMISED_DATE_COL, '{promisedDt}' => trim($data[self::PROMISED_DATE_COL]), '{invoice}' => $invoiceNbr)));
                        else
                            $this->invoice->chars['PROMISED_DT'] = $promisedDate->format('Y-m-d');
                    }
                    // Validate transaction order date
                    if ($data[self::TRANSACTION_ORDER_DATE_COL]) {
                        $transactionOrderDt = new DateTime($data[self::TRANSACTION_ORDER_DATE_COL]);
                        if (!$transactionOrderDt)
                            throw new CException(yii::t('app', '[{row},{col}][{invoice}] Transaction order date format is invalid: "{transactionOrderDt}"', array('{row}' => $row,
                                        '{col}' => self::TRANSACTION_ORDER_DATE_COL, '{transactionOrderDt}' => trim($data[self::TRANSACTION_ORDER_DATE_COL]), '{invoice}' => $invoiceNbr)));
                        else
                            $this->invoice->chars['TRANSACTION_ORDER_DT'] = $transactionOrderDt->format('Y-m-d');
                    }
                    $this->invoice->taxRegimes[] = self::DEFAULT_FISCAL_REGIME;

                    // Check for addenda
                    // If Customer RFC is one that requires addenda, find if an addenda was loaded.
                    if ($this->invoice->voucherType == 'ingreso') {
                        switch ($this->invoice->customer->rfc) {
                            // PEMEX
                            case 'PEP9207167XA':
                            case 'PRE9207163T7':
                                // Check if it has a PO nbr
                                if (isset($this->invoice->chars['CUSTOMER_ORDER_NBR'])) {
                                    // Has a PO. Find the PO in Pemex Addendas.
                                    $pemexPreInvoice = PemexPreInvoice::model()->find('poNbr = :poNbr', array(':poNbr' => $this->invoice->chars['CUSTOMER_ORDER_NBR']));
                                    if (!$pemexPreInvoice) {
                                        throw new CException(yii::t('app', '[{row},{col}][{invoice}] Pemex PreInvoice for Customer Order Nº "{customerOrder}" not found.', array('{row}' => $row, '{col}' => self::CUSTOMER_ORDER_NBR_COL,
                                                    '{customerOrder}' => $this->invoice->chars['CUSTOMER_ORDER_NBR'], '{invoice}' => $invoiceNbr)));
                                    } else {
                                        foreach ($pemexPreInvoice->pemexPreInvoiceItems as $pemexItem) {
                                            $item = new CfdItem();
                                            $item->qty = $pemexItem->qty;
                                            $item->uom = $pemexItem->uom;
                                            $item->description = $pemexItem->description;
                                            $item->unitPrice = $pemexItem->unitPrice;
                                            $item->productCode = $data[self::PRODUCT_CODE_COL];
//                                            $item->amt = $pemexItem->amount;
                                            $this->invoice->items[] = $item;
//                                            $this->invoice->subTotal += $item->amt;
                                        }
                                        $this->invoice->addenda = $pemexPreInvoice->addenda;
                                        $isPemexInvoiceWithPreInvoice = true;
                                    }
                                }
                                break;
                        }
                    }
                }
                if ($this->invoice) {
                    if ($data[self::INVOICE_DOC_TYPE]) {
                        if (!$isPemexInvoiceWithPreInvoice) {
                            // ITEMS
                            $item = new CfdItem();
                            if (!$data[self::ITEM_QTY])
                                throw new CException(yii::t('app', '[{row},{col}] Item quantity cannot be null', array('{row}' => $row,
                                            '{col}' => self::ITEM_QTY)));
                            $item->qty = $data[self::ITEM_QTY];
                            $description = trim($data[self::PRODUCT_DESCRIPTION_COL_1] . " " . $data[self::PRODUCT_DESCRIPTION_COL_2]);
                            if (!$description)
                                throw new CException(yii::t('app', '[{row},{col}] Item description cannot be null', array('{row}' => $row,
                                            '{col}' => self::PRODUCT_DESCRIPTION_COL_1)));
                            $item->description = $description;

                            if ($data[self::PRODUCT_UOM_COL])
                                $item->uom = $data[self::PRODUCT_UOM_COL];
                            else
                                $item->uom = 'EA';

                            if ($data[self::PRODUCT_CODE_COL])
                                $item->productCode = $data[self::PRODUCT_CODE_COL];

                            if ($data[self::CURRENCY_COL] == "MXP") {
                                if (!$data[self::ITEM_UNIT_PRICE])
                                    throw new CException(yii::t('app', '[{row},{col}] Item unit price cannot be null', array('{row}' => $row,
                                                '{col}' => self::ITEM_UNIT_PRICE)));
                            } else {
                                if (!$data[self::FOREIGN_UNIT_PRICE_COL])
                                    throw new CException(yii::t('app', '[{row},{col}] Item unit price cannot be null', array('{row}' => $row,
                                                '{col}' => self::FOREIGN_UNIT_PRICE_COL)));
                            }
                            $item->chars['LTS'] = (float)$data[self::QUANTITY_IN_LT_COL];

                            if ($data[self::CUSTOMS_DOCUMENT_NUMBER_COL]) {
                                $customsPermit = $this->testCustomsPermit($data);
                                $item->CustomsPermit = $customsPermit;
//                                $this->invoice->CustomsPermit = $customsPermit;
                            }
                            $lineDiscount = 0;
                            switch ($this->invoice->customer->customerCode) {
                                // S3 customers
                                case '124443':
                                    // TOTAL_AFTER_DISCOUNT is always MXP
                                    $totalPrice = (float)$data[self::TOTAL_AFTER_DISCOUNT];
                                    // Get unit price
                                    $item->unitPrice = $totalPrice / $item->qty;
                                    // If invoice currency is not MXP, get price in currency.
                                    if ($this->invoice->currency != "MXP") {
                                        // Convert unit price to currency
                                        $item->unitPrice /= $this->invoice->exchangeRate;
                                        $item->unitPrice = round($item->unitPrice, 6);
                                    }
                                    $totalPrice *= $item->unitPrice;
                                    $totalPrice = round($totalPrice, 2);
                                    break;
                                default:
                                    if ($data[self::DISCOUNT_REASON]) {
                                        if (!isset($discounts[$data[self::DISCOUNT_REASON]])) $discounts[$data[self::DISCOUNT_REASON]] = 0;
                                        $lineDiscount += ($this->invoice->currency == "MXP" ? (float)$data[self::DISCOUNT_AMOUNT]:(float)$data[self::FOREIGN_DISCOUNT]);
                                        $discounts[$data[self::DISCOUNT_REASON]] += ($this->invoice->currency == "MXP" ? (float)$data[self::DISCOUNT_AMOUNT]:(float)$data[self::FOREIGN_DISCOUNT]);
                                        if (!isset($this->invoice->discounts[$data[self::DISCOUNT_REASON]])) {
                                            $discountRec = new CfdDiscount();
                                            $discountRec->reason = $data[self::DISCOUNT_REASON];
                                            $discountRec->amt = 0;
                                            $this->invoice->discounts[$data[self::DISCOUNT_REASON]] = $discountRec;
                                        }
                                        $this->invoice->discounts[$data[self::DISCOUNT_REASON]]->amt += ($this->invoice->currency == "MXP" ? (float)$data[self::DISCOUNT_AMOUNT]:(float)$data[self::FOREIGN_DISCOUNT]);
                                    }
                                    if ($data[self::DISCOUNT_REASON_2]) {
                                        if (!isset($discounts[$data[self::DISCOUNT_REASON_2]])) $discounts[$data[self::DISCOUNT_REASON_2]] = 0;
                                        $lineDiscount += ($this->invoice->currency == "MXP" ? (float)$data[self::DISCOUNT_AMOUNT_2]:(float)$data[self::FOREIGN_DISCOUNT_2]);
                                        $discounts[$data[self::DISCOUNT_REASON_2]] += ($this->invoice->currency == "MXP" ? (float)$data[self::DISCOUNT_AMOUNT_2]:(float)$data[self::FOREIGN_DISCOUNT_2]);
                                        if (!isset($this->invoice->discounts[$data[self::DISCOUNT_REASON_2]])) {
                                            $discountRec = new CfdDiscount();
                                            $discountRec->reason = $data[self::DISCOUNT_REASON_2];
                                            $discountRec->amt = 0;
                                            $this->invoice->discounts[$data[self::DISCOUNT_REASON_2]] = $discountRec;
                                        }
                                        $this->invoice->discounts[$data[self::DISCOUNT_REASON_2]]->amt += ($this->invoice->currency == "MXP" ? (float)$data[self::DISCOUNT_AMOUNT_2]:(float)$data[self::FOREIGN_DISCOUNT_2]);
                                    }
                                    if ($data[self::DISCOUNT_REASON_3]) {
                                        if (!isset($discounts[$data[self::DISCOUNT_REASON_3]])) $discounts[$data[self::DISCOUNT_REASON_3]] = 0;
                                        $lineDiscount += ($this->invoice->currency == "MXP" ? (float)$data[self::DISCOUNT_AMOUNT_3]:(float)$data[self::FOREIGN_DISCOUNT_3]);
                                        $discounts[$data[self::DISCOUNT_REASON_3]] += ($this->invoice->currency == "MXP" ? (float)$data[self::DISCOUNT_AMOUNT_3]:(float)$data[self::FOREIGN_DISCOUNT_3]);
                                        if (!isset($this->invoice->discounts[$data[self::DISCOUNT_REASON_3]])) {
                                            $discountRec = new CfdDiscount();
                                            $discountRec->reason = $data[self::DISCOUNT_REASON_3];
                                            $discountRec->amt = 0;
                                            $this->invoice->discounts[$data[self::DISCOUNT_REASON_3]] = $discountRec;
                                        }
                                        $this->invoice->discounts[$data[self::DISCOUNT_REASON_3]]->amt += ($this->invoice->currency == "MXP" ? (float)$data[self::DISCOUNT_AMOUNT_3]:(float)$data[self::FOREIGN_DISCOUNT_3]);
                                    }
                                    if ($data[self::DISCOUNT_REASON_4]) {
                                        if (!isset($discounts[$data[self::DISCOUNT_REASON_4]])) $discounts[$data[self::DISCOUNT_REASON_4]] = 0;
                                        $lineDiscount += ($this->invoice->currency == "MXP" ? (float)$data[self::DISCOUNT_AMOUNT_4]:(float)$data[self::FOREIGN_DISCOUNT_4]);
                                        $discounts[$data[self::DISCOUNT_REASON_4]] += ($this->invoice->currency == "MXP" ? (float)$data[self::DISCOUNT_AMOUNT_4]:(float)$data[self::FOREIGN_DISCOUNT_4]);
                                        if (!isset($this->invoice->discounts[$data[self::DISCOUNT_REASON_4]])) {
                                            $discountRec = new CfdDiscount();
                                            $discountRec->reason = $data[self::DISCOUNT_REASON_4];
                                            $discountRec->amt = 0;
                                            $this->invoice->discounts[$data[self::DISCOUNT_REASON_4]] = $discountRec;
                                        }
                                        $this->invoice->discounts[$data[self::DISCOUNT_REASON_4]]->amt += ($this->invoice->currency == "MXP" ? (float)$data[self::DISCOUNT_AMOUNT_4]:(float)$data[self::FOREIGN_DISCOUNT_4]);
                                    }
//                                    $this->invoice->discount += $lineDiscount;
                                    if ($this->invoice->currency == "MXP") {
                                        $item->unitPrice = (float)$data[self::ITEM_UNIT_PRICE];
                                    } else {
                                        $item->unitPrice = (float)$data[self::FOREIGN_UNIT_PRICE_COL];
                                    }
                                    $totalPrice = $item->qty * $item->unitPrice;
                                    break;
                            }
//                            $item->amt = $totalPrice;
//                            $this->invoice->subTotal += $totalPrice;
                            $this->invoice->items[] = $item;
                        }

                        // Check tax type
                        if (!$data[self::TAX_TYPE])
                            throw new CException(yii::t('app', '[{row},{col}] Item tax type cannot be null', array('{row}' => $row,
                                        '{col}' => self::TAX_TYPE)));
                        // Check tax rate
                        if (!$data[self::TAX_RATE])
                            throw new CException(yii::t('app', '[{row},{col}] Item tax rate cannot be null', array('{row}' => $row,
                                        '{col}' => self::TAX_RATE)));

                        $taxAmt = ($totalPrice - $lineDiscount) * (float)$data[self::TAX_RATE];
                        $taxAdded = false;
                        foreach ($this->invoice->taxes as $tax) {
                            if ($tax->name == $data[self::TAX_TYPE])
                                if ($tax->rate == (float)$data[self::TAX_RATE] * 100) {
                                    $tax->amt += $taxAmt;
                                    $taxAdded = true;
                                }
                        }
                        if (!$taxAdded) {
                            $tax = new CfdTax();
                            $tax->name = $data[self::TAX_TYPE];
                            $tax->rate = (float)$data[self::TAX_RATE] * 100;
                            $tax->amt = $taxAmt;
                            $this->invoice->taxes[] = $tax;
                        }
                    } else {
                        $this->invoice->notes[] = $data[self::PRODUCT_DESCRIPTION_COL_1] . " " . $data[self::PRODUCT_DESCRIPTION_COL_2];
                    }
                }
            }
            // Save last invoice.
            if ($this->invoice) $this->saveInvoice ();

            $fileRec->processDttm = new CDbExpression('NOW()');
            $fileRec->IncomingInvoiceInterfaceFileStatus_id = IncomingInvoiceInterfaceFileStatus::model()->find('code = :code', array(':code' => IncomingInvoiceInterfaceFileStatus::PROCESSED))->id;
            $fileRec->save();

            yii::app()->end();
        } catch (Exception $e) {
            $this->log($e->getMessage(), CLogger::LEVEL_ERROR, self::LOG_CATEGORY);
            $fileRec->processDttm = new CDbExpression('NOW()');
            $fileRec->IncomingInvoiceInterfaceFileStatus_id = IncomingInvoiceInterfaceFileStatus::model()->find('code = :code', array(':code' => IncomingInvoiceInterfaceFileStatus::ERROR))->id;
            $fileRec->note = $e->getMessage();
            $fileRec->save();
            @unlink($nativeXmlFile);
//            $this->log('[ERROR] ' . $e->getMessage());
//            $this->log('[ERROR] ' . $e->getMessage(), $this->fileLog);
//            // Create error file
//            error_log('[' . date(DateTime::ISO8601) . '] ' . $e->getMessage() . PHP_EOL, 3, $this->fileError);
        }
    }

    private function saveInvoice() {
        if (!Cfd::model()->find('md5 = :md5', array(':md5' => $this->invoice->Md5))) {
            if (!$this->invoice->save())
                print_r($this->invoice->getErrors());
            else {
                // Create CFD XML
                echo $this->invoice->createXml() . PHP_EOL;
                $this->invoice->save();
            }
        } else
            $this->log (yii::t('app', 'Invoice {invoice} already exists.', array('{invoice}' => $this->invoice->invoice)), CLogger::LEVEL_INFO);
    }
    private function testCustomsPermit($data) {
        // Process customs permit
        // Find customs permit in DB
        $custPermit = CustomsPermit::model()->find('nbr = :nbr', array(':nbr' => $data[self::CUSTOMS_DOCUMENT_NUMBER_COL]));
        if (!$custPermit) {
            $custPermit = new CustomsPermit();
            $custPermit->nbr = $data[self::CUSTOMS_DOCUMENT_NUMBER_COL];
            if (!$data[self::CUSTOMS_DOCUMENT_DATE_COL])
                throw new CException(yii::t('app', 'Date for customs permit Nº "{nbr}" cannot be null.', array(
                            '{nbr}' => $custPermit->nbr)));
            $customsDt = DateTime::createFromFormat("Y/m/d", $data[self::CUSTOMS_DOCUMENT_DATE_COL]);
            if (!$customsDt)
                throw new CException(yii::t('app', 'Invalid date "{date}" for customs permit Nº "{nbr}".', array(
                    '{date}' => trim($data[self::CUSTOMS_DOCUMENT_DATE_COL]),
                            '{nbr}' => $custPermit->nbr)));
            else
                $custPermit->dt = $customsDt->format("Y-m-d");
            if ($data[self::CUSTOMS_NAME_COL])
                $custPermit->office = trim($data[self::CUSTOMS_NAME_COL]);
            $custPermit->save();
        }
        return $custPermit;
    }

    private function testVendor($data) {
        // Vendor validations

        // Test RFC
        $rfc = $data[self::OWNER_RFC_COL];
        if (!$rfc)
            throw new CException(yii::t('app', 'Vendor RFC cannot be null'));

        try {
            SatRfc::validate($rfc);
        } catch (CException $e) {
            throw new CException(yii::t('app', 'Invalid vendor RFC "{rfc}".', array('{rfc}' => $rfc)));
        }

        $name = $data[self::OWNER_NAME_COL];
        if (!$name)
            throw new CException(yii::t('app', 'Vendor name cannot be null'));

        // Test if we already have a vendor in memory
        if (!$this->vendorRec) {
            // Test if vendor exists in DB.
            $rfcRec = PartyIdentifier::model()->find('name = :name and value = :value', array(':name' => PartyIdentifier::RFC, ':value' => $rfc));
            if (!$rfcRec) {
                // Vendor does not exist.
                // Create vendor
                $this->vendorRec = new Party();
                $this->vendorRec->person = (strlen($rfc) == 13);
                $this->vendorRec->name = $name;
                $this->vendorRec->rfc = $rfc;
                $this->vendorRec->save();
            } else {
                $this->vendorRec = $rfcRec->party;
            }
        }
        // Test if the name has changed.
        if ($this->vendorRec->name != $name) {
            $this->vendorRec->name = $name;
            $this->vendorRec->save();
        }
        // Test if the RFC has changed.
        if ($this->vendorRec->rfc != $rfc) {
            $this->vendorRec->rfc = $rfc;
            $this->vendorRec->save();
        }
        return $this->vendorRec;
    }

    private function testCustomer($data) {
        // Customer validations

        // Test Customer RFC
        $rfc = $data[self::CUSTOMER_RFC_COL];
        if (!$rfc)
            throw new CException(yii::t('app', 'Customer RFC cannot be null'));

        try {
            SatRfc::validate($rfc);
        } catch (CException $e) {
            throw new CException(yii::t('app', 'Invalid customer RFC "{rfc}".', array('{rfc}' => $rfc)));
        }

        $name = $data[self::CUSTOMER_NAME_COL];
        if (!$name)
            throw new CException(yii::t('app', 'Customer name cannot be null'));

        $customerCode = $data[self::BP_CUSTOMER_CODE_COL];
        if (!$customerCode)
            throw new CException(yii::t('app', 'Customer code cannot be null'));

        // Test if we already have a vendor in memory
        if (!$this->customerRec) {
            // Test if vendor exists in DB.
            $customerCodeRec = PartyIdentifier::model()->find('name = :name and value = :value', array(':name' => PartyIdentifier::CUSTOMER_CODE, ':value' => $customerCode));
            if (!$customerCodeRec) {
                // Customer does not exist.
                // Create customer
                $this->customerRec = new Party();
                $this->customerRec->person = (strlen($rfc) == 13);
                $this->customerRec->name = $name;
                $this->customerRec->rfc = $rfc;
                $this->customerRec->customerCode = $customerCode;
                $this->customerRec->save();
            } else {
                $this->customerRec = $customerCodeRec->party;
            }
        }
        // Test if it's the same customer.
        if ($this->customerRec->customerCode == $customerCode) {
            // Test if the name has changed.
            if ($this->customerRec->name != $name) {
                $this->customerRec->name = $name;
                $this->customerRec->save();
            }
            // Test if the RFC has changed.
            if ($this->customerRec->rfc != $rfc) {
                $this->customerRec->rfc = $rfc;
                $this->customerRec->save();
            }
        } else {
            $this->customerRec = false;
            $this->testCustomer($data);
        }
        return $this->customerRec;
    }

    private function testAddress($data, $addressType, $testAddress) {

        $addressRec = new Address();

        switch ($addressType) {
            case AddressType::PRIMARY:
                // PROCESS VENDOR FISCAL ADDRESS
                if (!$data[self::OWNER_ADDRESS_STREET_COL])
                    throw new CException(yii::t('app', 'Vendor primary address street cannot be null.'));
                else
                    $addressRec->street = $data[self::OWNER_ADDRESS_STREET_COL];
                if ($data[self::OWNER_ADDRESS_EXTNUM_COL])
                    $addressRec->extNbr = $data[self::OWNER_ADDRESS_EXTNUM_COL];
                if ($data[self::OWNER_ADDRESS_INTNUM_COL])
                    $addressRec->intNbr = $data[self::OWNER_ADDRESS_INTNUM_COL];
                if (!$data[self::OWNER_ADDRESS_NEIGHBOURHOOD_COL])
                    throw new CException(yii::t('app', 'Vendor primary address municipality cannot be null.'));
                else
                    $addressRec->neighbourhood = $data[self::OWNER_ADDRESS_NEIGHBOURHOOD_COL];
                if ($data[self::OWNER_ADDRESS_CITY_COL])
                    $addressRec->municipality = $data[self::OWNER_ADDRESS_CITY_COL];
                if (!$data[self::OWNER_ADDRESS_ZIPCODE_COL])
                    throw new CException(yii::t('app', 'Vendor primary address zip code cannot be null.'));
                else
                    $addressRec->zipCode = substr('00000' . $data[self::OWNER_ADDRESS_ZIPCODE_COL], -5);
                if (!$data[self::OWNER_ADDRESS_COUNTRY_COL])
                    throw new CException(yii::t('app', 'Vendor primary address country cannot be null.'));
                else
                    $addressRec->country = $data[self::OWNER_ADDRESS_COUNTRY_COL];
                if (!$data[self::OWNER_ADDRESS_STATE_COL])
                    throw new CException(yii::t('app', 'Vendor primary address state cannot be null.'));
                else
                    $addressRec->state = $data[self::OWNER_ADDRESS_STATE_COL];
                // Test if we already have an address in memory
                break;
            case AddressType::ISSUING:
                if ($data[self::INVOICE_FROM_ADDRESS_STREET_COL])
                    $addressRec->street = $data[self::INVOICE_FROM_ADDRESS_STREET_COL];
                if ($data[self::INVOICE_FROM_ADDRESS_EXTNUM_COL])
                    $addressRec->extNbr = $data[self::INVOICE_FROM_ADDRESS_EXTNUM_COL];
                if ($data[self::INVOICE_FROM_ADDRESS_INTNUM_COL] != $data[self::INVOICE_FROM_ADDRESS_NEIGHBOURHOOD_COL]) {
                    if ($data[self::INVOICE_FROM_ADDRESS_INTNUM_COL])
                        $addressRec->intNbr = $data[self::INVOICE_FROM_ADDRESS_INTNUM_COL];
                }
                if ($data[self::INVOICE_FROM_ADDRESS_NEIGHBOURHOOD_COL])
                    $addressRec->neighbourhood = $data[self::INVOICE_FROM_ADDRESS_NEIGHBOURHOOD_COL];
                if ($data[self::INVOICE_FROM_ADDRESS_CITY_COL])
                    $addressRec->city = $data[self::INVOICE_FROM_ADDRESS_CITY_COL];
                if ($data[self::INVOICE_FROM_ADDRESS_ZIPCODE_COL])
                    $addressRec->zipCode = substr('00000' . $data[self::INVOICE_FROM_ADDRESS_ZIPCODE_COL], -5);
                if (!$data[self::INVOICE_FROM_ADDRESS_COUNTRY_COL])
                    throw new CException(yii::t('app', 'Vendor invoicing address country cannot be null.'));
                else
                    $addressRec->country = trim($data[self::INVOICE_FROM_ADDRESS_COUNTRY_COL]);
                if ($data[self::INVOICE_FROM_ADDRESS_STATE_COL])
                    $addressRec->state = $data[self::INVOICE_FROM_ADDRESS_STATE_COL];
                break;
            case AddressType::BILL_TO:
                if ($data[self::CUSTOMER_SOLD_TO_ADDRESS_STREET_COL])
                    $addressRec->street = $data[self::CUSTOMER_SOLD_TO_ADDRESS_STREET_COL];
                if ($data[self::CUSTOMER_SOLD_TO_ADDRESS_EXTNUM_COL])
                    $addressRec->extNbr = $data[self::CUSTOMER_SOLD_TO_ADDRESS_EXTNUM_COL];
                if ($data[self::CUSTOMER_SOLD_TO_ADDRESS_INTNUM_COL] != $data[self::CUSTOMER_SOLD_TO_ADDRESS_NEIGHBOURHOOD_COL]) {
                    if ($data[self::CUSTOMER_SOLD_TO_ADDRESS_INTNUM_COL])
                        $addressRec->intNbr = $data[self::CUSTOMER_SOLD_TO_ADDRESS_INTNUM_COL];
                }
                if ($data[self::CUSTOMER_SOLD_TO_ADDRESS_NEIGHBOURHOOD_COL])
                    $addressRec->neighbourhood = $data[self::CUSTOMER_SOLD_TO_ADDRESS_NEIGHBOURHOOD_COL];
                if ($data[self::CUSTOMER_SOLD_TO_ADDRESS_CITY_COL])
                    $addressRec->city = $data[self::CUSTOMER_SOLD_TO_ADDRESS_CITY_COL];
                if ($data[self::CUSTOMER_SOLD_TO_ADDRESS_ZIPCODE_COL])
                    if ($data[self::CUSTOMER_SOLD_TO_ADDRESS_COUNTRY_COL] == 'MX')
                        $addressRec->zipCode = substr('00000' . $data[self::CUSTOMER_SOLD_TO_ADDRESS_ZIPCODE_COL], -5);
                    else
                        $addressRec->zipCode = $data[self::CUSTOMER_SOLD_TO_ADDRESS_ZIPCODE_COL];
                if ($data[self::CUSTOMER_SOLD_TO_ADDRESS_STATE_COL])
                    $addressRec->state = $data[self::CUSTOMER_SOLD_TO_ADDRESS_STATE_COL];
                // Check customer billing address
                if (!$data[self::CUSTOMER_SOLD_TO_ADDRESS_COUNTRY_COL])
                    throw new CException(yii::t('app', 'Customer billing country address cannot be null.'));
                else
                    $addressRec->country = $data[self::CUSTOMER_SOLD_TO_ADDRESS_COUNTRY_COL];
                break;
            case AddressType::SHIP_TO:
                if ($data[self::CUSTOMER_SHIP_TO_ADDRESS_STREET_COL])
                    $addressRec->street = $data[self::CUSTOMER_SHIP_TO_ADDRESS_STREET_COL];
                if ($data[self::CUSTOMER_SHIP_TO_ADDRESS_EXTNUM_COL])
                    $addressRec->extNbr = $data[self::CUSTOMER_SHIP_TO_ADDRESS_EXTNUM_COL];
                if ($data[self::CUSTOMER_SHIP_TO_ADDRESS_INTNUM_COL] != $data[self::CUSTOMER_SHIP_TO_ADDRESS_NEIGHBOURHOOD_COL]) {
                    if ($data[self::CUSTOMER_SHIP_TO_ADDRESS_INTNUM_COL])
                        $addressRec->intNbr = $data[self::CUSTOMER_SHIP_TO_ADDRESS_INTNUM_COL];
                }
                if ($data[self::CUSTOMER_SHIP_TO_ADDRESS_NEIGHBOURHOOD_COL])
                    $addressRec->neighbourhood = $data[self::CUSTOMER_SHIP_TO_ADDRESS_NEIGHBOURHOOD_COL];
                if ($data[self::CUSTOMER_SHIP_TO_ADDRESS_CITY_COL])
                    $addressRec->city = $data[self::CUSTOMER_SHIP_TO_ADDRESS_CITY_COL];
                if ($data[self::CUSTOMER_SHIP_TO_ADDRESS_STATE_COL])
                    $addressRec->state = $data[self::CUSTOMER_SHIP_TO_ADDRESS_STATE_COL];
                if ($data[self::CUSTOMER_SHIP_TO_ADDRESS_COUNTRY_COL])
                    $addressRec->country = $data[self::CUSTOMER_SHIP_TO_ADDRESS_COUNTRY_COL];
                if ($data[self::CUSTOMER_SHIP_TO_ADDRESS_ZIPCODE_COL]) {
                    if ($addressRec->country == 'MX')
                        $addressRec->zipCode = substr('00000' . $data[self::CUSTOMER_SHIP_TO_ADDRESS_ZIPCODE_COL], -5);
                    else
                        $addressRec->zipCode = $data[self::CUSTOMER_SHIP_TO_ADDRESS_ZIPCODE_COL];
                }
                break;
        }
        if (!$testAddress || ($addressRec->Md5 != $testAddress->Md5)) {
            $address = Address::model()->find('md5 = :md5', array(':md5' => $addressRec->Md5));
            if (!$address)
                $addressRec->save();
            else
                $addressRec = $address;
        } else {
            $addressRec = $testAddress;
        }
        switch ($addressType) {
            case AddressType::PRIMARY:
                $this->vendorFiscalAddress = $addressRec;
                $cfdAddress = new CfdAddress();
                $cfdAddress->Address_id = $addressRec->id;
                $cfdAddress->AddressType_id = AddressType::model()->find('code = :code', array(':code' => AddressType::PRIMARY))->id;
                break;
            case AddressType::ISSUING:
                $this->vendorIssuingAddress = $addressRec;
                $cfdAddress = new CfdAddress();
                $cfdAddress->Address_id = $addressRec->id;
                $cfdAddress->AddressType_id = AddressType::model()->find('code = :code', array(':code' => AddressType::ISSUING))->id;
                $cfdAddress->name = $data[self::INVOICE_FROM_NAME_COL];
                break;
            case AddressType::BILL_TO:
                $this->customerBillToAddress = $addressRec;
                $cfdAddress = new CfdAddress();
                $cfdAddress->Address_id = $addressRec->id;
                $cfdAddress->AddressType_id = AddressType::model()->find('code = :code', array(':code' => AddressType::BILL_TO))->id;
                break;
            case AddressType::SHIP_TO:
                $this->customerBillToAddress = $addressRec;
                $cfdAddress = new CfdAddress();
                $cfdAddress->Address_id = $addressRec->id;
                $cfdAddress->AddressType_id = AddressType::model()->find('code = :code', array(':code' => AddressType::SHIP_TO))->id;
                $cfdAddress->name = $data[self::CUSTOMER_SHIP_TO_RFC_COL] . ' ' . $data[self::CUSTOMER_SHIP_TO_NAME_COL];
                break;
        }
        return $cfdAddress;
    }
}

?>
