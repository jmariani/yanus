<div class="view">
	<?php echo GxHtml::encode($data->getAttributeLabel($data->representingColumn())); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->__toString()), array('view', 'id' => $data->id)); ?>
	<br />
        <?php $this->widget('bootstrap.widgets.BootLabel', array(
            'type'=>'success', // '', 'success', 'warning', 'important', 'info' or 'inverse'
            'label'=>$data->Status->getText(),
        )); ?>
        <?php echo GxHtml::encode($data->Status->getText()); ?>
	<?php echo GxHtml::encode($data->getAttributeLabel('rfc')); ?>:
	<?php echo GxHtml::encode($data->rfc); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('userName')); ?>:
	<?php echo GxHtml::encode($data->userName); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('password')); ?>:
	<?php echo GxHtml::encode($data->password); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('street')); ?>:
	<?php echo GxHtml::encode($data->street); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('extNbr')); ?>:
	<?php echo GxHtml::encode($data->extNbr); ?>
	<br />
	<?php /*
	<?php echo GxHtml::encode($data->getAttributeLabel('intNbr')); ?>:
	<?php echo GxHtml::encode($data->intNbr); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('colony')); ?>:
	<?php echo GxHtml::encode($data->colony); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('city')); ?>:
	<?php echo GxHtml::encode($data->city); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('municipality')); ?>:
	<?php echo GxHtml::encode($data->municipality); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('zipCode')); ?>:
	<?php echo GxHtml::encode($data->zipCode); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('reference')); ?>:
	<?php echo GxHtml::encode($data->reference); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('State_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->state)); ?>
	<br />
	*/ ?>

</div>