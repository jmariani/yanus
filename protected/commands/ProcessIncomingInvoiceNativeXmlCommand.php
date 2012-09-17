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

    const DEFAULT_PAYMENT_TYPE_VALUE = 'PAGO EN UNA SOLA EXHIBICION';
    const DEFAULT_PAYMENT_METHOD = 'NO DEFINIDO';
    const DEFAULT_CURRENCY_CODE = 'MXN';
    const DEFAULT_EXCHANGE_RATE = 1;

    private $fileName;
    private $logFile;
    private $fileError;
    private $errors = array();

    const LOG_CATEGORY = 'ProcessIncomingInvoiceNativeXmlCommand';

    /**
     * Processes a file with Native XML format.
     * @param array $args arguments for the process.
     * The first parameter is the invoice file with path.
     * @return string the translated message
     */
    private function log($msg, $level = CLogger::LEVEL_INFO, $category = self::LOG_CATEGORY) {
        yii::log($msg, $level, $category);
        error_log(date(DateTime::ISO8601) . ' - ' . '[' . $level . '] ' . $msg . PHP_EOL, 3, "$this->logFile");
    }
    public function run($args) {

        // 1) LOCK FILE
        // 2) When file is locked, try to open it.
        // 3) File is a XML file.
        // 4) Run additional validations that cannot be performed with the schema.
        // 5) Produce a native XML and save it to NATIVE_XML_PATH
//        print_r($args);

        // $args[0] is the file to process
        $this->fileName = $args[0];
        $pathInfo = pathinfo($this->fileName);
        $this->logFile = $pathInfo['dirname'] . DIRECTORY_SEPARATOR . $pathInfo['filename'] . '.log';
        @unlink($this->logFile);

        $this->log(yii::t('app', 'Processing file {file}', array('{file}' => $this->fileName)));

        try {
            // Check if file exists
            if (!file_exists($args[0]))
                throw new CException(yii::t('app', 'File {file} not found.', array('{file}' => $this->fileName)));

            // Try to lock file to ensure is not still be written.
            $fp = fopen($this->fileName, 'r');
            while (!flock($fp, LOCK_EX)) {
                $this->log(yii::t('app', 'Waiting to lock file {file}', array('{file}' => $this->fileName)));
            }
            flock($fp, LOCK_UN);
            libxml_use_internal_errors(true);
            // File was succesfully locked, so we can open it.
            // Test if the file is a proper XML.
            $xml = simplexml_load_file($this->fileName);
            if (!$xml) {
                $this->log(yii::t('app', 'XML Error opening file {file}', array('{file}' => $this->fileName)), CLogger::LEVEL_ERROR);
                $xmlErrors = libxml_get_errors();
                foreach ($xmlErrors as $xmlError) {
                    $this->log('[LIBXML][' . $xmlError->code . '] ' . $xmlError->message, CLogger::LEVEL_ERROR);
                }
                yii::app()->end();
            } else {
                foreach ($xml->children() as $invoice) {
                    $cfdAttributes = array();
                    $cfdAddresses = array();
                    $cfdDiscounts = array();
                    $cfdFiscalRegimes = array();
                    $cfdItems = array();
                    $cfdNotes = array();
                    $cfdTaxes = array();
                    $cfd = new Cfd();
                    $cfd->CfdStatus_id = CfdStatus::model()->find('code = :code', array(':code' => CfdStatus::NEWCFD))->id;
                    // Parse attributes.
                    foreach ($invoice->attributes() as $attributeName => $attributeValue) {
                        switch ($attributeName) {
                            case 'version':
                                $cfd->version = (string) $attributeValue;
                                break;
                            case 'invoice':
                                $cfd->invoice = (string) $attributeValue;
                                break;
                            case 'serie':
                                if ((string) $attributeValue)
                                    $cfd->serial = (string) $attributeValue;
                                break;
                            case 'folio':
                                if ((string) $attributeValue)
                                    $cfd->folio = (string) $attributeValue;
                                break;
                            case 'fecha':
                                $cfd->dttm = (string) $attributeValue;
                                break;
                            case 'formaDePago':
                                $cfd->paymentType = (string) $attributeValue;
                                break;
                            case 'condicionesDePago':
                                if ((string) $attributeValue)
                                    $cfd->paymentTerm = (string) $attributeValue;
                                break;
                            case 'Moneda':
                                $cfd->currency = (string) $attributeValue;
                                // Find currency in db
                                $currencyRec = Currency::model()->find('code = :code', array(':code' => $cfd->currency));
                                if ($currencyRec)
                                    $cfd->Currency_id = $currencyRec->id;
                                break;
                            case 'TipoCambio':
                                if (trim($attributeValue))
                                    $cfd->exchangeRate = (float) $attributeValue;
                                break;
                            case 'tipoDeComprobante':
                                $cfd->voucherType = (string) $attributeValue;
                                break;
                            case 'metodoDePago':
                                $cfd->paymentMethod = (string) $attributeValue;
                                break;
                            case 'LugarExpedicion':
                                $cfd->expeditionPlace = (string) $attributeValue;
                                break;
                            case 'noCertificado':
                                if ((string) $attributeValue)
                                    $cfd->certNbr = (string) $attributeValue;
                                break;
                            case 'certificado':
                                if ((string) $attributeValue)
                                    $cfd->certificate = (string) $attributeValue;
                                break;
                            case 'descuento':
                                $cfd->discount = (float) $attributeValue;
                                break;
                            case 'motivoDescuento':
                                $cfd->discountReason = (string) $attributeValue;
                                break;
                            case 'subTotal':
                                $cfd->subTotal = (float) $attributeValue;
                                break;
//                            case 'seal':
//                                if ((string) $attributeValue)
//                                    $cfd->seal = (string) $attributeValue;
//                                break;
//                            case 'total':
//                                $cfd->total = (float) $attributeValue;
//                                break;
                            case 'NumCtaPago':
                                $cfd->paymentAcctNbr = (string) $attributeValue;
                                break;
//                            case 'sourceFolio':
//                                $cfd->sourceFolio = $attributeValue;
//                                break;
//                            case 'sourceSerial':
//                                $cfd->sourceSerial = (string) $attributeValue;
//                                break;
//                            case 'sourceDttm':
//                                $cfd->sourceDttm = (string) $attributeValue;
//                                break;
//                            case 'sourceAmt':
//                                $cfd->sourceAmt = (float) $attributeValue;
//                                break;
//                            case 'taxAmt':
//                                $cfd->taxAmt = (float) $attributeValue;
//                                break;
//                            case 'wthAmt':
//                                $cfd->wthAmt = (float) $attributeValue;
//                                break;
//                            case 'dtsVersion':
//                                $cfd->dtsVersion = $attributeValue;
//                                break;
//                            case 'dtsDttm':
//                                $cfd->dtsDttm = $attributeValue;
//                                break;
//                            case 'dtsSatCertNbr':
//                                $cfd->dtsSatCertNbr = $attributeValue;
//                                break;
//                            case 'dtsSatSeal':
//                                $cfd->dtsSatSeal = $attributeValue;
//                                break;
//                            case 'dtsOriginalString':
//                                $cfd->dtsOriginalString = $attributeValue;
//                                break;
//                            case 'approvalNbr':
//                                $cfd->approvalNbr = $attributeValue;
//                                break;
//                            case 'approvalYear':
//                                $cfd->approvalYear = $attributeValue;
//                                break;
//                            case 'originalString':
//                                $cfd->originalString = $attributeValue;
//                                break;
//                            case 'cbb':
//                                $cfd->cbb = $attributeValue;
//                                break;
//                            case 'localTaxAmt':
//                                $cfd->localTaxAmt = $attributeValue;
//                                break;
//                            case 'localWhtAmt':
//                                $cfd->localWhtAmt = $attributeValue;
//                                break;
                            default:
                                // everything else is extra information.
                                $cfdAttribute = new CfdAttribute();
                                $cfdAttribute->code = $attributeName;
                                $cfdAttribute->value = (string) $attributeValue;
                                $cfdAttributes[] = $cfdAttribute;
                                break;
                        }
                    }

//                    // Process vendor & customer
                    $customer = false;
                    $customerCode = '';
                    $customerName = '';
                    $customerRfc = '';
                    $customerAttributes = array();
                    $vendor = false;
                    $vendorName = '';
                    $vendorRfc = '';
                    $vendorAttributes = array();
                    $vendorPhoneLocators = array();
//
                    foreach ($invoice->children() as $invoiceNode) {
                        switch ($invoiceNode->getName()) {
                            case 'Emisor':
                                foreach ($invoiceNode->attributes() as $aName => $aValue) {
                                    switch ($aName) {
                                        case 'rfc':
                                            // Find vendor
                                            $vendorRfc = (string) $aValue;
                                            $rfcRec = PartyIdentifier::model()->current()->find('name = :name and value = :value', array(':name' => PartyIdentifier::RFC, ':value' => $vendorRfc));
                                            if ($rfcRec) {
                                                $vendor = $rfcRec->party;
                                                $cfd->vendorParty_id = $rfcRec->party->id;
                                            }
                                            break;
                                        case 'nombre':
                                            $vendorName = (string) $aValue;
                                            break;
                                        default:
                                            $vendorAttribute = new PartyAttribute();
                                            $vendorAttribute->code = $aName;
                                            $vendorAttribute->value = $aValue;
                                            $vendorAttributes[] = $vendorAttribute;
                                            break;
                                    }
                                }
                                if (!$vendor) {
                                    // No vendor found
                                    // Create new one
                                    $vendor = new Party();
                                    $vendor->person = (strlen($vendorRfc) == 13);
                                    if (!$vendor->save()) print_r($vendor->getErrors());
                                    // Create identifier
                                    $rfcRec = new PartyIdentifier();
                                    $rfcRec->name = PartyIdentifier::RFC;
                                    $rfcRec->value = $vendorRfc;
                                    $rfcRec->Party_id = $vendor->id;
                                    $rfcRec->save();
                                    // Create name
                                    $nameRec = new PartyName();
                                    $nameRec->fullName = $vendorName;
                                    $nameRec->Party_id = $vendor->id;
                                    $nameRec->save();
                                    // Save vendor characteristics
                                    foreach ($vendorAttributes as $vendorAttribute) {
                                        $vendorAttribute->Party_id = $vendor->id;
                                        $vendorAttribute->save();
                                    }
                                }
                                // Parse Emisor children
                                foreach ($invoiceNode->children() as $emisorNode) {
                                    switch ($emisorNode->getName()) {
                                        case 'DomicilioFiscal':
                                            // Vendor primary address
                                            $address = $this->mapAddress($emisorNode);
                                            $cfdAddress = new CfdAddress();
                                            $cfdAddress->Address_id = $address->id;
                                            $cfdAddress->AddressType_id = AddressType::model()->find('code = :code', array(':code' => AddressType::PRIMARY))->id;
                                            if ($emisorNode->attributes()->referencia)
                                                $cfdAddress->reference = $emisorNode->attributes()->referencia;
                                            if ($emisorNode->attributes()->name)
                                                $cfdAddress->name = $emisorNode->attributes()->name;
                                            $cfdAddresses[] = $cfdAddress;
                                            $cfd->expeditionPlace = '';
                                            if ($address->State_id)
                                                $cfd->expeditionPlace = $address->state0->name . ', ';
                                            else
                                                $cfd->expeditionPlace = $address->state . ', ';
                                            if ($address->Country_id)
                                                $cfd->expeditionPlace .= $address->country0->name;
                                            else
                                                $cfd->expeditionPlace .= $address->country;
                                            break;
                                        case 'ExpedidoEn':
                                            // Vendor issuing address
                                            $address = $this->mapAddress($emisorNode);
                                            $cfdAddress = new CfdAddress();
                                            $cfdAddress->Address_id = $address->id;
                                            $cfdAddress->AddressType_id = AddressType::model()->find('code = :code', array(':code' => AddressType::ISSUING))->id;
                                            if ($emisorNode->attributes()->referencia)
                                                $cfdAddress->reference = $emisorNode->attributes()->referencia;
                                            if ($emisorNode->attributes()->name)
                                                $cfdAddress->name = $emisorNode->attributes()->name;
                                            $cfdAddresses[] = $cfdAddress;
                                            $cfd->expeditionPlace = '';
                                            if ($address->State_id)
                                                $cfd->expeditionPlace = $address->state0->name . ', ';
                                            else
                                                $cfd->expeditionPlace = $address->state . ', ';
                                            if ($address->Country_id)
                                                $cfd->expeditionPlace .= $address->country0->name;
                                            else
                                                $cfd->expeditionPlace .= $address->country;
                                            break;
                                        case 'RegimenFiscal':
                                            $fiscalRegime = new CfdTaxRegime();
                                            $fiscalRegime->name = $emisorNode->attributes()->Regimen;
                                            $cfdFiscalRegimes[] = $fiscalRegime;
                                            break;
                                    }
                                }
                                break;
                            case 'Receptor':
                                foreach ($invoiceNode->attributes() as $aName => $aValue) {
                                    switch ($aName) {
                                        case 'customerCode':
                                            // Find customer
                                            $customerCode = (string) $aValue;
                                            break;
                                        case 'rfc':
                                            $customerRfc = (string) $aValue;
                                            break;
                                        case 'nombre':
                                            $customerName = (string) $aValue;
                                            break;
                                        default:
                                            $customerAttribute = new PartyAttribute();
                                            $customerAttribute->code = $aName;
                                            $customerAttribute->value = $aValue;
                                            $customerAttributes[] = $customerAttribute;
                                            break;
                                    }
                                }
                                if ($customerCode)
                                    $customerIdRec = PartyIdentifier::model()->current()->find('name = :name and value = :value', array(':name' => PartyIdentifier::CUSTOMER_CODE, ':value' => $customerCode));
                                else
                                    $customerIdRec = PartyIdentifier::model()->current()->find('name = :name and value = :value', array(':name' => PartyIdentifier::RFC, ':value' => $customerRfc));
                                if ($customerIdRec)
                                    $customer = $customerIdRec->party;
                                else {
                                    // Create customer
                                    $customer = new Party();
                                    $customer->person = (strlen($customerRfc) == 13);
                                    if (!$customer->save()) print_r($customer->getErrors());
                                    // Create identifier
                                    $rfcRec = new PartyIdentifier();
                                    $rfcRec->name = PartyIdentifier::RFC;
                                    $rfcRec->value = $customerRfc;
                                    $rfcRec->Party_id = $customer->id;
                                    $rfcRec->save();
                                    if ($customerCode) {
                                        $rfcRec = new PartyIdentifier();
                                        $rfcRec->name = PartyIdentifier::CUSTOMER_CODE;
                                        $rfcRec->value = $customerCode;
                                        $rfcRec->Party_id = $customer->id;
                                        $rfcRec->save();
                                    }
                                    // Create name
                                    $nameRec = new PartyName();
                                    $nameRec->fullName = $customerName;
                                    $nameRec->Party_id = $customer->id;
                                    $nameRec->save();
                                    // Save customer characteristics
                                    foreach ($customerAttributes as $customerAttribute) {
                                        $customerAttribute->Party_id = $customer->id;
                                        $customerAttribute->save();
                                    }
                                }
                                $cfd->customerParty_id = $customer->id;

                                // Parse Receptor children
                                foreach ($invoiceNode->children() as $receptorNode) {
                                    switch ($receptorNode->getName()) {
                                        case 'Domicilio':
                                            // Vendor primary address
                                            $address = $this->mapAddress($receptorNode);
                                            $cfdAddress = new CfdAddress();
                                            $cfdAddress->Address_id = $address->id;
                                            $cfdAddress->AddressType_id = AddressType::model()->find('code = :code', array(':code' => AddressType::BILL_TO))->id;
                                            if ($receptorNode->attributes()->referencia)
                                                $cfdAddress->reference = $receptorNode->attributes()->referencia;
                                            if ($receptorNode->attributes()->name)
                                                $cfdAddress->name = $receptorNode->attributes()->name;
                                            $cfdAddresses[] = $cfdAddress;
                                            break;
                                        case 'DomicilioDeEnvio':
                                            // Vendor issuing address
                                            $address = $this->mapAddress($receptorNode);
                                            $cfdAddress = new CfdAddress();
                                            $cfdAddress->Address_id = $address->id;
                                            $cfdAddress->AddressType_id = AddressType::model()->find('code = :code', array(':code' => AddressType::SHIP_TO))->id;
                                            if ($receptorNode->attributes()->referencia)
                                                $cfdAddress->reference = $receptorNode->attributes()->referencia;
                                            if ($receptorNode->attributes()->name)
                                                $cfdAddress->name = $receptorNode->attributes()->name;
                                            $cfdAddresses[] = $cfdAddress;
                                            break;
                                    }
                                }
                                break;
                            case 'Notas':
                                // Parse Receptor children
                                foreach ($invoiceNode->children() as $noteNode) {
                                    $cfdNote = new CfdNote();
                                    $cfdNote->value = $noteNode->attributes()->nota;
                                    $cfdNotes[] = $cfdNote;
                                }
                                break;
                            case 'Descuentos':
                                // Parse Receptor children
                                foreach ($invoiceNode->children() as $discountNode) {
                                    $cfdDiscount = new CfdDiscount();
                                    $cfdDiscount->reason = $discountNode->attributes()->motivo;
                                    $cfdDiscount->amt = $discountNode->attributes()->importe;
                                    $cfdDiscounts[] = $cfdDiscount;
                                }
                                break;
                            case 'Conceptos':
                                foreach ($invoiceNode->children() as $item) {
                                    $cfdItem = new CfdItem();
                                    $cfdItemAttributes = array();
                                    $cfdItemCustomsPermits = array();
                                    foreach ($item->attributes() as $aName => $aValue) {
                                        switch ($aName) {
                                            case 'cantidad':
                                                $cfdItem->qty = (float) $aValue;
                                                break;
                                            case 'unidad':
                                                $cfdItem->uom = (string) $aValue;
                                                break;
                                            case 'descripcion':
                                                $cfdItem->description = (string) $aValue;
                                                break;
                                            case 'noIdentificacion':
                                                $cfdItem->productCode = (string) $aValue;
                                                break;
                                            case 'valorUnitario':
                                                $cfdItem->unitPrice = (float) $aValue;
                                                break;
                                            default:
                                                $itemAttribute = new CfdItemAttribute();
                                                $itemAttribute->code = $aName;
                                                $itemAttribute->value = $aValue;
                                                $cfdItemAttributes[] = $itemAttribute;
                                                break;
                                        }
                                    }
                                    foreach ($item->children() as $itemChild) {
                                        switch ($itemChild->getName()) {
                                            case 'InformacionAduanera':
                                                $cfdItemCustomsPermit = new CfdItemHasCustomsPermit();
                                                $cfdItemCustomsPermit->CustomsPermit_id = $this->mapCustomsPermit($itemChild)->id;
                                                $cfdItemCustomsPermits[] = $cfdItemCustomsPermit;
                                                break;
                                        }
                                    }
                                    $cfdItems[] = array($cfdItem, $cfdItemAttributes, $cfdItemCustomsPermits);
                                }
                                break;
                            case 'Impuestos':
                                foreach ($invoiceNode->children() as $taxNode) {
                                    switch ($taxNode->getName()) {
                                        case 'Traslados':
                                            foreach ($taxNode->children() as $traslado) {
                                                $cfdTax = new CfdTax();
                                                $cfdTax->name = $traslado->attributes()->impuesto;
                                                $cfdTax->rate = $traslado->attributes()->tasa;
                                                $cfdTax->amt = $traslado->attributes()->importe;
                                                $cfdTax->local = false;
                                                $cfdTax->withHolding = false;
                                                $cfdTaxes[] = $cfdTax;
                                            }
                                            break;
                                    }
                                }
                        }
                    }
                    $transaction = $cfd->model()->dbConnection->beginTransaction();

//                    // Certificate
//                    $satCertificate = SatCertificate::model()->find('nbr = :nbr', array(':nbr' => $cfd->certNbr));
//                    $cfd->SatCertificate_id = $satCertificate->id;
//                    $cfd->CfdStatus_id = CfdStatus::model()->find('code = :code', array(':code' => CfdStatus::NEWCFD))->id;
                    // Create the Cfd
                    if (!$cfd->save()) {
                        print_r($cfd->getErrors());
                        $transaction->rollBack();
                        yii::app()->end();
                    }
                    // Save CFD Attributes
                    foreach ($cfdAttributes as $cfdAttribute) {
                        $cfdAttribute->Cfd_id = $cfd->id;
                        $cfdAttribute->save();
                    }
                    // Save CFD Addresses
                    foreach ($cfdAddresses as $cfdAddress) {
                        $cfdAddress->Cfd_id = $cfd->id;
                        $cfdAddress->save();
                    }
                    // Save Fiscal Regimes
                    foreach ($cfdFiscalRegimes as $cfdFiscalRegime) {
                        $cfdFiscalRegime->Cfd_id = $cfd->id;
                        $cfdFiscalRegime->save();
                    }
                    // Save Notes
                    foreach ($cfdNotes as $cfdNote) {
                        $cfdNote->Cfd_id = $cfd->id;
                        $cfdNote->save();
                    }
                    // Save Discounts
                    foreach ($cfdDiscounts as $cfdDiscount) {
                        $cfdDiscount->Cfd_id = $cfd->id;
                        $cfdDiscount->save();
                    }
                    // Save Items
                    foreach ($cfdItems as $cfdItem) {
                        $cfdItem[0]->Cfd_id = $cfd->id;
                        $cfdItem[0]->save();
                        foreach ($cfdItem[1] as $cfdItemAttribute) {
                            $cfdItemAttribute->CfdItem_id = $cfdItem[0]->id;
                            $cfdItemAttribute->save();
                        }
                        foreach ($cfdItem[2] as $cfdItemCustomsPermit) {
                            $cfdItemCustomsPermit->CfdItem_id = $cfdItem[0]->id;
                            $cfdItemCustomsPermit->save();
                        }
                    }
                    // Save Taxes
                    foreach ($cfdTaxes as $cfdTax) {
                        $cfdTax->Cfd_id = $cfd->id;
                        $cfdTax->save();
                    }

                    // Create XML
//                    $cfdXml = $cfd->createXml();
//                    if (!$cfdXml) {
//                        $cfd->CfdStatus_id = CfdStatus::model()->find('code = :code', array(':code' => CfdStatus::ERROR))->id;
//                        $cfd->errorMsg = '';
//                        foreach ($cfd->getErrors('id') as $cfdError) {
//                            $cfd->errorMsg .= $cfdError . PHP_EOL;
//                        }
//                        $cfd->save();
//                    } else {
////                        $processInvoiceDttm = new DateTime($cfd->dttm);
////                        $cfdBasePath = yii::app()->getBasePath() . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'files' .
////                                DIRECTORY_SEPARATOR . 'cfd' . DIRECTORY_SEPARATOR . $cfd->vendorRfc . DIRECTORY_SEPARATOR .
////                                $processInvoiceDttm->format('Y') . DIRECTORY_SEPARATOR .
////                                $processInvoiceDttm->format('m') . DIRECTORY_SEPARATOR .
////                                $processInvoiceDttm->format('d') . DIRECTORY_SEPARATOR .
////                                $cfd->invoice;
////
////                        echo $cfdBasePath . PHP_EOL;
//
//                        // Create dir for rfc if not exists
//                        if (!file_exists($cfd->getBasePath()))
//                            mkdir($cfd->getBasePath(), 0777, true);
//
////                        $xmlFileName = $cfd->vendorRfc . '_' .
////                                $cfd->invoice . '_' .
////                                $cfd->customerRfc . '.xml';
//                        file_put_contents($cfd->getBasePath() . DIRECTORY_SEPARATOR . $cfd->getXmlFileName(), $cfdXml);
//                        $cfd->CfdStatus_id = CfdStatus::model()->find('code = :code', array(':code' => CfdStatus::ISSUED))->id;
//                        $cfd->errorMsg = '';
//                        $cfd->save();
//                    }
                    $transaction->commit();
                }
            }
        } catch (CException $e) {
            $this->log($e->getMessage(), CLogger::LEVEL_ERROR);
//            yii::log($e->getMessage(), CLogger::LEVEL_ERROR, $this->name);
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
                case 'calle':
                    $address->street = (string) $attributeValue;
                    break;
                case 'noExterior':
                    $address->extNbr = (string) $attributeValue;
                    break;
                case 'noInterior':
                    $address->intNbr = (string) $attributeValue;
                    break;
                case 'colonia':
                    $address->neighbourhood = (string) $attributeValue;
                    break;
                case 'localidad':
                    $address->city = (string) $attributeValue;
                    break;
                case 'municipio':
                    $address->municipality = (string) $attributeValue;
                    break;
                case 'estado':
                    $address->state = (string) $attributeValue;
                    break;
                case 'pais':
                    $address->country = (string) $attributeValue;
                    break;
                case 'codigoPostal':
                    $address->zipCode = (string) $attributeValue;
                    break;
            }
        }
        $addressRec = Address::model()->find('md5 = :md5', array(':md5' => $address->Md5));
        if (!$addressRec) {
            if (!$address->save()) print_r($address->getErrors());
            $addressRec = $address;
        }
        return $addressRec;
    }

    private function mapCustomsPermit($node) {
        $nbr = $node->attributes()->numero;
        $customsPermit = CustomsPermit::model()->find('nbr = :nbr', array(':nbr' => $nbr));
        if (!$customsPermit) {
            $customsPermit = new CustomsPermit();
            $customsPermit->nbr = $nbr;
            $customsPermit->dt = $node->attributes()->fecha;
            $customsPermit->office = $node->attributes()->aduana;
            $customsPermit->save();
        }
        return $customsPermit;
    }
}

?>
