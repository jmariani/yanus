<div class="form">

<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
    'id' => 'register-form-form',
    'htmlOptions'=>array('class'=>'well'),
    'type' => 'horizontal',
    'enableAjaxValidation' => true,
)); ?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>
	<?php echo $form->errorSummary($model); ?>
        <?php // echo CHtml::link('Hover me', '#', array('class'=>'btn btn-primary btn-danger', 'data-title'=>'Heading', 'data-content'=>'Content ...', 'rel'=>'popover')); ?>

        <?php echo $form->textFieldRow($model, 'rfc', array('minlength' => 12, 'maxlength' => 13,'hint'=>yii::t('app', 'Please enter your RFC without spaces or hyphens.'))); ?>
        <?php echo $form->textAreaRow($model, 'businessName', array('class'=>'span8', 'rows' => 2)); ?>
        <?php echo $form->textFieldRow($model, 'userName', array('maxlength' => 20, 'hint'=>yii::t('app', "This is your administrator's username. Please choose carefully."))); ?>
        <?php // echo $form->passwordFieldRow($model, 'password', array('maxlength' => 128)); ?>
        <?php $this->widget('ext.EStrongPassword.EStrongPassword',
                array('form'=>$form, 'model'=>$model, 'attribute'=>'password', 'useBootstrapField' => true,
                'requirementOptions'=>array('minChar'=>8,'one_special_char'=>true,
                'verdicts' => array(yii::t('app', 'Weak'), yii::t('app', 'Normal'), yii::t('app', 'Medium'), yii::t('app', 'Strong'), yii::t('app', 'Very Strong')),
                'minCharText' => yii::t('app', 'You must enter a minimum of %d characters'),)
        ));?>
        <fieldset>
            <legend><?php echo yii::t('app', 'Contact information');?></legend>
            <?php echo $form->textAreaRow($model, 'contactName', array('class'=>'span8', 'rows' => 2)); ?>
            <?php echo $form->textAreaRow($model, 'contactPhone', array('class'=>'span8', 'rows' => 1)); ?>
            <?php echo $form->textAreaRow($model, 'contactEmail', array('class'=>'span8', 'rows' => 1)); ?>
        </fieldset>
<!--        <fieldset>
            <legend><?php echo yii::t('app', 'Fiscal address');?></legend>
            <?php echo $form->dropDownListRow($model, 'State_id', GxHtml::listDataEx(State::model()->with(
                    array('country' => array(
                        'select' => false,
                        'joinType' => 'LEFT JOIN',
                        'condition' => 'country.code = "MX"',
                    ))
                    )->findAllAttributes(null, true, array('order' => 't.name asc')))); ?>
            <?php echo $form->textAreaRow($model, 'street', array('class'=>'span8', 'rows' => 2)); ?>
            <?php echo $form->textAreaRow($model, 'extNbr', array('class'=>'span8', 'rows' => 1)); ?>
            <?php echo $form->textAreaRow($model, 'intNbr', array('class'=>'span8', 'rows' => 1)); ?>
            <?php echo $form->textAreaRow($model, 'colony', array('class'=>'span8', 'rows' => 1)); ?>
            <?php echo $form->textAreaRow($model, 'city', array('class'=>'span8', 'rows' => 1)); ?>
            <?php echo $form->textAreaRow($model, 'municipality', array('class'=>'span8', 'rows' => 1)); ?>
            <?php echo $form->textFieldRow($model, 'zipCode', array('maxlength' => 5)); ?>
            <?php echo $form->textAreaRow($model, 'reference', array('class'=>'span8', 'rows' => 2)); ?>
        </fieldset>-->
        <?php $this->widget('application.extensions.recaptcha.EReCaptcha',
        array('model'=>$model, 'attribute'=>'captcha',
                'theme'=>'red', 'language'=> yii::app()->getLanguage(),
                'publicKey'=>'6LeSJ9ESAAAAAC9XmTk28mJphYPulXDCIUjQ1C0g')) ?>
        <?php
$this->widget('bootstrap.widgets.BootButton', array(
    'label'=>Yii::t('app', 'Submit'),
    'buttonType' => 'submit',
    'type'=>'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'large', // '', 'large', 'small' or 'mini'
));
$this->endWidget();
?>
</div><!-- form -->