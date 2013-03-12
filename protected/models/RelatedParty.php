<?php

Yii::import('application.models._base.BaseRelatedParty');

class RelatedParty extends BaseRelatedParty
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}