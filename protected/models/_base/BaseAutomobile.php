<?php

/**
 * This is the model base class for the table "Automobile".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Automobile".
 *
 * Columns in table "Automobile" available as properties of the model,
 * followed by relations of table "Automobile" available as properties of the model.
 *
 * @property integer $id
 * @property string $name
 * @property integer $yearMake
 * @property integer $AutomobileTrim_id
 * @property integer $Country_id
 * @property integer $AutomobileBodyStyle_id
 * @property integer $EngineLocation_id
 * @property integer $EngineType_id
 * @property integer $cylinders
 * @property integer $engineDisplacementCc
 * @property integer $engineBoreMm
 * @property integer $engineStrokeMm
 * @property integer $engineValvesPerCylinder
 * @property integer $engineMaxPowerHp
 * @property integer $engineMaxTorqueNm
 * @property integer $engineCompressionRatio
 * @property integer $EngineFuel_id
 * @property integer $AutomobileDrive_id
 * @property integer $GearboxTransmission_id
 * @property string $topSpeedKph
 * @property string $zeroHundredKphSec
 * @property integer $doors
 * @property integer $seats
 * @property integer $SeatCover_id
 * @property string $weightKg
 * @property string $lengthMm
 * @property string $widthMm
 * @property string $heightMm
 * @property string $wheelbaseMm
 * @property string $fuelEconomyCityLKm
 * @property string $fuelEconomyHwyLKm
 * @property string $fuelEconomyMixedLKm
 * @property string $fuelCapacityLts
 * @property integer $airConditioning
 * @property integer $serviceEveryKm
 * @property integer $serviceEveryMonth
 *
 * @property GearboxTransmission $gearboxTransmission
 * @property SeatCover $seatCover
 * @property EngineFuel $engineFuel
 * @property AutomobileBodyStyle $automobileBodyStyle
 * @property AutomobileDrive $automobileDrive
 * @property AutomobileTrim $automobileTrim
 * @property Country $country
 * @property EngineLocation $engineLocation
 * @property EngineType $engineType
 * @property AutomobileAvailableColor[] $automobileAvailableColors
 * @property FleetAutomobile[] $fleetAutomobiles
 */
