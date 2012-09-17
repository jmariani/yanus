<?php

$this->breadcrumbs = array(
	AutomobileMaker::label(2),
);

$this->menu = array(
	array('label'=>Yii::t('app', 'Create') . ' ' . AutomobileMaker::label(), 'url' => array('create')),
	array('label'=>Yii::t('app', 'Manage') . ' ' . AutomobileMaker::label(2), 'url' => array('admin')),
);
?>

<h1><?php echo GxHtml::encode(AutomobileMaker::label(2)); ?></h1>

<?php $this->widget('bootstrap.widgets.BootListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); 