<div class="wide form">
<?php $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
        'htmlOptions'=>array('class'=>'well'),
        'type' => 'horizontal',
)); ?>

	<div class="row">
<!--
		<?php echo $form->label($model, 'name'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textAreaRow($model, 'name'); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'yearMake'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textFieldRow($model, 'yearMake'); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'AutomobileTrim_id'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->dropDownListRow($model, 'AutomobileTrim_id', GxHtml::listDataEx(AutomobileTrim::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'Country_id'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->dropDownListRow($model, 'Country_id', GxHtml::listDataEx(Country::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'AutomobileBodyStyle_id'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->dropDownListRow($model, 'AutomobileBodyStyle_id', GxHtml::listDataEx(AutomobileBodyStyle::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'EngineLocation_id'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->dropDownListRow($model, 'EngineLocation_id', GxHtml::listDataEx(EngineLocation::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'EngineType_id'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->dropDownListRow($model, 'EngineType_id', GxHtml::listDataEx(EngineType::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'cylinders'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textFieldRow($model, 'cylinders'); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'engineDisplacementCc'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textFieldRow($model, 'engineDisplacementCc'); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'engineBoreMm'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textFieldRow($model, 'engineBoreMm'); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'engineStrokeMm'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textFieldRow($model, 'engineStrokeMm'); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'engineValvesPerCylinder'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textFieldRow($model, 'engineValvesPerCylinder'); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'engineMaxPowerHp'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textFieldRow($model, 'engineMaxPowerHp'); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'engineMaxTorqueNm'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textFieldRow($model, 'engineMaxTorqueNm'); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'engineCompressionRatio'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textFieldRow($model, 'engineCompressionRatio'); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'EngineFuel_id'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->dropDownListRow($model, 'EngineFuel_id', GxHtml::listDataEx(EngineFuel::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'AutomobileDrive_id'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->dropDownListRow($model, 'AutomobileDrive_id', GxHtml::listDataEx(AutomobileDrive::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'GearboxTransmission_id'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->dropDownListRow($model, 'GearboxTransmission_id', GxHtml::listDataEx(GearboxTransmission::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'topSpeedKph'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textFieldRow($model, 'topSpeedKph', array('maxlength' => 10)); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'zeroHundredKphSec'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textFieldRow($model, 'zeroHundredKphSec', array('maxlength' => 10)); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'doors'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textFieldRow($model, 'doors'); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'seats'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textFieldRow($model, 'seats'); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'SeatCover_id'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->dropDownListRow($model, 'SeatCover_id', GxHtml::listDataEx(SeatCover::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'weightKg'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textFieldRow($model, 'weightKg', array('maxlength' => 10)); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'lengthMm'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textFieldRow($model, 'lengthMm', array('maxlength' => 10)); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'widthMm'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textFieldRow($model, 'widthMm', array('maxlength' => 10)); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'heightMm'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textFieldRow($model, 'heightMm', array('maxlength' => 10)); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'wheelbaseMm'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textFieldRow($model, 'wheelbaseMm', array('maxlength' => 10)); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'fuelEconomyCityLKm'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textFieldRow($model, 'fuelEconomyCityLKm', array('maxlength' => 10)); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'fuelEconomyHwyLKm'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textFieldRow($model, 'fuelEconomyHwyLKm', array('maxlength' => 10)); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'fuelEconomyMixedLKm'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textFieldRow($model, 'fuelEconomyMixedLKm', array('maxlength' => 10)); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'fuelCapacityLts'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->textFieldRow($model, 'fuelCapacityLts', array('maxlength' => 10)); ?>

	</div>

	<div class="row">
<!--
		<?php echo $form->label($model, 'airConditioning'); ?>
            -->
<!--                \n"; ?>-->

		<?php echo $form->dropDownListRow($model, 'airConditioning', array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')), array('prompt' => Yii::t('app', 'All'))); ?>

	</div>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'type'=>'primary',
                        'buttonType'=>'submit',
			'label'=>yii::t('app', 'Search'),
		)); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
