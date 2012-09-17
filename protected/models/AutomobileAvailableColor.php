<?php

Yii::import('application.models._base.BaseAutomobileAvailableColor');

class AutomobileAvailableColor extends BaseAutomobileAvailableColor {

    const INTERIOR = 1;
    const EXTERIOR = 1;

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function beforeSave() {
        $this->active = !(!$this->availableForExterior && !$this->availableForInterior);
        return parent::beforeSave();
    }

    public function scopes() {
        $scopes = parent::scopes();
        $scopes['active'] = array('condition' => $this->getTableAlias(false, false) . '.active = 1');
        $scopes['availableAsInteriorColor'] = array('condition' => 'availableForInterior = 1');
        $scopes['availableAsExteriorColor'] = array('condition' => 'availableForExterior = 1');
        $scopes['orderByColorName'] = array('order' => 'color.name');
        return $scopes;
    }
}