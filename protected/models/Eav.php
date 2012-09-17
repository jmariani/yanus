<?php

Yii::import('application.models._base.BaseEav');

class Eav extends BaseEav
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}