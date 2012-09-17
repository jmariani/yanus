<?php

$this->breadcrumbs = array(
	RegisterForm::label(2),
	Yii::t('app', 'Index'),
);

$this->menu = array(
	array('label'=>Yii::t('app', 'Create') . ' ' . RegisterForm::label(), 'url' => array('create')),
	array('label'=>Yii::t('app', 'Manage') . ' ' . RegisterForm::label(2), 'url' => array('admin')),
);
?>

<h1><?php echo GxHtml::encode(RegisterForm::label(2)); ?></h1>

<?php $this->widget('BootListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
));