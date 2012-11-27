<?php

Yii::import('application.models._base.BaseFileAsset');

class FileAsset extends BaseFileAsset {

    public function __construct($scenario = 'insert', $values = null) {
        parent::__construct($scenario);
        $this->setAttributes($values);
    }

    public function __toString() {
        return $this->name;
    }
    public function behaviors() {
        $behaviors = parent::behaviors();
        $behaviors['CTimestampBehavior'] = array(
            'class' => 'zii.behaviors.CTimestampBehavior',
            'createAttribute' => 'creationDttm',
        );
        return $behaviors;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function defaultScope() {
        return array('order' => $this->getTableAlias(false, false) . '.' . BaseFileAsset::representingColumn() . ' ASC');
    }

    public function rules() {
        return array(
            array('name, location, creationDttm', 'safe'),
            array('name, location, creationDttm', 'default', 'setOnEmpty' => true, 'value' => null),
            array('id, name, location, creationDttm', 'safe', 'on' => 'search'),
//            array('creationDttm', 'default', 'value' => new CDbExpression('NOW()'), 'on' => 'insert'),
        );
    }

}