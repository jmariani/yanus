<?php

class CfdController extends GxController {

    public function filters() {
        return array('rights',
        );
    }

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
                    $this->redirect(array('view', 'id' => $model->id));
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
                $this->redirect(array('view', 'id' => $model->id));
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
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionAdmin() {
        $model = new Cfd('search');
        $model->unsetAttributes();
        $this->layout = 'column1';
        if (isset($_GET['Cfd']))
            $model->setAttributes($_GET['Cfd']);

        $this->render('admin', array(
            'model' => $model,
        ));
    }

}