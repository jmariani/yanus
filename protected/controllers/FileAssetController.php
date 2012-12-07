<?php

class FileAssetController extends GxController {

        public $defaultAction = 'admin';
	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'FileAsset'),
		));
	}

	public function actionCreate() {
		$model = new FileAsset;


		if (isset($_POST['FileAsset'])) {
			$model->setAttributes($_POST['FileAsset']);

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
		$model = $this->loadModel($id, 'FileAsset');


		if (isset($_POST['FileAsset'])) {
			$model->setAttributes($_POST['FileAsset']);

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
			$this->loadModel($id, 'FileAsset')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('FileAsset');
                $dataProvider->sort->defaultOrder = FileAsset::representingColumn() . ' ASC';
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new FileAsset('search');
		$model->unsetAttributes();

		if (isset($_GET['FileAsset']))
			$model->setAttributes($_GET['FileAsset']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}