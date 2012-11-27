<?php

Yii::import('application.models._base.BasePartyIdentifier');

class PartyIdentifier extends BasePartyIdentifier {

    const CUSTOMER_CODE = 'CUSTOMER_CODE';
    const RFC = 'RFC';

    public function __toString() {
        return $this->value;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function behaviors() {
        return array(
            'name' => array(
                'class' => 'PartyIdentifierNameBehavior',
                'attribute' => 'name',
            ),
            'CurrentBehavior' => array('class' => 'ext.CurrentBehavior'),
        );
    }

    public function rules() {
        return array(
            array('Party_id', 'required'),
            array('Party_id', 'numerical', 'integerOnly' => true),
            array('name, value', 'length', 'max' => 45),
            array('effDt', 'safe'),
            array('name, value', 'default', 'setOnEmpty' => true, 'value' => null),
            array('id, name, value, effDt, Party_id', 'safe', 'on' => 'search'),
            array('effDt', 'default', 'setOnEmpty' => true, 'value' => new CDbExpression('NOW()')),
        );
    }

    public function scopes() {
        $scopes = parent::scopes();
        $names = new PartyIdentifierNameBehavior();
        foreach ($names->getList() as $name => $value) {
            $scopes[$name] = array('condition' => $this->getTableAlias(false, false) . '.name = "' . $name . '"');

        }
        return $scopes;
    }

}