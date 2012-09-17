<div class="well">
<?php
    /** @var BootActiveForm $form */
    $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
        'id' => 'register-form-form',
        'htmlOptions'=>array('class'=>'well', 'enctype' => 'multipart/form-data'),
        'inlineErrors'=>true, // how to display errors, inline or block?
        'type' => 'horizontal',
        'enableAjaxValidation' => true,
    ));
?>
    <div class="flash-notice"><?php echo yii::t('app', 'Please fill in the required information');?>.</div>
    <?php echo $form->errorSummary($model); ?>
    <?php echo $form->fileFieldRow($model, 'certificateFile', array('hint'=>yii::t('app', 'Please choose the certificate file.'))); ?>
    <?php echo $form->fileFieldRow($model, 'keyFile', array('hint'=>yii::t('app', 'Please choose the key file.'))); ?>
    <?php echo $form->passwordFieldRow($model, 'keyPassword', array('hint'=>yii::t('app', 'Please enter key file password.'))); ?>
    <div class="form-actions">
            <?php $this->widget('bootstrap.widgets.BootButton', array(
                    'buttonType'=>'submit',
                    'type'=>'primary',
                    'label'=>$model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save'),
            )); ?>
    </div>

<?php $this->endWidget(); ?>
<!--
    <h3>Please choose a certificate file</h3>
        <?php

//        $this->widget('xupload.XUpload', array(
//                            'url' => Yii::app()->createUrl("SatCertificate/create"),
//                            'model' => $model,
//                            'attribute' => 'certificateFile',
//                            'multiple' => false,
//        ));

    ?>
-->
</div><!-- form -->