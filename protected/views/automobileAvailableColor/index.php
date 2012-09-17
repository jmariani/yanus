<?php

$this->breadcrumbs = array(
	AutomobileAvailableColor::label(2),
);

$this->menu = array(
	array('label'=>Yii::t('app', 'Create') . ' ' . AutomobileAvailableColor::label(), 'url' => array('create')),
	array('label'=>Yii::t('app', 'Manage') . ' ' . AutomobileAvailableColor::label(2), 'url' => array('admin')),
);
?>

<h1><?php echo GxHtml::encode(AutomobileAvailableColor::label(2)); ?></h1>

<?php $this->widget('bootstrap.widgets.BootListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); 