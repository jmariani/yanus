<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProcessIncomingInvoiceNativeXmlCommand
 *
 * This command will process a 'Native XML' file received through command line
 * and store it in the database using the Cfd object.
 *
 * @author jmariani
 */
class ProcessIncomingInvoiceNativeXmlCommand extends CConsoleCommand {
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
        // 3) File is a XML file.
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
            $xml = simplexml_load_file($args[0]);
            if (!$xml) {
                $xmlErrors = libxml_get_errors();
                $msg = '';
                foreach ($xmlErrors as $xmlError) {
                    yii::log('[' . $pathInfo['basename'] . '][LIBXML][' . $xmlError->code . '] ' . $xmlError->message, CLogger::LEVEL_ERROR, $this->name);
                }
            } else {
                foreach ($xml->children() as $invoice) {
                    $cfd = new Cfd();
                    $cfdAttributes = array();
                    $subTotal = 0;
                    $tax = 0;
                    // Parse attributes.
                    foreach ($invoice->attributes() as $attributeName => $attributeValue) {
                        switch ($attributeName) {
                            case 'version':
                                $cfd->version = (string)$attributeValue;
                                break;
                            case 'serial':
                                if ((string)$attributeValue)
                                    $cfd->serial = (string)$attributeValue;
                                break;
                            case 'folio':
                                if ((string)$attributeValue)
                                    $cfd->folio = (string)$attributeValue;
                                break;
                            case 'date':
                                $cfd->dttm = (string)$attributeValue;
                                break;
                            case 'paymentType':
                                $cfd->paymentType = (string)$attributeValue;
                                break;
                            case 'paymentTerm':
                                if ((string)$attributeValue)
                                    $cfd->paymentTerm = (string)$attributeValue;
                                break;
                            case 'subTotal':
                                $cfd->subTotal = (float)$attributeValue;
                                break;
                            case 'discount':
                                $cfd->discount = (float)$attributeValue;
                                break;
                            case 'discountReason':
                                $cfd->discountReason = (string)$attributeValue;
                                break;
                            case 'exchangeRate':
                                $cfd->exchangeRate = (float)$attributeValue;
                                break;
                            case 'currency':
                                $cfd->currency = (string)$attributeValue;
                                break;
                            case 'total':
                                $cfd->total = (float)$attributeValue;
                                break;
                            case 'voucherType':
                                $cfd->voucherType = (string)$attributeValue;
                                break;
                            case 'paymentMethod':
                                $cfd->paymentType = (string)$attributeValue;
                                break;
                            case 'expeditionPlace':
                                $cfd->expeditionPlace = (string)$attributeValue;
                                break;
                            case 'paymentAcctNbr':
                                $cfd->paymentAcctNbr = (string)$attributeValue;
                                break;
                            case 'sourceFolio':
                                $cfd->sourceFolio = $attributeValue;
                                break;
                            case 'sourceSerial':
                                $cfd->sourceSerial = (string)$attributeValue;
                                break;
                            case 'sourceDttm':
                                $cfd->sourceDttm = (string)$attributeValue;
                                break;
                            case 'sourceAmt':
                                $cfd->sourceAmt = (float)$attributeValue;
                                break;
                            case 'vendorRfc':
                                $cfd->vendorRfc = (string)$attributeValue;
                                break;
                            case 'vendorName':
                                $cfd->vendorName = (string)$attributeValue;
                                break;
                            case 'customerRfc':
                                $cfd->customerRfc = (string)$attributeValue;
                                break;
                            case 'customerName':
                                $cfd->customerName = (string)$attributeValue;
                                break;
                            case 'subTotal':
                                $cfd->subTotal = (float)$attributeValue;
                                break;
                            default:
                                // everything else is extra information.
                                $cfdAttribute = new CfdAttribute();
                                $cfdAttribute->code = $attributeName;
                                $cfdAttribute->value = (string)$attributeValue;
                                $cfdAttributes[] = $cfdAttribute;
                                break;
                        }
                    }
                    // Parse nodes
                    $cfdAddresses = array();
                    $cfdItems = array();
                    $cfdTaxes = array();
                    foreach ($invoice->children() as $invoiceNode) {
                        switch ($invoiceNode->getName()) {
                            case 'vendorFiscalAddress':
                                $vendorFiscalAddress = $this->mapAddress($invoiceNode);
                                $cfdAddress = new CfdAddress();
                                $cfdAddress->Address_id = $vendorFiscalAddress->id;
                                $cfdAddress->type = AddressTypeBehavior::FISCAL;
                                $cfdAddresses[] = $cfdAddress;
                                break;
                            case 'customerBillToAddress':
                                $customerBillToAddress = $this->mapAddress($invoiceNode);
                                $cfdAddress = new CfdAddress();
                                $cfdAddress->Address_id = $customerBillToAddress->id;
                                $cfdAddress->type = AddressTypeBehavior::BILL_TO;
                                $cfdAddresses[] = $cfdAddress;
                                break;
                            case 'customerShipToAddress':
                                $customerShipToAddress = $this->mapAddress($invoiceNode);
                                $cfdAddress = new CfdAddress();
                                $cfdAddress->Address_id = $customerShipToAddress->id;
                                $cfdAddress->type = AddressTypeBehavior::SHIP_TO;
                                $cfdAddresses[] = $cfdAddress;
                                break;
                            case 'items':
                                foreach ($invoiceNode->children() as $invoiceItem) {
                                    $cfdItem = new CfdItem();
                                    $cfdItemAttributes = array();
                                    $cfdItemCustomsPermits = array();
                                    foreach ($invoiceItem->attributes() as $attributeName => $attributeValue) {
                                        switch ($attributeName) {
                                            case 'qty':
                                                $cfdItem->qty = (float)$attributeValue;
                                                break;
                                            case 'uom':
                                                $cfdItem->uom = (string)$attributeValue;
                                                break;
                                            case 'productCode':
                                                $cfdItem->productCode = (string)$attributeValue;
                                                break;
                                            case 'description':
                                                $cfdItem->description = (string)$attributeValue;
                                                break;
                                            case 'productCode':
                                                $cfdItem->productCode = (string)$attributeValue;
                                                break;
                                            case 'unitPrice':
                                                $cfdItem->unitPrice = (float)$attributeValue;
                                                break;
                                            case 'amount':
                                                $cfdItem->amt = (float)$attributeValue;
                                                $subTotal += (float)$attributeValue;
                                                break;
                                            default:
                                                // Everything else is attribute.
                                                $cfdItemAttribute = new CfdItemAttribute();
                                                $cfdItemAttribute->code = $attributeName;
                                                $cfdItemAttribute->value = (string)$attributeValue;
                                                $cfdItemAttributes[] = $cfdItemAttribute;
                                        }
                                    }
                                    //Customs permit
                                    foreach ($invoiceItem->children() as $invoiceItemNode) {
                                        switch ($invoiceItemNode->getName()) {
                                            case 'customsPermit':
                                                $customsPermit = CustomsPermit::model()->find('nbr = :nbr', array(':nbr' => $invoiceItemNode->attributes()->nbr));
                                                if (!$customsPermit) {
                                                    $customsPermit = new CustomsPermit();
                                                    $customsPermit->nbr = $invoiceItemNode->attributes()->nbr;
                                                    $customsPermit->dt = $invoiceItemNode->attributes()->date;
                                                    $customsPermit->office = $invoiceItemNode->attributes()->custom;
                                                    $customsPermit->save();
                                                }
                                                $cfdItemCustomsPermit = new CfdItemHasCustomsPermit();
                                                $cfdItemCustomsPermit->CustomsPermit_id = $customsPermit->id;
                                                $cfdItemCustomsPermits[] = $cfdItemCustomsPermit;
                                        }
                                    }
                                    $cfdItems[] = array($cfdItem, $cfdItemAttributes, $cfdItemCustomsPermits);
                                }
                                break;
                            case 'taxes':
                                foreach ($invoiceNode->children() as $invoiceTax) {
                                    $cfdTax = new CfdTax();
                                    foreach ($invoiceTax->attributes() as $attributeName => $attributeValue) {
                                        switch ($attributeName) {
                                            case 'name':
                                                $cfdTax->name = (string)$attributeValue;
                                                break;
                                            case 'rate':
                                                $cfdTax->rate = (float)$attributeValue;
                                                break;
                                            case 'amt':
                                                $cfdTax->amt = (float)$attributeValue;
                                                $tax += (float)$attributeValue;
                                                break;
                                        }
                                    }
                                    $cfdTaxes[] = $cfdTax;
                                }
                                break;
                        }
                    }
                    $cfd->subTotal = $subTotal;
                    $cfd->taxAmt = $tax;

                    // Create the Cfd
                    $transaction = $cfd->model()->dbConnection->beginTransaction();
                    if (!$cfd->save()) {
                        print_r($cfd->getErrors());
                        $transaction->rollback();
                    } else {
                        // Save attributes
                        foreach ($cfdAttributes as $cfdAttribute) {
                            $cfdAttribute->Cfd_id = $cfd->id;
                            $cfdAttribute->save();
                        }
                        // Attach adresses
                        foreach ($cfdAddresses as $cfdAddress) {
                            $cfdAddress->Cfd_id = $cfd->id;
                            $cfdAddress->save();
                        }
                        // Save items
                        foreach ($cfdItems as $cfdItem) {
                            $cfdItem[0]->Cfd_id = $cfd->id;
                            $cfdItem[0]->save();
                            // Save item attributes.
                            foreach ($cfdItem[1] as $cfdItemAttribute) {
                                $cfdItemAttribute->CfdItem_id = $cfdItem[0]->id;
                                $cfdItemAttribute->save();
                            }
                            // Save item customs permits
                            foreach ($cfdItem[2] as $cfdItemCustomsPermit) {
                                $cfdItemCustomsPermit->CfdItem_id = $cfdItem[0]->id;
                                $cfdItemCustomsPermit->save();
                                // Save customs permits to CFD
                                try {
                                    $cfdCustomsPermit = new CfdHasCustomsPermit();
                                    $cfdCustomsPermit->Cfd_id = $cfd->id;
                                    $cfdCustomsPermit->CustomsPermit_id = $cfdItemCustomsPermit->CustomsPermit_id;
                                    $cfdCustomsPermit->save();
                                } catch (Exception $e){}
                            }
                        }
                        // Save taxes
                        foreach ($cfdTaxes as $cfdTax) {
                            $cfdTax->Cfd_id = $cfd->id;
                            $cfdTax->save();
                        }
                        $transaction->commit();
                        // Create XML
                        echo $cfd->createXml() . PHP_EOL;

                    }
                }
            }
        } catch (Exception $e) {
            yii::log($e->getMessage(), CLogger::LEVEL_ERROR, $this->name);
//            $this->log('[ERROR] ' . $e->getMessage());
//            $this->log('[ERROR] ' . $e->getMessage(), $this->fileLog);
//            // Create error file
//            error_log('[' . date(DateTime::ISO8601) . '] ' . $e->getMessage() . PHP_EOL, 3, $this->fileError);
        }
    }

    private function mapAddress($node) {
        $address = new Address();
        foreach ($node->attributes() as $attributeName => $attributeValue) {
            switch ($attributeName) {
                case 'street':
                    $address->street = (string)$attributeValue;
                    break;
                case 'extNbr':
                    $address->extNbr = (string)$attributeValue;
                    break;
                case 'intNbr':
                    $address->intNbr = (string)$attributeValue;
                    break;
                case 'neighbourhood':
                    $address->neighbourhood = (string)$attributeValue;
                    break;
                case 'city':
                    $address->city = (string)$attributeValue;
                    break;
                case 'reference':
                    $address->reference = (string)$attributeValue;
                    break;
                case 'municipality':
                    $address->municipality = (string)$attributeValue;
                    break;
                case 'state':
                    $address->state = (string)$attributeValue;
                    break;
                case 'country':
                    $address->country = (string)$attributeValue;
                    break;
                case 'zipCode':
                    $address->zipCode = (string)$attributeValue;
                    break;
            }
        }
        $addressRec = Address::model()->find('md5 = :md5', array(':md5' => md5($address->getHash())));
        if (!$addressRec) {
            $address->save();
            $addressRec = $address;
        }
        return $addressRec;
    }
}

?>
