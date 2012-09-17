<?php

class GearboxTransmissionController extends GxController {

        public $defaultAction = 'admin';
	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'GearboxTransmission'),
		));
	}

	public function actionCreate() {
		$model = new GearboxTransmission;


		if (isset($_POST['GearboxTransmission'])) {
			$model->setAttributes($_POST['GearboxTransmission']);

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
		$model = $this->loadModel($id, 'GearboxTransmission');


		if (isset($_POST['GearboxTransmission'])) {
			$model->setAttributes($_POST['GearboxTransmission']);

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
			$this->loadModel($id, 'GearboxTransmission')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('GearboxTransmission');
                $dataProvider->sort->defaultOrder = GearboxTransmission::representingColumn() . ' ASC';
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new GearboxTransmission('search');
		$model->unsetAttributes();

		if (isset($_GET['GearboxTransmission']))
			$model->setAttributes($_GET['GearboxTransmission']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}