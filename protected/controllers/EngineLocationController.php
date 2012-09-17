<?php

class EngineLocationController extends GxController {

        public $defaultAction = 'admin';
	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'EngineLocation'),
		));
	}

	public function actionCreate() {
		$model = new EngineLocation;


		if (isset($_POST['EngineLocation'])) {
			$model->setAttributes($_POST['EngineLocation']);

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
		$model = $this->loadModel($id, 'EngineLocation');


		if (isset($_POST['EngineLocation'])) {
			$model->setAttributes($_POST['EngineLocation']);

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
			$this->loadModel($id, 'EngineLocation')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('EngineLocation');
                $dataProvider->sort->defaultOrder = EngineLocation::representingColumn() . ' ASC';
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new EngineLocation('search');
		$model->unsetAttributes();

		if (isset($_GET['EngineLocation']))
			$model->setAttributes($_GET['EngineLocation']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}