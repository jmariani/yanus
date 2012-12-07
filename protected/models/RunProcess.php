<?php

Yii::import('application.models._base.BaseRunProcess');

class RunProcess extends BaseRunProcess {

    const STATUS_RUNNING = 'running';
    const STATUS_SUCCESS = 'success';
    const STATUS_ERROR = 'error';

    public function behaviors() {
        $behaviors = parent::behaviors();
        $behaviors['swBehavior'] = array('class' => 'application.extensions.simpleWorkflow.SWActiveRecordBehavior', 'transitionBeforeSave' => true, 'enableEvent' => false);
        return $behaviors;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function rules() {
        return array(
            array('name', 'length', 'max' => 255),
            array('status', 'length', 'max' => 45),
            array('startDttm, endDttm, msg', 'safe'),
            array('startDttm', 'default', 'value' => new CDbExpression('NOW()'), 'on' => 'insert'),
            array('name, status, endDttm, msg', 'default', 'setOnEmpty' => true, 'value' => null),
            array('id, name, status, startDttm, endDttm, msg', 'safe', 'on' => 'search'),
            array('status',  'SWValidator','enableSwValidation'=>true,)
        );
    }

}