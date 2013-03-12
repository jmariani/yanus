<?php

Yii::import('application.models._base.BaseCfdPaymentMethod');

class CfdPaymentMethod extends BaseCfdPaymentMethod
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}