<?php

Yii::import('application.models._base.BaseCfdDiscount');

class CfdDiscount extends BaseCfdDiscount
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
        public function defaultScope() {
            return array('order' => $this->getTableAlias(false, false) . '.' . BaseCfdDiscount::representingColumn() . ' ASC');
        }

	public function rules() {
		return array(
                			array('Cfd_id', 'required'),
                			array('Cfd_id', 'numerical', 'integerOnly'=>true),
                			array('amt', 'length', 'max'=>64),
                			array('reason', 'safe'),
                			array('amt, reason', 'default', 'setOnEmpty' => true, 'value' => null),
                			array('id, amt, reason, Cfd_id', 'safe', 'on'=>'search'),
		);
	}

}