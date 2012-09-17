<div class="view">
	<?php echo GxHtml::encode($data->getAttributeLabel($data->representingColumn())); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->__toString()), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('value')); ?>:
	<?php echo GxHtml::encode($data->value); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('effDt')); ?>:
	<?php echo GxHtml::encode($data->effDt); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Party_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->party)); ?>
	<br />

</div>