<?php

$this->breadcrumbs = array(
	PaymentTerm::label(2),
);

$this->menu = array(
	array('label'=>Yii::t('app', 'Create') . ' ' . PaymentTerm::label(), 'url' => array('create')),
	array('label'=>Yii::t('app', 'Manage') . ' ' . PaymentTerm::label(2), 'url' => array('admin')),
);
?>

<h1><?php echo GxHtml::encode(PaymentTerm::label(2)); ?></h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); 