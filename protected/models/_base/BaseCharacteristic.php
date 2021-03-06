<?php

/**
 * This is the model base class for the table "Characteristic".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Characteristic".
 *
 * Columns in table "Characteristic" available as properties of the model,
 * and there are no model relations.
 *
 * @property integer $id
 * @property string $className
 * @property integer $objectId
 * @property string $code
 * @property string $value
 *
 */
abstract class BaseCharacteristic extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'Characteristic';
	}

	public static function label($n = 1) {
        return Yii::t('app', 'Characteristic|Characteristics', $n);
	}

	public static function representingColumn() {
		return 'className';
	}

	public function rules() {
		return array(
			array('objectId', 'numerical', 'integerOnly'=>true),
			array('className, code', 'length', 'max'=>45),
			array('value', 'safe'),
			array('className, objectId, code, value', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, className, objectId, code, value', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
                			'id' => yii::t('app', 'Id'),
                			'className' => yii::t('app', 'Class Name'),
                			'objectId' => yii::t('app', 'Object Id'),
                			'code' => yii::t('app', 'Code'),
                			'value' => yii::t('app', 'Value'),
		);
	}


	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('className', $this->className, true);
		$criteria->compare('objectId', $this->objectId);
		$criteria->compare('code', $this->code, true);
		$criteria->compare('value', $this->value, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
                        'pagination' => array('pageSize' => Yii::app()->user->getState('pageSize', Yii::app()->params['defaultPageSize'])),
		));
	}
}