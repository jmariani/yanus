<?php

Yii::import('application.models._base.BaseModelAttribute');

class ModelAttribute extends BaseModelAttribute {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function behaviors() {
        return array(
            'CurrentBehavior' => array('class' => 'components.CurrentBehavior')
        );
    }

}