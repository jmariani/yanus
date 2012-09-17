<div class="form">


<?php     /** @var BootActiveForm $form */
    $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
	'id' => 'automobile-available-color-form',
	'enableAjaxValidation' => false,
        'htmlOptions'=>array('class'=>'well'),
        'type' => 'horizontal',
    ));
?>

<div class="flash-notice"><?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.</div>
<?php echo $form->errorSummary($model); ?>
                <?php echo $form->dropDownListRow($model, 'Automobile_id', GxHtml::listDataEx(Automobile::model()->findAllAttributes(null, true)),
                        array('class' => 'span-10')); ?>
                <?php echo $form->dropDownListRow($model, 'Color_id', GxHtml::listDataEx(Color::model()->active()->findAllAttributes(null, true))); ?>
<!--		<div class="row">-->
<!--		\n"; ?>-->
		<?php echo $form->checkBoxRow($model, 'active'); ?>
<!--		\n"; ?>-->
<!--		</div> row -->
<!--		<div class="row">-->
<!--		\n"; ?>-->
		<?php echo $form->checkBoxRow($model, 'availableForInterior'); ?>
<!--		\n"; ?>-->
<!--		</div> row -->
<!--		<div class="row">-->
<!--		\n"; ?>-->
		<?php echo $form->checkBoxRow($model, 'availableForExterior'); ?>
<!--		\n"; ?>-->
<!--		</div> row -->
<!--		<div class="row">-->
<!--		\n"; ?>-->

<!--		\n"; ?>-->
<!--		</div> row -->
<!--		<div class="row">-->
<!--		\n"; ?>-->

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