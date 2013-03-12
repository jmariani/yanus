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
		<?php echo $form->label($model, 'code'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textFieldRow($model, 'code', array('maxlength' => 45)); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'Country_id'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->dropDownListRow($model, 'Country_id', GxHtml::listDataEx(Country::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>

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
