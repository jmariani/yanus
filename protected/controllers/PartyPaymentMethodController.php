<?php

class PartyPaymentMethodController extends GxController {

        public $defaultAction = 'admin';
	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'PartyPaymentMethod'),
		));
	}

	public function actionCreate() {
		$model = new PartyPaymentMethod;


		if (isset($_POST['PartyPaymentMethod'])) {
			$model->setAttributes($_POST['PartyPaymentMethod']);

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
		$model = $this->loadModel($id, 'PartyPaymentMethod');


		if (isset($_POST['PartyPaymentMethod'])) {
			$model->setAttributes($_POST['PartyPaymentMethod']);

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
			$this->loadModel($id, 'PartyPaymentMethod')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('PartyPaymentMethod');
                $dataProvider->sort->defaultOrder = PartyPaymentMethod::representingColumn() . ' ASC';
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new PartyPaymentMethod('search');
		$model->unsetAttributes();

		if (isset($_GET['PartyPaymentMethod']))
			$model->setAttributes($_GET['PartyPaymentMethod']);

        $this->render('castroladmin', array(
			'model' => $model,
		));
	}

}