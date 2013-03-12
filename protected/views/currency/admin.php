<?php
    $this->layout = '//layouts/column2';
    $this->breadcrumbs = array($model->label(2),);Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});

$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('currency-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
$this->menu=array(
        array('label'=>'<i class="icon icon-file"></i>  Create new currency', 'url'=>array('create'),'itemOptions'=>array('class'=>'')),
);

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
$this->widget('bootstrap.widgets.TbGridView',
    array('id'=>'currency-grid',
    'dataProvider'=>$model->search(),
    'type'=>'striped bordered condensed',
    'filter'=>$model,
    'columns'=>array(
//            array(
//                'name' => 'id',
//                'value' => '$data->primaryKey',
//                'selectableRows' => '10', //notice
//                'class' => 'CCheckBoxColumn',
//            ),

        array(
            'type' => 'raw',
            'name' => 'code',
            'value' => 'CHtml::link($data->code, array("Currency/view", "id"=>$data->id));',
        ),
//        'code',
		'name',
		'plural',
		'symbol',
		array(
					'name' => 'active',
					'value' => '($data->active == 0) ? Yii::t(\'app\', \'No\') : Yii::t(\'app\', \'Yes\')',
					'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
					),
                // Uncomment the following lines if you want standard button columns
                //array(
                //    'class'=>'bootstrap.widgets.TbButtonColumn',
                //    'htmlOptions'=>array('style'=>'width: 50px'),
                //),
            ),
        'afterAjaxUpdate'=>'js:function(id,data){$.bind_crud();$("tbody tr:even").addClass("alt-row");}'
        )
    );
?><?php $this->endWidget();?>