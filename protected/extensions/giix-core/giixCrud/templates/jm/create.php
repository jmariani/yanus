<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php
echo <<< 'EOT'
<?php
//    $this->layout = '//layouts/column1';
    $this->breadcrumbs = array($model->label(2) => array('admin'), Yii::t('app', 'Create'),);
?>
EOT;
echo PHP_EOL;
?>
<?php echo <<<'EOT'
<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
	'title' => Yii::t('app', 'Create') . ' ' . $model->label(),
        'headerIcon' => 'icon-file',
));
$this->renderPartial('_form', array( 'model' => $model, 'mode'=>'create', 'buttons' => 'create'));
?>
EOT;
echo PHP_EOL;
echo <<<'EOT'
<?php $this->endWidget();?>
EOT;
?>
