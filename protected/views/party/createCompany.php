<?php

$this->breadcrumbs = array(
	yii::t('app', 'Company') => array('admin'),
	Yii::t('app', 'Create'),
);

$this->menu = array(
	array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url' => array('index')),
	array('label'=>Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url' => array('admin')),
);
?>

<h1><?php echo Yii::t('app', 'Create') . ' ' . GxHtml::encode(yii::t('app', 'Company')); ?></h1>

<?php
$this->renderPartial('_formCompany', array(
		'model' => $model,
		'buttons' => 'create'));
?>