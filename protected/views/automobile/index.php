<?php

$this->breadcrumbs = array(
	Automobile::label(2),
);

$this->menu = array(
	array('label'=>Yii::t('app', 'Create') . ' ' . Automobile::label(), 'url' => array('create')),
	array('label'=>Yii::t('app', 'Manage') . ' ' . Automobile::label(2), 'url' => array('admin')),
);
?>

<h1><?php echo GxHtml::encode(Automobile::label(2)); ?></h1>

<?php $this->widget('bootstrap.widgets.BootListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); 