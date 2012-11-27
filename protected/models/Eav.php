<?php

Yii::import('application.models._base.BaseEav');

class Eav extends BaseEav {

    public function __toString() {
        return $this->value;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

//    public function defaultScope() {
//        return array('order' => $this->getTableAlias(false, false) . '.' . BaseEav::representingColumn() . ' ASC');
//    }

    public function rules() {
        return array(
            array('objectId', 'numerical', 'integerOnly' => true),
            array('objectName, code', 'length', 'max' => 255),
            array('value', 'safe'),
            array('objectName, objectId, code, value', 'default', 'setOnEmpty' => true, 'value' => null),
            array('id, objectName, objectId, code, value', 'safe', 'on' => 'search'),
        );
    }

    public function scopes() {
        $scopes = parent::scopes();
        $codes = EavCode::model()->findAll();
        $models = yii::app()->db->getSchema()->getTableNames();
        // Creates EAVCode scopes
        foreach ($codes as $code) {
            foreach ($models as $model) {
                // Will create a scope like TableNameAttribute
                // PartysupplierCode
                $scopes[$model . $code] = array('condition' => $this->getTableAlias(false, false) . '.code = "' . $code->code . '" and ' .
                    $this->getTableAlias(false, false) . '.objectName = "' . $model . '"');
            }
            $scopes['EAV' . ucfirst($code->code)] = array('condition' => $this->getTableAlias(false, false) . '.code = "' . strtolower($code->code) . '"');
        }
        return $scopes;
    }
}