<div class="view">
	<?php echo GxHtml::encode($data->getAttributeLabel($data->representingColumn())); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->__toString()), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('availableForInterior')); ?>:
	<?php echo GxHtml::encode($data->availableForInterior); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('availableForExterior')); ?>:
	<?php echo GxHtml::encode($data->availableForExterior); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Color_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->color)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Automobile_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->automobile)); ?>
	<br />

</div>