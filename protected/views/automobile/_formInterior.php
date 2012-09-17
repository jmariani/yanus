<div class="flash-notice"><?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.</div>
<fieldset>
    <legend><?php echo yii::t('app', 'Interior'); ?></legend>
    <div class="offset2">
<!--		\n"; ?>-->
<!--		</div> row -->
<!--		<div class="row">-->
<!--		\n"; ?>-->
		<?php echo $form->textFieldRow($model, 'seats'); ?>
<!--		\n"; ?>-->
<!--		</div> row -->
<!--		<div class="row">-->
<!--		\n"; ?>-->
		<?php echo $form->dropDownListRow($model, 'SeatCover_id', GxHtml::listDataEx(SeatCover::model()->findAllAttributes(null, true))); ?>
<!--		\n"; ?>-->
<!--		</div> row -->
<!--		<div class="row">-->
<!--		\n"; ?>-->
                <?php echo $form->checkBoxRow($model, 'airConditioning'); ?>
    </div>
</fieldset>