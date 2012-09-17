<div class="wide form">
<?php $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
        'htmlOptions'=>array('class'=>'well'),
        'type' => 'horizontal',
)); ?>

	<div class="row">
<!--
		<?php echo $form->label($model, 'invoice'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textAreaRow($model, 'invoice'); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'version'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textFieldRow($model, 'version', array('maxlength' => 45)); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'serial'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textFieldRow($model, 'serial', array('maxlength' => 25)); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'folio'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textFieldRow($model, 'folio'); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'uuid'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textFieldRow($model, 'uuid', array('maxlength' => 36)); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'dttm'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textFieldRow($model, 'dttm'); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'seal'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textAreaRow($model, 'seal'); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'paymentType'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textAreaRow($model, 'paymentType'); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'certNbr'); ?>
            -->
<!--                \n"; ?>-->

		<?php // echo $form->textFieldRow($model, 'certNbr', array('maxlength' => 20)); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'certificate'); ?>
            -->
<!--                \n"; ?>-->

		<?php // echo $form->textAreaRow($model, 'certificate'); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'paymentTerm'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textAreaRow($model, 'paymentTerm'); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'subTotal'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textFieldRow($model, 'subTotal', array('maxlength' => 64)); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'discount'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textFieldRow($model, 'discount', array('maxlength' => 45)); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'discountReason'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textAreaRow($model, 'discountReason'); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'exchangeRate'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textFieldRow($model, 'exchangeRate', array('maxlength' => 64)); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'currency'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textAreaRow($model, 'currency'); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'total'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textFieldRow($model, 'total', array('maxlength' => 64)); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'voucherType'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textFieldRow($model, 'voucherType'); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'paymentMethod'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textAreaRow($model, 'paymentMethod'); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'expeditionPlace'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textAreaRow($model, 'expeditionPlace'); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'paymentAcctNbr'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textFieldRow($model, 'paymentAcctNbr', array('maxlength' => 4)); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'sourceFolio'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textFieldRow($model, 'sourceFolio'); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'sourceSerial'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textFieldRow($model, 'sourceSerial', array('maxlength' => 25)); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'sourceDttm'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textFieldRow($model, 'sourceDttm'); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'sourceAmt'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textFieldRow($model, 'sourceAmt', array('maxlength' => 64)); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'vendorRfc'); ?>
            -->
<!--                \n"; ?>-->

		<?php // echo $form->textFieldRow($model, 'vendorRfc', array('maxlength' => 13)); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'vendorName'); ?>
            -->
<!--                \n"; ?>-->

		<?php // echo $form->textAreaRow($model, 'vendorName'); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'customerRfc'); ?>
            -->
<!--                \n"; ?>-->

		<?php // echo $form->textFieldRow($model, 'customerRfc', array('maxlength' => 13)); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'customerName'); ?>
            -->
<!--                \n"; ?>-->

		<?php // echo $form->textAreaRow($model, 'customerName'); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'taxAmt'); ?>
            -->
<!--                \n"; ?>-->

		<?php // echo $form->textFieldRow($model, 'taxAmt', array('maxlength' => 64)); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'wthAmt'); ?>
            -->
<!--                \n"; ?>-->

		<?php // echo $form->textFieldRow($model, 'wthAmt', array('maxlength' => 64)); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'dtsVersion'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textFieldRow($model, 'dtsVersion', array('maxlength' => 45)); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'dtsDttm'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textFieldRow($model, 'dtsDttm'); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'dtsSatCertNbr'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textFieldRow($model, 'dtsSatCertNbr', array('maxlength' => 45)); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'dtsSatSeal'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textAreaRow($model, 'dtsSatSeal'); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'dtsOriginalString'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textAreaRow($model, 'dtsOriginalString'); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'approvalNbr'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textFieldRow($model, 'approvalNbr'); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'approvalYear'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textFieldRow($model, 'approvalYear'); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'md5'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textFieldRow($model, 'md5', array('maxlength' => 32)); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'creationDt'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textFieldRow($model, 'creationDt'); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'updateDt'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textFieldRow($model, 'updateDt'); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'status'); ?>
            -->
<!--                \n"; ?>-->

		<?php // echo $form->textFieldRow($model, 'status'); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'vendorParty_id'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->dropDownListRow($model, 'vendorParty_id', GxHtml::listDataEx(Party::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'customerParty_id'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->dropDownListRow($model, 'customerParty_id', GxHtml::listDataEx(Party::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'originalString'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textAreaRow($model, 'originalString'); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'cbb'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textAreaRow($model, 'cbb'); ?>

	</div>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'type'=>'primary',
                        'buttonType'=>'submit',
                        'icon' => 'search',
			'label'=>yii::t('app', 'Search'),
		)); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
