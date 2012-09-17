<?php

Yii::import('application.models._base.BasePartyName');

class PartyName extends BasePartyName {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function beforeSave() {
        if ($this->surName) {
            $this->surName = mb_convert_case($this->surName, MB_CASE_UPPER);
            $this->fullName = $this->surName;
        }
        if ($this->motherFamilyName) {
            $this->motherFamilyName = mb_convert_case($this->motherFamilyName, MB_CASE_UPPER);
            $this->fullName .= ' ' . $this->motherFamilyName;
        }
        if ($this->firstName) {
            $this->firstName = mb_convert_case($this->firstName, MB_CASE_UPPER);
            $this->fullName .= ', ' . $this->firstName;
        }
        if ($this->secondName) {
            $this->secondName = mb_convert_case($this->secondName, MB_CASE_UPPER);
            $this->fullName .= ' ' . $this->secondName;
        }

        return parent::beforeSave();
    }

    public function behaviors() {
        return array(
            'CurrentBehavior' => array('class' => 'ext.CurrentBehavior')
        );
    }

    public function rules() {
        $rules = parent::rules();
        $rules[] = array('effDt', 'default', 'setOnEmpty' => true, 'value' => new CDbExpression('NOW()'));
        return $rules;
    }

}