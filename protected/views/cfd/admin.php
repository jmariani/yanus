<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	Yii::t('app', 'Manage'),
);

//$this->menu = array(
//		array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('index')),
//		array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('create')),
//	);

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
<div class="flash-notice"><?php echo yii::t('app', 'You may optionally enter a comparison operator (&lt;, &lt;=, &gt;, &gt;=, &lt;&gt; or =) at the beginning of each of your search values to specify how the comparison should be done.');?>.</div>

<?php echo GxHtml::link(Yii::t('app', 'Advanced Search'), '#', array('class' => 'search-button btn')); ?>
<div class="search-form" style="display:none">
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
                array(
                    'name' => 'invoice',
                    'type'=>'raw',
                    'value' => 'GxHtml::link($data->invoice, array("cfd/view", "id" => $data->id))'
                ),
                'voucherType',
		'uuid',
                array(
                    'name' => 'dttm',
                    'htmlOptions'=>array('style'=>'text-align: center'),
                    'value'=>'date_format(date_create($data->dttm), "d/m/Y H:i:s")',
                    'headerHtmlOptions'=>array('style'=>'text-align: center'),
                ),
		'customerRfc',
		'customerName',
                array(
                    'name' => 'total',
                    'htmlOptions'=>array('style'=>'text-align: right'),
                    'headerHtmlOptions'=>array('style'=>'text-align: right'),
                    'type' => 'number'
                ),
                array(
                    'name' => 'currency',
                    'htmlOptions'=>array('style'=>'text-align: center'),
                    'headerHtmlOptions'=>array('style'=>'text-align: center'),
                ),
                array(
                    'name' => 'exchangeRate',
                    'htmlOptions'=>array('style'=>'text-align: right'),
                    'headerHtmlOptions'=>array('style'=>'text-align: right'),
                    'type' => 'number'
                ),
		/*
		'seal',
		'paymentType',
		'certNbr',
		'certificate',
		'paymentTerms',
		'subTotal',
		'discount',
		'discountReason',

		'paymentMethod',
		'expeditionPlace',
		'paymentAcctNbr',
		'sourceFolio',
		'sourceSerial',
		'sourceDttm',
		'sourceAmt',
		'vendorRfc',
		'vendorName',
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
//                array(
//                    'class'=>'bootstrap.widgets.BootButtonColumn',
//                    'template' => '{view}',
//                    'viewButtonUrl'=>'Yii::app()->createUrl("/cfd/view", array("id" => $data["id"]))',
//                    'htmlOptions'=>array('style'=>'width: 10px'),
//                ),
	),
)); ?>