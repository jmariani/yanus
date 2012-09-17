<div class="form">


<?php $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
	'id' => 'cfd-form',
	'enableAjaxValidation' => false,
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'invoice'); ?>
		<?php echo $form->textArea($model, 'invoice'); ?>
		<?php echo $form->error($model,'invoice'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'version'); ?>
		<?php echo $form->textField($model, 'version', array('maxlength' => 45)); ?>
		<?php echo $form->error($model,'version'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'serial'); ?>
		<?php echo $form->textField($model, 'serial', array('maxlength' => 25)); ?>
		<?php echo $form->error($model,'serial'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'folio'); ?>
		<?php echo $form->textField($model, 'folio'); ?>
		<?php echo $form->error($model,'folio'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'uuid'); ?>
		<?php echo $form->textField($model, 'uuid', array('maxlength' => 36)); ?>
		<?php echo $form->error($model,'uuid'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'dttm'); ?>
		<?php echo $form->textField($model, 'dttm'); ?>
		<?php echo $form->error($model,'dttm'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'seal'); ?>
		<?php echo $form->textArea($model, 'seal'); ?>
		<?php echo $form->error($model,'seal'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'paymentType'); ?>
		<?php echo $form->textArea($model, 'paymentType'); ?>
		<?php echo $form->error($model,'paymentType'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'certNbr'); ?>
		<?php echo $form->textField($model, 'certNbr', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'certNbr'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'certificate'); ?>
		<?php echo $form->textArea($model, 'certificate'); ?>
		<?php echo $form->error($model,'certificate'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'paymentTerms'); ?>
		<?php echo $form->textArea($model, 'paymentTerms'); ?>
		<?php echo $form->error($model,'paymentTerms'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'subTotal'); ?>
		<?php echo $form->textField($model, 'subTotal', array('maxlength' => 64)); ?>
		<?php echo $form->error($model,'subTotal'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'discount'); ?>
		<?php echo $form->textField($model, 'discount', array('maxlength' => 45)); ?>
		<?php echo $form->error($model,'discount'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'discountReason'); ?>
		<?php echo $form->textArea($model, 'discountReason'); ?>
		<?php echo $form->error($model,'discountReason'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'exchangeRate'); ?>
		<?php echo $form->textField($model, 'exchangeRate', array('maxlength' => 64)); ?>
		<?php echo $form->error($model,'exchangeRate'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'currency'); ?>
		<?php echo $form->textArea($model, 'currency'); ?>
		<?php echo $form->error($model,'currency'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'total'); ?>
		<?php echo $form->textField($model, 'total', array('maxlength' => 64)); ?>
		<?php echo $form->error($model,'total'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'voucherType'); ?>
		<?php echo $form->textField($model, 'voucherType', array('maxlength' => 45)); ?>
		<?php echo $form->error($model,'voucherType'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'paymentMethod'); ?>
		<?php echo $form->textArea($model, 'paymentMethod'); ?>
		<?php echo $form->error($model,'paymentMethod'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'expeditionPlace'); ?>
		<?php echo $form->textArea($model, 'expeditionPlace'); ?>
		<?php echo $form->error($model,'expeditionPlace'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'paymentAcctNbr'); ?>
		<?php echo $form->textField($model, 'paymentAcctNbr', array('maxlength' => 4)); ?>
		<?php echo $form->error($model,'paymentAcctNbr'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'sourceFolio'); ?>
		<?php echo $form->textField($model, 'sourceFolio'); ?>
		<?php echo $form->error($model,'sourceFolio'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'sourceSerial'); ?>
		<?php echo $form->textField($model, 'sourceSerial', array('maxlength' => 25)); ?>
		<?php echo $form->error($model,'sourceSerial'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'sourceDttm'); ?>
		<?php echo $form->textField($model, 'sourceDttm'); ?>
		<?php echo $form->error($model,'sourceDttm'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'sourceAmt'); ?>
		<?php echo $form->textField($model, 'sourceAmt', array('maxlength' => 64)); ?>
		<?php echo $form->error($model,'sourceAmt'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'vendorRfc'); ?>
		<?php echo $form->textField($model, 'vendorRfc', array('maxlength' => 13)); ?>
		<?php echo $form->error($model,'vendorRfc'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'vendorName'); ?>
		<?php echo $form->textArea($model, 'vendorName'); ?>
		<?php echo $form->error($model,'vendorName'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'customerRfc'); ?>
		<?php echo $form->textField($model, 'customerRfc', array('maxlength' => 13)); ?>
		<?php echo $form->error($model,'customerRfc'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'customerName'); ?>
		<?php echo $form->textArea($model, 'customerName'); ?>
		<?php echo $form->error($model,'customerName'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'taxAmt'); ?>
		<?php echo $form->textField($model, 'taxAmt', array('maxlength' => 64)); ?>
		<?php echo $form->error($model,'taxAmt'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'wthAmt'); ?>
		<?php echo $form->textField($model, 'wthAmt', array('maxlength' => 64)); ?>
		<?php echo $form->error($model,'wthAmt'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'dtsVersion'); ?>
		<?php echo $form->textField($model, 'dtsVersion', array('maxlength' => 45)); ?>
		<?php echo $form->error($model,'dtsVersion'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'dtsDttm'); ?>
		<?php echo $form->textField($model, 'dtsDttm'); ?>
		<?php echo $form->error($model,'dtsDttm'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'dtsSatCertNbr'); ?>
		<?php echo $form->textField($model, 'dtsSatCertNbr', array('maxlength' => 45)); ?>
		<?php echo $form->error($model,'dtsSatCertNbr'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'dtsSatSeal'); ?>
		<?php echo $form->textArea($model, 'dtsSatSeal'); ?>
		<?php echo $form->error($model,'dtsSatSeal'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'approvalNbr'); ?>
		<?php echo $form->textField($model, 'approvalNbr'); ?>
		<?php echo $form->error($model,'approvalNbr'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'approvalYear'); ?>
		<?php echo $form->textField($model, 'approvalYear'); ?>
		<?php echo $form->error($model,'approvalYear'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'md5'); ?>
		<?php echo $form->textField($model, 'md5', array('maxlength' => 32)); ?>
		<?php echo $form->error($model,'md5'); ?>
		</div><!-- row -->

