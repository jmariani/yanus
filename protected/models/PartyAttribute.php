<?php

Yii::import('application.models._base.BasePartyAttribute');

class PartyAttribute extends BasePartyAttribute {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function behaviors() {
        return array(
            'CurrentBehavior' => array('class' => 'CurrentBehavior')
        );
    }
    public function rules() {
        $rules = parent::rules();
        $rules[] = array('effDt', 'default', 'value'=>new CDbExpression('NOW()'));
        return $rules;
    }

}