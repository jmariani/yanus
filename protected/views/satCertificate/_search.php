<div class="wide form">

<?php $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); ?>

	<div class="row">
<!--
		<?php echo $form->label($model, 'serial'); ?>
            -->
                <?php echo $form->textFieldRow($model,'serial',array('class'=>'span5','maxlength'=>50)); ?>
<!--
		<?php echo $form->textField($model, 'serial', array('maxlength' => 50)); ?>
            -->
	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'validFrom'); ?>
            -->
                <?php echo $form->textFieldRow($model,'validFrom',array('class'=>'span5')); ?>
<!--
		<?php echo $form->textField($model, 'validFrom'); ?>
            -->
	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'validTo'); ?>
            -->
                <?php echo $form->textFieldRow($model,'validTo',array('class'=>'span5')); ?>
<!--
		<?php echo $form->textField($model, 'validTo'); ?>
            -->
	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'name'); ?>
            -->
                <?php echo $form->textAreaRow($model,'name',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>
<!--
		<?php echo $form->textArea($model, 'name'); ?>
            -->
	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'rfc'); ?>
            -->
                <?php echo $form->textFieldRow($model,'rfc',array('class'=>'span5','maxlength'=>13)); ?>
<!--
		<?php echo $form->textField($model, 'rfc', array('maxlength' => 13)); ?>
            -->
	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'pem'); ?>
            -->
                <?php echo $form->textAreaRow($model,'pem',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>
<!--
		<?php echo $form->textArea($model, 'pem'); ?>
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
