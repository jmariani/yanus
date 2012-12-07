<?php

class CustomsPermitController extends GxController {

    public $defaultAction = 'admin';

    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id, 'CustomsPermit'),
        ));
    }

    public function actionCreate() {
        $model = new CustomsPermit;

        if (isset($_POST['CustomsPermit'])) {
//            CVarDumper::dump($_POST['CustomsPermit']);
            $model->setAttributes($_POST['CustomsPermit']);
            if ($model->save()) {
                if (Yii::app()->getRequest()->getIsAjaxRequest())
                    Yii::app()->end();
                else
                    $this->redirect(array('admin'));
            }
        }

        $this->render('create', array('model' => $model));
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id, 'CustomsPermit');


        if (isset($_POST['CustomsPermit'])) {
            $model->setAttributes($_POST['CustomsPermit']);
            if ($model->save()) {
                // $this->redirect(array('admin', 'id' => $model->));
                $this->redirect(array('admin'));
            }
        }

        $this->render('update', array('model' => $model,));
    }

    public function actionDelete($id) {
        if (Yii::app()->getRequest()->getIsPostRequest()) {
            $this->loadModel($id, 'CustomsPermit')->delete();

            if (!Yii::app()->getRequest()->getIsAjaxRequest())
                $this->redirect(array('admin'));
        } else
            throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
    }

    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('CustomsPermit');
        $dataProvider->sort->defaultOrder = CustomsPermit::representingColumn() . ' ASC';
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionAdmin() {
        $model = new CustomsPermit('search');
        $model->unsetAttributes();

        if (isset($_GET['CustomsPermit']))
            $model->setAttributes($_GET['CustomsPermit']);

        $this->render('admin', array(
            'model' => $model,
        ));
    }

}