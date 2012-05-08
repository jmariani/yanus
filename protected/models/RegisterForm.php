<?php

Yii::import('application.models._base.BaseRegisterForm');

class RegisterForm extends BaseRegisterForm {

    public $captcha;

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function beforeSave() {
        $this->activationKey = md5(time() . $this->password);
        return parent::beforeSave();
    }
    public function rules() {
        $rules = parent::rules();
        $rules[] = array('rfc, businessName', 'unique');
        $rules[] = array('contactEmail', 'email');
        $rules[] = array(
            'captcha',
            'application.extensions.recaptcha.EReCaptchaValidator',
            'privateKey' => '6LeSJ9ESAAAAABs28mTOtb1-0XvM0--u05CS5w_V',
            'on' => 'registerwcaptcha'
        );
        return $rules;
    }

}