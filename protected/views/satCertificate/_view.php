<div class="view">
	<?php echo GxHtml::encode($data->getAttributeLabel($data->representingColumn())); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->__toString()), array('view', 'id' => $data->id)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('serial')); ?>:
	<?php echo GxHtml::encode($data->serial); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('issuerName')); ?>:
	<?php echo GxHtml::encode($data->issuerName); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('validFrom')); ?>:
	<?php echo GxHtml::encode($data->validFrom); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('validTo')); ?>:
	<?php echo GxHtml::encode($data->validTo); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('name')); ?>:
	<?php echo GxHtml::encode($data->name); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('rfc')); ?>:
	<?php echo GxHtml::encode($data->rfc); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('pem')); ?>:
	<?php echo GxHtml::encode($data->pem); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('keyPem')); ?>:
	<?php echo GxHtml::encode($data->pem); ?>
	<br />

</div>