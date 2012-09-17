<?php

Yii::import('application.models._base.BaseFleetAutomobile');

class FleetAutomobile extends BaseFleetAutomobile
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}