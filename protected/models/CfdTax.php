<?php

Yii::import('application.models._base.BaseCfdTax');

class CfdTax extends BaseCfdTax {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function rules() {
        return array(
            array('Cfd_id', 'required'),
            array('local, withHolding', 'boolean',),
            array('Cfd_id', 'numerical', 'integerOnly' => true),
            array('rate, amt', 'length', 'max' => 64),
            array('name', 'safe'),
            array('name, rate, amt, local, withHolding', 'default', 'setOnEmpty' => true, 'value' => null),
            array('id, Cfd_id, name, rate, amt, local, withHolding', 'safe', 'on' => 'search'),
        );
    }

}