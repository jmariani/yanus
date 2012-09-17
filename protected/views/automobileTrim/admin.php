<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	Yii::t('app', 'Manage'),
);

$this->menu = array(
		array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('index')),
		array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('create')),
	);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});

$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('automobile-trim-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('app', 'Manage') . ' ' . GxHtml::encode($model->label(2)); ?></h1>

<div class="flash-notice"><?php echo Yii::t('app', 'You may optionally enter a comparison operator (&lt;, &lt;=, &gt;, &gt;=, &lt;&gt; or =) at the beginning of each of your search values to specify how the comparison should be done'); ?>.</div>

<?php echo GxHtml::link(Yii::t('app', 'Advanced Search'), '#', array('class' => 'search-button btn')); ?><div class="search-form" style="display:none">
<?php // $this->renderPartial('_search', array('model' => $model,)); ?>
</div><!-- search-form -->
<?php $this->widget('bootstrap.widgets.BootGridView',array(
	'id'=>'automobile-trim-grid',
	'dataProvider'=>$model->orderByMakerModelName()->with(array('automobileModel', 'automobileModel.automobileMaker'))->search(),
        'type'=>'striped bordered condensed',
	'filter'=>$model,
	'columns'=>array(
		array(
                    'header' => yii::t('app', 'Automobile Maker / Model'),
                    'name'=>'AutomobileModel_id',
                    'value'=>'$data->automobileModel->MakerModel',
                    'filter'=>AutomobileModel::model()->listModelMaker(),
                ),
//		array(
//                    'name'=>'AutomobileModel_id',
//                    'value'=>'GxHtml::valueEx($data->automobileModel)',
//                    'filter'=>GxHtml::listDataEx(AutomobileModel::model()->findAllAttributes(null, true)),
//                ),
		'name',
                array(
                    'class'=>'bootstrap.widgets.BootButtonColumn',
                    'htmlOptions'=>array('style'=>'width: 50px'),
                ),
	),
)); ?>