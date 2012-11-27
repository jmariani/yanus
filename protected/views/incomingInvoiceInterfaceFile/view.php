<?php

$this->breadcrumbs = array(
	$model->label(2) => array('admin'),
	GxHtml::valueEx($model),
);

?>

<h1><?php echo Yii::t('app', 'View') . ' ' . GxHtml::encode($model->label()) . ' "' . GxHtml::encode(GxHtml::valueEx($model)) . '"'; ?></h1>

<?php $this->widget('bootstrap.widgets.TBDetailView', array(
	'data' => $model,
        'type' => array('striped','bordered'),
	'attributes' => array(
        'fileName',
        'receptionDttm',
            array(
                'type' => 'raw',
                'name' => 'validationDttm',
                'value' => $model->validationDttm,
                'visible' => ($model->validationDttm ? true : false)
            ),
            array(
                'type' => 'raw',
                'name' => 'processDttm',
                'value' => $model->processDttm,
                'visible' => ($model->processDttm ? true : false)
            ),
),
)); ?>
