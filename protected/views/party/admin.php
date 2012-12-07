<?php

$this->breadcrumbs = array(
    yii::t('app', ($model->person ? 'Persons' : 'Companies')),
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
	$.fn.yiiGridView.update('party-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
	'title' => Yii::t('app', 'Manage') . ' ' . yii::t('app', 'Invoice Notification Mail Addresses'),
        'headerIcon' => 'icon-envelope',
	// when displaying a table, if we include bootstra-widget-table class
	// the table will be 0-padding to the box
//	'htmlOptions' => array('class'=>'bootstrap-widget-table')
//    'headerButtonActionsLabel' => 'My actions',
    'headerActions' => array(
	    array('label'=>'first action', 'url'=>'#', 'icon'=>'plus'),
	    array('label'=>'second action', 'url'=>'#', 'icon'=>'icon-headphones'),
	    '---',
	    array('label'=>'third action', 'url'=>'#', 'icon'=>'icon-facetime-video')
    )
));?>

<!--<h1><?php echo Yii::t('app', 'Manage') . ' ' . GxHtml::encode(yii::t('app', ($model->person ? 'Persons' : 'Companies'))); ?></h1>-->

<!--<div class="flash-notice"><?php echo Yii::t('app', 'You may optionally enter a comparison operator (&lt;, &lt;=, &gt;, &gt;=, &lt;&gt; or =) at the beginning of each of your search values to specify how the comparison should be done'); ?>.</div>-->
<?php
//    $this->widget('bootstrap.widgets.TbButtonGroup', array(
//        'buttons'=>array(
//            array('buttonType'=>'link', 'icon'=>'search', 'label'=>Yii::t('app', 'Advanced Search'), 'url' => '#', 'htmlOptions' => array('class' => 'search-button')),
//            array('buttonType'=>'link', 'icon'=>'plus', 'label'=>Yii::t('app', 'Create new' . ' ' . yii::t('app', ($model->person ? 'Person' : 'Company'))), 'url' => array(($model->person ? 'createPerson' : 'createCompany'))),
//        ),
//    ));
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
<!--
<div align="right" class="row">
<?php
    $this->widget('application.extensions.PageSize.PageSize', array(
        'mGridId'=>'party-grid',
        'mPageSize' => @$_GET['pageSize'],
        'mDefPageSize' => Yii::app()->params['defaultPageSize'],
        'mPageSizeOptions'=>Yii::app()->params['pageSizeOptions'],// Optional, you can use with the widget default
        'label' => yii::t('app', 'Items per page')
));
?>
</div>-->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'party-grid',
	'dataProvider'=>$model->search(!$model->person),
        'type'=>'striped bordered condensed',
	'filter'=>$model,
	'columns'=>array(
		'name',
                array(
                    'header' => yii::t('app', 'Email'),
                    'type' => 'raw',
//                    'name' => 'invoice',
                    'value' => 'invoice@invoice.com.mx',
                ),
                array(
                    'header' => yii::t('app', 'Active'),
                    'type' => 'raw',
//                    'name' => 'invoice',
                    'value' => '',
                ),
                array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'htmlOptions'=>array('style'=>'width: 50px'),
                ),
	),
)); ?>
<?php $this->endWidget();?>