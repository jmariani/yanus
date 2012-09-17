<?php

/**
 * This is the model base class for the table "CustomsPermit".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "CustomsPermit".
 *
 * Columns in table "CustomsPermit" available as properties of the model,
 * followed by relations of table "CustomsPermit" available as properties of the model.
 *
 * @property integer $id
 * @property string $nbr
 * @property string $dt
 * @property string $office
 *
 * @property CfdItem[] $cfdItems
 * @property Cfd[] $cfds
 */
abstract class BaseCustomsPermit extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'CustomsPermit';
	}

	public static function label($n = 1) {
        return Yii::t('app', 'Customs Permit|Customs Permits', $n);
	}

	public static function representingColumn() {
		return 'nbr';
	}

	public function rules() {
		return array(
			array('nbr, dt', 'required'),
			array('nbr', 'length', 'max'=>45),
			array('office', 'safe'),
			array('office', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, nbr, dt, office', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'cfdItems' => array(self::MANY_MANY, 'CfdItem', 'CfdItem_has_CustomsPermit(CustomsPermit_id, CfdItem_id)'),
			'cfds' => array(self::MANY_MANY, 'Cfd', 'Cfd_has_CustomsPermit(CustomsPermit_id, Cfd_id)'),
		);
	}

	public function pivotModels() {
		return array(
			'cfdItems' => 'CfdItemHasCustomsPermit',
			'cfds' => 'CfdHasCustomsPermit',
		);
	}

	public function attributeLabels() {
		return array(
                			'id' => yii::t('app', 'Id'),
                			'nbr' => yii::t('app', 'Nbr'),
                			'dt' => yii::t('app', 'Dt'),
                			'office' => yii::t('app', 'Office'),
                        			                        'cfdItems' => yii::t('app', 'Cfd Items'),
                        			                        'cfds' => yii::t('app', 'Cfds'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('nbr', $this->nbr, true);
		$criteria->compare('dt', $this->dt, true);
		$criteria->compare('office', $this->office, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}