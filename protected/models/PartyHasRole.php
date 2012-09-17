<?php

Yii::import('application.models._base.BasePartyHasRole');

class PartyHasRole extends BasePartyHasRole
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
	public function rules() {
		return array(
                			array('Party_id, PartyRole_id', 'required'),
                			array('Party_id, PartyRole_id, active', 'numerical', 'integerOnly'=>true),
                			array('effDt', 'safe'),
                			array('effDt, active', 'default', 'setOnEmpty' => true, 'value' => null),
                			array('id, Party_id, PartyRole_id, effDt, active', 'safe', 'on'=>'search'),
		);
	}

}