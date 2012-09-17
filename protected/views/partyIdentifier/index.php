<?php

$this->breadcrumbs = array(
	PartyIdentifier::label(2),
);

$this->menu = array(
	array('label'=>Yii::t('app', 'Create') . ' ' . PartyIdentifier::label(), 'url' => array('create')),
	array('label'=>Yii::t('app', 'Manage') . ' ' . PartyIdentifier::label(2), 'url' => array('admin')),
);
?>

<h1><?php echo GxHtml::encode(PartyIdentifier::label(2)); ?></h1>

<?php $this->widget('bootstrap.widgets.BootListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); 