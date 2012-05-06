<?php

Yii::import('application.models._base.BaseAddress');

class Address extends BaseAddress
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
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
            $hash .= $this->reference . '|';
            return $hash;
        }
        public function beforeValidate() {
            $this->md5 = md5($this->getHash());
            return parent::beforeValidate();
        }

}