<?php

class IncomingInvoiceInterfaceFileController extends GxController {

    public $defaultAction = 'admin';

    public function actions() {
        return array(
            'upload' => 'IncomingInvoiceInterfaceFileUpload',
        );
    }
    // Placeholders for Rights
    //public function actionUpload() {

    public function filters() {
        return array('rights',
        );
    }

    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id, 'IncomingInvoiceInterfaceFile'),
        ));
    }

    public function actionCreate() {
        $model = new IncomingInvoiceInterfaceFile;


        if (isset($_POST['IncomingInvoiceInterfaceFile'])) {
            $model->setAttributes($_POST['IncomingInvoiceInterfaceFile']);

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
        $model = $this->loadModel($id, 'IncomingInvoiceInterfaceFile');


        if (isset($_POST['IncomingInvoiceInterfaceFile'])) {
            $model->setAttributes($_POST['IncomingInvoiceInterfaceFile']);

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
            $this->loadModel($id, 'IncomingInvoiceInterfaceFile')->delete();

            if (!Yii::app()->getRequest()->getIsAjaxRequest())
                $this->redirect(array('admin'));
        } else
            throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
    }

    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('IncomingInvoiceInterfaceFile');
        $dataProvider->sort->defaultOrder = IncomingInvoiceInterfaceFile::representingColumn() . ' ASC';
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionAdmin() {
        $model = new IncomingInvoiceInterfaceFile('search');
        $model->unsetAttributes();

        if (isset($_GET['IncomingInvoiceInterfaceFile']))
            $model->setAttributes($_GET['IncomingInvoiceInterfaceFile']);

        $this->render('admin', array(
            'model' => $model,
        ));
    }
}