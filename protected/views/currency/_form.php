<div class="form">
<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'currency', 'enableAjaxValidation' =>false,         //'htmlOptions'=>array('class'=>'well'),
        'type' => 'horizontal',
    ));
?>
<?php echo $form->errorSummary($model); ?><?php echo $form->textFieldRow($model, 'code', array('maxlength' => 45, 'disabled' => ($mode == 'update'))); ?>
<?php echo $form->textAreaRow($model, 'name', array('class' => 'span8')); ?>
<?php echo $form->textAreaRow($model, 'plural', array('class' => 'span8')); ?>
<?php echo $form->textFieldRow($model, 'symbol', array('maxlength' => 45)); ?>
<?php echo $form->checkBoxRow($model, 'active'); ?>
<div class="form-actions well well-small">
<?php
$this->widget('bootstrap.widgets.TbButton',
    array(
        'buttonType'=>'submit',
        'type'=>'primary',
        'label'=> $model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save'),
    )); ?></div>

<?php $this->endWidget(); ?>

</div><!-- form -->