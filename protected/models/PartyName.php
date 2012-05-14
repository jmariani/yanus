<?php

Yii::import('application.models._base.BasePartyName');

class PartyName extends BasePartyName {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function beforeSave() {
        if ($this->surName)
            $this->surName = mb_convert_case($this->surName, MB_CASE_UPPER);
        if ($this->motherName)
            $this->motherName = mb_convert_case($this->motherName, MB_CASE_UPPER);
        if ($this->firstName)
            $this->firstName = mb_convert_case($this->firstName, MB_CASE_UPPER);
        if ($this->secondName)
            $this->secondName = mb_convert_case($this->secondName, MB_CASE_UPPER);
        return parent::beforeSave();
    }

    public function rules() {
        $rules = parent::rules();
        $rules[] = array('effDt', 'default', 'setOnEmpty' => true, 'value'=>new CDbExpression('NOW()'));
        return $rules;
    }
}