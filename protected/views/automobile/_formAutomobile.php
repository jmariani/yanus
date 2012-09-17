<div class="flash-notice"><?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.</div>
<fieldset>
    <div class="offset2">
        <?php echo $form->dropDownListRow($model, 'AutomobileTrim_id', AutomobileTrim::model()->listModelMakerTrim(), array('class' => 'span-11')); ?>
        <?php echo $form->textFieldRow($model, 'yearMake'); ?>
        <?php echo $form->dropDownListRow($model, 'Country_id', GxHtml::listDataEx(Country::model()
                                ->active()->automobileCountryOfOrigin()->findAllAttributes(null, true))); ?>
        <?php echo $form->dropDownListRow($model, 'AutomobileBodyStyle_id', GxHtml::listDataEx(AutomobileBodyStyle::model()
                                ->findAllAttributes(null, true))); ?>
        <?php echo $form->textFieldRow($model, 'doors'); ?>
        <?php echo $form->textFieldRow($model, 'serviceEveryKm', array('append'=>yii::t('app', 'Km'))); ?>
        <?php echo $form->textFieldRow($model, 'serviceEveryMonth', array('append'=>yii::t('app', 'Months'))); ?>
    </div>
</fieldset>
