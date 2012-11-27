<?php

Yii::import('application.models._base.BasePartyLocator');

class PartyLocator extends BasePartyLocator {

    public function __toString() {
        switch ($this->class) {
            case 'phone':
                return $this->phone->value;
                break;
            default:
                return yii::t('Undefined class "{class}"', array('{class}' => $this->class));
        }
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function behaviors() {
        return array(
            'class' => array(
                'class' => 'PartyLocatorClassBehavior',
                'attribute' => 'class',
            ),
            'type' => array(
                'class' => 'PartyLocatorTypeBehavior',
                'attribute' => 'type',
            ),
            'CurrentBehavior' => array('class' => 'ext.CurrentBehavior'),
        );
    }

//    public function defaultScope() {
//        return array('order' => $this->getTableAlias(false, false) . '.' . BasePartyLocator::representingColumn() . ' ASC');
//    }

    public function relations() {
        $relations = array();

        $relations['phone'] = array(self::BELONGS_TO, 'PhoneNbr', 'objectId');

//        $partyLocatorType = new PartyLocatorTypeBehavior();

//        foreach ($partyLocatorType->getList() as $key => $value) {
//                    $relations[CActiveRecord::generateAttributeLabel($key)] = array(self::BELONGS_TO, 'PhoneNbr', 'objectId',
//                'condition' => $this->getTableAlias(false, false) . '.type = "' . $key . '"'
//        }

//        'phoneNbr' => array(self::BELONGS_TO, 'PhoneNbr', 'PhoneNbr_id'),
//        $relations['WithHoldings'] = array(self::HAS_MANY, 'CfdTax', 'Cfd_id', 'on' => 'WithHoldings.local = 0 and WithHoldings.withHolding = 1');
//
//        $partyType = new CfdPartyTypeBehavior();
//        foreach ($partyType->getList() as $key => $value) {
//            $relations['CfdHas' . ucfirst($key) . 'Party'] = array(self::HAS_ONE, 'CfdHasParty', 'Cfd_id', 'scopes' => $key);
//            $relations[ucfirst($key) . 'Party'] = array(self::HAS_ONE, 'Party', array('Party_id' => 'id'), 'through' => 'CfdHas' . ucfirst($key) . 'Party');
//        }
//
//        $assetType = new CfdFileAssetTypeBehavior();
//        foreach ($assetType->getList() as $key => $value) {
//            $relations['CfdHas' . ucfirst($key) . 'FileAsset'] = array(self::HAS_ONE, 'CfdHasFileAsset', 'Cfd_id', 'scopes' => $key);
//            $relations[ucfirst($key) . 'File'] = array(self::HAS_ONE, 'FileAsset', array('FileAsset_id' => 'id'), 'through' => 'CfdHas' . ucfirst($key) . 'FileAsset');
//        }
//
//        $addressType = new AddressTypeBehavior();
//        foreach ($addressType->getList() as $key => $value) {
//            $relations['CfdHas' . ucfirst($key) . 'Address'] = array(self::HAS_ONE, 'CfdAddress', 'Cfd_id', 'scopes' => $key);
//            $relations[ucfirst($key) . 'Address'] = array(self::HAS_ONE, 'Address', array('Address_id' => 'id'), 'through' => 'CfdHas' . ucfirst($key) . 'Address');
//        }
//
        return array_merge($relations, parent::relations());
    }

    public function rules() {
        return array(
            array('Party_id', 'required'),
            array('Party_id, objectId', 'numerical', 'integerOnly' => true),
            array('class, type', 'length', 'max' => 255),
            array('comment, effDt', 'safe'),
            array('class, type, objectId, comment', 'default', 'setOnEmpty' => true, 'value' => null),
            array('id, Party_id, class, type, objectId, comment, effDt', 'safe', 'on' => 'search'),
            array('effDt', 'default', 'setOnEmpty' => true, 'value' => new CDbExpression('NOW()')),
        );
    }

    public function scopes() {
        $scopes = parent::scopes();
        $class = new PartyLocatorClassBehavior();
        $type = new PartyLocatorTypeBehavior();
        foreach ($type->getList() as $typeKey => $typeValue) {
            // This will create a scope like Primary, Billto, etc.
            $scopes[CActiveRecord::generateAttributeLabel($typeKey)] = array(
                'condition' => $this->getTableAlias(false, false) . '.type = "' . $typeKey . '"');
        }
        foreach ($class->getList() as $classKey => $classValue) {
            // This will create a scope like Phone, Address, etc.
            $scopes[CActiveRecord::generateAttributeLabel($classKey)] = array(
                'condition' => $this->getTableAlias(false, false) . '.class = "' . $classKey . '"');
        }
        foreach ($type->getList() as $typeKey => $typeValue) {
            foreach ($class->getList() as $classKey => $classValue) {
                // This will create a scope like primaryPhone, primaryAddress, billToAddress, etc.
                $scopes[$typeKey . CActiveRecord::generateAttributeLabel($classKey)] = array(
                    'condition' => $this->getTableAlias(false, false) . '.type = "' . $typeKey . '" and ' .
                    $this->getTableAlias(false, false) . '.class = "' . $classKey . '"');
            }
        }
        return $scopes;
    }
}