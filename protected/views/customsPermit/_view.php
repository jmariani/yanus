<div class="view">
	<?php echo GxHtml::encode($data->getAttributeLabel($data->representingColumn())); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->__toString()), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('dt')); ?>:
	<?php echo GxHtml::encode($data->dt); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('office')); ?>:
	<?php echo GxHtml::encode($data->office); ?>
	<br />

</div>