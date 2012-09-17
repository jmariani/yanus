<div class="flash-notice"><?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.</div>
<fieldset>
    <legend><?php echo yii::t('app', 'Drive'); ?></legend>
        <div class="offset2">
            <?php echo $form->dropDownListRow($model, 'AutomobileDrive_id', GxHtml::listDataEx(AutomobileDrive::model()->findAllAttributes(null, true))); ?>
            <?php echo $form->dropDownListRow($model, 'GearboxTransmission_id', GxHtml::listDataEx(GearboxTransmission::model()->findAllAttributes(null, true))); ?>
            <?php echo $form->textFieldRow($model, 'topSpeedKph', array('maxlength' => 10, 'append'=>'Kph')); ?>
            <?php echo $form->textFieldRow($model, 'zeroHundredKphSec', array('maxlength' => 10, 'append'=>'Sec.')); ?>
        </div>
</fieldset>