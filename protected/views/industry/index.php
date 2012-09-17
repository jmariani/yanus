<?php

$this->breadcrumbs = array(
	Industry::label(2),
);

$this->menu = array(
	array('label'=>Yii::t('app', 'Create') . ' ' . Industry::label(), 'url' => array('create')),
	array('label'=>Yii::t('app', 'Manage') . ' ' . Industry::label(2), 'url' => array('admin')),
);
?>

<h1><?php echo GxHtml::encode(Industry::label(2)); ?></h1>

<?php $this->widget('bootstrap.widgets.BootListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); 