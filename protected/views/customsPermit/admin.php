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
	$.fn.yiiGridView.update('customs-permit-grid', {
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
        array(
            'buttonType'=>'link',
            'icon'=>'plus',
            'url' => array('create'),
            'htmlOptions' => array('rel' => 'tooltip', 'title' => Yii::t('app', 'Create new' . ' ' . $model->label()), )),
//        array(
//            'buttonType'=>'link',
//            'icon'=>'upload',
//            'url' => array('upload'),
//            'htmlOptions' => array('rel' => 'tooltip', 'title' => Yii::t('app', 'Upload new') . ' ' . $model->label(), )),
    ),
));
?>


<?php // echo GxHtml::link(Yii::t('app', 'Advanced Search'), '#', array('class' => 'search-button btn')); ?><?php // echo GxHtml::link(Yii::t('app', 'Create new' . ' ' . $model->label()), yii::app()->baseUrl . '/' . $model->label() . '/create', array('class' => 'btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search', array(
	'model' => $model,
)); ?>
</div><!-- search-form -->
<div align="right" class="row">
<?php $this->widget('application.extensions.PageSize.PageSize', array(
        'mGridId'=>'customs-permit-grid',
        'mPageSize' => @$_GET['pageSize'],
        'mDefPageSize' => Yii::app()->params['defaultPageSize'],
        'mPageSizeOptions'=>Yii::app()->params['pageSizeOptions'],// Optional, you can use with the widget default
        'label' => yii::t('app', 'Items per page')
));
?>
</div>
<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'customs-permit-grid',
	'dataProvider'=>$model->search(),
        'type'=>'striped bordered condensed',
	'filter'=>$model,
	'columns'=>array(
		'nbr',
		'dt',
		'office',
//                array(
//                    'class'=>'bootstrap.widgets.TbButtonColumn',
//                    'htmlOptions'=>array('style'=>'width: 50px'),
//                ),
	),
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