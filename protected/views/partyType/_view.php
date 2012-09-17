<div class="view">
	<?php echo GxHtml::encode($data->getAttributeLabel($data->representingColumn())); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->__toString()), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('active')); ?>:
	<?php echo GxHtml::encode($data->active); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('personType')); ?>:
	<?php echo GxHtml::encode($data->personType); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('businessType')); ?>:
	<?php echo GxHtml::encode($data->businessType); ?>
	<br />

</div>