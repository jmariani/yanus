<?php

Yii::import('application.models._base.BaseCfdItem');

class CfdItem extends BaseCfdItem {

    const DEFAULT_UOM = 'PIEZA';

    public $chars = array();
    private $_customsPermits = array(); // Array of CustomsPermit::model

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function afterSave() {
        $this->saveChars();
        $this->saveCustomsPermits();
        return parent::afterSave();
    }
    public function beforeSave() {
        if (!$this->uom)
            $this->uom = self::DEFAULT_UOM;
        return parent::beforeSave();
    }

    public function getAttributesAssocArray() {
        $attr = array();

        $criteria = new CDbCriteria();
        $criteria->condition = 'CfdItem_id = :itemId';
        $criteria->params = array(':itemId' => $this->id);
        $criteria->order = 'code ASC';
        $itemAttrs = CfdItemAttribute::model()->findAll($criteria);
        foreach ($itemAttrs as $itemAttr) {
            $attr[$itemAttr->code] = $itemAttr->value;
        }
        return $attr;
    }

    public function gettotal() {
        return $this->qty * $this->unitPrice;
    }
    private function saveChars() {
        foreach ($this->chars as $code => $value) {
            $char = new CfdItemAttribute();
            $char->CfdItem_id = $this->id;
            $char->code = $code;
            $char->value = $value;
            $char->save();
        }
    }
    private function saveCustomsPermits() {
        foreach ($this->_customsPermits as $permit) {
            $char = new CfdItemHasCustomsPermit();
            $char->CfdItem_id = $this->id;
            $char->CustomsPermit_id = $permit->id;
            $char->save();
        }
    }
    public function setCustomsPermit(CustomsPermit $customPermit) {
        $this->_customsPermits[$customPermit->nbr] = $customPermit;
    }

}