<?php

class PartyMailController extends GxController {

    public $defaultAction = 'admin';

    public function actions() {
        return array(
            'toggle' => array(
                'class' => 'ext.bootstrap.actions.TbToggleAction',
                'modelName' => 'PartyMail',
            )
        );
    }

    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id, 'PartyMail'),
        ));
    }

    public function actionCreate() {
        $model = new PartyMail;


        if (isset($_POST['PartyMail'])) {
            $model->setAttributes($_POST['PartyMail']);

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
        $model = $this->loadModel($id, 'PartyMail');


        if (isset($_POST['PartyMail'])) {
            $model->setAttributes($_POST['PartyMail']);

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
            $this->loadModel($id, 'PartyMail')->delete();

            if (!Yii::app()->getRequest()->getIsAjaxRequest())
                $this->redirect(array('admin'));
        } else
            throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
    }

    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('PartyMail');
        $dataProvider->sort->defaultOrder = PartyMail::representingColumn() . ' ASC';
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionAdmin() {
        $model = new PartyMail('search');
        $model->unsetAttributes();

        if (isset($_GET['PartyMail']))
            $model->setAttributes($_GET['PartyMail']);

        $this->render('castroladmin', array(
            'model' => $model,
        ));
    }

}