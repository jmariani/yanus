<?php

class CfdAddressTypeController extends GxController {


	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'CfdAddressType'),
		));
	}

	public function actionCreate() {
		$model = new CfdAddressType;


		if (isset($_POST['CfdAddressType'])) {
			$model->setAttributes($_POST['CfdAddressType']);

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
		$model = $this->loadModel($id, 'CfdAddressType');


		if (isset($_POST['CfdAddressType'])) {
			$model->setAttributes($_POST['CfdAddressType']);

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
			$this->loadModel($id, 'CfdAddressType')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('CfdAddressType');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new CfdAddressType('search');
		$model->unsetAttributes();

		if (isset($_GET['CfdAddressType']))
			$model->setAttributes($_GET['CfdAddressType']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}