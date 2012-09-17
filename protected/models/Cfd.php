<?php

Yii::import('application.models._base.BaseCfd');

class Cfd extends BaseCfd {

    const DEFAULT_PAYMENT_TYPE = 'PAGO EN UNA SOLA EXHIBICION';
    const DEFAULT_PAYMENT_METHOD = 'NO IDENTIFICADO';

    public $addresses = array(); // Array holding CfdAddress()
    public $cfdXmlFile;

    public $chars = array(); // array of Cfd characteristics. char[CODE] = VALUE
    public $customer; // Object holding customer
    public $_customsPermits = array(); //Array of customs permits.

    public $discounts = array(); // Array of CfdDiscount.

    public $items = array(); // array of cfd items

    public $notes = array(); // Array of notes.

    public $taxes = array(); // Array of tax objects.
    public $taxRegimes = array(); // Array of cfd tax regimes.

    public $vendor; // Object holding vendor

    public $vendorFiscalAddress;

    // RelatedData
    // RelatedData['CfdItem'] = array(CfdItem1, CfdItem2, etc)
    // RelatedData['CfdAttribute'] = array(CfdAttribute1, CfdAttribute2, etc)

    public $relatedData = array();

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function afterFind() {
        $this->vendor = $this->vendorParty;
        $this->customer = $this->customerParty;
        return parent::afterFind();
    }
    public function afterSave() {
        if ($this->isNewRecord) {
            $this->saveAddresses();
            $this->saveChars();
            $this->saveCustomsPermits();
            $this->saveDiscounts();
            $this->saveItems();
            $this->saveNotes();
            $this->saveTaxes();
            $this->saveTaxRegimes();
        }
        return parent::afterSave();
    }
    public function beforeSave() {
//        $this->invoice = $this->serial . $this->folio;
//        if (!$this->invoice)
//            $this->invoice = $this->uuid;
//        $this->paymentType = ($this->paymentType ? : self::DEFAULT_PAYMENT_TYPE);
//        $this->paymentMethod = ($this->paymentMethod ? : self::DEFAULT_PAYMENT_METHOD);
//        $this->total = $this->subTotal - $this->discount + $this->taxAmt + $this->localTaxAmt - $this->wthAmt - $this->localWhtAmt;

//        if ($this->isNewRecord) {
//            if ($this->vendor) {
//                $this->vendorParty_id = $this->vendor->id;
//                $this->SatCertificate_id = SatCertificate::model()->current()->find('rfc = :rfc', array(':rfc' => $this->vendor->rfc))->id;
//            } else {
//                $this->addError ('vendor', yii::t('app', 'Vendor cannot be null.'));
//                return false;
//            }
//            if ($this->customer)
//                $this->customerParty_id = $this->customer->id;
//            else {
//                $this->addError ('customer', yii::t('app', 'Customer cannot be null.'));
//                return false;
//            }
//            if ($this->customer)
//                $this->customerParty_id = $this->customer->id;
//            else {
//                $this->addError ('customer', yii::t('app', 'Customer cannot be null.'));
//                return false;
//            }
//
////            if ($this->vendor)
////                $this->vendorParty_id = $this->vendor->id;
////            if ($this->customer)
////                $this->customerParty_id = $this->customer->id;
//            $this->md5 = md5($this->getHash());
////            $this->status = CfdStatusBehavior::CREATED;
//        }
        return parent::beforeSave();
    }
    public function beforeValidate() {
//        if ($this->isNewRecord) {
//            if ($this->vendor) {
//                $this->vendorParty_id = $this->vendor->id;
//                $satCertificate = SatCertificate::model()->current()->find('rfc = :rfc', array(':rfc' => $this->vendor->rfc));
//                if (!$satCertificate) {
//                    $this->addError ('SatCertificate_id', yii::t('app', 'Cannot find a current certificate for vendor.'));
//                    return false;
//                } else
//                    $this->SatCertificate_id = $satCertificate->id;
//            } else {
//                $this->addError ('vendor', yii::t('app', 'Vendor cannot be null.'));
//                return false;
//            }
//            if ($this->customer)
//                $this->customerParty_id = $this->customer->id;
//            else {
//                $this->addError ('customer', yii::t('app', 'Customer cannot be null.'));
//                return false;
//            }
//            $this->md5 = md5($this->getHash());
//        }
        return parent::beforeValidate();
    }
    public function behaviors() {
        return array(
            'CTimestampBehavior' => array(
                'class' => 'zii.behaviors.CTimestampBehavior',
                'createAttribute' => 'creationDt',
                'updateAttribute' => 'updateDt',
            ),
            'VoucherType' => array(
                'class' => 'CfdTypeBehavior',
                'attribute' => 'voucherType',
            ),
        );
    }

    public function createOriginalString(SimpleXMLElement $xml) {
        libxml_use_internal_errors(true);
        $xslt = new XSLTProcessor();
        $xsl = new DOMDocument("1.0", "UTF-8");
//        $xsl->substituteEntities = true;

        $version = $xml->attributes()->version;
//        $xsltFile = SystemConfig::getValue(SystemConfig::CFD_OS_XSLT . $version);
        $xsltFile = SatHelper::getXslt(SystemConfig::CFD_OS_XSLT . $version);

        if (!@$xsl->load($xsltFile, LIBXML_NOCDATA)) {
            $this->addError('id', yii::t('app', 'Cannot retrieve XSLT file "{file}"', array('{file}' => $xsltFile)));
            throw new CException(yii::t('app', 'Cannot retrieve XSLT file "{file}"', array('{file}' => $xsltFile)));
            return false;
        }

        @$xslt->importStylesheet($xsl);

        $dom = new DOMDocument("1.0", "UTF-8");
        $dom->loadXML($xml->saveXML());

        $originalString = $xslt->transformToXml($dom);
        if (!$originalString) {
            $errors = array();
            $errors[] = yii::t('app', 'Error retrieving original string');
            foreach (libxml_get_errors() as $xmlError) {
                $errors[] = $xmlError->message . ' ' . yii::t('app', 'at line') . ': ' . $xmlError->line;
            }
            $this->addErrors(array('id' => $errors));
            throw new CException(yii::t('app', 'Error retrieving original string'));
            return false;
        } else {
            $this->Char = array('ORIGINAL_STRING', $originalString);
            return $originalString;
        }
    }

    public function createSignature(SimpleXMLElement $xml, SatCertificate $certificate) {
        if (!$this->originalString)
            $this->originalString = $this->createOriginalString($xml);

        $pemKey = "-----BEGIN ENCRYPTED PRIVATE KEY-----\n" . chunk_split($certificate->keyPem, 64, "\n") . "-----END ENCRYPTED PRIVATE KEY-----\n";

        $pkeyid = openssl_get_privatekey(array($pemKey, $certificate->keyPassword));
        if (!$pkeyid) {
            $this->addError('id', yii::t('app', 'Cannot retrieve private key from certificate'));
            throw new CException(yii::t('app', 'Cannot retrieve private key from certificate'));
            return false;
        }
        if (!openssl_sign($this->originalString, $cryptStamp, $pkeyid, OPENSSL_ALGO_SHA1)) {
            $this->addError('id', yii::t('app', 'Error signing CFD'));
            throw new CException(yii::t('app', 'Error signing CFD'));
            return false;
        }
        openssl_free_key($pkeyid);
        $stamp = base64_encode($cryptStamp);             // lo codifica en formato base64
        return $stamp;
    }

