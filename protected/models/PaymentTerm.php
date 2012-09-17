<?php

Yii::import('application.models._base.BasePaymentTerm');

class PaymentTerm extends BasePaymentTerm
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
	public function rules() {
		return array(
                			array('days', 'numerical', 'integerOnly'=>true),
                			array('name', 'length', 'max'=>255),
                			array('code', 'length', 'max'=>45),
                			array('name, code, days', 'default', 'setOnEmpty' => true, 'value' => null),
                			array('id, name, code, days', 'safe', 'on'=>'search'),
		);
	}

}