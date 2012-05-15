<div class="view">
	<?php echo GxHtml::encode(yii::t('app', 'Invoice')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->serial . $data->folio), array('view', 'id' => $data->id)); ?>
	<br />
        <?php $this->widget('bootstrap.widgets.BootDetailView', array(
	'data' => $data,
        'type' => array('striped','bordered'),
	'attributes' => array(
//            'invoice',
            'voucherType',
            'uuid',
            'dttm',
            'vendorRfc',
            'vendorName',
            'customerRfc',
            'customerName',
            'total:number',
            'currency',
            'exchangeRate',
	),
        )); ?>
	<?php
        /*
	<?php echo GxHtml::encode($data->getAttributeLabel('seal')); ?>:
	<?php echo GxHtml::encode($data->seal); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('paymentType')); ?>:
	<?php echo GxHtml::encode($data->paymentType); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('certNbr')); ?>:
	<?php echo GxHtml::encode($data->certNbr); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('certificate')); ?>:
	<?php echo GxHtml::encode($data->certificate); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('paymentTerms')); ?>:
	<?php echo GxHtml::encode($data->paymentTerms); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('discountReason')); ?>:
	<?php echo GxHtml::encode($data->discountReason); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('exchangeRate')); ?>:
	<?php echo GxHtml::encode($data->exchangeRate); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('currency')); ?>:
	<?php echo GxHtml::encode($data->currency); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('voucherType')); ?>:
	<?php echo GxHtml::encode($data->voucherType); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('paymentMethod')); ?>:
	<?php echo GxHtml::encode($data->paymentMethod); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('expeditionPlace')); ?>:
	<?php echo GxHtml::encode($data->expeditionPlace); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('paymentAcctNbr')); ?>:
	<?php echo GxHtml::encode($data->paymentAcctNbr); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('sourceFolio')); ?>:
	<?php echo GxHtml::encode($data->sourceFolio); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('sourceSerial')); ?>:
	<?php echo GxHtml::encode($data->sourceSerial); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('sourceDttm')); ?>:
	<?php echo GxHtml::encode($data->sourceDttm); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('sourceAmt')); ?>:
	<?php echo GxHtml::encode($data->sourceAmt); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('dtsVersion')); ?>:
	<?php echo GxHtml::encode($data->dtsVersion); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('dtsDttm')); ?>:
	<?php echo GxHtml::encode($data->dtsDttm); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('dtsSatCertNbr')); ?>:
	<?php echo GxHtml::encode($data->dtsSatCertNbr); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('dtsSatSeal')); ?>:
	<?php echo GxHtml::encode($data->dtsSatSeal); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('approvalNbr')); ?>:
	<?php echo GxHtml::encode($data->approvalNbr); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('approvalYear')); ?>:
	<?php echo GxHtml::encode($data->approvalYear); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('md5')); ?>:
	<?php echo GxHtml::encode($data->md5); ?>
	<br />
	*/ ?>

</div>