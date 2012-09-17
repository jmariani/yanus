<div class="view">
	<?php echo GxHtml::encode($data->getAttributeLabel($data->representingColumn())); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->__toString()), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('yearMake')); ?>:
	<?php echo GxHtml::encode($data->yearMake); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('AutomobileTrim_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->automobileTrim)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Country_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->country)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('AutomobileBodyStyle_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->automobileBodyStyle)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('EngineLocation_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->engineLocation)); ?>
	<br />
	<?php /*
	<?php echo GxHtml::encode($data->getAttributeLabel('EngineType_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->engineType)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('cylinders')); ?>:
	<?php echo GxHtml::encode($data->cylinders); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('engineDisplacementCc')); ?>:
	<?php echo GxHtml::encode($data->engineDisplacementCc); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('engineBoreMm')); ?>:
	<?php echo GxHtml::encode($data->engineBoreMm); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('engineStrokeMm')); ?>:
	<?php echo GxHtml::encode($data->engineStrokeMm); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('engineValvesPerCylinder')); ?>:
	<?php echo GxHtml::encode($data->engineValvesPerCylinder); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('engineMaxPowerHp')); ?>:
	<?php echo GxHtml::encode($data->engineMaxPowerHp); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('engineMaxTorqueNm')); ?>:
	<?php echo GxHtml::encode($data->engineMaxTorqueNm); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('engineCompressionRatio')); ?>:
	<?php echo GxHtml::encode($data->engineCompressionRatio); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('EngineFuel_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->engineFuel)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('AutomobileDrive_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->automobileDrive)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('GearboxTransmission_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->gearboxTransmission)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('topSpeedKph')); ?>:
	<?php echo GxHtml::encode($data->topSpeedKph); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('zeroHundredKphSec')); ?>:
	<?php echo GxHtml::encode($data->zeroHundredKphSec); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('doors')); ?>:
	<?php echo GxHtml::encode($data->doors); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('seats')); ?>:
	<?php echo GxHtml::encode($data->seats); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('SeatCover_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->seatCover)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('weightKg')); ?>:
	<?php echo GxHtml::encode($data->weightKg); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('lengthMm')); ?>:
	<?php echo GxHtml::encode($data->lengthMm); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('widthMm')); ?>:
	<?php echo GxHtml::encode($data->widthMm); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('heightMm')); ?>:
	<?php echo GxHtml::encode($data->heightMm); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('wheelbaseMm')); ?>:
	<?php echo GxHtml::encode($data->wheelbaseMm); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('fuelEconomyCityLKm')); ?>:
	<?php echo GxHtml::encode($data->fuelEconomyCityLKm); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('fuelEconomyHwyLKm')); ?>:
	<?php echo GxHtml::encode($data->fuelEconomyHwyLKm); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('fuelEconomyMixedLKm')); ?>:
	<?php echo GxHtml::encode($data->fuelEconomyMixedLKm); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('fuelCapacityLts')); ?>:
	<?php echo GxHtml::encode($data->fuelCapacityLts); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('airConditioning')); ?>:
	<?php echo GxHtml::encode($data->airConditioning); ?>
	<br />
	*/ ?>

</div>