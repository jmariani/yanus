<?php

Yii::import('application.models._base.BaseSwTest');

class SwTest extends BaseSwTest {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function rules() {
        $workflowId = $this->swGetDefaultWorkflowId();
        return array(
            array('status', 'length', 'max' => 45),
            array('status', 'default', 'setOnEmpty' => true, 'value' => Yii::app()->swSource->getInitialNode($workflowId)),
            array('id, status', 'safe', 'on' => 'search'),
            array('status', 'SWValidator'),
        );
    }

    public function behaviors() {
        return array(
            'swBehavior' => array(
                'class' => 'application.extensions.simpleWorkflow.SWActiveRecordBehavior',
            ),
        );
    }

}