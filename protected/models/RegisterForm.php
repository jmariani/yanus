<?php

Yii::import('application.models._base.BaseRegisterForm');

class RegisterForm extends BaseRegisterForm {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function rules() {
        $rules = parent::rules();
        $rules[] = array('rfc, businessName', 'unique');
        return $rules;
    }

}