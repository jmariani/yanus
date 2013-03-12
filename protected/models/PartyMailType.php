<?php

Yii::import('application.models._base.BasePartyMailType');

class PartyMailType extends BasePartyMailType {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
	public static function representingColumn() {
		return 'text';
	}

}