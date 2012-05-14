<?php

Yii::import('application.models._base.BaseCfd');

class Cfd extends BaseCfd {

    const DEFAULT_PAYMENT_TYPE = 'PAGO EN UNA SOLA EXHIBICION';
    const DEFAULT_PAYMENT_METHOD = 'NO DEFINIDO';

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getHash() {
        $hash = $this->version . '|';
        $hash .= $this->serial . '|';
        $hash .= $this->folio . '|';
        $hash .= $this->vendorRfc . '|';
        $hash .= $this->customerRfc . '|';
        return $hash;
    }

    public function beforeSave() {
        $this->invoice = $this->serial . $this->folio;
        $this->paymentType = ($this->paymentType ? : self::DEFAULT_PAYMENT_TYPE);
        $this->paymentMethod = ($this->paymentMethod ? : self::DEFAULT_PAYMENT_METHOD);
        $this->total = $this->subTotal - $this->discount + $this->taxAmt - $this->wthAmt;
        $this->md5 = md5($this->getHash());
        if ($this->isNewRecord) {
            $this->status = CfdStatusBehavior::CREATED;
        }
        return parent::beforeSave();
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
           'Status' => array(
                'class' => 'CfdStatusBehavior',
                'attribute' => 'status',
            ),
        );
    }

    public function createXml() {

        // This will create a SAT compliant XML
        // Returns the XML
        // Depending on the CFD version, it will also invoke the PAC WebService.

        // Create document
        $xml = new DOMDocument("1.0","UTF-8");
        $this->version = '3.2';
        switch ($this->version) {
            case '3.0':
                $root = $xml->createElementNS("http://www.sat.gob.mx/cfd/3", "cfdi:Comprobante");
                // Set namespaces, etc.
                $root->setAttribute("xsi:schemaLocation", "http://www.sat.gob.mx/cfd/3 http://www.sat.gob.mx/sitio_internet/cfd/3/cfdv3.xsd");
                $root->setAttribute("xmlns:xsi", "http://www.w3.org/2001/XMLSchema-instance");
                break;
            case '3.2':
                $root = $xml->createElementNS("http://www.sat.gob.mx/cfd/3", "cfdi:Comprobante");
                // Set namespaces, etc.
                $root->setAttribute("xsi:schemaLocation", "http://www.sat.gob.mx/cfd/3 http://www.sat.gob.mx/sitio_internet/cfd/3/cfdv32.xsd");
                $root->setAttribute("xmlns:xsi", "http://www.w3.org/2001/XMLSchema-instance");
                break;
        }

        // Find certificate for the issuer.
        if (Yii::app()->params['runmode'] == 'PRODUCTION') {
            $vendorRfc = $this->vendorParty->Rfc;
            $cfdDate = new DateTime($this->dttm);
        } else {
            $vendorRfc = Yii::app()->params['demorfc'];
            $cfdDate = new DateTime();
            $cfdDate = $cfdDate->sub(DateInterval::createFromDateString("15 minutes"));
        }
        $certificate = SatCertificate::model()->find('rfc = :rfc and validFrom <= :dttm and validTo >= :dttm', array(
            ':rfc' => $vendorRfc, ':dttm' => $cfdDate->format(DateTime::ISO8601)));
        if (!$certificate) die('No certificate found');

        $root = $xml->appendChild($root);

        // Set comprobante attributes.
        // Version
        $root->setAttribute("version", $this->version);
        // Serie
        if ($this->serial) $root->setAttribute("serie", $this->serial);
        // Folio
        if ($this->folio) $root->setAttribute("folio", $this->folio);
        // Fecha
        $root->setAttribute("fecha", substr($cfdDate->format(DateTime::ISO8601), 0, strlen($cfdDate->format(DateTime::ISO8601)) - 5));
        // formaDePago
        $root->setAttribute("formaDePago", $this->paymentType);
        // nocertificado
        $root->setAttribute("noCertificado", $certificate->nbr);
        // certificado
        $root->setAttribute("certificado", $certificate->pem);

        // condicionesDePago
        if ($this->paymentTerm) $root->setAttribute("condicionesDePago", $this->paymentTerm);
        // subTotal
        $root->setAttribute("subTotal", number_format($this->subTotal, 6, ".", ""));
        // descuento
        if ($this->discount > 0) {
            $root->setAttribute("descuento", number_format($this->discount, 6, ".", ""));
            // motivoDescuento
            if ($this->discountReason) $root->setAttribute("motivoDescuento", $this->discountReason);
        }
        // TipoCambio
        if ($this->exchangeRate) $root->setAttribute("TipoCambio", $this->exchangeRate);
        // Moneda
        $root->setAttribute("Moneda", $this->currency);
        // total
        $root->setAttribute("total", number_format($this->total, 6, ".", ""));
        // metodoDePago
        $root->setAttribute("metodoDePago", $this->paymentMethod);
        // tipoDeComprobante
        $root->setAttribute("tipoDeComprobante", $this->VoucherType->text);
        // Emisor
        $emisor = $root->appendChild($xml->createElement("cfdi:Emisor"));
        // RFC
        $emisor->setAttribute("rfc", $vendorRfc);
        // Nombre emisor
        $emisor->setAttribute("nombre", $this->vendorParty->FullName);

        // Receptor
        $receptor = $root->appendChild($xml->createElement("cfdi:Receptor"));

        // RFC receptor
        $receptor->setAttribute("rfc", $this->customerParty->Rfc);

        // Nombre receptor
        $receptor->setAttribute("nombre", $this->customerParty->FullName);

        //Domicilios.
        foreach ($this->cfdAddresses as $cfdAddress) {
            switch ($cfdAddress->type) {
                case AddressTypeBehavior::FISCAL:
                    // Domicilio fiscal del emisor
                    $address = $emisor->appendChild($xml->createElement("cfdi:DomicilioFiscal"));
                    $lugarDeExpedicion = $cfdAddress->address->state . ', ' . $cfdAddress->address->country;
                    break;
                case AddressTypeBehavior::ISSUING:
                    // Expedido en
                    $address = $emisor->appendChild($xml->createElement("cfdi:ExpedidoEn"));
                    $lugarDeExpedicion = $cfdAddress->address->state . ', ' . $cfdAddress->address->country;
                    break;
                case AddressTypeBehavior::BILL_TO:
                    // Domicilio fiscal del receptor
                    $address = $receptor->appendChild($xml->createElement("cfdi:Domicilio"));
                    break;
                default:
                    continue;
            }
            // Street
            if ($cfdAddress->address->street) $address->setAttribute('calle', $cfdAddress->address->street);
            // noExterior
            if ($cfdAddress->address->extNbr) $address->setAttribute('noExterior', $cfdAddress->address->extNbr);
            // noInterior
            if ($cfdAddress->address->intNbr) $address->setAttribute('noInterior', $cfdAddress->address->intNbr);
            // colonia
            if ($cfdAddress->address->neighbourhood) $address->setAttribute('colonia', $cfdAddress->address->neighbourhood);
            // localidad
            if ($cfdAddress->address->city) $address->setAttribute('localidad', $cfdAddress->address->city);
            // referencia
            if ($cfdAddress->reference) $address->setAttribute('referencia', $cfdAddress->reference);
            // municipio
            if ($cfdAddress->address->municipality) $address->setAttribute('municipio', $cfdAddress->address->municipality);
            // estado
            if ($cfdAddress->address->state) $address->setAttribute('estado', $cfdAddress->address->state);
            // pais
            if ($cfdAddress->address->country) $address->setAttribute('pais', $cfdAddress->address->country);
            // codigoPostal
            $address->setAttribute("codigoPostal", $cfdAddress->address->zipCode);
        }
        if ($this->version == '3.2') {
            // LugarExpedicion
            $root->setAttribute("LugarExpedicion", $lugarDeExpedicion);
//            // NumCtaPago
//            $root->setAttribute("LugarExpedicion", $this->VoucherType->text);
        }
        // Nodo conceptos
        $regimenFiscal = $emisor->appendChild($xml->createElement("cfdi:RegimenFiscal"));
        $regimenFiscal->setAttribute("Regimen", 'REGIMEN GENERAL');

        $regimenFiscal = $emisor->appendChild($xml->createElement("cfdi:RegimenFiscal"));
        $regimenFiscal->setAttribute("Regimen", 'REGIMEN GENERAL');

        // Nodo conceptos
        $conceptos = $root->appendChild($xml->createElement("cfdi:Conceptos"));
        foreach ($this->cfdItems as $cfdItem) {
            $item = $conceptos->appendChild($xml->createElement("cfdi:Concepto"));
            // cantidad
            $item->setAttribute("cantidad", $cfdItem->qty);
            // unidad
            $item->setAttribute("unidad", $cfdItem->uom);
            // noIdentificacion
            if ($cfdItem->productCode) $item->setAttribute("noIdentificacion", $cfdItem->productCode);
            // descripcion
            $item->setAttribute("descripcion", $cfdItem->description);
            // valorUnitario
            $item->setAttribute("valorUnitario", number_format($cfdItem->unitPrice, 6, ".", ""));
            // importe
            $item->setAttribute("importe", number_format($cfdItem->amt, 6, ".", ""));
            // Pedimento
            foreach ($cfdItem->customsPermits as $customsPermit) {
                $infomacionAduanera = $item->appendChild($xml->createElement("cfdi:InformacionAduanera"));
                $infomacionAduanera->setAttribute("numero", $customsPermit->nbr);
                $permitDt = new DateTime($customsPermit->dt);
                $infomacionAduanera->setAttribute("fecha", $permitDt->format('Y-m-d'));
                $infomacionAduanera->setAttribute("aduana", $customsPermit->office);
            }
        }
        $impuestos = $root->appendChild($xml->createElement("cfdi:Impuestos"));
        if (count($this->cfdTaxes) > 0) {
            $taxSum = 0;
            $traslados = $impuestos->appendChild($xml->createElement("cfdi:Traslados"));
            foreach ($this->cfdTaxes as $cfdTax) {
                $traslado = $traslados->appendChild($xml->createElement("cfdi:Traslado"));
                $traslado->setAttribute("impuesto", $cfdTax->name);
                $traslado->setAttribute("tasa", number_format($cfdTax->rate, 6, ".", ""));
                $traslado->setAttribute("importe", number_format($cfdTax->amt, 6, ".", ""));
                $taxSum += $cfdTax->amt;
            }
            $impuestos->setAttribute("totalImpuestosTrasladados", number_format($taxSum, 6, ".", ""));
        }
        if (count($this->cfdWithholdings) > 0) {
            $whtSum = 0;
            $retenciones = $impuestos->appendChild($xml->createElement("cfdi:Retenciones"));
            foreach ($this->cfdWithholdings as $cfdWht) {
                $retencion = $retenciones->appendChild($xml->createElement("cfdi:Retencion"));
                $retencion->setAttribute("impuesto", $cfdWht->taxName);
                $retencion->setAttribute("importe", number_format($cfdWht->amt, 6, ".", ""));
                $whtSum += $cfdWht->amt;
            }
            $retenciones->setAttribute("totalImpuestosRetenidos", number_format($whtSum, 6, ".", ""));
        }

        // Sign CFD
        // Load XSLT

        // Get original string
        libxml_use_internal_errors(true);
        $xslt = new XSLTProcessor();
        $xsl = new DOMDocument("1.0", "UTF-8");
        $xsl->substituteEntities = true;
        switch ($this->version) {
            case '3.0':
                $xsltFile = Yii::app()->params['ORIGINAL_STRING_XSLT_3.0'];
                break;
            case '3.2':
                $xsltFile = Yii::app()->params['ORIGINAL_STRING_XSLT_3.2'];
                break;
        }

        if (!$xsl->load($xsltFile, LIBXML_NOCDATA)) {
            throw new Exception("[ERROR] No se pudo recuperar la plantilla " . $xsltFile . " provista por SAT. Es posible que haya problemas en la red. Por favor intente mas tarde.");
            return false;
        }
        $xslt->importStylesheet($xsl);

        $dom = new DOMDocument("1.0", "UTF-8");
        $dom->loadXML($xml->saveXML());

        $originalString = $xslt->transformToXml($dom);
        if (!$originalString) {
            $errors = libxml_get_errors();
            print_r($errors);
        } else {
            $this->originalString = $originalString;
            echo $originalString . PHP_EOL;
        }

        $pemKey = "-----BEGIN ENCRYPTED PRIVATE KEY-----\n".chunk_split($certificate->keyPem, 64, "\n")."-----END ENCRYPTED PRIVATE KEY-----\n";

//        $pkeyid = openssl_get_privatekey(array($pemKey, $this->MasterRecord->cfdpasswd));
        $pkeyid = openssl_get_privatekey(array($pemKey, $certificate->keyPassword));
        openssl_sign($originalString, $cryptStamp, $pkeyid, OPENSSL_ALGO_SHA1);

        openssl_free_key($pkeyid);
        $stamp = base64_encode($cryptStamp);             // lo codifica en formato base64
        $root->setAttribute("sello", $stamp);
        $this->seal = $stamp;

        echo $xml->saveXML() . PHP_EOL;

        $mySuite = new MySuiteRequest();
        $mySuite->country = 'MX';
        $mySuite->entity = Yii::app()->params['MYSUITE_ENTITY'];
        $mySuite->requestor = Yii::app()->params['MYSUITE_REQUESTOR'];
        $mySuite->transaction = "TIMBRAR";
        $mySuite->url = Yii::app()->params['MYSUITE_WSDL'];
        $mySuite->username = Yii::app()->params['MYSUITE_USERNAME'];
        $mySuite->data1 = $xml->saveXML();

        $response = $mySuite->requestTransaction();

        if ($response->result == 'true') {
            echo $response->data1 . PHP_EOL;

            $tfdEl = simplexml_load_string($response->data1);
            $tfdNode = dom_import_simplexml($tfdEl);

            $complemento = $root->appendChild($xml->createElement("cfdi:Complemento"));
            $tfdNode = $complemento->appendChild($xml->importNode($tfdNode, true));

            $dom = new DOMDocument("1.0", "UTF-8");
            $dom->loadXML($response->data1);

            $xsltTfd = new XSLTProcessor();
            $xslTfd = new DOMDocument("1.0", "UTF-8");
            $xslTfd->substituteEntities = true;
            if (!$xslTfd->load(Yii::app()->params['ORIGINAL_STRING_TFD_XSLT_1.0'] , LIBXML_NOCDATA)) {
                throw new Exception("[ERROR] No se pudo recuperar la plantilla " . $xsltTfdFile . " provista por SAT. Es posible que haya problemas en la red. Por favor intente mas tarde.");
                return false;
            }
            $xsltTfd->importStylesheet($xslTfd);

            $originalTfdString = $xsltTfd->transformToXml($dom);
            if (!$originalTfdString) {
                $errors = libxml_get_errors();
                foreach ($errors as $error) {
                    echo $error->message.PHP_EOL;
                }
                throw new Exception("[ERROR] Error en la transformación de la cadena original");
            } else {
    //            $this->setAttr(InvoiceAttribute::TFD_ORIGINAL_STRING, $originalTfdString);
                $this->dtsOriginalString = $originalTfdString;
            }
            foreach ($tfdEl->attributes() as $attributeName => $attributeValue) {
                switch ($attributeName) {
                    case 'FechaTimbrado':
                        $this->dtsDttm = $attributeValue;
                        break;
                    case 'noCertificadoSAT':
                        $this->dtsSatCertNbr = $attributeValue;
                        break;
                    case 'version':
                        $this->dtsVersion = $attributeValue;
                        break;
                    case 'selloSAT':
                        $this->dtsSatSeal = $attributeValue;
                        break;
                    case 'UUID':
                        $this->uuid = $attributeValue;
                        break;
                }
            }

            // Create CBB code
            $this->cbb = '?re=' . $vendorRfc .
                    "&rr=" . $this->customerParty->Rfc .
                    "&tt=" . substr(str_repeat("0", 17) . number_format($this->total, 6, ".", ""), -17) .
                    "&id=" . $this->uuid;

            $this->save();
            return $xml->saveXML();
        } else {
            echo $response->description . PHP_EOL;
            echo $response->data . PHP_EOL;
        }
    }
}