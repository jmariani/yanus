<?php

Yii::import('application.models._base.BaseSatFoliosCfd');

class SatFoliosCfd extends BaseSatFoliosCfd {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function rules() {
        return array(
            array('approvalNbr, approvalYear, startFolio, endFolio', 'numerical', 'integerOnly' => true),
            array('rfc', 'length', 'max' => 13),
            array('md5', 'length', 'max' => 45),
            array('serial', 'safe'),
            array('rfc, approvalNbr, approvalYear, serial, startFolio, endFolio, md5', 'default', 'setOnEmpty' => true, 'value' => null),
            array('id, rfc, approvalNbr, approvalYear, serial, startFolio, endFolio, md5', 'safe', 'on' => 'search'),
        );
    }

    public function getHash() {
        return $this->rfc . '|' .
                $this->approvalNbr . '|' .
                $this->approvalYear . '|' .
                $this->serial . '|' .
                $this->startFolio . '|' .
                $this->endFolio;
    }

    public function beforeSave() {
        $this->md5 = md5($this->getHash());
        return parent::beforeSave();
    }
}