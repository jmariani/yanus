<div class="form">

<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
    'id' => 'register-form-form',
    'htmlOptions'=>array('class'=>'well'),
    'type' => 'horizontal'
)); ?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>
	<?php echo $form->errorSummary($model); ?>
        <?php // echo CHtml::link('Hover me', '#', array('class'=>'btn btn-primary btn-danger', 'data-title'=>'Heading', 'data-content'=>'Content ...', 'rel'=>'popover')); ?>

        <?php echo $form->textFieldRow($model, 'rfc', array('maxlength' => 13,'data-title'=>'Heading', 'data-content'=>'Content ...', 'rel'=>'popover')); ?>
        <?php echo $form->textAreaRow($model, 'businessName', array('class'=>'span8', 'rows' => 2)); ?>
        <?php echo $form->textFieldRow($model, 'userName', array('maxlength' => 20)); ?>
        <?php echo $form->passwordFieldRow($model, 'password', array('maxlength' => 128)); ?>
        <fieldset>
            <legend><?php echo yii::t('app', 'Contact information');?></legend>
            <?php echo $form->textAreaRow($model, 'contactName', array('class'=>'span8', 'rows' => 2)); ?>
            <?php echo $form->textAreaRow($model, 'contactPhone', array('class'=>'span8', 'rows' => 1)); ?>
            <?php echo $form->textAreaRow($model, 'contactEmail', array('class'=>'span8', 'rows' => 1)); ?>
        </fieldset>
        <fieldset>
            <legend><?php echo yii::t('app', 'Fiscal address');?></legend>
            <?php echo $form->dropDownListRow($model, 'State_id', GxHtml::listDataEx(State::model()->with(
                    array('country' => array(
                        'select' => false,
                        'joinType' => 'LEFT JOIN',
                        'condition' => 'country.code = "MX"'
                    ))
                    )->findAllAttributes(null, true))); ?>
            <?php echo $form->textAreaRow($model, 'street', array('class'=>'span8', 'rows' => 2)); ?>
            <?php echo $form->textAreaRow($model, 'extNbr', array('class'=>'span8', 'rows' => 1)); ?>
            <?php echo $form->textAreaRow($model, 'intNbr', array('class'=>'span8', 'rows' => 1)); ?>
            <?php echo $form->textAreaRow($model, 'colony', array('class'=>'span8', 'rows' => 1)); ?>
            <?php echo $form->textAreaRow($model, 'city', array('class'=>'span8', 'rows' => 1)); ?>
            <?php echo $form->textAreaRow($model, 'municipality', array('class'=>'span8', 'rows' => 1)); ?>
            <?php echo $form->textFieldRow($model, 'zipCode', array('maxlength' => 5)); ?>
            <?php echo $form->textAreaRow($model, 'reference', array('class'=>'span8', 'rows' => 2)); ?>
        </fieldset>
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