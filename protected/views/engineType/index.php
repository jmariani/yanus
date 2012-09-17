<?php

$this->breadcrumbs = array(
	EngineType::label(2),
);

$this->menu = array(
	array('label'=>Yii::t('app', 'Create') . ' ' . EngineType::label(), 'url' => array('create')),
	array('label'=>Yii::t('app', 'Manage') . ' ' . EngineType::label(2), 'url' => array('admin')),
);
?>

<h1><?php echo GxHtml::encode(EngineType::label(2)); ?></h1>

<?php $this->widget('bootstrap.widgets.BootListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); 