<?php

class RegisterFormController extends GxController {

    public $defaultAction = 'create';

    public function actionSuccess($id) {
        $model = $this->loadModel($id, 'RegisterForm');

        // Here we're going to send an activation mail to the newly created user.
        $mail = new YiiMailMessage();
        $mail->setTo(array($model->contactEmail => $model->contactName));
        $mail->setBcc(array(Yii::app()->params['adminEmail'] => CHtml::encode(Yii::app()->name) . ' admin'));
        $mail->setFrom(array(Yii::app()->params['noreplyEmail'] => CHtml::encode(Yii::app()->name) . ' admin'));
        $mail->setSubject(yii::t('app', 'Thank you for registering'));
        $mail->view = 'activateRegisterForm';
        $mail->setBody(array('model' => $model), 'text/html');
        yii::app()->mail->send($mail);

        $this->render('success', array(
            'model' => $model,
        ));
    }

    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id, 'RegisterForm'),
        ));
    }

    public function actionCreate() {
        $model = new RegisterForm;


        if (isset($_POST['RegisterForm'])) {
            $model->setAttributes($_POST['RegisterForm']);

            $model->scenario = 'registerwcaptcha';
            if ($model->validate()) {
                if ($model->save(false)) {
                    if (Yii::app()->getRequest()->getIsAjaxRequest())
                        Yii::app()->end();
                    else
                        $this->redirect(array('success', 'id' => $model->id));
                }
            }
        }

        $this->render('create', array('model' => $model));
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id, 'RegisterForm');


        if (isset($_POST['RegisterForm'])) {
            $model->setAttributes($_POST['RegisterForm']);

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
            $this->loadModel($id, 'RegisterForm')->delete();

            if (!Yii::app()->getRequest()->getIsAjaxRequest())
                $this->redirect(array('admin'));
        } else
            throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
    }

    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('RegisterForm');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionAdmin() {
        $model = new RegisterForm('search');
        $model->unsetAttributes();

        if (isset($_GET['RegisterForm']))
            $model->setAttributes($_GET['RegisterForm']);

        $this->render('admin', array(
            'model' => $model,
        ));
    }

}