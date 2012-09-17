<?php

class satCertificateUpload extends CAction {

    public function run() {
        $controller = $this->getController();

        // get the Model Name
        $model_class = 'SatCertificate';

        // create the Model
        $model = new $model_class('upload');

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        if (isset($_POST[$model_class])) {
            $model->attributes = $_POST[$model_class];

            $file = CUploadedFile::getInstance($model, 'certificateFile');
            if (!$file) {
                $model->addError('certificateFile', yii::t('app', 'Please select a file to upload.'));
            } else {
                if ($file->hasError) {
                    $model->addError('certificateFile', yii::t('app', 'The file "{file}" cannot be uploaded.' . ' ' . $file->error, array('{file}' => $file->name)));
                } else {
                    $model->loadFromFile($file->tempName);
                    $keyFile = CUploadedFile::getInstance($model, 'keyFile');
                    if ($keyFile)
                        $model->loadKeyFromFile($keyFile->tempName);
                    if ($model->save()) {
                        $controller->redirect(array('admin'));
                    }
                }
            }
        }

        $controller->render('upload', array('model' => $model));
    }

}

?>
