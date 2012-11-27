<?php

$this->breadcrumbs = array(
	CustomsPermit::label(2),
);

$this->menu = array(
	array('label'=>Yii::t('app', 'Create') . ' ' . CustomsPermit::label(), 'url' => array('create')),
	array('label'=>Yii::t('app', 'Manage') . ' ' . CustomsPermit::label(2), 'url' => array('admin')),
);
?>

<h1><?php echo GxHtml::encode(CustomsPermit::label(2)); ?></h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
));