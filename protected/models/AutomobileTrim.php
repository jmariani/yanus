<?php

Yii::import('application.models._base.BaseAutomobileTrim');

class AutomobileTrim extends BaseAutomobileTrim {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function scopes() {
        $scopes = parent::scopes();
        $scopes['orderByMakerModelName'] = array('order' => 'automobileMaker.name, automobileModel.name, t.name');
        return $scopes;
    }
    public function getMakerModelTrim() {
        return $this->automobileModel->automobileMaker->name . ' ' . $this->automobileModel->name . ' ' . $this->name;
    }

    public function listModelMakerTrim() {
        $models = AutomobileTrim::model()->with(array('automobileModel', 'automobileModel.automobileMaker'))
                ->findAll(array('order' => 'automobileMaker.name, automobileModel.name, t.name'));
        $listData = array();
        foreach ($models as $model) {
            $text = $model->name;
            $listData[$model->id] = $model->automobileModel->automobileMaker->name . ' ' . $model->automobileModel->name . ' ' . $model->name;
        }
        return $listData;
    }

}