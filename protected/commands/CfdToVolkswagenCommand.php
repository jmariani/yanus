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
class CfdToVolkswagenCommand extends CConsoleCommand {

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
//                $cfd->swNextStatus(Cfd::STATUS_CREATING_XML);
//                $cfd->save();
//                $runMode = SystemConfig::getValue(SystemConfig::RUN_MODE);
//                if ($runMode == SystemConfig::RUN_MODE_PRODUCTION) {
//                    $vendorRfc = $cfd->vendor->rfc;
//                    $certificate = $cfd->satCertificate;
//                    $cfdDate = new DateTime($cfd->dttm);
//                } else {
//                    $vendorRfc = SystemConfig::getValue(SystemConfig::DEMO_RFC);
//                    $cfdDate = new DateTime();
//                    $cfdDate = $cfdDate->sub(DateInterval::createFromDateString("30 minutes"));
//
//                    // Get certificate for demo RFC
//                    $certificate = SatCertificate::model()->current()->find('rfc = :rfc', array(':rfc' => $vendorRfc));
//                    if (!$certificate)
//                        throw new CException(yii::t('yanus', 'Cannot find a valid certificate for DEMO RFC "{rfc}"', array('{rfc}' => $vendorRfc)));
//                }
//                $cfdPath = SystemConfig::getvalue(SystemConfig::CFD_PATH);
//
//                if (!$cfd->vendorParty->name)
//                    throw new CException(yii::t('yanus', 'CFD Vendor has no name defined.'));
//                else
//                    $vendorName = $cfd->vendorParty->name;
                // Create document
                $xml = new DOMDocument("1.0", "UTF-8");
                $root = $xml->appendChild($xml->createElement('cfdi:Addenda'));
                $factura = $root->appendChild($xml->createElement("PSV:Factura"));
                $factura->setAttribute("xmlns:PSV", "http://www.vwnovedades.com/volkswagen/kanseilab/shcp/2009/Addenda/PSV");
                // Version
                $factura->setAttribute("version", '1.0');
                switch ($cfd->voucherType) {
                    case 'ingreso':
                        $factura->setAttribute('tipoDocumentoFiscal', 'FA');
                        break;
                    case 'egreso':
                        $factura->setAttribute('tipoDocumentoFiscal', 'CR');
                        break;
                }
                $factura->setAttribute('tipoDocumentoVWM', 'PSV');
                $factura->setAttribute('division', 'VW');

                $moneda = $factura->appendChild($xml->createElement("PSV:Moneda"));
                $moneda->setAttribute('tipoMoneda', $cfd->currency->code);
                if ($cfd->currency->code != 'MXP')
                    $moneda->setAttribute('tipoCambio', $cfd->exchangeRate);
                $moneda->setAttribute('codigoImpuesto', '1A');

                $proveedor = $factura->appendChild($xml->createElement("PSV:Proveedor"));
                $proveedor->setAttribute('codigo', '6001007232');
                $proveedor->setAttribute('nombre', $cfd->vendor->name);
//                $proveedor->setAttribute('correoContacto', 'noracecilia.alvarez@bp.com');
//                $destino = $factura->appendChild($xml->createElement("PSV:Destino"));
//                $destino->setAttribute('codigo', '6010');

                $solicitante = $factura->appendChild($xml->createElement("PSV:Solicitante"));
                $solicitante->setAttribute('nombre', $cfd->petitionerName);
                $solicitante->setAttribute('correo', $cfd->petitionerMail);

                $pdf = base64_encode(@file_get_contents($cfd->graphicVersionFile->location));
                $archivo = $factura->appendChild($xml->createElement("PSV:Archivo"));
                $archivo->setAttribute('datos', $pdf);
                $archivo->setAttribute('tipo', 'PDF');

                $partes = $factura->appendChild($xml->createElement("PSV:Partes"));
                $i = 1;
                foreach ($cfd->cfdItems as $item) {
                    $parte = $partes->appendChild($xml->createElement("PSV:Parte"));
                    $parte->setAttribute('posicion', $i++);
                    $parte->setAttribute('numeroMaterial', $item->productCode);
                    $parte->setAttribute('descripcionMaterial', $item->description);
                    $parte->setAttribute('cantidadMaterial', $item->qty);
                    $parte->setAttribute('unidadMedida', $item->uom);
                    $parte->setAttribute('precioUnitario', $item->unitPrice);
                    $parte->setAttribute('montoLinea', $item->amt);
                    $parte->setAttribute('codigoImpuesto', '1A');
                    $referencia = $parte->appendChild($xml->createElement("PSV:Referencias"));
                    $referencia->setAttribute('ordenCompra', $cfd->customerOrderNbr);
                }


                $srcDoc = new DOMDocument;
                $srcDoc->load($cfd->cfdFile->location);

                $import = $srcDoc->importNode($root, true);
                $srcDoc->documentElement->appendChild($import);
                echo $srcDoc->saveXML();

                $xmlFileName = $cfd->getFileBasename() . '-addenda-vw-psv.xml';
                $xml->save($xmlFileName);

                $xmlFileName = $cfd->getFileBasename() . '-con-addenda.xml';
                $srcDoc->save($xmlFileName);
//                $xmlCfd->save($cfd->cfdFile->location);
//                $fileAsset = FileAsset::model()->find('location = :location', array(':location' => $xmlFileName));
//                if (!$fileAsset) {
//                    $fileAsset = new FileAsset();
//                    $fileAsset->location = $xmlFileName;
//                    $fileAsset->save();
//                }
//                $cfdHasFileAsset = new CfdHasFileAsset();
//                $cfdHasFileAsset->fileAsset = $fileAsset;
//                $cfdHasFileAsset->cfd = $cfd;
//                $cfdHasFileAsset->type = CfdFileAssetTypeBehavior::CFD;
//                $cfdHasFileAsset->save();
//                $cfd->swNextStatus(Cfd::STATUS_XML_CREATED);
//                $cfd->save();
//                $cfd->runSignXml();
            } catch (Exception $e) {
                echo $e->getMessage() . ' ' . $e->getLine() . PHP_EOL;
                yii::log($e->getMessage(), CLogger::LEVEL_ERROR, __METHOD__);
//                $log = new YanusLog(SystemConfig::getvalue(SystemConfig::LOG_PATH) . DIRECTORY_SEPARATOR . $this->name . '.log');
//                $log->log($e->getMessage(), CLogger::LEVEL_ERROR);
//                $cfd->swNextStatus(cfd::STATUS_XML_CREATION_ERROR);
//                $cfd->save();
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
