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
class CastrolProcessIncomingInvoiceFileAsEntityCommand extends CConsoleCommand {

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
    const VENDOR_RFC_COL = 7;
    const VENDOR_NAME_COL = 8;
    const VENDOR_ADDRESS_STREET_COL = 9;
    const VENDOR_ADDRESS_EXTNUM_COL = 10;
    const VENDOR_ADDRESS_INTNUM_COL = 11;
    const VENDOR_ADDRESS_NEIGHBOURHOOD_COL = 12;
    const VENDOR_ADDRESS_CITY_COL = 13;
    const VENDOR_ADDRESS_STATE_COL = 14;
    const VENDOR_ADDRESS_COUNTRY_COL = 15;
    const VENDOR_ADDRESS_ZIPCODE_COL = 16;
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
    private $row = null;

    private $invoice = false;
    private $discounts = array();
    private $taxes = array();
    private $nativeXml;

    const LOG_CATEGORY = 'IncomingInvoiceInterfaceFileProcessor';

    /**
     * Processes a file with CASTROL format.
     * @param array $args arguments for the process.
     * The first parameter is the invoice file with path.
     * @return string the translated message
     */
    private function log($msg, $level = CLogger::LEVEL_INFO, $category = self::LOG_CATEGORY) {
        yii::log($msg, $level, $category);
        $sMsg = yii::t('app', '{date} - [{level}] [row: {row}] - {msg}', array(
            '{date}' => date(DateTime::ISO8601),
            '{level}' => $level,
            '{row}' => ($this->row?:''),
            '{msg}' => $msg)) . PHP_EOL;
        error_log($sMsg, 3, "$this->logFile");
        echo $sMsg;
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
            // Get party Entity type
            $partyEntityType = EntityType::model()->find('code = :code', array(':code' => 'PARTY'));
            if (!$partyEntityType)
                throw new CException(yii::t('app', 'Entity type {type} not found.', array('{type}' => 'PARTY')));
            
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
            $this->nativeXml = new DOMDocument("1.0", "UTF-8");
            $root = $this->nativeXml->createElement('Cfds');
            $root = $this->nativeXml->appendChild($root);

            $discount = 0;
            $subTotal = 0;
            $this->discounts = array();
            $this->row = 0;
            $isPemexInvoiceWithPreInvoice = false;
            $vendorRec = false;
            $noteCount = 1;
            $lts = 0;

            while (($data = fgetcsv($fHandle, 0, '|')) !== FALSE) {
                $this->row++;
                $colCount = count($data);
                if ($colCount <= 1)
                    continue;
                if ($colCount != self::COL_COUNT)
                    throw new CException(yii::t('app', 'Row {row} has {colCount} columns and must have {col_count}.', array('{row}' => $this->row, '{colCount}' => $colCount, '{col_count}' => self::COL_COUNT)));

                // Normalize UTF8
                for ($i = 0; $i < self::COL_COUNT; $i++) {
                    $data[$i] = trim(mb_convert_encoding($data[$i], 'utf8'));
                }

                if ($invoiceNbr != $data[self::INVOICE_NUMBER_COL]) {
                    if ($this->invoice) {
                        $this->saveInvoice();

//                        $descuentos = $this->invoice->appendChild($this->nativeXml->createElement('Descuentos'));
//                        foreach ($this->discounts as $reason => $amt) {
//                            $descuento = $descuentos->appendChild($this->nativeXml->createElement('Descuento'));
//                            $descuento->setAttribute('motivo', $reason);
//                            $descuento->setAttribute('importe', $amt);
//                        }
//                        $this->discounts = array();
//                        foreach ($this->taxes as $type => $tax) {
//                            $cfdTax = $cfdTaxes->appendChild($this->nativeXml->createElement('CfdTax'));
//                            $cfdTax->setAttribute('name', $type);
//                            foreach ($tax as $rate => $amt) {
//                                $cfdTax->setAttribute('rate', $rate * 100);
//                                $cfdTax->setAttribute('amt', $amt);
//                                $cfdTax->setAttribute('local', 0);
//                                $cfdTax->setAttribute('withHolding', 0);
//                            }
//                        }
//                        $this->taxes = array();
//                        $lts = 0;
//                        $this->invoice->setAttribute('subTotal', $subTotal);
//                        $subTotal = 0;
//                        $this->invoice = false;
//                        $isPemexInvoiceWithPreInvoice = false;
//                        $noteCount = 1;
                    }

                    $invoiceNbr = $data[self::INVOICE_NUMBER_COL];
                    // InvoiceNbr validations
                    if (!$invoiceNbr)
                        throw new CException(yii::t('app', '[{row},{col}] Invoice number cannot be null', array('{row}' => $this->row,
                                    '{col}' => self::INVOICE_NUMBER_COL)));

                    $this->log(yii::t('app', 'Processing invoice {invoice}', array('{invoice}' => $invoiceNbr)), CLogger::LEVEL_INFO, self::LOG_CATEGORY);
                    $serie = substr($invoiceNbr, 0, 1);
                    $folio = substr($invoiceNbr, 1);

                    $this->testHeader($data);

//                    // Find invoice in database
//                    // If invoice already found, skip
//
//                    if (cfd::model()->find('vendorRfc = :vendorRfc and serial = :serial and folio = :folio', array(
//                                ':vendorRfc' => $vendorRfc,
//                                ':serial' => $serie,
//                                ':folio' => $folio))) {
//                        $this->log(yii::t('app', '[{row},{col}][{invoice}] Invoice Nº "{invoice}" already exists.', array(
//                                    '{row}' => $this->row, '{col}' => self::INVOICE_NUMBER_COL, '{invoice}' => $invoiceNbr
//                                )), CLogger::LEVEL_WARNING, self::LOG_CATEGORY);
//                        continue;
//                    }
//
                    $invoiceDttm = $this->testDttm($data);

                    // New Invoice
                    $this->invoice = $root->appendChild($this->nativeXml->createElement('Cfd'));
                    $version = SystemConfig::getValue(SystemConfig::CURRENT_CFD_VERSION);

                    $this->invoice->setAttribute('version', SystemConfig::getValue(SystemConfig::CURRENT_CFD_VERSION));
                    $this->invoice->setAttribute('invoice', $invoiceNbr);
                    $this->invoice->setAttribute('serial', $serie);
                    $this->invoice->setAttribute('folio', $folio);
                    $this->invoice->setAttribute('dttm', $invoiceDttm->format("Y-m-d\TH:i:s"));
                    $this->invoice->setAttribute('paymentType', ($data[self::INVOICE_PAYMENT_TYPE] == 'PAGO EN UNA SOLA EHXIBICION') ? self::DEFAULT_PAYMENT_TYPE : $data[self::INVOICE_PAYMENT_TYPE]);
                    $this->invoice->setAttribute('paymentTerm', $data[self::INVOICE_PAYMENT_TERM]);
                    $this->invoice->setAttribute('currency', $data[self::CURRENCY_COL]);
                    if ($data[self::CURRENCY_COL] != 'MXP') $this->invoice->setAttribute('exchangeRate', trim($data[self::CURRENCY_RATE_COL]));
                    $currencyRec = Currency::model()->find('code = :code', array(':code' => $data[self::CURRENCY_COL]));
                    if ($currencyRec) $this->invoice->setAttribute('Currency_id', $currencyRec->id);
                    $this->invoice->setAttribute('voucherType', strtolower($data[self::INVOICE_DOC_TYPE]));

                    $this->invoice->setAttribute('paymentMethod', self::DEFAULT_PAYMENT_METHOD);

                    $cfdAttributes = $this->invoice->appendChild($this->nativeXml->createElement('Characteristics'));

                    $paymentTermRec = PaymentTerm::model()->find('name = :name', array(':name' => $data[self::INVOICE_PAYMENT_TERM]));
                    if ($paymentTermRec->days != 0) $invoiceDttm->add(new DateInterval('P' . $paymentTermRec->days . 'D'));
                    $cfdAttribute = $cfdAttributes->appendChild($this->nativeXml->createElement('Characteristic'));
                    $cfdAttribute->setAttribute('className', 'Cfd');
                    $cfdAttribute->setAttribute('code', 'dueDt');
                    $cfdAttribute->setAttribute('value', $invoiceDttm->format('Y-m-d'));

                    $promisedDate = new DateTime($data[self::PROMISED_DATE_COL]);
                    $cfdAttribute = $cfdAttributes->appendChild($this->nativeXml->createElement('Characteristic'));
                    $cfdAttribute->setAttribute('className', 'Cfd');
                    $cfdAttribute->setAttribute('code', 'promisedDt');
                    $cfdAttribute->setAttribute('value', $promisedDate->format("Y-m-d"));

                    $cfdAttribute = $cfdAttributes->appendChild($this->nativeXml->createElement('Characteristic'));
                    $cfdAttribute->setAttribute('className', 'Cfd');
                    $cfdAttribute->setAttribute('code', 'orderNbr');
                    $cfdAttribute->setAttribute('value', $data[self::BP_ORDER_NBR_COL]);

                    if ($data[self::CUSTOMER_ORDER_NBR_COL]) {
                        $cfdAttribute = $cfdAttributes->appendChild($this->nativeXml->createElement('Characteristic'));
                        $cfdAttribute->setAttribute('className', 'Cfd');
                        $cfdAttribute->setAttribute('code', 'customerOrderNbr');
                        $cfdAttribute->setAttribute('value', $data[self::CUSTOMER_ORDER_NBR_COL]);
                    }

                    $cfdAttribute = $cfdAttributes->appendChild($this->nativeXml->createElement('Characteristic'));
                    $cfdAttribute->setAttribute('className', 'Cfd');
                    $cfdAttribute->setAttribute('code', 'emailAddress');
                    $cfdAttribute->setAttribute('value', $data[self::EMAIL_ADDRESS_COL]);

                    $cfdAttribute = $cfdAttributes->appendChild($this->nativeXml->createElement('Characteristic'));
                    $cfdAttribute->setAttribute('className', 'Cfd');
                    $cfdAttribute->setAttribute('code', 'agent');
                    $cfdAttribute->setAttribute('value', $data[self::AGENT_COL]);

                    $cfdAttribute = $cfdAttributes->appendChild($this->nativeXml->createElement('Characteristic'));
                    $cfdAttribute->setAttribute('className', 'Cfd');
                    $cfdAttribute->setAttribute('code', 'transport');
                    $cfdAttribute->setAttribute('value', $data[self::TRANSPORT_COL]);

                    $transactionOrderDt = new DateTime($data[self::TRANSACTION_ORDER_DATE_COL]);
                    $cfdAttribute = $cfdAttributes->appendChild($this->nativeXml->createElement('Characteristic'));
                    $cfdAttribute->setAttribute('className', 'Cfd');
                    $cfdAttribute->setAttribute('code', 'transactionOrderDt');
                    $cfdAttribute->setAttribute('value', $transactionOrderDt->format("Y-m-d"));

                    $cfdTaxRegimes = $this->invoice->appendChild($this->nativeXml->createElement('CfdTaxRegimes'));
                    $cfdTaxRegime = $cfdTaxRegimes->appendChild($this->nativeXml->createElement('CfdTaxRegime'));
                    $cfdTaxRegime->setAttribute('name', self::DEFAULT_FISCAL_REGIME);

                    // PROCESS VENDOR
                    $vendor = $this->testVendor($data);
                    $this->invoice->setAttribute('vendorParty_id', $vendor->id);
                    // PROCESS CUSTOMER
                    $customer = $this->testCustomer($data);
                    $this->invoice->setAttribute('customerParty_id', $customer->id);
                    // PROCESS SAT CERTIFICATE
                    $this->invoice->setAttribute('SatCertificate_id', $this->testCertificate($data)->id);

                    // ADDRESSES
                    $cfdAddresses = $this->invoice->appendChild($this->nativeXml->createElement('CfdAddresses'));
                    // ADDRESSES
                    $cfdAddress = $cfdAddresses->appendChild($this->nativeXml->createElement('CfdAddress'));
                    $primaryAddress = $this->testAddress($data, AddressType::PRIMARY);
                    $cfdAddress->setAttribute('Address_id', $primaryAddress->id);
                    $cfdAddress->setAttribute('AddressType_id', AddressType::model()->find('code = :code', array(':code' => AddressType::PRIMARY))->id);
                    $expeditionPlace = ($primaryAddress->Country_id ? $primaryAddress->country0->name : $primaryAddress->country);
                    $expeditionPlace = ($primaryAddress->State_id ? $primaryAddress->state0->name . ', ' . $expeditionPlace : $primaryAddress->state . ', ' . $expeditionPlace);
                    $this->invoice->setAttribute('expeditionPlace', $expeditionPlace);

                    // PROCESS VENDOR ISSUING ADDRESS
                    if ($data[self::INVOICE_FROM_NAME_COL]) {
                        $cfdAddress = $cfdAddresses->appendChild($this->nativeXml->createElement('CfdAddress'));
                        $issuingAddress = $this->testAddress($data, AddressType::ISSUING);
                        $cfdAddress->setAttribute('Address_id', $issuingAddress->id);
                        $cfdAddress->setAttribute('AddressType_id', AddressType::model()->find('code = :code', array(':code' => AddressType::ISSUING))->id);
                        $cfdAddress->setAttribute('name', $data[self::INVOICE_FROM_NAME_COL]);
                        $expeditionPlace = ($issuingAddress->Country_id ? $issuingAddress->country0->name : $issuingAddress->country);
                        $expeditionPlace = ($issuingAddress->State_id ? $issuingAddress->state0->name . ', ' . $expeditionPlace : $issuingAddress->state . ', ' . $expeditionPlace);
                        $this->invoice->setAttribute('expeditionPlace', $expeditionPlace);
                    }

                    // CUSTOMER ADDRESS
                    $cfdAddress = $cfdAddresses->appendChild($this->nativeXml->createElement('CfdAddress'));
                    $cfdAddress->setAttribute('Address_id', $this->testAddress($data, AddressType::BILL_TO)->id);
                    $cfdAddress->setAttribute('AddressType_id', AddressType::model()->find('code = :code', array(':code' => AddressType::BILL_TO))->id);

                    // PROCESS CUSTOMER SHIP TO ADDRESS
                    if ($data[self::CUSTOMER_SHIP_TO_NAME_COL]) {
                        $cfdAddress = $cfdAddresses->appendChild($this->nativeXml->createElement('CfdAddress'));
                        $cfdAddress->setAttribute('Address_id', $this->testAddress($data, AddressType::SHIP_TO)->id);
                        $cfdAddress->setAttribute('AddressType_id', AddressType::model()->find('code = :code', array(':code' => AddressType::SHIP_TO))->id);
                        $cfdAddress->setAttribute('name', $data[self::CUSTOMER_SHIP_TO_NAME_COL]);
                    }

                    $items = $this->invoice->appendChild($this->nativeXml->createElement('CfdItems'));
                    $notes = $this->invoice->appendChild($this->nativeXml->createElement('CfdNotes'));
                    $cfdTaxes = $this->invoice->appendChild($this->nativeXml->createElement('CfdTaxes'));

                    // Check for addenda
                    // If Customer RFC is one that requires addenda, find if an addenda was loaded.
                    if ($data[self::INVOICE_DOC_TYPE] == 'INGRESO') {
                        switch ($data[self::CUSTOMER_RFC_COL]) {
                            case 'PEP9207167XA':
                            case 'PRE9207163T7':
                                // Check if it has a PO nbr
                                if ($data[self::CUSTOMER_ORDER_NBR_COL]) {
                                    // Has a PO. Find the PO in Pemex Addendas.
                                    $pemexPreInvoice = PemexPreInvoice::model()->find('poNbr = :poNbr', array(':poNbr' => $data[self::CUSTOMER_ORDER_NBR_COL]));
                                    if (!$pemexPreInvoice) {
                                        throw new CException(yii::t('app', '[{row},{col}][{invoice}] Pemex PreInvoice for Customer Order Nº "{customerOrder}" not found.', array('{row}' => $this->row, '{col}' => self::CUSTOMER_ORDER_NBR_COL,
                                                    '{customerOrder}' => $data[self::CUSTOMER_ORDER_NBR_COL], '{invoice}' => $invoiceNbr)));
                                    } else {
                                        // Create item from Pemex preinvoice
                                        $totalPrice = 0;
                                        foreach ($pemexPreInvoice->pemexPreInvoiceItems as $pemexItem) {
                                            $item = $items->appendChild($this->nativeXml->createElement('CfdItem'));
                                            $item->setAttribute('qty', $pemexItem->qty);
                                            $item->setAttribute('uom', $pemexItem->uom);
                                            $item->setAttribute('description', $pemexItem->description);
                                            $item->setAttribute('productCode', $data[self::PRODUCT_CODE_COL]);
                                            $item->setAttribute('unitPrice', $pemexItem->unitPrice);
                                            $itemAttributes = $item->appendChild($this->nativeXml->createElement('Characteristics'));
                                            $itemAttribute = $itemAttributes->appendChild($this->nativeXml->createElement('Characteristic'));
                                            $itemAttribute->setAttribute('className', 'CfdItem');
                                            $itemAttribute->setAttribute('code', 'lts');
                                            $itemAttribute->setAttribute('value', $pemexItem->qty);

                                            $cfdItemHasCustomsPermits = $item->appendChild($this->nativeXml->createElement('CfdItemHasCustomsPermits'));
                                            // Check tax type
                                            if (!$data[self::TAX_TYPE]) throw new CException(yii::t('app', '[{row},{col}] Item tax type cannot be null', array('{row}' => $this->row,
                                                            '{col}' => self::TAX_TYPE)));
                                            // Check tax rate
                                            if (!$data[self::TAX_RATE]) throw new CException(yii::t('app', '[{row},{col}] Item tax rate cannot be null', array('{row}' => $this->row,
                                                            '{col}' => self::TAX_RATE)));

                                            $taxAmt = $pemexItem->qty * $pemexItem->unitPrice * (float) trim($data[self::TAX_RATE]);
                                            if (!isset($this->taxes[$data[self::TAX_TYPE]]) || !isset($this->taxes[$data[self::TAX_TYPE]][$data[self::TAX_RATE]]))
                                                $this->taxes[$data[self::TAX_TYPE]][$data[self::TAX_RATE]] = 0;

                                            $this->taxes[$data[self::TAX_TYPE]][$data[self::TAX_RATE]] += $taxAmt;

                                        }
                                        $isPemexInvoiceWithPreInvoice = true;
                                    }
                                }
                                break;
                        }
                    }

//                    $this->discounts = array();
//                    $discount = 0;
//                    $subTotal = 0;
                }
                if ($this->invoice) {
                    // ITEMS
                    if (trim($data[self::INVOICE_DOC_TYPE])) {
                        if (!$isPemexInvoiceWithPreInvoice) {
                            $qty = (float)trim($data[self::ITEM_QTY]);
                            if (!$qty)
                                throw new CException(yii::t('app', '[{row},{col}] Item quantity cannot be null', array('{row}' => $this->row,
                                            '{col}' => self::ITEM_QTY)));

                            $description = trim($data[self::PRODUCT_DESCRIPTION_COL_1] . " " . $data[self::PRODUCT_DESCRIPTION_COL_2]);
                            if (!$description)
                                throw new CException(yii::t('app', '[{row},{col}] Item description cannot be null', array('{row}' => $this->row,
                                            '{col}' => self::PRODUCT_DESCRIPTION_COL_1)));

                            $item = $items->appendChild($this->nativeXml->createElement('CfdItem'));
                            $item->setAttribute('qty', (float) $qty);
                            $item->setAttribute('uom', $data[self::PRODUCT_UOM_COL]?:'EA');
                            $item->setAttribute('description', $description);

                            if (trim($data[self::PRODUCT_CODE_COL]))
                                $item->setAttribute('productCode', trim($data[self::PRODUCT_CODE_COL]));

                            switch ($data[self::BP_CUSTOMER_CODE_COL]) {
                                // S3 customers
                                case '124443':
                                    if (!trim($data[self::TOTAL_AFTER_DISCOUNT]))
                                        throw new CException(yii::t('app', '[{row},{col}] Item total price after discount cannot be null', array('{row}' => $this->row,
                                                    '{col}' => self::TOTAL_AFTER_DISCOUNT)));
                                    // TOTAL_AFTER_DISCOUNT is always MXP
                                    $totalPrice = (float)$data[self::TOTAL_AFTER_DISCOUNT];
                                    // Get unit price
                                    $unitPrice = $totalPrice / $qty;
                                    // If invoice currency is not MXP, get price in currency.
                                    if ($data[self::CURRENCY_COL] != "MXP") {
                                        // Convert unit price to currency
                                        $unitPrice /= (float)$data[self::CURRENCY_RATE_COL];
                                        $unitPrice = round($unitPrice, 6);
                                    }
                                    $totalPrice *= $unitPrice;
                                    $totalPrice = round($totalPrice, 2);
                                    break;
                                default:
                                    if (trim($data[self::CURRENCY_COL]) == "MXP") {
                                        if (!$data[self::ITEM_UNIT_PRICE])
                                            throw new CException(yii::t('app', '[{row},{col}] Item unit price cannot be null', array('{row}' => $this->row,
                                                        '{col}' => self::ITEM_UNIT_PRICE)));
                                        $unitPrice = (float) trim($data[self::ITEM_UNIT_PRICE]);
                                    } else {
                                        if (!trim($data[self::FOREIGN_UNIT_PRICE_COL]))
                                            throw new CException(yii::t('app', '[{row},{col}] Item unit price cannot be null', array('{row}' => $this->row,
                                                        '{col}' => self::FOREIGN_UNIT_PRICE_COL)));
                                        $unitPrice = (float) trim($data[self::FOREIGN_UNIT_PRICE_COL]);
                                    }
                                    $lineDiscount = 0;
                                    if ($data[self::DISCOUNT_REASON]) {
                                        if (!isset($this->discounts[$data[self::DISCOUNT_REASON]]))
                                            $this->discounts[$data[self::DISCOUNT_REASON]] = 0;
                                        if ($data[self::CURRENCY_COL] == 'MXP') {
                                            $lineDiscount += (float) $data[self::DISCOUNT_AMOUNT];
                                            $this->discounts[$data[self::DISCOUNT_REASON]] += (float) $data[self::DISCOUNT_AMOUNT];
                                        } else {
                                            $lineDiscount += (float) $data[self::FOREIGN_DISCOUNT];
                                            $this->discounts[$data[self::DISCOUNT_REASON]] += (float) $data[self::FOREIGN_DISCOUNT];
                                        }
                                    }
                                    if ($data[self::DISCOUNT_REASON_2]) {
                                        if (!isset($this->discounts[$data[self::DISCOUNT_REASON_2]]))
                                            $this->discounts[$data[self::DISCOUNT_REASON_2]] = 0;
                                        if ($data[self::CURRENCY_COL] == 'MXP') {
                                            $lineDiscount += (float) $data[self::DISCOUNT_AMOUNT_2];
                                            $this->discounts[$data[self::DISCOUNT_REASON_2]] += (float) $data[self::DISCOUNT_AMOUNT_2];
                                        } else {
                                            $lineDiscount += (float) $data[self::FOREIGN_DISCOUNT_2];
                                            $this->discounts[$data[self::DISCOUNT_REASON_2]] += (float) $data[self::FOREIGN_DISCOUNT_2];
                                        }
                                    }
                                    if ($data[self::DISCOUNT_REASON_3]) {
                                        if (!isset($this->discounts[$data[self::DISCOUNT_REASON_3]]))
                                            $this->discounts[$data[self::DISCOUNT_REASON_3]] = 0;
                                        if ($data[self::CURRENCY_COL] == 'MXP') {
                                            $lineDiscount += (float) $data[self::DISCOUNT_AMOUNT_3];
                                            $this->discounts[$data[self::DISCOUNT_REASON_3]] += (float) $data[self::DISCOUNT_AMOUNT_3];
                                        } else {
                                            $lineDiscount += (float) $data[self::FOREIGN_DISCOUNT_3];
                                            $this->discounts[$data[self::DISCOUNT_REASON_3]] += (float) $data[self::FOREIGN_DISCOUNT_3];
                                        }
                                    }
                                    if ($data[self::DISCOUNT_REASON_4]) {
                                        if (!isset($this->discounts[$data[self::DISCOUNT_REASON_4]]))
                                            $this->discounts[$data[self::DISCOUNT_REASON_4]] = 0;
                                        if ($data[self::CURRENCY_COL] == 'MXP') {
                                            $lineDiscount += (float) $data[self::DISCOUNT_AMOUNT_4];
                                            $this->discounts[$data[self::DISCOUNT_REASON_4]] += (float) $data[self::DISCOUNT_AMOUNT_4];
                                        } else {
                                            $lineDiscount += (float) $data[self::FOREIGN_DISCOUNT_4];
                                            $this->discounts[$data[self::DISCOUNT_REASON_4]] += (float) $data[self::FOREIGN_DISCOUNT_4];
                                        }
                                    }
                                    break;
                            }
                            $item->setAttribute('unitPrice', $unitPrice);
                            $totalPrice = (float) trim($data[self::ITEM_QTY]) * $unitPrice;
                            $subTotal += $totalPrice;

    //                        $item->setAttribute('importe', $totalPrice);
                            $itemAttributes = $item->appendChild($this->nativeXml->createElement('Characteristics'));
                            $lts = 0;
                            $itemAttribute = $itemAttributes->appendChild($this->nativeXml->createElement('Characteristic'));
                            $cfdItemHasCustomsPermits = $item->appendChild($this->nativeXml->createElement('CfdItemHasCustomsPermits'));

                            $lts += (float) $data[self::QUANTITY_IN_LT_COL];
                            $itemAttribute->setAttribute('className', 'CfdItem');
                            $itemAttribute->setAttribute('code', 'lts');
                            $itemAttribute->setAttribute('value', $lts);
                            // Check tax type
                            if (!$data[self::TAX_TYPE]) throw new CException(yii::t('app', '[{row},{col}] Item tax type cannot be null', array('{row}' => $this->row,
                                            '{col}' => self::TAX_TYPE)));
                            // Check tax rate
                            if (!$data[self::TAX_RATE]) throw new CException(yii::t('app', '[{row},{col}] Item tax rate cannot be null', array('{row}' => $this->row,
                                            '{col}' => self::TAX_RATE)));

                            $taxAmt = ($totalPrice - $lineDiscount) * (float) trim($data[self::TAX_RATE]);
                            if (!isset($this->taxes[$data[self::TAX_TYPE]]) || !isset($this->taxes[$data[self::TAX_TYPE]][$data[self::TAX_RATE]]))
                                $this->taxes[$data[self::TAX_TYPE]][$data[self::TAX_RATE]] = 0;

                            $this->taxes[$data[self::TAX_TYPE]][$data[self::TAX_RATE]] += $taxAmt;
                        }
                        // Process customs permit
                        if ($data[self::CUSTOMS_DOCUMENT_NUMBER_COL]) {
                            $cfdItemHasCustomsPermit = $cfdItemHasCustomsPermits->appendChild($this->nativeXml->createElement('CfdItemHasCustomsPermit'));
                            $cfdItemHasCustomsPermit->setAttribute('CustomsPermit_id', $this->testCustomsPermit($data)->id);
                        }
//                        $discount += $lineDiscount;
//
                    } else {
                        $note = $notes->appendChild($this->nativeXml->createElement('CfdNote'));
                        $note->setAttribute('value', $data[self::PRODUCT_DESCRIPTION_COL_1] . " " . $data[self::PRODUCT_DESCRIPTION_COL_2]);
                    }
                }
            }
            if ($this->invoice) {
                $descuentos = $this->invoice->appendChild($this->nativeXml->createElement('Descuentos'));
                foreach ($this->discounts as $reason => $amt) {
                    $descuento = $descuentos->appendChild($this->nativeXml->createElement('Descuento'));
                    $descuento->setAttribute('motivo', $reason);
                    $descuento->setAttribute('importe', $amt);
                }
                $this->discounts = array();
                foreach ($this->taxes as $type => $tax) {
                    $cfdTax = $cfdTaxes->appendChild($this->nativeXml->createElement('CfdTax'));
                    $cfdTax->setAttribute('name', $type);
                    foreach ($tax as $rate => $amt) {
                        $cfdTax->setAttribute('rate', $rate * 100);
                        $cfdTax->setAttribute('amt', $amt);
                        $cfdTax->setAttribute('local', 0);
                        $cfdTax->setAttribute('withHolding', 0);
                    }
                }
                $this->taxes = array();
//                        $this->invoice->setAttribute('subTotal', $subTotal);
//                        $subTotal = 0;
//                        $this->invoice = false;
//                        $isPemexInvoiceWithPreInvoice = false;
//                        $noteCount = 1;
            }
            // Save native XML
            $this->nativeXml->save($nativeXmlFile);

            XmlHelper::loadXml($this->nativeXml);

//            Cfd::loadNativeXml($nativeXmlFile);

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

    private function saveInvoice() {
        $descuentos = $this->invoice->appendChild($this->nativeXml->createElement('Descuentos'));
        foreach ($this->discounts as $reason => $amt) {
            $descuento = $descuentos->appendChild($this->nativeXml->createElement('Descuento'));
            $descuento->setAttribute('motivo', $reason);
            $descuento->setAttribute('importe', $amt);
        }
        $this->discounts = array();
        foreach ($this->taxes as $type => $tax) {
            $cfdTax = $cfdTaxes->appendChild($this->nativeXml->createElement('CfdTax'));
            $cfdTax->setAttribute('name', $type);
            foreach ($tax as $rate => $amt) {
                $cfdTax->setAttribute('rate', $rate * 100);
                $cfdTax->setAttribute('amt', $amt);
                $cfdTax->setAttribute('local', 0);
                $cfdTax->setAttribute('withHolding', 0);
            }
        }
        $this->taxes = array();
        $lts = 0;
    }
    private function testVendor($data) {
        // Vendor validations

        // Test RFC
        if (!$data[self::VENDOR_RFC_COL])
            throw new CException(yii::t('app', 'Vendor RFC cannot be null'));

        try {
            SatHelper::validateRfc($data[self::VENDOR_RFC_COL]);
        } catch (CException $e) {
            throw new CException(yii::t('app', 'Invalid vendor RFC "{rfc}".', array('{rfc}' => $data[self::VENDOR_RFC_COL])));
        }

        if (!$data[self::VENDOR_NAME_COL])
            throw new CException(yii::t('app', 'Vendor name cannot be null'));

        // Vendor data is correct.
        // Find if vendor exists in DB.
        $vendorRfc = PartyIdentifier::model()->current()->find('name = :name and value = :value', array(':name' => PartyIdentifier::RFC, ':value' => $data[self::VENDOR_RFC_COL]));
        if (!$vendorRfc) {
            // Vendor does not exists.
            // Create
            $party = new Party();
            $party->name = $data[self::VENDOR_NAME_COL];
            $party->identifiers[PartyIdentifier::RFC] = $data[self::VENDOR_RFC_COL];
            $party->save();
        } else {
            $party = $vendorRfc->party;
            // Test if name has changed
            if ($party->name != $data[self::VENDOR_NAME_COL]) {
                $party->name = $data[self::VENDOR_NAME_COL];
                $party->save();
            }
        }
        return $party;
    }
    private function testCustomer($data) {
        // Test Customer Code
        if (!$data[self::BP_CUSTOMER_CODE_COL]) throw new CException(yii::t('app', 'BP Customer code cannot be null'));

        // Test RFC
        if (!$data[self::CUSTOMER_RFC_COL]) throw new CException(yii::t('app', 'Customer RFC cannot be null'));

        try {
            SatHelper::validateRfc($data[self::CUSTOMER_RFC_COL]);
        } catch (CException $e) {
            throw new CException(yii::t('app', 'Invalid customer RFC "{rfc}".', array('{rfc}' => $data[self::CUSTOMER_RFC_COL])));
        }

        if (!$data[self::CUSTOMER_NAME_COL]) throw new CException(yii::t('app', 'Customer name cannot be null'));

        // Vendor data is correct.
        // Find if vendor exists in DB.
        $customerCode = PartyIdentifier::model()->current()->find('name = :name and value = :value', array(':name' => PartyIdentifier::CUSTOMER_CODE, ':value' => $data[self::BP_CUSTOMER_CODE_COL]));
        if (!$customerCode) {
            // Customer does not exists.
            // Create
            $party = new Party();
            $party->name = $data[self::CUSTOMER_NAME_COL];
            $party->identifiers[PartyIdentifier::RFC] = $data[self::CUSTOMER_RFC_COL];
            $party->identifiers[PartyIdentifier::CUSTOMER_CODE] = $data[self::BP_CUSTOMER_CODE_COL];
            $party->save();
        } else {
            $party = $customerCode->party;
            // Test if name has changed
            if ($party->name != $data[self::CUSTOMER_NAME_COL]) {
                $party->name = $data[self::CUSTOMER_NAME_COL];
                $party->save();
            }
            // Test if RFC has changed
            if ($party->identifiers[PartyIdentifier::RFC] != $data[self::CUSTOMER_RFC_COL]) {
                $party->identifiers[PartyIdentifier::RFC] = $data[self::CUSTOMER_RFC_COL];
                $party->save();
            }
        }
        return $party;
    }

    private function testCertificate($data) {
        // Find current certificate
        $certificate = SatCertificate::model()->current()->find('rfc = :rfc', array(':rfc' => $data[self::VENDOR_RFC_COL]));
        if (!$certificate) throw new CException(yii::t('app', 'Valid SAT certificate for RFC "{rfc}" cannot be found.', array('{rfc}' => $data[self::VENDOR_RFC_COL])));
        return $certificate;
    }

    private function testCustomsPermit($data) {
        // Find customs permit in DB
        $custPermit = CustomsPermit::model()->find('nbr = :nbr', array(':nbr' => $data[self::CUSTOMS_DOCUMENT_NUMBER_COL]));
        if (!$custPermit) {
            if (!trim($data[self::CUSTOMS_DOCUMENT_DATE_COL]))
                throw new CException(yii::t('app', '[{row},{col}] Date for customs permit Nº "{nbr}" cannot be null.', array('{row}' => $this->row,
                            '{col}' => self::CUSTOMS_DOCUMENT_DATE_COL,
                            '{nbr}' => $custPermit->nbr)));
            $customsDt = DateTime::createFromFormat("Y/m/d", trim($data[self::CUSTOMS_DOCUMENT_DATE_COL]));
            if (!$customsDt)
                throw new CException(yii::t('app', '[{row},{col}] Invalid date "{date}" for customs permit Nº "{nbr}".', array('{row}' => $this->row,
                            '{col}' => self::CUSTOMS_DOCUMENT_DATE_COL, '{date}' => trim($data[self::CUSTOMS_DOCUMENT_DATE_COL]),
                            '{nbr}' => $custPermit->nbr)));

            $custPermit = new CustomsPermit();
            $custPermit->nbr = trim($data[self::CUSTOMS_DOCUMENT_NUMBER_COL]);
            $custPermit->dt = $customsDt->format("Y-m-d");
            if (trim($data[self::CUSTOMS_NAME_COL])) $custPermit->office = trim($data[self::CUSTOMS_NAME_COL]);
            $custPermit->save();
        }
        return $custPermit;
    }

    private function testAddress($data, $addressType) {

        $addressRec = new Address();

        switch ($addressType) {
            case AddressType::PRIMARY:
                // PROCESS VENDOR FISCAL ADDRESS
                if (!$data[self::VENDOR_ADDRESS_STREET_COL])
                    throw new CException(yii::t('app', 'Vendor primary address street cannot be null.'));
                else
                    $addressRec->street = $data[self::VENDOR_ADDRESS_STREET_COL];
                if ($data[self::VENDOR_ADDRESS_EXTNUM_COL])
                    $addressRec->extNbr = $data[self::VENDOR_ADDRESS_EXTNUM_COL];
                if ($data[self::VENDOR_ADDRESS_INTNUM_COL])
                    $addressRec->intNbr = $data[self::VENDOR_ADDRESS_INTNUM_COL];
                if (!$data[self::VENDOR_ADDRESS_NEIGHBOURHOOD_COL])
                    throw new CException(yii::t('app', 'Vendor primary address municipality cannot be null.'));
                else
                    $addressRec->neighbourhood = $data[self::VENDOR_ADDRESS_NEIGHBOURHOOD_COL];
                if ($data[self::VENDOR_ADDRESS_CITY_COL])
                    $addressRec->municipality = $data[self::VENDOR_ADDRESS_CITY_COL];
                if (!$data[self::VENDOR_ADDRESS_ZIPCODE_COL])
                    throw new CException(yii::t('app', 'Vendor primary address zip code cannot be null.'));
                else
                    $addressRec->zipCode = substr('00000' . $data[self::VENDOR_ADDRESS_ZIPCODE_COL], -5);
                if (!$data[self::VENDOR_ADDRESS_COUNTRY_COL])
                    throw new CException(yii::t('app', 'Vendor primary address country cannot be null.'));
                else
                    $addressRec->country = $data[self::VENDOR_ADDRESS_COUNTRY_COL];
                if (!$data[self::VENDOR_ADDRESS_STATE_COL])
                    throw new CException(yii::t('app', 'Vendor primary address state cannot be null.'));
                else
                    $addressRec->state = $data[self::VENDOR_ADDRESS_STATE_COL];
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
        $address = Address::model()->find('md5 = :md5', array(':md5' => $addressRec->Md5));
        if (!$address)
            $addressRec->save();
        else
            $addressRec = $address;
        return $addressRec;
    }

    private function testHeader($data) {
        // Vendor validations
        if (!$data[self::VENDOR_RFC_COL]) throw new CException(yii::t('app', 'Vendor RFC cannot be null'));
        try {
            SatRfc::validate($data[self::VENDOR_RFC_COL]);
        } catch (CException $e) {
            throw new CException(yii::t('app', 'Invalid vendor RFC "{rfc}".', array('{rfc}' => $data[self::VENDOR_RFC_COL])));
        }
        if (!$data[self::VENDOR_NAME_COL]) throw new CException(yii::t('app', 'Vendor name cannot be null'));

        // Customer validations
        if (!$data[self::CUSTOMER_RFC_COL]) throw new CException(yii::t('app', 'Customer RFC cannot be null'));
        try {
            SatRfc::validate($data[self::CUSTOMER_RFC_COL]);
        } catch (CException $e) {
            throw new CException(yii::t('app', 'Invalid customer RFC "{rfc}".', array('{rfc}' => $data[self::CUSTOMER_RFC_COL])));
        }

        if (!$data[self::BP_CUSTOMER_CODE_COL]) throw new CException(yii::t('app', 'Customer code cannot be null'));

        if (!$data[self::CUSTOMER_NAME_COL]) throw new CException(yii::t('app', 'Customer name cannot be null'));

        // Check Invoice Type
        if (!$data[self::INVOICE_DOC_TYPE]) throw new CException(yii::t('app', 'Invoice type cannot be null.'));
        switch ($data[self::INVOICE_DOC_TYPE]) {
            case 'INGRESO':
            case 'EGRESO':
                break;
            default:
                throw new CException(yii::t('app', 'Invalid invoice type "{type}". Valid types are INGRESO or EGRESO', array('{type}' => $data[self::INVOICE_DOC_TYPE])));
        }

        if (!$data[self::BP_ORDER_NBR_COL]) throw new CException(yii::t('app', 'BP Order Nº cannot be null.'));
        if (!$data[self::TIME_OF_DAY_COL]) throw new CException(yii::t('app', 'Invoice time cannot be null'));
        if (!$data[self::INVOICE_DATE_COL]) throw new CException(yii::t('app', 'Invoice date cannot be null'));

        // Validate payment term
        $paymentTerm = trim($data[self::INVOICE_PAYMENT_TERM]);
        if (!$data[self::INVOICE_PAYMENT_TERM]) throw new CException(yii::t('app', 'Payment term cannot be null'));

        // Check if payment term exists
        $paymentTermRec = PaymentTerm::model()->find('name = :name', array(':name' => $data[self::INVOICE_PAYMENT_TERM]));
        if (!$paymentTermRec) throw new CException(yii::t('app', 'Payment term "{term}" does not exists.', array('{term}' => $data[self::INVOICE_PAYMENT_TERM])));

        // Validate invoice currency
        if (!$data[self::CURRENCY_COL]) throw new CException(yii::t('app', 'Invoice currency cannot be null'));

        // Validate currency exchange rate
        if ($data[self::CURRENCY_COL] != 'MXP')
            if (!$data[self::CURRENCY_RATE_COL]) throw new CException(yii::t('app', 'Invoice currency exchange rate cannot be null'));

        // Validate promised date
        $promisedDate = new DateTime($data[self::PROMISED_DATE_COL]);
        if (!$promisedDate) throw new CException(yii::t('app', 'Promised date format is invalid: "{promisedDt}"', array('{promisedDt}' => $data[self::PROMISED_DATE_COL])));

        // Validate transaction order date
        $transactionOrderDt = new DateTime($data[self::TRANSACTION_ORDER_DATE_COL]);
        if (!$transactionOrderDt) throw new CException(yii::t('app', 'Transaction order date format is invalid: "{transactionOrderDt}"', array('{transactionOrderDt}' => $data[self::TRANSACTION_ORDER_DATE_COL])));

        return;
    }

    private function testDttm($data) {
        // Validate invoice date time
        $invoiceTmStr = $data[self::TIME_OF_DAY_COL];
        if (strlen($invoiceTmStr) == 5) $invoiceTmStr = '0' . $invoiceTmStr;

        $invoiceTm = DateTime::createFromFormat("His", $invoiceTmStr);
        if (!$invoiceTm) throw new CException(yii::t('app', 'Invalid invoice time "{tm}".', array('{tm}' => $data[self::TIME_OF_DAY_COL])));

        $invoiceDt = new DateTime($data[self::INVOICE_DATE_COL]);
        if (!$invoiceDt) throw new CException(yii::t('app', 'Invalid invoice date "{dt}".', array('{dt}' => $data[self::INVOICE_DATE_COL])));

        $invoiceDttm = DateTime::createFromFormat("Y-m-d H:i:s", $invoiceDt->format("Y-m-d") . " " . $invoiceTm->format("H:i:s"), new DateTimeZone('EDT'));
        $invoiceDttm->setTimeZone(new DateTimeZone('CDT'));
        return $invoiceDttm;
    }
}

?>
