<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	Yii::t('app', 'Manage'),
);

$this->menu = array(
		array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('index')),
		array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('create')),
	);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});

$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('cfd-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('app', 'Manage') . ' ' . GxHtml::encode($model->label(2)); ?></h1>

<p>
You may optionally enter a comparison operator (&lt;, &lt;=, &gt;, &gt;=, &lt;&gt; or =) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo GxHtml::link(Yii::t('app', 'Advanced Search'), '#', array('class' => 'search-button btn')); ?><div class="search-form" style="display:none">
<?php $this->renderPartial('_search', array(
	'model' => $model,
)); ?>
</div><!-- search-form -->
<?php $this->widget('bootstrap.widgets.BootGridView',array(
	'id'=>'cfd-grid',
	'dataProvider'=>$model->search(),
        'type'=>'striped bordered condensed',
	'filter'=>$model,
	'columns'=>array(
		'invoice',
		'version',
		'serial',
		'folio',
		'uuid',
		'dttm',
		/*
		'seal',
		'paymentType',
		'certNbr',
		'certificate',
		'paymentTerms',
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
		'vendorRfc',
		'vendorName',
		'customerRfc',
		'customerName',
		'taxAmt',
		'wthAmt',
		'dtsVersion',
		'dtsDttm',
		'dtsSatCertNbr',
		'dtsSatSeal',
		'approvalNbr',
		'approvalYear',
		'md5',
		*/
                array(
                    'class'=>'bootstrap.widgets.BootButtonColumn',
                    'htmlOptions'=>array('style'=>'width: 50px'),
                ),
	),
)); ?>