abstract class BaseAutomobile extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'Automobile';
	}

	public static function label($n = 1) {
        return Yii::t('app', 'Automobile|Automobiles', $n);
	}

	public static function representingColumn() {
		return 'name';
	}

	public function rules() {
		return array(
			array('yearMake, AutomobileTrim_id, Country_id, AutomobileBodyStyle_id, EngineLocation_id, EngineType_id, EngineFuel_id, AutomobileDrive_id, GearboxTransmission_id, SeatCover_id', 'required'),
			array('yearMake, AutomobileTrim_id, Country_id, AutomobileBodyStyle_id, EngineLocation_id, EngineType_id, cylinders, engineDisplacementCc, engineBoreMm, engineStrokeMm, engineValvesPerCylinder, engineMaxPowerHp, engineMaxTorqueNm, engineCompressionRatio, EngineFuel_id, AutomobileDrive_id, GearboxTransmission_id, doors, seats, SeatCover_id, airConditioning, serviceEveryKm, serviceEveryMonth', 'numerical', 'integerOnly'=>true),
			array('topSpeedKph, zeroHundredKphSec, weightKg, lengthMm, widthMm, heightMm, wheelbaseMm, fuelEconomyCityLKm, fuelEconomyHwyLKm, fuelEconomyMixedLKm, fuelCapacityLts', 'length', 'max'=>10),
			array('name', 'safe'),
			array('name, cylinders, engineDisplacementCc, engineBoreMm, engineStrokeMm, engineValvesPerCylinder, engineMaxPowerHp, engineMaxTorqueNm, engineCompressionRatio, topSpeedKph, zeroHundredKphSec, doors, seats, weightKg, lengthMm, widthMm, heightMm, wheelbaseMm, fuelEconomyCityLKm, fuelEconomyHwyLKm, fuelEconomyMixedLKm, fuelCapacityLts, airConditioning, serviceEveryKm, serviceEveryMonth', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, name, yearMake, AutomobileTrim_id, Country_id, AutomobileBodyStyle_id, EngineLocation_id, EngineType_id, cylinders, engineDisplacementCc, engineBoreMm, engineStrokeMm, engineValvesPerCylinder, engineMaxPowerHp, engineMaxTorqueNm, engineCompressionRatio, EngineFuel_id, AutomobileDrive_id, GearboxTransmission_id, topSpeedKph, zeroHundredKphSec, doors, seats, SeatCover_id, weightKg, lengthMm, widthMm, heightMm, wheelbaseMm, fuelEconomyCityLKm, fuelEconomyHwyLKm, fuelEconomyMixedLKm, fuelCapacityLts, airConditioning, serviceEveryKm, serviceEveryMonth', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'gearboxTransmission' => array(self::BELONGS_TO, 'GearboxTransmission', 'GearboxTransmission_id'),
			'seatCover' => array(self::BELONGS_TO, 'SeatCover', 'SeatCover_id'),
			'engineFuel' => array(self::BELONGS_TO, 'EngineFuel', 'EngineFuel_id'),
			'automobileBodyStyle' => array(self::BELONGS_TO, 'AutomobileBodyStyle', 'AutomobileBodyStyle_id'),
			'automobileDrive' => array(self::BELONGS_TO, 'AutomobileDrive', 'AutomobileDrive_id'),
			'automobileTrim' => array(self::BELONGS_TO, 'AutomobileTrim', 'AutomobileTrim_id'),
			'country' => array(self::BELONGS_TO, 'Country', 'Country_id'),
			'engineLocation' => array(self::BELONGS_TO, 'EngineLocation', 'EngineLocation_id'),
			'engineType' => array(self::BELONGS_TO, 'EngineType', 'EngineType_id'),
			'automobileAvailableColors' => array(self::HAS_MANY, 'AutomobileAvailableColor', 'Automobile_id'),
			'fleetAutomobiles' => array(self::HAS_MANY, 'FleetAutomobile', 'Automobile_id'),
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
                			'yearMake' => yii::t('app', 'Year Make'),
                        			                        'AutomobileTrim_id' => yii::t('app', 'Automobile Trim'),
                        			                        'Country_id' => yii::t('app', 'Country'),
                        			                        'AutomobileBodyStyle_id' => yii::t('app', 'Automobile Body Style'),
                        			                        'EngineLocation_id' => yii::t('app', 'Engine Location'),
                        			                        'EngineType_id' => yii::t('app', 'Engine Type'),
                			'cylinders' => yii::t('app', 'Cylinders'),
                			'engineDisplacementCc' => yii::t('app', 'Engine Displacement Cc'),
                			'engineBoreMm' => yii::t('app', 'Engine Bore Mm'),
                			'engineStrokeMm' => yii::t('app', 'Engine Stroke Mm'),
                			'engineValvesPerCylinder' => yii::t('app', 'Engine Valves Per Cylinder'),
                			'engineMaxPowerHp' => yii::t('app', 'Engine Max Power Hp'),
                			'engineMaxTorqueNm' => yii::t('app', 'Engine Max Torque Nm'),
                			'engineCompressionRatio' => yii::t('app', 'Engine Compression Ratio'),
                        			                        'EngineFuel_id' => yii::t('app', 'Engine Fuel'),
                        			                        'AutomobileDrive_id' => yii::t('app', 'Automobile Drive'),
                        			                        'GearboxTransmission_id' => yii::t('app', 'Gearbox Transmission'),
                			'topSpeedKph' => yii::t('app', 'Top Speed Kph'),
                			'zeroHundredKphSec' => yii::t('app', 'Zero Hundred Kph Sec'),
                			'doors' => yii::t('app', 'Doors'),
                			'seats' => yii::t('app', 'Seats'),
                        			                        'SeatCover_id' => yii::t('app', 'Seat Cover'),
                			'weightKg' => yii::t('app', 'Weight Kg'),
                			'lengthMm' => yii::t('app', 'Length Mm'),
                			'widthMm' => yii::t('app', 'Width Mm'),
                			'heightMm' => yii::t('app', 'Height Mm'),
                			'wheelbaseMm' => yii::t('app', 'Wheelbase Mm'),
                			'fuelEconomyCityLKm' => yii::t('app', 'Fuel Economy City Lkm'),
                			'fuelEconomyHwyLKm' => yii::t('app', 'Fuel Economy Hwy Lkm'),
                			'fuelEconomyMixedLKm' => yii::t('app', 'Fuel Economy Mixed Lkm'),
                			'fuelCapacityLts' => yii::t('app', 'Fuel Capacity Lts'),
                			'airConditioning' => yii::t('app', 'Air Conditioning'),
                			'serviceEveryKm' => yii::t('app', 'Service Every Km'),
                			'serviceEveryMonth' => yii::t('app', 'Service Every Month'),
                        			                        'gearboxTransmission' => yii::t('app', 'Gearbox Transmission'),
                        			                        'seatCover' => yii::t('app', 'Seat Cover'),
                        			                        'engineFuel' => yii::t('app', 'Engine Fuel'),
                        			                        'automobileBodyStyle' => yii::t('app', 'Automobile Body Style'),
                        			                        'automobileDrive' => yii::t('app', 'Automobile Drive'),
                        			                        'automobileTrim' => yii::t('app', 'Automobile Trim'),
                        			                        'country' => yii::t('app', 'Country'),
                        			                        'engineLocation' => yii::t('app', 'Engine Location'),
                        			                        'engineType' => yii::t('app', 'Engine Type'),
                        			                        'automobileAvailableColors' => yii::t('app', 'Automobile Available Colors'),
                        			                        'fleetAutomobiles' => yii::t('app', 'Fleet Automobiles'),
		);
	}

    public function defaultScope() {
        return array('order' => $this->getTableAlias(false, false) . '.' . BaseAutomobile::representingColumn() . ' ASC');
    }

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('name', $this->name, true);
		$criteria->compare('yearMake', $this->yearMake);
		$criteria->compare('AutomobileTrim_id', $this->AutomobileTrim_id);
		$criteria->compare('Country_id', $this->Country_id);
		$criteria->compare('AutomobileBodyStyle_id', $this->AutomobileBodyStyle_id);
		$criteria->compare('EngineLocation_id', $this->EngineLocation_id);
		$criteria->compare('EngineType_id', $this->EngineType_id);
		$criteria->compare('cylinders', $this->cylinders);
		$criteria->compare('engineDisplacementCc', $this->engineDisplacementCc);
		$criteria->compare('engineBoreMm', $this->engineBoreMm);
		$criteria->compare('engineStrokeMm', $this->engineStrokeMm);
		$criteria->compare('engineValvesPerCylinder', $this->engineValvesPerCylinder);
		$criteria->compare('engineMaxPowerHp', $this->engineMaxPowerHp);
		$criteria->compare('engineMaxTorqueNm', $this->engineMaxTorqueNm);
		$criteria->compare('engineCompressionRatio', $this->engineCompressionRatio);
		$criteria->compare('EngineFuel_id', $this->EngineFuel_id);
		$criteria->compare('AutomobileDrive_id', $this->AutomobileDrive_id);
		$criteria->compare('GearboxTransmission_id', $this->GearboxTransmission_id);
		$criteria->compare('topSpeedKph', $this->topSpeedKph, true);
		$criteria->compare('zeroHundredKphSec', $this->zeroHundredKphSec, true);
		$criteria->compare('doors', $this->doors);
		$criteria->compare('seats', $this->seats);
		$criteria->compare('SeatCover_id', $this->SeatCover_id);
		$criteria->compare('weightKg', $this->weightKg, true);
		$criteria->compare('lengthMm', $this->lengthMm, true);
		$criteria->compare('widthMm', $this->widthMm, true);
		$criteria->compare('heightMm', $this->heightMm, true);
		$criteria->compare('wheelbaseMm', $this->wheelbaseMm, true);
		$criteria->compare('fuelEconomyCityLKm', $this->fuelEconomyCityLKm, true);
		$criteria->compare('fuelEconomyHwyLKm', $this->fuelEconomyHwyLKm, true);
		$criteria->compare('fuelEconomyMixedLKm', $this->fuelEconomyMixedLKm, true);
		$criteria->compare('fuelCapacityLts', $this->fuelCapacityLts, true);
		$criteria->compare('airConditioning', $this->airConditioning);
		$criteria->compare('serviceEveryKm', $this->serviceEveryKm);
		$criteria->compare('serviceEveryMonth', $this->serviceEveryMonth);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
                        'pagination' => array('pageSize' => Yii::app()->user->getState('pageSize', Yii::app()->params['defaultPageSize'])),
		));
	}
}