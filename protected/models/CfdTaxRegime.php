<?php

Yii::import('application.models._base.BaseCfdTaxRegime');

class CfdTaxRegime extends BaseCfdTaxRegime {

    public function __toString() {
        return $this->name;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}