    public function createXml() {

        if (!$this->id) {
            $this->addError('id', yii::t('app', 'Invoice must be saved before a CFD can be created.'));
            throw new CException(yii::t('app', 'Invoice must be saved before a CFD can be created.'));
        }
        // This will create a SAT compliant XML
        // Returns the XML
        // Depending on the CFD version, it will also invoke the PAC WebService.
        // Find certificate for the issuer.
        $runMode = SystemConfig::getValue(SystemConfig::RUN_MODE);
        if ($runMode == SystemConfig::RUN_MODE_PRODUCTION) {
            $vendorRfc = $this->vendor->rfc;
            $vendorName = $this->vendor->name;
            $certificate = $this->satCertificate;
            $cfdDate = new DateTime($this->dttm);
        } else {
            $vendorRfc = SystemConfig::getValue(SystemConfig::DEMO_RFC);
            $cfdDate = new DateTime();
            $cfdDate = $cfdDate->sub(DateInterval::createFromDateString("15 minutes"));

            // Get certificate for demo RFC
            $certificate = SatCertificate::model()->current()->find('rfc = :rfc', array(':rfc' => $vendorRfc));
            if (!$certificate) {
                $this->addError('satCertificate_id', yii::t('app', 'Cannot find a valid certificate for RFC "{rfc}"', array('{rfc}' => $vendorRfc)));
                throw new CException(yii::t('app', 'Cannot find a valid certificate for RFC "{rfc}"', array('{rfc}' => $vendorRfc)));
            }
            $vendorName = $certificate->name;
        }

        // Create document
        $xml = new DOMDocument("1.0", "UTF-8");
        $root = $xml->createElementNS("http://www.sat.gob.mx/cfd/3", "cfdi:Comprobante");
        $root->setAttribute("xsi:schemaLocation", "http://www.sat.gob.mx/cfd/3 " . SystemConfig::getValue(SystemConfig::CFD_XSD . $this->version));
        $root->setAttribute("xmlns:xsi", "http://www.w3.org/2001/XMLSchema-instance");

        $root = $xml->appendChild($root);

        // Set comprobante attributes.
        // Version
        $root->setAttribute("version", $this->version);
        // Serie
        if ($this->serial) $root->setAttribute("serie", $this->serial);
        // Folio
        if ($this->folio) $root->setAttribute("folio", $this->folio);
        // Fecha
        if (strlen($cfdDate->format(DateTime::ISO8601)) == 19) $root->setAttribute("fecha", $cfdDate->format(DateTime::ISO8601));
        else $root->setAttribute("fecha", substr($cfdDate->format(DateTime::ISO8601), 0, strlen($cfdDate->format(DateTime::ISO8601)) - 5));
        // formaDePago
        $root->setAttribute("formaDePago", $this->paymentType);
        // nocertificado
        $root->setAttribute("noCertificado", $certificate->nbr);
        // certificado
        $root->setAttribute("certificado", $certificate->pem);
        // condicionesDePago
        if ($this->paymentTerm) $root->setAttribute("condicionesDePago", $this->paymentTerm);
        elseif ($this->PaymentTerm_id) $root->setAttribute("condicionesDePago", $this->paymentTerm0->name);
        // subTotal
        $root->setAttribute("subTotal", number_format($this->subTotal, 6, ".", ""));
        // descuento
        if ($this->discount > 0) {
            $root->setAttribute("descuento", number_format($this->discount, 6, ".", ""));
            // motivoDescuento
            if ($this->discountReason)
                $root->setAttribute("motivoDescuento", $this->discountReason);
        }
        // TipoCambio
        if ($this->exchangeRate)
            $root->setAttribute("TipoCambio", $this->exchangeRate);
        // Moneda
        if ($this->currency)
            $root->setAttribute("Moneda", $this->currency);
        // total
        $root->setAttribute("total", number_format($this->total, 6, ".", ""));
        // tipoDeComprobante
        $root->setAttribute("tipoDeComprobante", $this->voucherType);
        // metodoDePago
        $root->setAttribute("metodoDePago", $this->paymentMethod);

        if ($this->version == '3.2') {
            // LugarExpedicion
            $root->setAttribute("LugarExpedicion", $this->expeditionPlace);
            // NumCtaPago
            if ($this->paymentAcctNbr)
                $root->setAttribute("NumCtaPago", $this->paymentAcctNbr);
        }

        // Emisor
        $emisor = $root->appendChild($xml->createElement("cfdi:Emisor"));
        // RFC
        $emisor->setAttribute("rfc", $this->vendor->rfc);
        // Nombre emisor
        $emisor->setAttribute("nombre", $this->vendor->name);

        // Receptor
        $receptor = $root->appendChild($xml->createElement("cfdi:Receptor"));
        // RFC receptor
        $receptor->setAttribute("rfc", $this->customer->rfc);
        // Nombre receptor
        $receptor->setAttribute("nombre", $this->customer->name);

        //Domicilios.
        foreach ($this->cfdAddresses as $cfdAddress) {
            switch ($cfdAddress->addressType->code) {
                case AddressType::PRIMARY:
                    // Domicilio fiscal del emisor
                    $address = $emisor->appendChild($xml->createElement("cfdi:DomicilioFiscal"));
                    break;
                case AddressType::ISSUING:
                    // Expedido en
                    $address = $emisor->appendChild($xml->createElement("cfdi:ExpedidoEn"));
                    break;
                case AddressType::BILL_TO:
                    // Domicilio fiscal del receptor
                    $address = $receptor->appendChild($xml->createElement("cfdi:Domicilio"));
                    break;
                default:
                    continue;
            }
            // Street
            if ($cfdAddress->address->street)
                $address->setAttribute('calle', $cfdAddress->address->street);
            // noExterior
            if ($cfdAddress->address->extNbr)
                $address->setAttribute('noExterior', $cfdAddress->address->extNbr);
            // noInterior
            if ($cfdAddress->address->intNbr)
                $address->setAttribute('noInterior', $cfdAddress->address->intNbr);
            // colonia
            if ($cfdAddress->address->neighbourhood)
                $address->setAttribute('colonia', $cfdAddress->address->neighbourhood);
            // localidad
            if ($cfdAddress->address->city)
                $address->setAttribute('localidad', $cfdAddress->address->city);
            // referencia
            if ($cfdAddress->reference)
                $address->setAttribute('referencia', $cfdAddress->reference);
            // municipio
            if ($cfdAddress->address->municipality)
                $address->setAttribute('municipio', $cfdAddress->address->municipality);
            // estado
            if ($cfdAddress->address->state)
                $address->setAttribute('estado', $cfdAddress->address->state);
            // pais
            if ($cfdAddress->address->country)
                $address->setAttribute('pais', $cfdAddress->address->country);
            // codigoPostal
            $address->setAttribute("codigoPostal", $cfdAddress->address->zipCode);
        }
        // Nodo Regimen Fiscal
        if ($this->version == '3.2') {
            foreach ($this->cfdTaxRegimes as $taxRegime) {
                $regimenFiscal = $emisor->appendChild($xml->createElement("cfdi:RegimenFiscal"));
                $regimenFiscal->setAttribute("Regimen", $taxRegime->name);
            }
        }
        // Nodo conceptos
        $conceptos = $root->appendChild($xml->createElement("cfdi:Conceptos"));
        foreach ($this->cfdItems as $cfdItem) {
            $item = $conceptos->appendChild($xml->createElement("cfdi:Concepto"));
            // cantidad
            $item->setAttribute("cantidad", $cfdItem->qty);
            // unidad
            $item->setAttribute("unidad", $cfdItem->uom);
            // noIdentificacion
            if ($cfdItem->productCode)
                $item->setAttribute("noIdentificacion", $cfdItem->productCode);
            // descripcion
            $item->setAttribute("descripcion", $cfdItem->description);
            // valorUnitario
            $item->setAttribute("valorUnitario", number_format($cfdItem->unitPrice, 6, ".", ""));
            // importe
            $item->setAttribute("importe", number_format($cfdItem->total, 6, ".", ""));
            // Pedimento
            foreach ($cfdItem->customsPermits as $customsPermit) {
                $infomacionAduanera = $item->appendChild($xml->createElement("cfdi:InformacionAduanera"));
                $infomacionAduanera->setAttribute("numero", $customsPermit->nbr);
                if ($customsPermit->dt) {
                    $permitDt = new DateTime($customsPermit->dt);
                    $infomacionAduanera->setAttribute("fecha", $permitDt->format('Y-m-d'));
                }
                if ($customsPermit->office)
                    $infomacionAduanera->setAttribute("aduana", $customsPermit->office);
            }
        }
        $impuestos = $root->appendChild($xml->createElement("cfdi:Impuestos"));
        // Whitholdings
        if ($this->withholding > 0) {
            $impuestos->setAttribute("totalImpuestosRetenidos", number_format($this->withholding, 6, ".", ""));
            $retenciones = $impuestos->appendChild($xml->createElement("cfdi:Retenciones"));
            foreach ($this->WithHoldings as $withHolding) {
                $retencion = $retenciones->appendChild($xml->createElement("cfdi:Retencion"));
                $retencion->setAttribute("impuesto", $withHolding->name);
                $retencion->setAttribute("importe", number_format($withHolding->amt, 6, ".", ""));
                $whtSum += $withHolding->amt;
            }
        }
        // Taxes
        if ($this->tax > 0) {
            $impuestos->setAttribute("totalImpuestosTrasladados", number_format($this->tax, 6, ".", ""));
            $traslados = $impuestos->appendChild($xml->createElement("cfdi:Traslados"));
            foreach ($this->Taxes as $tax) {
                $impuesto = $traslados->appendChild($xml->createElement("cfdi:Traslado"));
                $impuesto->setAttribute("impuesto", $tax->name);
                $impuesto->setAttribute("tasa", $tax->rate);
                $impuesto->setAttribute("importe", number_format($tax->amt, 6, ".", ""));
            }
        }
        $this->originalString = $this->createOriginalString(simplexml_load_string($xml->saveXML()));
        $this->seal = $this->createSignature(simplexml_load_string($xml->saveXML()), $certificate);
        // sello
        $root->setAttribute("sello", $this->seal);

//
//        // Sign CFD
//        // Load XSLT
//        // Get original string

//        $pemKey = "-----BEGIN ENCRYPTED PRIVATE KEY-----\n" . chunk_split($certificate->keyPem, 64, "\n") . "-----END ENCRYPTED PRIVATE KEY-----\n";
//
//        $pkeyid = openssl_get_privatekey(array($pemKey, $certificate->keyPassword));
//        if (!$pkeyid) {
//            $this->addError('id', yii::t('app', 'Cannot retrieve private key from certificate'));
//            return false;
//        }
//        if (!openssl_sign($originalString, $cryptStamp, $pkeyid, OPENSSL_ALGO_SHA1)) {
//            $this->addError('id', yii::t('app', 'Error signing CFD'));
//            return false;
//        }
//        openssl_free_key($pkeyid);
//        $stamp = base64_encode($cryptStamp);             // lo codifica en formato base64
//        $root->setAttribute("sello", $stamp);
//        $this->seal = $stamp;
//
////        echo $stamp . PHP_EOL;
////
////        echo $xml->saveXML() . PHP_EOL;
//        // PAC PROCESSING
//        $mySuite = new MySuiteRequest();
//        $mySuite->country = 'MX';
//        $mySuite->entity = Yii::app()->params['MYSUITE_ENTITY'];
//        $mySuite->requestor = Yii::app()->params['MYSUITE_REQUESTOR'];
//        $mySuite->transaction = MySuiteRequest::TRANSACTION_TIMBRAR;
//        $mySuite->url = Yii::app()->params['MYSUITE_WSDL'];
//        $mySuite->username = Yii::app()->params['MYSUITE_USERNAME'];
//        $mySuite->data1 = $xml->saveXML();
//
//        $response = $mySuite->requestTransaction(MySuiteRequest::TRANSACTION_TIMBRAR);
//
//        if ($response->result) {
//            echo $response->data1 . PHP_EOL;
//
//            $tfdEl = simplexml_load_string($response->data1);
//            $tfdNode = dom_import_simplexml($tfdEl);
//
//            $complemento = $root->appendChild($xml->createElement("cfdi:Complemento"));
//            $tfdNode = $complemento->appendChild($xml->importNode($tfdNode, true));
//
//            $dom = new DOMDocument("1.0", "UTF-8");
//            $dom->loadXML($response->data1);
//
//            $xsltTfd = new XSLTProcessor();
//            $xslTfd = new DOMDocument("1.0", "UTF-8");
//            $xslTfd->substituteEntities = true;
//            if (!$xslTfd->load(Yii::app()->params['XSLT_OS_TFD1.0'], LIBXML_NOCDATA)) {
//                $this->addError('id', yii::t('app', 'Cannot retrieve XSLT file "{file}"', array('{file}' => $xslTfd)));
//                return false;
//            }
//            $xsltTfd->importStylesheet($xslTfd);
//
//            $originalTfdString = $xsltTfd->transformToXml($dom);
//            if (!$originalTfdString) {
//                $errors = array();
//                $errors[] = yii::t('app', 'Error while creating TFD original string');
//                foreach (libxml_get_errors() as $xmlError) {
//                    $errors[] = $xmlError->message . ' ' . yii::t('app', 'at line') . ': ' . $xmlError->line;
//                }
//                $this->addErrors(array('id' => $errors));
//                return false;
//            } else {
//                $this->dtsOriginalString = $originalTfdString;
//            }
//            foreach ($tfdEl->attributes() as $attributeName => $attributeValue) {
//                switch ($attributeName) {
//                    case 'FechaTimbrado':
//                        $this->dtsDttm = $attributeValue;
//                        break;
//                    case 'noCertificadoSAT':
//                        $this->dtsSatCertNbr = $attributeValue;
//                        break;
//                    case 'version':
//                        $this->dtsVersion = $attributeValue;
//                        break;
//                    case 'selloSAT':
//                        $this->dtsSatSeal = $attributeValue;
//                        break;
//                    case 'UUID':
//                        $this->uuid = $attributeValue;
//                        break;
//                }
//            }
//
//            // Create CBB code
//            $this->cbb = '?re=' . $vendorRfc .
//                    "&rr=" . $this->customerRfc .
//                    "&tt=" . substr(str_repeat("0", 17) . number_format($this->total, 6, ".", ""), -17) .
//                    "&id=" . $this->uuid;
//            $this->save();
            return $xml->saveXML();
//        } else {
//            $errors = array();
//            $errors[] = 'Error while processing TFD';
//            $errors[] = $response->description;
//            $errors[] = $response->hint;
//            $this->addErrors(array('id' => $errors));
//            file_put_contents('/tmp/' . $this->id . '.xml', $xml->saveXML());
//            return false;
//        }
    }

