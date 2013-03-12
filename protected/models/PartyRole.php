<?php

Yii::import('application.models._base.BasePartyRole');

class PartyRole extends BasePartyRole {

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
                'idColumn' => 'Party_id')
        );
    }

    /**
     * byToRole
     * Named scope to filter PartyRelationships by To role on find
     * @param Role $role
     * @return $this
     */
    public function byRole(Role $role) {
        $criteria = new CDbCriteria();
//        $criteria->with = array(
//            'partyRoles' => array('scopes' => 'current'),
//            'partyRoles.role',
//        );
//        $criteria->compare('role.code', $role->code);
        $criteria->compare('Role_id', $role->id);
        $criteria = $this->getDbCriteria()->mergeWith($criteria);
        return $this;
    }

    /**
     * byFromParty
     * Named scope to filter PartyRelationships by To role on find
     * @param Role $role
     * @return $this
     */
    public function byParty(Party $party) {
        $criteria = new CDbCriteria();
//        $criteria->with = array(
////            'partyRoles' => array('scopes' => 'current'),
//            'fromPartyRole',
//        );
//        $criteria->compare('role.code', $role->code);
        $criteria->compare('Party_id', $party->id);
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