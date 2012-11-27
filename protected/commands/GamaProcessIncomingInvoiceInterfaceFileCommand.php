<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GamaProcessIncomingInvoiceInterfaceFileCommand:
 *
 * This process performs the following tasks:
 *  1) Opens the file in Castrol format.
 *  2) Validates the contents of the file.
 *  3) Produces a Native XML file to be processed
 *
 * @author jmariani
 */
class GamaProcessIncomingInvoiceInterfaceFileCommand extends CConsoleCommand {

    public function actionValidate($modelId) {
        try {
            $model = IncomingInvoiceInterfaceFile::model()->findByPk($modelId);
            GamaHelper::validateIncomingInvoiceInterfaceFile($model);
        } catch (Exception $e) {
            yii::trace('[error] ' . $e->getMessage(), __METHOD__);
        }
    }

    public function actionProcess($modelId) {
        $model = IncomingInvoiceInterfaceFile::model()->findByPk($modelId);
        GamaHelper::processIncomingInvoiceInterfaceFile($model);
    }

}

?>
