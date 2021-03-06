<div class="form">


<?php     /** @var BootActiveForm $form */
    $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
	'id' => 'party-form',
	'enableAjaxValidation' => false,
        'htmlOptions'=>array('class'=>'well'),
        'type' => 'horizontal',
    ));
?>

<div class="flash-notice"><?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.</div>
<?php echo $form->errorSummary($model); ?>
    <?php echo $form->textFieldRow($model, 'personFirstName', array('class' => 'span-8')); ?>
    <?php echo $form->textFieldRow($model, 'personSecondName', array('class' => 'span-8')); ?>
    <?php echo $form->textFieldRow($model, 'personSurName', array('class' => 'span-8')); ?>
    <?php echo $form->textFieldRow($model, 'personMotherFamilyName', array('class' => 'span-8')); ?>
    <div class="form-actions">
            <?php $this->widget('bootstrap.widgets.BootButton', array(
                    'buttonType'=>'submit',
                    'type'=>'primary',
                    'label'=>$model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save'),
            )); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->