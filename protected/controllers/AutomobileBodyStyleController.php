<?php

class AutomobileBodyStyleController extends GxController {

        public $defaultAction = 'admin';
	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'AutomobileBodyStyle'),
		));
	}

	public function actionCreate() {
		$model = new AutomobileBodyStyle;


		if (isset($_POST['AutomobileBodyStyle'])) {
			$model->setAttributes($_POST['AutomobileBodyStyle']);

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
		$model = $this->loadModel($id, 'AutomobileBodyStyle');


		if (isset($_POST['AutomobileBodyStyle'])) {
			$model->setAttributes($_POST['AutomobileBodyStyle']);

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
			$this->loadModel($id, 'AutomobileBodyStyle')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('AutomobileBodyStyle');
                $dataProvider->sort->defaultOrder = AutomobileBodyStyle::representingColumn() . ' ASC';
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new AutomobileBodyStyle('search');
		$model->unsetAttributes();

		if (isset($_GET['AutomobileBodyStyle']))
			$model->setAttributes($_GET['AutomobileBodyStyle']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}