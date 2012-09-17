<?php

class SeatCoverController extends GxController {

        public $defaultAction = 'admin';
	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'SeatCover'),
		));
	}

	public function actionCreate() {
		$model = new SeatCover;


		if (isset($_POST['SeatCover'])) {
			$model->setAttributes($_POST['SeatCover']);

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
		$model = $this->loadModel($id, 'SeatCover');


		if (isset($_POST['SeatCover'])) {
			$model->setAttributes($_POST['SeatCover']);

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
			$this->loadModel($id, 'SeatCover')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('SeatCover');
                $dataProvider->sort->defaultOrder = SeatCover::representingColumn() . ' ASC';
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new SeatCover('search');
		$model->unsetAttributes();

		if (isset($_GET['SeatCover']))
			$model->setAttributes($_GET['SeatCover']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}