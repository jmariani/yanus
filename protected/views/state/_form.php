<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'state-form',
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
		<div class="row">
		<?php echo $form->labelEx($model,'Country_id'); ?>
		<?php echo $form->dropDownList($model, 'Country_id', GxHtml::listDataEx(Country::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'Country_id'); ?>
		</div><!-- row -->

		<label><?php echo GxHtml::encode($model->getRelationLabel('addresses')); ?></label>
		<?php echo $form->checkBoxList($model, 'addresses', GxHtml::encodeEx(GxHtml::listDataEx(Address::model()->findAllAttributes(null, true)), false, true)); ?>
		<label><?php echo GxHtml::encode($model->getRelationLabel('registerForms')); ?></label>
		<?php echo $form->checkBoxList($model, 'registerForms', GxHtml::encodeEx(GxHtml::listDataEx(RegisterForm::model()->findAllAttributes(null, true)), false, true)); ?>

<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget();
?>
</div><!-- form -->