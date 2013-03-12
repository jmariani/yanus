<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CfdCreateXmlCommand
 *
 * @author jmariani
 */
class CfdToXmlCommand extends CConsoleCommand {

    public function run($args) {
        try {
            $cfd = Cfd::model()->findByPk($args[0]);
            if (!$cfd)
                throw new Exception(yii::t('yanus', 'Cannot find CFD with id "{id}"', array('{id}' => $args[0])));
            yii::trace(yii::t('yanus', 'Creating XML file'), __METHOD__);

            // This will create a SAT compliant XML
            try {
                echo yii::t('yanus', 'Processing CFD id {id}', array('{id}' => $cfd->id)) . PHP_EOL;
                yii::trace(yii::t('yanus', 'Processing CFD id {id}', array('{id}' => $cfd->id)), __METHOD__);
                $cfd->swNextStatus(Cfd::STATUS_CREATING_XML);
                $cfd->save();
                $runMode = SystemConfig::getValue(SystemConfig::RUN_MODE);
                if ($runMode == SystemConfig::RUN_MODE_PRODUCTION) {
                    $vendorRfc = $cfd->vendor->rfc;
                    $certificate = $cfd->satCertificate;
                    $cfdDate = new DateTime($cfd->dttm);
                } else {
                    $vendorRfc = SystemConfig::getValue(SystemConfig::DEMO_RFC);
                    $cfdDate = new DateTime();
                    $cfdDate = $cfdDate->sub(DateInterval::createFromDateString("30 minutes"));

                    // Get certificate for demo RFC
                    $certificate = SatCertificate::model()->current()->find('rfc = :rfc', array(':rfc' => $vendorRfc));
                    if (!$certificate)
                        throw new CException(yii::t('yanus', 'Cannot find a valid certificate for DEMO RFC "{rfc}"', array('{rfc}' => $vendorRfc)));
                }
//                $cfdPath = SystemConfig::getvalue(SystemConfig::CFD_PATH);
//
//                if (!$cfd->vendorParty->name)
//                    throw new CException(yii::t('yanus', 'CFD Vendor has no name defined.'));
//                else
//                    $vendorName = $cfd->vendorParty->name;
                // Create document
                $xml = new DOMDocument("1.0", "UTF-8");
                $root = $xml->createElementNS("http://www.sat.gob.mx/cfd/3", "cfdi:Comprobante");
                $root->setAttribute("xsi:schemaLocation", "http://www.sat.gob.mx/cfd/3 " . SystemConfig::getValue(SystemConfig::CFD_XSD . $cfd->version));
                $root->setAttribute("xmlns:xsi", "http://www.w3.org/2001/XMLSchema-instance");

                $root = $xml->appendChild($root);

                // Set comprobante attributes.
                // Version
                $root->setAttribute("version", $cfd->version);
                // Serie
                if ($cfd->serial)
                    $root->setAttribute("serie", $cfd->serial);
                // Folio
                if ($cfd->folio)
                    $root->setAttribute("folio", $cfd->folio);
                // Fecha
                if (strlen($cfdDate->format(DateTime::ISO8601)) == 19)
                    $root->setAttribute("fecha", $cfdDate->format(DateTime::ISO8601));
                else
                    $root->setAttribute("fecha", substr($cfdDate->format(DateTime::ISO8601), 0, strlen($cfdDate->format(DateTime::ISO8601)) - 5));

                // formaDePago
                $root->setAttribute("formaDePago", $cfd->paymentType);
                // nocertificado
                $root->setAttribute("noCertificado", $certificate->nbr);
                // certificado
                $root->setAttribute("certificado", $certificate->pem);
                // condicionesDePago
                if ($cfd->paymentTerm)
                    $root->setAttribute("condicionesDePago", $cfd->paymentTerm->name);
                // subTotal
                $root->setAttribute("subTotal", number_format($cfd->subTotal, 6, ".", ""));
                // descuento
                if ($cfd->discount > 0) {
                    $root->setAttribute("descuento", number_format($cfd->discount, 6, ".", ""));
                    // motivoDescuento
                    // Find motivos de descuento
                    $motivos = yii::app()->db->createCommand()
                            ->select('reason')
                            ->from('CfdDiscount')
                            ->where('Cfd_id = :id', array(':id' => $cfd->id))
                            ->group('reason')
                            ->queryAll(true);
                    $strMotivo = array();
                    foreach ($motivos as $motivo) {
                        $strMotivo[] = $motivo['reason'];
                    }
                    if (strlen(implode(',', $strMotivo)) > 0)
                        $root->setAttribute("motivoDescuento", implode(',', $strMotivo));
                }
                // TipoCambio
                if ($cfd->exchangeRate)
                    $root->setAttribute("TipoCambio", $cfd->exchangeRate);
                // Moneda
                if ($cfd->currency)
                    $root->setAttribute("Moneda", $cfd->currency->code);
                // total
                $root->setAttribute("total", number_format($cfd->total, 6, ".", ""));
                // tipoDeComprobante
                $root->setAttribute("tipoDeComprobante", $cfd->voucherType);
                // metodoDePago
                $root->setAttribute("metodoDePago", $cfd->paymentMethod);
                if ($cfd->version == '3.2') {
                    // LugarExpedicion
                    $root->setAttribute("LugarExpedicion", $cfd->expeditionPlace);
                    // NumCtaPago
                    if ($cfd->paymentAcctNbr)
                        $root->setAttribute("NumCtaPago", $cfd->paymentAcctNbr);
                }

                // Emisor
                $emisor = $root->appendChild($xml->createElement("cfdi:Emisor"));
                // RFC
                $emisor->setAttribute("rfc", $vendorRfc);
                // Nombre emisor
                $emisor->setAttribute("nombre", $cfd->vendor->name);

                // Receptor
                $receptor = $root->appendChild($xml->createElement("cfdi:Receptor"));
                // RFC receptor
                $receptor->setAttribute("rfc", $cfd->customer->rfc);
                // Nombre receptor
                $receptor->setAttribute("nombre", $cfd->customer->name);

                foreach ($cfd->cfdAddresses as $cfdAddress) {
                    switch ($cfdAddress->type) {
                        case AddressTypeBehavior::PRIMARY:
                            // Domicilio fiscal del emisor
                            $address = $emisor->appendChild($xml->createElement("cfdi:DomicilioFiscal"));
                            break;
                        case AddressTypeBehavior::BILLED_FROM:
                            // Expedido en
                            $address = $emisor->appendChild($xml->createElement("cfdi:ExpedidoEn"));
                            break;
                        case AddressTypeBehavior::BILL_TO:
                            // Domicilio fiscal del receptor
                            $address = $receptor->appendChild($xml->createElement("cfdi:Domicilio"));
                            break;
                        default:
                            $address = false;
                            break;
                    }
                    if ($address) {
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
                        $address->setAttribute('estado', $cfdAddress->address->state->code);
                        // pais
                        $address->setAttribute('pais', $cfdAddress->address->state->country->code);
                        // codigoPostal
                        $address->setAttribute("codigoPostal", $cfdAddress->address->zipCode);
                    }
                }

                // Nodo Regimen Fiscal
                if ($cfd->version == '3.2') {
                    foreach ($cfd->cfdTaxRegimes as $taxRegime) {
                        $regimenFiscal = $emisor->appendChild($xml->createElement("cfdi:RegimenFiscal"));
                        $regimenFiscal->setAttribute("Regimen", $taxRegime->name);
                    }
                }

                // Nodo conceptos
                $conceptos = $root->appendChild($xml->createElement("cfdi:Conceptos"));
                foreach ($cfd->cfdItems as $cfdItem) {
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
                    $item->setAttribute("importe", number_format($cfdItem->amt, 6, ".", ""));

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
                // Nodo impuestos
                $impuestos = $root->appendChild($xml->createElement("cfdi:Impuestos"));
//                // Whitholdings
//                if ($cfd->withHolding > 0) {
//                    $impuestos->setAttribute("totalImpuestosRetenidos", number_format($cfd->withHolding, 6, ".", ""));
//                    $retenciones = $impuestos->appendChild($xml->createElement("cfdi:Retenciones"));
//                    foreach ($cfd->WithHoldings as $withHolding) {
//                        $retencion = $retenciones->appendChild($xml->createElement("cfdi:Retencion"));
//                        $retencion->setAttribute("impuesto", $withHolding->name);
//                        $retencion->setAttribute("importe", number_format($withHolding->amt, 6, ".", ""));
//                        $whtSum += $withHolding->amt;
//                    }
//                }
                // Taxes
                if ($cfd->tax > 0) {
                    $impuestos->setAttribute("totalImpuestosTrasladados", number_format($cfd->tax, 6, ".", ""));
                    $traslados = $impuestos->appendChild($xml->createElement("cfdi:Traslados"));
                    // Get taxes
                    $taxes = yii::app()->db->createCommand()
                            ->select(array('name, rate, sum(amt) as amt'))
                            ->from('CfdTax')
                            ->where(array('and', 'Cfd_id = :id', 'local = 0', 'withHolding = 0'), array(':id' => $cfd->id))
                            ->group(array('name', 'rate'))
                            ->queryAll(true);

                    foreach ($taxes as $tax) {
                        $impuesto = $traslados->appendChild($xml->createElement("cfdi:Traslado"));
                        $impuesto->setAttribute("impuesto", $tax['name']);
                        $impuesto->setAttribute("tasa", $tax['rate']);
                        $impuesto->setAttribute("importe", number_format($tax['amt'], 6, ".", ""));
                    }
                }

                $cfd->save();

                $xmlFileName = $cfd->getFileBasename() . '.xml';
                $xml->save($xmlFileName);

                $cfd->attachFileAsset($xmlFileName, CfdFileAssetTypeBehavior::CFD);

                $cfd->swNextStatus(Cfd::STATUS_XML_CREATED);
                $cfd->save();

//                $cfd->runSignXml();
            } catch (Exception $e) {
                echo $e->getMessage() . PHP_EOL;
                yii::log($e->getMessage(), CLogger::LEVEL_ERROR, __METHOD__);
//                $log = new YanusLog(SystemConfig::getvalue(SystemConfig::LOG_PATH) . DIRECTORY_SEPARATOR . $this->name . '.log');
//                $log->log($e->getMessage(), CLogger::LEVEL_ERROR);
                $cfd->swNextStatus(cfd::STATUS_XML_CREATION_ERROR);
                $cfd->save();
            }
        } catch (Exception $e) {
            echo $e->getMessage() . PHP_EOL;
            yii::log($e->getMessage(), CLogger::LEVEL_ERROR, __METHOD__);
//            $log = new YanusLog(SystemConfig::getvalue(SystemConfig::LOG_PATH) . DIRECTORY_SEPARATOR . __CLASS__ . '.log');
//            $log->log($e->getMessage(), CLogger::LEVEL_ERROR);
        }
    }

}

?>
