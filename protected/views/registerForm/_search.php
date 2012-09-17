<div class="wide form">

<?php $form = $this->beginWidget('GxActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model, 'businessName'); ?>
		<?php echo $form->textArea($model, 'businessName'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'rfc'); ?>
		<?php echo $form->textField($model, 'rfc', array('maxlength' => 13)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'userName'); ?>
		<?php echo $form->textField($model, 'userName', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'street'); ?>
		<?php echo $form->textArea($model, 'street'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'extNbr'); ?>
		<?php echo $form->textArea($model, 'extNbr'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'intNbr'); ?>
		<?php echo $form->textField($model, 'intNbr', array('maxlength' => 45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'colony'); ?>
		<?php echo $form->textArea($model, 'colony'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'city'); ?>
		<?php echo $form->textArea($model, 'city'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'municipality'); ?>
		<?php echo $form->textArea($model, 'municipality'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'zipCode'); ?>
		<?php echo $form->textField($model, 'zipCode', array('maxlength' => 5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'reference'); ?>
		<?php echo $form->textArea($model, 'reference'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'State_id'); ?>
		<?php echo $form->dropDownList($model, 'State_id', GxHtml::listDataEx(State::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row buttons">
		<?php echo GxHtml::submitButton(Yii::t('app', 'Search')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
