<div class="well">
    <h1><?php echo Yii::t('app', 'View') . ' ' . GxHtml::encode($model->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model)); ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data' => $model,
	'attributes' => array(
'businessName',
'rfc',
'userName',
'contactName',
'contactPhone',
'contactEmail',
    ),
)); ?>
<hr/>
<?php echo yii::t('app', 'Please do not answer this message. It was sent from an unattended account');?>
</div>

