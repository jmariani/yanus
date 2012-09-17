<?php

Yii::import('application.models._base.BaseCfdTaxRegime');

class CfdTaxRegime extends BaseCfdTaxRegime
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
	public function rules() {
		return array(
                			array('Cfd_id, name', 'required'),
                			array('Cfd_id', 'numerical', 'integerOnly'=>true),
                			array('id, Cfd_id, name', 'safe', 'on'=>'search'),
		);
	}

}