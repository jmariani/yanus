<?php

$this->breadcrumbs = array(
	AutomobileBodyStyle::label(2),
);

$this->menu = array(
	array('label'=>Yii::t('app', 'Create') . ' ' . AutomobileBodyStyle::label(), 'url' => array('create')),
	array('label'=>Yii::t('app', 'Manage') . ' ' . AutomobileBodyStyle::label(2), 'url' => array('admin')),
);
?>

<h1><?php echo GxHtml::encode(AutomobileBodyStyle::label(2)); ?></h1>

<?php $this->widget('bootstrap.widgets.BootListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); 