<?php

class EngineTypeController extends GxController {

        public $defaultAction = 'admin';
	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'EngineType'),
		));
	}

	public function actionCreate() {
		$model = new EngineType;


		if (isset($_POST['EngineType'])) {
			$model->setAttributes($_POST['EngineType']);

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
		$model = $this->loadModel($id, 'EngineType');


		if (isset($_POST['EngineType'])) {
			$model->setAttributes($_POST['EngineType']);

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
			$this->loadModel($id, 'EngineType')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('EngineType');
                $dataProvider->sort->defaultOrder = EngineType::representingColumn() . ' ASC';
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new EngineType('search');
		$model->unsetAttributes();

		if (isset($_GET['EngineType']))
			$model->setAttributes($_GET['EngineType']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}