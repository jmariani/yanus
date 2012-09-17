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
        array(
            'buttonType'=>'link',
            'icon'=>'plus',
            'url' => array('create'),
            'htmlOptions' => array('rel' => 'tooltip', 'title' => Yii::t('app', 'Create new' . ' ' . $model->label()), )),
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
                array(
                    'type' => 'raw',
                    'name' => 'invoice',
                    'value'=>'CHtml::link($data->invoice, array("Cfd/view", "id"=>$data->id));',
                ),
                'dttm',
		array(
				'name'=>'vendorParty_id',
				'value'=>'$data->vendorParty->Rfc->value',
				'filter'=>GxHtml::listDataEx(Party::model()->findAllAttributes(null, true), null, 'rfc'),
				),
		array(
				'name'=>'customerParty_id',
				'value'=>'$data->customerParty->Rfc->value',
				'filter'=>GxHtml::listDataEx(Party::model()->findAllAttributes(null, true)),
				),
		array(
				'name'=>'customerParty_id',
				'value'=>'$data->customerParty->Name->fullName',
				'filter'=>GxHtml::listDataEx(Party::model()->findAllAttributes(null, true)),
				),


//		'invoice',
//		'version',
//		'serial',
//		'folio',
//		'uuid',
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
                 */
                /*
		'originalString',
		'cbb',
		array(
				'name'=>'SatCertificate_id',
				'value'=>'GxHtml::valueEx($data->satCertificate)',
				'filter'=>GxHtml::listDataEx(SatCertificate::model()->findAllAttributes(null, true)),
				),
		array(
				'name'=>'dtsSatCertificate_id',
				'value'=>'GxHtml::valueEx($data->dtsSatCertificate)',
				'filter'=>GxHtml::listDataEx(SatCertificate::model()->findAllAttributes(null, true)),
				),
		'localTaxAmt',
		'localWhtAmt',
		array(
				'name'=>'CfdStatus_id',
				'value'=>'GxHtml::valueEx($data->cfdStatus)',
				'filter'=>GxHtml::listDataEx(CfdStatus::model()->findAllAttributes(null, true)),
				),
		*/
                array(
                    'class'=>'bootstrap.widgets.BootButtonColumn',
                    'htmlOptions'=>array('style'=>'width: 50px'),
                ),
	),
)); ?>