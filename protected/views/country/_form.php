<div class="form">


<?php $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
	'id' => 'country-form',
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
		<div class="row">
		<?php echo $form->labelEx($model,'code'); ?>
		<?php echo $form->textField($model, 'code', array('maxlength' => 45)); ?>
		<?php echo $form->error($model,'code'); ?>
		</div><!-- row -->

<!--
		<label><?php echo GxHtml::encode($model->getRelationLabel('addresses')); ?></label>
		<?php echo $form->checkBoxList($model, 'addresses', GxHtml::encodeEx(GxHtml::listDataEx(Address::model()->findAllAttributes(null, true)), false, true)); ?>
		<label><?php echo GxHtml::encode($model->getRelationLabel('states')); ?></label>
		<?php echo $form->checkBoxList($model, 'states', GxHtml::encodeEx(GxHtml::listDataEx(State::model()->findAllAttributes(null, true)), false, true)); ?>
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