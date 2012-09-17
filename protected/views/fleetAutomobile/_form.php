<div class="form">


<?php     /** @var BootActiveForm $form */
    $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
	'id' => 'fleet-automobile-form',
	'enableAjaxValidation' => false,
        'htmlOptions'=>array('class'=>'well'),
        'type' => 'horizontal',
    ));
?>

<div class="flash-notice"><?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.</div>
<?php echo $form->errorSummary($model); ?>
    <?php echo $form->dropDownListRow($model, 'Automobile_id', GxHtml::listDataEx(Automobile::model()->findAllAttributes(null, true)), array(
            'class' => 'span-10',
            'prompt' => 'Please select an automobile',
            'ajax' => array(
                    'type' => 'POST',
                    'url' => CController::createUrl('exteriorColorsDropDown'), //url to call.
                    'data'=>array('automobileId'=>'js:this.value'),
                    'update'=>'#FleetAutomobile_AutomobileAvailableColor_id', //selector to update
                )
        ));
    ?>
    <?php     //empty since it will be filled by the other dropdown

//    echo CHtml::dropDownList('AutomobileAvailableColor_id','', array());
            echo $form->dropDownListRow($model, 'AutomobileAvailableColor_id',
                    ($model->isNewRecord ? array() : GxHtml::listDataEx(Automobile::listAvailableExteriorColor($model->Automobile_id), 'id', 'color.name')));
    ?>
    <?php echo $form->textFieldRow($model, 'serialNbr', array('maxlength' => 45)); ?>
    <?php echo $form->textFieldRow($model, 'engineNbr', array('maxlength' => 45)); ?>
    <?php echo $form->textFieldRow($model, 'currentLicensePlate', array('maxlength' => 45)); ?>
    <?php echo $form->textFieldRow($model, 'economicNbr', array('maxlength' => 45)); ?>
    <?php echo $form->textFieldRow($model, 'currentMileage'); ?>
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save'),
		)); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->