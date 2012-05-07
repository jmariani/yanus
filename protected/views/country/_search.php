<div class="wide form">

<?php $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); ?>

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
		<?php echo $form->label($model, 'code'); ?>
            -->
                <?php echo $form->textFieldRow($model,'code',array('class'=>'span5','maxlength'=>45)); ?>
<!--
		<?php echo $form->textField($model, 'code', array('maxlength' => 45)); ?>
            -->
	</div>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'type'=>'primary',
                        'buttonType' => 'submit',
			'label'=>yii::t('app', 'Search'),
		)); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
