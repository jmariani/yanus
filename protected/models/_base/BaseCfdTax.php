<?php

/**
 * This is the model base class for the table "CfdTax".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "CfdTax".
 *
 * Columns in table "CfdTax" available as properties of the model,
 * followed by relations of table "CfdTax" available as properties of the model.
 *
 * @property integer $id
 * @property integer $Cfd_id
 * @property string $name
 * @property string $rate
 * @property string $amt
 *
 * @property Cfd $cfd
 */
abstract class BaseCfdTax extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'CfdTax';
	}

	public static function label($n = 1) {
        return Yii::t('app', 'Cfd Tax|Cfd Taxes', $n);
	}

	public static function representingColumn() {
		return 'name';
	}

	public function rules() {
		return array(
			array('Cfd_id, name, rate, amt', 'required'),
			array('Cfd_id', 'numerical', 'integerOnly'=>true),
			array('rate, amt', 'length', 'max'=>64),
			array('id, Cfd_id, name, rate, amt', 'safe', 'on'=>'search'),
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
                        			                        'Cfd_id' => yii::t('app', 'Cfd'),
                			'name' => yii::t('app', 'Name'),
                			'rate' => yii::t('app', 'Rate'),
                			'amt' => yii::t('app', 'Amt'),
                        			                        'cfd' => yii::t('app', 'Cfd'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('Cfd_id', $this->Cfd_id);
		$criteria->compare('name', $this->name, true);
		$criteria->compare('rate', $this->rate, true);
		$criteria->compare('amt', $this->amt, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}