<?php

Yii::import('application.models._base.BasePartyIdentifier');

class PartyIdentifier extends BasePartyIdentifier {

    public function __toString() {
        return $this->value;
    }

    public function behaviors() {
        return array(
            'CTimestampBehavior' => array(
                'class' => 'zii.behaviors.CTimestampBehavior',
                'createAttribute' => 'effDt',
                'updateAttribute' => null
            ),
            'current' => array('class' => 'ext.CurrentBehavior', 'idColumn' => array('Party_id', 'type'))
        );
    }

    public function byType($type) {
        $criteria = new CDbCriteria();
        $criteria->compare($this->getTableAlias(false, false) . '.type', $type);

        $criteria = $this->Owner->getDbCriteria()->mergeWith($criteria);
        return $this->Owner;
    }

    public function byValue($value) {
        $criteria = new CDbCriteria();
        $criteria->compare($this->getTableAlias(false, false) . '.value', $value);

        $criteria = $this->Owner->getDbCriteria()->mergeWith($criteria);
        return $this->Owner;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function scopes() {
        $scopes = parent::scopes();
        $types = new PartyIdentifierTypeBehavior();
        foreach ($types->getList() as $type => $label) {
            $scopes[$type] = array('condition' => $this->getTableAlias(false, false) . '.type = "' . $type . '"');
        }
        return $scopes;
    }

}