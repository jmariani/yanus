<?php

Yii::import('application.models._base.BaseCfdHasFileAsset');

class CfdHasFileAsset extends BaseCfdHasFileAsset {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function scopes() {
        $scopes = parent::scopes();
        $type = new CfdFileAssetTypeBehavior();
        foreach ($type->getList() as $key => $value) {
            $scopes[$key] = array('condition' => $this->getTableAlias(false, false) . '.type = "' . $key . '"');
        }
        return $scopes;
    }

}