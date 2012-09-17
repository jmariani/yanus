<?php

Yii::import('application.models._base.BaseParty');

class Party extends BaseParty {

    private $_name;
    private $_rfc;
    private $_partyIdentifiers = array(); // Array of IDENTIFIER_NAME => VALUE
    public $identifiers = array(); // Array of PartyIdentifier->name => PartyIdentifier->value

    public $customerCode;

    public $firstName;
    public $secondName;
    public $surName;
    public $motherFamilyName;
    public $defaultNameTemplate = '{personFirstName} {personSecondName} {personSurName} {motherName}';
    private $_pendingAttributes = array();

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function attributeLabels() {
        $attributeLabels = parent::attributeLabels();
        $attributeLabels['customerCode'] = yii::t('app', 'Customer Code');
        $attributeLabels['name'] = yii::t('app', 'Name');
        $attributeLabels['personFirstName'] = yii::t('app', 'First Name');
        $attributeLabels['personSecondName'] = yii::t('app', 'Second Name');
        $attributeLabels['personSurName'] = yii::t('app', 'Surname');
        $attributeLabels['personMotherFamilyName'] = yii::t('app', 'Mother Family Name');
        $attributeLabels['rfc'] = yii::t('app', 'RFC');
        return $attributeLabels;
    }

    public function afterFind() {
//        if ($this->Name) {
//            $this->name = $this->Name->fullName;
//            $this->firstName = $this->Name->firstName;
//            $this->secondName = $this->Name->secondName;
//            $this->surName = $this->Name->surName;
//            $this->motherFamilyName = $this->Name->motherFamilyName;
//        }
//        if ($this->Rfc)
//            $this->rfc = $this->Rfc->value;
//        if ($this->CustomerCode)
//            $this->customerCode = $this->CustomerCode->value;
        foreach ($this->partyIdentifiers as $partyIdentifier) {
            $this->identifiers[$partyIdentifier->name] = $partyIdentifier->value;
        }
        return parent::afterFind();
    }

    public function afterSave() {
        if ($this->isNewRecord) {
            // Create name
            $this->createName();
            // Save Identifiers
        } else {
            // Update name
            if ($this->Name && ($this->_name != $this->Name->fullName)) $this->createName();
        }
        // Update / create identifiers
        $this->createIdentifiers();
        return parent::afterSave();
    }

    private function createCustomerCode($customerCode) {
        // Create CustomerCode
        $partyCustomerCode = new PartyIdentifier();
        $partyCustomerCode->Party_id = $this->id;
        $partyCustomerCode->name = PartyIdentifier::CUSTOMER_CODE;
        $partyCustomerCode->value = $customerCode;
        $partyCustomerCode->save();
    }

    private function createIdentifiers(){
        foreach ($this->identifiers as $key => $value) {
            $partyIdentifier = false;
            // If this is a new record do not test if it already exists.
            if (!$this->isNewRecord)
                $partyIdentifier = PartyIdentifier::model()->current()->find('name = :name and value = :value and Party_id = :id',
                        array(':name' => $key, ':value' => $value, ':id' => $this->id));
            if (!$partyIdentifier) {
                $partyIdentifier = new PartyIdentifier();
                $partyIdentifier->name = $key;
                $partyIdentifier->value = $value;
                $partyIdentifier->Party_id = $this->id;
                $partyIdentifier->save();
            } else {
                // Test if is changed
                if ($partyIdentifier->value != $value) {
                    $partyIdentifier = new PartyIdentifier();
                    $partyIdentifier->name = $key;
                    $partyIdentifier->value = $value;
                    $partyIdentifier->Party_id = $this->id;
                    $partyIdentifier->save();
                }
            }
        }
    }
    private function createName() {
        if ($this->_name) {
            $partyName = new PartyName();
            $partyName->Party_id = $this->id;
            $partyName->fullName = $this->name;
            $partyName->save();
        }
    }

    private function createRfc($rfc) {
        // Create RFC
        $partyRfc = new PartyIdentifier();
        $partyRfc->Party_id = $this->id;
        $partyRfc->name = PartyIdentifier::RFC;
        $partyRfc->value = $rfc;
        $partyRfc->save();
    }

    public static function createFromXML($xml) {

    }

//    public function defaultScope() {
//        return array('order' => $this->getTableAlias(false, false) . '.name ASC');
//    }

