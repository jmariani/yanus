<?php

Yii::import('application.models._base.BasePhoneNbr');

class PhoneNbr extends BasePhoneNbr {

    public function __toString() {
        return $this->value;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function cleanUpNbr($nbr) {
        return preg_replace("/[^0-9]/", '', $nbr);
    }

//    public function defaultScope() {
//        return array('order' => $this->getTableAlias(false, false) . '.' . BasePhoneNbr::representingColumn() . ' ASC');
//    }

    public function rules() {
        return array(
            array('value, ext', 'length', 'max' => 255),
            array('value, ext', 'default', 'setOnEmpty' => true, 'value' => null),
            array('id, value, ext', 'safe', 'on' => 'search'),
        );
    }

}