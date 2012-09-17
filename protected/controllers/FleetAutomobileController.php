<?php

class FleetAutomobileController extends GxController {

    public $defaultAction = 'admin';

    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id, 'FleetAutomobile'),
        ));
    }

    public function actionCreate() {
        $model = new FleetAutomobile;


        if (isset($_POST['FleetAutomobile'])) {
            $model->setAttributes($_POST['FleetAutomobile']);

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
        $model = $this->loadModel($id, 'FleetAutomobile');


        if (isset($_POST['FleetAutomobile'])) {
            $model->setAttributes($_POST['FleetAutomobile']);

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
            $this->loadModel($id, 'FleetAutomobile')->delete();

            if (!Yii::app()->getRequest()->getIsAjaxRequest())
                $this->redirect(array('admin'));
        } else
            throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
    }

    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('FleetAutomobile');
        $dataProvider->sort->defaultOrder = FleetAutomobile::representingColumn() . ' ASC';
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionAdmin() {
        $model = new FleetAutomobile('search');
        $model->unsetAttributes();

        if (isset($_GET['FleetAutomobile']))
            $model->setAttributes($_GET['FleetAutomobile']);

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function actionexteriorColorsDropDown() {
        $data = Automobile::listAvailableExteriorColor($_POST['automobileId']);
//        Location::model()->findAll('parent_id=:parent_id', array(':parent_id' => (int) $_POST['Current-Controller']['country_id']));

        $data = CHtml::listData($data, 'id', 'color.name');
        foreach ($data as $value => $name) {
            echo CHtml::tag('option', array('value' => $value), CHtml::encode($name), true);
        }
    }

}