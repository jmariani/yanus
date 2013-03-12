<?php

Yii::import('application.models._base.BaseFileAsset');

class FileAsset extends BaseFileAsset {

    public function __toString() {
        return $this->name;
    }

    public function beforeSave() {
        $this->name = pathinfo($this->location, PATHINFO_BASENAME);
        return parent::beforeSave();
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

}