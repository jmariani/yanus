<div class="form">

<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'role', 'enableAjaxValidation' =>false,         //'htmlOptions'=>array('class'=>'well'),
        'type' => 'horizontal',
    ));
?>
<?php echo $form->errorSummary($model); ?><?php echo $form->textFieldRow($model, 'code', array('maxlength' => 45)); ?>
<?php echo $form->textFieldRow($model, 'name', array('maxlength' => 45)); ?>
<?php echo $form->textFieldRow($model, 'class', array('maxlength' => 45)); ?>
<div class="form-actions well well-small">
<?php $this->widget('bootstrap.widgets.TbButton',
    array(
        'buttonType'=>'submit',
        'type'=>'primary',
        'label'=> $model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save'),
    )); ?></div>

<?php $this->endWidget(); ?>

</div><!-- form -->