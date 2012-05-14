<?php

Yii::import('application.models._base.BaseAddress');

class Address extends BaseAddress {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function beforeValidate() {
        $this->md5 = $this->Md5;
        return parent::beforeValidate();
    }

    public function getHash() {
        $hash = $this->street . '|';
        $hash .= $this->extNbr . '|';
        $hash .= $this->intNbr . '|';
        $hash .= $this->neighbourhood . '|';
        $hash .= $this->city . '|';
        $hash .= $this->municipality . '|';
        $hash .= $this->state . '|';
        $hash .= $this->State_id . '|';
        $hash .= $this->country . '|';
        $hash .= $this->Country_id . '|';
        $hash .= $this->zipCode . '|';
        return $hash;
    }

    public function getMd5() {
        return md5($this->getHash());
    }
}