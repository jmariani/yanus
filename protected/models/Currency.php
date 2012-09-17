<?php

Yii::import('application.models._base.BaseCurrency');

class Currency extends BaseCurrency
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
	public function rules() {
		return array(
                			array('active', 'numerical', 'integerOnly'=>true),
                			array('name, code', 'length', 'max'=>45),
                			array('name, code, active', 'default', 'setOnEmpty' => true, 'value' => null),
                			array('id, name, code, active', 'safe', 'on'=>'search'),
		);
	}

}