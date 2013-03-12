<?php

Yii::import('application.models._base.BasePartyName');

class PartyName extends BasePartyName {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function behaviors() {
        return array(
            'CTimestampBehavior' => array(
                'class' => 'zii.behaviors.CTimestampBehavior',
                'createAttribute' => 'effDt',
                'updateAttribute' => null
            ),
            'current' => array('class' => 'ext.CurrentBehavior',
                'idColumn' => array('Party_id', 'type'))
        );
    }

    public function scopes() {
        $scopes = parent::scopes();
        $types = new PartyNameTypeBehavior();
        foreach ($types->getList() as $type => $label) {
            $scopes[$type] = array('condition' => $this->getTableAlias(false, false) . '.type = "' . $type . '"');
        }
        return $scopes;
    }

}