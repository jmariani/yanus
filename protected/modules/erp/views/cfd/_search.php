<div class="wide form">

<?php $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
        'htmlOptions'=>array('class'=>'well'),
)); ?>

	<div class="row">
<!--
		<?php echo $form->label($model, 'invoice'); ?>
            -->
                <?php echo $form->textAreaRow($model,'invoice',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>
<!--
		<?php echo $form->textArea($model, 'invoice'); ?>
            -->
	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'version'); ?>
            -->
                <?php echo $form->textFieldRow($model,'version',array('class'=>'span5','maxlength'=>45)); ?>
<!--
		<?php echo $form->textField($model, 'version', array('maxlength' => 45)); ?>
            -->
	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'serial'); ?>
            -->
                <?php echo $form->textFieldRow($model,'serial',array('class'=>'span5','maxlength'=>25)); ?>
<!--
		<?php echo $form->textField($model, 'serial', array('maxlength' => 25)); ?>
            -->
	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'folio'); ?>
            -->
                <?php echo $form->textFieldRow($model,'folio',array('class'=>'span5')); ?>
<!--
		<?php echo $form->textField($model, 'folio'); ?>
            -->
	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'uuid'); ?>
            -->
                <?php echo $form->textFieldRow($model,'uuid',array('class'=>'span5','maxlength'=>36)); ?>
<!--
		<?php echo $form->textField($model, 'uuid', array('maxlength' => 36)); ?>
            -->
	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'dttm'); ?>
            -->
                <?php echo $form->textFieldRow($model,'dttm',array('class'=>'span5')); ?>
<!--
		<?php echo $form->textField($model, 'dttm'); ?>
            -->
	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'seal'); ?>
            -->
                <?php echo $form->textAreaRow($model,'seal',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>
<!--
		<?php echo $form->textArea($model, 'seal'); ?>
            -->
	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'paymentType'); ?>
            -->
                <?php echo $form->textAreaRow($model,'paymentType',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>
<!--
		<?php echo $form->textArea($model, 'paymentType'); ?>
            -->
	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'certNbr'); ?>
            -->
                <?php echo $form->textFieldRow($model,'certNbr',array('class'=>'span5','maxlength'=>20)); ?>
<!--
		<?php echo $form->textField($model, 'certNbr', array('maxlength' => 20)); ?>
            -->
	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'certificate'); ?>
            -->
                <?php echo $form->textAreaRow($model,'certificate',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>
<!--
		<?php echo $form->textArea($model, 'certificate'); ?>
            -->
	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'paymentTerm'); ?>
            -->
                <?php echo $form->textAreaRow($model,'paymentTerm',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>
<!--
		<?php echo $form->textArea($model, 'paymentTerm'); ?>
            -->
	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'subTotal'); ?>
            -->
                <?php echo $form->textFieldRow($model,'subTotal',array('class'=>'span5','maxlength'=>64)); ?>
<!--
		<?php echo $form->textField($model, 'subTotal', array('maxlength' => 64)); ?>
            -->
	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'discount'); ?>
            -->
                <?php echo $form->textFieldRow($model,'discount',array('class'=>'span5','maxlength'=>45)); ?>
<!--
		<?php echo $form->textField($model, 'discount', array('maxlength' => 45)); ?>
            -->
	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'discountReason'); ?>
            -->
                <?php echo $form->textAreaRow($model,'discountReason',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>
<!--
		<?php echo $form->textArea($model, 'discountReason'); ?>
            -->
	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'exchangeRate'); ?>
            -->
                <?php echo $form->textFieldRow($model,'exchangeRate',array('class'=>'span5','maxlength'=>64)); ?>
<!--
		<?php echo $form->textField($model, 'exchangeRate', array('maxlength' => 64)); ?>
            -->
	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'currency'); ?>
            -->
                <?php echo $form->textAreaRow($model,'currency',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>
<!--
		<?php echo $form->textArea($model, 'currency'); ?>
            -->
	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'total'); ?>
            -->
                <?php echo $form->textFieldRow($model,'total',array('class'=>'span5','maxlength'=>64)); ?>
<!--
		<?php echo $form->textField($model, 'total', array('maxlength' => 64)); ?>
            -->
	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'voucherType'); ?>
            -->
                <?php echo $form->textFieldRow($model,'voucherType',array('class'=>'span5','maxlength'=>45)); ?>
<!--
		<?php echo $form->textField($model, 'voucherType', array('maxlength' => 45)); ?>
            -->
	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'paymentMethod'); ?>
            -->
                <?php echo $form->textAreaRow($model,'paymentMethod',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>
<!--
		<?php echo $form->textArea($model, 'paymentMethod'); ?>
            -->
	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'expeditionPlace'); ?>
            -->
                <?php echo $form->textAreaRow($model,'expeditionPlace',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>
<!--
		<?php echo $form->textArea($model, 'expeditionPlace'); ?>
            -->
	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'paymentAcctNbr'); ?>
            -->
                <?php echo $form->textFieldRow($model,'paymentAcctNbr',array('class'=>'span5','maxlength'=>4)); ?>
