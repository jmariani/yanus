<?php

Yii::import('application.models._base.BasePartyRelationship');

class PartyRelationship extends BasePartyRelationship {

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
        );
    }

    /**
     * byIdentifier
     * Named scope to filter PartyRelationships by identifier on find
     * @param string $identifier
     * @return $this
     */
    public function byIdentifier($identifier) {
        $criteria = new CDbCriteria();
//        $criteria->with = array(
//            'partyRoles' => array('scopes' => 'current'),
//            'partyRoles.role',
//        );
//        $criteria->compare('role.code', $role->code);
        $criteria->compare('identifier', $identifier);
        $criteria = $this->getDbCriteria()->mergeWith($criteria);
        return $this;
    }

    /**
     * byFromRole
     * Named scope to filter PartyRelationships by From role on find
     * @param Role $role
     * @return $this
     */
    public function byFromPartyRole(PartyRole $role) {
        $criteria = new CDbCriteria();
//        $criteria->with = array(
//            'partyRoles' => array('scopes' => 'current'),
//            'partyRoles.role',
//        );
//        $criteria->compare('role.code', $role->code);
        $criteria->compare('fromPartyRole_id', $role->id);
        $criteria = $this->getDbCriteria()->mergeWith($criteria);
        return $this;
    }

    /**
     * byToRole
     * Named scope to filter PartyRelationships by To role on find
     * @param Role $role
     * @return $this
     */
    public function byToPartyRole(PartyRole $role) {
        $criteria = new CDbCriteria();
//        $criteria->with = array(
//            'partyRoles' => array('scopes' => 'current'),
//            'partyRoles.role',
//        );
//        $criteria->compare('role.code', $role->code);
        $criteria->compare('toPartyRole_id', $role->id);
        $criteria = $this->getDbCriteria()->mergeWith($criteria);
        return $this;
    }

    /**
     * byFromParty
     * Named scope to filter PartyRelationships by To role on find
     * @param Role $role
     * @return $this
     */
    public function byFromParty(Party $party) {
        $criteria = new CDbCriteria();
        $criteria->with = array(
//            'partyRoles' => array('scopes' => 'current'),
            'fromPartyRole',
        );
//        $criteria->compare('role.code', $role->code);
        $criteria->compare('fromPartyRole.Party_id', $party->id);
        $criteria = $this->getDbCriteria()->mergeWith($criteria);
        return $this;
    }

    /**
     * byToParty
     * Named scope to filter PartyRelationships by To Party on find
     * @param Role $role
     * @return $this
     */
    public function byToParty(Party $party) {
        $criteria = new CDbCriteria();
        $criteria->with = array(
//            'partyRoles' => array('scopes' => 'current'),
            'toPartyRole',
        );
//        $criteria->compare('role.code', $role->code);
        $criteria->compare('toPartyRole.Party_id', $party->id);
        $criteria = $this->getDbCriteria()->mergeWith($criteria);
        return $this;
    }

    public function rules() {
        $rules = array();
        $rules[] = array('enabled', 'default', 'setOnEmpty' => true, 'value' => 1);
        return array_merge($rules, parent::rules());
    }

    public function scopes() {
        $scopes = parent::scopes();
        $scopes['enabled'] = array('condition' => $this->getTableAlias(false, false) . '.enabled = 1');
        return $scopes;
    }

}