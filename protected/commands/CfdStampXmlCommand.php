<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CfdStampXmlCommand
 *
 * @author jmariani
 */
class CfdStampXmlCommand extends CConsoleCommand {

    public function run($args) {
        try {
            $cfd = Cfd::model()->findByPk($args[0]);
            if (!$cfd)
                throw new Exception(yii::t('yanus', 'Cannot find CFD with id "{id}"', array('{id}' => $args[0])));
            try {
                $cfd->swNextStatus(Cfd::STATUS_STAMPING_XML);
                $cfd->save();
                $xml = new DOMDocument("1.0", "UTF-8");
                $xml->load($cfd->cfdFile->location);
                if (!$xml)
                    throw new CException(yii::t('yanus', 'Failed to load CFD XML file'));
                $result = false;
                // Find the MySuiteConfig record
                $mySuiteConfig = MySuiteConfig::model()->find('runMode = :runMode', array(':runMode' => SystemConfig::getValue(SystemConfig::RUN_MODE)));
                while (!$result) {
                    // MySuite PAC PROCESSING
                    $mySuite = new MySuiteRequest();
                    $mySuite->country = $mySuiteConfig->country;
                    $mySuite->transaction = MySuiteRequest::TRANSACTION_TIMBRAR;

                    $mySuite->entity = $mySuiteConfig->entity;
                    $mySuite->requestor = $mySuiteConfig->requestor;
                    $mySuite->url = $mySuiteConfig->wsdl;
                    $mySuite->username = $mySuiteConfig->userName;
                    $mySuite->data1 = $xml->saveXML();

                    $response = $mySuite->requestTransaction(MySuiteRequest::TRANSACTION_TIMBRAR);
                    // If request has error
                    if (!$response->result) {
                        switch ($response->lastResult) {
                            case 'TIMBRE_OUT_OF_TIME_LIMIT':
                                // if the cfd is too old or too young
                                $timeStamp = new DateTime($response->timeStamp);    // Server date
                                $cfdDt = new DateTime($xml->firstChild->attributes->getNamedItem('fecha')->nodeValue); // invoice date
//                            echo $timeStamp->format(DateTime::ISO8601) . PHP_EOL;
//                            echo $cfdDt->format(DateTime::ISO8601) . PHP_EOL;
//                            echo ($timeStamp->format('U') - $cfdDt->format('U')) . PHP_EOL;
                                if ($timeStamp->format('U') - $cfdDt->format('U') < 0) // if invoice date is in the future
                                    sleep(abs($timeStamp->format('U') - $cfdDt->format('U')));  // wait until
                                else
                                    throw new CException('[' . $response->lastResult . '] - ' . $response->description . ' - ' . $response->hint);
//                            yii::app()->end();
                                break;
                            default:
                                throw new CException('[' . $response->lastResult . '] - ' . $response->description . ' - ' . $response->hint);
                                break;
                        }
                    } else
                        $result = true;
                }
                // Get response as SimpleXML
                $tfdEl = simplexml_load_string($response->data1);
                if (!$tfdEl)
                    throw new CException(yii::t('yanus', 'Failed to load response->data1'));

                // Import response as a DOM node.
                $tfdNode = dom_import_simplexml($tfdEl);

                // Find Comprobante node.
                $root = $xml->firstChild;
                // Attach Complemento node to XML
                $complemento = $root->appendChild($xml->createElement("cfdi:Complemento"));
                // Append TFD node to Complemento.
                $tfdNode = $complemento->appendChild($xml->importNode($tfdNode, true));
                // Save new CFD
                $xml->save($cfd->cfdFile->location);

                // Create TFD original string.
                $tfdXsltFile = SystemConfig::getValue(SystemConfig::TFD_OS_XSLT . SystemConfig::getValue(SystemConfig::CURRENT_TFD_VERSION));
                error_log('XSLT file: ' . $tfdXsltFile);
                $xslTfd = new DOMDocument("1.0", "UTF-8");
                $xslTfd->substituteEntities = true;
                if (!$xslTfd->load($tfdXsltFile))
                    throw new CException(yii::t('yanus', 'Failed to retrieve XSLT file "{file}"', array('{file}' => $tfdXsltFile)));

                $xsltTfd = new XSLTProcessor();
                @$xsltTfd->importStylesheet($xslTfd);

                $dom = new DOMDocument("1.0", "UTF-8");
                $dom->loadXML($response->data1);

                $originalTfdString = $xsltTfd->transformToXml($tfdEl);
                if (!$originalTfdString)
                    throw new CException(yii::t('yanus', 'Error retrieving TFD Original string'));

                $dts = new SatStamp();
                $dts->originalString = $originalTfdString;
                foreach ($tfdEl->attributes() as $attributeName => $attributeValue) {
                    switch ($attributeName) {
                        case 'FechaTimbrado':
                            $dts->dttm = $attributeValue;
                            break;
                        case 'noCertificadoSAT':
                            $dts->certificate = $attributeValue;
//                            $certificate = SatCertificate::model()->find('nbr = :nbr', array(':nbr' => $attributeValue));
//                            if ($certificate)
//                                $dts->SatCertificate_id = $certificate->id;
                            break;
                        case 'version':
                            $dts->version = $attributeValue;
                            break;
                        case 'selloSAT':
                            $dts->stamp = $attributeValue;
                            break;
                        case 'UUID':
                            $dts->uuid = $attributeValue;
                            break;
                    }
                }
                $cfd->addRelatedObject($dts);

                // Create CBB code
                $cfd->cbb = '?re=' . $cfd->vendor->rfc .
                        "&rr=" . $cfd->customer->rfc .
                        "&tt=" . substr(str_repeat("0", 17) . number_format($cfd->total, 6, ".", ""), -17) .
                        "&id=" . $dts->uuid;

                $cfd->swNextStatus(cfd::STATUS_XML_STAMPED);
                $cfd->save();
            } catch (Exception $e) {
                echo $e->getMessage() . PHP_EOL;
                $cfd->swNextStatus(cfd::STATUS_XML_STAMP_ERROR);
                $cfd->save();
            }
        } catch (Exception $e) {
            echo $e->getMessage() . PHP_EOL;
        }
    }

