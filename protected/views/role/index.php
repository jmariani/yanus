<?php

$this->breadcrumbs = array(
	Role::label(2),
);

$this->menu = array(
	array('label'=>Yii::t('app', 'Create') . ' ' . Role::label(), 'url' => array('create')),
	array('label'=>Yii::t('app', 'Manage') . ' ' . Role::label(2), 'url' => array('admin')),
);
?>

<h1><?php echo GxHtml::encode(Role::label(2)); ?></h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); 