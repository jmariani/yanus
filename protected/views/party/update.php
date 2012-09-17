<?php

$this->breadcrumbs = array(
	yii::t('app', ($model->person ? 'Persons' : 'Companies')) => array(($model->person ? 'adminPerson' : 'adminCompany')),
	GxHtml::valueEx($model) => array(),// => array('view', 'id' => GxActiveRecord::extractPkValue($model, true)),
	Yii::t('app', 'Update'),
);

$this->menu = array(
	array('label' => Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('index')),
	array('label' => Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('create')),
	array('label' => Yii::t('app', 'View') . ' ' . $model->label(), 'url'=>array('view', 'id' => GxActiveRecord::extractPkValue($model, true))),
	array('label' => Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app', 'Update') . ' ' . GxHtml::encode(yii::t('app', ($model->person ? 'Person' : 'Company'))) . ' ' . GxHtml::encode(GxHtml::valueEx($model)); ?></h1>

<?php
$this->renderPartial(($model->person ? '_formPerson' : '_formUpdateCompany'), array(
		'model' => $model));
?>