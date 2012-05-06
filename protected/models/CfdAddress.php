<?php

Yii::import('application.models._base.BaseCfdAddress');

class CfdAddress extends BaseCfdAddress
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
    public function behaviors()
    {
        return array(
           'Type' => array(
                'class' => 'AddressTypeBehavior',
                'attribute' => 'type',
            ),
        );
    }
}