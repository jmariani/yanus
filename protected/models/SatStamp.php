<?php

Yii::import('application.models._base.BaseSatStamp');

class SatStamp extends BaseSatStamp
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
        public function defaultScope() {
            return array('order' => $this->getTableAlias(false, false) . '.' . BaseSatStamp::representingColumn() . ' ASC');
        }

	public function rules() {
		return array(
                			array('Cfd_id', 'required'),
                			array('Cfd_id, SatCertificate_id', 'numerical', 'integerOnly'=>true),
                			array('uuid, version, dttm, certificate', 'length', 'max'=>45),
                			array('stamp, originalString', 'safe'),
                			array('uuid, version, dttm, certificate, stamp, originalString, SatCertificate_id', 'default', 'setOnEmpty' => true, 'value' => null),
                			array('id, Cfd_id, uuid, version, dttm, certificate, stamp, originalString, SatCertificate_id', 'safe', 'on'=>'search'),
		);
	}

}