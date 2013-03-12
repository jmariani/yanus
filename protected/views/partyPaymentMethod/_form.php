<div class="form">

<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'party-payment-method', 'enableAjaxValidation' =>false,         //'htmlOptions'=>array('class'=>'well'),
        'type' => 'horizontal',
    ));
?>
<?php echo $form->dropDownListRow($model, 'Party_id', GxHtml::listDataEx(Party::model()->with(array('primaryName','customerId'))->together()->findAllAttributes(null, true, array('order' => 'primaryName.value')), null, 'NameAndCustomerId'), array('class' => 'span8', )); ?>
<?php echo $form->errorSummary($model); ?><?php echo $form->textAreaRow($model, 'method', array('class' => 'span8')); ?>
<?php echo $form->textAreaRow($model, 'bankAcct', array('class' => 'span8')); ?>
<?php echo $form->checkBoxRow($model, 'active'); ?>
<div class="form-actions well well-small">
<?php $this->widget('bootstrap.widgets.TbButton',
    array(
        'buttonType'=>'submit',
        'type'=>'primary',
        'label'=> $model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save'),
    )); ?></div>

<?php $this->endWidget(); ?>

</div><!-- form -->