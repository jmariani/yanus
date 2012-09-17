<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Restore");
$this->breadcrumbs=array(
	UserModule::t("Login") => array('/user/login'),
	UserModule::t("Lost password?"),
);
?>

<h1><?php echo UserModule::t("Lost password?"); ?></h1>

<?php if(Yii::app()->user->hasFlash('recoveryMessage')): ?>
<div class="success">
<?php echo Yii::app()->user->getFlash('recoveryMessage'); ?>
</div>
<?php else: ?>

<div class="form">
<?php     /** @var BootActiveForm $form */
    $rform = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
	'id' => 'login-form',
	'enableAjaxValidation' => false,
        'htmlOptions'=>array('class'=>'well'),
        'type' => 'horizontal',
    ));
?>
<div class="flash-notice"><?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.</div>
<?php echo $rform->errorSummary($form); ?>
<?php echo $rform->textFieldRow($form, 'login_or_email'); ?>
<div class="form-actions">
<?php $this->widget('bootstrap.widgets.BootButton', array(
        'buttonType'=>'submit',
        'type'=>'primary',
        'label'=>Yii::t('app', 'Restore'),
)); ?>

</div>
<?php $this->endWidget(); ?>

</div><!-- form -->
<?php endif; ?>