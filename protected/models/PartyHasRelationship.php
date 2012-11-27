<?php

Yii::import('application.models._base.BasePartyHasRelationship');

class PartyHasRelationship extends BasePartyHasRelationship {

    public function behaviors() {
        return array(
            'type' => array(
                'class' => 'PartyRelationshipTypeBehavior',
                'attribute' => 'type',
            ),
//            'CurrentBehavior' => array('class' => 'ext.CurrentBehavior'),
        );
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

//    public function defaultScope() {
//        return array('order' => $this->getTableAlias(false, false) . '.' . BasePartyHasRelationship::representingColumn() . ' ASC');
//    }

    public function rules() {
        return array(
            array('Party_id, RelatedParty_id', 'required'),
            array('Party_id, RelatedParty_id', 'numerical', 'integerOnly' => true),
            array('type', 'length', 'max' => 45),
            array('type', 'default', 'setOnEmpty' => true, 'value' => null),
            array('id, Party_id, RelatedParty_id, type', 'safe', 'on' => 'search'),
        );
    }

    public function scopes() {
        $scopes = parent::scopes();
        $type = new PartyRelationshipTypeBehavior();
        foreach ($type->getList() as $key => $value) {
            $scopes[$key] = array('condition' => $this->getTableAlias(false, false) . '.type = "' . $key . '"');
        }
        return $scopes;
    }

}