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
	$.fn.yiiGridView.update('file-asset-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('app', 'Manage') . ' ' . GxHtml::encode($model->label(2)); ?></h1>

<div class="flash-notice"><?php echo Yii::t('app', 'You may optionally enter a comparison operator (&lt;, &lt;=, &gt;, &gt;=, &lt;&gt; or =) at the beginning of each of your search values to specify how the comparison should be done'); ?>.</div>

<?php $this->widget('bootstrap.widgets.TbButtonGroup', array(
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
        'mGridId'=>'file-asset-grid',
        'mPageSize' => @$_GET['pageSize'],
        'mDefPageSize' => Yii::app()->params['defaultPageSize'],
        'mPageSizeOptions'=>Yii::app()->params['pageSizeOptions'],// Optional, you can use with the widget default
        'label' => yii::t('app', 'Items per page')
));
?>
</div>
<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'file-asset-grid',
	'dataProvider'=>$model->search(),
        'type'=>'striped bordered condensed',
	'filter'=>$model,
	'columns'=>array(
		'name',
//		'location',
		'creationDttm',
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
//            'class' => 'CButtonColumn',
            'template' => '{download}',
//            'template' => '{downloadXml}{downloadPdf}{add}{delete}',
            'htmlOptions' => array('nowrap' => 'nowrap'),
            'buttons' => array(
                'downloadXml' => array(
                    'label' => 'Download',
                    'options' => array('title' => yii::t('app', 'Download')),
                    'imageUrl' => Yii::app()->theme->baseUrl . '/images/yanus-small-icons/file-xml.png',
                    'url' => '$this->grid->controller->createUrl("/Cfd/dlFile", array("id"=>$data->id, "type"=>"cfd"))',
//                    'url' => '$this->grid->controller->createUrl("/Extras/update", array("id"=>$data->id,"asDialog"=>1,"gridId"=>$this->grid->id))',
//                    'click' => 'function(){$("#cru-frame").attr("src",$(this).attr("href")); $("#cru-dialog").dialog("open");  return false;}',
//                    'visible' => '($data->cfdFile !== null && $data->swGetStatus()->getId()==Cfd::STATUS_READY)'
                ),
//                'downloadPdf' => array(
//                    'label' => 'PDF',
//                    'options' => array('title' => yii::t('app', 'Download PDF')),
//                    'imageUrl' => Yii::app()->theme->baseUrl . '/images/yanus-small-icons/file-pdf.png',
//                    'url' => '$this->grid->controller->createUrl("/Cfd/dlFile", array("id"=>$data->id, "type"=>"pdf"))',
////                    'url' => '$this->grid->controller->createUrl("/Extras/update", array("id"=>$data->id,"asDialog"=>1,"gridId"=>$this->grid->id))',
////                    'click' => 'function(){$("#cru-frame").attr("src",$(this).attr("href")); $("#cru-dialog").dialog("open");  return false;}',
////                    'visible' => '($data->pdfFile !== null && $data->swGetStatus()->getId()==Cfd::STATUS_READY)'
//                ),
//                'mail' => array(
//                    'label' => 'Mail',
//                    'options' => array('title' => yii::t('app', 'Send')),
//                    'icon' => 'icon-envelope',
//                    'url' => '$this->grid->controller->createUrl("/Extras/update", array("id"=>$data->id,"asDialog"=>1,"gridId"=>$this->grid->id))',
////                    'click' => 'function(){$("#cru-frame").attr("src",$(this).attr("href")); $("#cru-dialog").dialog("open");  return false;}',
////                    'visible' => '($data->swGetStatus()->getId()==Cfd::STATUS_READY)'
//                ),
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
        ),	),
)); ?>