<div class="wide form">
<?php $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
        'htmlOptions'=>array('class'=>'well'),
        'type' => 'horizontal',
)); ?>

	<div class="row">
<!--
		<?php echo $form->label($model, 'Automobile_id'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->dropDownListRow($model, 'Automobile_id', GxHtml::listDataEx(Automobile::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'AutomobileAvailableColor_id'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->dropDownListRow($model, 'AutomobileAvailableColor_id', GxHtml::listDataEx(AutomobileAvailableColor::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'serialNbr'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textFieldRow($model, 'serialNbr', array('maxlength' => 45)); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'engineNbr'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textFieldRow($model, 'engineNbr', array('maxlength' => 45)); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'currentLicensePlate'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textFieldRow($model, 'currentLicensePlate', array('maxlength' => 45)); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'economicNbr'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textFieldRow($model, 'economicNbr', array('maxlength' => 45)); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'currentMileage'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textFieldRow($model, 'currentMileage'); ?>

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
