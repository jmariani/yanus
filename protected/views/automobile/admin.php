<?php

$this->breadcrumbs = array(
	$model->label(2) => array('admin'),
	Yii::t('app', 'Manage'),
);
$this->layout = '//layouts/column1';
//$this->menu = array(
//		array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('index')),
//		array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('create')),
//	);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});

$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('automobile-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('app', 'Manage') . ' ' . GxHtml::encode($model->label(2)); ?></h1>

<div class="flash-notice"><?php echo Yii::t('app', 'You may optionally enter a comparison operator (&lt;, &lt;=, &gt;, &gt;=, &lt;&gt; or =) at the beginning of each of your search values to specify how the comparison should be done'); ?>.</div>

<?php echo GxHtml::link(Yii::t('app', 'Advanced Search'), '#', array('class' => 'search-button btn')); ?>
<?php echo GxHtml::link(Yii::t('app', 'Create new' . ' ' . $model->label()), yii::app()->baseUrl . '/automobile/create', array('class' => 'btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search', array(
	'model' => $model,
)); ?>
</div><!-- search-form -->
<div align="right" class="row">
<?php $this->widget('application.extensions.PageSize.PageSize', array(
        'mGridId'=>'automobile-grid',
        'mPageSize' => @$_GET['pageSize'],
        'mDefPageSize' => Yii::app()->params['defaultPageSize'],
        'mPageSizeOptions'=>Yii::app()->params['pageSizeOptions'],// Optional, you can use with the widget default
        'label' => yii::t('app', 'Items per page')
));
?>
</div>
<?php $this->widget('bootstrap.widgets.BootGridView',array(
	'id'=>'automobile-grid',
	'dataProvider'=>$model->search(),
        'type'=>'striped bordered condensed',
	'filter'=>$model,
	'columns'=>array(
		'name',
		'yearMake',
//		array(
//				'name'=>'AutomobileTrim_id',
//				'value'=>'GxHtml::valueEx($data->automobileTrim)',
//				'filter'=>GxHtml::listDataEx(AutomobileTrim::model()->findAllAttributes(null, true)),
//				),
//		array(
//				'name'=>'Country_id',
//				'value'=>'GxHtml::valueEx($data->country)',
//				'filter'=>GxHtml::listDataEx(Country::model()->findAllAttributes(null, true)),
//				),
//		array(
//				'name'=>'AutomobileBodyStyle_id',
//				'value'=>'GxHtml::valueEx($data->automobileBodyStyle)',
//				'filter'=>GxHtml::listDataEx(AutomobileBodyStyle::model()->findAllAttributes(null, true)),
//				),
//		array(
//				'name'=>'EngineLocation_id',
//				'value'=>'GxHtml::valueEx($data->engineLocation)',
//				'filter'=>GxHtml::listDataEx(EngineLocation::model()->findAllAttributes(null, true)),
//				),
		/*
		array(
				'name'=>'EngineType_id',
				'value'=>'GxHtml::valueEx($data->engineType)',
				'filter'=>GxHtml::listDataEx(EngineType::model()->findAllAttributes(null, true)),
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
				'name'=>'EngineFuel_id',
				'value'=>'GxHtml::valueEx($data->engineFuel)',
				'filter'=>GxHtml::listDataEx(EngineFuel::model()->findAllAttributes(null, true)),
				),
		array(
				'name'=>'AutomobileDrive_id',
				'value'=>'GxHtml::valueEx($data->automobileDrive)',
				'filter'=>GxHtml::listDataEx(AutomobileDrive::model()->findAllAttributes(null, true)),
				),
		array(
				'name'=>'GearboxTransmission_id',
				'value'=>'GxHtml::valueEx($data->gearboxTransmission)',
				'filter'=>GxHtml::listDataEx(GearboxTransmission::model()->findAllAttributes(null, true)),
				),
		'topSpeedKph',
		'zeroHundredKphSec',
		'doors',
		'seats',
		array(
				'name'=>'SeatCover_id',
				'value'=>'GxHtml::valueEx($data->seatCover)',
				'filter'=>GxHtml::listDataEx(SeatCover::model()->findAllAttributes(null, true)),
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
		array(
					'name' => 'airConditioning',
					'value' => '($data->airConditioning === 0) ? Yii::t(\'app\', \'No\') : Yii::t(\'app\', \'Yes\')',
					'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
					),
		*/
                array(
                    'class'=>'bootstrap.widgets.BootButtonColumn',
                    'htmlOptions'=>array('style'=>'width: 50px'),
                ),
	),
)); ?>