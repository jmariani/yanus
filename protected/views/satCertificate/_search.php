<div class="wide form">
<?php $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
        'htmlOptions'=>array('class'=>'well'),
        'type' => 'horizontal',
)); ?>

	<div class="row">
<!--
		<?php echo $form->label($model, 'nbr'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textFieldRow($model, 'nbr', array('maxlength' => 45)); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'serial'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textFieldRow($model, 'serial', array('maxlength' => 50)); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'validFrom'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textFieldRow($model, 'validFrom'); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'validTo'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textFieldRow($model, 'validTo'); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'name'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textAreaRow($model, 'name'); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'rfc'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textFieldRow($model, 'rfc', array('maxlength' => 13)); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'pem'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textAreaRow($model, 'pem'); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'keyPem'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textAreaRow($model, 'keyPem'); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'keyPassword'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textFieldRow($model, 'keyPassword', array('maxlength' => 45)); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'issuerName'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textAreaRow($model, 'issuerName'); ?>

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
