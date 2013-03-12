<?php

Yii::import('application.models._base.BaseAnnotation');

class Annotation extends BaseAnnotation {

    public function beforeSave() {
        $this->md5 = md5($this->note);
        return parent::beforeSave();
    }

    public function behaviors() {
        return array(
            'CTimestampBehavior' => array(
                'class' => 'zii.behaviors.CTimestampBehavior',
                'createAttribute' => 'effDt',
                'updateAttribute' => null
            ),
        );
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}