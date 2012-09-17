<?php

class SwTestController extends GxController {

        public $defaultAction = 'admin';
	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'SwTest'),
		));
	}

	public function actionCreate() {
		$model = new SwTest;


		if (isset($_POST['SwTest'])) {
			$model->setAttributes($_POST['SwTest']);

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
		$model = $this->loadModel($id, 'SwTest');


		if (isset($_POST['SwTest'])) {
			$model->setAttributes($_POST['SwTest']);

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
			$this->loadModel($id, 'SwTest')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('SwTest');
                $dataProvider->sort->defaultOrder = SwTest::representingColumn() . ' ASC';
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new SwTest('search');
		$model->unsetAttributes();

		if (isset($_GET['SwTest']))
			$model->setAttributes($_GET['SwTest']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}