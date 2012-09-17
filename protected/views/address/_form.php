<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'address-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'street'); ?>
		<?php echo $form->textArea($model,'street',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'street'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'extNbr'); ?>
		<?php echo $form->textArea($model,'extNbr',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'extNbr'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'intNbr'); ?>
		<?php echo $form->textArea($model,'intNbr',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'intNbr'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'neighbourhood'); ?>
		<?php echo $form->textArea($model,'neighbourhood',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'neighbourhood'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'city'); ?>
		<?php echo $form->textArea($model,'city',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'city'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'reference'); ?>
		<?php echo $form->textArea($model,'reference',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'reference'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'municipality'); ?>
		<?php echo $form->textArea($model,'municipality',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'municipality'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'state'); ?>
		<?php echo $form->textArea($model,'state',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'state'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'country'); ?>
		<?php echo $form->textArea($model,'country',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'country'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'zipCode'); ?>
		<?php echo $form->textField($model,'zipCode',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'zipCode'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Country_id'); ?>
		<?php echo $form->textField($model,'Country_id'); ?>
		<?php echo $form->error($model,'Country_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'State_id'); ?>
		<?php echo $form->textField($model,'State_id'); ?>
		<?php echo $form->error($model,'State_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->