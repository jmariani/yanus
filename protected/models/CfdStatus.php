<?php

Yii::import('application.models._base.BaseCfdStatus');

class CfdStatus extends BaseCfdStatus {
    const NEWCFD = 'NEW';
    const ERROR = 'ERROR';
    
    const SIGNED = 'SIGNED';
    const SEALED = 'SEALED';

    const VALID = 'VALID';

    const ISSUED = 'ISSUED';

    const DRAFT = 'DRAFT';

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function rules() {
        return array(
            array('name, code', 'length', 'max' => 45),
            array('name, code', 'default', 'setOnEmpty' => true, 'value' => null),
            array('id, name, code', 'safe', 'on' => 'search'),
        );
    }

}