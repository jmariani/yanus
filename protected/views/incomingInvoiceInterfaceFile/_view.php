<div class="view">
	<?php echo GxHtml::encode($data->getAttributeLabel($data->representingColumn())); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->__toString()), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('status')); ?>:
	<?php echo GxHtml::encode($data->status); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('receptionDttm')); ?>:
	<?php echo GxHtml::encode($data->receptionDttm); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('validationDttm')); ?>:
	<?php echo GxHtml::encode($data->validationDttm); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('processDttm')); ?>:
	<?php echo GxHtml::encode($data->processDttm); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('note')); ?>:
	<?php echo GxHtml::encode($data->note); ?>
	<br />
	<?php /*
	<?php echo GxHtml::encode($data->getAttributeLabel('fileLocation')); ?>:
	<?php echo GxHtml::encode($data->fileLocation); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('logFileLocation')); ?>:
	<?php echo GxHtml::encode($data->logFileLocation); ?>
	<br />
	*/ ?>

</div>