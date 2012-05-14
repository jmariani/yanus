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
        error_log('[' . date(DateTime::ISO8601) . '] ' . $msg . PHP_EOL, 3, (($logFile) ? : '/tmp/' . $this->name . '.log'));
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
                                $cfd->version = (string) $attributeValue;
                                break;
                            case 'serial':
                                if ((string) $attributeValue)
                                    $cfd->serial = (string) $attributeValue;
                                break;
                            case 'folio':
                                if ((string) $attributeValue)
                                    $cfd->folio = (string) $attributeValue;
                                break;
                            case 'date':
                                $cfd->dttm = (string) $attributeValue;
                                break;
                            case 'paymentType':
                                $cfd->paymentType = (string) $attributeValue;
                                break;
                            case 'paymentTerm':
                                if ((string) $attributeValue)
                                    $cfd->paymentTerm = (string) $attributeValue;
                                break;
                            case 'subTotal':
                                $cfd->subTotal = (float) $attributeValue;
                                break;
                            case 'discount':
                                $cfd->discount = (float) $attributeValue;
                                break;
                            case 'discountReason':
                                $cfd->discountReason = (string) $attributeValue;
                                break;
                            case 'exchangeRate':
                                $cfd->exchangeRate = (float) $attributeValue;
                                break;
                            case 'currency':
                                $cfd->currency = (string) $attributeValue;
                                break;
                            case 'total':
                                $cfd->total = (float) $attributeValue;
                                break;
                            case 'voucherType':
                                $cfd->voucherType = (string) $attributeValue;
                                break;
                            case 'paymentMethod':
                                $cfd->paymentType = (string) $attributeValue;
                                break;
                            case 'expeditionPlace':
                                $cfd->expeditionPlace = (string) $attributeValue;
                                break;
                            case 'paymentAcctNbr':
                                $cfd->paymentAcctNbr = (string) $attributeValue;
                                break;
                            case 'sourceFolio':
                                $cfd->sourceFolio = $attributeValue;
                                break;
                            case 'sourceSerial':
                                $cfd->sourceSerial = (string) $attributeValue;
                                break;
                            case 'sourceDttm':
                                $cfd->sourceDttm = (string) $attributeValue;
                                break;
                            case 'sourceAmt':
                                $cfd->sourceAmt = (float) $attributeValue;
                                break;
                            case 'vendorRfc':
                                $cfd->vendorRfc = (string) $attributeValue;
                                break;
                            case 'vendorName':
                                $cfd->vendorName = (string) $attributeValue;
                                break;
                            case 'customerRfc':
                                $cfd->customerRfc = (string) $attributeValue;
                                break;
                            case 'customerName':
                                $cfd->customerName = (string) $attributeValue;
                                break;
                            case 'subTotal':
                                $cfd->subTotal = (float) $attributeValue;
                                break;
                            default:
                                // everything else is extra information.
                                $cfdAttribute = new CfdAttribute();
                                $cfdAttribute->code = $attributeName;
                                $cfdAttribute->value = (string) $attributeValue;
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
                                $vendorFiscalAddress->type = AddressTypeBehavior::FISCAL;
                                $cfdAddresses[] = $vendorFiscalAddress;
                                break;
                            case 'customerBillToAddress':
                                $customerBillToAddress = $this->mapAddress($invoiceNode);
                                $customerBillToAddress->type = AddressTypeBehavior::BILL_TO;
                                $cfdAddresses[] = $customerBillToAddress;
                                break;
                            case 'customerShipToAddress':
                                $customerShipToAddress = $this->mapAddress($invoiceNode);
                                $customerShipToAddress->type = AddressTypeBehavior::SHIP_TO;
                                $cfdAddresses[] = $customerShipToAddress;
                                break;
                            case 'items':
                                foreach ($invoiceNode->children() as $invoiceItem) {
                                    $cfdItem = new CfdItem();
                                    $cfdItemAttributes = array();
                                    $cfdItemCustomsPermits = array();
                                    foreach ($invoiceItem->attributes() as $attributeName => $attributeValue) {
                                        switch ($attributeName) {
                                            case 'qty':
                                                $cfdItem->qty = (float) $attributeValue;
                                                break;
                                            case 'uom':
                                                $cfdItem->uom = (string) $attributeValue;
                                                break;
                                            case 'productCode':
                                                $cfdItem->productCode = (string) $attributeValue;
                                                break;
                                            case 'description':
                                                $cfdItem->description = (string) $attributeValue;
                                                break;
                                            case 'productCode':
                                                $cfdItem->productCode = (string) $attributeValue;
                                                break;
                                            case 'unitPrice':
                                                $cfdItem->unitPrice = (float) $attributeValue;
                                                break;
                                            case 'amount':
                                                $cfdItem->amt = (float) $attributeValue;
                                                $subTotal += (float) $attributeValue;
                                                break;
                                            default:
                                                // Everything else is attribute.
                                                $cfdItemAttribute = new CfdItemAttribute();
                                                $cfdItemAttribute->code = $attributeName;
                                                $cfdItemAttribute->value = (string) $attributeValue;
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
                                                $cfdTax->name = (string) $attributeValue;
                                                break;
                                            case 'rate':
                                                $cfdTax->rate = (float) $attributeValue;
                                                break;
                                            case 'amt':
                                                $cfdTax->amt = (float) $attributeValue;
                                                $tax += (float) $attributeValue;
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
                    // Find or create vendor using RFC.
                    // Find RFC
                    $vendorRfc = PartyAttribute::model()
                            ->current()
                            ->find('code = :code and value = :rfc', array(':code' => 'RFC', ':rfc' => $cfd->vendorRfc));
                    if (!$vendorRfc) {
                        // RFC not found.
                        // Create vendor
                        $vendorParty = new Party();
                        $vendorParty->name = mb_strtoupper($cfd->vendorName);
                        $vendorParty->type = (strlen($cfd->vendorRfc) == 13 ? PartyTypeBehavior::PERSON : PartyTypeBehavior::COMPANY);
                        $vendorParty->save();
                        // Create vendor name
                        $vendorName = new PartyName();
                        $vendorName->surName = mb_strtoupper($cfd->vendorName);
                        $vendorName->Party_id = $vendorParty->id;
                        if (!$vendorName->save(false)) print_r($vendorName->getErrors());
                        // Create RFC attribute
                        $vendorRfc = new PartyAttribute();
                        $vendorRfc->Party_id = $vendorParty->id;
                        $vendorRfc->code = 'RFC';
                        $vendorRfc->value = $cfd->vendorRfc;
                        if (!$vendorRfc->save()) print_r($vendorRfc->getErrors());
                    } else {
                        $vendorParty = Party::model()->findByPk($vendorRfc->Party_id);
                    }
                    $cfd->vendorParty_id = $vendorParty->id;
                    // Find or create customer using RFC.
                    // Find RFC
                    $customerRfc = PartyAttribute::model()
                            ->current()
                            ->find('code = :code and value = :rfc', array(':code' => 'RFC', ':rfc' => $cfd->customerRfc));
                    if (!$customerRfc) {
                        // RFC not found.
                        // Create customer
                        $customerParty = new Party();
                        $customerParty->name = mb_strtoupper($cfd->customerName);
                        $customerParty->type = (strlen($cfd->customerRfc) == 13 ? PartyTypeBehavior::PERSON : PartyTypeBehavior::COMPANY);
                        $customerParty->save();
                        // Create customes name
                        $customerName = new PartyName();
                        $customerName->surName = mb_strtoupper($cfd->customerName);
                        $customerName->Party_id = $customerParty->id;
                        $customerName->save(false);
                        // Create RFC attribute
                        $customerRfc = new PartyAttribute();
                        $customerRfc->Party_id = $customerParty->id;
                        $customerRfc->code = 'RFC';
                        $customerRfc->value = $cfd->customerRfc;
                        $customerRfc->save();
                    } else {
                        $customerParty = Party::model()->findByPk($customerRfc->Party_id);
                    }
                    $cfd->customerParty_id = $customerParty->id;
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
                            if (!$cfdAddress->save()) print_r($cfdAddress->getErrors());
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
                                } catch (Exception $e) {

                                }
                            }
                        }
                        // Save taxes
                        foreach ($cfdTaxes as $cfdTax) {
                            $cfdTax->Cfd_id = $cfd->id;
                            $cfdTax->save();
                        }
                        $transaction->commit();
                        // Create XML
                        $cfdXml = $cfd->createXml();
                        $processInvoiceDttm = new DateTime($cfd->dttm);
                        $cfdBasePath = dirname(__FILE__) . '/../files/cfd/' . $cfd->vendorRfc . '/' .
                                $processInvoiceDttm->format('Y') . '/' .
                                $processInvoiceDttm->format('m') . '/' .
                                $processInvoiceDttm->format('d');

                        echo $cfdBasePath . PHP_EOL;

                        // Create dir for rfc if not exists
                        if (!file_exists($cfdBasePath))
                            mkdir($cfdBasePath, 0777, true);

                        $xmlFileName = $cfd->vendorRfc . '_' .
                                ($cfd->serial ? $cfd->serial . '_' : '') .
                                ($cfd->folio ? $cfd->folio . '_' : '') .
                                $cfd->uuid . '_' .
                                $cfd->customerRfc . '.xml';
                        file_put_contents($cfdBasePath . '/' . $xmlFileName, $cfdXml);
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
        $addressReference = '';
        $address = new Address();
        foreach ($node->attributes() as $attributeName => $attributeValue) {
            switch ($attributeName) {
                case 'street':
                    $address->street = (string) $attributeValue;
                    break;
                case 'extNbr':
                    $address->extNbr = (string) $attributeValue;
                    break;
                case 'intNbr':
                    $address->intNbr = (string) $attributeValue;
                    break;
                case 'neighbourhood':
                    $address->neighbourhood = (string) $attributeValue;
                    break;
                case 'city':
                    $address->city = (string) $attributeValue;
                    break;
                case 'reference':
                    $addressReference = (string) $attributeValue;
                    break;
                case 'municipality':
                    $address->municipality = (string) $attributeValue;
                    break;
                case 'state':
                    $address->state = (string) $attributeValue;
                    break;
                case 'country':
                    $address->country = (string) $attributeValue;
                    break;
                case 'zipCode':
                    $address->zipCode = (string) $attributeValue;
                    break;
            }
        }
        if ($node->getName() == 'vendorFiscalAddress') {
            // Find Mexico
            $mexico = Country::model()->find('code = :code', array(':code' => 'MX'));
            $address->Country_id = $mexico->id;
        }
        $addressRec = Address::model()->find('md5 = :md5', array(':md5' => $address->Md5));
        if (!$addressRec) {
            if (!$address->save()) print_r($address->getErrors());
            $addressRec = $address;
        }
        $cfdAddress = new CfdAddress();
        $cfdAddress->Address_id = $addressRec->id;
        if ($addressReference) $cfdAddress->reference = $addressReference;
        return $cfdAddress;
    }

}

?>
