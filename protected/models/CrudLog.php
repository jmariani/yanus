<?php

Yii::import('application.models._base.BaseCrudLog');

class CrudLog extends BaseCrudLog {

    public function behaviors() {
        return array(
            'CTimestampBehavior' => array(
                'class' => 'zii.behaviors.CTimestampBehavior',
                'createAttribute' => 'effDt',
            )
        );
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function rules() {
        return array(
            array('modelId', 'numerical', 'integerOnly' => true),
            array('model', 'length', 'max' => 255),
            array('action', 'length', 'max' => 45),
            array('effDt', 'safe'),
            array('model, modelId, action, effDt', 'default', 'setOnEmpty' => true, 'value' => null),
            array('id, model, modelId, action, effDt', 'safe', 'on' => 'search'),
        );
    }

    public function search() {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('model', $this->model, true);
        $criteria->compare('modelId', $this->modelId);
        $criteria->compare('action', $this->action, true);
        $criteria->compare('effDt', $this->effDt, true);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                    'pagination' => array('pageSize' => Yii::app()->user->getState('pageSize', Yii::app()->params['defaultPageSize'])),
                ));
    }

}