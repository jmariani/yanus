<?php

$this->breadcrumbs = array(
	Brand::label(2),
);

$this->menu = array(
	array('label'=>Yii::t('app', 'Create') . ' ' . Brand::label(), 'url' => array('create')),
	array('label'=>Yii::t('app', 'Manage') . ' ' . Brand::label(2), 'url' => array('admin')),
);
?>

<h1><?php echo GxHtml::encode(Brand::label(2)); ?></h1>

<?php $this->widget('bootstrap.widgets.BootListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); 