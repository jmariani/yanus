<?php

Yii::import('application.models._base.BaseParty');

class Party extends BaseParty {

    public $defaultNameTemplate = '{firstName} {secondName} {surName} {motherName}';

    private $_pendingAttributes = array();

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * PHP getter magic method.
     * This method is overridden so that AR attributes can be accessed like properties.
     * @param string $name property name
     * @return mixed property value
     * @see getAttribute
     */
    public function __get($name) {
        try {
            return parent::__get($name);
        } catch (Exception $e) {
            foreach ($this->partyAttributes as $partyAttribute) {
                if ($partyAttribute->code == strtoupper($name)) {
                    return $partyAttribute->value;
                }
            }
            throw new CException($e->getMessage());
        }
    }

    public function __set($name, $value) {
        try {
            parent::__set($name, $value);
        } catch (Exception $e) {
            foreach ($this->partyAttributes as $partyAttribute) {
                if ($partyAttribute->code == strtoupper($name)) {
                    $partyAttribute->value = $value;
                    return;
                }
            }
            $partyAttribute = new PartyAttribute();
            $partyAttribute->code = strtoupper($name);
            $partyAttribute->value = $value;
            $this->_pendingAttributes[] = $partyAttribute;
        }
    }
    public function behaviors()
    {
        return array(
           'Type' => array(
                'class' => 'PartyTypeBehavior',
                'attribute' => 'type',
            ),
        );
    }

    public function getFullName() {
        if ($this->type == PartyTypeBehavior::COMPANY) {
            return $this->currentName->surName;
        } else {
            return trim($this->currentName->firstName) . ' ' .
                ($this->currentName->secondName ?:'') .
                trim($this->currentName->surName) .
                ($this->currentName->motherName ?:'');
        }
    }
    public function getRfc() {
        foreach ($this->currentAttributes as $currentAttribute) {
            if ($currentAttribute->code == 'RFC') {
                return $currentAttribute->value;
            }
        }
    }

    public function afterSave() {
        foreach ($this->partyAttributes as $partyAttribute) {
            $partyAttribute->save();
        }
        foreach ($this->_pendingAttributes as $partyAttribute) {
            $partyAttribute->Party_id = $this->id;
            $partyAttribute->save();
        }
        return parent::afterSave();
    }

    public function relations() {
        $relations = parent::relations();
        $relations['currentAttributes'] = array(self::HAS_MANY, 'PartyAttribute', 'Party_id', 'order' => 'effDt DESC', 'limit' => '1',
                'on' => 'currentAttributes.effDt <= NOW()');
        $relations['currentName'] = array(self::HAS_ONE, 'PartyName', 'Party_id', 'order' => 'effDt DESC',
                'on' => 'currentName.effDt <= NOW()');
        return $relations;
    }
}