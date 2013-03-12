<div class="view">
	<?php echo GxHtml::encode($data->getAttributeLabel($data->representingColumn())); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->__toString()), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('active')); ?>:
	<?php echo GxHtml::encode($data->active); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('effDt')); ?>:
	<?php echo GxHtml::encode($data->effDt); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Party_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->party)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('PartyMailType_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->partyMailType)); ?>
	<br />

</div>