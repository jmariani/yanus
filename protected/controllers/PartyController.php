<?php

class PartyController extends GxController {

    public $defaultAction = 'admin';

    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id, 'Party'),
        ));
    }

    public function actionCreate() {
        $model = new Party;


        if (isset($_POST['Party'])) {
            $model->setAttributes($_POST['Party']);
//			$relatedData = array(
//				'satCertificates' => $_POST['Party']['satCertificates'] === '' ? null : $_POST['Party']['satCertificates'],
//				);
//			if ($model->saveWithRelated($relatedData)) {
            if ($model->save()) {
                if (Yii::app()->getRequest()->getIsAjaxRequest())
                    Yii::app()->end();
                else
                    $this->redirect(array('admin', 'id' => $model->id));
            }
        }

        $this->render('create', array('model' => $model));
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id, 'Party');


        if (isset($_POST['Party'])) {
            $model->setAttributes($_POST['Party']);
            if (isset($_POST['Party']['rfc'])) {
                if (isset($model->currentRfc->value)) {
                    if ($model->rfc != $model->currentRfc->value) {
                        // Create new identifiear
                        $this->createNewIdentifier($model, PartyIdentifier::RFC, $model->rfc);
                    }
                } else {
                    // Create new RFC identifier
                    $this->createNewIdentifier($model, PartyIdentifier::RFC, $model->rfc);
                }
            }
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
            $this->loadModel($id, 'Party')->delete();

            if (!Yii::app()->getRequest()->getIsAjaxRequest())
                $this->redirect(array('admin'));
        } else
            throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
    }

    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Party');
        $dataProvider->sort->defaultOrder = Party::representingColumn() . ' ASC';
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionAdmin() {
        $model = new Party('search');
        $model->unsetAttributes();

        if (isset($_GET['Party']))
            $model->setAttributes($_GET['Party']);

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function actionAdminCompany() {
        $model = new Party('search');
        $model->unsetAttributes();

        if (isset($_GET['Party']))
            $model->setAttributes($_GET['Party']);

        $model->person = false;
//        $this->render('adminCompany', array('model' => $model,));
        $this->render('adminCompany', array('model' => $model,));
    }

    public function actionCreateCompany() {
        $model = new Party('createCompany');
        if (isset($_POST['Party'])) {
            $model->setAttributes($_POST['Party']);
            $model->name = mb_convert_case($model->companyName, MB_CASE_UPPER);
            $model->person = false;
            if ($model->save()) {
                // Create NAME
                $partyName = new PartyName();
                $partyName->Party_id = $model->id;
                $partyName->surName = $model->name;
                if (!$partyName->save())
                    print_r($partyName->getErrors());
                // CREATE IDENTIFIER
                $partyIdentifier = new PartyIdentifier();
                $partyIdentifier->Party_id = $model->id;
                $partyIdentifier->name = 'RFC';
                $partyIdentifier->value = $model->rfc;
                $partyIdentifier->save();
                if (Yii::app()->getRequest()->getIsAjaxRequest())
                    Yii::app()->end();
                else
                    $this->redirect(array('admin'));
            }
        }

        $this->render('createCompany', array('model' => $model));
    }

    public function actionAdminCustomers() {
        $model = new Party('search');
        $model->unsetAttributes();

        if (isset($_GET['Party']))
            $model->setAttributes($_GET['Party']);

//        $this->render('adminCompany', array('model' => $model,));
        $this->render('adminCustomers', array('model' => $model,));
    }

    public function actionCreateCustomer() {
        $model = new Party('createCompany');
        if (isset($_POST['Party'])) {
            $model->setAttributes($_POST['Party']);
            $model->name = mb_convert_case($model->companyName, MB_CASE_UPPER);
            $model->person = false;
            if ($model->save()) {
                // Create NAME
                $partyName = new PartyName();
                $partyName->Party_id = $model->id;
                $partyName->surName = $model->name;
                if (!$partyName->save())
                    print_r($partyName->getErrors());
                // CREATE IDENTIFIER
                $partyIdentifier = new PartyIdentifier();
                $partyIdentifier->Party_id = $model->id;
                $partyIdentifier->name = 'RFC';
                $partyIdentifier->value = $model->rfc;
                $partyIdentifier->save();
                if (Yii::app()->getRequest()->getIsAjaxRequest())
                    Yii::app()->end();
                else
                    $this->redirect(array('admin'));
            }
        }

        $this->render('createCompany', array('model' => $model));
    }

    public function actionAdminPerson() {
        $model = new Party('search');
        $model->unsetAttributes();

        if (isset($_GET['Party']))
            $model->setAttributes($_GET['Party']);

        $model->person = true;
        $this->render('admin', array('model' => $model,));
//        $this->render('adminPerson', array('model' => $model,));
    }

    public function actionCreatePerson() {
        $model = new Party('createPerson');
        if (isset($_POST['Party'])) {
            $model->setAttributes($_POST['Party']);
            $model->name = mb_convert_case(trim($model->personSurName . ' ' . $model->personMotherFamilyName) . ', ' . trim($model->personFirstName . ' ' . $model->personSecondName), MB_CASE_UPPER);
            $model->person = true;
            if ($model->save()) {
                $partyName = new PartyName();
                $partyName->Party_id = $model->id;
                $partyName->firstName = $model->personFirstName;
                $partyName->secondName = $model->personSecondName;
                $partyName->surName = $model->personSurName;
                $partyName->motherFamilyName = $model->personMotherFamilyName;
                if (!$partyName->save())
                    print_r($partyName->getErrors());
                if (Yii::app()->getRequest()->getIsAjaxRequest())
                    Yii::app()->end();
                else
                    $this->redirect(array('adminPerson'));
            }
        }

        $this->render('createPerson', array('model' => $model));
    }

    public function loadModel($key, $modelClass) {
        $model = Party::model()->with(array(
                    'currentName' => array('together' => true),
                    'currentRfc' => array('together' => true)
                ))->findByPk($key);
//        CVarDumper::dump($model);
        if ($model->person) {
            $model->personFirstName = $model->currentName->firstName;
            $model->personSecondName = $model->currentName->secondName;
            $model->personSurName = $model->currentName->surName;
            $model->personMotherFamilyName = $model->currentName->motherFamilyName;
        } else {
            $model->companyName = $model->currentName->surName;
            $model->rfc = (isset($model->currentRfc->value) ? $model->currentRfc->value : '');
        }
        return $model;
    }

    private function createNewIdentifier($model, $identifierName, $identifierValue) {
        // Insert new RFC
        $partyIdentifier = new PartyIdentifier();
        $partyIdentifier->Party_id = $model->id;
        $partyIdentifier->name = $identifierName;
        $partyIdentifier->value = $identifierValue;
        if (!$partyIdentifier->save()) $model->addErrors($partyIdentifier->getErrors ());
    }

}