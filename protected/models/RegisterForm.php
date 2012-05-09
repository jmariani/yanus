<?php

Yii::import('application.models._base.BaseRegisterForm');

class RegisterForm extends BaseRegisterForm {

    public $captcha;

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    public function beforeSave() {
        $this->activationKey = md5(time() . $this->password);
        $this->activationUrl = yii::app()->createAbsoluteUrl('/registerForm/activate', array('activateKey' => $this->activationKey));
        $this->lastName = trim(mb_convert_case($this->lastName, MB_CASE_TITLE));
        $this->motherName = ($this->motherName ?:trim(mb_convert_case($this->motherName, MB_CASE_TITLE)));
        $this->firstName = trim(mb_convert_case($this->firstName, MB_CASE_TITLE));
        $this->secondName = ($this->secondName ?: trim(mb_convert_case($this->secondName, MB_CASE_TITLE)));

        return parent::beforeSave();
    }
    public function beforeValidate() {
        $this->rfc = strtoupper($this->rfc);
        $this->businessName = trim(mb_strtoupper($this->businessName));
        return parent::beforeValidate();
    }
    public function getContactName() {
        return trim($this->firstName . ' ' . $this->secondName . ' ' . $this->lastName . ' ' . $this->motherName);
    }
    public function rules() {
        $rules = parent::rules();
        $rules[] = array('rfc, businessName', 'unique');
        $rules[] = array('contactEmail', 'email');
        $rules[] = array('captcha', 'safe');
        $rules[] = array(
            'captcha',
            'application.extensions.recaptcha.EReCaptchaValidator',
            'privateKey' => '6LeSJ9ESAAAAABs28mTOtb1-0XvM0--u05CS5w_V',
            'on' => 'registerwcaptcha'
        );
        return $rules;
    }
    public function sendActivationMail() {
        $mail = new YiiMailMessage();
        $mail->setTo(array($this->contactEmail => $this->getContactName()));
        $mail->setBcc(array(Yii::app()->params['adminEmail'] => CHtml::encode(Yii::app()->name) . ' ' . yii::t('app', 'administration')));
        $mail->setFrom(array(Yii::app()->params['noreplyEmail'] => CHtml::encode(Yii::app()->name) . ' ' . yii::t('app', 'administration')));
        $mail->setSubject(yii::t('app', 'Thank you for registering'));
        $mail->view = 'activateRegisterForm';
        $mail->setBody(array('model' => $this), 'text/html');
        yii::app()->mail->send($mail);
    }
}