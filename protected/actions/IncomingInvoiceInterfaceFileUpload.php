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
        $model = new $model_class();

//        CVarDumper::dump(Yii::app()->user->checkAccess('Cfd.Upload'));
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        if (isset($_POST[$model_class])) {
            try {
                // Get a file instance
                $cfile = yii::app()->file->set('fileName');
                $file = CUploadedFile::getInstance($model, 'fileName');
                // If no file was selected to upload
                if (!$file) {
                    $model->addError('fileName', yii::t('app', 'Please select a file to upload.'));
                } else {
                    // If the file has an upload error
                    if ($file->hasError) {
                        throw new Exception($file->error);
//                        $model->addError('fileName', yii::t('app', 'The file "{file}" cannot be uploaded.' . ' ' . $file->error, array('{file}' => $file->name)));
                    } else {
                        // Move file to filesystem
                        $path = SystemConfig::getValue(SystemConfig::INCOMING_INVOICE_INTERFACE_FILE_PATH);
                        if (!$file->saveAs($path . DIRECTORY_SEPARATOR . $file->name)) {
                            throw new Exception($file->error);
//                            $model->addError('fileName', yii::t('app', 'Error uploading file "{file}".' . ' ' . $file->error, array('{file}' => $file->name)));
                        } else {
                            // Find file in model by name
                            $model = IncomingInvoiceInterfaceFile::model()->find('fileName = :name', array(':name' => $file->name));
                            // Delete if found
                            if ($model) $model->delete();
                            // Create new file in model
                            $model = new IncomingInvoiceInterfaceFile();
                            $model->fileName = $file->name;
                            $model->receptionDttm = new CDbExpression('NOW()');
                            $model->validationDttm = null;
                            $model->processDttm = null;
                            $model->note = null;
                            $model->fileLocation = $path . DIRECTORY_SEPARATOR . $file->name;
                            // Save the model
                            if ($model->save()) {
                                // Run validation command
                                $model->runValidation();
                                $controller->redirect('admin');

//                                // Validate
//                                if ($model->save()) {
//                                    $model->scenario = IncomingInvoiceInterfaceFile::SCENARIO_PROCESS;
//                                    if ($model->save()) $controller->redirect('admin');
//                                    else $model->delete();
//                                } else $model->delete();
                            } else
                                CVarDumper::dump($model->getErrors());
                        }
                    }
                }
            } catch (Exception $e) {
                $model->addError('id', yii::t('app', 'Error uploading file "{file}"', array('{file}' => $file->name)) . ': ' . $e->getMessage());
            }
        }
        $controller->render('upload', array('model' => $model));
    }
}

?>
