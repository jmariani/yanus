<div class="wide form">
<?php $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
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

		<?php echo $form->textFieldRow($model, 'fileName', array('maxlength' => 255)); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'receptionDttm'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textFieldRow($model, 'receptionDttm'); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'note'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textAreaRow($model, 'note'); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'nativeXmlFile'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textAreaRow($model, 'nativeXmlFile'); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'IncomingInvoiceInterfaceFileStatus_id'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->dropDownListRow($model, 'IncomingInvoiceInterfaceFileStatus_id', GxHtml::listDataEx(IncomingInvoiceInterfaceFileStatus::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>

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
