<div class="wide form">
<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
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

		<?php echo $form->textAreaRow($model, 'name'); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'location'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textAreaRow($model, 'location'); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'creationDttm'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textFieldRow($model, 'creationDttm'); ?>

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
