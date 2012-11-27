<?php

Yii::import('application.models._base.BaseCfdItemAttribute');

class CfdItemAttribute extends BaseCfdItemAttribute {

    public function behaviors() {
        $behaviors = parent::behaviors();
//        $behaviors['CTimestampBehavior'] = array(
//            'class' => 'zii.behaviors.CTimestampBehavior',
//            'createAttribute' => 'creationDt',
//            'updateAttribute' => 'updateDt',
//        );
        $behaviors['Code'] = array(
            'class' => 'CfdItemCodeBehavior',
            'attribute' => 'code',
        );
        return $behaviors;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function scopes() {
        $scopes = parent::scopes();
        $codes = new CfdItemCodeBehavior();
        foreach ($codes->getList() as $key => $value) {
            $scopes[$key] = array('condition' => $this->getTableAlias(false, false) . '.code = "' . $key . '"');
        }
        return $scopes;
    }

}