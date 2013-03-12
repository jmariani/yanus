<?php

/**
 * Description of IncomingInvoiceInterfaceFileUpload
 *
 * This action is used to upload an Interface File for Invoices
 *
 * @author jmariani
 */
class PartyMailToggle extends CAction {
    public function run($id) {

        $partyMail = PartyMail::model()->findByPk($id);
        $partyMail->active = !$partyMail->active;
        $partyMail->save();

//        $controller = $this->getController();
//
//
//        // get the Model Name
//        $model_class = 'PartyMail';
//
//        // create the Model
//        $model = $controller->loadModel($id, $model_class);
////        $model = new $model_class();
//
//        // Uncomment the following line if AJAX validation is needed
////         $this->performAjaxValidation($model);
//        error_log($id);
//        if (isset($_POST[$model_class])) {
//            $model->setAttributes($_POST[$model_class]);
//            $model->active = !$model->active;
//            $model->save();
//        }
////        $controller->render('admin');
    }
}

?>
