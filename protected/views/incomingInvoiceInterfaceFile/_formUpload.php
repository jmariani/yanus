<div class="form">
<?php     /** @var BootActiveForm $form */
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id' => 'incoming-invoice-interface-file-form',
	'enableAjaxValidation' => false,
        'htmlOptions'=>array('class'=>'well', 'enctype' => 'multipart/form-data'),
        'type' => 'horizontal',
        'inlineErrors' => false
    ));
?>

<?php
    Yii::app()->user->setFlash('info', Yii::t('app', 'Please select a file to upload.'));
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
<?php echo $form->fileFieldRow($model, 'fileName'); ?>
<div class="form-actions">
    <?php
        $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
                        'size' => 'mini',
			'type'=>'primary',
			'label'=>Yii::t('app', 'Upload'),
        ));
    ?>
</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
