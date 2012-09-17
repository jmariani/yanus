<?php

Yii::import('application.models._base.BaseAddressType');

class AddressType extends BaseAddressType {

    const PRIMARY = 'PRIMARY';
    const ISSUING = 'ISSUING';
    const BILL_TO = 'BILL_TO';
    const SHIP_TO = 'SHIP_TO';

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function defaultScope() {
        return array('order' => $this->getTableAlias(false, false) . '.' . BaseAddressType::representingColumn() . ' ASC');
    }

    public function rules() {
        return array(
            array('name, code', 'length', 'max' => 45),
            array('name, code', 'default', 'setOnEmpty' => true, 'value' => null),
            array('id, name, code', 'safe', 'on' => 'search'),
        );
    }

}