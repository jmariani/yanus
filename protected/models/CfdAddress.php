<?php

Yii::import('application.models._base.BaseCfdAddress');

class CfdAddress extends BaseCfdAddress {

    public function behaviors() {
        $behaviors = parent::behaviors();
        $behaviors['Type'] = array(
            'class' => 'AddressTypeBehavior',
            'attribute' => 'type',
        );
        return $behaviors;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function scopes() {
        $scopes = parent::scopes();
        $type = new AddressTypeBehavior();
        foreach ($type->getList() as $key => $value) {
            $scopes[$key] = array('condition' => $this->getTableAlias(false, false) . '.type = "' . $key . '"');
        }
        return $scopes;
    }

}