<?php

/**
 * This is the model base class for the table "PartyPhoneLocator".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "PartyPhoneLocator".
 *
 * Columns in table "PartyPhoneLocator" available as properties of the model,
 * followed by relations of table "PartyPhoneLocator" available as properties of the model.
 *
 * @property integer $id
 * @property integer $Party_id
 * @property string $value
 * @property string $effDt
 *
 * @property Party $party
 */
abstract class BasePartyPhoneLocator extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'PartyPhoneLocator';
	}

	public static function label($n = 1) {
        return Yii::t('app', 'Party Phone Locator|Party Phone Locators', $n);
	}

	public static function representingColumn() {
		return 'value';
	}

	public function rules() {
		return array(
			array('Party_id', 'required'),
			array('Party_id', 'numerical', 'integerOnly'=>true),
			array('value', 'length', 'max'=>45),
			array('effDt', 'safe'),
			array('value, effDt', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, Party_id, value, effDt', 'safe', 'on'=>'search'),
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
                        			                        'Party_id' => yii::t('app', 'Party'),
                			'value' => yii::t('app', 'Value'),
                			'effDt' => yii::t('app', 'Eff Dt'),
                        			                        'party' => yii::t('app', 'Party'),
		);
	}

    public function defaultScope() {
        return array('order' => $this->getTableAlias(false, false) . '.' . BasePartyPhoneLocator::representingColumn() . ' ASC');
    }

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('Party_id', $this->Party_id);
		$criteria->compare('value', $this->value, true);
		$criteria->compare('effDt', $this->effDt, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
                        'pagination' => array('pageSize' => Yii::app()->user->getState('pageSize', Yii::app()->params['defaultPageSize'])),
		));
	}
}