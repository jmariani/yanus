<?php

class CfdUpload extends CAction {

    public function run() {
        $controller = $this->getController();

        // get the Model Name
        $model_class = ucfirst($controller->getId());

        // create the Model
        $model = new $model_class('upload');

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        if (isset($_POST[$model_class])) {
            $model->attributes = $_POST[$model_class];

            $file = CUploadedFile::getInstance($model, 'cfdXmlFile');
            if (!$file) {
                $model->addError('cfdXmlFile', yii::t('app', 'Please select a file to upload.'));
            } else {
                if ($file->hasError) {
                    $model->addError('cfdXmlFile', yii::t('app', 'The file "{file}" cannot be uploaded.' . ' ' . $file->error, array('{file}' => $file->name)));
                } else {
                    // Check if is a proper XML
                    libxml_use_internal_errors(true);
                    $xml = @simplexml_load_file($file->tempName);
                    //                $xml = new DOMDocument();
                    //                $xml->validateOnParse = true;
                    //                $xml->load($file->tempName);
                    if (!$xml) {
                        $errors = array();
                        $errors[] = yii::t('app', 'File "{fileName}" has syntax errors:', array('{fileName}' => $file->name));
                        foreach (libxml_get_errors() as $xmlError) {
                            $errors[] = $xmlError->message . ' ' . yii::t('app', 'at line {line}', array('{line}' => $xmlError->line));
                        }
                        $model->addErrors(array('cfdXmlFile' => $errors));
                    } else {
                        // Validate CFD
                        if (!$model->validateAndMap($xml)) {
                            $modelErrors = $model->getErrors();
                            CVarDumper::dump($modelErrors);
                            array_unshift($modelErrors['cfdXmlFile'], yii::t('app', 'File "{fileName}" cannot be uploaded.', array('{fileName}' => $file->name)));
                            $model->clearErrors();
                            $model->addErrors($modelErrors);
                        } else {
                            $model->CfdStatus_id = CfdStatus::model()->find('code = :code', array(':code' => CfdStatus::VALID))->id;
                            if ($model->save()) {
                                // Move file(s) to repository
                                $processInvoiceDttm = new DateTime($model->dttm);
                                $cfdBasePath = yii::app()->getBasePath() . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'files' .
                                        DIRECTORY_SEPARATOR . 'cfd' . DIRECTORY_SEPARATOR . $model->vendorRfc . DIRECTORY_SEPARATOR .
                                        $processInvoiceDttm->format('Y') . DIRECTORY_SEPARATOR .
                                        $processInvoiceDttm->format('m') . DIRECTORY_SEPARATOR .
                                        $processInvoiceDttm->format('d') . DIRECTORY_SEPARATOR .
                                        $model->invoice;

                                // Create dir if not exists
                                if (!file_exists($cfdBasePath))
                                    mkdir($cfdBasePath, 0777, true);
                                $file->saveAs($cfdBasePath . DIRECTORY_SEPARATOR . $file->name);
                                $controller->redirect(array('admin'));
                            }
                        }
                    }
                }
            }
        }
        $controller->render('upload', array('model' => $model));
    }

}

?>
