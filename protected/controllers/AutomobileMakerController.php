<?php

class AutomobileMakerController extends GxController {

        public $defaultAction = 'admin';
	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'AutomobileMaker'),
		));
	}

	public function actionCreate() {
		$model = new AutomobileMaker;


		if (isset($_POST['AutomobileMaker'])) {
			$model->setAttributes($_POST['AutomobileMaker']);

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
		$model = $this->loadModel($id, 'AutomobileMaker');


		if (isset($_POST['AutomobileMaker'])) {
			$model->setAttributes($_POST['AutomobileMaker']);

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
			$this->loadModel($id, 'AutomobileMaker')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('AutomobileMaker');
                $dataProvider->sort->defaultOrder = AutomobileMaker::representingColumn() . ' ASC';
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new AutomobileMaker('search');
		$model->unsetAttributes();

		if (isset($_GET['AutomobileMaker']))
			$model->setAttributes($_GET['AutomobileMaker']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}