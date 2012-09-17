<?php

class AutomobileModelController extends GxController {

        public $defaultAction = 'admin';
	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'AutomobileModel'),
		));
	}

	public function actionCreate() {
		$model = new AutomobileModel;


		if (isset($_POST['AutomobileModel'])) {
			$model->setAttributes($_POST['AutomobileModel']);

			if ($model->save()) {
				if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else
					$this->redirect(array('admin', 'id' => $model->id));
			}
		}

		$this->render('create', array( 'model' => $model));
	}

	public function actionUpdate($id) {
		$model = $this->loadModel($id, 'AutomobileModel');


		if (isset($_POST['AutomobileModel'])) {
			$model->setAttributes($_POST['AutomobileModel']);

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
			$this->loadModel($id, 'AutomobileModel')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('AutomobileModel');
                $dataProvider->sort->defaultOrder = AutomobileModel::representingColumn() . ' ASC';
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new AutomobileModel('search');
		$model->unsetAttributes();

		if (isset($_GET['AutomobileModel']))
			$model->setAttributes($_GET['AutomobileModel']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}