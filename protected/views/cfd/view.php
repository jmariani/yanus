<?php

$this->breadcrumbs = array(
	$model->label(2) => array('admin'),
	$model->invoice,
);

$this->menu=array(
	array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('index')),
	array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('create')),
	array('label'=>Yii::t('app', 'Update') . ' ' . $model->label(), 'url'=>array('update', 'id' => $model->id)),
	array('label'=>Yii::t('app', 'Delete') . ' ' . $model->label(), 'url'=>'#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app', 'View') . ' ' . GxHtml::encode($model->label()) . ' ' . GxHtml::encode($model->invoice); ?></h1>

<?php $this->widget('bootstrap.widgets.TBDetailView', array(
	'data' => $model,
        'type' => array('striped','bordered'),
	'attributes' => array(
'invoice',
'version',
'serial',
'folio',
'dttm',
'seal',
'paymentType',
//'certNbr',
//'certificate',
'paymentTerm',
'subTotal',
'discount',
'discountReason',
'exchangeRate',
'currency',
'total',
'voucherType',
'paymentMethod',
'expeditionPlace',
'paymentAcctNbr',
'sourceFolio',
'sourceSerial',
'sourceDttm',
'sourceAmt',
'approvalNbr',
'approvalYear',
'md5',
'creationDt',
'updateDt',
//'status',
array(
			'name' => 'vendorParty',
			'type' => 'raw',
			'value' => $model->vendorParty !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->vendorParty)), array('party/view', 'id' => GxActiveRecord::extractPkValue($model->vendorParty, true))) : null,
			),
array(
			'name' => 'customerParty',
			'type' => 'raw',
			'value' => $model->customerParty !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->customerParty)), array('party/view', 'id' => GxActiveRecord::extractPkValue($model->customerParty, true))) : null,
			),
'originalString',
'cbb',
	),
)); ?>
