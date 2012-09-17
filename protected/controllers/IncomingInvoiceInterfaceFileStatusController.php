<?php

class IncomingInvoiceInterfaceFileStatusController extends GxController {

        public $defaultAction = 'admin';

    public function filters() {
        return array('rights',
        );
    }

	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'IncomingInvoiceInterfaceFileStatus'),
		));
	}

	public function actionCreate() {
		$model = new IncomingInvoiceInterfaceFileStatus;


		if (isset($_POST['IncomingInvoiceInterfaceFileStatus'])) {
			$model->setAttributes($_POST['IncomingInvoiceInterfaceFileStatus']);

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
		$model = $this->loadModel($id, 'IncomingInvoiceInterfaceFileStatus');


		if (isset($_POST['IncomingInvoiceInterfaceFileStatus'])) {
			$model->setAttributes($_POST['IncomingInvoiceInterfaceFileStatus']);

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
			$this->loadModel($id, 'IncomingInvoiceInterfaceFileStatus')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('IncomingInvoiceInterfaceFileStatus');
                $dataProvider->sort->defaultOrder = IncomingInvoiceInterfaceFileStatus::representingColumn() . ' ASC';
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new IncomingInvoiceInterfaceFileStatus('search');
		$model->unsetAttributes();

		if (isset($_GET['IncomingInvoiceInterfaceFileStatus']))
			$model->setAttributes($_GET['IncomingInvoiceInterfaceFileStatus']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}