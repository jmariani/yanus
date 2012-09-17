<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Registration");
$this->breadcrumbs=array(
	UserModule::t("Registration"),
);
?>

<h1><?php echo UserModule::t("Registration"); ?></h1>

<?php if(Yii::app()->user->hasFlash('registration')): ?>
    <div class="flash-success"><?php echo Yii::app()->user->getFlash('registration'); ?></div>
<?php else: ?>
    <div class="form">
    <?php     /** @var BootActiveForm $form */
        $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
            'id' => 'login-form',
            'enableAjaxValidation'=>false,
            'htmlOptions'=>array('class'=>'well'),
            'type' => 'horizontal',
        ));
    ?>
    <div class="flash-notice"><?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.</div>
    <?php echo $form->errorSummary($model); ?>

            <?php echo $form->textFieldRow($model,'username'); ?>
            <?php echo $form->passwordFieldRow($model,'password'); ?>
            <?php echo $form->passwordFieldRow($model,'verifyPassword'); ?>
            <?php echo $form->textFieldRow($model,'email'); ?>
            <?php $this->widget('application.extensions.recaptcha.EReCaptcha',
            array('model'=>$model, 'attribute'=>'verifyCode',
                    'theme'=>'red', 'language'=> yii::app()->getLanguage(),
                    'publicKey'=>'6LeSJ9ESAAAAAC9XmTk28mJphYPulXDCIUjQ1C0g')) ?>
    <div class="form-actions">
    <?php $this->widget('bootstrap.widgets.BootButton', array(
            'buttonType'=>'submit',
            'type'=>'primary',
            'label'=>Yii::t('app', 'Register'),
    )); ?>
    </div>
    <?php $this->endWidget(); ?>
<?php endif; ?>