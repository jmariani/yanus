<?php

Yii::import('application.models._base.BaseAutomobileBodyStyle');

class AutomobileBodyStyle extends BaseAutomobileBodyStyle {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function getDefault() {
        return 'SUV';
    }
}