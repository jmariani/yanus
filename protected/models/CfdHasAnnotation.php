<?php

Yii::import('application.models._base.BaseCfdHasAnnotation');

class CfdHasAnnotation extends BaseCfdHasAnnotation
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}