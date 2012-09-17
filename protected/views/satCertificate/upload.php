<?php

$this->breadcrumbs = array(
	$model->label(2) => array('admin'),
	Yii::t('app', 'Upload'),
);

//$this->menu = array(
//	array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url' => array('index')),
//	array('label'=>Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url' => array('admin')),
//);
?>

<h1><?php echo Yii::t('app', 'Upload') . ' ' . GxHtml::encode($model->label()); ?></h1>

<?php
$this->renderPartial('_formUpload', array(
		'model' => $model,
		'buttons' => 'upload'));
?>