<?php

/**
 * This is the model base class for the table "AddressType".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "AddressType".
 *
 * Columns in table "AddressType" available as properties of the model,
 * followed by relations of table "AddressType" available as properties of the model.
 *
 * @property integer $id
 * @property string $name
 * @property string $code
 *
 * @property CfdAddress[] $cfdAddresses
 */
abstract class BaseAddressType extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'AddressType';
	}

	public static function label($n = 1) {
        return Yii::t('app', 'Address Type|Address Types', $n);
	}

	public static function representingColumn() {
		return 'name';
	}

	public function rules() {
		return array(
			array('name, code', 'length', 'max'=>45),
			array('name, code', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, name, code', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'cfdAddresses' => array(self::HAS_MANY, 'CfdAddress', 'AddressType_id'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
                			'id' => yii::t('app', 'Id'),
                			'name' => yii::t('app', 'Name'),
                			'code' => yii::t('app', 'Code'),
                        			                        'cfdAddresses' => yii::t('app', 'Cfd Addresses'),
		);
	}


	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('name', $this->name, true);
		$criteria->compare('code', $this->code, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
                        'pagination' => array('pageSize' => Yii::app()->user->getState('pageSize', Yii::app()->params['defaultPageSize'])),
		));
	}
}