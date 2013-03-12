<?php

Yii::import('application.models._base.BaseCurrency');

class Currency extends BaseCurrency {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * byCode
     * Named scope to filter Currency by code
     * @param string code
     * @return Owner
     */
    public function byCode($code) {
        $criteria = new CDbCriteria();
        $criteria->compare('code', $code);
        $criteria = $this->getDbCriteria()->mergeWith($criteria);
        return $this;
    }

    public function search() {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('code', $this->code, true);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('plural', $this->plural, true);
        $criteria->compare('symbol', $this->symbol, true);
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