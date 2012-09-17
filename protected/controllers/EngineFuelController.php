<?php

class EngineFuelController extends GxController {

    public $defaultAction = 'admin';

    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id, 'EngineFuel'),
        ));
    }

    public function actionCreate() {
        $model = new EngineFuel;


        if (isset($_POST['EngineFuel'])) {
            $model->setAttributes($_POST['EngineFuel']);

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
        $model = $this->loadModel($id, 'EngineFuel');


        if (isset($_POST['EngineFuel'])) {
            $model->setAttributes($_POST['EngineFuel']);

            if ($model->save()) {
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionDelete($id) {
        if (Yii::app()->getRequest()->getIsPostRequest()) {
            $this->loadModel($id, 'EngineFuel')->delete();

            if (!Yii::app()->getRequest()->getIsAjaxRequest())
                $this->redirect(array('admin'));
        } else
            throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
    }

    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('EngineFuel');
        $dataProvider->sort->defaultOrder = EngineFuel::representingColumn() . ' ASC';
        $this->render('index', array(
            'dataProvider' => $dataProvider,
            'sortableAttributes' => array(
                'name'
            )
        ));
    }

    public function actionAdmin() {
        $model = new EngineFuel('search');
        $model->unsetAttributes();

        if (isset($_GET['EngineFuel']))
            $model->setAttributes($_GET['EngineFuel']);

        $this->render('admin', array(
            'model' => $model,
        ));
    }

}