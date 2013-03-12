<?php

Yii::import('application.models._base.BasePartyHasPaymentMethod');

class PartyHasPaymentMethod extends BasePartyHasPaymentMethod
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}