<?php

class AutomobileController extends GxController {

    public $defaultAction = 'admin';
//    public $layout = '//layouts/column2left';

    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id, 'Automobile'),
        ));
    }

    public function actionCreate() {
        $model = new Automobile;


        if (isset($_POST['Automobile'])) {
            $model->setAttributes($_POST['Automobile']);

            if ($model->save()) {
                // Save Interior colors
                if (isset($_POST['interiorColor']['target'])) {
                    foreach ($_POST['exteriorColor']['target'] as $interiorColorId) {
                        $interiorColor = new AutomobileAvailableColor();
                        $interiorColor->Color_id = $interiorColorId;
                        $interiorColor->Automobile_id = $model->id;
                        $interiorColor->active = true;
                        $interiorColor->availableForInterior = true;
                        $interiorColor->save();
                    }
                }
                // Save Exterior colors
                if (isset($_POST['exteriorColor']['target'])) {
                    foreach ($_POST['exteriorColor']['target'] as $exteriorColorId) {
                        // Find if we do not already have it
                        $exteriorColor = AutomobileAvailableColor::model()->find('Automobile_id = :aid and Color_id = :cid', array(':aid' => $model->id, ':cid' => $exteriorColorId));
                        if (!$exteriorColor) {
                            $exteriorColor = new AutomobileAvailableColor();
                            $exteriorColor->Color_id = $exteriorColorId;
                            $exteriorColor->Automobile_id = $model->id;
                        }
                        $exteriorColor->active = true;
                        $exteriorColor->availableForExterior = true;
                        $exteriorColor->save();
                    }
                }

                if (Yii::app()->getRequest()->getIsAjaxRequest())
                    Yii::app()->end();
                else
                    $this->redirect(array('admin', 'id' => $model->id));
            }
        }

        $this->render('create', array('model' => $model));
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id, 'Automobile');


        if (isset($_POST['Automobile'])) {
            $model->setAttributes($_POST['Automobile']);

            if ($model->save()) {
                // Save Interior colors
                if (isset($_POST['interiorColor']['source'])) {
                    if (count($_POST['interiorColor']['source']) != 0) {
                        // Get list of excluded sources
                        $excluded = implode(',', $_POST['interiorColor']['source']);
                        $criteria = new CDbCriteria();
                        $criteria->compare('Automobile_id', $id);
                        $criteria->addInCondition('Color_id', $_POST['interiorColor']['source']);
                        $colors = AutomobileAvailableColor::model()->findAll($criteria);

                        foreach ($colors as $color) {
                            error_log('Color id ' . $color->id);
                            $color->availableForInterior = 0;
                            if (!$color->save()) CVarDumper::dump ($color->getErrors());
                        }
                    }
                }
                if (isset($_POST['interiorColor']['target'])) {
                    foreach ($_POST['interiorColor']['target'] as $colorId) {
                        // Find if we do not already have it
                        $color = AutomobileAvailableColor::model()->find('Automobile_id = :aid and Color_id = :cid', array(':aid' => $id, ':cid' => $colorId));
                        if (!$color) {
                            $color = new AutomobileAvailableColor();
                            $color->Color_id = $colorId;
                            $color->Automobile_id = $model->id;
                        }
                        $color->availableForInterior = true;
                        $color->save();
                    }
                }
                // Save Exterior colors
                if (isset($_POST['exteriorColor']['source'])) {
                    if (count($_POST['exteriorColor']['source']) != 0) {
                        // Get list of excluded sources
                        $excluded = implode(',', $_POST['exteriorColor']['source']);

                        $criteria = new CDbCriteria();
                        $criteria->compare('Automobile_id', $id);
                        $criteria->addInCondition('Color_id', $_POST['exteriorColor']['source']);

                        $colors = AutomobileAvailableColor::model()
                                ->findAll($criteria);
                        foreach ($colors as $color) {
                            $color->availableForExterior= 0;
                            $color->save();
                        }
                    }
                }
                if (isset($_POST['exteriorColor']['target'])) {
                    foreach ($_POST['exteriorColor']['target'] as $colorId) {
                        // Find if we do not already have it
                        $color = AutomobileAvailableColor::model()->find('Automobile_id = :aid and Color_id = :cid', array(':aid' => $id, ':cid' => $colorId));
                        if (!$color) {
                            $color = new AutomobileAvailableColor();
                            $color->Color_id = $colorId;
                            $color->Automobile_id = $model->id;
                        }
                        $color->availableForExterior = true;
                        $color->save();
                    }
                }
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
            $this->loadModel($id, 'Automobile')->delete();

            if (!Yii::app()->getRequest()->getIsAjaxRequest())
                $this->redirect(array('admin'));
        } else
            throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
    }

    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Automobile');
        $dataProvider->sort->defaultOrder = Automobile::representingColumn() . ' ASC';
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionAdmin() {
        $model = new Automobile('search');
        $model->unsetAttributes();

        if (isset($_GET['Automobile']))
            $model->setAttributes($_GET['Automobile']);

        $this->render('admin', array(
            'model' => $model,
        ));
    }
}