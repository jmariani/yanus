<?php

Yii::import('application.models._base.BaseObjectHasFileAsset');

class ObjectHasFileAsset extends BaseObjectHasFileAsset {

    public function __toString() {
        return $this->fileAsset->name;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function rules() {
        return array(
            array('FileAsset_id', 'required'),
            array('FileAsset_id, objectId', 'numerical', 'integerOnly' => true),
            array('type, objectName', 'length', 'max' => 255),
            array('type, objectName, objectId', 'default', 'setOnEmpty' => true, 'value' => null),
            array('id, FileAsset_id, type, objectName, objectId', 'safe', 'on' => 'search'),
        );
    }

    public function scopes() {
        $scopes = parent::scopes();
        $models = yii::app()->db->getSchema()->getTableNames();
        // Create scopes for models.
        foreach ($models as $model) {
            // Will create a scope like TableName
            $scopes[$model] = array('condition' => $this->getTableAlias(false, false) . '.objectName = "' . $model . '"');
        }
        $types = new FileAssetTypeBehavior();
        foreach ($types->getList() as $key => $value) {
            $scopes[$key] = array('condition' => $this->getTableAlias(false, false) . '.type = "' . $key . '"');
        }
        return $scopes;
    }

}