<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TamaProcessIncomingInvoiceFile
 *
 * @author jmariani
 */
class TamaProcessIncomingInvoiceFileCommand extends CConsoleCommand {
    const MASTER_ACCOUNT_ALIAS = 'TAMA';
    const DEFAULT_PAYMENT_TYPE_VALUE = 'PAGO EN UNA SOLA EXHIBICION';
    const DEFAULT_PAYMENT_METHOD = 'NO DEFINIDO';
    const DEFAULT_CURRENCY_CODE = 'MXN';
    const DEFAULT_EXCHANGE_RATE = 1;

    private $fileName;
    private $fileLog;
    private $fileError;
    private $errors = array();

    private function log($msg, $logFile = NULL) {
        // Always save to process log.
        yii::log($msg, CLogger::LEVEL_INFO, $this->name);
        error_log('[' . date(DateTime::ISO8601) . '] ' . $msg . PHP_EOL, 3, (($logFile) ?:'/tmp/' . $this->name . '.log'));
    }

    public function run($args) {

        // 1) LOCK FILE
        // 2) When file is locked, try to open it.
        // 3) Tama file is a XML file. Validate the file against a schema found in INCOMING_INVOICE_FILE_XSD
        // 4) Run additional validations that cannot be performed with the schema.
        // 5) Produce a native XML and save it to NATIVE_XML_PATH

//        print_r($args);

        libxml_use_internal_errors(true);
        $this->fileName = $args[0];

        $pathInfo = pathinfo($args[0]);

        // This file log file name.
        $this->fileLog = '/tmp/' . basename($args[0], '.xml') . '.log';
        // This file error file name
        $this->fileError = '/tmp/' . basename($args[0], '.xml') . '.err';

        // Delete this file log.
        @unlink($this->fileLog);
        // Delete this file error file.
        @unlink($this->fileError);

        yii::log(yii::t('app', 'Processing file {file}', array('{file}' => $args[0])), CLogger::LEVEL_INFO, $this->name);

        try {
            // Load master account information.
//            $masterAccount = MasterAccount::model()->with('masterAccountAttributes')->find('alias = :alias', array(':alias' => self::MASTER_ACCOUNT_ALIAS));
            $masterAccount = MasterAccount::model()->find('alias = :alias', array(':alias' => self::MASTER_ACCOUNT_ALIAS));
            if (!$masterAccount) {
                throw new Exception(yii::t('app', 'Master Account alias "{alias}" not found.', array('{alias}' => self::MASTER_ACCOUNT_ALIAS)));
            }
            // Check if file exists
            if (!file_exists($args[0])) {
                throw new Exception(yii::t('app', 'File {file} not found.', array('{file}' => $args[0])));
            }
            // Try to lock file to ensure is not still be written.
            $fp = fopen($args[0], 'r');
            while (!flock($fp, LOCK_EX)) {
                yii::log(yii::t('app', 'Waiting to lock file {file}', array('{file}' => $args[0])), CLogger::LEVEL_INFO, $args[0]);
            }
            flock($fp, LOCK_UN);
            // File was succesfully locked, so we can open it.
            // Test if the file is a proper XML.
            $xml = new DOMDocument();
            if (!$xml->load($args[0])) {
                $xmlErrors = libxml_get_errors();
                $msg = '';
                foreach ($xmlErrors as $xmlError) {
                    yii::log('[' . $pathInfo['basename'] . '][LIBXML][' . $xmlError->code . '] ' . $xmlError->message, CLogger::LEVEL_ERROR, $this->name);
                }
            } else {
                // The file is a valid XML.
                // Check the XML against the Schema
                // Get schema
                $xsd = $masterAccount->masterAccountAttributes(array('condition' => "code = 'INCOMING_INVOICE_FILE_XSD'"));
                if (!$xsd) {
                    throw new Exception(yii::t('app', 'Master Account attribute "{attr}" not found.', array('{attr}' => self::MASTER_ACCOUNT_ALIAS . '->INCOMING_INVOICE_FILE_XSD')));
                } else {
                    if (!file_exists($xsd[0]->value)) {
                        throw new Exception(yii::t('app', 'File {file} not found.', array('{file}' => $xsd[0]->value)));
                    }
                    if (!$xml->schemaValidate($xsd[0]->value)) {
                        $xmlErrors = libxml_get_errors();
                        $msg = '';
                        foreach ($xmlErrors as $xmlError) {
                            yii::log('[' . $pathInfo['basename'] . '][LIBXML][' . $xmlError->code . '] ' . $xmlError->message, CLogger::LEVEL_ERROR, $this->name);
                        }
                    }
                    // Get master account cfd version
                    $cfdVersion = $masterAccount->masterAccountAttributes(array('condition' => "code = 'CFD_VERSION'"));
                    // Process and create Native XML
                    $xml = simplexml_load_file($args[0]);
                    // Create XML file
                    $nativeXml = new DOMDocument("1.0","UTF-8");
                    $root = $nativeXml->createElement('invoices');
                    $root = $nativeXml->appendChild($root);
                    foreach ($xml->children() as $xmlInvoice) {
                        $subTotal = 0;
                        $invoice = $root->appendChild($nativeXml->createElement('invoice'));
                        $invoice->setAttribute('version', $cfdVersion[0]->value);
                        foreach ($xmlInvoice->attributes() as $attributeName => $attributeValue) {
                            switch ($attributeName) {
                                case 'documentType':
                                    $invoice->setAttribute('voucherType', (string)$attributeValue);
//                                    switch ($attributeValue) {
//                                        case 0:
//                                            $invoice->setAttribute('voucherType', 'ingreso');
//                                            break;
//                                        case 1:
//                                            $invoice->setAttribute('voucherType', 'egreso');
//                                            break;
//                                        case 2:
//                                            $invoice->setAttribute('voucherType', 'traslado');
//                                            break;
//                                    }
                                    break;
                                default:
                                    $invoice->setAttribute($attributeName, $attributeValue);
                            }
                        }
                        // Process nodes
                        foreach ($xmlInvoice->children() as $xmlInvoiceNode) {
                            switch ($xmlInvoiceNode->getName()) {
                                case 'vendor':
                                    foreach ($xmlInvoiceNode->attributes() as $attributeName => $attributeValue) {
                                        switch ($attributeName) {
                                            case 'rfc':
                                                $invoice->setAttribute('vendorRfc', (string)$attributeValue);
                                                break;
                                            case 'name':
                                                $invoice->setAttribute('vendorName', (string)$attributeValue);
                                                break;
                                        }
                                    }
                                    // Parse nodes
                                    foreach ($xmlInvoiceNode->children() as $vendorNode) {
                                        switch ($vendorNode->getName()) {
                                            case 'fiscalAddress':
                                                // Create vendorFiscalAddress node.
                                                $vendorFiscalAddressNode = $invoice->appendChild($nativeXml->createElement('vendorFiscalAddress'));
                                                foreach ($vendorNode->attributes() as $attributeName => $attributeValue) {
                                                    switch ($attributeName) {
                                                        case 'colony':
                                                            $vendorFiscalAddressNode->setAttribute('neighbourhood', (string)$attributeValue);
                                                            break;
                                                        case 'county':
                                                            $vendorFiscalAddressNode->setAttribute('municipality', (string)$attributeValue);
                                                            break;
                                                        default:
                                                            $vendorFiscalAddressNode->setAttribute($attributeName, (string)$attributeValue);
                                                    }
                                                }
                                                break;
                                        }
                                    }
                                    break;
                                case 'customer':
                                    foreach ($xmlInvoiceNode->attributes() as $attributeName => $attributeValue) {
                                        switch ($attributeName) {
                                            case 'rfc':
                                                $invoice->setAttribute('customerRfc', (string)$attributeValue);
                                                break;
                                            case 'name':
                                                $invoice->setAttribute('customerName', (string)$attributeValue);
                                                break;
                                            default:
                                                // everything else will be attributes.
                                                $invoice->setAttribute('customer' . ucwords($attributeName), (string)$attributeValue);
                                                break;
                                        }
                                    }
                                    // Parse nodes
                                    foreach ($xmlInvoiceNode->children() as $customerNode) {
                                        switch ($customerNode->getName()) {
                                            case 'customerFiscalAddress':
                                                // Create vendorFiscalAddress node.
                                                $customerBillToAddressNode = $invoice->appendChild($nativeXml->createElement('customerBillToAddress'));
                                                foreach ($customerNode->attributes() as $attributeName => $attributeValue) {
                                                    switch ($attributeName) {
                                                        case 'colony':
                                                            $customerBillToAddressNode->setAttribute('neighbourhood', (string)$attributeValue);
                                                            break;
                                                        case 'county':
                                                            $customerBillToAddressNode->setAttribute('municipality', (string)$attributeValue);
                                                            break;
                                                        default:
                                                            $customerBillToAddressNode->setAttribute($attributeName, (string)$attributeValue);
                                                    }
                                                }
                                                break;
                                            case 'shipToAddress':
                                                // Create vendorFiscalAddress node.
                                                $customerShipToAddressNode = $invoice->appendChild($nativeXml->createElement('customerShipToAddress'));
                                                foreach ($customerNode->attributes() as $attributeName => $attributeValue) {
                                                    switch ($attributeName) {
                                                        case 'colony':
                                                            $customerShipToAddressNode->setAttribute('neighbourhood', (string)$attributeValue);
                                                            break;
                                                        case 'county':
                                                            $customerShipToAddressNode->setAttribute('municipality', (string)$attributeValue);
                                                            break;
                                                        default:
                                                            $customerShipToAddressNode->setAttribute($attributeName, (string)$attributeValue);
                                                    }
                                                }
                                                // Find additional information
                                                foreach ($customerNode->children() as $customerShipToAddressNode) {
                                                    switch ($customerShipToAddressNode->getName()) {
                                                        case 'shipToCustomer':
                                                            foreach ($customerShipToAddressNode->attributes() as $attributeName => $attributeValue) {
                                                                $invoice->setAttribute('customerShipTo' . ucwords($attributeName), (string)$attributeValue);
                                                            }
                                                            break;
                                                    }
                                                }
                                                break;
                                        }
                                    }
                                    break;
                                case 'items':
                                    $items = $invoice->appendChild($nativeXml->createElement('items'));
                                    // Process invoice items.
                                    foreach ($xmlInvoiceNode->children() as $invoiceItem) {
                                        $item = $items->appendChild($nativeXml->createElement('item'));
                                        foreach ($invoiceItem->attributes() as $attributeName => $attributeValue) {
                                            switch ($attributeName) {
                                                case 'amount':
                                                    $subTotal += (float)$attributeValue;
                                                    $item->setAttribute($attributeName, (string)$attributeValue);
                                                    break;
                                                default:
                                                    $item->setAttribute($attributeName, (string)$attributeValue);
                                            }
                                            $item->setAttribute($attributeName, (string)$attributeValue);
                                        }
                                        // Customs permit
                                        foreach ($invoiceItem->children() as $invoiceItemNode) {
                                            switch ($invoiceItemNode->getName()) {
                                                case 'customsPermit':
                                                    $customsPermit = $item->appendChild($nativeXml->createElement('customsPermit'));
                                                    foreach ($invoiceItemNode->attributes() as $attributeName => $attributeValue) {
                                                        switch ($attributeName) {
                                                            case 'customsPermitNbr':
                                                                $customsPermit->setAttribute('nbr', (string)$attributeValue);
                                                                break;
                                                            case 'customsOffice':
                                                                $customsPermit->setAttribute('custom', (string)$attributeValue);
                                                                break;
                                                            case 'customsPermitDate':
                                                                $customsPermit->setAttribute('date', (string)$attributeValue);
                                                                break;
                                                        }
                                                    }
                                            }
                                        }
                                    }
                                    break;
                                case 'taxes':
                                    $taxes = $invoice->appendChild($nativeXml->createElement('taxes'));
                                    // Process invoice taxes.
                                    foreach ($xmlInvoiceNode->children() as $invoiceTax) {
                                        $tax = $taxes->appendChild($nativeXml->createElement('tax'));
                                        foreach ($invoiceTax->attributes() as $attributeName => $attributeValue) {
                                            switch ($attributeName) {
                                                case 'taxName':
                                                    $tax->setAttribute('name', yii::t('app', (string)$attributeValue));
                                                    break;
                                                case 'taxRate':
                                                    $tax->setAttribute('rate', (float)$attributeValue);
                                                    break;
                                                case 'taxAmount':
                                                    $tax->setAttribute('amt', (float)$attributeValue);
                                                    break;
                                            }
                                        }
                                    }
                            }
                        }
                        $invoice->setAttribute('subTotal', $subTotal);
                    }
                    $nativeXmlPath = $masterAccount->masterAccountAttributes(array('condition' => "code = 'NATIVE_XML_PATH'"));
                    $nativeXml->save($nativeXmlPath[0]->value . DIRECTORY_SEPARATOR . $pathInfo['basename']);
                }
                // Get TAMA xsd.
//                foreach ($xml->children() as $xmlInvoice) {
//                    // FOLIO
//                    // Rules:
//                    // 1) Required
//                    // 2) Must be numeric
//                    $msg = '[INFO] ' . yii::t('app', 'Validating attribute "{attr}".', array('{attr}' => 'folio'));
//                    $this->log($msg);
//                    $this->log($msg, $this->fileLog);
//
//                    $folio = (string)$xmlInvoice->attributes()->folio;
//                    // Check if folio attribute is not missing.
//                    if (!$folio) {
//                        $msg = '[ERROR] ' . yii::t('app', 'Required attribute "{attr}" missing.', array('{attr}' => 'folio'));
//                        $this->log($msg);
//                        $this->log($msg, $this->fileLog);
//                        $this->errors[] = $msg;
//                        throw new Exception($msg);
//                    } else {
//                        // Check if folio attribute is numeric
//                        if (!is_numeric($folio)) {
//                            $msg = '[ERROR] ' . yii::t('app', 'Attribute "{attr}" must be a number. Value passed: {value}',
//                                    array('{attr}' => 'folio', '{value}' => $folio));
//                            $this->log($msg);
//                            $this->log($msg, $this->fileLog);
//                            $this->errors[] = $msg;
//                            throw new Exception($msg);
//                        } else {
//                            $msg = '[INFO] ' . yii::t('app', 'Validating invoice {folio}', array('{folio}' => $folio));
//                            $this->log($msg);
//                            $this->log($msg, $this->fileLog);
//                        }
//                    }
//                    // DATE
//                    // Rules:
//                    // 1) Required
//                    // 2) Must be a valid date.
//                    // 3) Must not be older than 72 Hs.
//                    $msg = '[INFO] ' . yii::t('app', 'Validating attribute "{attr}".', array('{attr}' => 'date'));
//                    $this->log($msg);
//                    $this->log($msg, $this->fileLog);
//                    $date = (string)$xmlInvoice->attributes()->date;
//                    // Check if date attribute is not missing.
//                    if (!$date) {
//                        $msg = '[ERROR] ' . yii::t('app', 'Required attribute "{attr}" missing.', array('{attr}' => 'date'));
//                        $this->log($msg);
//                        $this->log($msg, $this->fileLog);
//                        $this->errors[] = $msg;
//                        throw new Exception($msg);
//                    } else {
//                        // Check if "date" attribute is a valid date.
//                        $invoiceDt = new DateTime($date);
//                        if (!$invoiceDt) {
//                            $msg = '[ERROR] ' . yii::t('app', 'Attribute "{attr}" must be a valid date. Value passed: {value}',
//                                    array('{attr}' => 'date', '{value}' => $date));
//                            $this->log($msg);
//                            $this->log($msg, $this->fileLog);
//                            $this->errors[] = $msg;
//                            throw new Exception($msg);
//                        } else {
//                            // Check if the date is more than 72 Hs old.
//                            $now = new DateTime();
//                            $dateDiff = abs($now->format('U') - $invoiceDt->format('U'));
//                            // 72 * 60 * 60
//                            if ($dateDiff >= 259200) {
//                                $msg = '[ERROR] ' . yii::t('app', 'Invoice date is more than {hs} Hs. old. Value passed: {value}', array('{hs}' => 72, '{value}' => $date));
//                                $this->log($msg);
//                                $this->log($msg, $this->fileLog);
//                                $this->errors[] = $msg;
//                                throw new Exception($msg);
//                            }
//                        }
//                    }
//                    // PAYMENT TYPE
//                    // Rules:
//                    // 1) Optional. If missing defaults to DEFAULT_PAYMENT_TYPE_VALUE
//                    $msg = '[INFO] ' . yii::t('app', 'Validating attribute "{attr}".', array('{attr}' => 'paymentType'));
//                    $this->log($msg);
//                    $this->log($msg, $this->fileLog);
//                    $paymentType = (string)$xmlInvoice->attributes()->paymentType;
//                    if (!$paymentType) {
//                        // Set payment type to default value.
//                        $msg = '[INFO] ' . yii::t('app', 'Attribute "{attr}" not found or null. Setting value to default value "{value}"', array('{attr}' => 'paymentType', '{value}' => self::DEFAULT_PAYMENT_TYPE_VALUE));
//                        $this->log($msg);
//                        $this->log($msg, $this->fileLog);
//                    }
//                    // PAYMENT TERM
//                    // Rules:
//                    // 1) Optional.
//                    // 2) Free form text.
//                    $msg = '[INFO] ' . yii::t('app', 'Validating attribute "{attr}".', array('{attr}' => 'paymentTerm'));
//                    $this->log($msg);
//                    $this->log($msg, $this->fileLog);
//                    $paymentTerm = (string)$xmlInvoice->attributes()->paymentTerm;
//                    if (!$paymentTerm) {
//                        // Set payment type to default value.
//                        $msg = '[INFO] ' . yii::t('app', 'Attribute "{attr}" not found or null.', array('{attr}' => 'paymentTerm'));
//                        $this->log($msg);
//                        $this->log($msg, $this->fileLog);
//                    }
//                    // DOCUMENT TYPE
//                    // Rules:
//                    // 1) Required
//                    // 2) Valid values:
//                    //      0: Invoice
//                    //      1: Credit note
//                    $msg = '[INFO] ' . yii::t('app', 'Validating attribute "{attr}".', array('{attr}' => 'documentType'));
//                    $this->log($msg);
//                    $this->log($msg, $this->fileLog);
//                    $documentType = (string)$xmlInvoice->attributes()->documentType;
//                    switch ($documentType) {
//                        case '0':
//                        case '1':
//                            break;
//                        default:
//                            $msg = '[ERROR] ' . yii::t('app', 'Required attribute "{attr}" missing or invalid. Passed value: {value}', array('{attr}' => 'documentType', '{value}' => $documentType));
//                            $this->log($msg);
//                            $this->log($msg, $this->fileLog);
//                            $this->errors[] = $msg;
//                            throw new Exception($msg);
//                    }
//                    // DISCOUNT
//                    // Rules:
//                    // 1) Optional
//                    // 2) If present, must be positive numeric.
//                    $msg = '[INFO] ' . yii::t('app', 'Validating attribute "{attr}".', array('{attr}' => 'discount'));
//                    $this->log($msg);
//                    $this->log($msg, $this->fileLog);
//                    $discount = (float)$xmlInvoice->attributes()->discount;
//                    if ($discount) {
//                        if (!is_numeric($discount)) {
//                            $msg = '[ERROR] ' . yii::t('app', 'Attribute "{attr}" is invalid. Passed value: {value}', array('{attr}' => 'discount', '{value}' => $discount));
//                            $this->log($msg);
//                            $this->log($msg, $this->fileLog);
//                            $this->errors[] = $msg;
//                            throw new Exception($msg);
//                        } else {
//                            if ($discount < 0) {
//                                $msg = '[ERROR] ' . yii::t('app', 'Attribute "{attr}" must be positive. Passed value: {value}', array('{attr}' => 'discount', '{value}' => $discount));
//                                $this->log($msg);
//                                $this->log($msg, $this->fileLog);
//                                $this->errors[] = $msg;
//                                throw new Exception($msg);
//                            }
//                        }
//                    }
//                    // DISCOUNT REASON
//                    // Rules:
//                    // 1) Optional.
//                    // 2) Free form text.
//                    $msg = '[INFO] ' . yii::t('app', 'Validating attribute "{attr}".', array('{attr}' => 'discountReason'));
//                    $this->log($msg);
//                    $this->log($msg, $this->fileLog);
//                    $discountReason = (string)$xmlInvoice->attributes()->discountReason;
//                    if (!$discountReason) {
//                        $msg = '[INFO] ' . yii::t('app', 'Attribute "{attr}" not found or null.', array('{attr}' => 'discountReason'));
//                        $this->log($msg);
//                        $this->log($msg, $this->fileLog);
//                    }
//                    // CURRENCY
//                    // Rules:
//                    // 1) Optional. If missing defaults to DEFAULT_CURRENCY_CODE
//                    $msg = '[INFO] ' . yii::t('app', 'Validating attribute "{attr}".', array('{attr}' => 'currency'));
//                    $this->log($msg);
//                    $this->log($msg, $this->fileLog);
//                    $currency = (string)$xmlInvoice->attributes()->currency;
//                    if (!$currency) {
//                        // Set currency to default value.
//                        $msg = '[INFO] ' . yii::t('app', 'Attribute "{attr}" not found or null. Setting value to default value "{value}"', array('{attr}' => 'currency', '{value}' => self::DEFAULT_CURRENCY_CODE));
//                        $currency = self::DEFAULT_CURRENCY_CODE;
//                        $this->log($msg);
//                        $this->log($msg, $this->fileLog);
//                    }
//                    // EXCHANGE RATE
//                    // Rules:
//                    // 1) Optional. If missing defaults to DEFAULT_EXCHANGE_RATE
//                    $msg = '[INFO] ' . yii::t('app', 'Validating attribute "{attr}".', array('{attr}' => 'exchangeRate'));
//                    $this->log($msg);
//                    $this->log($msg, $this->fileLog);
//                    $exchangeRate = (string)$xmlInvoice->attributes()->exchangeRate;
//                    if (!$exchangeRate) {
//                        // Set currency to default value.
//                        $msg = '[INFO] ' . yii::t('app', 'Attribute "{attr}" not found or null. Setting value to default value "{value}"', array('{attr}' => 'exchangeRate', '{value}' => self::DEFAULT_EXCHANGE_RATE));
//                        $currency = self::DEFAULT_EXCHANGE_RATE;
//                        $this->log($msg);
//                        $this->log($msg, $this->fileLog);
//                    }
//                    // PAYMENT METHOD
//                    // Rules:
//                    // 1) Required. If missing defaults to DEFAULT_PAYMENT_METHOD
//                    // 2) Free form text.
//                    $msg = '[INFO] ' . yii::t('app', 'Validating attribute "{attr}".', array('{attr}' => 'paymentMethod'));
//                    $this->log($msg);
//                    $this->log($msg, $this->fileLog);
//                    $paymentMethod = (string)$xmlInvoice->attributes()->paymentMethod;
//                    if (!$paymentMethod) {
//                        // Set payment type to default value.
//                        $msg = '[INFO] ' . yii::t('app', 'Attribute "{attr}" not found or null. Setting value to default value "{value}"', array('{attr}' => 'paymentMethod', '{value}' => self::DEFAULT_PAYMENT_METHOD));
//                        $paymentMethod = self::DEFAULT_PAYMENT_METHOD;
//                        $this->log($msg);
//                        $this->log($msg, $this->fileLog);
//                    }
//                    // SHIPPING TERMS
//                    // Rules:
//                    // 1) Optional.
//                    // 2) Free form text.
//                    $msg = '[INFO] ' . yii::t('app', 'Validating attribute "{attr}".', array('{attr}' => 'shippingTerms'));
//                    $this->log($msg);
//                    $this->log($msg, $this->fileLog);
//                    $shippingTerms = (string)$xmlInvoice->attributes()->shippingTerms;
//                    if (!$shippingTerms) {
//                        $msg = '[INFO] ' . yii::t('app', 'Attribute "{attr}" not found or null.', array('{attr}' => 'shippingTerms'));
//                        $this->log($msg);
//                        $this->log($msg, $this->fileLog);
//                    }
//                    // CUSTOMER REFERENCE NBR
//                    // Rules:
//                    // 1) Optional.
//                    // 2) Free form text.
//                    $msg = '[INFO] ' . yii::t('app', 'Validating attribute "{attr}".', array('{attr}' => 'customerReferenceNbr'));
//                    $this->log($msg);
//                    $this->log($msg, $this->fileLog);
//                    $customerReferenceNbr = (string)$xmlInvoice->attributes()->customerReferenceNbr;
//                    if (!$customerReferenceNbr) {
//                        $msg = '[INFO] ' . yii::t('app', 'Attribute "{attr}" not found or null.', array('{attr}' => 'customerReferenceNbr'));
//                        $this->log($msg);
//                        $this->log($msg, $this->fileLog);
//                    }
//                    // CUSTOMER SALES ORDER NBR
//                    // Rules:
//                    // 1) Optional.
//                    // 2) Free form text.
//                    $msg = '[INFO] ' . yii::t('app', 'Validating attribute "{attr}".', array('{attr}' => 'customerSalesOrderNbr'));
//                    $this->log($msg);
//                    $this->log($msg, $this->fileLog);
//                    $customerSalesOrderNbr = (string)$xmlInvoice->attributes()->customerSalesOrderNbr;
//                    if (!$customerSalesOrderNbr) {
//                        $msg = '[INFO] ' . yii::t('app', 'Attribute "{attr}" not found or null.', array('{attr}' => 'customerSalesOrderNbr'));
//                        $this->log($msg);
//                        $this->log($msg, $this->fileLog);
//                    }
//                    // DELIVERY NOTE NBR
//                    // Rules:
//                    // 1) Optional.
//                    // 2) Free form text.
//                    $msg = '[INFO] ' . yii::t('app', 'Validating attribute "{attr}".', array('{attr}' => 'deliveryNoteNbr'));
//                    $this->log($msg);
//                    $this->log($msg, $this->fileLog);
//                    $deliveryNoteNbr = (string)$xmlInvoice->attributes()->deliveryNoteNbr;
//                    if (!$deliveryNoteNbr) {
//                        $msg = '[INFO] ' . yii::t('app', 'Attribute "{attr}" not found or null.', array('{attr}' => 'deliveryNoteNbr'));
//                        $this->log($msg);
//                        $this->log($msg, $this->fileLog);
//                    }
//                    // SHIP DATE ACTUAL
//                    // Rules:
//                    // 1) Optional.
//                    // 2) If present must be a valid date.
//                    $msg = '[INFO] ' . yii::t('app', 'Validating attribute "{attr}".', array('{attr}' => 'shipDateActual'));
//                    $this->log($msg);
//                    $this->log($msg, $this->fileLog);
//                    $shipDateActual = (string)$xmlInvoice->attributes()->shipDateActual;
//                    if (!$shipDateActual) {
//                        $msg = '[INFO] ' . yii::t('app', 'Attribute "{attr}" not found or null.', array('{attr}' => 'shipDateActual'));
//                        $this->log($msg);
//                        $this->log($msg, $this->fileLog);
//                    } else {
//                        $shipDateActualDt = new DateTime($shipDateActual);
//                        if (!$shipDateActualDt) {
//                            $msg = '[ERROR] ' . yii::t('app', 'Attribute "{attr}" must be a valid date. Value passed: {value}',
//                                    array('{attr}' => 'shipDateActual', '{value}' => $shipDateActual));
//                            $this->log($msg);
//                            $this->log($msg, $this->fileLog);
//                            $this->errors[] = $msg;
//                            throw new Exception($msg);
//                        }
//                    }
//                    // NOTES
//                    // Rules:
//                    // 1) Optional.
//                    // 2) Free form text.
//                    $msg = '[INFO] ' . yii::t('app', 'Validating attribute "{attr}".', array('{attr}' => 'notes'));
//                    $this->log($msg);
//                    $this->log($msg, $this->fileLog);
//                    $notes = (string)$xmlInvoice->attributes()->notes;
//                    if (!$notes) {
//                        $msg = '[INFO] ' . yii::t('app', 'Attribute "{attr}" not found or null.', array('{attr}' => 'notes'));
//                        $this->log($msg);
//                        $this->log($msg, $this->fileLog);
//                    }
//
//                    // VENDOR
//                    // Rules:
//                    // 1) Vendor node is required.
//                    $msg = '[INFO] ' . yii::t('app', 'Processing node "{node}".', array('{node}' => 'vendor'));
//                    $this->log($msg);
//                    $this->log($msg, $this->fileLog);
//                    $node = $xmlInvoice->xpath('vendor');
//                    if (!$node) {
//                        $msg = yii::t('app', 'Node "{node}" is required.',
//                                array('{node}' => 'vendor'));
//                        $this->errors[] = $msg;
//                        throw new Exception($msg);
//                    } else {
//                        $vendor = $node[0];
//                        // VENDOR RFC
//                        // Rules:
//                        // 1) Required
//                        // 2) RFC must be a valid RFC.
//                        $msg = '[INFO] ' . yii::t('app', 'Validating attribute "{attr}".', array('{attr}' => 'vendor->rfc'));
//                        $this->log($msg);
//                        $this->log($msg, $this->fileLog);
//                        if (!(string)$vendor->attributes()->rfc) {
//                            $msg = yii::t('app', 'Vendor attribute "{attr}" is required.',
//                                    array('{attr}' => 'rfc'));
//                            $this->errors[] = $msg;
//                            throw new Exception($msg);
//                        } else {
//                            if (SatRfc::validate((string)$vendor->attributes()->rfc)) {
//                                $vendorRfc = (string)$vendor->attributes()->rfc;
//                            }
//                        }
//                        // VENDOR NAME
//                        // Rules:
//                        // 1) Required
//                        // 2) Free form text
//                        $msg = '[INFO] ' . yii::t('app', 'Validating attribute "{attr}".', array('{attr}' => 'vendor->name'));
//                        $this->log($msg);
//                        $this->log($msg, $this->fileLog);
//
//                        $vendorName = (string)$vendor->attributes()->name;
//                        if (!$vendorName) {
//                            $msg = yii::t('app', 'Vendor attribute "{attr}" is required.',
//                                    array('{attr}' => 'name'));
//                            $this->errors[] = $msg;
//                            throw new Exception($msg);
//                        }
//                        // VENDOR FISCAL ADDRESS
//                        // Rules:
//                        // 1) Vendor fiscal address node is required.
//                        $msg = '[INFO] ' . yii::t('app', 'Processing node "{node}".', array('{node}' => 'vendor->fiscalAddress'));
//                        $this->log($msg);
//                        $this->log($msg, $this->fileLog);
//                        $node = $vendor->xpath('fiscalAddress');
//                        if (!$node) {
//                            $msg = yii::t('app', 'Node "{node}" is required.',
//                                    array('{node}' => 'vendor->fiscalAddress'));
//                            $this->errors[] = $msg;
//                            throw new Exception($msg);
//                        } else {
//                            $vendorFiscalAddress = $node[0];
//                            // VENDOR FISCAL ADDRESS STREET
//                            // Rules:
//                            // 1) Required
//                            $msg = '[INFO] ' . yii::t('app', 'Validating attribute "{attr}".', array('{attr}' => 'vendor->fiscalAddress->street'));
//                            $this->log($msg);
//                            $this->log($msg, $this->fileLog);
//                            $vendorFiscalAddressStreet = (string)$vendorFiscalAddress->attributes()->street;
//                            if (!$vendorFiscalAddressStreet) {
//                                $msg = yii::t('app', 'Vendor fiscal address attribute "{attr}" is required.',
//                                        array('{attr}' => 'street'));
//                                $this->errors[] = $msg;
//                                throw new Exception($msg);
//                            }
//                            // VENDOR FISCAL ADDRESS EXTNBR
//                            // Rules:
//                            // 1) Optional
//                            $msg = '[INFO] ' . yii::t('app', 'Validating attribute "{attr}".', array('{attr}' => 'vendor->fiscalAddress->extNbr'));
//                            $this->log($msg);
//                            $this->log($msg, $this->fileLog);
//                            $vendorFiscalAddressExtNbr = (string)$vendorFiscalAddress->attributes()->extNbr;
//                            if (!$vendorFiscalAddressExtNbr) {
//                                $msg = '[INFO] ' . yii::t('app', 'Vendor fiscal address attribute "{attr}" missing or is null', array('{attr}' => 'vendor->fiscalAddress->extNbr'));
//                                $this->log($msg);
//                                $this->log($msg, $this->fileLog);
//                            }
//                            // VENDOR FISCAL ADDRESS INTNBR
//                            // Rules:
//                            // 1) Optional
//                            $msg = '[INFO] ' . yii::t('app', 'Validating attribute "{attr}".', array('{attr}' => 'vendor->fiscalAddress->intNbr'));
//                            $this->log($msg);
//                            $this->log($msg, $this->fileLog);
//                            $vendorFiscalAddressIntNbr = (string)$vendorFiscalAddress->attributes()->intNbr;
//                            if (!$vendorFiscalAddressIntNbr) {
//                                $msg = '[INFO] ' . yii::t('app', 'Vendor fiscal address attribute "{attr}" missing or is null', array('{attr}' => 'vendor->fiscalAddress->intNbr'));
//                                $this->log($msg);
//                                $this->log($msg, $this->fileLog);
//                            }
//                            // VENDOR FISCAL ADDRESS COLONY
//                            // Rules:
//                            // 1) Optional
//                            $msg = '[INFO] ' . yii::t('app', 'Validating attribute "{attr}".', array('{attr}' => 'vendor->fiscalAddress->colony'));
//                            $this->log($msg);
//                            $this->log($msg, $this->fileLog);
//                            $vendorFiscalAddressColony = (string)$vendorFiscalAddress->attributes()->colony;
//                            if (!$vendorFiscalAddressColony) {
//                                $msg = '[INFO] ' . yii::t('app', 'Vendor fiscal address attribute "{attr}" missing or is null',
//                                        array('{attr}' => 'vendor->fiscalAddress->colony'));
//                                $this->log($msg);
//                                $this->log($msg, $this->fileLog);
//                            }
//                            // VENDOR FISCAL ADDRESS CITY
//                            // Rules:
//                            // 1) Optional
//                            $msg = '[INFO] ' . yii::t('app', 'Validating attribute "{attr}".', array('{attr}' => 'vendor->fiscalAddress->city'));
//                            $this->log($msg);
//                            $this->log($msg, $this->fileLog);
//                            $vendorFiscalAddressCity = (string)$vendorFiscalAddress->attributes()->city;
//                            if (!$vendorFiscalAddressCity) {
//                                $msg = '[INFO] ' . yii::t('app', 'Vendor fiscal address attribute "{attr}" missing or is null',
//                                        array('{attr}' => 'vendor->fiscalAddress->city'));
//                                $this->log($msg);
//                                $this->log($msg, $this->fileLog);
//                            }
//                            // VENDOR FISCAL ADDRESS REFERENCE
//                            // Rules:
//                            // 1) Optional
//                            $msg = '[INFO] ' . yii::t('app', 'Validating attribute "{attr}".', array('{attr}' => 'vendor->fiscalAddress->reference'));
//                            $this->log($msg);
//                            $this->log($msg, $this->fileLog);
//                            $vendorFiscalAddressReference= (string)$vendorFiscalAddress->attributes()->reference;
//                            if (!$vendorFiscalAddressReference) {
//                                $msg = '[INFO] ' . yii::t('app', 'Vendor fiscal address attribute "{attr}" missing or is null',
//                                        array('{attr}' => 'vendor->fiscalAddress->reference'));
//                                $this->log($msg);
//                                $this->log($msg, $this->fileLog);
//                            }
//                            // VENDOR FISCAL ADDRESS COUNTY
//                            // Rules:
//                            // 1) Required
//                            $msg = '[INFO] ' . yii::t('app', 'Validating attribute "{attr}".', array('{attr}' => 'vendor->fiscalAddress->county'));
//                            $this->log($msg);
//                            $this->log($msg, $this->fileLog);
//                            $vendorFiscalAddressCounty = (string)$vendorFiscalAddress->attributes()->county;
//                            if (!$vendorFiscalAddressCounty) {
//                                $msg = yii::t('app', 'Vendor fiscal address attribute "{attr}" is required.',
//                                        array('{attr}' => 'county'));
//                                $this->errors[] = $msg;
//                                throw new Exception($msg);
//                            }
//                            // VENDOR FISCAL ADDRESS STATE
//                            // Rules:
//                            // 1) Required
//                            $msg = '[INFO] ' . yii::t('app', 'Validating attribute "{attr}".', array('{attr}' => 'vendor->fiscalAddress->state'));
//                            $this->log($msg);
//                            $this->log($msg, $this->fileLog);
//                            $vendorFiscalAddressState = (string)$vendorFiscalAddress->attributes()->state;
//                            if (!$vendorFiscalAddressState) {
//                                $msg = yii::t('app', 'Vendor fiscal address attribute "{attr}" is required.',
//                                        array('{attr}' => 'state'));
//                                $this->errors[] = $msg;
//                                throw new Exception($msg);
//                            }
//                            // VENDOR FISCAL ADDRESS COUNTRY
//                            // Rules:
//                            // 1) Required
//                            $msg = '[INFO] ' . yii::t('app', 'Validating attribute "{attr}".', array('{attr}' => 'vendor->fiscalAddress->country'));
//                            $this->log($msg);
//                            $this->log($msg, $this->fileLog);
//                            $vendorFiscalAddressCountry = (string)$vendorFiscalAddress->attributes()->country;
//                            if (!$vendorFiscalAddressCountry) {
//                                $msg = yii::t('app', 'Vendor fiscal address attribute "{attr}" is required.',
//                                        array('{attr}' => 'country'));
//                                $this->errors[] = $msg;
//                                throw new Exception($msg);
//                            }
//                            // VENDOR FISCAL ADDRESS ZIPCODE
//                            // Rules:
//                            // 1) Required
//                            // 2) If country is MX, must be a valid mexican zipcode.
//                            $msg = '[INFO] ' . yii::t('app', 'Validating attribute "{attr}".', array('{attr}' => 'vendor->fiscalAddress->zipCode'));
//                            $this->log($msg);
//                            $this->log($msg, $this->fileLog);
//                            $vendorFiscalAddressZipCode = (string)$vendorFiscalAddress->attributes()->zipCode;
//                            if (!$vendorFiscalAddressZipCode) {
//                                $msg = yii::t('app', 'Vendor fiscal address attribute "{attr}" is required.',
//                                        array('{attr}' => 'zipCode'));
//                                $this->errors[] = $msg;
//                                throw new Exception($msg);
//                            } else {
//                                if ($vendorFiscalAddressCountry == 'MX') {
//                                    ZipCode::validate($vendorFiscalAddressZipCode, $vendorFiscalAddressCountry);
//                                }
//                            }
//                        }
//                    }
//
//                    // CUSTOMER
//                    // Rules:
//                    // 1) Customer node is required.
//                    $msg = '[INFO] ' . yii::t('app', 'Processing node "{node}".', array('{node}' => 'customer'));
//                    $this->log($msg);
//                    $this->log($msg, $this->fileLog);
//                    $node = $xmlInvoice->xpath('customer');
//                    if (!$node) {
//                        $msg = yii::t('app', 'Node "{node}" is required.',
//                                array('{node}' => 'customer'));
//                        $this->errors[] = $msg;
//                        throw new Exception($msg);
//                    } else {
//                        $customer = $node[0];
//                        // CUSTOMER RFC
//                        // Rules:
//                        // 1) Required
//                        // 2) RFC must be a valid RFC.
//                        $msg = '[INFO] ' . yii::t('app', 'Validating attribute "{attr}".', array('{attr}' => 'customer->rfc'));
//                        $this->log($msg);
//                        $this->log($msg, $this->fileLog);
//                        if (!(string)$customer->attributes()->rfc) {
//                            $msg = yii::t('app', 'Customer attribute "{attr}" is required.',
//                                    array('{attr}' => 'rfc'));
//                            $this->errors[] = $msg;
//                            throw new Exception($msg);
//                        } else {
//                            if (SatRfc::validate((string)$customer->attributes()->rfc)) {
//                                $customerRfc = (string)$customer->attributes()->rfc;
//                            }
//                        }
//                        // CUSTOMER NAME
//                        // Rules:
//                        // 1) Required
//                        // 2) Free form text
//                        $msg = '[INFO] ' . yii::t('app', 'Validating attribute "{attr}".', array('{attr}' => 'customer->name'));
//                        $this->log($msg);
//                        $this->log($msg, $this->fileLog);
//
//                        $customerName = (string)$customer->attributes()->name;
//                        if (!$customerName) {
//                            $msg = yii::t('app', 'Customer attribute "{attr}" is required.',
//                                    array('{attr}' => 'name'));
//                            $this->errors[] = $msg;
//                            throw new Exception($msg);
//                        }
//                        // CUSTOMER EMAIL
//                        // Rules:
//                        // 1) Optional
//                        $msg = '[INFO] ' . yii::t('app', 'Validating attribute "{attr}".', array('{attr}' => 'customer->email'));
//                        $this->log($msg);
//                        $this->log($msg, $this->fileLog);
//
//                        $customerEmail = (string)$customer->attributes()->email;
//                        if (!$customerEmail) {
//                            $msg = '[INFO] ' . yii::t('app', 'Customer attribute "{attr}" missing or is null',
//                                    array('{attr}' => 'customer->email'));
//                            $this->log($msg);
//                            $this->log($msg, $this->fileLog);
//                        }
//                        // CUSTOMER NBR
//                        // Rules:
//                        // 1) Optional
//                        $msg = '[INFO] ' . yii::t('app', 'Validating attribute "{attr}".', array('{attr}' => 'customer->nbr'));
//                        $this->log($msg);
//                        $this->log($msg, $this->fileLog);
//
//                        $customerNbr = (string)$customer->attributes()->nbr;
//                        if (!$customerNbr) {
//                            $msg = '[INFO] ' . yii::t('app', 'Customer attribute "{attr}" missing or is null',
//                                    array('{attr}' => 'customer->nbr'));
//                            $this->log($msg);
//                            $this->log($msg, $this->fileLog);
//                        }
//                        // CUSTOMER FISCAL ADDRESS
//                        // Rules:
//                        // 1) Customer fiscal address node is required.
//                        $msg = '[INFO] ' . yii::t('app', 'Processing node "{node}".', array('{node}' => 'customer->customerFiscalAddress'));
//                        $this->log($msg);
//                        $this->log($msg, $this->fileLog);
//                        $node = $customer->xpath('customerFiscalAddress');
//                        if (!$node) {
//                            $msg = yii::t('app', 'Node "{node}" is required.',
//                                    array('{node}' => 'customer->customerFiscalAddress'));
//                            $this->errors[] = $msg;
//                            throw new Exception($msg);
//                        } else {
//                            $customerFiscalAddress = $node[0];
//                            // CUSTOMER FISCAL ADDRESS STREET
//                            // Rules:
//                            // 1) Required
//                            $msg = '[INFO] ' . yii::t('app', 'Validating attribute "{attr}".', array('{attr}' => 'customer->customerFiscalAddress->street'));
//                            $this->log($msg);
//                            $this->log($msg, $this->fileLog);
//                            $customerFiscalAddressStreet = (string)$customerFiscalAddress->attributes()->street;
//                            if (!$customerFiscalAddressStreet) {
//                                $msg = yii::t('app', 'Customer fiscal address attribute "{attr}" missing or null.',
//                                        array('{attr}' => 'street'));
//                                $this->log($msg);
//                                $this->log($msg, $this->fileLog);
//                            }
//                            // CUSTOMER FISCAL ADDRESS EXTNBR
//                            // Rules:
//                            // 1) Optional
//                            $msg = '[INFO] ' . yii::t('app', 'Validating attribute "{attr}".', array('{attr}' => 'customer->customerFiscalAddress->extNbr'));
//                            $this->log($msg);
//                            $this->log($msg, $this->fileLog);
//                            $customerFiscalAddressExtNbr = (string)$customerFiscalAddress->attributes()->extNbr;
//                            if (!$customerFiscalAddressExtNbr) {
//                                $msg = '[INFO] ' . yii::t('app', 'Customer fiscal address attribute "{attr}" missing or is null', array('{attr}' => 'customer->customerFiscalAddress->extNbr'));
//                                $this->log($msg);
//                                $this->log($msg, $this->fileLog);
//                            }
//                            // CUSTOMER FISCAL ADDRESS INTNBR
//                            // Rules:
//                            // 1) Optional
//                            $msg = '[INFO] ' . yii::t('app', 'Validating attribute "{attr}".', array('{attr}' => 'customer->customerFiscalAddress->intNbr'));
//                            $this->log($msg);
//                            $this->log($msg, $this->fileLog);
//                            $customerFiscalAddressIntNbr = (string)$customerFiscalAddress->attributes()->intNbr;
//                            if (!$customerFiscalAddressIntNbr) {
//                                $msg = '[INFO] ' . yii::t('app', 'Customer fiscal address attribute "{attr}" missing or is null', array('{attr}' => 'customer->customerFiscalAddress->intNbr'));
//                                $this->log($msg);
//                                $this->log($msg, $this->fileLog);
//                            }
//                            // CUSTOMER FISCAL ADDRESS COLONY
//                            // Rules:
//                            // 1) Optional
//                            $msg = '[INFO] ' . yii::t('app', 'Validating attribute "{attr}".', array('{attr}' => 'customer->customerFiscalAddress->colony'));
//                            $this->log($msg);
//                            $this->log($msg, $this->fileLog);
//                            $customerFiscalAddressColony = (string)$customerFiscalAddress->attributes()->colony;
//                            if (!$customerFiscalAddressColony) {
//                                $msg = '[INFO] ' . yii::t('app', 'Customer fiscal address attribute "{attr}" missing or is null',
//                                        array('{attr}' => 'customer->customerFiscalAddress->colony'));
//                                $this->log($msg);
//                                $this->log($msg, $this->fileLog);
//                            }
//                            // CUSTOMER FISCAL ADDRESS CITY
//                            // Rules:
//                            // 1) Optional
//                            $msg = '[INFO] ' . yii::t('app', 'Validating attribute "{attr}".', array('{attr}' => 'customer->customerFiscalAddress->city'));
//                            $this->log($msg);
//                            $this->log($msg, $this->fileLog);
//                            $customerFiscalAddressCity = (string)$customerFiscalAddress->attributes()->city;
//                            if (!$customerFiscalAddressCity) {
//                                $msg = '[INFO] ' . yii::t('app', 'Customer fiscal address attribute "{attr}" missing or is null',
//                                        array('{attr}' => 'customer->customerFiscalAddress->city'));
//                                $this->log($msg);
//                                $this->log($msg, $this->fileLog);
//                            }
//                            // CUSTOMER FISCAL ADDRESS REFERENCE
//                            // Rules:
//                            // 1) Optional
//                            $msg = '[INFO] ' . yii::t('app', 'Validating attribute "{attr}".', array('{attr}' => 'customer->customerFiscalAddress->reference'));
//                            $this->log($msg);
//                            $this->log($msg, $this->fileLog);
//                            $customerFiscalAddressReference= (string)$customerFiscalAddress->attributes()->reference;
//                            if (!$customerFiscalAddressReference) {
//                                $msg = '[INFO] ' . yii::t('app', 'Customer fiscal address attribute "{attr}" missing or is null',
//                                        array('{attr}' => 'customer->customerFiscalAddress->reference'));
//                                $this->log($msg);
//                                $this->log($msg, $this->fileLog);
//                            }
//                            // CUSTOMER FISCAL ADDRESS COUNTY
//                            // Rules:
//                            // 1) OPTIONAL
//                            $msg = '[INFO] ' . yii::t('app', 'Validating attribute "{attr}".', array('{attr}' => 'customer->customerFiscalAddress->county'));
//                            $this->log($msg);
//                            $this->log($msg, $this->fileLog);
//                            $customerFiscalAddressCounty = (string)$customerFiscalAddress->attributes()->county;
//                            if (!$customerFiscalAddressCounty) {
//                                $msg = '[INFO] ' . yii::t('app', 'Customer fiscal address attribute "{attr}" missing or is null',
//                                        array('{attr}' => 'customer->customerFiscalAddress->county'));
//                                $this->log($msg);
//                                $this->log($msg, $this->fileLog);
//                            }
//                            // CUSTOMER FISCAL ADDRESS STATE
//                            // Rules:
//                            // 1) Optional
//                            $msg = '[INFO] ' . yii::t('app', 'Validating attribute "{attr}".', array('{attr}' => 'customer->customerFiscalAddress->state'));
//                            $this->log($msg);
//                            $this->log($msg, $this->fileLog);
//                            $customerFiscalAddressState = (string)$customerFiscalAddress->attributes()->state;
//                            if (!$customerFiscalAddressState) {
//                                $msg = '[INFO] ' . yii::t('app', 'Customer fiscal address attribute "{attr}" missing or is null',
//                                        array('{attr}' => 'customer->customerFiscalAddress->state'));
//                                $this->log($msg);
//                                $this->log($msg, $this->fileLog);
//                            }
//                            // CUSTOMER FISCAL ADDRESS COUNTRY
//                            // Rules:
//                            // 1) Required
//                            $msg = '[INFO] ' . yii::t('app', 'Validating attribute "{attr}".', array('{attr}' => 'customer->customerFiscalAddress->country'));
//                            $this->log($msg);
//                            $this->log($msg, $this->fileLog);
//                            $customerFiscalAddressCountry = (string)$customerFiscalAddress->attributes()->country;
//                            if (!$customerFiscalAddressCountry) {
//                                $msg = yii::t('app', 'Customer fiscal address attribute "{attr}" is required.',
//                                        array('{attr}' => 'country'));
//                                $this->errors[] = $msg;
//                                throw new Exception($msg);
//                            }
//                            // CUSTOMER FISCAL ADDRESS ZIPCODE
//                            // Rules:
//                            // 1) Optional
//                            // 2) If country is MX, must be a valid mexican zipcode.
//                            $msg = '[INFO] ' . yii::t('app', 'Validating attribute "{attr}".', array('{attr}' => 'customer->customerFiscalAddress->zipCode'));
//                            $this->log($msg);
//                            $this->log($msg, $this->fileLog);
//                            $customerFiscalAddressZipCode = (string)$customerFiscalAddress->attributes()->zipCode;
//                            if (!$customerFiscalAddressZipCode) {
//                                $msg = '[INFO] ' . yii::t('app', 'Customer fiscal address attribute "{attr}" missing or is null',
//                                        array('{attr}' => 'customer->customerFiscalAddress->zipCode'));
//                                $this->log($msg);
//                                $this->log($msg, $this->fileLog);
//                            } else {
//                                if ($customerFiscalAddressCountry == 'MX') {
//                                    ZipCode::validate($customerFiscalAddressZipCode, $customerFiscalAddressCountry);
//                                }
//                            }
//                        }
//                        // CUSTOMER SHIP TO ADDRESS
//                        // Rules:
//                        // 1) Customer ship to address node is optional.
//                        $msg = '[INFO] ' . yii::t('app', 'Processing node "{node}".', array('{node}' => 'customer->shipToAddress'));
//                        $this->log($msg);
//                        $this->log($msg, $this->fileLog);
//                        $node = $customer->xpath('shipToAddress');
//                        if (!$node) {
//                            $msg = yii::t('app', 'Node "{node}" is missing.',
//                                    array('{node}' => 'customer->shipToAddress'));
//                            $this->log($msg);
//                            $this->log($msg, $this->fileLog);
//                        } else {
//                            $shipToAddress = $node[0];
//                            // CUSTOMER SHIP TO ADDRESS STREET
//                            // Rules:
//                            // 1) Optional
//                            $msg = '[INFO] ' . yii::t('app', 'Validating attribute "{attr}".', array('{attr}' => 'customer->shipToAddress->street'));
//                            $this->log($msg);
//                            $this->log($msg, $this->fileLog);
//                            $shipToAddressStreet = (string)$shipToAddress->attributes()->street;
//                            if (!$shipToAddressStreet) {
//                                $msg = yii::t('app', 'Customer ship to address attribute "{attr}" missing or null.',
//                                        array('{attr}' => 'street'));
//                                $this->log($msg);
//                                $this->log($msg, $this->fileLog);
//                            }
//                            // CUSTOMER SHIP TO ADDRESS EXTNBR
//                            // Rules:
//                            // 1) Optional
//                            $msg = '[INFO] ' . yii::t('app', 'Validating attribute "{attr}".', array('{attr}' => 'customer->shipToAddress->extNbr'));
//                            $this->log($msg);
//                            $this->log($msg, $this->fileLog);
//                            $shipToAddressExtNbr = (string)$shipToAddress->attributes()->extNbr;
//                            if (!$shipToAddressExtNbr) {
//                                $msg = '[INFO] ' . yii::t('app', 'Customer ship to address attribute "{attr}" missing or is null', array('{attr}' => 'customer->shipToAddress->extNbr'));
//                                $this->log($msg);
//                                $this->log($msg, $this->fileLog);
//                            }
//                            // CUSTOMER SHIP TO ADDRESS INTNBR
//                            // Rules:
//                            // 1) Optional
//                            $msg = '[INFO] ' . yii::t('app', 'Validating attribute "{attr}".', array('{attr}' => 'customer->shipToAddress->intNbr'));
//                            $this->log($msg);
//                            $this->log($msg, $this->fileLog);
//                            $shipToAddressIntNbr = (string)$shipToAddress->attributes()->intNbr;
//                            if (!$shipToAddressIntNbr) {
//                                $msg = '[INFO] ' . yii::t('app', 'Customer ship to address attribute "{attr}" missing or is null', array('{attr}' => 'customer->shipToAddress->intNbr'));
//                                $this->log($msg);
//                                $this->log($msg, $this->fileLog);
//                            }
//                            // CUSTOMER SHIP TO ADDRESS COLONY
//                            // Rules:
//                            // 1) Optional
//                            $msg = '[INFO] ' . yii::t('app', 'Validating attribute "{attr}".', array('{attr}' => 'customer->shipToAddress->colony'));
//                            $this->log($msg);
//                            $this->log($msg, $this->fileLog);
//                            $shipToAddressColony = (string)$shipToAddress->attributes()->colony;
//                            if (!$shipToAddressColony) {
//                                $msg = '[INFO] ' . yii::t('app', 'Customer ship to address attribute "{attr}" missing or is null',
//                                        array('{attr}' => 'customer->shipToAddress->colony'));
//                                $this->log($msg);
//                                $this->log($msg, $this->fileLog);
//                            }
//                            // CUSTOMER SHIP TO ADDRESS CITY
//                            // Rules:
//                            // 1) Optional
//                            $msg = '[INFO] ' . yii::t('app', 'Validating attribute "{attr}".', array('{attr}' => 'customer->shipToAddress->city'));
//                            $this->log($msg);
//                            $this->log($msg, $this->fileLog);
//                            $shipToAddressCity = (string)$shipToAddress->attributes()->city;
//                            if (!$shipToAddressCity) {
//                                $msg = '[INFO] ' . yii::t('app', 'Customer ship to address attribute "{attr}" missing or is null',
//                                        array('{attr}' => 'customer->shipToAddress->city'));
//                                $this->log($msg);
//                                $this->log($msg, $this->fileLog);
//                            }
//                            // CUSTOMER SHIP TO ADDRESS REFERENCE
//                            // Rules:
//                            // 1) Optional
//                            $msg = '[INFO] ' . yii::t('app', 'Validating attribute "{attr}".', array('{attr}' => 'customer->shipToAddress->reference'));
//                            $this->log($msg);
//                            $this->log($msg, $this->fileLog);
//                            $shipToAddressReference= (string)$shipToAddress->attributes()->reference;
//                            if (!$shipToAddressReference) {
//                                $msg = '[INFO] ' . yii::t('app', 'Customer ship to address attribute "{attr}" missing or is null',
//                                        array('{attr}' => 'customer->shipToAddress->reference'));
//                                $this->log($msg);
//                                $this->log($msg, $this->fileLog);
//                            }
//                            // CUSTOMER SHIP TO ADDRESS COUNTY
//                            // Rules:
//                            // 1) OPTIONAL
//                            $msg = '[INFO] ' . yii::t('app', 'Validating attribute "{attr}".', array('{attr}' => 'customer->shipToAddress->county'));
//                            $this->log($msg);
//                            $this->log($msg, $this->fileLog);
//                            $shipToAddressCounty = (string)$shipToAddress->attributes()->county;
//                            if (!$shipToAddressCounty) {
//                                $msg = '[INFO] ' . yii::t('app', 'Customer ship to address attribute "{attr}" missing or is null',
//                                        array('{attr}' => 'customer->shipToAddress->county'));
//                                $this->log($msg);
//                                $this->log($msg, $this->fileLog);
//                            }
//                            // CUSTOMER SHIP TO ADDRESS STATE
//                            // Rules:
//                            // 1) Optional
//                            $msg = '[INFO] ' . yii::t('app', 'Validating attribute "{attr}".', array('{attr}' => 'customer->shipToAddress->state'));
//                            $this->log($msg);
//                            $this->log($msg, $this->fileLog);
//                            $shipToAddressState = (string)$shipToAddress->attributes()->state;
//                            if (!$shipToAddressState) {
//                                $msg = '[INFO] ' . yii::t('app', 'Customer ship to address attribute "{attr}" missing or is null',
//                                        array('{attr}' => 'customer->shipToAddress->state'));
//                                $this->log($msg);
//                                $this->log($msg, $this->fileLog);
//                            }
//                            // CUSTOMER SHIP TO ADDRESS COUNTRY
//                            // Rules:
//                            // 1) Optional
//                            $msg = '[INFO] ' . yii::t('app', 'Validating attribute "{attr}".', array('{attr}' => 'customer->shipToAddress->country'));
//                            $this->log($msg);
//                            $this->log($msg, $this->fileLog);
//                            $shipToAddressCountry = (string)$shipToAddress->attributes()->country;
//                            if (!$shipToAddressCountry) {
//                                $msg = yii::t('app', 'Customer ship to address attribute "{attr}" is missing or null.',
//                                        array('{attr}' => 'country'));
//                                $this->log($msg);
//                                $this->log($msg, $this->fileLog);
//                            }
//                            // CUSTOMER SHIP TO ADDRESS ZIPCODE
//                            // Rules:
//                            // 1) Optional
//                            // 2) If country is MX, must be a valid mexican zipcode.
//                            $msg = '[INFO] ' . yii::t('app', 'Validating attribute "{attr}".', array('{attr}' => 'customer->shipToAddress->zipCode'));
//                            $this->log($msg);
//                            $this->log($msg, $this->fileLog);
//                            $shipToAddressZipCode = (string)$shipToAddress->attributes()->zipCode;
//                            if (!$shipToAddressZipCode) {
//                                $msg = '[INFO] ' . yii::t('app', 'Customer ship to address attribute "{attr}" missing or is null',
//                                        array('{attr}' => 'customer->shipToAddress->zipCode'));
//                                $this->log($msg);
//                                $this->log($msg, $this->fileLog);
//                            }
//                            // SHIP TO CUSTOMER
//                            // Rules:
//                            // 1) Ship to customer node is optional.
//                            $msg = '[INFO] ' . yii::t('app', 'Processing node "{node}".', array('{node}' => 'customer->shipToAddress->shipToCustomer'));
//                            $this->log($msg);
//                            $this->log($msg, $this->fileLog);
//                            $node = $shipToAddress->xpath('shipToCustomer');
//                            if (!$node) {
//                                $msg = yii::t('app', 'Node "{node}" is missing.',
//                                        array('{node}' => 'customer->shipToAddress->shipToCustomer'));
//                                $this->log($msg);
//                                $this->log($msg, $this->fileLog);
//                            } else {
//                                $shipToCustomer = $node[0];
//                                // SHIP TO CUSTOMER NBR
//                                // Rules:
//                                // 1) Optional
//                                $msg = '[INFO] ' . yii::t('app', 'Validating attribute "{attr}".', array('{attr}' => 'customer->shipToAddress->shipToCustomer->nbr'));
//                                $this->log($msg);
//                                $this->log($msg, $this->fileLog);
//                                $customerShipToNbr = (string)$shipToCustomer->attributes()->nbr;
//                                if (!$customerShipToNbr) {
//                                    $msg = '[INFO] ' . yii::t('app', 'Customer attribute "{attr}" missing or is null',
//                                            array('{attr}' => 'customer->shipToAddress->shipToCustomer->nbr'));
//                                    $this->log($msg);
//                                    $this->log($msg, $this->fileLog);
//                                }
//                                // SHIP TO CUSTOMER NAME
//                                // Rules:
//                                // 1) Optional
//                                $msg = '[INFO] ' . yii::t('app', 'Validating attribute "{attr}".', array('{attr}' => 'customer->shipToAddress->shipToCustomer->name'));
//                                $this->log($msg);
//                                $this->log($msg, $this->fileLog);
//                                $customerShipToName = (string)$shipToCustomer->attributes()->name;
//                                if (!$customerShipToName) {
//                                    $msg = '[INFO] ' . yii::t('app', 'Customer attribute "{attr}" missing or is null',
//                                            array('{attr}' => 'customer->shipToAddress->shipToCustomer->name'));
//                                    $this->log($msg);
//                                    $this->log($msg, $this->fileLog);
//                                }
//                                // SHIP TO CUSTOMER RFC
//                                // Rules:
//                                // 1) Optional
//                                $msg = '[INFO] ' . yii::t('app', 'Validating attribute "{attr}".', array('{attr}' => 'customer->shipToAddress->shipToCustomer->rfc'));
//                                $this->log($msg);
//                                $this->log($msg, $this->fileLog);
//                                $customerShipToRfc = (string)$shipToCustomer->attributes()->rfc;
//                                if (!$customerShipToRfc) {
//                                    $msg = '[INFO] ' . yii::t('app', 'Customer attribute "{attr}" missing or is null',
//                                            array('{attr}' => 'customer->shipToAddress->shipToCustomer->rfc'));
//                                    $this->log($msg);
//                                    $this->log($msg, $this->fileLog);
//                                }
//                            }
//                        }
//                    }
//                    // ITEMS
//                    // Rules:
//                    // 1) Items node is required.
//                    $msg = '[INFO] ' . yii::t('app', 'Processing node "{node}".', array('{node}' => 'items'));
//                    $this->log($msg);
//                    $this->log($msg, $this->fileLog);
//                    $node = $xmlInvoice->xpath('items');
//                    if (!$node) {
//                        $msg = yii::t('app', 'Node "{node}" is required.',
//                                array('{node}' => 'items'));
//                        $this->errors[] = $msg;
//                        throw new Exception($msg);
//                    } else {
//                        $itemsNode = $node[0];
//                        $items = array();
//                        // Validate each item
//                        foreach ($itemsNode->children() as $xmlItem) {
//                            // QTY
//                            // Rules:
//                            // 1) Required
//                            // 2) Must be numeric
//                            $msg = '[INFO] ' . yii::t('app', 'Validating item attribute "{attr}".', array('{attr}' => 'qty'));
//                            $this->log($msg);
//                            $this->log($msg, $this->fileLog);
//
//                            $itemQty = (float)$xmlItem->attributes()->qty;
//                            if (!$itemQty) {
//                                $msg = yii::t('app', 'Item attribute "{attr}" is required.',
//                                        array('{attr}' => 'qty'));
//                                $this->errors[] = $msg;
//                                throw new Exception($msg);
//                            } else {
//                                if (!is_numeric($itemQty)) {
//                                    $msg = yii::t('app', 'Item qty must be numeric. Value reported: {value}',
//                                            array('{value}' => $itemQty));
//                                    $this->errors[] = $msg;
//                                    throw new Exception($msg);
//                                }
//                            }
//                            // UOM
//                            // Rules:
//                            // 1) Required
//                            $msg = '[INFO] ' . yii::t('app', 'Validating item attribute "{attr}".', array('{attr}' => 'uom'));
//                            $this->log($msg);
//                            $this->log($msg, $this->fileLog);
//                            $itemUom = (string)$xmlItem->attributes()->uom;
//                            if (!$itemUom) {
//                                $msg = yii::t('app', 'Item attribute "{attr}" is required.',
//                                        array('{attr}' => 'uom'));
//                                $this->errors[] = $msg;
//                                throw new Exception($msg);
//                            }
//                            // PRODUCT CODE
//                            // Rules:
//                            // 1) Optional
//                            $msg = '[INFO] ' . yii::t('app', 'Validating item attribute "{attr}".', array('{attr}' => 'productCode'));
//                            $this->log($msg);
//                            $this->log($msg, $this->fileLog);
//                            $itemProductCode = (string)$xmlItem->attributes()->productCode;
//                            if (!$itemProductCode) {
//                                $msg = '[INFO] ' . yii::t('app', 'Item attribute "{attr}" missing or is null',
//                                        array('{attr}' => 'productCode'));
//                                $this->log($msg);
//                                $this->log($msg, $this->fileLog);
//                            }
//                            // DESCRIPTION
//                            // Rules:
//                            // 1) Required
//                            $msg = '[INFO] ' . yii::t('app', 'Validating item attribute "{attr}".', array('{attr}' => 'description'));
//                            $this->log($msg);
//                            $this->log($msg, $this->fileLog);
//                            $itemDescription = (string)$xmlItem->attributes()->description;
//                            if (!$itemDescription) {
//                                $msg = yii::t('app', 'Item attribute "{attr}" is required.',
//                                        array('{attr}' => 'description'));
//                                $this->errors[] = $msg;
//                                throw new Exception($msg);
//                            }
//                            // UNIT PRICE
//                            // Rules:
//                            // 1) Required
//                            // 2) Must be numeric
//                            $msg = '[INFO] ' . yii::t('app', 'Validating item attribute "{attr}".', array('{attr}' => 'unitPrice'));
//                            $this->log($msg);
//                            $this->log($msg, $this->fileLog);
//
//                            $itemUnitPrice = (float)$xmlItem->attributes()->unitPrice;
//                            if (!$itemUnitPrice) {
//                                $msg = yii::t('app', 'Item attribute "{attr}" is required.',
//                                        array('{attr}' => 'unitPrice'));
//                                $this->errors[] = $msg;
//                                throw new Exception($msg);
//                            } else {
//                                if (!is_numeric($itemUnitPrice)) {
//                                    $msg = yii::t('app', 'Item unit price must be numeric. Value reported: {value}',
//                                            array('{value}' => $itemUnitPrice));
//                                    $this->errors[] = $msg;
//                                    throw new Exception($msg);
//                                }
//                            }
//                            // DISCOUNT
//                            // Rules:
//                            // 1) Optional
//                            // 2) If present, must be numeric.
//                            $msg = '[INFO] ' . yii::t('app', 'Validating item attribute "{attr}".', array('{attr}' => 'discount'));
//                            $this->log($msg);
//                            $this->log($msg, $this->fileLog);
//                            $itemDiscount = (string)$xmlItem->attributes()->discount;
//                            if (!$itemDiscount) {
//                                $msg = '[INFO] ' . yii::t('app', 'Item attribute "{attr}" missing or is null',
//                                        array('{attr}' => 'discount'));
//                                $this->log($msg);
//                                $this->log($msg, $this->fileLog);
//                            } else {
//                                if (!is_numeric($discount)) {
//                                    $msg = yii::t('app', 'Item discount must be numeric. Value reported: {value}',
//                                            array('{value}' => $itemDiscount));
//                                    $this->errors[] = $msg;
//                                    throw new Exception($msg);
//                                }
//                            }
//                            // DISCOUNT TYPE
//                            // Rules:
//                            // 1) Optional
//                            $msg = '[INFO] ' . yii::t('app', 'Validating item attribute "{attr}".', array('{attr}' => 'discountType'));
//                            $this->log($msg);
//                            $this->log($msg, $this->fileLog);
//                            $itemDiscountType = (string)$xmlItem->attributes()->discountType;
//                            if (!$itemDiscountType) {
//                                $msg = '[INFO] ' . yii::t('app', 'Item attribute "{attr}" missing or is null',
//                                        array('{attr}' => 'discountType'));
//                                $this->log($msg);
//                                $this->log($msg, $this->fileLog);
//                            }
//                            // UNIT NET PRICE
//                            // Rules:
//                            // 1) Required
//                            // 2) Must be numeric
//                            $msg = '[INFO] ' . yii::t('app', 'Validating item attribute "{attr}".', array('{attr}' => 'unitNetPrice'));
//                            $this->log($msg);
//                            $this->log($msg, $this->fileLog);
//                            $itemUnitNetPrice = (float)$xmlItem->attributes()->unitNetPrice;
//                            if (!$itemUnitNetPrice) {
//                                $msg = yii::t('app', 'Item attribute "{attr}" is required.',
//                                        array('{attr}' => 'unitNetPrice'));
//                                $this->errors[] = $msg;
//                                throw new Exception($msg);
//                            } else {
//                                if (!is_numeric($itemUnitPrice)) {
//                                    $msg = yii::t('app', 'Item unit net price must be numeric. Value reported: {value}',
//                                            array('{value}' => $itemUnitNetPrice));
//                                    $this->errors[] = $msg;
//                                    throw new Exception($msg);
//                                }
//                            }
//                            // AMOUNT
//                            // Rules:
//                            // 1) Required
//                            // 2) Must be numeric
//                            // 3) Must be equal to qty * unit net price
//                            $msg = '[INFO] ' . yii::t('app', 'Validating item attribute "{attr}".', array('{attr}' => 'amount'));
//                            $this->log($msg);
//                            $this->log($msg, $this->fileLog);
//                            $itemAmount = (float)$xmlItem->attributes()->amount;
//                            if (!$itemAmount) {
//                                $msg = yii::t('app', 'Item attribute "{attr}" is required.',
//                                        array('{attr}' => 'amount'));
//                                $this->errors[] = $msg;
//                                throw new Exception($msg);
//                            } else {
//                                if (!is_numeric($itemAmount)) {
//                                    $msg = yii::t('app', 'Item amount must be numeric. Value reported: {value}',
//                                            array('{value}' => $itemAmount));
//                                    $this->errors[] = $msg;
//                                    throw new Exception($msg);
//                                } else {
//                                    if ($itemAmount != $itemQty * $itemUnitNetPrice) {
//                                        $msg = yii::t('app', 'Item amount must equal to item qty * item unit net price.');
//                                        $this->errors[] = $msg;
//                                        throw new Exception($msg);
//                                    }
//                                }
//                            }
//                        }
//                    }
//                }
            }
        } catch (Exception $e) {
            yii::log($e->getMessage(), CLogger::LEVEL_ERROR, $this->name);
//            $this->log('[ERROR] ' . $e->getMessage());
//            $this->log('[ERROR] ' . $e->getMessage(), $this->fileLog);
//            // Create error file
//            error_log('[' . date(DateTime::ISO8601) . '] ' . $e->getMessage() . PHP_EOL, 3, $this->fileError);
        }
    }
}

?>
