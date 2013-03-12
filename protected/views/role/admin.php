<?php
$this->layout = '//layouts/column1';
$this->breadcrumbs = array($model->label(2),);
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});

$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('role-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<?php
$box = $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => Yii::t('app', 'Manage') . ' ' . $model->label(2),
    'headerIcon' => 'icon-list',
    'headerButtons' => array(
        array(
            'class' => 'bootstrap.widgets.TbButtonGroup',
            'size' => 'mini',
            'buttons' => array(
                array(
                    'icon' => 'icon-file',
                    'url' => array('create'),
                    'htmlOptions' => array(
                        'rel' => 'tooltip',
                        'title' => Yii::t('app', 'Create new {model}', array('{model}' => $model->label())),
                    ),
                ),
            ),
        ),
    )
        ));
?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search', array('model' => $model,)); ?>
</div><!-- search-form -->
<?php
$this->widget('bootstrap.widgets.TbGridView', array('id' => 'role-grid',
    'dataProvider' => $model->search(),
    'type' => 'striped bordered condensed hover',
    'responsiveTable' => true,
    'filter' => $model,
    'columns' => array('code',
        'name',
        'class',
    // Uncomment the following lines if you want standard button columns
    //array(
    //    'class'=>'bootstrap.widgets.TbButtonColumn',
    //    'htmlOptions'=>array('style'=>'width: 50px'),
    //),
    ),
    )
);
?><?php $this->endWidget(); ?>