<fieldset>
    <legend><?php echo yii::t('app', 'Dimensions'); ?></legend>
    <div class="offset2">
		<?php echo $form->textFieldRow($model, 'weightKg', array('maxlength' => 10, 'append'=>'Kg')); ?>
<!--		\n"; ?>-->
<!--		</div> row -->
<!--		<div class="row">-->
<!--		\n"; ?>-->
                <?php echo $form->textFieldRow($model, 'lengthMm', array('maxlength' => 10, 'append'=>'mm')); ?>
<!--		\n"; ?>-->
<!--		</div> row -->
<!--		<div class="row">-->
<!--		\n"; ?>-->
		<?php echo $form->textFieldRow($model, 'widthMm', array('maxlength' => 10, 'append'=>'mm')); ?>
<!--		\n"; ?>-->
<!--		</div> row -->
<!--		<div class="row">-->
<!--		\n"; ?>-->
		<?php echo $form->textFieldRow($model, 'heightMm', array('maxlength' => 10, 'append'=>'mm')); ?>
<!--		\n"; ?>-->
<!--		</div> row -->
<!--		<div class="row">-->
<!--		\n"; ?>-->
		<?php echo $form->textFieldRow($model, 'wheelbaseMm', array('maxlength' => 10, 'append'=>'mm')); ?>
    </div>
</fieldset>