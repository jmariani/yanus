<?php

Yii::import('application.models._base.BasePaymentTerm');

class PaymentTerm extends BasePaymentTerm
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}