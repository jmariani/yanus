<?php

$this->breadcrumbs = array(
	$model->label(2) => array('admin'),
	Yii::t('app', 'Manage'),
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
	$.fn.yiiGridView.update('incoming-invoice-interface-file-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<div class="page-header">
    <h1><?php echo Yii::t('app', 'Manage') . ' ' . GxHtml::encode($model->label(2)); ?></h1>
</div>

<!--<div class="flash-notice"><?php // echo Yii::t('app', 'You may optionally enter a comparison operator (&lt;, &lt;=, &gt;, &gt;=, &lt;&gt; or =) at the beginning of each of your search values to specify how the comparison should be done'); ?>.</div>-->
<?php
Yii::app()->user->setFlash('info', '<strong>Note: </strong> ' . Yii::t('app', 'You may optionally enter a comparison operator (&lt;, &lt;=, &gt;, &gt;=, &lt;&gt; or =) at the beginning of each of your search values to specify how the comparison should be done'));
$this->widget('bootstrap.widgets.TbAlert', array(
    'block'=>true, // display a larger alert block?
    'fade'=>true, // use transitions?
    'closeText'=>false, // close link text - if set to false, no close link is displayed
//    'alerts'=>array( // configurations per alert type
//        'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'×'), // success, info, warning, error or danger
//        'info'=>array('block'=>true, 'fade'=>true, ), // success, info, warning, error or danger
//    ),
));
?>

<?php $this->widget('bootstrap.widgets.TbButtonGroup', array(
    'buttons'=>array(
//        array(
//            'buttonType'=>'link',
//            'icon'=>'search',
//            'url' => '#',
//            'htmlOptions' => array('class' => 'search-button', 'rel'=>'tooltip', 'title'=>Yii::t('app', 'Advanced Search'))),
//        array(
//            'buttonType'=>'link',
//            'icon'=>'plus',
//            'url' => array('create'),
//            'htmlOptions' => array('rel' => 'tooltip', 'title' => Yii::t('app', 'Create new' . ' ' . $model->label()), )),
        array(
            'buttonType'=>'link',
            'icon'=>'upload',
            'url' => array('upload'),
            'htmlOptions' => array('rel' => 'tooltip', 'title' => Yii::t('app', 'Upload new') . ' ' . $model->label(), )),
    ),
));
?>
<?php $this->widget('application.extensions.PageSize.PageSize', array(
        'mGridId'=>'incoming-invoice-interface-file-grid',
        'mPageSize' => @$_GET['pageSize'],
        'mDefPageSize' => Yii::app()->params['defaultPageSize'],
        'mPageSizeOptions'=>Yii::app()->params['pageSizeOptions'],// Optional, you can use with the widget default
        'label' => yii::t('app', 'Items per page'),
        'htmlOptions' => array('class' => 'pull-right'),
));
?>

<!--
";?>
";?>
-->

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search', array(
	'model' => $model,
)); ?>
</div><!-- search-form -->
<?php
    $this->widget('bootstrap.widgets.TbGridView',array(
//    $this->widget('bootstrap.widgets.TbExtendedGridView',array(
	'id'=>'incoming-invoice-interface-file-grid',
//    	'fixedHeader' => true,
	'dataProvider'=>$model->search(),
        'type'=>'striped bordered condensed',
	'filter'=>$model,
	'columns'=>array(
            array(
                'type' => 'raw',
                'name' => 'status',
                'value'=>'CHtml::tag("span", array("class" => "label " . $data->getStatusLabelClass()), $data->swGetStatus()->getLabel(), true)',
                'filter'=> SWHelper::allStatuslistData($model),
            ),
            array(
                'type' => 'raw',
                'name' => 'fileName',
//                'value'=>'CHtml::link($data->fileName, array("incomingInvoiceInterfaceFile/view", "id"=>$data->id));',
                'value'=>'CHtml::link($data->fileName, array("incomingInvoiceInterfaceFile/dlFile", "id"=>$data->id));',
//                'htmlOptions'=>array('rel'=>'popover', 'data-title'=>'Heading', 'data-content'=>'Content ...',),
            ),
            'receptionDttm',
            'validationDttm',
            'processDttm',
		'note',
//                array(
//                    'class'=>'bootstrap.widgets.BootButtonColumn',
//                    'htmlOptions'=>array('style'=>'width: 50px'),
//                ),
	),
//        'itemsCssClass' => 'table table-striped', // override default css
//                'pagerCssClass' => 'pagination', // override default css
//    'summaryCssClass' => 'alert alert-info', // override default css
        'pager' => array(
                'class' => 'tbpager', // **use extended CLinkPager class**
                'cssFile' => false, //prevent Yii autoloading css
                'alignment' => TbPager::ALIGNMENT_CENTER,
                'displayFirstAndLast' => true,
                'header' => false, // hide 'go to page' header
                'firstPageLabel' => '&lt;&lt;', // change pager button labels
//                'prevPageLabel' => '&lt;',
//                'nextPageLabel' => '&gt;',
                'lastPageLabel' => '&gt;&gt;',
            ),
)); ?>