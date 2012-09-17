<?php

Yii::import('application.models._base.BaseState');

class State extends BaseState {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function beforeSave() {
        // Code must be uppercase
        $this->code = trim(mb_strtoupper($this->code));
        $this->name = trim(mb_convert_case($this->name, MB_CASE_TITLE));
        return parent::beforeSave();
    }


}