<?php

Yii::import('application.models._base.BaseParty');

class Party extends BaseParty {

    public static function model($className = __CLASS__) {
        return parent::model($className);
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

    /**
     * byIdentifier
     * Named scope to filter Parties by identifier on find
     * @param Identifier $identifier
     * @return Owner
     */
    public function byIdentifier(PartyIdentifier $identifier) {
        $criteria = new CDbCriteria();
        $criteria->with = array(
            'partyIdentifiers' => array('scopes' => array('current', $identifier->type)),
        );
        $criteria->compare('partyIdentifiers.value', $identifier->value);
        $criteria = $this->getDbCriteria()->mergeWith($criteria);
        return $this;
    }

    /**
     * byName
     * Named scope to filter Parties by name on find
     * @param Name $name
     * @return Owner
     */
    public function byName(Name $name) {
        $criteria = new CDbCriteria();
        $criteria->with = array(
            'partyNames' => array('scopes' => 'current'),
            'partyNames.name',
        );
        $criteria->compare('name.md5', $name->getMd5());
        $criteria = $this->getDbCriteria()->mergeWith($criteria);
        return $this;
    }

    /**
     * byRole
     * Named scope to filter Parties by role on find
     * @param Role $role
     * @return Owner
     */
    public function byRole(Role $role) {
        $criteria = new CDbCriteria();
        $criteria->with = array(
            'partyRoles' => array('scopes' => 'current'),
            'partyRoles.role',
        );
        $criteria->compare('role.code', $role->code);
        $criteria->compare('role.class', 'Party');
        $criteria = $this->getDbCriteria()->mergeWith($criteria);
        return $this;
    }

    public function getNameAndCustomerId() {
        return $this->primaryName->value . ' ' . (strlen($this->customerId) > 0?'(' . $this->customerId . ')':'');
    }

    public function findByIdentifier(Identifier $identifier) {
        $criteria = new CDbCriteria();
        $criteria->with = array('partyIdentifiers' => array('with' => 'identifier'));
        $criteria->condition = 'identifier.type = :itype and identifier.value = :value';
        $criteria->params = array(':itype' => $identifier->type, ':value' => $identifier->value);
        return Party::model()->find($criteria);
    }


    public function findByPartyIdentifierValue($value, $partyIdentifierType = PartyIdentifierTypeBehavior::RFC) {
        return Party::model()->with(array(
                    'partyIdentifiers' => array('scopes' => array('current', $partyIdentifierType))
                ))->find('partyIdentifiers.value = :value', array(':value' => $value));

        $criteria = new CDbCriteria();
        $criteria->with = array('partyIdentifiers' => array('with' => 'identifier'));
        $criteria->condition = 'partyIdentifiers.type = :ptype and identifier.type = :itype and identifier.value = :value';
        $criteria->params = array(':ptype' => $partyIdentifierType, ':itype' => $idType, ':value' => $value);
        return Party::model()->find($criteria);
    }

    public function findPartyIdentifier($idType, $value, $partyIdentifierType = null) {
        $criteria = new CDbCriteria();
        $criteria->with = 'identifier';
        $criteria->condition = 't.Party_id = :id and identifier.type = :itype and identifier.value = :value';
        $criteria->params = array(':id' => $this->id, ':itype' => $idType, ':value' => $value);
        if ($partyIdentifierType)
            $criteria->scopes = $partyIdentifierType;
        return PartyIdentifier::model()->find($criteria);
    }

    public function findPartyName(Name $name, $partyNameType = null, $current = true) {
        $criteria = new CDbCriteria();
        $criteria->with = 'name';
        $criteria->condition = 't.Party_id = :id and name.md5 = :md5';
        $criteria->params = array(':id' => $this->id, ':md5' => $name->getMd5());
        $scopes = array();
        if ($current)
            $scopes[] = 'current';
        if ($partyNameType)
            $scopes[] = $partyNameType;
        if (count($scopes))
            $criteria->scopes = $scopes;
        return PartyName::model()->find($criteria);
    }

    /**
     *
     * @param type $roleCode
     * @return type
     */
    public function getRole($roleCode) {
        $criteria = new CDbCriteria();
        $criteria->with = 'role';
        $criteria->condition = 't.Party_id = :id and role.code = :code and role.class = :class';
        $criteria->params = array(':id' => $this->id, ':code' => $roleCode, ':class' => 'Party');
        $criteria->scopes = array('enabled', 'current');
        return PartyRole::model()->find($criteria);
    }


    /**
     * Test if the party has the role code and returns it.
     *
     * @param type $roleCode
     * @return type PartyRole
     */
    public function hasRole($roleCode) {
        $criteria = new CDbCriteria();
        $criteria->with = 'role';
        $criteria->condition = 't.Party_id = :id and role.code = :code and role.class = :class';
        $criteria->params = array(':id' => $this->id, ':code' => $roleCode, ':class' => 'Party');
        $criteria->scopes = array('enabled', 'current');
        return PartyRole::model()->find($criteria);
    }

    public function relations() {
        $relations = parent::relations();
        $relations['primaryName'] = array(self::HAS_ONE, 'PartyName', 'Party_id', 'scopes' => array('current', 'primary',));
        $relations['name'] = array(self::HAS_ONE, 'Name', array('Name_id' => 'id'), 'through' => 'primaryName');

//        $relations['primaryIdentifier'] = array(self::HAS_ONE, 'PartyIdentifier', 'Party_id', 'scopes' => array('primary', 'current'));
//        $relations['identifier'] = array(self::HAS_ONE, 'Identifier', array('Identifier_id' => 'id'), 'through' => 'primaryIdentifier');

          $relations['rfc'] = array(self::HAS_ONE, 'PartyIdentifier', 'Party_id', 'scopes' => array('current', PartyIdentifierTypeBehavior::RFC));
          $relations['customerId'] = array(self::HAS_ONE, 'PartyIdentifier', 'Party_id', 'scopes' => array('current', PartyIdentifierTypeBehavior::CUSTOMER_ID));
//          $relations['rfcIdentifier'] = array(self::HAS_ONE, 'PartyIdentifier', 'Party_id', 'scopes' => array('current', PartyIdentifierTypeBehavior::RFC));
//        $relations['rfc'] = array(self::HAS_ONE, 'Identifier', array('Identifier_id' => 'id'), 'through' => 'rfcIdentifier', 'scopes' => IdentifierTypeBehavior::RFC);

//        $relations['customerId'] = array(self::HAS_ONE, 'Identifier', array('Identifier_id' => 'id'), 'through' => 'partyIdentifiers', 'scopes' => IdentifierTypeBehavior::CUSTOMERID);

        $relations['currentPartyRoles'] = array(self::HAS_MANY, 'PartyRole', 'Party_id', 'scopes' => array('enabled', 'current'));
        $relations['isSupplier'] = array(self::HAS_ONE, 'Role', array('Role_id' => 'id'), 'through' => 'currentPartyRoles', 'scopes' => 'SUPPLIER');
        $relations['paymentMethods'] = array(self::HAS_MANY, 'PartyPaymentMethod', 'Party_id', 'scopes' => array('active', 'current'));
        $relations['emailAddresses'] = array(self::HAS_MANY, 'PartyMail', 'Party_id', 'scopes' => array('active'));

        return $relations;
    }

    public function scopes() {
        $scopes = parent::scopes();
        $scopes['person'] = array('condition' => $this->getTableAlias(false, false) . '.person = 1');
        $scopes['company'] = array('condition' => $this->getTableAlias(false, false) . '.person = 0');
        return $scopes;
    }

    public function searchRelatedParties($relationship) {
        $criteria = new CDbCriteria();

        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        $criteria->mergeWith(array(
            'join' => 'LEFT JOIN PartyRelationship pr ON pr.Party_id = t.id',
            'condition' => 'pr.PartyRelationshipType_id = ' . PartyRelationshipType::model()->find('code = :code', array(':code' => $relationship))->id,
                )
        );
        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                    'pagination' => array('pageSize' => Yii::app()->user->getState('pageSize', Yii::app()->params['defaultPageSize'])),
                ));
    }

    public function search($company = null) {
        $criteria = new CDbCriteria();

        $criteria->compare('id', $this->id);
//        $criteria->compare('name', $this->name, true);
        if (!is_null($company))
            $criteria->scopes = ($company ? 'company' : 'person');
//        $criteria->mergeWith(array(
//            'join' => 'LEFT JOIN PartyRelationship pr ON pr.Party_id = t.id',
//            'condition' => 'pr.PartyRelationshipType_id = ' . PartyRelationshipType::model()->find('code = :code', array(':code' => PartyRelationshipType::CUSTOMER))->id,
//                )
//        );
//        $criteria->with = array(
//            'currentName' => array('together' => true),
//            'currentRfc' => array('together' => true,),
//        );

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                    'pagination' => array('pageSize' => Yii::app()->user->getState('pageSize', Yii::app()->params['defaultPageSize'])),
                ));
    }

    /**
     * tests if the party xml exists as a party
     *
     * @param SimpleXMLElement $xml
     */
    public function testParty(SimpleXMLElement $xml) {


    }
}