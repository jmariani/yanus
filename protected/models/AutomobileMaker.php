<?php

Yii::import('application.models._base.BaseAutomobileMaker');

class AutomobileMaker extends BaseAutomobileMaker
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}