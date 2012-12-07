<?php

class PaymentTermController extends GxController {

        public $defaultAction = 'admin';
	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'PaymentTerm'),
		));
	}

	public function actionCreate() {
		$model = new PaymentTerm;


		if (isset($_POST['PaymentTerm'])) {
			$model->setAttributes($_POST['PaymentTerm']);

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
		$model = $this->loadModel($id, 'PaymentTerm');


		if (isset($_POST['PaymentTerm'])) {
			$model->setAttributes($_POST['PaymentTerm']);

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
			$this->loadModel($id, 'PaymentTerm')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('PaymentTerm');
                $dataProvider->sort->defaultOrder = PaymentTerm::representingColumn() . ' ASC';
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new PaymentTerm('search');
		$model->unsetAttributes();

		if (isset($_GET['PaymentTerm']))
			$model->setAttributes($_GET['PaymentTerm']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}