<?php

Yii::import('application.models._base.BaseIncomingInvoiceInterfaceFileStatus');

class IncomingInvoiceInterfaceFileStatus extends BaseIncomingInvoiceInterfaceFileStatus {

    const PENDING = 'PENDING';  // INITIAL
    const PROCESSING = 'PROCESSING'; // TRANSITIONAL
    const PROCESSED = 'PROCESSED'; // FINAL
    const ERROR = 'ERROR'; // FINAL

    // |---------------------|
    // |TRANSITIONS          |
    // |---------------------|
    // |FROM      |TO        |
    // |----------|----------|
    // |PENDING   |PROCESSING|
    // |PENDING   |ERROR     |
    // |PROCESSING|PROCESSED |
    // |PROCESSING|ERROR     |
    // |PROCESSED |PENDING   |
    // |ERROR     |PENDING   |
    // |----------|----------|

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