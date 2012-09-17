<?php

Yii::import('application.models._base.BaseEntity');

class Entity extends BaseEntity {

    private $_attributes = array();    // attribute name => attribute value

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
        switch ($name) {
            case 'id':
            case 'isNewRecord':
            case 'class':
                return parent::__get($name);
                break;
            default:
            if (!isset($this->_attributes[$name]))
                $this->_attributes[$name] = null;
            return $this->_attributes[$name];
        }
    }

    /**
     * PHP setter magic method.
     * This method is overridden so that AR attributes can be accessed like properties.
     * @param string $name property name
     * @param mixed $value property value
     */
    public function __set($name, $value) {
        switch ($name) {
            case 'id':
            case 'isNewRecord':
            case 'class':
                parent::__set($name, $value);
                break;
            default:
                $this->_attributes[$name] = $value;
        }
    }

    public function afterFind() {
        // Load all attributes for this id.
        error_log('afterFind $this->id' . $this->id);
        $eaves = Eav::model()->findAll('Entity_id = :entity_id', array(':entity_id' => $this->id));
        foreach ($eaves as $eav) {
            $this->_attributes[$eav->attribute] = $eav->value;
        }
        return parent::afterFind();
    }

    public function afterSave() {
        foreach ($this->_attributes as $attributeName => $attributeValue) {
            if ($attributeName != 'id') {
                $eav = new Eav();
                $eav->Entity_id = $this->id;
                $eav->attribute = $attributeName;
                $eav->value = $attributeValue;
                $eav->effDt = new CDbExpression('NOW()');
                $eav->save();
            }
        }
        return parent::afterSave();
    }

    public function beforeSave() {
        if ($this->isNewRecord) {
            $this->class = __CLASS__;
        }
        return parent::beforeSave();
    }

    public function rules() {
        $rules = parent::rules();
        $rules[] = array('name', 'required');
        return $rules;
    }

}