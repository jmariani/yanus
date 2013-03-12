<?php

Yii::import('application.models._base.BaseCountry');

class Country extends BaseCountry {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function search() {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('code', $this->code, true);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('active', $this->active);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                    'pagination' => array('pageSize' => Yii::app()->user->getState('pageSize', Yii::app()->params['defaultPageSize'])),
                    'sort' => array(
                        'defaultOrder' => array(
                            'code' => CSort::SORT_ASC
                        )
                    )
                ));
    }

}