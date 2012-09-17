<?php

class PartyIdentifierController extends GxController {

        public $defaultAction = 'admin';
	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'PartyIdentifier'),
		));
	}

	public function actionCreate() {
		$model = new PartyIdentifier;


		if (isset($_POST['PartyIdentifier'])) {
			$model->setAttributes($_POST['PartyIdentifier']);

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
		$model = $this->loadModel($id, 'PartyIdentifier');


		if (isset($_POST['PartyIdentifier'])) {
			$model->setAttributes($_POST['PartyIdentifier']);

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
			$this->loadModel($id, 'PartyIdentifier')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('PartyIdentifier');
                $dataProvider->sort->defaultOrder = PartyIdentifier::representingColumn() . ' ASC';
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new PartyIdentifier('search');
		$model->unsetAttributes();

		if (isset($_GET['PartyIdentifier']))
			$model->setAttributes($_GET['PartyIdentifier']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}