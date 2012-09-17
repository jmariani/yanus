<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GamaProcessIncomingInvoiceFile
 *
 * @author jmariani
 */
class GamaCreatePdfFromCfdCommand extends CConsoleCommand {
    public function run($args) {
        // args[0] -> CFD ID


        $cfd = Cfd::model()->findByPk($args[0]);
        $fName = $cfd->getBasePath() . DIRECTORY_SEPARATOR . $cfd->getPdfFileName();

        $pdf = new GamaPdfInvoice();
        $pdf->create($cfd, $fName);
        
    }
}

?>
