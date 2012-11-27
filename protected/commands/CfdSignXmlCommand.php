<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CfdSignXmlCommand
 *
 * @author jmariani
 */
class CfdSignXmlCommand extends CConsoleCommand {
    public function run($args) {
        try {
            $cfd = Cfd::model()->findByPk($args[0]);
            if (!$cfd) throw new Exception(yii::t('app', 'Cannot find CFD id "{id}"', array('{id}' => $args[0])));
            // This will create a SAT compliant XML
            try {
                $cfd->swNextStatus(Cfd::STATUS_SIGNING_XML);
                $cfd->save();

                $xmlFile = $cfd->cfdFile->location;
                $xml = @simplexml_load_file($xmlFile);
                if (!$xml) throw new Exception(yii::t('app', 'Failed to load XML file "{file}"', array('{file}' => $xmlFile)));
                // Get original string
                $cfd->originalString = $cfd->createOriginalString($xml);
                $cfd->seal = $cfd->createSignature(simplexml_load_string($xml->saveXML()), $cfd->satCertificate);
                // sello
                $xml->addAttribute('sello', $cfd->seal);
                $xml->saveXML($xmlFile);
                $cfd->swNextStatus(cfd::STATUS_XML_SIGNED);
                $cfd->save();
                $cfd->runStampXml();
            } catch (Exception $e) {
                $log = new YanusLog(pathinfo($cfd->cfdFile->location, PATHINFO_DIRNAME) . DIRECTORY_SEPARATOR . pathinfo($cfd->cfdFile->location, PATHINFO_FILENAME) . '.log');
                $log->log($e->getMessage(), CLogger::LEVEL_ERROR);
                $cfd->swNextStatus(cfd::STATUS_XML_SIGNATURE_ERROR);
                $cfd->save();
            }
        } catch (Exception $e) {
            $log = new YanusLog(SystemConfig::getvalue(SystemConfig::LOG_PATH) . DIRECTORY_SEPARATOR . __CLASS__ . '.log');
            $log->log($e->getMessage(), CLogger::LEVEL_ERROR);
        }
    }
}

?>
