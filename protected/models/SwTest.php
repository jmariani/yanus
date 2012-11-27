<?php

Yii::import('application.models._base.BaseSwTest');

class SwTest extends BaseSwTest
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

        public function rules() {
		return array(
                			array('status', 'length', 'max'=>45),
                			array('status', 'default', 'setOnEmpty' => true, 'value' => null),
                			array('id, status', 'safe', 'on'=>'search'),
		);
	}

}