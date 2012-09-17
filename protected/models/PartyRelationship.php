<?php

Yii::import('application.models._base.BasePartyRelationship');

class PartyRelationship extends BasePartyRelationship
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
	public function rules() {
		return array(
                			array('Party_id, PartyRelationshipType_id, RelatedParty_id', 'required'),
                			array('Party_id, PartyRelationshipType_id, RelatedParty_id', 'numerical', 'integerOnly'=>true),
                			array('id, Party_id, PartyRelationshipType_id, RelatedParty_id', 'safe', 'on'=>'search'),
		);
	}

}