<div class="form">


<?php     /** @var BootActiveForm $form */
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id' => 'customs-permit-form',
	'enableAjaxValidation' => false,
        'htmlOptions'=>array('class'=>'well'),
        'type' => 'horizontal',
    ));
?>

<?php
//    Yii::app()->user->setFlash('info', Yii::t('app', 'Fields with * are required.'));
//    $this->widget('bootstrap.widgets.TbAlert', array(
//        'block'=>true, // display a larger alert block?
//        'fade'=>true, // use transitions?
//        'closeText'=>false, // close link text - if set to false, no close link is displayed
//    //    'alerts'=>array( // configurations per alert type
//    //        'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'×'), // success, info, warning, error or danger
//    //        'info'=>array('block'=>true, 'fade'=>true, ), // success, info, warning, error or danger
//    //    ),
//    ));
?>

<?php
Yii::app()->user->setFlash('info', Yii::t('app', 'Fields with') . '<span class="required"> * </span>' . Yii::t('app', 'are required'));
$this->widget('bootstrap.widgets.TbAlert', array(
    'block'=>true, // display a larger alert block?
    'fade'=>true, // use transitions?
    'closeText'=>false, // close link text - if set to false, no close link is displayed
//    'alerts'=>array( // configurations per alert type
//        'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'×'), // success, info, warning, error or danger
//        'info'=>array('block'=>true, 'fade'=>true, ), // success, info, warning, error or danger
//    ),
));
?>

<?php echo $form->errorSummary($model); ?>
<?php echo $form->textFieldRow($model, 'nbr', array('maxlength' => 45)); ?>
<?php echo $form->datepickerRow($model, 'dt'
            ,array(
////                        'hint'=>'Click inside! This is a super cool date field.',
                'prepend'=>'<i class="icon-calendar"></i>',
                'options' => array('language' => 'es', 'format' => 'dd/mm/yyyy', 'autoclose' => true, 'todayBtn' => true, 'todayHighlight' => true)
            )
        );
?>
<?php echo $form->textAreaRow($model, 'office'); ?>
<div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType'=>'submit',
                'type'=>'primary',
                'label'=>$model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save'),
        )); ?>
</div>
<?php $this->endWidget(); ?>
</div><!-- form -->