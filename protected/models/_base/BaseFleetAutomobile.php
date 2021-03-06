<?php

/**
 * This is the model base class for the table "FleetAutomobile".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "FleetAutomobile".
 *
 * Columns in table "FleetAutomobile" available as properties of the model,
 * followed by relations of table "FleetAutomobile" available as properties of the model.
 *
 * @property integer $id
 * @property integer $Automobile_id
 * @property integer $AutomobileAvailableColor_id
 * @property string $serialNbr
 * @property string $engineNbr
 * @property string $currentLicensePlate
 * @property string $economicNbr
 * @property integer $currentMileage
 *
 * @property Automobile $automobile
 * @property AutomobileAvailableColor $automobileAvailableColor
 */
abstract class BaseFleetAutomobile extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'FleetAutomobile';
	}

	public static function label($n = 1) {
        return Yii::t('app', 'Fleet Automobile|Fleet Automobiles', $n);
	}

	public static function representingColumn() {
		return 'serialNbr';
	}

	public function rules() {
		return array(
			array('Automobile_id, AutomobileAvailableColor_id, serialNbr, engineNbr, currentLicensePlate', 'required'),
			array('Automobile_id, AutomobileAvailableColor_id, currentMileage', 'numerical', 'integerOnly'=>true),
			array('serialNbr, engineNbr, currentLicensePlate, economicNbr', 'length', 'max'=>45),
			array('economicNbr, currentMileage', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, Automobile_id, AutomobileAvailableColor_id, serialNbr, engineNbr, currentLicensePlate, economicNbr, currentMileage', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'automobile' => array(self::BELONGS_TO, 'Automobile', 'Automobile_id'),
			'automobileAvailableColor' => array(self::BELONGS_TO, 'AutomobileAvailableColor', 'AutomobileAvailableColor_id'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
                			'id' => yii::t('app', 'Id'),
                        			                        'Automobile_id' => yii::t('app', 'Automobile'),
                        			                        'AutomobileAvailableColor_id' => yii::t('app', 'Automobile Available Color'),
                			'serialNbr' => yii::t('app', 'Serial Nbr'),
                			'engineNbr' => yii::t('app', 'Engine Nbr'),
                			'currentLicensePlate' => yii::t('app', 'Current License Plate'),
                			'economicNbr' => yii::t('app', 'Economic Nbr'),
                			'currentMileage' => yii::t('app', 'Current Mileage'),
                        			                        'automobile' => yii::t('app', 'Automobile'),
                        			                        'automobileAvailableColor' => yii::t('app', 'Automobile Available Color'),
		);
	}

    public function defaultScope() {
        return array('order' => $this->getTableAlias(false, false) . '.' . BaseFleetAutomobile::representingColumn() . ' ASC');
    }

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('Automobile_id', $this->Automobile_id);
		$criteria->compare('AutomobileAvailableColor_id', $this->AutomobileAvailableColor_id);
		$criteria->compare('serialNbr', $this->serialNbr, true);
		$criteria->compare('engineNbr', $this->engineNbr, true);
		$criteria->compare('currentLicensePlate', $this->currentLicensePlate, true);
		$criteria->compare('economicNbr', $this->economicNbr, true);
		$criteria->compare('currentMileage', $this->currentMileage);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
                        'pagination' => array('pageSize' => Yii::app()->user->getState('pageSize', Yii::app()->params['defaultPageSize'])),
		));
	}
}