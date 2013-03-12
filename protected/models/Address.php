<?php

Yii::import('application.models._base.BaseAddress');

class Address extends BaseAddress {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function beforeSave() {
        // Get country
//        if ($this->country) {
//            $country = Country::model()->find('code = :code', array(':code' => $this->country));
//            if ($country) {
//                $this->Country_id = $country->id;
//                // Get state
//                if ($this->state) {
//                    $state = State::model()->find('code = :code and Country_id = :country_id', array(':code' => $this->state,
//                        ':country_id' => $country->id));
//                    if ($state) {
//                        $this->State_id = $state->id;
//                    }
//                }
//            }
//        }
        return parent::beforeSave();
    }

    public function beforeValidate() {
        $this->md5 = $this->getMd5();
        return parent::beforeValidate();
    }

    public function geoEncode() {
        $hash = array();
        $hash[] = $this->street;
        $hash[] = $this->extNbr;
        $hash[] = $this->neighbourhood;
        $hash[] = $this->city;
        $hash[] = $this->municipality;
        $hash[] = $this->zipCode;
        $hash[] = $this->zipCode;

        $url = "http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false&language=es";
        $result = file_get_contents("$url");
        $json = json_decode($result);
    }

    public function getHash() {
        $hash = $this->street . '|';
        $hash .= $this->extNbr . '|';
        $hash .= $this->intNbr . '|';
        $hash .= $this->neighbourhood . '|';
        $hash .= $this->city . '|';
        $hash .= $this->municipality . '|';
        $hash .= $this->State_id . '|';
        $hash .= $this->zipCode . '|';
        return $hash;
    }

    public function getMd5() {
        return md5($this->getHash());
    }

    public function rules() {
        $rules = array();
        $rules[] = array('md5', 'unique');
        return array_merge($rules, parent::rules());
    }
}