<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	GxHtml::valueEx($model),
);

$this->menu=array(
	array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('index')),
	array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('create')),
	array('label'=>Yii::t('app', 'Update') . ' ' . $model->label(), 'url'=>array('update', 'id' => $model->id)),
	array('label'=>Yii::t('app', 'Delete') . ' ' . $model->label(), 'url'=>'#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app', 'View') . ' ' . GxHtml::encode($model->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model)); ?></h1>

<?php $this->widget('bootstrap.widgets.BootDetailView', array(
	'data' => $model,
        'type' => array('striped','bordered'),
	'attributes' => array(
'name',
'yearMake',
array(
			'name' => 'automobileTrim',
			'type' => 'raw',
			'value' => $model->automobileTrim !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->automobileTrim)), array('automobileTrim/view', 'id' => GxActiveRecord::extractPkValue($model->automobileTrim, true))) : null,
			),
array(
			'name' => 'country',
			'type' => 'raw',
			'value' => $model->country !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->country)), array('country/view', 'id' => GxActiveRecord::extractPkValue($model->country, true))) : null,
			),
array(
			'name' => 'automobileBodyStyle',
			'type' => 'raw',
			'value' => $model->automobileBodyStyle !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->automobileBodyStyle)), array('automobileBodyStyle/view', 'id' => GxActiveRecord::extractPkValue($model->automobileBodyStyle, true))) : null,
			),
array(
			'name' => 'engineLocation',
			'type' => 'raw',
			'value' => $model->engineLocation !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->engineLocation)), array('engineLocation/view', 'id' => GxActiveRecord::extractPkValue($model->engineLocation, true))) : null,
			),
array(
			'name' => 'engineType',
			'type' => 'raw',
			'value' => $model->engineType !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->engineType)), array('engineType/view', 'id' => GxActiveRecord::extractPkValue($model->engineType, true))) : null,
			),
'cylinders',
'engineDisplacementCc',
'engineBoreMm',
'engineStrokeMm',
'engineValvesPerCylinder',
'engineMaxPowerHp',
'engineMaxTorqueNm',
'engineCompressionRatio',
array(
			'name' => 'engineFuel',
			'type' => 'raw',
			'value' => $model->engineFuel !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->engineFuel)), array('engineFuel/view', 'id' => GxActiveRecord::extractPkValue($model->engineFuel, true))) : null,
			),
array(
			'name' => 'automobileDrive',
			'type' => 'raw',
			'value' => $model->automobileDrive !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->automobileDrive)), array('automobileDrive/view', 'id' => GxActiveRecord::extractPkValue($model->automobileDrive, true))) : null,
			),
array(
			'name' => 'gearboxTransmission',
			'type' => 'raw',
			'value' => $model->gearboxTransmission !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->gearboxTransmission)), array('gearboxTransmission/view', 'id' => GxActiveRecord::extractPkValue($model->gearboxTransmission, true))) : null,
			),
'topSpeedKph',
'zeroHundredKphSec',
'doors',
'seats',
array(
			'name' => 'seatCover',
			'type' => 'raw',
			'value' => $model->seatCover !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->seatCover)), array('seatCover/view', 'id' => GxActiveRecord::extractPkValue($model->seatCover, true))) : null,
			),
'weightKg',
'lengthMm',
'widthMm',
'heightMm',
'wheelbaseMm',
'fuelEconomyCityLKm',
'fuelEconomyHwyLKm',
'fuelEconomyMixedLKm',
'fuelCapacityLts',
'airConditioning:boolean',
	),
)); ?>

