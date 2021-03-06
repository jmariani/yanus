<?php
//    $this->layout = '//layouts/column1';
    $this->breadcrumbs = array($model->label(2),);Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});

$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('party-mail-grid', {
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
    array('id'=>'party-mail-grid',
    'dataProvider'=>$model->search(),
    'type'=>'striped bordered condensed',
    'filter'=>$model,
    'template'=>"{items}\n{pager}{summary}",
    'columns'=>array(		'value',
		array(
					'name' => 'active',
					'value' => '($data->active == 0) ? Yii::t(\'app\', \'No\') : Yii::t(\'app\', \'Yes\')',
					'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
					),
		'effDt',
		array(
				'name'=>'Party_id',
				'value'=>'GxHtml::valueEx($data->party)',
				'filter'=>GxHtml::listDataEx(Party::model()->findAllAttributes(null, true)),
				),
		array(
				'name'=>'PartyMailType_id',
				'value'=>'GxHtml::valueEx($data->partyMailType)',
				'filter'=>GxHtml::listDataEx(PartyMailType::model()->findAllAttributes(null, true)),
				),
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