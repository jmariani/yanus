<?php

$this->breadcrumbs = array(
	SwTest::label(2),
);

$this->menu = array(
	array('label'=>Yii::t('app', 'Create') . ' ' . SwTest::label(), 'url' => array('create')),
	array('label'=>Yii::t('app', 'Manage') . ' ' . SwTest::label(2), 'url' => array('admin')),
);
?>

<h1><?php echo GxHtml::encode(SwTest::label(2)); ?></h1>

<?php $this->widget('bootstrap.widgets.BootListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); 