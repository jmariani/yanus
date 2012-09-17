<?php

Yii::import('application.models._base.BaseAutomobile');

class Automobile extends BaseAutomobile {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function rules() {
        $rules = parent::rules();
        $rules[] = array('name', 'unique', 'message' => 'Automobile "{value}" already exists.');
        return $rules;
    }
    public function attributeLabels() {
        $attributeLabels = parent::attributeLabels();
        $attributeLabels['AutomobileTrim_id'] = yii::t('app', 'Maker') . '/' . yii::t('app', 'Model') . '/' . yii::t('app', 'Trim');
        $attributeLabels['Country_id'] = yii::t('app', 'Country of Origin');
        $attributeLabels['AutomobileBodyStyle_id'] = yii::t('app', 'Body Style');
        $attributeLabels['EngineLocation_id'] = yii::t('app', 'Location');
        $attributeLabels['EngineType_id'] = yii::t('app', 'Type');
        $attributeLabels['engineDisplacementCc'] = yii::t('app', 'Displacement');
        $attributeLabels['engineBoreMm'] = yii::t('app', 'Bore');
        $attributeLabels['engineStrokeMm'] = yii::t('app', 'Stroke');
        $attributeLabels['engineValvesPerCylinder'] = yii::t('app', 'Valves Per Cylinder');
        $attributeLabels['engineMaxPowerHp'] = yii::t('app', 'Max. Power');
        $attributeLabels['engineMaxTorqueNm'] = yii::t('app', 'Max. Torque');
        $attributeLabels['engineCompressionRatio'] = yii::t('app', 'Compression Ratio');
        $attributeLabels['EngineFuel_id'] = yii::t('app', 'Fuel');
        $attributeLabels['AutomobileDrive_id'] = yii::t('app', 'Drive');
        $attributeLabels['GearboxTransmission_id'] = yii::t('app', 'Transmission');
        $attributeLabels['topSpeedKph'] = yii::t('app', 'Top Speed');
        $attributeLabels['zeroHundredKphSec'] = yii::t('app', '0-100 Kph');
        $attributeLabels['weightKg'] = yii::t('app', 'Weight');
        $attributeLabels['lengthMm'] = yii::t('app', 'Lenght');
        $attributeLabels['widthMm'] = yii::t('app', 'Width');
        $attributeLabels['heightMm'] = yii::t('app', 'Height');
        $attributeLabels['wheelbaseMm'] = yii::t('app', 'Wheelbase');
        $attributeLabels['fuelEconomyCityLKm'] = yii::t('app', 'Fuel Economy City');
        $attributeLabels['fuelEconomyHwyLKm'] = yii::t('app', 'Fuel Economy Hwy');
        $attributeLabels['fuelEconomyMixedLKm'] = yii::t('app', 'Fuel Economy Mixed');
        $attributeLabels['fuelCapacityLts'] = yii::t('app', 'Fuel Capacity');
        $attributeLabels['serviceEveryKm'] = yii::t('app', 'Service Every');
        $attributeLabels['serviceEveryMonth'] = yii::t('app', 'Service Every');

        return $attributeLabels;
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
            'gearboxTransmission' => yii::t('app', 'Gearbox Transmission'),
            'seatCover' => yii::t('app', 'Seat Cover'),
            'engineFuel' => yii::t('app', 'Engine Fuel'),
            'automobileTrim' => yii::t('app', 'Automobile Trim'),
            'country' => yii::t('app', 'Country'),
            'automobileBodyStyle' => yii::t('app', 'Automobile Body Style'),
            'engineLocation' => yii::t('app', 'Engine Location'),
            'engineType' => yii::t('app', 'Engine Type'),
            'automobileDrive' => yii::t('app', 'Automobile Drive'),
        );
    }

    public function beforeValidate() {
        $this->name = $this->automobileTrim->automobileModel->automobileMaker->name . ' ';
        $this->name .= $this->automobileTrim->automobileModel->name . ' ';
        $this->name .= $this->automobileTrim->name . ' ';
        $this->name .= $this->yearMake;
        return parent::beforeValidate();
    }

    public static function listAvailableExteriorColor($automobileId = null) {
        if (!is_null($automobileId)) {
            return AutomobileAvailableColor::model()->active()->availableAsExteriorColor()->orderByColorName()->with('color')->findAll('Automobile_id = :id', array(':id' => $automobileId));
        } else {
            return AutomobileAvailableColor::model()->active()->availableAsExteriorColor()->orderByColorName()->with('color')->findAll();
        }
    }
}