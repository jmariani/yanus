<?php

Yii::import('application.models._base.BaseName');

class Name extends BaseName {

    public function __toString() {
        return $this->name;
    }
    public function beforeValidate() {
        $this->md5 = $this->getMd5();
        return parent::beforeValidate();
    }

    public function behaviors() {
        return array(
            'CTimestampBehavior' => array(
                'class' => 'zii.behaviors.CTimestampBehavior',
                'createAttribute' => 'effDt',
                'updateAttribute' => null
            )
        );
    }

    public function getHash() {
        $hash = $this->name . '|';
        $hash .= $this->surName . '|';
        $hash .= $this->motherFamilyName . '|';
        $hash .= $this->firstName . '|';
        $hash .= $this->secondName . '|';
        return $hash;
    }

    public function getMd5() {
        return md5($this->getHash());
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function byMd5($md5) {
        $criteria = new CDbCriteria();
        $criteria->compare($this->getTableAlias(false, false) . '.md5', $md5);

        $criteria = $this->Owner->getDbCriteria()->mergeWith($criteria);
        return $this->Owner;
    }

    public function rules() {
        return array(
            array('md5', 'length', 'max' => 32),
            array('name, surName, motherFamilyName, firstName, secondName', 'safe'),
            array('name, surName, motherFamilyName, firstName, secondName, md5', 'default', 'setOnEmpty' => true, 'value' => null),
            array('id, name, surName, motherFamilyName, firstName, secondName, md5', 'safe', 'on' => 'search'),
        );
    }

    public function search() {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('surName', $this->surName, true);
        $criteria->compare('motherFamilyName', $this->motherFamilyName, true);
        $criteria->compare('firstName', $this->firstName, true);
        $criteria->compare('secondName', $this->secondName, true);
        $criteria->compare('md5', $this->md5, true);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                    'pagination' => array('pageSize' => Yii::app()->user->getState('pageSize', Yii::app()->params['defaultPageSize'])),
                ));
    }

}