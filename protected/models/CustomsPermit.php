<?php

Yii::import('application.models._base.BaseCustomsPermit');

class CustomsPermit extends BaseCustomsPermit {

    public $fancyDate;

    public function beforeSave() {
        $dt = date_create_from_format('d/m/Y', $this->dt);
        $this->dt = $dt->format('Y-m-d');
        return parent::beforeSave();
    }
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function search() {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('nbr', $this->nbr, true);
        $criteria->compare('dt', $this->dt, true);
        $criteria->compare('office', $this->office, true);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                    'sort' => array(
                        'defaultOrder' => array(
                            'nbr' => true
                        ),
//                        'attributes' => array(
//                            'nbr',
//                            'dttm',
//                            'status',
//                            'customerSearch' => array(
//                                'asc' => 'crfc.value ASC',
//                                'desc' => 'crfc.value DESC',
//                            ),
//                            'vendorSearch' => array(
//                                'asc' => 'vrfc.value ASC',
//                                'desc' => 'vrfc.value DESC',
//                            ),
//                            'total' => array(
//                                'asc' => 'total ASC',
//                                'desc' => 'total DESC'
//                            )
//                        ),
                    ),
                    'pagination' => array('pageSize' => Yii::app()->user->getState('pageSize', Yii::app()->params['defaultPageSize'])),
                ));
    }

//        return new CActiveDataProvider($this,
//                        array(
//                            'criteria' => $criteria,
//                            'sort' => array(
//                                'defaultOrder' => array(
//                                    'dttm' => true
//                                ),
//                                'attributes' => array(
//                                    'invoice',
//                                    'dttm',
//                                    'status',
//                                    'customerSearch' => array(
//                                        'asc' => 'crfc.value ASC',
//                                        'desc' => 'crfc.value DESC',
//                                    ),
//                                    'vendorSearch' => array(
//                                        'asc' => 'vrfc.value ASC',
//                                        'desc' => 'vrfc.value DESC',
//                                    ),
//                                    'total' => array(
//                                        'asc' => 'total ASC',
//                                        'desc' => 'total DESC'
//                                    )
//                                ),
//                            ),
//                ));
}