    public function getAttributesAssocArray() {
        $attr = array();

        $criteria = new CDbCriteria();
        $criteria->condition = 'Party_id = :id';
        $criteria->params = array(':id' => $this->id);
        $criteria->order = 'code ASC';
        $itemAttrs = PartyAttribute::model()->current()->findAll($criteria);
        foreach ($itemAttrs as $itemAttr) {
            $attr[$itemAttr->code] = $itemAttr->value;
        }
        return $attr;
    }

    // Scope functions
    public function automotiveIndustry() {
        $manufacturer = Industry::model()->find('name = :name', array(':name' => 'Automotriz'));
        $this->getDbCriteria()->mergeWith(array(
            'condition' => 'Industry_id = ' . $manufacturer->id,
        ));
        return $this;
    }

    public function relations() {
        $relations = parent::relations();
        $relations['currentAttributes'] = array(self::HAS_MANY, 'PartyAttribute', 'Party_id', 'order' => 'effDt DESC', 'limit' => '1',
            'on' => 'currentAttributes.effDt <= NOW()');

        $relations['CustomerCode'] = array(self::HAS_ONE, 'PartyIdentifier', 'Party_id', 'order' => 'CustomerCode.effDt DESC',
            'on' => 'CustomerCode.effDt <= NOW() and CustomerCode.name = "' . PartyIdentifier::CUSTOMER_CODE . '"');

        $relations['Name'] = array(self::HAS_ONE, 'PartyName', 'Party_id', 'order' => 'Name.effDt DESC',
            'on' => 'Name.effDt <= NOW()');

        $relations['Rfc'] = array(self::HAS_ONE, 'PartyIdentifier', 'Party_id', 'order' => 'Rfc.effDt DESC',
            'on' => 'Rfc.effDt <= NOW() and Rfc.name = "' . PartyIdentifier::RFC . '"');
        return $relations;
    }

    public function rules() {
        return array(
            array('person', 'boolean'),
            array('name', 'safe'),
            array('name, person', 'default', 'setOnEmpty' => true, 'value' => null),
            array('id, name, person', 'safe', 'on' => 'search'),
            array('personFirstName, personSecondName, personSurName, personMotherFamilyName', 'safe', 'on' => 'createPerson'),
            array('personFirstName, personSurName', 'required', 'on' => 'createPerson'),
            array('name, rfc', 'safe', 'on' => 'update,createCompany'),
            array('name, rfc', 'required', 'on' => 'createCompany'),
        );
    }

    public function scopes() {
        $scopes = parent::scopes();
        $scopes['person'] = array('condition' => $this->getTableAlias(false, false) . '.person = 1');
        $scopes['company'] = array('condition' => $this->getTableAlias(false, false) . '.person = 0');
        return $scopes;
    }

    public function searchRelatedParties($relationship) {
        $criteria = new CDbCriteria();

        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        $criteria->mergeWith(array(
            'join' => 'LEFT JOIN PartyRelationship pr ON pr.Party_id = t.id',
            'condition' => 'pr.PartyRelationshipType_id = ' . PartyRelationshipType::model()->find('code = :code', array(':code' => $relationship))->id,
                )
        );
        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                    'pagination' => array('pageSize' => Yii::app()->user->getState('pageSize', Yii::app()->params['defaultPageSize'])),
                ));
    }

    public function search($company = null) {
        $criteria = new CDbCriteria();

        $criteria->compare('id', $this->id);
//        $criteria->compare('name', $this->name, true);
        if (!is_null($company))
            $criteria->scopes = ($company ? 'company' : 'person');
        $criteria->mergeWith(array(
            'join' => 'LEFT JOIN PartyRelationship pr ON pr.Party_id = t.id',
            'condition' => 'pr.PartyRelationshipType_id = ' . PartyRelationshipType::model()->find('code = :code', array(':code' => PartyRelationshipType::CUSTOMER))->id,
                )
        );

//        $criteria->with = array(
//            'currentName' => array('together' => true),
//            'currentRfc' => array('together' => true,),
//        );

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                    'pagination' => array('pageSize' => Yii::app()->user->getState('pageSize', Yii::app()->params['defaultPageSize'])),
                ));
    }

    // HELPER FUNCTIONS
    // NAME
    public function getName(){
        if (!$this->_name)
            if ($this->Name) $this->_name = $this->Name->fullName;
        return $this->_name;
    }
    public function setName($value) {
        $this->_name = $value;
    }

    // RFC
    public function getRfc(){
        if ($this->_rfc)
            if ($this->Rfc) $this->_rfc = $this->Rfc->value;
        return $this->_rfc;
    }
    public function setRfc($value) {
        $this->_rfc = $value;
    }
}