<div class="flash-notice"><?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.</div>
<fieldset>
    <legend><?php echo yii::t('app', 'Engine'); ?></legend>
    <div class="offset2">
        <?php echo $form->dropDownListRow($model, 'EngineLocation_id', GxHtml::listDataEx(EngineLocation::model()->findAllAttributes(null, true))); ?>
        <?php echo $form->dropDownListRow($model, 'EngineType_id', GxHtml::listDataEx(EngineType::model()->findAllAttributes(null, true))); ?>
        <?php echo $form->dropDownListRow($model, 'EngineFuel_id', GxHtml::listDataEx(EngineFuel::model()->findAllAttributes(null, true))); ?>
        <?php echo $form->textFieldRow($model, 'cylinders'); ?>
        <?php echo $form->textFieldRow($model, 'engineDisplacementCc', array('append'=>'cc')); ?>
        <?php echo $form->textFieldRow($model, 'engineBoreMm', array('append'=>'mm')); ?>
        <?php echo $form->textFieldRow($model, 'engineStrokeMm', array('append'=>'mm')); ?>
        <?php echo $form->textFieldRow($model, 'engineValvesPerCylinder'); ?>
        <?php echo $form->textFieldRow($model, 'engineMaxPowerHp', array('append'=>'HP')); ?>
        <?php echo $form->textFieldRow($model, 'engineMaxTorqueNm', array('append'=>'nm')); ?>
        <?php echo $form->textFieldRow($model, 'engineCompressionRatio'); ?>
        <?php echo $form->textFieldRow($model, 'fuelEconomyCityLKm', array('maxlength' => 10, 'append'=>'Lts/100Km')); ?>
        <?php echo $form->textFieldRow($model, 'fuelEconomyHwyLKm', array('maxlength' => 10, 'append'=>'Lts/100Km')); ?>
        <?php echo $form->textFieldRow($model, 'fuelEconomyMixedLKm', array('maxlength' => 10, 'append'=>'Lts/100Km')); ?>
        <?php echo $form->textFieldRow($model, 'fuelCapacityLts', array('maxlength' => 10, 'append'=>'Lts')); ?>
    </div>
</fieldset>
