<?php

Yii::import('application.models._base.BaseCfdHasParty');

class CfdHasParty extends BaseCfdHasParty {

    public function behaviors() {
        $behaviors = parent::behaviors();
//        $behaviors['CTimestampBehavior'] = array(
//            'class' => 'zii.behaviors.CTimestampBehavior',
//            'createAttribute' => 'creationDt',
//            'updateAttribute' => 'updateDt',
//        );
        $behaviors['Type'] = array(
            'class' => 'CfdPartyTypeBehavior',
            'attribute' => 'type',
        );
        return $behaviors;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

//    public function defaultScope() {
//        return array('order' => $this->getTableAlias(false, false) . '.' . BaseCfdHasParty::representingColumn() . ' ASC');
//    }

    public function rules() {
        return array(
            array('Cfd_id, Party_id', 'required'),
            array('Cfd_id, Party_id', 'numerical', 'integerOnly' => true),
            array('type', 'length', 'max' => 45),
            array('type', 'default', 'setOnEmpty' => true, 'value' => null),
            array('id, Cfd_id, Party_id, type', 'safe', 'on' => 'search'),
        );
    }

    public function scopes() {
        $scopes = parent::scopes();
        $type = new CfdPartyTypeBehavior();
        $types = $type->getList();
        foreach ($types as $key => $value) {
            $scopes[$key] = array('condition' => $this->getTableAlias(false, false) . '.type = "' . $key . '"');
        }
//        $scopes[CfdPartyTypeBehavior::VENDOR] = array('condition' => $this->getTableAlias(false, false) . '.type = "' . CfdPartyTypeBehavior::VENDOR . '"');
//        $scopes[CfdPartyTypeBehavior::CUSTOMER] = array('condition' => $this->getTableAlias(false, false) . '.type = "' . CfdPartyTypeBehavior::CUSTOMER . '"');
        return $scopes;
    }
}