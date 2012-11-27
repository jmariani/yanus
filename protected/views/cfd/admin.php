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

<?php
Yii::app()->user->setFlash('info', '<strong>Note: </strong> ' . Yii::t('app', 'You may optionally enter a comparison operator (&lt;, &lt;=, &gt;, &gt;=, &lt;&gt; or =) at the beginning of each of your search values to specify how the comparison should be done'));
$this->widget('bootstrap.widgets.TbAlert', array(
    'block' => true, // display a larger alert block?
    'fade' => true, // use transitions?
    'closeText' => false, // close link text - if set to false, no close link is displayed
//    'alerts'=>array( // configurations per alert type
//        'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'×'), // success, info, warning, error or danger
//        'info'=>array('block'=>true, 'fade'=>true, ), // success, info, warning, error or danger
//    ),
));
?>

<?php
$this->widget('bootstrap.widgets.TbButtonGroup', array(
    'buttons' => array(
        array(
            'buttonType' => 'link',
            'icon' => 'search',
            'url' => '#',
            'htmlOptions' => array('class' => 'search-button', 'rel' => 'tooltip', 'title' => Yii::t('app', 'Advanced Search'))),
        array(
            'buttonType' => 'link',
            'icon' => 'plus',
            'url' => array('create'),
            'htmlOptions' => array('rel' => 'tooltip', 'title' => Yii::t('app', 'Create new' . ' ' . $model->label()),)),
    ),
));
?>

<!--
";?>
";?>
-->

<div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->
<div align="right" class="row">
    <?php
    $this->widget('application.extensions.PageSize.PageSize', array(
        'mGridId' => 'cfd-grid',
        'mPageSize' => @$_GET['pageSize'],
        'mDefPageSize' => Yii::app()->params['defaultPageSize'],
        'mPageSizeOptions' => Yii::app()->params['pageSizeOptions'], // Optional, you can use with the widget default
        'label' => yii::t('app', 'Items per page')
    ));
    ?>
</div>
<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'cfd-grid',
    'dataProvider' => $model->search(),
    'type' => 'striped bordered condensed',
    'filter' => $model,
                'responsiveTable' => true,

    'columns' => array(
        array(
            'type' => 'raw',
            'name' => 'invoice',
            'value' => 'CHtml::link($data->invoice, array("Cfd/view", "id"=>$data->id));',
        ),
        'dttm',
        array(
            'name' => 'status',
            'type' => 'raw',
            'value' => 'CHtml::tag("span", array("class" => "label " . $data->getStatusLabelClass()), $data->swGetStatus()->getLabel(), true)',
            'filter' => SWHelper::allStatuslistData($model),
        ),
//		array(
//                    'type' => 'raw',
//                    'header' => yii::t('app', 'Vendor'),
//                    'name'=>'vendorSearch',
//                    'value' => '$data->vendor->party->Rfc->value . " - " . $data->vendor->party->Name->fullName'
//                ),
        array(
            'name' => 'customerSearch',
            'type' => 'raw',
            'header' => yii::t('app', 'Customer'),
            'value' => '$data->customerParty->rfc . " - " . $data->customerParty->name'
        ),
//                'tax',
        array(
            'type' => 'text',
            'name' => 'total',
            'header' => yii::t('app', 'Total'),
            'value' => 'number_format($data->total, 2)',
            'htmlOptions' => array('style' => 'text-align: right'),
            'headerHtmlOptions' => array('style' => 'text-align: right')
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
//        array(
//            'htmlOptions' => array('nowrap' => 'nowrap'),
//            'class' => 'bootstrap.widgets.TbButtonColumn',
////            'htmlOptions' => array('style' => 'width: 50px'),
//        ),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
//            'class' => 'CButtonColumn',
            'template' => '{downloadXml}{downloadPdf}{mail}',
//            'template' => '{downloadXml}{downloadPdf}{add}{delete}',
            'htmlOptions' => array('nowrap' => 'nowrap'),
            'buttons' => array(
                'downloadXml' => array(
                    'label' => 'XML',
                    'options' => array('title' => yii::t('app', 'Download XML')),
                    'imageUrl' => Yii::app()->theme->baseUrl . '/images/yanus-small-icons/file-xml.png',
                    'url' => '$this->grid->controller->createUrl("/Cfd/dlFile", array("id"=>$data->id, "type"=>"cfd"))',
//                    'url' => '$this->grid->controller->createUrl("/Extras/update", array("id"=>$data->id,"asDialog"=>1,"gridId"=>$this->grid->id))',
//                    'click' => 'function(){$("#cru-frame").attr("src",$(this).attr("href")); $("#cru-dialog").dialog("open");  return false;}',
                    'visible' => '($data->cfdFile !== null && $data->swGetStatus()->getId()==Cfd::STATUS_READY)'
                ),
                'downloadPdf' => array(
                    'label' => 'PDF',
                    'options' => array('title' => yii::t('app', 'Download PDF')),
                    'imageUrl' => Yii::app()->theme->baseUrl . '/images/yanus-small-icons/file-pdf.png',
                    'url' => '$this->grid->controller->createUrl("/Cfd/dlFile", array("id"=>$data->id, "type"=>"pdf"))',
//                    'url' => '$this->grid->controller->createUrl("/Extras/update", array("id"=>$data->id,"asDialog"=>1,"gridId"=>$this->grid->id))',
//                    'click' => 'function(){$("#cru-frame").attr("src",$(this).attr("href")); $("#cru-dialog").dialog("open");  return false;}',
                    'visible' => '($data->pdfFile !== null && $data->swGetStatus()->getId()==Cfd::STATUS_READY)'
                ),
                'mail' => array(
                    'label' => 'Mail',
                    'options' => array('title' => yii::t('app', 'Send')),
                    'icon' => 'icon-envelope',
                    'url' => '$this->grid->controller->createUrl("/Extras/update", array("id"=>$data->id,"asDialog"=>1,"gridId"=>$this->grid->id))',
//                    'click' => 'function(){$("#cru-frame").attr("src",$(this).attr("href")); $("#cru-dialog").dialog("open");  return false;}',
                    'visible' => '($data->swGetStatus()->getId()==Cfd::STATUS_READY)'
                ),
//                'add' => array(
//                    'label' => 'Add',
//                    'imageUrl' => Yii::app()->request->baseUrl . '/css/gridViewStyle/images/gr-plus.png',
//                    'url' => '$this->grid->controller->createUrl("/Extras/create", array("eid"=>$data->extras_id, "bid"=>' . $model->id . ', "asDialog"=>1,"gridId"=>$this->grid->id))',
//                    'click' => 'function(){$("#cru-frame").attr("src",$(this).attr("href")); $("#cru-dialog").dialog("open");  return false;}',
////                    'visible' => '($data->id===null)?true:false;'
//                ),
//                'delete' => array(
//                    'url' => '$this->grid->controller->createUrl("/Extras/delete", array("id"=>$data->primaryKey,"asDialog"=>1,"gridId"=>$this->grid->id))',
//                ),
            ),
        ),
    ),
));
?>