<?php

// class CurrencyController extends GxController {
class CurrencyController extends BaseController {

    public $defaultAction = 'admin';

    public function init() {
        $this->ajaxCrudBehavior->register_Js_Css();
        parent::init();
    }

    public function behaviors() {
        return array(
            'ajaxCrudBehavior' => array('class' => 'application.behaviors.AjaxCrudBehavior',
                'modelClassName' => 'Currency',
                'form_alias_path' => 'application.views.currency._form',
                'view_alias_path' => 'application.views.currency._view',
                'pagination' => '10'      //page size for CGridView pagination
            )
        );
    }

    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id, 'Currency'),
        ));
    }

    public function actionCreate() {
        $model = new Currency;


        if (isset($_POST['Currency'])) {
            $model->setAttributes($_POST['Currency']);

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
        $model = $this->loadModel($id, 'Currency');


        if (isset($_POST['Currency'])) {
            $model->setAttributes($_POST['Currency']);

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
            $this->loadModel($id, 'Currency')->delete();

            if (!Yii::app()->getRequest()->getIsAjaxRequest())
                $this->redirect(array('admin'));
        } else
            throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
    }

    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Currency');
        $dataProvider->sort->defaultOrder = Currency::representingColumn() . ' ASC';
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionAdmin() {
        $model = new Currency('search');
        $model->unsetAttributes();

        if (isset($_GET['Currency']))
            $model->setAttributes($_GET['Currency']);

        $this->render('admin', array(
            'model' => $model,
        ));
    }

}