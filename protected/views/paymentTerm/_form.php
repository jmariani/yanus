<div class="form">


<?php     /** @var BootActiveForm $form */
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id' => 'payment-term-form',
	'enableAjaxValidation' => false,
        'htmlOptions'=>array('class'=>'well'),
        'type' => 'horizontal',
    ));
?>

<div class="flash-notice"><?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.</div>
<?php echo $form->errorSummary($model); ?>

<!--		<div class="row">-->
<!--		\n"; ?>-->
		<?php echo $form->textFieldRow($model, 'name', array('maxlength' => 255)); ?>
<!--		\n"; ?>-->
<!--		</div> row -->
<!--		<div class="row">-->
<!--		\n"; ?>-->
		<?php echo $form->textFieldRow($model, 'code', array('maxlength' => 45)); ?>
<!--		\n"; ?>-->
<!--		</div> row -->
<!--		<div class="row">-->
<!--		\n"; ?>-->
		<?php echo $form->textFieldRow($model, 'days'); ?>
<!--		\n"; ?>-->
<!--		</div> row -->

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save'),
		)); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->