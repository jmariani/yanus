<?php

class CfdController extends GxController {

    public $defaultAction = 'admin';

    public function actions() {
        return array(
            'upload' => 'CfdUpload',
        );
    }
//    public function filters() {
//        return array('rights',
//        );
//    }

    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id, 'Cfd'),
        ));
    }

    public function actionCreate() {
        $model = new Cfd;


        if (isset($_POST['Cfd'])) {
            $model->setAttributes($_POST['Cfd']);
            $relatedData = array(
                'customsPermits' => $_POST['Cfd']['customsPermits'] === '' ? null : $_POST['Cfd']['customsPermits'],
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
        $model = $this->loadModel($id, 'Cfd');


        if (isset($_POST['Cfd'])) {
            $model->setAttributes($_POST['Cfd']);
            $relatedData = array(
                'customsPermits' => $_POST['Cfd']['customsPermits'] === '' ? null : $_POST['Cfd']['customsPermits'],
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
            $this->loadModel($id, 'Cfd')->delete();

            if (!Yii::app()->getRequest()->getIsAjaxRequest())
                $this->redirect(array('admin'));
        } else
            throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
    }

    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Cfd');
        $dataProvider->sort->defaultOrder = Cfd::representingColumn() . ' ASC';
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionAdmin() {
        $model = new Cfd('search');
        $model->unsetAttributes();

        if (isset($_GET['Cfd']))
            $model->setAttributes($_GET['Cfd']);

        $this->render('admin', array(
            'model' => $model,
        ));
    }
    public function actionAdminReceived() {
        $model = new Cfd('search');
        $model->unsetAttributes();

        if (isset($_GET['Cfd']))
            $model->setAttributes($_GET['Cfd']);

        $this->render('adminReceived', array(
            'model' => $model,
        ));
    }
    public function actionAdminIssued() {
        $model = new Cfd('search');
        $model->unsetAttributes();

        if (isset($_GET['Cfd']))
            $model->setAttributes($_GET['Cfd']);

        $this->render('adminIssued', array(
            'model' => $model,
        ));
    }

//    Placeholder for Rights
//    public function actionUpload() {
//    }

    public function actiondlFile($id, $type) {
        $model = Cfd::model()->findByPk($id);

        switch ($type) {
            case 'cfd':
                $file = Yii::app()->file->set($model->cfdFile->location, true);
                $file->download(pathinfo($model->cfdFile->location, PATHINFO_BASENAME));
                break;
            case 'pdf':
                $file = Yii::app()->file->set($model->pdfFile->location, true);
                $file->download($model->pdfFile->name);
                break;
            default:
                throw new CHttpException(404, yii::t('app', 'File type "{type}" not found.', array('{type}' => $type)));
        }
    }

}