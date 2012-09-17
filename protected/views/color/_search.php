<div class="wide form">
<?php $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
        'htmlOptions'=>array('class'=>'well'),
        'type' => 'horizontal',
)); ?>

	<div class="row">
<!--
		<?php echo $form->label($model, 'name'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textFieldRow($model, 'name', array('maxlength' => 45)); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'htmlCode'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textFieldRow($model, 'htmlCode', array('maxlength' => 45)); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'active'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->dropDownListRow($model, 'active', array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')), array('prompt' => Yii::t('app', 'All'))); ?>

	</div>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'type'=>'primary',
                        'buttonType'=>'submit',
			'label'=>yii::t('app', 'Search'),
		)); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
