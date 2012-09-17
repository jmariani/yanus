<?php

/**
 * This is the model base class for the table "PartyIdentifier".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "PartyIdentifier".
 *
 * Columns in table "PartyIdentifier" available as properties of the model,
 * followed by relations of table "PartyIdentifier" available as properties of the model.
 *
 * @property integer $id
 * @property string $name
 * @property string $value
 * @property string $effDt
 * @property integer $Party_id
 *
 * @property Party $party
 */
abstract class BasePartyIdentifier extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'PartyIdentifier';
	}

	public static function label($n = 1) {
        return Yii::t('app', 'Party Identifier|Party Identifiers', $n);
	}

	public static function representingColumn() {
		return 'name';
	}

	public function rules() {
		return array(
			array('Party_id', 'required'),
			array('Party_id', 'numerical', 'integerOnly'=>true),
			array('name, value', 'length', 'max'=>45),
			array('effDt', 'safe'),
			array('name, value, effDt', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, name, value, effDt, Party_id', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'party' => array(self::BELONGS_TO, 'Party', 'Party_id'),
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
                			'value' => yii::t('app', 'Value'),
                			'effDt' => yii::t('app', 'Eff Dt'),
                        			                        'Party_id' => yii::t('app', 'Party'),
                        			                        'party' => yii::t('app', 'Party'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('name', $this->name, true);
		$criteria->compare('value', $this->value, true);
		$criteria->compare('effDt', $this->effDt, true);
		$criteria->compare('Party_id', $this->Party_id);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
                        'pagination' => array('pageSize' => Yii::app()->user->getState('pageSize', Yii::app()->params['defaultPageSize'])),
		));
	}
}