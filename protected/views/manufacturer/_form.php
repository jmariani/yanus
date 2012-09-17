<div class="form">


<?php     /** @var BootActiveForm $form */
    $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
	'id' => 'manufacturer-form',
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
		<?php echo $form->dropDownListRow($model, 'Industry_id', GxHtml::listDataEx(Industry::model()->findAllAttributes(null, true))); ?>
<!--		\n"; ?>-->
<!--		</div> row -->

<!--
		<label><?php echo GxHtml::encode($model->getRelationLabel('automobiles')); ?></label>
		<?php echo $form->checkBoxList($model, 'automobiles', GxHtml::encodeEx(GxHtml::listDataEx(Automobile::model()->findAllAttributes(null, true)), false, true)); ?>
		<label><?php echo GxHtml::encode($model->getRelationLabel('cfds')); ?></label>
		<?php echo $form->checkBoxList($model, 'cfds', GxHtml::encodeEx(GxHtml::listDataEx(Cfd::model()->findAllAttributes(null, true)), false, true)); ?>
		<label><?php echo GxHtml::encode($model->getRelationLabel('cfds1')); ?></label>
		<?php echo $form->checkBoxList($model, 'cfds1', GxHtml::encodeEx(GxHtml::listDataEx(Cfd::model()->findAllAttributes(null, true)), false, true)); ?>
		<label><?php echo GxHtml::encode($model->getRelationLabel('partyAddresses')); ?></label>
		<?php echo $form->checkBoxList($model, 'partyAddresses', GxHtml::encodeEx(GxHtml::listDataEx(PartyAddress::model()->findAllAttributes(null, true)), false, true)); ?>
		<label><?php echo GxHtml::encode($model->getRelationLabel('partyAttributes')); ?></label>
		<?php echo $form->checkBoxList($model, 'partyAttributes', GxHtml::encodeEx(GxHtml::listDataEx(PartyAttribute::model()->findAllAttributes(null, true)), false, true)); ?>
		<label><?php echo GxHtml::encode($model->getRelationLabel('partyNames')); ?></label>
		<?php echo $form->checkBoxList($model, 'partyNames', GxHtml::encodeEx(GxHtml::listDataEx(PartyName::model()->findAllAttributes(null, true)), false, true)); ?>
		<label><?php echo GxHtml::encode($model->getRelationLabel('satCertificates')); ?></label>
		<?php echo $form->checkBoxList($model, 'satCertificates', GxHtml::encodeEx(GxHtml::listDataEx(SatCertificate::model()->findAllAttributes(null, true)), false, true)); ?>
		<label><?php echo GxHtml::encode($model->getRelationLabel('currentAttributes')); ?></label>
		<?php echo $form->checkBoxList($model, 'currentAttributes', GxHtml::encodeEx(GxHtml::listDataEx(PartyAttribute::model()->findAllAttributes(null, true)), false, true)); ?>
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