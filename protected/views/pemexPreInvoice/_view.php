<div class="view">
	<?php echo GxHtml::encode($data->getAttributeLabel($data->representingColumn())); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->__toString()), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('poNbr')); ?>:
	<?php echo GxHtml::encode($data->poNbr); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('copade')); ?>:
	<?php echo GxHtml::encode($data->copade); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('addenda')); ?>:
	<?php echo GxHtml::encode($data->addenda); ?>
	<br />

</div>