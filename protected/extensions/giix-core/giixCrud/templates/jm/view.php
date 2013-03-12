<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php echo <<<'EOT'
<?php
//    $this->layout = '//layouts/column1';
    $this->breadcrumbs = array($model->label(2) => array('admin'),GxHtml::valueEx($model),);
?>
EOT;
?>
<?php echo <<<'EOT'
<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
	'title' => Yii::t('app', 'View') . ' ' . $model->label() . ' ' . GxHtml::encode(GxHtml::valueEx($model)),
        'headerIcon' => 'icon-folder-open',
        'headerButtons' => array(
            array(
                'class' => 'bootstrap.widgets.TbButtonGroup',
                'size' => 'mini',
                'buttons' => array(
                    array(
                        'icon' => 'icon-edit',
                        'url' => array('update', 'id' => $model->id),
                        'htmlOptions' => array(
                            'rel' => 'tooltip',
                            'title' => Yii::t('app', 'Update'),
                        ),
                    ),
                ),
            ),
         )

));
$this->widget('bootstrap.widgets.TbDetailView', array(
	'data' => $model,
        'type' => array('striped','bordered'),
	'attributes' => array(
EOT;
foreach ($this->tableSchema->columns as $column)
    if ($column->name != 'id')
		echo $this->generateDetailViewAttribute($this->modelClass, $column) . ",\n";

echo <<<'EOT'
	),
));
?>
EOT;
echo PHP_EOL;
echo <<<'EOT'
<?php $this->endWidget();?>
EOT;
?>
