<?php

Yii::import('application.models._base.BaseCharacteristic');

class Characteristic extends BaseCharacteristic
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
        public function defaultScope() {
            return array('order' => $this->getTableAlias(false, false) . '.' . BaseCharacteristic::representingColumn() . ' ASC');
        }

	public function rules() {
		return array(
                			array('objectId', 'numerical', 'integerOnly'=>true),
                			array('className, code', 'length', 'max'=>45),
                			array('value', 'safe'),
                			array('className, objectId, code, value', 'default', 'setOnEmpty' => true, 'value' => null),
                			array('id, className, objectId, code, value', 'safe', 'on'=>'search'),
		);
	}

}