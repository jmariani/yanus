<?php

class PemexPreInvoiceController extends GxController {

    public $defaultAction = 'admin';

    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id, 'PemexPreInvoice'),
        ));
    }

    public function actionCreate() {
        $model = new PemexPreInvoice;


        if (isset($_POST['PemexPreInvoice'])) {
            $model->setAttributes($_POST['PemexPreInvoice']);

            if ($model->save()) {
                if (Yii::app()->getRequest()->getIsAjaxRequest())
                    Yii::app()->end();
                else
                    $this->redirect(array('admin', 'id' => $model->id));
            }
        }

        $this->render('create', array('model' => $model));
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id, 'PemexPreInvoice');


        if (isset($_POST['PemexPreInvoice'])) {
            $model->setAttributes($_POST['PemexPreInvoice']);

            if ($model->save()) {
                // $this->redirect(array('admin', 'id' => $model->));
                $this->redirect(array('admin'));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionDelete($id) {
        if (Yii::app()->getRequest()->getIsPostRequest()) {
            $this->loadModel($id, 'PemexPreInvoice')->delete();

            if (!Yii::app()->getRequest()->getIsAjaxRequest())
                $this->redirect(array('admin'));
        } else
            throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
    }

    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('PemexPreInvoice');
        $dataProvider->sort->defaultOrder = PemexPreInvoice::representingColumn() . ' ASC';
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionAdmin() {
        $model = new PemexPreInvoice('search');
        $model->unsetAttributes();

        if (isset($_GET['PemexPreInvoice']))
            $model->setAttributes($_GET['PemexPreInvoice']);

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function actionUpload() {
        $model = new PemexPreInvoice('upload');
        if (isset($_POST['PemexPreInvoice'])) {
            $model->setAttributes($_POST['PemexPreInvoice']);
            $file = CUploadedFile::getInstance($model, 'pemexPreInvoiceFile');
            $model->fileName = $file->name;
            if ($model->loadFromFile($file->tempName))
                $this->redirect(array('admin', 'id' => $model->id));
        }

        $this->render('upload', array('model' => $model));
    }

}