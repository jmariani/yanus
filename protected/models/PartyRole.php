<?php

Yii::import('application.models._base.BasePartyRole');

class PartyRole extends BasePartyRole
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
	public function rules() {
		return array(
                			array('active', 'numerical', 'integerOnly'=>true),
                			array('name', 'length', 'max'=>255),
                			array('code', 'length', 'max'=>45),
                			array('name, code, active', 'default', 'setOnEmpty' => true, 'value' => null),
                			array('id, name, code, active', 'safe', 'on'=>'search'),
		);
	}

}