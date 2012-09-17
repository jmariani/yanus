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
	$.fn.yiiGridView.update('party-type-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('app', 'Manage') . ' ' . GxHtml::encode($model->label(2)); ?></h1>

<div class="flash-notice"><?php echo Yii::t('app', 'You may optionally enter a comparison operator (&lt;, &lt;=, &gt;, &gt;=, &lt;&gt; or =) at the beginning of each of your search values to specify how the comparison should be done'); ?>.</div>
<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'link', 'icon'=>'search', 'label'=>Yii::t('app', 'Advanced Search'), 'url' => '#', 'htmlOptions' => array('class' => 'search-button'))); ?>
<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'link', 'type' => 'primary', 'icon'=>'plus', 'label'=>Yii::t('app', 'Create new' . ' ' . $model->label()), 'url' => array('create'))); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search', array(
	'model' => $model,
)); ?>
</div><!-- search-form -->
<div align="right" class="row">
<?php $this->widget('application.extensions.PageSize.PageSize', array(
        'mGridId'=>'party-type-grid',
        'mPageSize' => @$_GET['pageSize'],
        'mDefPageSize' => Yii::app()->params['defaultPageSize'],
        'mPageSizeOptions'=>Yii::app()->params['pageSizeOptions'],// Optional, you can use with the widget default
        'label' => yii::t('app', 'Items per page')
));
?>
</div>
<?php $this->widget('bootstrap.widgets.BootGridView',array(
	'id'=>'party-type-grid',
	'dataProvider'=>$model->search(),
        'type'=>'striped bordered condensed',
	'filter'=>$model,
	'columns'=>array(
		'name',
		array(
					'name' => 'active',
					'value' => '($data->active == 0) ? Yii::t(\'app\', \'No\') : Yii::t(\'app\', \'Yes\')',
					'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
					),
		array(
					'name' => 'personType',
					'value' => '($data->personType == 0) ? Yii::t(\'app\', \'No\') : Yii::t(\'app\', \'Yes\')',
					'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
					),
		array(
					'name' => 'businessType',
					'value' => '($data->businessType == 0) ? Yii::t(\'app\', \'No\') : Yii::t(\'app\', \'Yes\')',
					'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
					),
                array(
                    'class'=>'bootstrap.widgets.BootButtonColumn',
                    'htmlOptions'=>array('style'=>'width: 50px'),
                ),
	),
)); ?>