<?php

Yii::import('application.models._base.BaseMySuiteConfig');

class MySuiteConfig extends BaseMySuiteConfig
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}