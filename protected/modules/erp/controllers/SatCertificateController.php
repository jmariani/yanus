<?php

class SatCertificateController extends GxController {

    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id, 'SatCertificate'),
        ));
    }

    public function actionCreate() {

        $model = new SatCertificate;

        if (isset($_POST['SatCertificate'])) {
            $file = CUploadedFile::getInstance($model, 'certificateFile');
            if ($file)
                $model->loadFromFile($file->tempName);
            $keyFile = CUploadedFile::getInstance($model, 'keyFile');
            if ($keyFile)
                $model->loadKeyFromFile($keyFile->tempName);

            $model->setAttributes($_POST['SatCertificate']);
            if ($model->validate()) {
                if ($model->save(false)) {
                    if (Yii::app()->getRequest()->getIsAjaxRequest())
                        Yii::app()->end();
                    else
                        $this->redirect(array('view', 'id' => $model->id));
                }
            }
        }
        $this->render('create', array('model' => $model));
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id, 'SatCertificate');


        if (isset($_POST['SatCertificate'])) {
            $model->setAttributes($_POST['SatCertificate']);
            $relatedData = array(
                'parties' => $_POST['SatCertificate']['parties'] === '' ? null : $_POST['SatCertificate']['parties'],
            );

            if ($model->saveWithRelated($relatedData)) {
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionDelete($id) {
        if (Yii::app()->getRequest()->getIsPostRequest()) {
            $this->loadModel($id, 'SatCertificate')->delete();

            if (!Yii::app()->getRequest()->getIsAjaxRequest())
                $this->redirect(array('admin'));
        } else
            throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
    }

    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('SatCertificate');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionAdmin() {
        $model = new SatCertificate('search');
        $model->unsetAttributes();

        if (isset($_GET['SatCertificate']))
            $model->setAttributes($_GET['SatCertificate']);

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function actionUpload() {

        $model = new SatCertificate;

        if (isset($_POST['SatCertificate'])) {
            $file = CUploadedFile::getInstance($model, 'certificateFile');
            if ($file) {
                $model->loadFromFile($file->tempName);
                $keyFile = CUploadedFile::getInstance($model, 'keyFile');
                if ($keyFile)
                    $model->loadKeyFromFile($keyFile->tempName);
                    $model->setAttributes($_POST['SatCertificate']);
                    $model->scenario = 'upload';
                    if ($model->validate()) {
                        if ($model->save(false)) {
                            if (Yii::app()->getRequest()->getIsAjaxRequest())
                                Yii::app()->end();
                            else
                                $this->redirect(array('view', 'id' => $model->id));
                        }
                    }
                else {
                    if ($keyFile->hasError)
                        $model->addError('keyFile', $keyFile->getError());
                }
            } else {
                if ($file->hasError)
                    $model->addError('certificateFile', $file->getError());
            }
        }
        $this->render('create', array('model' => $model));
    }

}