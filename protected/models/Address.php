<?php

Yii::import('application.models._base.BaseAddress');

class Address extends BaseAddress
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}