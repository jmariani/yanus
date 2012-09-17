<?php

Yii::import('application.models._base.BasePartyRelationshipType');

class PartyRelationshipType extends BasePartyRelationshipType {

    const CUSTOMER = 'CUSTOMER';
    const EMPLOYEE = 'EMPLOYEE';
    const VENDOR = 'VENDOR';
    
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function rules() {
        return array(
            array('name, code', 'length', 'max' => 45),
            array('name, code', 'default', 'setOnEmpty' => true, 'value' => null),
            array('id, name, code', 'safe', 'on' => 'search'),
        );
    }

}