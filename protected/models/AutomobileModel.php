<?php

Yii::import('application.models._base.BaseAutomobileModel');

class AutomobileModel extends BaseAutomobileModel {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function listModelMaker() {
        $listData = array();
        $models = AutomobileModel::model()->with('automobileMaker')->findAll(array('order' => 'automobileMaker.name, t.name'));
        foreach ($models as $model) {
            $text = $model->name;
            $listData[$model->id] = $model->automobileMaker->name . ' ' . $model->name;
        }
        return $listData;
    }

    public function getMakerModel() {
        return $this->automobileMaker->name . ' ' . $this->name;
    }
}