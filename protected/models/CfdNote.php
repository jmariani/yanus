<?php

Yii::import('application.models._base.BaseCfdNote');

class CfdNote extends BaseCfdNote
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
        public function defaultScope() {
            return array('order' => $this->getTableAlias(false, false) . '.' . BaseCfdNote::representingColumn() . ' ASC');
        }

	public function rules() {
		return array(
                			array('Cfd_id', 'required'),
                			array('Cfd_id', 'numerical', 'integerOnly'=>true),
                			array('value', 'safe'),
                			array('value', 'default', 'setOnEmpty' => true, 'value' => null),
                			array('id, value, Cfd_id', 'safe', 'on'=>'search'),
		);
	}

}