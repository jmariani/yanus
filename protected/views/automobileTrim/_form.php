<div class="form">


<?php     /** @var BootActiveForm $form */
    $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
	'id' => 'automobile-trim-form',
	'enableAjaxValidation' => false,
        'htmlOptions'=>array('class'=>'well'),
        'type' => 'horizontal',
    ));
?>

<div class="flash-notice"><?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.</div>
<?php echo $form->errorSummary($model); ?>
<?php echo $form->dropDownListRow($model, 'AutomobileModel_id', AutomobileModel::model()->listModelMaker()); ?>
<?php echo $form->textFieldRow($model, 'name', array('maxlength' => 45)); ?>

<!--		<div class="row">-->
<!--		\n"; ?>-->
<!--		\n"; ?>-->
<!--		</div> row -->
<!--		<div class="row">-->
<!--		\n"; ?>-->
		<?php // echo $form->dropDownListRow($model, 'AutomobileMaker_id', GxHtml::listDataEx(AutomobileMaker::model()->findAllAttributes(null, true))); ?>
<!--		\n"; ?>-->
<!--		</div> row -->
<!--		<div class="row">-->
<!--		\n"; ?>-->
		<?php // echo $form->dropDownListRow($model, 'AutomobileModel_id', GxHtml::listDataEx(AutomobileModel::model()->findAllAttributes(null, true))); ?>

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