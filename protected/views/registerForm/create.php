<?php

//$this->breadcrumbs = array(
//	Yii::t('app', 'Registration form'),
//);

//$this->menu = array(
//	array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url' => array('index')),
//	array('label'=>Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url' => array('admin')),
//);
?>

<h1><?php echo Yii::t('app', 'Registration form');?></h1>
<?php
    $this->layout='column1';
?>
<?php
$this->renderPartial('_form', array(
		'model' => $model,
		'buttons' => 'create'));
?>