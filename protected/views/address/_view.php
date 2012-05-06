<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('street')); ?>:</b>
	<?php echo CHtml::encode($data->street); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('extNbr')); ?>:</b>
	<?php echo CHtml::encode($data->extNbr); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('intNbr')); ?>:</b>
	<?php echo CHtml::encode($data->intNbr); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('neighbourhood')); ?>:</b>
	<?php echo CHtml::encode($data->neighbourhood); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('city')); ?>:</b>
	<?php echo CHtml::encode($data->city); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('reference')); ?>:</b>
	<?php echo CHtml::encode($data->reference); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('municipality')); ?>:</b>
	<?php echo CHtml::encode($data->municipality); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('state')); ?>:</b>
	<?php echo CHtml::encode($data->state); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('country')); ?>:</b>
	<?php echo CHtml::encode($data->country); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('zipCode')); ?>:</b>
	<?php echo CHtml::encode($data->zipCode); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Country_id')); ?>:</b>
	<?php echo CHtml::encode($data->Country_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('State_id')); ?>:</b>
	<?php echo CHtml::encode($data->State_id); ?>
	<br />

	*/ ?>

</div>