    public function filters() {
        return array('rights',
        );
    }

    public function getBasePath() {
        $processInvoiceDttm = new DateTime($this->dttm);
        return yii::getPathOfAlias('application') . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . __CLASS__ .
                DIRECTORY_SEPARATOR . $this->vendorRfc . DIRECTORY_SEPARATOR .
                $processInvoiceDttm->format('Y') . DIRECTORY_SEPARATOR .
                $processInvoiceDttm->format('m') . DIRECTORY_SEPARATOR .
                $processInvoiceDttm->format('d') . DIRECTORY_SEPARATOR .
                $this->invoice;
    }

    public function getCustomsPermits() {
        // Returns an array of CustomsPermit $permit[CustomsPermit->nbr] = CustomsPermit
        $permits = array();
        foreach ($this->cfdItems as $items) {
            foreach ($item->customsPermits as $customPermit) {
                $permits[$customPermit->nbr] = $customPermit;
            }
        }
        return $permits;
    }
    public function getDiscount() {
        $sum = 0;
        foreach ($this->cfdDiscounts as $discount) {
            $sum += $discount->amt;
        }
        return $sum;
    }
    public function getDiscountReason() {
        $reason = '';
        foreach ($this->cfdDiscounts as $discount) {
            $reason .= $discount->reason . ' ';
        }
        return trim($reason);
    }

    public function getHash() {
//        $hash = $this->version . '|' .
//                $this->serial . '|' .
//                $this->folio . '|' .
//                $this->uuid . '|' .
//                $this->vendorRfc . '|' .
//                $this->customerRfc . '|';
        $hash = $this->vendorRfc . '|' . $this->invoice . '|' . $this->voucherType;
        return $hash;
    }

    public function getMd5() {
        return md5($this->getHash());
    }

    public function getPdfFileName() {
        return $this->vendorRfc . '_' .
                $this->invoice . '_' .
                $this->customerRfc . '.pdf';
    }

    public function getTax() {
        $total = 0;
        foreach ($this->Taxes as $tax) {
//            if (!$tax->withHolding && !$tax->local)
                $total += $tax->amt;
        }
        return $total;
    }

    public function getSubTotal() {
        $total = 0;
        foreach ($this->cfdItems as $item) {
            $total += $item->total;
        }
        return $total;
    }
    public function getTotal() {
        return $this->subTotal - $this->discount + $this->tax - $this->withHolding;
    }

    public function getWithholding() {
        $total = 0;
        foreach ($this->WithHoldings as $tax) {
            $total += $tax->amt;
        }
        return $total;
    }

    public function getXmlFileName() {
        return $this->vendorRfc . '_' .
                $this->invoice . '_' .
                $this->customerRfc . '.xml';
    }

