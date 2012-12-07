<div class="form">


<?php     /** @var BootActiveForm $form */
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id' => 'file-asset-form',
	'enableAjaxValidation' => false,
        'htmlOptions'=>array('class'=>'well'),
        'type' => 'horizontal',
    ));
?>

<div class="flash-notice"><?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.</div>
<?php echo $form->errorSummary($model); ?>

<!--		<div class="row">-->
<!--		\n"; ?>-->
		<?php echo $form->textAreaRow($model, 'name'); ?>
<!--		\n"; ?>-->
<!--		</div> row -->
<!--		<div class="row">-->
<!--		\n"; ?>-->
		<?php echo $form->textAreaRow($model, 'location'); ?>
<!--		\n"; ?>-->
<!--		</div> row -->
<!--		<div class="row">-->
<!--		\n"; ?>-->
		<?php echo $form->textFieldRow($model, 'creationDttm'); ?>
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