<div class="form">
<?php     /** @var BootActiveForm $form */
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id' => 'login-form',
	'enableAjaxValidation' => false,
//        'htmlOptions'=>array('class'=>'pull-right'),
        'type' => 'horizontal',
    ));
?>
<?php
Yii::app()->user->setFlash('warning', Yii::t('app', 'Fields with') . '<span class="required"> * </span>' . Yii::t('app', 'are required'));
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
<?php echo $form->textFieldRow($model, 'username'); ?>
<?php echo $form->passwordFieldRow($model, 'password'); ?>
<?php echo $form->checkBoxRow($model, 'rememberMe'); ?>

<div class="well">
<?php
if (Yii::app()->params['allowRegistration']) {
    $this->widget('bootstrap.widgets.TbButtonGroup', array(
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
    $this->widget('bootstrap.widgets.TbButtonGroup', array(
//        'htmlOptions'=>array('class'=>'span-20'),
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
<?php $this->endWidget(); ?>
