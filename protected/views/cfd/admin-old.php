<?php

$this->breadcrumbs = array(
	$model->label(2),
);

$this->layout = '//layouts/column1';

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

<div class="flash-notice"><?php echo Yii::t('app', 'You may optionally enter a comparison operator (&lt;, &lt;=, &gt;, &gt;=, &lt;&gt; or =) at the beginning of each of your search values to specify how the comparison should be done'); ?>.</div>
<?php $this->widget('bootstrap.widgets.BootButtonGroup', array(
    'buttons'=>array(
        array(
            'buttonType'=>'link',
            'icon'=>'search',
            'url' => '#',
            'htmlOptions' => array('class' => 'search-button', 'rel'=>'tooltip', 'title'=>Yii::t('app', 'Advanced Search'))),
//        array(
//            'buttonType'=>'link',
//            'icon'=>'plus',
//            'url' => array('create'),
//            'htmlOptions' => array('rel' => 'tooltip', 'title' => Yii::t('app', 'Create new' . ' ' . $model->label()), )),
        array(
            'buttonType'=>'link',
            'icon'=>'upload',
            'url' => array('upload'),
            'htmlOptions' => array('rel' => 'tooltip', 'title' => Yii::t('app', 'Upload new' . ' ' . $model->label()), )),
    ),
)); ?>
<!--
";?>
";?>
-->

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search', array(
	'model' => $model,
)); ?>
</div><!-- search-form -->
<div align="right" class="row">
<?php $this->widget('application.extensions.PageSize.PageSize', array(
        'mGridId'=>'cfd-grid',
        'mPageSize' => @$_GET['pageSize'],
        'mDefPageSize' => Yii::app()->params['defaultPageSize'],
        'mPageSizeOptions'=>Yii::app()->params['pageSizeOptions'],// Optional, you can use with the widget default
        'label' => yii::t('app', 'Items per page')
));
?>
</div>
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
		'dtsOriginalString',
		'approvalNbr',
		'approvalYear',
		'md5',
		'creationDt',
		'updateDt',
		'status',
		array(
				'name'=>'vendorParty_id',
				'value'=>'GxHtml::valueEx($data->vendorParty)',
				'filter'=>GxHtml::listDataEx(Party::model()->findAllAttributes(null, true)),
				),
		array(
				'name'=>'customerParty_id',
				'value'=>'GxHtml::valueEx($data->customerParty)',
				'filter'=>GxHtml::listDataEx(Party::model()->findAllAttributes(null, true)),
				),
		'originalString',
		'cbb',
		*/
                array(
                    'class'=>'bootstrap.widgets.BootButtonColumn',
                    'htmlOptions'=>array('style'=>'width: 50px'),
                ),
	),
)); ?>