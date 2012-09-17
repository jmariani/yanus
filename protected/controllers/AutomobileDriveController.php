<?php

class AutomobileDriveController extends GxController {

        public $defaultAction = 'admin';
	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'AutomobileDrive'),
		));
	}

	public function actionCreate() {
		$model = new AutomobileDrive;


		if (isset($_POST['AutomobileDrive'])) {
			$model->setAttributes($_POST['AutomobileDrive']);

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
		$model = $this->loadModel($id, 'AutomobileDrive');


		if (isset($_POST['AutomobileDrive'])) {
			$model->setAttributes($_POST['AutomobileDrive']);

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
			$this->loadModel($id, 'AutomobileDrive')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('AutomobileDrive');
                $dataProvider->sort->defaultOrder = AutomobileDrive::representingColumn() . ' ASC';
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new AutomobileDrive('search');
		$model->unsetAttributes();

		if (isset($_GET['AutomobileDrive']))
			$model->setAttributes($_GET['AutomobileDrive']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}