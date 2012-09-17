<?php

$this->breadcrumbs = array(
	Color::label(2),
);

$this->menu = array(
	array('label'=>Yii::t('app', 'Create') . ' ' . Color::label(), 'url' => array('create')),
	array('label'=>Yii::t('app', 'Manage') . ' ' . Color::label(2), 'url' => array('admin')),
);
?>

<h1><?php echo GxHtml::encode(Color::label(2)); ?></h1>

<?php $this->widget('bootstrap.widgets.BootListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); 