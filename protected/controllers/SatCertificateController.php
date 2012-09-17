<?php

class SatCertificateController extends GxController {

    public $defaultAction = 'admin';

    public function actions() {
        return array(
            'upload' => 'SatCertificateUpload',
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
            'model' => $this->loadModel($id, 'SatCertificate'),
        ));
    }

    public function actionCreate() {
        $model = new SatCertificate;


        if (isset($_POST['SatCertificate'])) {
            $model->setAttributes($_POST['SatCertificate']);
            $relatedData = array(
                'parties' => $_POST['SatCertificate']['parties'] === '' ? null : $_POST['SatCertificate']['parties'],
            );

            if ($model->saveWithRelated($relatedData)) {
                if (Yii::app()->getRequest()->getIsAjaxRequest())
                    Yii::app()->end();
                else
                    $this->redirect(array('admin', 'id' => $model->id));
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
            $this->loadModel($id, 'SatCertificate')->delete();

            if (!Yii::app()->getRequest()->getIsAjaxRequest())
                $this->redirect(array('admin'));
        } else
            throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
    }

    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('SatCertificate');
        $dataProvider->sort->defaultOrder = SatCertificate::representingColumn() . ' ASC';
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

}