    private function stampXml(Cfd $cfd) {
        libxml_use_internal_errors(true);

        $log = false;

        // This will create a SAT compliant XML
        try {
//            $cfd = Cfd::model()->findByPk($args[0]);
//            if (!$cfd) throw new CException(yii::t('yanus', 'CFD with id "{id}" not found.', array('{id}' => $args[0])));
//            $log = new YanusLog(pathinfo($cfd->cfdFile->location, PATHINFO_DIRNAME) . DIRECTORY_SEPARATOR . pathinfo($cfd->cfdFile->location, PATHINFO_FILENAME) . '.log');

            $cfd->swNextStatus(Cfd::STATUS_STAMPING_XML);
            $cfd->save();
            $xml = new DOMDocument("1.0", "UTF-8");
            $xml->load($cfd->cfdFile->location);
            if (!$xml)
                throw new CException(yii::t('yanus', 'Failed to load CFD XML file'));
//            $xml = simplexml_load_file($cfd->CfdFile->location);

            $result = false;
            while (!$result) {
                // MySuite PAC PROCESSING
                $mySuite = new MySuiteRequest();
                $mySuite->country = 'MX';
                $mySuite->transaction = MySuiteRequest::TRANSACTION_TIMBRAR;

                $mySuite->entity = Yii::app()->params['MYSUITE_ENTITY'];
                $mySuite->requestor = Yii::app()->params['MYSUITE_REQUESTOR'];
                $mySuite->url = Yii::app()->params['MYSUITE_WSDL'];
                $mySuite->username = Yii::app()->params['MYSUITE_USERNAME'];
                $mySuite->data1 = $xml->saveXML();

                $response = $mySuite->requestTransaction(MySuiteRequest::TRANSACTION_TIMBRAR);
                // If request has error
                if (!$response->result) {
                    switch ($response->lastResult) {
                        case 'TIMBRE_OUT_OF_TIME_LIMIT':
                            // if the cfd is too old or too young
                            $timeStamp = new DateTime($response->timeStamp);    // Server date
                            $cfdDt = new DateTime($xml->firstChild->attributes->getNamedItem('fecha')->nodeValue); // invoice date
//                            echo $timeStamp->format(DateTime::ISO8601) . PHP_EOL;
//                            echo $cfdDt->format(DateTime::ISO8601) . PHP_EOL;
//                            echo ($timeStamp->format('U') - $cfdDt->format('U')) . PHP_EOL;
                            if ($timeStamp->format('U') - $cfdDt->format('U') < 0) // if invoice date is in the future
                                sleep(abs($timeStamp->format('U') - $cfdDt->format('U')));  // wait until
                            else
                                throw new CException('[' . $response->lastResult . '] - ' . $response->description . ' - ' . $response->hint);
//                            yii::app()->end();
                            break;
                        default:
                            throw new CException('[' . $response->lastResult . '] - ' . $response->description . ' - ' . $response->hint);
                            break;
                    }
                } else
                    $result = true;
            }
            // Get response as SimpleXML
            $tfdEl = simplexml_load_string($response->data1);
            if (!$tfdEl)
                throw new CException(yii::t('yanus', 'Failed to load response->data1'));

            // Import response as a DOM node.
            $tfdNode = dom_import_simplexml($tfdEl);

            // Find Comprobante node.
            $root = $xml->firstChild;
            // Attach Complemento node to XML
            $complemento = $root->appendChild($xml->createElement("cfdi:Complemento"));
            // Append TFD node to Complemento.
            $tfdNode = $complemento->appendChild($xml->importNode($tfdNode, true));
            // Save new CFD
            $xml->save($cfd->cfdFile->location);

            // Create TFD original string.
            $tfdXsltFile = SystemConfig::getValue(SystemConfig::TFD_OS_XSLT . SystemConfig::getValue(SystemConfig::CURRENT_TFD_VERSION));
            error_log('XSLT file: ' . $tfdXsltFile);
            $xslTfd = new DOMDocument("1.0", "UTF-8");
            $xslTfd->substituteEntities = true;
            if (!$xslTfd->load($tfdXsltFile))
                throw new CException(yii::t('yanus', 'Failed to retrieve XSLT file "{file}"', array('{file}' => $tfdXsltFile)));

            $xsltTfd = new XSLTProcessor();
            $xsltTfd->importStylesheet($xslTfd);

            $dom = new DOMDocument("1.0", "UTF-8");
            $dom->loadXML($response->data1);

            $originalTfdString = $xsltTfd->transformToXml($tfdEl);
            if (!$originalTfdString)
                throw new CException(yii::t('yanus', 'Error retrieving TFD Original string'));

            $dts = new SatStamp();
            $dts->Cfd_id = $cfd->id;
            $dts->originalString = $originalTfdString;
            foreach ($tfdEl->attributes() as $attributeName => $attributeValue) {
                switch ($attributeName) {
                    case 'FechaTimbrado':
                        $dts->dttm = $attributeValue;
                        break;
                    case 'noCertificadoSAT':
                        $dts->certificate = $attributeValue;
                        $certificate = SatCertificate::model()->find('nbr = :nbr', array(':nbr' => $attributeValue));
                        if ($certificate)
                            $dts->SatCertificate_id = $certificate->id;
                        break;
                    case 'version':
                        $dts->version = $attributeValue;
                        break;
                    case 'selloSAT':
                        $dts->stamp = $attributeValue;
                        break;
                    case 'UUID':
                        $dts->uuid = $attributeValue;
                        break;
                }
            }
            $dts->save();

            // Create CBB code
            $cfd->cbb = '?re=' . $cfd->vendorParty->rfc .
                    "&rr=" . $cfd->customerParty->rfc .
                    "&tt=" . substr(str_repeat("0", 17) . number_format($cfd->total, 6, ".", ""), -17) .
                    "&id=" . $dts->uuid;

            $cfd->swNextStatus(cfd::STATUS_XML_STAMPED);
            if (!$cfd->save())
                print_r($cfd->getErrors());
        } catch (Exception $e) {
//            echo $e->getMessage();
            yii::log($e->getMessage(), CLogger::LEVEL_ERROR, __METHOD__);
//            if (!$log) $log = new YanusLog(SystemConfig::getValue(SystemConfig::LOG_PATH) . DIRECTORY_SEPARATOR . $this->name . '.log');
//            $log->log($e->getMessage(), CLogger::LEVEL_ERROR);
            $cfd->swNextStatus(cfd::STATUS_XML_STAMP_ERROR);
            $cfd->save();
        }
    }

}

?>
