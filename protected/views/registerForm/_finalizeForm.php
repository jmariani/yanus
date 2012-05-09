<div class="form">

<?php /** @var BootActiveForm $form */
$model->scenario = 'finalize';
$form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
    'id' => 'register-form-form',
    'htmlOptions'=>array('class'=>'well'),
    'type' => 'horizontal',
    'enableAjaxValidation' => true,
));
    ?>
	<p class="note">
		<?php echo Yii::t('app', 'Please fill the required information to complete your registration.'); ?>
	</p>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>
	<?php echo $form->errorSummary($model); ?>
        <?php // echo CHtml::link('Hover me', '#', array('class'=>'btn btn-primary btn-danger', 'data-title'=>'Heading', 'data-content'=>'Content ...', 'rel'=>'popover')); ?>
<?php $this->widget('bootstrap.widgets.BootDetailView', array(
	'data' => $model,
	'attributes' => array(
'businessName',
'rfc',
'userName',
//'password',
'contactName',
'contactPhone',
'contactEmail',
))); ?>
        <?php echo $form->textAreaRow($model, 'fiscalRegime', array('class'=>'span8', 'rows' => 2, 'hint' => yii::t('app', 'Please enter your fiscal regime as registered with tax authority.'))); ?>
        <fieldset>
            <legend><?php echo yii::t('app', 'Fiscal address');?></legend>
            <?php echo $form->dropDownListRow($model, 'State_id', GxHtml::listDataEx(State::model()->with(
                    array('country' => array(
                        'select' => false,
                        'joinType' => 'LEFT JOIN',
                        'condition' => 'country.code = "MX"',
                    ))
                    )->findAllAttributes(null, true, array('order' => 't.name asc')))); ?>
            <?php echo $form->textAreaRow($model, 'street', array('class'=>'span8', 'rows' => 2,), array('required' => true)); ?>
            <?php echo $form->textAreaRow($model, 'extNbr', array('class'=>'span8', 'rows' => 1)); ?>
            <?php echo $form->textAreaRow($model, 'intNbr', array('class'=>'span8', 'rows' => 1)); ?>
            <?php echo $form->textAreaRow($model, 'colony', array('class'=>'span8', 'rows' => 1)); ?>
            <?php echo $form->textAreaRow($model, 'city', array('class'=>'span8', 'rows' => 1)); ?>
            <?php echo $form->textAreaRow($model, 'municipality', array('class'=>'span8', 'rows' => 1)); ?>
            <?php echo $form->textFieldRow($model, 'zipCode', array('maxlength' => 5)); ?>
            <?php echo $form->textAreaRow($model, 'reference', array('class'=>'span8', 'rows' => 2)); ?>
        </fieldset>
        <?php $this->widget('application.extensions.recaptcha.EReCaptcha',
        array('model'=>$model, 'attribute'=>'captcha',
                'theme'=>'red', 'language'=> yii::app()->getLanguage(),
                'publicKey'=>'6LeSJ9ESAAAAAC9XmTk28mJphYPulXDCIUjQ1C0g')) ?>
        <?php


$this->widget('bootstrap.widgets.BootButton', array(
    'label'=>Yii::t('app', 'Submit'),
    'icon'=>'ok white',
    'buttonType' => 'submit',
    'type'=>'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'large', // '', 'large', 'small' or 'mini'
));
$this->widget('bootstrap.widgets.BootButton', array(
    'buttonType'=>'reset',
    'icon'=>'remove',
    'label'=>yii::t('app', 'Reset'),
    'size'=>'large', // '', 'large', 'small' or 'mini'
    )
);

$this->endWidget();
?>
</div><!-- form -->