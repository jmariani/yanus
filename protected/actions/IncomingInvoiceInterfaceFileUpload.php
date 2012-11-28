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

        // Uncomment the following line if AJAX validation is needed
//         $this->performAjaxValidation($model);
        if (isset($_POST[$model_class])) {
            try {
                // Get a file instance
                $file = CUploadedFile::getInstance($model, 'fileName');
                // If no file was selected to upload
                if (!$file) {
                    $model->addError('fileName', yii::t('app', 'Please select a file to upload.'));
                } else {
                    // If the file has an upload error
                    if ($file->hasError) {
                        throw new Exception($file->error);
                    } else {
                        // Move file to filesystem
                        $path = IncomingInvoiceInterfaceFile::model()->getFilePath();
                        $fileName = $path . DIRECTORY_SEPARATOR . $file->name;
                        if (!$file->saveAs($fileName)) {
                            throw new Exception($file->error);
                        } else {
                            // Find file in model by name
                            $model = IncomingInvoiceInterfaceFile::model()->find('fileName = :name', array(':name' => $file->name));
                            // Delete if found
                            if ($model) $model->delete();
                            // Create new file in model
                            $model = new IncomingInvoiceInterfaceFile();
                            $model->fileName = $file->name;
                            $model->receptionDttm = new CDbExpression('NOW()');
                            $model->fileLocation = $fileName;
                            // Save the model
                            if ($model->save()) {
                                // Run validation command
                                $model->runValidation();
                                $controller->redirect('admin');
                            }
//                            else
//                                CVarDumper::dump($model->getErrors());
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
