<?php
//    $this->layout = '//layouts/column1';
    $this->breadcrumbs = array($model->label(2),);Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});

$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('party-payment-method-grid', {
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
$this->widget('bootstrap.widgets.TbGroupGridView',
            array('id'=>'party-payment-method-grid',
//    'fixedHeader' => true,
    'dataProvider' => $model->search(),
    'type' => 'striped bordered condensed hover',
    'enableHistory' => true,
    'filter' => $model,
    'responsiveTable' => true,
    'template'=>"{items}\n{pager}{summary}",
    'mergeColumns' => array('partyCustomerId','partyName'),
    'columns' => array(
        'partyName',
        array(
            'name' => 'partyCustomerId',
//            'value' => '$data->party->primaryName',
//            'filter' => GxHtml::listDataEx(Party::model()->findAllAttributes(null, true)),
//            'header' => 'Name',
            'htmlOptions' => array('style' => 'text-align: right'),
        ),
        'method', 'bankAcct',
        array(
            'class'=>'bootstrap.widgets.TbToggleColumn',
            'toggleAction'=>'partymail/toggle',
            'name' => 'active',
            'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
//            'htmlOptions' => array('align' => 'center'),
        ),
//		'effDt',
//		array(
//				'name'=>'Party_id',
//				'value'=>'GxHtml::valueEx($data->party)',
//				'filter'=>GxHtml::listDataEx(Party::model()->findAllAttributes(null, true)),
//				),
        // Uncomment the following lines if you want standard button columns
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => '{update}',
            'htmlOptions' => array('style' => 'width: 10px'),
            'headerHtmlOptions'=>array('style'=>'width: 10px;'),
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
?><?php $this->endWidget(); ?>