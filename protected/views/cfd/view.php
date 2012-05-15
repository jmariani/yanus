<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	GxHtml::valueEx($model),
);

$this->menu=array(
	array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('index')),
	array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('create')),
	array('label'=>Yii::t('app', 'Update') . ' ' . $model->label(), 'url'=>array('update', 'id' => $model->id)),
	array('label'=>Yii::t('app', 'Delete') . ' ' . $model->label(), 'url'=>'#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app', 'View') . ' ' . GxHtml::encode($model->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model)); ?></h1>

<?php $this->widget('bootstrap.widgets.BootDetailView', array(
	'data' => $model,
        'type' => array('striped','bordered'),
	'attributes' => array(
'invoice',
'version',
'serial',
'folio',
'uuid',
'dttm',
            'vendorRfc',
'vendorName',
'customerRfc',
'customerName',

//'seal',
'paymentType',
//'certNbr',
//'certificate',
'paymentTerm',
'subTotal',
'discount',
'discountReason',
'taxAmt',
'wthAmt',
'total',
'currency',
'exchangeRate',
'voucherType',
'paymentMethod',
'expeditionPlace',
'paymentAcctNbr',
//'sourceFolio',
//'sourceSerial',
//'sourceDttm',
//'sourceAmt',
//'dtsVersion',
//'dtsDttm',
//'dtsSatCertNbr',
//'dtsSatSeal',
//'approvalNbr',
//'approvalYear',
//'md5',
	),
)); ?>

<h2><?php echo GxHtml::encode($model->getRelationLabel('cfdAddresses')); ?></h2>
<?php
	echo GxHtml::openTag('ul');
	foreach($model->cfdAddresses as $relatedModel) {
		echo GxHtml::openTag('li');
		echo GxHtml::link(GxHtml::encode(GxHtml::valueEx($relatedModel)), array('cfdAddress/view', 'id' => GxActiveRecord::extractPkValue($relatedModel, true)));
		echo GxHtml::closeTag('li');
	}
	echo GxHtml::closeTag('ul');
?><h2><?php echo GxHtml::encode($model->getRelationLabel('cfdItems')); ?></h2>
<?php
	echo GxHtml::openTag('ul');
	foreach($model->cfdItems as $relatedModel) {
		echo GxHtml::openTag('li');
		echo GxHtml::link(GxHtml::encode(GxHtml::valueEx($relatedModel)), array('cfdItem/view', 'id' => GxActiveRecord::extractPkValue($relatedModel, true)));
		echo GxHtml::closeTag('li');
	}
	echo GxHtml::closeTag('ul');
?><h2><?php echo GxHtml::encode($model->getRelationLabel('cfdTaxes')); ?></h2>
<?php
	echo GxHtml::openTag('ul');
	foreach($model->cfdTaxes as $relatedModel) {
		echo GxHtml::openTag('li');
		echo GxHtml::link(GxHtml::encode(GxHtml::valueEx($relatedModel)), array('cfdTax/view', 'id' => GxActiveRecord::extractPkValue($relatedModel, true)));
		echo GxHtml::closeTag('li');
	}
	echo GxHtml::closeTag('ul');
//
//        ?><h2><?php echo GxHtml::encode($model->getRelationLabel('cfdTaxRegimes')); ?></h2>
//<?php
//	echo GxHtml::openTag('ul');
//	foreach($model->cfdTaxRegimes as $relatedModel) {
//		echo GxHtml::openTag('li');
//		echo GxHtml::link(GxHtml::encode(GxHtml::valueEx($relatedModel)), array('cfdTaxRegime/view', 'id' => GxActiveRecord::extractPkValue($relatedModel, true)));
//		echo GxHtml::closeTag('li');
//	}
//	echo GxHtml::closeTag('ul');

        ?><h2><?php echo GxHtml::encode($model->getRelationLabel('cfdWithholdings')); ?></h2>
<?php
	echo GxHtml::openTag('ul');
	foreach($model->cfdWithholdings as $relatedModel) {
		echo GxHtml::openTag('li');
		echo GxHtml::link(GxHtml::encode(GxHtml::valueEx($relatedModel)), array('cfdWithholding/view', 'id' => GxActiveRecord::extractPkValue($relatedModel, true)));
		echo GxHtml::closeTag('li');
	}
	echo GxHtml::closeTag('ul');
?><h2><?php echo GxHtml::encode($model->getRelationLabel('customsPermits')); ?></h2>
<?php
	echo GxHtml::openTag('ul');
	foreach($model->customsPermits as $relatedModel) {
		echo GxHtml::openTag('li');
		echo GxHtml::link(GxHtml::encode(GxHtml::valueEx($relatedModel)), array('customsPermit/view', 'id' => GxActiveRecord::extractPkValue($relatedModel, true)));
		echo GxHtml::closeTag('li');
	}
	echo GxHtml::closeTag('ul');
?>