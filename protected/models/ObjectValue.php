<?php

Yii::import('application.models._base.BaseObjectValue');

class ObjectValue extends BaseObjectValue
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
        public function defaultScope() {
            return array('order' => $this->getTableAlias(false, false) . '.' . BaseObjectValue::representingColumn() . ' ASC');
        }

	public function rules() {
		return array(
                			array('objectId', 'numerical', 'integerOnly'=>true),
                			array('objectName, code', 'length', 'max'=>255),
                			array('value', 'safe'),
                			array('objectName, objectId, code, value', 'default', 'setOnEmpty' => true, 'value' => null),
                			array('id, objectName, objectId, code, value', 'safe', 'on'=>'search'),
		);
	}

}