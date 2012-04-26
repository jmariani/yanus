<?php

Yii::import('application.models._base.BaseMasterAccountAttribute');

class MasterAccountAttribute extends BaseMasterAccountAttribute
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}