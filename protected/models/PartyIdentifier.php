<?php

Yii::import('application.models._base.BasePartyIdentifier');

class PartyIdentifier extends BasePartyIdentifier {

    const CUSTOMER_CODE = 'CUSTOMER_CODE';
    const RFC = 'RFC';

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function behaviors() {
        return array(
            'CurrentBehavior' => array('class' => 'ext.CurrentBehavior')
        );
    }

    public function rules() {
        return array(
            array('Party_id', 'required'),
            array('Party_id', 'numerical', 'integerOnly' => true),
            array('name, value', 'length', 'max' => 45),
            array('effDt', 'safe'),
            array('name, value, effDt', 'default', 'setOnEmpty' => true, 'value' => null),
            array('id, name, value, effDt, Party_id', 'safe', 'on' => 'search'),
            array('effDt', 'default', 'setOnEmpty' => true, 'value' => new CDbExpression('NOW()')),
        );
    }

    public function scopes() {
        $scopes = parent::scopes();
        $scopes['rfc'] = array('condition' => $this->getTableAlias(false, false) . '.name = "RFC"');
        return $scopes;
    }
}