<?php

Yii::import('application.models._base.BaseCustomsPermit');

class CustomsPermit extends BaseCustomsPermit {

    public $fancyDate;

    public function beforeSave() {
        $dt = date_create_from_format('d/m/Y', $this->dt);
        if ($dt)
            $this->dt = $dt->format('Y-m-d');
        return parent::beforeSave();
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function rules() {
        $rules = parent::rules();
        $rules[] = array('nbr', 'unique');
        return $rules;
    }

    public function search() {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('nbr', $this->nbr, true);
        $criteria->compare('dt', $this->dt, true);
        $criteria->compare('office', $this->office, true);

        $sort = new CSort();
        $sort->defaultOrder = 'cast(nbr as signed) ASC';
        $sort->attributes = array(
            'nbr' => array(
                'asc' => 'CAST(nbr as SIGNED) ASC',
                'desc' => 'CAST(nbr as SIGNED) DESC',
            ),
            '*',
        );

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                    'sort' => $sort,
                    'pagination' => array('pageSize' => Yii::app()->user->getState('pageSize', Yii::app()->params['defaultPageSize'])),
                ));
    }

}