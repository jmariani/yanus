<?php

$this->breadcrumbs = array(
	yii::t('app', 'Persons'),
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

<h1><?php echo Yii::t('app', 'Manage') . ' ' . GxHtml::encode(yii::t('app', 'Persons')); ?></h1>

<div class="flash-notice"><?php echo Yii::t('app', 'You may optionally enter a comparison operator (&lt;, &lt;=, &gt;, &gt;=, &lt;&gt; or =) at the beginning of each of your search values to specify how the comparison should be done'); ?>.</div>
<?php $this->widget('bootstrap.widgets.BootButtonGroup', array(
    'buttons'=>array(
        array('buttonType'=>'link', 'icon'=>'search', 'label'=>Yii::t('app', 'Advanced Search'), 'url' => '#', 'htmlOptions' => array('class' => 'search-button')),
        array('buttonType'=>'link', 'icon'=>'plus', 'label'=>Yii::t('app', 'Create new' . ' ' . yii::t('app', 'Person')), 'url' => array('createPerson')),
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
        'mGridId'=>'party-grid',
        'mPageSize' => @$_GET['pageSize'],
        'mDefPageSize' => Yii::app()->params['defaultPageSize'],
        'mPageSizeOptions'=>Yii::app()->params['pageSizeOptions'],// Optional, you can use with the widget default
        'label' => yii::t('app', 'Items per page')
));
?>
</div>
<?php $this->widget('bootstrap.widgets.BootGridView',array(
	'id'=>'party-grid',
	'dataProvider'=>$model->search(false),
        'type'=>'striped bordered condensed',
	'filter'=>$model,
	'columns'=>array(
//            'name',
            array('header' => yii::t('app', 'Name'), 'value' => '$data->partyNames[0]->fullName'),
//            array('header' => yii::t('app', 'Surname'), 'value' => '$data->partyNames[0]->surName'),
//            array('header' => yii::t('app', 'Mother Family Name'), 'value' => '$data->partyNames[0]->motherFamilyName'),
//            array('header' => yii::t('app', 'First Name'), 'value' => '$data->partyNames[0]->firstName'),
//            array('header' => yii::t('app', 'Second Name(s)'), 'value' => '$data->partyNames[0]->secondName'),
            array(
                'class'=>'bootstrap.widgets.BootButtonColumn',
                'htmlOptions'=>array('style'=>'width: 50px'),
            ),
	),
)); ?>