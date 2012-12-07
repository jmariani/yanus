<div class="view">
	<?php echo GxHtml::encode($data->getAttributeLabel($data->representingColumn())); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->__toString()), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('location')); ?>:
	<?php echo GxHtml::encode($data->location); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('creationDttm')); ?>:
	<?php echo GxHtml::encode($data->creationDttm); ?>
	<br />

</div>