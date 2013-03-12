<?php

Yii::import('application.models._base.BaseRole');

class Role extends BaseRole {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function byCode($code) {
        $criteria = new CDbCriteria();
        $criteria->compare($this->getTableAlias(false, false) . '.code', $code);

        $criteria = $this->getDbCriteria()->mergeWith($criteria);
        return $this;
    }

    public function byClass($class) {
        $criteria = new CDbCriteria();
        $criteria->compare($this->getTableAlias(false, false) . '.class', $class);

        $criteria = $this->getDbCriteria()->mergeWith($criteria);
        return $this;
    }

    public function scopes() {
        $scopes = parent::scopes();
//        $roles = Role::model()->findAll();
//        foreach ($roles as $role) {
//            $scopes[ucfirst($role->code)] = array('condition' => $this->getTableAlias(false, false) . ".code = '" . $role->code . "'");
//        }
        $models = yii::app()->db->getSchema()->getTableNames();
        foreach ($models as $model) {
            $scopes[$model] = array('condition' => $this->getTableAlias(false, false) . ".class = '" . $model . "'");
        }
        return $scopes;
    }

}