<div class="form">


<?php     /** @var BootActiveForm $form */
    $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
        'id' => 'register-form-form',
        'htmlOptions'=>array('class'=>'well'),
        'type' => 'horizontal',
        'enableAjaxValidation' => false,
    ));
?>

<div class="flash-notice"><?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.</div>
<?php echo $form->errorSummary($model); ?>
<?php echo $form->textFieldRow($model, 'name'); ?>

<!--
		<label><?php echo GxHtml::encode($model->getRelationLabel('eavs')); ?></label>
		<?php echo $form->checkBoxList($model, 'eavs', GxHtml::encodeEx(GxHtml::listDataEx(Eav::model()->findAllAttributes(null, true)), false, true)); ?>
-->
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save'),
		)); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->