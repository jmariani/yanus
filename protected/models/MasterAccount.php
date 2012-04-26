<?php

Yii::import('application.models._base.BaseMasterAccount');

class MasterAccount extends BaseMasterAccount
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}