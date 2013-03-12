<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php echo <<<'EOT'
<?php
//    $this->layout = '//layouts/column1';
    $this->breadcrumbs = array($model->label(2),);
EOT;
?>
<?php echo <<<'EOT'
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});

$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('
EOT;
echo $this->class2id($this->modelClass);
echo <<<'EOT'
-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
EOT;
echo PHP_EOL;
?>
<?php echo <<<'EOT'
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
EOT;
echo PHP_EOL;
?>
<div class="search-form" style="display:none">
<?php echo <<< 'EOT'
<?php $this->renderPartial('_search', array('model' => $model,)); ?>
EOT;
echo PHP_EOL;
?>
</div><!-- search-form -->
<?php echo <<<'EOT'
<?php
$this->widget('bootstrap.widgets.TbGridView',
    array('id'=>'
EOT;
echo $this->class2id($this->modelClass);
echo <<<'EOT'
-grid',
    'dataProvider'=>$model->search(),
    'type'=>'striped bordered condensed',
    'filter'=>$model,
    'template'=>"{items}\n{pager}{summary}",
    'columns'=>array(
EOT;
$count = 0;
foreach ($this->tableSchema->columns as $column) {
if ($column->name == 'id') continue;
if (++$count == 7) echo "\t\t/*\n";
echo "\t\t" . $this->generateGridViewColumn($this->modelClass, $column).",\n";
}
if ($count >= 7) echo "\t\t*/\n";
echo <<<'EOT'
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
?>
EOT;
?>
<?php echo <<<'EOT'
<?php $this->endWidget();?>
EOT;
?>