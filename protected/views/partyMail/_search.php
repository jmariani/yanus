<div class="wide form">
<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
        'htmlOptions'=>array('class'=>'well'),
        'type' => 'horizontal',
)); ?>

	<div class="row">
<!--
		<?php echo $form->label($model, 'value'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textFieldRow($model, 'value', array('maxlength' => 255)); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'active'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->dropDownListRow($model, 'active', array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')), array('prompt' => Yii::t('app', 'All'))); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'effDt'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textFieldRow($model, 'effDt'); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'Party_id'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->dropDownListRow($model, 'Party_id', GxHtml::listDataEx(Party::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'PartyMailType_id'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->dropDownListRow($model, 'PartyMailType_id', GxHtml::listDataEx(PartyMailType::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>

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
