<div class="view">
	<?php echo GxHtml::encode($data->getAttributeLabel($data->representingColumn())); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->__toString()), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('AutomobileMaker_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->automobileMaker)); ?>
	<br />

</div>