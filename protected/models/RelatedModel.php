<?php

Yii::import('application.models._base.BaseRelatedModel');

class RelatedModel extends BaseRelatedModel {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function rules() {
        return array(
            array('parentId, childId', 'numerical', 'integerOnly' => true),
            array('parentModel, childModel', 'length', 'max' => 255),
            array('cDttm', 'safe'),
            array('parentModel, parentId, childModel, childId, cDttm', 'default', 'setOnEmpty' => true, 'value' => null),
            array('id, parentModel, parentId, childModel, childId, cDttm', 'safe', 'on' => 'search'),
            array('cDttm', 'default', 'value' => new CDbExpression('NOW()'), 'on' => 'insert')
        );
    }

    public function scopes() {
        $scopes = parent::scopes();
        $models = yii::app()->db->getSchema()->getTableNames();
        // Creates RelatedModel scopes
        foreach ($models as $model) {
            $scopes[$model . 'AsParent'] = array('condition' => $this->getTableAlias(false, false) . '.ParentModel = "' . $model . '"');
            $scopes[$model . 'AsChild'] = array('condition' => $this->getTableAlias(false, false) . '.ChildModel = "' . $model . '"');
        }
        return $scopes;
    }
}