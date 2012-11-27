<?php

/**
 * This is the model base class for the table "Address".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Address".
 *
 * Columns in table "Address" available as properties of the model,
 * followed by relations of table "Address" available as properties of the model.
 *
 * @property integer $id
 * @property string $street
 * @property string $extNbr
 * @property string $intNbr
 * @property string $neighbourhood
 * @property string $city
 * @property string $municipality
 * @property string $state
 * @property string $country
 * @property string $zipCode
 * @property integer $Country_id
 * @property integer $State_id
 * @property string $md5
 *
 * @property Country $country0
 * @property State $state0
 * @property CfdAddress[] $cfdAddresses
 * @property PartyAddress[] $partyAddresses
 */
abstract class BaseAddress extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'Address';
	}

	public static function label($n = 1) {
        return Yii::t('app', 'Address|Addresses', $n);
	}

	public static function representingColumn() {
		return 'street';
	}

	public function rules() {
		return array(
			array('Country_id, State_id', 'numerical', 'integerOnly'=>true),
			array('zipCode', 'length', 'max'=>45),
			array('md5', 'length', 'max'=>32),
			array('street, extNbr, intNbr, neighbourhood, city, municipality, state, country', 'safe'),
			array('street, extNbr, intNbr, neighbourhood, city, municipality, state, country, zipCode, Country_id, State_id, md5', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, street, extNbr, intNbr, neighbourhood, city, municipality, state, country, zipCode, Country_id, State_id, md5', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'country0' => array(self::BELONGS_TO, 'Country', 'Country_id'),
			'state0' => array(self::BELONGS_TO, 'State', 'State_id'),
			'cfdAddresses' => array(self::HAS_MANY, 'CfdAddress', 'Address_id'),
			'partyAddresses' => array(self::HAS_MANY, 'PartyAddress', 'Address_id'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
                			'id' => yii::t('app', 'Id'),
                			'street' => yii::t('app', 'Street'),
                			'extNbr' => yii::t('app', 'Ext Nbr'),
                			'intNbr' => yii::t('app', 'Int Nbr'),
                			'neighbourhood' => yii::t('app', 'Neighbourhood'),
                			'city' => yii::t('app', 'City'),
                			'municipality' => yii::t('app', 'Municipality'),
                			'state' => yii::t('app', 'State'),
                			'country' => yii::t('app', 'Country'),
                			'zipCode' => yii::t('app', 'Zip Code'),
                        			                        'Country_id' => yii::t('app', 'Country'),
                        			                        'State_id' => yii::t('app', 'State'),
                			'md5' => yii::t('app', 'Md5'),
                        			                        'country0' => yii::t('app', 'Country0'),
                        			                        'state0' => yii::t('app', 'State0'),
                        			                        'cfdAddresses' => yii::t('app', 'Cfd Addresses'),
                        			                        'partyAddresses' => yii::t('app', 'Party Addresses'),
		);
	}


	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('street', $this->street, true);
		$criteria->compare('extNbr', $this->extNbr, true);
		$criteria->compare('intNbr', $this->intNbr, true);
		$criteria->compare('neighbourhood', $this->neighbourhood, true);
		$criteria->compare('city', $this->city, true);
		$criteria->compare('municipality', $this->municipality, true);
		$criteria->compare('state', $this->state, true);
		$criteria->compare('country', $this->country, true);
		$criteria->compare('zipCode', $this->zipCode, true);
		$criteria->compare('Country_id', $this->Country_id);
		$criteria->compare('State_id', $this->State_id);
		$criteria->compare('md5', $this->md5, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
                        'pagination' => array('pageSize' => Yii::app()->user->getState('pageSize', Yii::app()->params['defaultPageSize'])),
		));
	}
}