<!--
		<label><?php echo GxHtml::encode($model->getRelationLabel('cfdAddresses')); ?></label>
		<?php echo $form->checkBoxList($model, 'cfdAddresses', GxHtml::encodeEx(GxHtml::listDataEx(CfdAddress::model()->findAllAttributes(null, true)), false, true)); ?>
		<label><?php echo GxHtml::encode($model->getRelationLabel('cfdItems')); ?></label>
		<?php echo $form->checkBoxList($model, 'cfdItems', GxHtml::encodeEx(GxHtml::listDataEx(CfdItem::model()->findAllAttributes(null, true)), false, true)); ?>
		<label><?php echo GxHtml::encode($model->getRelationLabel('cfdTaxes')); ?></label>
		<?php echo $form->checkBoxList($model, 'cfdTaxes', GxHtml::encodeEx(GxHtml::listDataEx(CfdTax::model()->findAllAttributes(null, true)), false, true)); ?>
		<label><?php echo GxHtml::encode($model->getRelationLabel('cfdTaxRegimes')); ?></label>
		<?php echo $form->checkBoxList($model, 'cfdTaxRegimes', GxHtml::encodeEx(GxHtml::listDataEx(CfdTaxRegime::model()->findAllAttributes(null, true)), false, true)); ?>
		<label><?php echo GxHtml::encode($model->getRelationLabel('cfdWithholdings')); ?></label>
		<?php echo $form->checkBoxList($model, 'cfdWithholdings', GxHtml::encodeEx(GxHtml::listDataEx(CfdWithholding::model()->findAllAttributes(null, true)), false, true)); ?>
		<label><?php echo GxHtml::encode($model->getRelationLabel('customsPermits')); ?></label>
		<?php echo $form->checkBoxList($model, 'customsPermits', GxHtml::encodeEx(GxHtml::listDataEx(CustomsPermit::model()->findAllAttributes(null, true)), false, true)); ?>
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