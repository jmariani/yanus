<div class="form">


<?php     /** @var BootActiveForm $form */
    $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
	'id' => 'party-type-form',
	'enableAjaxValidation' => false,
        'htmlOptions'=>array('class'=>'well'),
        'type' => 'horizontal',
    ));
?>

<div class="flash-notice"><?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.</div>
<?php echo $form->errorSummary($model); ?>

<!--		<div class="row">-->
<!--		\n"; ?>-->
		<?php echo $form->textFieldRow($model, 'name', array('maxlength' => 45)); ?>
<!--		\n"; ?>-->
<!--		</div> row -->
<!--		<div class="row">-->
<!--		\n"; ?>-->
		<?php echo $form->checkBoxRow($model, 'active'); ?>
<!--		\n"; ?>-->
<!--		</div> row -->
<!--		<div class="row">-->
<!--		\n"; ?>-->
		<?php echo $form->checkBoxRow($model, 'personType'); ?>
<!--		\n"; ?>-->
<!--		</div> row -->
<!--		<div class="row">-->
<!--		\n"; ?>-->
		<?php echo $form->checkBoxRow($model, 'businessType'); ?>
<!--		\n"; ?>-->
<!--		</div> row -->

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save'),
		)); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->