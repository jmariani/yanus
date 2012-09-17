<?php

class AutomobileAvailableColorController extends GxController {

    public $defaultAction = 'admin';

    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id, 'AutomobileAvailableColor'),
        ));
    }

    public function actionCreate() {
        $model = new AutomobileAvailableColor;


        if (isset($_POST['AutomobileAvailableColor'])) {
            $model->setAttributes($_POST['AutomobileAvailableColor']);

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
        $model = $this->loadModel($id, 'AutomobileAvailableColor');


        if (isset($_POST['AutomobileAvailableColor'])) {
            $model->setAttributes($_POST['AutomobileAvailableColor']);

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
            $this->loadModel($id, 'AutomobileAvailableColor')->delete();

            if (!Yii::app()->getRequest()->getIsAjaxRequest())
                $this->redirect(array('admin'));
        } else
            throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
    }

    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('AutomobileAvailableColor');
        $dataProvider->sort->defaultOrder = AutomobileAvailableColor::representingColumn() . ' ASC';
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionAdmin() {
        $model = new AutomobileAvailableColor('search');
        $model->unsetAttributes();

        if (isset($_GET['AutomobileAvailableColor']))
            $model->setAttributes($_GET['AutomobileAvailableColor']);

        $this->render('admin', array(
            'model' => $model,
        ));
    }

}