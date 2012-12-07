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
	$.fn.yiiGridView.update('payment-term-grid', {
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
        'mGridId'=>'payment-term-grid',
        'mPageSize' => @$_GET['pageSize'],
        'mDefPageSize' => Yii::app()->params['defaultPageSize'],
        'mPageSizeOptions'=>Yii::app()->params['pageSizeOptions'],// Optional, you can use with the widget default
        'label' => yii::t('app', 'Items per page')
));
?>
</div>
<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'payment-term-grid',
	'dataProvider'=>$model->search(),
        'type'=>'striped bordered condensed',
	'filter'=>$model,
	'columns'=>array(
		'name',
		'code',
		'days',
                array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'htmlOptions'=>array('style'=>'width: 50px'),
                ),
	),
)); ?>