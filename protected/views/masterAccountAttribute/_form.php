<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'master-account-attribute-form',
	'enableAjaxValidation' => false,
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'MasterAccount_id'); ?>
		<?php echo $form->dropDownList($model, 'MasterAccount_id', GxHtml::listDataEx(MasterAccount::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'MasterAccount_id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'code'); ?>
		<?php echo $form->textField($model, 'code', array('maxlength' => 255)); ?>
		<?php echo $form->error($model,'code'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model, 'description'); ?>
		<?php echo $form->error($model,'description'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'value'); ?>
		<?php echo $form->textArea($model, 'value'); ?>
		<?php echo $form->error($model,'value'); ?>
		</div><!-- row -->


<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget();
?>
</div><!-- form -->