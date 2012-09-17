<div class="form">
<?php     /** @var BootActiveForm $form */
    $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
	'id' => 'incoming-invoice-interface-file-form',
	'enableAjaxValidation' => false,
        'htmlOptions'=>array('class'=>'well', 'enctype' => 'multipart/form-data'),
        'type' => 'horizontal',
        'inlineErrors' => false
    ));
?>

<div class="flash-notice"><?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.</div>
<?php echo $form->errorSummary($model); ?>
<?php echo $form->fileFieldRow($model, 'fileName'); ?>
<div class="form-actions">
    <?php
        $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>Yii::t('app', 'Upload'),
        ));
    ?>
</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
