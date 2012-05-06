<div class="view">
	<?php echo GxHtml::encode($data->getAttributeLabel($data->representingColumn())); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->__toString()), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('version')); ?>:
	<?php echo GxHtml::encode($data->version); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('serial')); ?>:
	<?php echo GxHtml::encode($data->serial); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('folio')); ?>:
	<?php echo GxHtml::encode($data->folio); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('uuid')); ?>:
	<?php echo GxHtml::encode($data->uuid); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('dttm')); ?>:
	<?php echo GxHtml::encode($data->dttm); ?>
	<br />
	<?php /*
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
	<?php echo GxHtml::encode($data->getAttributeLabel('subTotal')); ?>:
	<?php echo GxHtml::encode($data->subTotal); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('discount')); ?>:
	<?php echo GxHtml::encode($data->discount); ?>
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
	<?php echo GxHtml::encode($data->getAttributeLabel('total')); ?>:
	<?php echo GxHtml::encode($data->total); ?>
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
	<?php echo GxHtml::encode($data->getAttributeLabel('vendorRfc')); ?>:
	<?php echo GxHtml::encode($data->vendorRfc); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('vendorName')); ?>:
	<?php echo GxHtml::encode($data->vendorName); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('customerRfc')); ?>:
	<?php echo GxHtml::encode($data->customerRfc); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('customerName')); ?>:
	<?php echo GxHtml::encode($data->customerName); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('taxAmt')); ?>:
	<?php echo GxHtml::encode($data->taxAmt); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('wthAmt')); ?>:
	<?php echo GxHtml::encode($data->wthAmt); ?>
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