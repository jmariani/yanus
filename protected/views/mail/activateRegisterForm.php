<h1><?php echo Yii::t('app', 'View') . ' ' . GxHtml::encode($model->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model)); ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data' => $model,
	'attributes' => array(
'businessName',
'rfc',
'userName',
//'password',
'contactName',
'contactPhone',
'contactEmail',
'street',
'extNbr',
'intNbr',
'colony',
'city',
'municipality',
'zipCode',
'reference',
array(
        'name' => 'state',
        'type' => 'raw',
        'value' => $model->state !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->state)), array('state/view', 'id' => GxActiveRecord::extractPkValue($model->state, true))) : null,
        ),
    ),
)); ?>

