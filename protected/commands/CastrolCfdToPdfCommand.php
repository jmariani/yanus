<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
Yii::import('application.vendors.tcpdf.tcpdf');

/**
 * Description of GamaCfdPdCreationCommand
 *
 * @author jorgemariani
 */
class CastrolCfdToPdfCommand extends CConsoleCommand {

    const REAL_WIDTH = 196;
    const WIDTH_DESC = 96;
    const WIDTH_QTY = 10;
    const WIDTH_UOM = 10;
    const WIDTH_AUTH = 10;
    const WIDTH_UNP = 30;
    const WIDTH_AMT = 40;
    const WIDTH_CUSTOMER_BOX = 131;
    const WIDTH_INVOICE_BOX = 65;
    const WIDTH_WORDAMOUNT_BOX = 126;
    const WIDTH_CBB = 50;
    const WIDTH_SAT_LABELS = 56;
    const WIDTH_ORIGINAL_STRING = 154;
    const ROWS_PER_PAGE = 60;

    public $invoice;
    public $cfdFile;
    public $logoFile;
    public $master;
    private $lastPage = false;
    private $xml;
    private $sumItem = 0;
    private $sumTax = 0;
    private $sumDiscount = 0;
    private $row = 0;
    private $cbb;

    public function run($args) {
        try {
            $cfd = Cfd::model()->findByPk($args[0]);
            if (!$cfd)
                throw new Exception(yii::t('yanus', 'Cannot find CFD with id "{id}"', array('{id}' => $args[0])));
            try {
//                $cfd->swNextStatus(cfd::STATUS_CREATING_PDF);
//                $cfd->save();
                $fName = pathinfo($cfd->cfdFile->location, PATHINFO_DIRNAME) . DIRECTORY_SEPARATOR . pathinfo($cfd->cfdFile->location, PATHINFO_FILENAME) . '.pdf';
                $pdf = new CastrolPdfInvoice('P', 'mm', 'LETTER');

                $pdf->create($cfd, $fName);
                // Create file asset
                $fileAsset = FileAsset::model()->find('location = :name', array(':name' => $fName));
                if (!$fileAsset) {
                    $fileAsset = new FileAsset();
                    $fileAsset->location = $fName;
                }

                $cfd->attachFileAsset($fName, CfdFileAssetTypeBehavior::GRAPHIC_VERSION);

//                $cfd->swNextStatus(cfd::STATUS_PDF_CREATED);
//                $cfd->save();
                // Since there's no addenda, move to READY
//                $cfd->swNextStatus(cfd::STATUS_READY);
                $cfd->save();
            } catch (Exception $e) {
                yii::log($e->getMessage(), CLogger::LEVEL_ERROR, __METHOD__);
//                $cfd->swNextStatus(cfd::STATUS_PDF_CREATION_ERROR);
//                $cfd->save();
            }
        } catch (Exception $e) {
            echo $e->getMessage() . PHP_EOL;
        }
    }

    private function createPdf(Cfd $cfd) {
        try {
//            $cfd = Cfd::model()->findByPk($args[0]);
            $cfd->swNextStatus(cfd::STATUS_CREATING_PDF);
            $cfd->save();
            $fName = pathinfo($cfd->cfdFile->location, PATHINFO_DIRNAME) . DIRECTORY_SEPARATOR . pathinfo($cfd->cfdFile->location, PATHINFO_FILENAME) . '.pdf';

            $pdf = new GamaPdfInvoice();
            $pdf->create($cfd, $fName);
            // Create file asset
            $fileAsset = FileAsset::model()->find('location = :name', array(':name' => $fName));
            if (!$fileAsset) {
                $fileAsset = new FileAsset();
                $fileAsset->name = pathinfo($fName, PATHINFO_BASENAME);
                $fileAsset->location = $fName;
            }
            $cfd->addFileAsset($fName, FileAssetTypeBehavior::GRAPHIC_REPRESENTATION);

            $cfd->swNextStatus(cfd::STATUS_PDF_CREATED);
            $cfd->save();
            // Since there's no addenda, move to READY
            $cfd->swNextStatus(cfd::STATUS_READY);
            $cfd->save();
        } catch (Exception $e) {
            yii::log($e->getMessage(), CLogger::LEVEL_ERROR, __METHOD__);
            $cfd->swNextStatus(cfd::STATUS_PDF_CREATION_ERROR);
            $cfd->save();
        }
    }

}
