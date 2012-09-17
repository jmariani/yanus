<?php

$this->breadcrumbs = array(
	Entity::label(2),
);

$this->menu = array(
	array('label'=>Yii::t('app', 'Create') . ' ' . Entity::label(), 'url' => array('create')),
	array('label'=>Yii::t('app', 'Manage') . ' ' . Entity::label(2), 'url' => array('admin')),
);
?>

<h1><?php echo GxHtml::encode(Entity::label(2)); ?></h1>

<?php $this->widget('bootstrap.widgets.BootListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); 