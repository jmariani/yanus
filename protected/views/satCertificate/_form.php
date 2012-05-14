<div class="form">
<?php
/** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
    'id' => 'register-form-form',
    'htmlOptions'=>array('class'=>'well', 'enctype' => 'multipart/form-data'),
    'inlineErrors'=>true, // how to display errors, inline or block?
    'type' => 'horizontal',
    'enableAjaxValidation' => true,
));
    ?>
        <?php $this->widget('YanusBootAlert', array('closable' => false)); ?>
	<?php echo $form->errorSummary($model); ?>
        <?php echo $form->fileFieldRow($model, 'certificateFile', array('hint'=>yii::t('app', 'Please choose the certificate file.'))); ?>
        <?php echo $form->fileFieldRow($model, 'keyFile', array('hint'=>yii::t('app', 'Please choose the key file.'))); ?>
        <?php echo $form->passwordFieldRow($model, 'keyPassword', array('hint'=>yii::t('app', 'Please enter key file password.'))); ?>
<!--
		<label><?php echo GxHtml::encode($model->getRelationLabel('parties')); ?></label>
        <?php echo $form->checkBoxList($model, 'parties', GxHtml::encodeEx(GxHtml::listDataEx(Party::model()->findAllAttributes(null, true)), false, true)); ?>
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