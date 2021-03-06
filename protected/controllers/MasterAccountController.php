<?php

class MasterAccountController extends GxController {


	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'MasterAccount'),
		));
	}

	public function actionCreate() {
		$model = new MasterAccount;


		if (isset($_POST['MasterAccount'])) {
			$model->setAttributes($_POST['MasterAccount']);

			if ($model->save()) {
				if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else
					$this->redirect(array('view', 'id' => $model->id));
			}
		}

		$this->render('create', array( 'model' => $model));
	}

	public function actionUpdate($id) {
		$model = $this->loadModel($id, 'MasterAccount');


		if (isset($_POST['MasterAccount'])) {
			$model->setAttributes($_POST['MasterAccount']);

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
			$this->loadModel($id, 'MasterAccount')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('MasterAccount');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new MasterAccount('search');
		$model->unsetAttributes();

		if (isset($_GET['MasterAccount']))
			$model->setAttributes($_GET['MasterAccount']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}