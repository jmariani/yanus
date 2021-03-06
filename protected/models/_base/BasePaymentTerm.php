<?php

/**
 * This is the model base class for the table "PaymentTerm".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "PaymentTerm".
 *
 * Columns in table "PaymentTerm" available as properties of the model,
 * followed by relations of table "PaymentTerm" available as properties of the model.
 *
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property integer $days
 *
 * @property Cfd[] $cfds
 */
abstract class BasePaymentTerm extends EAVActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'PaymentTerm';
	}

	public static function label($n = 1) {
        return Yii::t('app', 'Payment Term|Payment Terms', $n);
	}

	public static function representingColumn() {
		return 'code';
	}

	public function relations() {
		$relations = array(
			'cfds' => array(self::HAS_MANY, 'Cfd', 'PaymentTerm_id'),
		);
                return array_merge($relations, parent::relations());
	}
	public function rules() {
		return array(
			array('days', 'numerical', 'integerOnly'=>true),
			array('code', 'length', 'max'=>45),
			array('name', 'length', 'max'=>255),
			array('code, name, days', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, code, name, days', 'safe', 'on'=>'search'),
		);
	}
	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('code', $this->code, true);
		$criteria->compare('name', $this->name, true);
		$criteria->compare('days', $this->days);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
                        'pagination' => array('pageSize' => Yii::app()->user->getState('pageSize', Yii::app()->params['defaultPageSize'])),
		));
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
                			'id' => yii::t('app', 'Id'),
                			'code' => yii::t('app', 'Code'),
                			'name' => yii::t('app', 'Name'),
                			'days' => yii::t('app', 'Days'),
                        			                        'cfds' => yii::t('app', 'Cfds'),
		);
	}
}