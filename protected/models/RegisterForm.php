<?php

Yii::import('application.models._base.BaseRegisterForm');

class RegisterForm extends BaseRegisterForm {

    const STATUS_NEW = 'new';
    const STATUS_PENDING = 'pending';

    public $captcha;

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function afterSave() {
        if ($this->isNewRecord)
            $this->sendActivationMail();
        return parent::afterSave();
    }
    public function beforeSave() {
        $this->activationKey = md5(time() . $this->password);
        $this->activationUrl = yii::app()->createAbsoluteUrl('/registerForm/activate', array('activateKey' => $this->activationKey));
        $this->contactLastName = trim(mb_convert_case($this->contactLastName, MB_CASE_TITLE));
        if ($this->contactMotherName)
            $this->contactMotherName = trim(mb_convert_case($this->contactMotherName, MB_CASE_TITLE));
        $this->contactFirstName = trim(mb_convert_case($this->contactFirstName, MB_CASE_TITLE));
        if ($this->contactSecondName)
            $this->contactSecondName = trim(mb_convert_case($this->contactSecondName, MB_CASE_TITLE));
        if ($this->isNewRecord) {
            $this->userName .= '@' . $this->rfc;
            $this->password = UserModule::encrypting($this->password);
        }
        return parent::beforeSave();
    }

    public function beforeValidate() {
        $this->rfc = strtoupper($this->rfc);
        $this->businessName = trim(mb_strtoupper($this->businessName));
        if ($this->isNewRecord)
            $this->status = $this->swGetInitialStatus();
        return parent::beforeValidate();
    }

    public function behaviors() {
        return array(
//            'CTimestampBehavior' => array(
//                'class' => 'zii.behaviors.CTimestampBehavior',
//                'createAttribute' => 'creationDt',
//                'updateAttribute' => 'updateDt',
//            ),
//           'VoucherType' => array(
//                'class' => 'CfdTypeBehavior',
//                'attribute' => 'voucherType',
//            ),
//            'Status' => array(
//                'class' => 'RegisterFormStatusBehavior',
//                'attribute' => 'status',
//            ),
            'swBehavior' => array(
                'class' => 'application.extensions.simpleWorkflow.SWActiveRecordBehavior',
            ),
        );
    }

    public function finalize() {
        // First create the address
        $address = new Address();
        $address->street = $this->street;
        $address->extNbr = $this->extNbr;
        $address->intNbr = $this->intNbr;
        $address->neighbourhood = $this->colony;
        $address->city = $this->city;
        $address->reference = $this->reference;
        $address->municipality = $this->municipality;
        $address->Country_id = Country::model()->find('code = :code', array(':code' => 'MX'))->id;
        $address->country = Country::model()->find('code = :code', array(':code' => 'MX'))->name;
        $address->State_id = $this->State_id;
        $address->zipCode = $this->zipCode;
        if (Address::model()->find('md5 = :md5', array(':md5' => $address->Md5)) === NULL) {
            if (!$address->save()) print_r($address->getErrors());
        }


        // Now create the Party
        $party = new Party();
        $party->name = $this->businessName;
        $party->Rfc = $this->rfc;
        if (!$party->save()) print_r($party->getErrors());

//        // Save RFC
//        $partyRfc = new PartyAttribute();
//        $partyRfc->Party_id = $party->id;
//        $partyRfc->code = 'RFC';
//        $partyRfc->value = $this->rfc;
//        if (!$partyRfc->save()) print_r($partyRfc->getErrors());
        // Attach address
        $partyAddress = new PartyAddress();
        $partyAddress->Party_id = $party->id;
        $partyAddress->Address_id = $address->id;
        $partyAddress->type = AddressTypeBehavior::FISCAL;
        if ($this->reference) $partyAddress->reference = $this->reference;
        if (!$partyAddress->save()) print_r($partyAddress->getErrors());
        // Create user
        $user = new User();
        $user->username = $this->userName;
        $user->password = $this->password;
        $user->activkey = $this->activationKey;
        $user->email = $this->contactEmail;
//        $user->verifyPassword = $this->password;
        $user->createtime = time();
        $user->lastvisit = 0;
        $user->superuser = 0;
        $user->status = User::STATUS_ACTIVE;
        if (!$user->save()) print_r($user->getErrors());
    }
    public function getContactName() {
        return trim($this->contactFirstName . ' ' . $this->contactSecondName . ' ' . $this->contactLastName . ' ' . $this->contactMotherName);
    }

    public function rules() {
        $rules = parent::rules();
        $rules[] = array('status', 'SWValidator');
        $rules[] = array('rfc', 'match', 'pattern' => SatRfc::rfc_regex, 'message' => yii::t('app', "RFC: Incorrect format."));
        $rules[] = array('userName', 'match', 'pattern' => '/^[A-Za-z0-9_]+$/u');
        $rules[] = array('userName', 'length', 'max'=>20, 'min' => 3);
        $rules[] = array('rfc', 'SatRfcValidator');
        $rules[] = array('rfc, businessName', 'unique');
        $rules[] = array('contactEmail', 'email');
        $rules[] = array('captcha', 'safe');
        $rules[] = array('fiscalRegime, street, municipality, zipCode', 'required', 'on' => 'finalize');
        $rules[] = array(
            'captcha',
            'application.extensions.recaptcha.EReCaptchaValidator',
            'privateKey' => '6LeSJ9ESAAAAABs28mTOtb1-0XvM0--u05CS5w_V',
            'on' => 'registerwcaptcha,finalize'
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