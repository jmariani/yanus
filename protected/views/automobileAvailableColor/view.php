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
'active:boolean',
'availableForInterior:boolean',
'availableForExterior:boolean',
array(
			'name' => 'color',
			'type' => 'raw',
			'value' => $model->color !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->color)), array('color/view', 'id' => GxActiveRecord::extractPkValue($model->color, true))) : null,
			),
array(
			'name' => 'automobile',
			'type' => 'raw',
			'value' => $model->automobile !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->automobile)), array('automobile/view', 'id' => GxActiveRecord::extractPkValue($model->automobile, true))) : null,
			),
	),
)); ?>
