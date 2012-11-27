<?php

Yii::import('application.models._base.BaseEavCode');

class EavCode extends BaseEavCode
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
        public function defaultScope() {
            return array('order' => $this->getTableAlias(false, false) . '.' . BaseEavCode::representingColumn() . ' ASC');
        }

	public function rules() {
		return array(
                			array('code', 'length', 'max'=>255),
                			array('code', 'default', 'setOnEmpty' => true, 'value' => null),
                			array('id, code', 'safe', 'on'=>'search'),
		);
	}

}