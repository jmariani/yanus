<?php

//Yii::import('application.models._base.BaseEntity');

class EntityType extends Entity {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function rules() {
        $rules = parent::rules();
        $rules[] = array('name', 'required');
        return $rules;
    }

}