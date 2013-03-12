<?php

Yii::import('application.models._base.BaseIdentifier');

class Identifier extends BaseIdentifier {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function __toString() {
        return $this->value;
    }

    public function behaviors() {
        return array(
            'CTimestampBehavior' => array(
                'class' => 'zii.behaviors.CTimestampBehavior',
                'createAttribute' => 'effDt',
                'updateAttribute' => null
            )
        );
    }

    public function relations() {
        $relations = array(
            'partyIdentifier' => array(self::HAS_ONE, 'PartyIdentifier', 'Identifier_id'),
        );
        return array_merge($relations, parent::relations());
    }

    public function scopes() {
        $scopes = parent::scopes();
        $types = new IdentifierTypeBehavior();
        foreach ($types->getList() as $type => $label) {
            $scopes[$type] = array('condition' => $this->getTableAlias(false, false) . '.type = "' . $type . '"');
        }
        return $scopes;
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

}