    private function processAddress($addressNode) {
        $address = new Address();
        foreach ($addressNode->attributes() as $aName => $aValue) {
            switch ($aName) {
                case 'calle':
                    if (trim((string) $aValue))
                        $address->street = trim((string) $aValue);
                    break;
                case 'noExterior':
                    if (trim((string) $aValue))
                        $address->extNbr = trim((string) $aValue);
                    break;
                case 'noInterior':
                    if (trim((string) $aValue))
                        $address->intNbr = trim((string) $aValue);
                    break;
                case 'colonia':
                    if (trim((string) $aValue))
                        $address->neighbourhood = trim((string) $aValue);
                    break;
                case 'localidad':
                    if (trim((string) $aValue))
                        $address->city = trim((string) $aValue);
                    break;
                case 'municipio':
                    if (trim((string) $aValue))
                        $address->municipality = trim((string) $aValue);
                    break;
                case 'estado':
                    if (trim((string) $aValue))
                        $address->state = trim((string) $aValue);
                    break;
                case 'pais':
                    if (trim((string) $aValue))
                        $address->country = trim((string) $aValue);
                    break;
                case 'codigoPostal':
                    if (trim((string) $aValue))
                        $address->zipCode = trim((string) $aValue);
                    break;
            }
        }
        $addressRec = Address::model()->find('md5 = :md5', array(':md5' => $address->Md5));
        if (!$addressRec) {
            $address->save();
            return $address;
        } else {
            return $addressRec;
        }
    }

    private function processParty($rfc, $name) {
        // Find Vendor
        $partyIdentifier = PartyIdentifier::model()->find('name = :name and value = :value', array(':name' => PartyIdentifier::RFC, ':value' => $rfc));
        if (!$partyIdentifier) {
            // Create party
            $party = new Party();
            $party->name = $name;
            $party->person = (strlen($rfc) == 13);
            if (!$party->save()) {
                $this->addError('cfdXmlFile', implode($party->getErrors()));
                return false;
            }
            // Create party identifier
            $partyIdentifier = new PartyIdentifier();
            $partyIdentifier->Party_id = $party->id;
            $partyIdentifier->name = PartyIdentifier::RFC;
            $partyIdentifier->value = $rfc;
            if (!$partyIdentifier->save()) {
                $this->addError('cfdXmlFile', implode($partyIdentifier->getErrors()));
                return false;
            }
            // Create party name
            $partyName = new PartyName();
            $partyName->Party_id = $party->id;
            $partyName->fullName = $name;
            if (!$partyName->save()) {
                $this->addError('cfdXmlFile', implode($partyName->getErrors()));
                return false;
            }
        } else {
            $party = $partyIdentifier->party;
        }
        return $party;
    }

    public function relations() {
        $relations = array();
        $relations['Taxes'] = array(self::HAS_MANY, 'CfdTax', 'Cfd_id',
            'on' => 'Taxes.local = 0 and Taxes.withHolding = 0');
        $relations['WithHoldings'] = array(self::HAS_MANY, 'CfdTax', 'Cfd_id',
            'on' => 'WithHoldings.local = 0 and WithHoldings.withHolding = 1');
        return array_merge($relations, parent::relations());
    }

    public function rules() {
        $rules = array();
        $rules[] = array('cfdXmlFile', 'file', 'allowEmpty' => false, 'types' => 'xml', 'on' => 'upload');
        $rules[] = array('cfdXmlFile', 'ext.isXmlValidator', 'on' => 'upload');
        $rules[] = array('cfdXmlFile', 'safe', 'on' => 'upload');
        $rules[] = array('CfdStatus_id', 'default', 'value'
            => CfdStatus::model()->find('code = :code', array(':code' => CfdStatus::NEWCFD))->id,
            'on' => 'insert');
        $rules[] = array('version', 'default', 'value'
            => SystemConfig::getValue(SystemConfig::CURRENT_CFD_VERSION),
            'on' => 'insert');
//        $rules[] = array('vendorParty_id', 'default', 'value' => $this->vendor->id, 'on' => 'insert');
//        $rules[] = array('customerParty_id', 'default', 'value' => $this->customer->id, 'on' => 'insert');
//        $rules[] = array('SatCertificate_id', 'default', 'value' => SatCertificate::model()->current()->find('rfc = :rfc', array(':rfc' => $this->vendor->rfc))->id, 'on' => 'insert');

//        $rules[] = array('CfdStatus_id', 'exist', 'allowEmpty' => false, 'attributeName' => 'id', 'className' => 'CfdStatus');
        $rules[] = array('vendorParty_id', 'exist', 'allowEmpty' => false, 'attributeName' => 'id', 'className' => 'Party');
//        $rules[] = array('customerParty_id', 'exist', 'allowEmpty' => false, 'attributeName' => 'id', 'className' => 'Party');
//        $rules[] = array('SatCertificate_id', 'exist', 'allowEmpty' => false, 'attributeName' => 'id', 'className' => 'SatCertificate');
//
        $rules[] = array('voucherType', 'in', 'allowEmpty' => false, 'range' => array('ingreso', 'egreso', 'traslado'));

        return array_merge($rules, parent::rules());
    }

    private function saveAddresses() {
        foreach ($this->addresses as $char) {
            $char->Cfd_id = $this->id;
            $char->save();
        }
    }
    private function saveChar($code, $value, $noTest = true) {
        $char = false;
        if (!$noTest) {
            // Find char in DB
            $char = CfdAttribute::model()->find('Cfd_id = :cfdId and code = :code', array(':cfdId' => $this->id, ':code' => $code));
        }
        if (!$char) {
            $char = new CfdAttribute();
            $char->Cfd_id = $this->id;
            $char->code = $code;
        }
        if ($char->value != $value) {
            $char->value = $value;
            $char->save();
        }
    }
    private function saveChars() {
        foreach ($this->chars as $code => $value) {
            $this->saveChar($code, $value);
        }
    }

    private function saveCustomsPermits() {
        foreach ($this->_customsPermits as $permit) {
            $char = new CfdHasCustomsPermit();
            $char->Cfd_id = $this->id;
            $char->CustomsPermit_id = $permit->id;
            $char->save();
        }
    }

