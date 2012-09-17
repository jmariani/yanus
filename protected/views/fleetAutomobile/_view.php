<div class="view">
	<?php echo GxHtml::encode($data->getAttributeLabel($data->representingColumn())); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->__toString()), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('AutomobileAvailableColor_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->automobileAvailableColor)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('serialNbr')); ?>:
	<?php echo GxHtml::encode($data->serialNbr); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('engineNbr')); ?>:
	<?php echo GxHtml::encode($data->engineNbr); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('currentLicensePlate')); ?>:
	<?php echo GxHtml::encode($data->currentLicensePlate); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('economicNbr')); ?>:
	<?php echo GxHtml::encode($data->economicNbr); ?>
	<br />
	<?php /*
	<?php echo GxHtml::encode($data->getAttributeLabel('currentMileage')); ?>:
	<?php echo GxHtml::encode($data->currentMileage); ?>
	<br />
	*/ ?>

</div>