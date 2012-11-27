<div class="wide form">
<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
        'htmlOptions'=>array('class'=>'well'),
        'type' => 'horizontal',
)); ?>

	<div class="row">
<!--
		<?php echo $form->label($model, 'fileName'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textFieldRow($model, 'fileName', array('maxlength' => 45)); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'poNbr'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textFieldRow($model, 'poNbr', array('maxlength' => 45)); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'copade'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textFieldRow($model, 'copade', array('maxlength' => 45)); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'addenda'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textAreaRow($model, 'addenda'); ?>

	</div>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'type'=>'primary',
                        'buttonType'=>'submit',
                        'icon' => 'search',
			'label'=>yii::t('app', 'Search'),
		)); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
