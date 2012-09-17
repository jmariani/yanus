<?php

class AutomobileTrimController extends GxController {

        public $defaultAction = 'admin';
	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'AutomobileTrim'),
		));
	}

	public function actionCreate() {
		$model = new AutomobileTrim;


		if (isset($_POST['AutomobileTrim'])) {
			$model->setAttributes($_POST['AutomobileTrim']);

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
		$model = $this->loadModel($id, 'AutomobileTrim');


		if (isset($_POST['AutomobileTrim'])) {
			$model->setAttributes($_POST['AutomobileTrim']);

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
			$this->loadModel($id, 'AutomobileTrim')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('AutomobileTrim',
                        array(
                            'criteria' => array(
                                'with' => array('automobileModel', 'automobileModel.automobileMaker'),
                                'order' => 'automobileMaker.name, automobileModel.name'
                            )
                        ));
//                $dataProvider->sort->defaultOrder = AutomobileTrim::representingColumn() . ' ASC';
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new AutomobileTrim('search');
		$model->unsetAttributes();

		if (isset($_GET['AutomobileTrim']))
			$model->setAttributes($_GET['AutomobileTrim']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}