    private function saveDiscounts() {
        foreach ($this->discounts as $char) {
            $char->Cfd_id = $this->id;
            $char->save();
        }
    }
    private function saveItems() {
        foreach ($this->items as $char) {
            $char->Cfd_id = $this->id;
            $char->save();
        }
    }
    private function saveNotes() {
        foreach ($this->notes as $char) {
            $note = new CfdNote();
            $note->Cfd_id = $this->id;
            $note->value = $char;
            $note->save();
        }
    }
    private function saveTaxes() {
        foreach ($this->taxes as $char) {
            $char->Cfd_id = $this->id;
            $char->save();
        }
    }
    private function saveTaxRegimes() {
        foreach ($this->taxRegimes as $value) {
            $char = new CfdTaxRegime();
            $char->Cfd_id = $this->id;
            $char->name = $value;
            $char->save();
        }
    }
    public function search() {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('invoice', $this->invoice, true);
        $criteria->compare('version', $this->version, true);
        $criteria->compare('serial', $this->serial, true);
        $criteria->compare('folio', $this->folio);
        $criteria->compare('uuid', $this->uuid, true);
        $criteria->compare('dttm', $this->dttm, true);
        $criteria->compare('seal', $this->seal, true);
        $criteria->compare('paymentType', $this->paymentType, true);
//        $criteria->compare('certNbr', $this->certNbr, true);
//        $criteria->compare('certificate', $this->certificate, true);
        $criteria->compare('paymentTerm', $this->paymentTerm, true);
//        $criteria->compare('subTotal', $this->subTotal, true);
//        $criteria->compare('discount', $this->discount, true);
        $criteria->compare('discountReason', $this->discountReason, true);
        $criteria->compare('exchangeRate', $this->exchangeRate, true);
        $criteria->compare('currency', $this->currency, true);
//        $criteria->compare('total', $this->total, true);
        $criteria->compare('voucherType', $this->voucherType, true);
        $criteria->compare('paymentMethod', $this->paymentMethod, true);
        $criteria->compare('expeditionPlace', $this->expeditionPlace, true);
        $criteria->compare('paymentAcctNbr', $this->paymentAcctNbr, true);
        $criteria->compare('sourceFolio', $this->sourceFolio);
        $criteria->compare('sourceSerial', $this->sourceSerial, true);
        $criteria->compare('sourceDttm', $this->sourceDttm, true);
        $criteria->compare('sourceAmt', $this->sourceAmt, true);
//        $criteria->compare('vendorRfc', $this->vendorRfc, true);
//        $criteria->compare('vendorName', $this->vendorName, true);
//        $criteria->compare('customerRfc', $this->customerRfc, true);
//        $criteria->compare('customerName', $this->customerName, true);
//        $criteria->compare('taxAmt', $this->taxAmt, true);
//        $criteria->compare('wthAmt', $this->wthAmt, true);
        $criteria->compare('dtsVersion', $this->dtsVersion, true);
        $criteria->compare('dtsDttm', $this->dtsDttm, true);
        $criteria->compare('dtsSatCertNbr', $this->dtsSatCertNbr, true);
        $criteria->compare('dtsSatSeal', $this->dtsSatSeal, true);
        $criteria->compare('dtsOriginalString', $this->dtsOriginalString, true);
        $criteria->compare('approvalNbr', $this->approvalNbr);
        $criteria->compare('approvalYear', $this->approvalYear);
        $criteria->compare('md5', $this->md5, true);
        $criteria->compare('creationDt', $this->creationDt, true);
        $criteria->compare('updateDt', $this->updateDt, true);
        $criteria->compare('vendorParty_id', $this->vendorParty_id);
        $criteria->compare('customerParty_id', $this->customerParty_id);
        $criteria->compare('originalString', $this->originalString, true);
        $criteria->compare('cbb', $this->cbb, true);
        $criteria->compare('SatCertificate_id', $this->SatCertificate_id);
        $criteria->compare('dtsSatCertificate_id', $this->dtsSatCertificate_id);
//        $criteria->compare('localTaxAmt', $this->localTaxAmt, true);
//        $criteria->compare('localWhtAmt', $this->localWhtAmt, true);
        $criteria->compare('CfdStatus_id', $this->CfdStatus_id);
        $criteria->compare('notes', $this->notes, true);
        $criteria->compare('errorMsg', $this->errorMsg, true);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                    'sort' => array(
                        'defaultOrder' => array(
                            'dttm' => true
                    )),
                    'pagination' => array('pageSize' => Yii::app()->user->getState('pageSize', Yii::app()->params['defaultPageSize'])),
                ));
    }

    public function setChar(array $char) {
        $this->chars[$char[0]] = $char[1];
        if ($this->id) $this->saveChar($char[0], $char[1], $this->isNewRecord);
    }

    public function setCustomsPermit(CustomsPermit $customPermit) {
        $this->_customsPermits[$customPermit->nbr] = $customPermit;
    }

    public function setRelatedData($data) {
        // $data[relation] = RelatedObject
        // Eg: $data['CfdItem'] = CfdItem;

    }
    public function validateAndMap($xml) {
        libxml_use_internal_errors(true);

        $addresses = array();
        $taxRegimes = array();
        $cfdItems = array();
        $withHoldings = array();
        $taxes = array();

        $subTotal = 0;
        $taxSum = 0;
        $withHoldingSum = 0;
        $localTaxSum = 0;
        $localWhtSum = 0;

        // Get CFD version.
        $this->version = (string) $xml->attributes()->version;
        if (!$this->version) {
            $this->addError('cfdXmlFile', yii::t('app', 'Failed to retrieve CFD version'));
            return false;
        }
        $this->dttm = (string) $xml->attributes()->fecha;
        if (!$this->dttm) {
            $this->addError('cfdXmlFile', yii::t('app', 'Failed to retrieve CFD issuing date'));
            return false;
        }

        // Clear addenda
        $strXml = $xml->asXml();
        switch ($this->version) {
            case "2.0":
                // Test version
                if ($this->dttm >= '2012-07-01') {
                    $this->addError('cfdXmlFile', yii::t('app', 'Error: CFD Version {v} is deprecated since 01-Jul-2012', array('{v}' => '2.0')));
                    return false;
                }
            case "2.2":
                $strXml = preg_replace('{<Addenda.*/Addenda>}is', '<Addenda/>', $strXml);
                break;
            case "3.0":
                // Test version
                if ($this->dttm >= '2012-07-01') {
                    $this->addError('cfdXmlFile', yii::t('app', 'Error: CFD Version {v} is deprecated since 01-Jul-2012', array('{v}' => '3.0')));
                    return false;
                }
            case "3.2":
                $strXml = preg_replace('{<cfdi:Addenda.*/cfdi:Addenda>}is', '<cfdi:Addenda/>', $strXml);
                break;
            default:
                $this->addError('cfdXmlFile', yii::t('app', 'Invalid CFD version "{version}"', array('{version}' => $this->version)));
                return false;
        }
        $xml = simplexml_load_string($strXml);

        // Validate XML against schemas
        if (!$this->validateSchema($xml))
            return false;
        if (!$this->validateStamp($xml))
            return false;

        // Schema and stamp are Ok.
        // Start mapping.
        foreach ($xml->attributes() as $aName => $aValue) {
            switch ($aName) {
                case 'serie':
                    $this->serial = (string) $aValue;
                    break;
                case 'folio':
                    $this->folio = (string) $aValue;
                    break;
                case 'fecha':
                    $this->dttm = (string) $aValue;
                    break;
                case 'sello':
                    $this->seal = (string) $aValue;
                    break;
                case 'noAprobacion':
                    $this->approvalNbr = (string) $aValue;
                    break;
                case 'anoAprobacion':
                    $this->approvalYear = (string) $aValue;
                    break;
                case 'formaDePago':
                    $this->paymentType = (string) $aValue;
                    break;
                case 'noCertificado':
                    $this->certNbr = (string) $aValue;
                    break;
                case 'certificado':
                    $this->certificate = (string) $aValue;
                    break;
                case 'condicionesDePago':
                    $this->paymentTerm = (string) $aValue;
                    break;
                case 'subTotal':
                    $this->subTotal = (float) $aValue;
                    break;
                case 'descuento':
                    $this->discount = round((float) $aValue, 2);
                    break;
                case 'motivoDescuento':
                    $this->discountReason = (string) $aValue;
                    break;
                case 'TipoCambio':
                    $this->exchangeRate = (float) $aValue;
                    break;
                case 'Moneda':
                    $this->currency = (string) $aValue;
                    break;
                case 'total':
                    $this->total = round((float) $aValue, 2);
                    break;
                case 'tipoDeComprobante':
                    $this->voucherType = (string) $aValue;
                    break;
                case 'metodoDePago':
                    $this->paymentMethod = (string) $aValue;
                    break;
                case 'LugarExpedicion':
                    $this->expeditionPlace = (string) $aValue;
                    break;
                case 'NumCtaPago':
                    $this->paymentAcctNbr = (string) $aValue;
                    break;
                case 'FolioFiscalOrig':
                    $this->sourceFolio = (string) $aValue;
                    break;
                case 'SerieFolioFiscalOrig':
                    $this->sourceSerial = (string) $aValue;
                    break;
                case 'FechaFolioFiscalOrig':
                    $this->sourceDttm = (string) $aValue;
                    break;
                case 'MontoFolioFiscalOrig':
                    $this->sourceAmt = round((float) $aValue, 2);
                    break;
            }
        }

        // Test approval Nº and approval Year.
        if ($this->version == '2.0' || $this->version == '2.2') {
            // Find approval number and year
            $criteria = new CDbCriteria();
            $criteria->addCondition($this->folio . ' between startFolio and endFolio');
            $criteria->compare('rfc', $this->vendorRfc);
            $criteria->compare('approvalNbr', $this->approvalNbr);
            $criteria->compare('approvalYear', $this->approvalYear);
            if ($this->serial)
                $criteria->compare('serial', $this->serial);
            if (!SatFoliosCfd::model()->find($criteria)) {
                $errors = array();
                $errors[] = yii::t('app', 'Invalid approval number / year or invalid serial or folio');
                $errors[] = yii::t('app', 'Approval number: {n}', array('{n}' => $this->approvalNbr));
                $errors[] = yii::t('app', 'Approval year: {n}', array('{n}' => $this->approvalYear));
                if ($this->serial)
                    $errors[] = yii::t('app', 'CFD Serial: {n}', array('{n}' => $this->serial));
                $errors[] = yii::t('app', 'CFD Folio: {n}', array('{n}' => $this->folio));
                $this->addErrors(array('cfdXmlFile' => $errors));
                return false;
            }
        }
        // Get namespaces.
        $xmlNameSpaces = $xml->getDocNamespaces(true);
        foreach ($xmlNameSpaces as $xmlNameSpace => $schema) {
            foreach ($xml->children($xmlNameSpace, true) as $child) {
                switch ($child->getName()) {
                    case 'Emisor':
                        foreach ($child->attributes() as $aName => $aValue) {
                            switch ($aName) {
                                case 'rfc':
                                    $this->vendorRfc = trim((string) $aValue);
                                    break;
                                case 'nombre':
                                    $this->vendorName = trim((string) $aValue);
                                    break;
                            }
                        }
                        // Process Party
                        $vendor = $this->processParty($this->vendorRfc, $this->vendorName);
                        if (!$vendor)
                            return false;
                        else
                            $this->vendorParty_id = $vendor->id;

                        foreach ($child->children($xmlNameSpace, true) as $vendorChild) {
                            switch ($vendorChild->getName()) {
                                case 'DomicilioFiscal':
                                case 'ExpedidoEn':
                                    $address = $this->processAddress($vendorChild);
                                    if ($address->hasErrors()) {
                                        $this->addError('cfdXmlFile', implode($address->getErrors()));
                                        return false;
                                    }
                                    $cfdAddress = new CfdAddress();
                                    $cfdAddress->Address_id = $address->id;
                                    if (trim($vendorChild->attributes()->referencia))
                                        $cfdAddress->reference = trim($vendorChild->attributes()->referencia);
                                    switch ($vendorChild->getName()) {
                                        case 'DomicilioFiscal':
                                            $cfdAddress->type = AddressTypeBehavior::FISCAL;
                                            break;
                                        case 'ExpedidoEn':
                                            $cfdAddress->type = AddressTypeBehavior::ISSUING;
                                            break;
                                    }
                                    $addresses[] = $cfdAddress;
                                    break;
                                case 'RegimenFiscal':
                                    $taxRegime = new CfdTaxRegime();
                                    $taxRegime->name = $vendorChild->attributes()->Regimen;
                                    $taxRegimes[] = $taxRegime;
                                    break;
                            }
                        }
                        break;
                    case 'Receptor':
                        foreach ($child->attributes() as $aName => $aValue) {
                            switch ($aName) {
                                case 'rfc':
                                    $this->customerRfc = trim((string) $aValue);
                                    break;
                                case 'nombre':
                                    $this->customerName = trim((string) $aValue);
                                    break;
                            }
                        }
                        // Process Party
                        $customer = $this->processParty($this->customerRfc, $this->customerName);
                        if (!$customer)
                            return false;
                        else
                            $this->customerParty_id = $customer->id;

                        foreach ($child->children($xmlNameSpace, true) as $customerChild) {
                            switch ($customerChild->getName()) {
                                case 'Domicilio':
                                    $address = $this->processAddress($customerChild);
                                    if ($address->hasErrors()) {
                                        $this->addError('cfdXmlFile', implode($address->getErrors()));
                                        return false;
                                    }
                                    $cfdAddress = new CfdAddress();
                                    $cfdAddress->Address_id = $address->id;
                                    if (trim($customerChild->attributes()->referencia))
                                        $cfdAddress->reference = trim($customerChild->attributes()->referencia);
                                    $cfdAddress->type = AddressTypeBehavior::BILL_TO;
                                    $addresses[] = $cfdAddress;
                                    break;
                            }
                        }

                        break;
                    case 'Conceptos':
                        $itemCount = 0;
                        foreach ($child->children($xmlNameSpace, true) as $item) {
                            $itemCount++;
                            $cfdItem = new CfdItem();
                            foreach ($item->attributes() as $aName => $aValue) {
                                switch ($aName) {
                                    case 'cantidad':
                                        $cfdItem->qty = (float) $aValue;
                                        break;
                                    case 'unidad':
                                        $cfdItem->uom = (string) $aValue;
                                        break;
                                    case 'noIdentificacion':
                                        $cfdItem->productCode = (string) $aValue;
                                        break;
                                    case 'descripcion':
                                        $cfdItem->description = (string) $aValue;
                                        break;
                                    case 'valorUnitario':
                                        $cfdItem->unitPrice = (float) $aValue;
                                        break;
                                    case 'importe':
                                        $cfdItem->amt = (float) $aValue;
                                        break;
                                }
                            }
                            // Check item arithmetics
                            if (number_format($cfdItem->amt, 2) != number_format($cfdItem->qty * $cfdItem->unitPrice, 2)) {
                                $this->addError('cfdXmlFile', yii::t('app', 'Arithmetic error on item {item} - "{desc}". Amount is {amt} and must be {realamt}', array(
                                            '{item}' => $itemCount,
                                            '{desc}' => $cfdItem->description,
                                            '{amt}' => number_format($cfdItem->amt, 2),
                                            '{realamt}' => number_format($cfdItem->qty * $cfdItem->unitPrice, 2)
                                        )));
                                return false;
                            }
                            $subTotal += $cfdItem->qty * $cfdItem->unitPrice;
                            $cfdItems[] = $cfdItem;
                        }
                        break;
                    case 'Impuestos':
                        foreach ($child->attributes() as $aName => $aValue) {
                            switch ($aName) {
                                case 'totalImpuestosRetenidos':
                                    $this->wthAmt = (float) $aValue;
                                    break;
                                case 'totalImpuestosTrasladados':
                                    $this->taxAmt = (float) $aValue;
                                    break;
                            }
                        }
                        foreach ($child->children($xmlNameSpace, true) as $taxNode) {
                            switch ($taxNode->getName()) {
                                case 'Retenciones':
                                    foreach ($taxNode->children($xmlNameSpace, true) as $withHolding) {
                                        $cfdWithHolding = new CfdTax();
                                        $cfdWithHolding->name = trim((string) $withHolding->attributes()->impuesto);
                                        $cfdWithHolding->amt = (float) $withHolding->attributes()->importe;
                                        $cfdWithHolding->withHolding = true;
                                        $withHoldings[] = $cfdWithHolding;
                                        $withHoldingSum += $cfdWithHolding->amt;
                                    }
                                    break;
                                case 'Traslados':
                                    foreach ($taxNode->children($xmlNameSpace, true) as $tax) {
                                        $cfdTax = new CfdTax();
                                        $cfdTax->name = trim((string) $tax->attributes()->impuesto);
                                        $cfdTax->amt = (float) $tax->attributes()->importe;
                                        $cfdTax->rate = (float) $tax->attributes()->tasa;
                                        $taxes[] = $cfdTax;
                                        $taxSum += $cfdTax->amt;
                                    }
                                    break;
                            }
                        }
                        if ($this->wthAmt != 0) {
                            if (number_format($this->wthAmt, 2) != number_format($withHoldingSum, 2)) {
                                $this->addError('cfdXmlFile', yii::t('app', 'Arithmetic error: Withholdings total is {wt} and must be {cwt}', array('{wt}' => number_format($this->wthAmt, 2), '{cwt}' => number_format($withHoldingSum, 2))));
                                return false;
                            }
                        } else {
                            $this->wthAmt = $withHoldingSum;
                        }
                        if ($this->taxAmt != 0) {
                            if (number_format($this->taxAmt, 2) != number_format($taxSum, 2)) {
                                $this->addError('cfdXmlFile', yii::t('app', 'Arithmetic error: Tax total is {wt} and must be {cwt}', array('{wt}' => number_format($this->taxAmt, 2), '{cwt}' => number_format($taxSum, 2))));
                                return false;
                            }
                        } else {
                            $this->taxAmt = $taxSum;
                        }
                        break;
                    case 'Complemento':
                        foreach ($xmlNameSpaces as $complementNameSpace => $schema) {
                            foreach ($child->children($complementNameSpace, true) as $complement) {
                                switch ($complement->getName()) {
                                    case "TimbreFiscalDigital":
                                        if (!$this->validateTfdSchema($complement))
                                            return false;
                                        if (!$this->validateTfdStamp($complement))
                                            return false;
                                        foreach ($complement->attributes() as $aName => $aValue) {
                                            switch ($aName) {
                                                case "UUID":
                                                    $this->uuid = (string) $aValue;
                                                    break;
                                                case "selloCFD":
                                                    if (trim($aValue) != trim($this->seal)) {
                                                        $this->addError('cfdXmlFile', yii::t('app', 'The CFD seal in the Digital Tax Stamp is different from the CFD seal'));
                                                        return false;
                                                    }
                                                    break;
                                                case "FechaTimbrado":
                                                    $ft = new DateTime($aValue);
                                                    $dt = new DateTime($this->dttm);
                                                    $interval = $ft->diff($dt);
                                                    if ($interval->h < 0) {
                                                        $this->addError('cfdXmlFile', yii::t('app', 'Digital Tax Stamp date "{dtsdt}" is older than the CFD issuing date "{cfddt}"', array('{dtsdt}' => $ft->format(DateTime::ISO8601), '{cfddt}' => $dt->format(DateTime::ISO8601))));
                                                        return false;
                                                    }
                                                    if ($interval->h > 72) {
                                                        $this->addError('cfdXmlFile', yii::t('app', 'Digital Tax Stamp date "{dtsdt}" cannot be more than 72Hs from CFD issuing date "{cfddt}"', array('{dtsdt}' => $ft->format(DateTime::ISO8601), '{cfddt}' => $dt->format(DateTime::ISO8601))));
                                                        return false;
                                                    }
                                                    break;
                                                default:
                                                    break;
                                            }
                                        }
                                        break;
                                    case "ImpuestosLocales":
                                        foreach ($complement->attributes() as $aName => $aValue) {
                                            switch ($aName) {
                                                case 'TotaldeRetenciones':
                                                    $this->localWhtAmt = (float) $aValue;
                                                    break;
                                                case 'TotaldeTraslados':
                                                    $this->localTaxAmt = (float) $aValue;
                                                    break;
                                            }
                                        }
                                        foreach ($complement->children($complementNameSpace, true) as $taxNode) {
                                            switch ($taxNode->getName()) {
                                                case 'RetencionesLocales':
                                                    $cfdWithHolding = new CfdTax();
                                                    $cfdWithHolding->name = trim((string) $taxNode->attributes()->ImpLocRetenido);
                                                    $cfdWithHolding->amt = (float) $taxNode->attributes()->Importe;
                                                    $cfdWithHolding->rate = (float) $taxNode->attributes()->TasadeRetencion;
                                                    $cfdWithHolding->local = true;
                                                    $cfdWithHolding->withHolding = true;
                                                    $withHoldings[] = $cfdWithHolding;
                                                    $localWhtSum += $cfdWithHolding->amt;
                                                    break;
                                                case 'TrasladosLocales':
                                                    $cfdTax = new CfdTax();
                                                    $cfdTax->name = trim((string) $taxNode->attributes()->ImpLocTrasladado);
                                                    $cfdTax->amt = (float) $taxNode->attributes()->Importe;
                                                    $cfdTax->rate = (float) $taxNode->attributes()->TasadeTraslado;
                                                    $cfdTax->local = true;
                                                    $cfdTax->withHolding = false;
                                                    $taxes[] = $cfdTax;
                                                    $localTaxSum += $cfdTax->amt;
                                                    break;
                                            }
                                        }
                                        if ($this->localWhtAmt != 0) {
                                            if (number_format($this->localWhtAmt, 2) != number_format($localWhtSum, 2)) {
                                                $this->addError('cfdXmlFile', yii::t('app', 'Arithmetic error: Local withholdings total is {wt} and must be {cwt}', array('{wt}' => number_format($this->localWhtAmt, 2), '{cwt}' => number_format($localWhtSum, 2))));
                                                return false;
                                            }
                                        } else {
                                            $this->localWhtAmt = $localWhtSum;
                                        }
                                        if ($this->localTaxAmt != 0) {
                                            if (number_format($this->localTaxAmt, 2) != number_format($localTaxSum, 2)) {
                                                $this->addError('cfdXmlFile', yii::t('app', 'Arithmetic error: Local tax total is {wt} and must be {cwt}', array('{wt}' => number_format($this->localTaxAmt, 2), '{cwt}' => number_format($localTaxSum, 2))));
                                                return false;
                                            }
                                        } else {
                                            $this->localTaxAmt = $localTaxSum;
                                        }

                                        break;
                                }
                            }
                        }
                }
            }
        }

        // Validate aritmetics.
        if (number_format($this->subTotal, 2) != number_format($subTotal, 2)) {
            $this->addError('cfdXmlFile', yii::t('app', 'Arithmetic error: CFD Subtotal is {amt} and must be {realamt}', array(
                        '{amt}' => number_format($this->subTotal, 2),
                        '{realamt}' => number_format($subTotal, 2)
                    )));
            return false;
        }
        $total = $this->subTotal - $this->discount + $this->taxAmt + $this->localTaxAmt - $this->wthAmt - $this->localWhtAmt;
        if (number_format($this->total, 2) != number_format($total, 2)) {
            $errors = array();
            $errors[] = yii::t('app', 'Arithmetic error: CFD Total is {amt} and must be {realamt}', array(
                        '{amt}' => number_format($this->total, 2),
                        '{realamt}' => number_format($total, 2)
                    ));
            $errors[] = yii::t('app', 'CFD subtotal: {st}', array('{st}' => number_format($this->subTotal, 2)));
            $errors[] = yii::t('app', 'CFD discount: {st}', array('{st}' => number_format($this->discount, 2)));
            $errors[] = yii::t('app', 'CFD tax amount: {st}', array('{st}' => number_format($this->taxAmt, 2)));
            $errors[] = yii::t('app', 'CFD withholding amount: {st}', array('{st}' => number_format($this->wthAmt, 2)));
            $errors[] = yii::t('app', 'CFD local tax amount: {st}', array('{st}' => number_format($this->localTaxAmt, 2)));
            $errors[] = yii::t('app', 'CFD local withholding amount: {st}', array('{st}' => number_format($this->localWhtAmt, 2)));
            $this->addErrors(array('cfdXmlFile' => $errors));
            return false;
        }

        // Validate if already exists
        if (Cfd::model()->find('md5 = :md5', array(':md5' => md5($this->getHash())))) {
            $this->addError('cfdXmlFile', yii::t('app', 'CFD was already uploaded to the site.'));
            return false;
        }
        return true;
    }

    public function validateSchema($xml) {

        // Create import xsd
        $xsd = '<?xml version="1.0"?>';
        $xsd .= '<xs:schema xmlns:xs="http://www.w3.org/2001/XMLSchema">';
        $xsd .= '<xs:import namespace="' . Yii::app()->params['URI_CFD' . $this->version] . '" schemaLocation="' . Yii::app()->params['XSD_CFD' . $this->version] . '"/>';
        // Get namespaces.
        $xmlNameSpaces = $xml->getNamespaces(true);
        foreach ($xmlNameSpaces as $nameSpace => $uri) {
            switch ($uri) {
                case 'http://www.sat.gob.mx/detallista':
                    $xsd .= '<xs:import namespace="' . $uri . '" schemaLocation="http://www.sat.gob.mx/sitio_internet/cfd/detallista/detallista.xsd"/>';
                    break;
                case 'http://www.sat.gob.mx/divisas':
                    $xsd .= '<xs:import namespace="' . $uri . '" schemaLocation="http://www.sat.gob.mx/sitio_internet/cfd/divisas/Divisas.xsd"/>';
                    break;
                case 'http://www.sat.gob.mx/donat':
                    $xsd .= '<xs:import namespace="' . $uri . '" schemaLocation="http://www.sat.gob.mx/sitio_internet/cfd/donat/donat.xsd"/>';
                    break;
                case 'http://www.sat.gob.mx/ecc':
                    $xsd .= '<xs:import namespace="' . $uri . '" schemaLocation="http://www.sat.gob.mx/sitio_internet/cfd/ecc/ecc.xsd"/>';
                    break;
                case 'http://www.sat.gob.mx/ecb':
                    $xsd .= '<xs:import namespace="' . $uri . '" schemaLocation="http://www.sat.gob.mx/sitio_internet/cfd/ecb/ecb.xsd"/>';
                    break;
                case 'http://www.sat.gob.mx/implocal':
                    $xsd .= '<xs:import namespace="' . $uri . '" schemaLocation="http://www.sat.gob.mx/sitio_internet/cfd/implocal/implocal.xsd"/>';
                    break;
                case 'http://www.sat.gob.mx/psgecfd':
                    $xsd .= '<xs:import namespace="' . $uri . '" schemaLocation="http://www.sat.gob.mx/sitio_internet/cfd/psgecfd/psgecfd.xsd"/>';
                    break;
                case 'http://www.sat.gob.mx/terceros':
                    $xsd .= '<xs:import namespace="' . $uri . '" schemaLocation="http://www.sat.gob.mx/sitio_internet/cfd/terceros/terceros.xsd"/>';
                    break;
                case 'http://www.sat.gob.mx/TimbreFiscalDigital':
                    $xsd .= '<xs:import namespace="' . $uri . '" schemaLocation="' . Yii::app()->params['XSD_TFD1.0'] . '"/>';
                    break;
            }
        }
        $xsd .= '</xs:schema>';

        $strXml = $xml->asXml();
        $cfdSxe = dom_import_simplexml(simplexml_load_string($strXml));
        $cfdDoc = new DOMDocument('1.0');
        $cfdSxe = $cfdDoc->importNode($cfdSxe, true);
        $cfdSxe = $cfdDoc->appendChild($cfdSxe);

        if (!@$cfdDoc->schemaValidateSource($xsd)) {
            $errors = array();
            foreach (libxml_get_errors() as $xmlError) {
                $errors[] = $xmlError->message . ' ' . yii::t('app', 'at line') . ': ' . $xmlError->line;
            }
            $this->addErrors(array('cfdXmlFile' => $errors));
            return false;
        }
        return true;
    }

    public function validateStamp($xml) {
        $this->certNbr = $xml->attributes()->noCertificado;
        $certificate = SatCertificate::model()->find('nbr = :nbr', array(':nbr' => $this->certNbr));
        if (!$certificate) {
            $certificate = new SatCertificate();
            $certificate->nbr = $this->certNbr;
            // Try to get it from SAT
            if (!$certificate->downloadFromSat()) {
                $this->addError('cfdXmlFile', $certificate->getError('nbr'));
                return false;
            }
        }
        $this->SatCertificate_id = $certificate->id;

        if (!($certificate->validFrom <= $this->dttm && $this->dttm <= $certificate->validTo)) {
            $this->addError('cfdXmlFile', yii::t('app', 'CFD Issuing date "{cfddt}" is not between the range of valid certificate dates "{vf}" - "{vt}".', array('{cfddt}' => $this->dttm, '{vf}' => $certificate->validFrom, '{vt}' => $certificate->validTo)));
            return false;
        }
        $cfdSxe = dom_import_simplexml($xml);
        $dom = new DOMDocument('1.0');
        $cfdSxe = $dom->importNode($cfdSxe, true);
        $cfdSxe = $dom->appendChild($cfdSxe);

        // Get XSLT for version
        $xsltFile = Yii::app()->params['XSLT_OS_CFD' . $this->version];

        $xslt = new XSLTProcessor();
        $xsl = new DOMDocument();
        if (!@$xsl->load($xsltFile, LIBXML_NOCDATA)) {
            $errors = array();
            foreach (libxml_get_errors() as $xmlError) {
                $errors[] = $xmlError->message;
            }
            $this->addErrors(array('cfdXmlFile' => $errors));
            return false;
        }
        if (!@$xslt->importStylesheet($xsl)) {
            $errors = array();
            foreach (libxml_get_errors() as $xmlError) {
                $errors[] = $xmlError->message;
            }
            $this->addErrors(array('cfdXmlFile' => $errors));
            return false;
        }
        // Get Original String
        $this->originalString = $xslt->transformToXml($dom);
        if (!$this->originalString) {
            $this->addError('cfdXmlFile', yii::t('app', 'Unable to extract original string from CFD'));
            return false;
        }

        // Get certificate PEM
        $pem = "-----BEGIN CERTIFICATE-----\n" . chunk_split($certificate->pem, 64, "\n") . "-----END CERTIFICATE-----\n";

        // Get public key
        $pk = @openssl_get_publickey(openssl_x509_read($certificate->Pem));
        if (!$pk) {
            $this->addError('cfdXmlFile', yii::t('app', 'Unable to extract public key from certificate.'));
            return false;
        }

        // Get CFD stamp
        $stamp = base64_decode($xml->attributes()->sello);

        $verify = openssl_verify($this->originalString, $stamp, $pk, (substr($xml->attributes()->fecha, 0, 4) < 2011 ? OPENSSL_ALGO_MD5 : OPENSSL_ALGO_SHA1));

        switch ($verify) {
            case 0:
                //Bad
                if (substr($xml->attributes()->fecha, 0, 4) >= 2011) {
                    // Try to see if it was signed with MD5
                    $verify = openssl_verify($this->originalString, $stamp, $pk, OPENSSL_ALGO_MD5);
                    openssl_free_key($pk);
                    if ($verify > 0) {
                        // Yes it was.
                        // Trigger an error
                        $this->addError('cfdXmlFile', yii::t('app', 'CFD was signed with MD5 algorithm and must be signed with SHA-1 algorithm.'));
                        return false;
                    }
                } else {
                    $this->addError('cfdXmlFile', yii::t('app', 'Invalid CFD signature.'));
                    return false;
                }
                break;
            case -1:
                //Bad
                openssl_free_key($pk);
                $this->addError('cfdXmlFile', yii::t('app', 'Failed to verify CFD signature.'));
                return false;
                break;
            default:
                openssl_free_key($pk);
                break;
        }
        return true;
    }

    /*
     * Validates the TFD against the schemas.
     * Throws exception if fails.
     */

    public function validateTfdSchema($xml) {
        // Get TFD version
        $this->dtsVersion = $xml->attributes()->version;
        if (!$this->dtsVersion) {
            $this->addError('cfdXmlFile', yii::t('app', 'Digital Tax Seal version not found.'));
            return false;
        }

        $xsd = @file_get_contents(Yii::app()->params['XSD_TFD' . $this->dtsVersion]);

        if (!$xsd) {
            $this->addError('cfdXmlFile', yii::t('app', 'Failed to download Digital Tax Seal schema "{file}"', array('{file}' => Yii::app()->params['XSD_TFD' . $this->dtsVersion])));
            return false;
        }

        $cfdSxe = dom_import_simplexml($xml);
        $cfdDoc = new DOMDocument('1.0');
        $cfdSxe = $cfdDoc->importNode($cfdSxe, true);
        $cfdSxe = $cfdDoc->appendChild($cfdSxe);

        if (!@$cfdDoc->schemaValidateSource($xsd)) {
            $errors = array();
            $errors[] = yii::t('app', 'Digital Tax Seal schema validation failed');
            foreach (libxml_get_errors() as $xmlError) {
                $errors[] = $xmlError->message . ' ' . yii::t('app', 'at line') . ': ' . $xmlError->line;
            }
            $this->addErrors(array('cfdXmlFile' => $errors));
            return false;
        }
        return true;
    }

    /*
     * Validates the stamp of the TFD
     *
     */

    public function validateTfdStamp($xml) {
        // First, find out the certificate
        //
        $this->dtsSatCertNbr = $xml->attributes()->noCertificadoSAT;

        $certificate = SatCertificate::model()->find('nbr = :nbr', array(':nbr' => $this->dtsSatCertNbr));
        if (!$certificate) {
            $certificate = new SatCertificate();
            $certificate->nbr = $this->dtsSatCertNbr;
            // Try to get it from SAT
            if (!$certificate->downloadFromSat()) {
                $this->addError('cfdXmlFile', implode($certificate->getErrors()));
                return false;
            }
        }
        $this->dtsSatCertificate_id = $certificate->id;

        // Get CFD version
        $version = $xml->attributes()->version;

        $stamp = base64_decode($xml->attributes()->selloSAT);

        // Get XSLT for version
        //$xsltFile = SystemConfig::getOriginalStringXSLT($version);
//        $xsltFile = "/tmp/cadenaoriginal_TFD_1_0.xslt";
        $xsltFile = Yii::app()->params['XSLT_OS_TFD' . $this->dtsVersion];

        $cfdSxe = dom_import_simplexml($xml);
        $dom = new DOMDocument('1.0');
        $cfdSxe = $dom->importNode($cfdSxe, true);
        $cfdSxe = $dom->appendChild($cfdSxe);

        $xslt = new XSLTProcessor();
        $xsl = new DOMDocument();
        if (!@$xsl->load($xsltFile, LIBXML_NOCDATA)) {
            $errors = array();
            $errors[] = yii::t('app', 'Failed to download XSLT file "{file}"', array('{file}' => $xsltFile));
            foreach (libxml_get_errors() as $xmlError) {
                $errors[] = $xmlError->message;
            }
            $this->addErrors(array('cfdXmlFile' => $errors));
            return false;
        }
        $xslt->importStylesheet($xsl);
        // Get Original String
        $originalString = $xslt->transformToXml($dom);
        if (!$this->originalString) {
            $this->addError('cfdXmlFile', yii::t('app', 'Unable to extract original string from TFD'));
            return false;
        }

        // Get certificate PEM
        $pem = "-----BEGIN CERTIFICATE-----\n" . chunk_split($certificate->pem, 64, "\n") . "-----END CERTIFICATE-----\n";

        // Get public key
        $pk = openssl_get_publickey(openssl_x509_read($pem));
        if (!$pk) {
            $this->addError('cfdXmlFile', yii::t('app', 'Unable to extract public key from TFD certificate.'));
            return false;
        }

        $verify = openssl_verify($originalString, $stamp, $pk, OPENSSL_ALGO_SHA1);
        // Free key

        switch ($verify) {
            case 0:
                $this->addError('cfdXmlFile', yii::t('app', 'Invalid TFD signature.'));
                return false;
                break;
            case -1:
                //Bad
                openssl_free_key($pk);
                $this->addError('cfdXmlFile', yii::t('app', 'Failed to verify TFD signature.'));
                return false;
                break;
            default:
                openssl_free_key($pk);
                break;
        }
        return true;
    }

}