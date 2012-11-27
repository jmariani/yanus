<?php

Yii::import('application.models._base.BaseCfdItem');

class CfdItem extends BaseCfdItem {
    const DEFAULT_UOM = 'PIEZA';

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function beforeValidate() {
        if (!$this->uom)
            $this->uom = self::DEFAULT_UOM;
        return parent::beforeValidate();
    }

}