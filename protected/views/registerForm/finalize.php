<?php

//$this->breadcrumbs = array(
//	$model->label(2) => array('index'),
//	GxHtml::valueEx($model) => array('view', 'id' => GxActiveRecord::extractPkValue($model, true)),
//	Yii::t('app', 'Update'),
//);
//
//$this->menu = array(
//	array('label' => Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('index')),
//	array('label' => Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('create')),
//	array('label' => Yii::t('app', 'View') . ' ' . $model->label(), 'url'=>array('view', 'id' => GxActiveRecord::extractPkValue($model, true))),
//	array('label' => Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url'=>array('admin')),
//);
?>

<h1><?php echo Yii::t('app', 'Finalize registration and activate account'); ?></h1>
<br/>
<h1><?php echo GxHtml::encode(GxHtml::valueEx($model)); ?></h1>
<?php
    $this->layout='column1';
?>

<?php
$this->renderPartial('_finalizeForm', array(
		'model' => $model));
?>