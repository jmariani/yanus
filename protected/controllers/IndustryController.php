<?php

class IndustryController extends GxController {

        public $defaultAction = 'admin';
	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'Industry'),
		));
	}

	public function actionCreate() {
		$model = new Industry;


		if (isset($_POST['Industry'])) {
			$model->setAttributes($_POST['Industry']);

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
		$model = $this->loadModel($id, 'Industry');


		if (isset($_POST['Industry'])) {
			$model->setAttributes($_POST['Industry']);

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
			$this->loadModel($id, 'Industry')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('Industry');
                $dataProvider->sort->defaultOrder = Industry::representingColumn() . ' ASC';
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new Industry('search');
		$model->unsetAttributes();

		if (isset($_GET['Industry']))
			$model->setAttributes($_GET['Industry']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}