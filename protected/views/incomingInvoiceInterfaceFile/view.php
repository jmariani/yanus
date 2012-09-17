<?php

$this->breadcrumbs = array(
	$model->label(2) => array('admin'),
	GxHtml::valueEx($model),
);

?>

<h1><?php echo Yii::t('app', 'View') . ' ' . GxHtml::encode($model->label()) . ' "' . GxHtml::encode(GxHtml::valueEx($model)) . '"'; ?></h1>

<?php $this->widget('bootstrap.widgets.BootDetailView', array(
	'data' => $model,
        'type' => array('striped','bordered'),
	'attributes' => array(
'fileName',
    array(
        'name' => 'incomingInvoiceInterfaceFileStatus',
        'type' => 'raw',
        'value' => $model->incomingInvoiceInterfaceFileStatus !== null ?
                GxHtml::encode(
                        GxHtml::valueEx($model->incomingInvoiceInterfaceFileStatus)) : null,
    ),
'receptionDttm',
            array(
                'type' => 'raw',
                'name' => 'processDttm',
                'value' => $model->processDttm,
                'visible' => ($model->processDttm ? true : false)
            ),
            array(
                'type' => 'raw',
                'name' => 'note',
                'value' => $model->note,
                'visible' => ($model->note ? true : false)
            ),
            array(
                'type' => 'raw',
                'name' => 'nativeXmlFile',
                'value' => $model->nativeXmlFile,
                'visible' => (UserModule::isAdmin() ? true : false)
            ),
),
)); ?>
