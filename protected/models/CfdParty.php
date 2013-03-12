<?php

Yii::import('application.models._base.BaseCfdParty');

class CfdParty extends BaseCfdParty {

    public function behaviors() {
        $behaviors = parent::behaviors();
        $behaviors['Type'] = array(
            'class' => 'CfdPartyTypeBehavior',
            'attribute' => 'type',
        );
        return $behaviors;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function scopes() {
        $scopes = parent::scopes();
        $types = new CfdPartyTypeBehavior();
        foreach ($types->getList() as $key => $value) {
            $scopes[$key] = array('condition' => $this->getTableAlias(false, false) . '.type = "' . $key . '"');
        }
        return $scopes;
    }
}