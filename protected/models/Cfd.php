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
        $root = $xml->createElementNS("http://www.sat.gob.mx/cfd/3", "cfdi:Comprobante");
        $root = $xml->appendChild($root);
        // Set namespaces, etc.
        $root->setAttribute("xsi:schemaLocation", "http://www.sat.gob.mx/cfd/3 http://www.sat.gob.mx/sitio_internet/cfd/3/cfdv3.xsd");
        $root->setAttribute("xmlns:xsi", "http://www.w3.org/2001/XMLSchema-instance");

        // Set comprobante attributes.
        // Version
        $root->setAttribute("version", $this->version);
        // Fecha
        $root->setAttribute("fecha", $this->dttm);
        // Serie
        if ($this->serial) $root->setAttribute("serie", $this->serial);
        // Folio
        if ($this->folio) $root->setAttribute("folio", $this->folio);
        // formaDePago
        $root->setAttribute("formaDePago", $this->paymentType);
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
        $emisor->setAttribute("rfc", $this->vendorRfc);
        // Nombre emisor
        $emisor->setAttribute("nombre", $this->vendorName);

        // Receptor
        $receptor = $root->appendChild($xml->createElement("cfdi:Receptor"));

        // RFC receptor
        $receptor->setAttribute("rfc", $this->customerRfc);

        // Nombre receptor
        $receptor->setAttribute("nombre", $this->customerName);

        //Domicilios.
        foreach ($this->cfdAddresses as $cfdAddress) {
            switch ($cfdAddress->type) {
                case AddressTypeBehavior::FISCAL:
                    // Domicilio fiscal del emisor
                    $address = $emisor->appendChild($xml->createElement("cfdi:DomicilioFiscal"));
                    break;
                case AddressTypeBehavior::ISSUING:
                    // Expedido en
                    $address = $emisor->appendChild($xml->createElement("cfdi:ExpedidoEn"));
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
            if ($cfdAddress->address->reference) $address->setAttribute('referencia', $cfdAddress->address->reference);
            // municipio
            if ($cfdAddress->address->municipality) $address->setAttribute('municipio', $cfdAddress->address->municipality);
            // estado
            if ($cfdAddress->address->state) $address->setAttribute('estado', $cfdAddress->address->state);
            // pais
            if ($cfdAddress->address->country) $address->setAttribute('pais', $cfdAddress->address->country);
            // codigoPostal
            $address->setAttribute("codigoPostal", $cfdAddress->address->zipCode);
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
        return $xml->saveXML();
    }

}