<?php
//    $this->layout = '//layouts/column2';
    $this->breadcrumbs = array($model->label(2),);Yii::app()->clientScript->registerScript('search', "
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
$this->menu=array(
        array('label'=>'<i class="icon icon-upload"></i>  Upload new ' . IncomingInvoiceInterfaceFile::label(),
            'url'=>array('upload'),'itemOptions'=>array('class'=>'')),
);

?>
<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
	'title' => Yii::t('app', 'Manage') . ' ' . $model->label(2),
        'headerIcon' => 'icon-list',
        'headerButtons' => array(
            array(
                'class' => 'bootstrap.widgets.TbButtonGroup',
                'size' => 'mini',
                'buttons' => array(
                    array(
                        'icon' => 'icon-upload',
                        'url' => array('create'),
                        'htmlOptions' => array(
                            'rel' => 'tooltip',
                            'title' => Yii::t('app', 'Upload {model}', array('{model}' => $model->label())),
                        ),
                    ),
                ),
            ),
         )
));?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search', array('model' => $model,)); ?>
</div><!-- search-form -->
<?php
$this->widget('bootstrap.widgets.TbGridView',
    array('id'=>'incoming-invoice-interface-file-grid',
    'dataProvider'=>$model->search(),
    'type'=>'striped bordered condensed',
    'filter'=>$model,
    'columns'=>array(
        array(
            'type' => 'raw',
            'name' => 'fileName',
            'value' => 'CHtml::link($data->fileName, array("IncomingInvoiceInterfaceFile/view", "id"=>$data->id));',
        ),
//        'fileName',
        array(
            'type' => 'raw',
            'name' => 'status',
            'value' => '$data->swGetStatus()->label'
        ),
//		'status',
		'receptionDttm',
//		'validationDttm',
		'processDttm',
		'note',
		/*
		'fileLocation',
		'logFileLocation',
		*/
        // Uncomment the following lines if you want standard button columns
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => '{view}{update}',
            'htmlOptions' => array('style' => 'width: 30px'),
            'headerHtmlOptions'=>array('style'=>'width:30px;'),
        ),
            ),
            'pager' => array(
                'class' => 'tbpager', // **use extended CLinkPager class**
//                'cssFile' => false, //prevent Yii autoloading css
//                'alignment' => TbPager::ALIGNMENT_CENTER,
                'displayFirstAndLast' => true,
//                'header' => false, // hide 'go to page' header
                'firstPageLabel' => '&lt;&lt;', // change pager button labels
//                'prevPageLabel' => '&lt;',
//                'nextPageLabel' => '&gt;',
                'lastPageLabel' => '&gt;&gt;',
            ),
        )
    );
?><?php $this->endWidget();?>