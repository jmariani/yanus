<?php

/**
 * This is the model base class for the table "CfdDiscount".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "CfdDiscount".
 *
 * Columns in table "CfdDiscount" available as properties of the model,
 * followed by relations of table "CfdDiscount" available as properties of the model.
 *
 * @property integer $id
 * @property string $amt
 * @property string $reason
 * @property integer $Cfd_id
 *
 * @property Cfd $cfd
 */
abstract class BaseCfdDiscount extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'CfdDiscount';
	}

	public static function label($n = 1) {
        return Yii::t('app', 'Cfd Discount|Cfd Discounts', $n);
	}

	public static function representingColumn() {
		return 'amt';
	}

	public function rules() {
		return array(
			array('Cfd_id', 'required'),
			array('Cfd_id', 'numerical', 'integerOnly'=>true),
			array('amt', 'length', 'max'=>64),
			array('reason', 'safe'),
			array('amt, reason', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, amt, reason, Cfd_id', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'cfd' => array(self::BELONGS_TO, 'Cfd', 'Cfd_id'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
                			'id' => yii::t('app', 'Id'),
                			'amt' => yii::t('app', 'Amt'),
                			'reason' => yii::t('app', 'Reason'),
                        			                        'Cfd_id' => yii::t('app', 'Cfd'),
                        			                        'cfd' => yii::t('app', 'Cfd'),
		);
	}


	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('amt', $this->amt, true);
		$criteria->compare('reason', $this->reason, true);
		$criteria->compare('Cfd_id', $this->Cfd_id);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
                        'pagination' => array('pageSize' => Yii::app()->user->getState('pageSize', Yii::app()->params['defaultPageSize'])),
		));
	}
}