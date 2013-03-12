
<?php

//$this->layout = '//layouts/column1';
$this->breadcrumbs = array(
	PartyPaymentMethod::label(2),
);

$this->menu = array(
	array('label'=>Yii::t('app', 'Create') . ' ' . PartyPaymentMethod::label(), 'url' => array('create')),
	array('label'=>Yii::t('app', 'Manage') . ' ' . PartyPaymentMethod::label(2), 'url' => array('admin')),
);
?>

<h1><?php echo GxHtml::encode(PartyPaymentMethod::label(2)); ?></h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); 