<?php

/**
 * Description of IncomingInvoiceInterfaceFileUpload
 *
 * This action is used to upload an Interface File for Invoices
 *
 * @author jmariani
 */
class IncomingInvoiceInterfaceFileUpload extends CAction {

    public function run() {
        $controller = $this->getController();

        // get the Model Name
        $model_class = 'IncomingInvoiceInterfaceFile';

        // create the Model
        $model = new $model_class('upload');

//        CVarDumper::dump(Yii::app()->user->checkAccess('Cfd.Upload'));
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        if (isset($_POST[$model_class])) {
            // Get a file instance
            $file = CUploadedFile::getInstance($model, 'fileName');
            // If no file was selected to upload
            if (!$file) {
                $model->addError('fileName', yii::t('app', 'Please select a file to upload.'));
            } else {
                // If the file has an upload error
                if ($file->hasError) {
                    $model->addError('fileName', yii::t('app', 'The file "{file}" cannot be uploaded.' . ' ' . $file->error, array('{file}' => $file->name)));
                } else {
                    // Find file in model by name
                    $model = IncomingInvoiceInterfaceFile::model()->find('fileName = :name', array(':name' => $file->name));
                    // If the file name was not found
                    if (!$model) {
                        // Create new file in model
                        $model = new IncomingInvoiceInterfaceFile('upload');
                        $model->fileName = $file->name;
                    }
                    $model->receptionDttm = new CDbExpression('NOW()');
                    $model->processDttm = null;
                    $model->IncomingInvoiceInterfaceFileStatus_id = IncomingInvoiceInterfaceFileStatus::model()->find('code = :code', array(':code' => IncomingInvoiceInterfaceFileStatus::PENDING))->id;
                    $model->note = null;

                    if ($model->save()) {
                        // Save file to filesystem
                        $path = IncomingInvoiceInterfaceFile::getFilePath();
                        $file->saveAs($path . DIRECTORY_SEPARATOR . $file->name);

                        // Run process command.
                        // Find command to run
                        // SystemConfig->PROCESS_INCOMING_INVOICE_FILE_CMD

                        $cmd = SystemConfig::model()->find('code = :code', array(':code' => SystemConfig::INCOMING_INVOICE_INTERFACE_FILE_CMD_PROCESSOR));
                        if (!$cmd)
                            $model->addError('fileName', yii::t('app', 'System Config code "{code}" is undefined.', array('{code}' => SystemConfig::INCOMING_INVOICE_INTERFACE_FILE_CMD_PROCESSOR)));
                        else {
                            $console = new CConsole();
                            $console->runCommand($cmd, array('"' . $path . DIRECTORY_SEPARATOR . $file->name . '"'), true);
                            $controller->redirect(array('admin'));
                        }
                    } else
                        CVarDumper::dump($model->getErrors());
                }
            }
        } else {
//            CVarDumper::dump($_POST[$model_class]);
        }

        $controller->render('upload', array('model' => $model));
//
//        if (isset($_POST[$model_class])) {
//            $model->attributes = $_POST[$model_class];
//
//            $file = CUploadedFile::getInstance($model, 'fileName');
//            if (!$file) {
//                $model->addError('fileName', yii::t('app', 'Please select a file to upload.'));
//            } else {
//                if ($file->hasError) {
//                    $model->addError('fileName', yii::t('app', 'The file "{file}" cannot be uploaded.' . ' ' . $file->error, array('{file}' => $file->name)));
//                } else {
//                    if ($model->save()) {
//                        //                            if ($model->loadFromFile($file->tempName)) {
//                        //                                $model->fileName = $file->name;
//                        //                                $model->save();
//                        $controller->redirect(array('admin', 'id' => $model->id));
//                        //                            }
//                    }
//                }
//            }
//        }
//        $controller->render('upload', array('model' => $model));
    }

}

?>
