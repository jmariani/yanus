<?php

Yii::import('application.models._base.BaseCfdAddress');

class CfdAddress extends BaseCfdAddress
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
        public function defaultScope() {
            return array('order' => $this->getTableAlias(false, false) . '.' . BaseCfdAddress::representingColumn() . ' ASC');
        }

	public function rules() {
		return array(
                			array('Cfd_id, Address_id, AddressType_id', 'required'),
                			array('Cfd_id, Address_id, AddressType_id', 'numerical', 'integerOnly'=>true),
                			array('name, reference', 'safe'),
                			array('name, reference', 'default', 'setOnEmpty' => true, 'value' => null),
                			array('id, name, reference, Cfd_id, Address_id, AddressType_id', 'safe', 'on'=>'search'),
		);
	}

}