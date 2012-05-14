<?php

class RegisterFormController extends GxController {

    public $defaultAction = 'create';

    public function actionActivate() {
        try {
            if (!isset($_GET['activateKey'])) throw new Exception(yii::t('app', 'Invalid activation key'));
            $activationKey = $_GET['activateKey'];
            if (!$activationKey) throw new Exception(yii::t('app', 'Invalid activation key'));
            $model = RegisterForm::model()->findByAttributes(array('activationKey' => $activationKey));
            if (!$model) throw new Exception(yii::t('app', 'Invalid activation key'));
            if (!$model->swIsInitialStatus()) throw new Exception(yii::t('app', 'Invalid activation key'));

            $this->redirect(array('finalize', 'id' => $model->id));

        } catch (Exception$e) {
            Yii::app()->user->setFlash('error', $e->getMessage());
            $this->render('/registerForm/message', array('title' => yii::t('app', 'Account activation')));
        }
    }

    public function actionFinalize($id) {
        $model = $this->loadModel($id, 'RegisterForm');

        Yii::app()->user->setFlash('info', yii::t('app', 'Please fill in the required information') . '<br/>' .
	'<p class="note">' . Yii::t('app', 'Fields with') . ' <span class="required">*</span> ' . Yii::t('app', 'are required') . '</p>');
        if (isset($_POST['RegisterForm'])) {
            $model->scenario = 'finalize';
            $model->setAttributes($_POST['RegisterForm']);
            $model->status = 'activated';
            if ($model->save()) {
                // Create user and other stuff...
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('finalize', array('model' => $model,));
    }

    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id, 'RegisterForm'),
        ));
    }

    public function actionCreate() {
        $model = new RegisterForm;

        Yii::app()->user->setFlash('info', yii::t('app', 'Please fill in the required information') . '<br/>' .
	'<p class="note">' . Yii::t('app', 'Fields with') . ' <span class="required">*</span> ' . Yii::t('app', 'are required') . '</p>');

        if (isset($_POST['RegisterForm'])) {
            $model->setAttributes($_POST['RegisterForm']);

            $model->scenario = 'registerwcaptcha';
            if ($model->save()) {
                if (Yii::app()->getRequest()->getIsAjaxRequest())
                    Yii::app()->end();
                $this->render('success');
            } else {
                $this->render('create', array('model' => $model));
            }
        } else {
            $this->render('create', array('model' => $model));
        }
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