<!--
		<?php echo $form->textField($model, 'paymentAcctNbr', array('maxlength' => 4)); ?>
            -->
	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'sourceFolio'); ?>
            -->
                <?php echo $form->textFieldRow($model,'sourceFolio',array('class'=>'span5')); ?>
<!--
		<?php echo $form->textField($model, 'sourceFolio'); ?>
            -->
	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'sourceSerial'); ?>
            -->
                <?php echo $form->textFieldRow($model,'sourceSerial',array('class'=>'span5','maxlength'=>25)); ?>
<!--
		<?php echo $form->textField($model, 'sourceSerial', array('maxlength' => 25)); ?>
            -->
	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'sourceDttm'); ?>
            -->
                <?php echo $form->textFieldRow($model,'sourceDttm',array('class'=>'span5')); ?>
<!--
		<?php echo $form->textField($model, 'sourceDttm'); ?>
            -->
	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'sourceAmt'); ?>
            -->
                <?php echo $form->textFieldRow($model,'sourceAmt',array('class'=>'span5','maxlength'=>64)); ?>
<!--
		<?php echo $form->textField($model, 'sourceAmt', array('maxlength' => 64)); ?>
            -->
	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'vendorRfc'); ?>
            -->
                <?php echo $form->textFieldRow($model,'vendorRfc',array('class'=>'span5','maxlength'=>13)); ?>
<!--
		<?php echo $form->textField($model, 'vendorRfc', array('maxlength' => 13)); ?>
            -->
	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'vendorName'); ?>
            -->
                <?php echo $form->textAreaRow($model,'vendorName',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>
<!--
		<?php echo $form->textArea($model, 'vendorName'); ?>
            -->
	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'customerRfc'); ?>
            -->
                <?php echo $form->textFieldRow($model,'customerRfc',array('class'=>'span5','maxlength'=>13)); ?>
<!--
		<?php echo $form->textField($model, 'customerRfc', array('maxlength' => 13)); ?>
            -->
	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'customerName'); ?>
            -->
                <?php echo $form->textAreaRow($model,'customerName',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>
<!--
		<?php echo $form->textArea($model, 'customerName'); ?>
            -->
	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'taxAmt'); ?>
            -->
                <?php echo $form->textFieldRow($model,'taxAmt',array('class'=>'span5','maxlength'=>64)); ?>
<!--
		<?php echo $form->textField($model, 'taxAmt', array('maxlength' => 64)); ?>
            -->
	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'wthAmt'); ?>
            -->
                <?php echo $form->textFieldRow($model,'wthAmt',array('class'=>'span5','maxlength'=>64)); ?>
<!--
		<?php echo $form->textField($model, 'wthAmt', array('maxlength' => 64)); ?>
            -->
	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'dtsVersion'); ?>
            -->
                <?php echo $form->textFieldRow($model,'dtsVersion',array('class'=>'span5','maxlength'=>45)); ?>
<!--
		<?php echo $form->textField($model, 'dtsVersion', array('maxlength' => 45)); ?>
            -->
	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'dtsDttm'); ?>
            -->
                <?php echo $form->textFieldRow($model,'dtsDttm',array('class'=>'span5')); ?>
<!--
		<?php echo $form->textField($model, 'dtsDttm'); ?>
            -->
	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'dtsSatCertNbr'); ?>
            -->
                <?php echo $form->textFieldRow($model,'dtsSatCertNbr',array('class'=>'span5','maxlength'=>45)); ?>
<!--
		<?php echo $form->textField($model, 'dtsSatCertNbr', array('maxlength' => 45)); ?>
            -->
	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'dtsSatSeal'); ?>
            -->
                <?php echo $form->textAreaRow($model,'dtsSatSeal',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>
<!--
		<?php echo $form->textArea($model, 'dtsSatSeal'); ?>
            -->
	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'approvalNbr'); ?>
            -->
                <?php echo $form->textFieldRow($model,'approvalNbr',array('class'=>'span5')); ?>
<!--
		<?php echo $form->textField($model, 'approvalNbr'); ?>
            -->
	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'approvalYear'); ?>
            -->
                <?php echo $form->textFieldRow($model,'approvalYear',array('class'=>'span5')); ?>
<!--
		<?php echo $form->textField($model, 'approvalYear'); ?>
            -->
	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'md5'); ?>
            -->
                <?php echo $form->textFieldRow($model,'md5',array('class'=>'span5','maxlength'=>32)); ?>
<!--
		<?php echo $form->textField($model, 'md5', array('maxlength' => 32)); ?>
            -->
	</div>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'type'=>'primary',
			'label'=>yii::t('app', 'Search'),
		)); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
