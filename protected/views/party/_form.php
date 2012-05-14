<div class="form">


<?php $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
	'id' => 'party-form',
	'enableAjaxValidation' => false,
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textArea($model, 'name'); ?>
		<?php echo $form->error($model,'name'); ?>
		</div><!-- row -->

<!--
		<label><?php echo GxHtml::encode($model->getRelationLabel('partyAttributes')); ?></label>
		<?php echo $form->checkBoxList($model, 'partyAttributes', GxHtml::encodeEx(GxHtml::listDataEx(PartyAttribute::model()->findAllAttributes(null, true)), false, true)); ?>
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