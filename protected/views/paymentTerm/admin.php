<?php
//    $this->layout = '//layouts/column1';
    $this->breadcrumbs = array($model->label(2),);Yii::app()->clientScript->registerScript('search', "
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
<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
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
));?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search', array('model' => $model,)); ?>
</div><!-- search-form -->
<?php
$this->widget('bootstrap.widgets.TbGridView',
    array('id'=>'payment-term-grid',
    'dataProvider'=>$model->search(),
    'type'=>'striped bordered condensed',
    'filter'=>$model,
    'template'=>"{items}\n{pager}{summary}",
    'columns'=>array(		'code',
		'name',
		'days',
                // Uncomment the following lines if you want standard button columns
                // array(
                // 'class' => 'bootstrap.widgets.TbButtonColumn',
                // 'template' => '{view}{update}{delete}',  // To modify the standard template
                // 'htmlOptions' => array('style' => 'width: 40px'),    // To modifiy the width
                //  'headerHtmlOptions'=>array('style'=>'width:40px;'), // To modifiy the width
                // ),
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