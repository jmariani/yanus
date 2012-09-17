<?php
$this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Login");
$this->breadcrumbs=array(
	UserModule::t("Login"),
);
?>

<h1><?php echo UserModule::t("Login"); ?></h1>

<?php if(Yii::app()->user->hasFlash('loginMessage')): ?>

<div class="success">
	<?php echo Yii::app()->user->getFlash('loginMessage'); ?>
</div>

<?php endif; ?>

<div class="flash-notice"><?php echo Yii::t('app', 'Please fill out the following form with your login credentials'); ?>.</div>
<!--<p><?php // echo UserModule::t("Please fill out the following form with your login credentials:"); ?></p>-->

<div class="form">
<?php     /** @var BootActiveForm $form */
    $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
	'id' => 'login-form',
	'enableAjaxValidation' => false,
        'htmlOptions'=>array('class'=>'well'),
        'type' => 'horizontal',
    ));
?>
<div class="flash-notice"><?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.</div>
<?php echo $form->errorSummary($model); ?>
<?php echo $form->textFieldRow($model, 'username'); ?>
<?php echo $form->passwordFieldRow($model, 'password'); ?>
<?php echo $form->checkBoxRow($model, 'rememberMe'); ?>
<div class="form-actions">
<?php
if (Yii::app()->params['allowRegistration']) {
    $this->widget('bootstrap.widgets.BootButtonGroup', array(
        'buttons'=>array(
            array(
                    'buttonType'=>'submit',
                    'type'=>'primary',
                    'label'=>Yii::t('app', 'Login'),
            ),
            array('label'=>yii::t('app', 'Register'), 'url'=>Yii::app()->getModule('user')->registrationUrl),
            array('label'=>yii::t('app', 'Lost password?'), 'url'=>Yii::app()->getModule('user')->recoveryUrl),
        ),
    ));
} else {
    $this->widget('bootstrap.widgets.BootButtonGroup', array(
        'buttons'=>array(
            array(
                    'buttonType'=>'submit',
                    'type'=>'primary',
                    'label'=>Yii::t('app', 'Login'),
            ),
            array('label'=>yii::t('app', 'Lost password?'), 'url'=>Yii::app()->getModule('user')->recoveryUrl),
        ),
    ));
}
?>
</div>
<div class="form-actions">
    <p>
<?php echo yii::t('app', "This site is intended solely for use by authorized users. Use of this site is subject to the Legal Notices, Terms for Use and Privacy Statement located on this site. Use of the site by customers and partners, if authorized, is also subject to the terms of your contract(s) with us. Use of this site by our employees is also subject to company policies, including the Code of Conduct. Unauthorized access or breach of these terms may result in termination of your authorization to use this site and/or civil and criminal penalties."); ?>
</p>
</div>
<?php $this->endWidget(); ?>
