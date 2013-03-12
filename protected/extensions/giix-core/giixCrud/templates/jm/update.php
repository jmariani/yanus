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
    // $this->breadcrumbs = array($model->label(2) => array('admin'), Yii::t('app', 'Create'),);
    $this->breadcrumbs = array($model->label(2) => array('admin'), GxHtml::valueEx($model) => array('view', 'id' => GxActiveRecord::extractPkValue($model, true)), Yii::t('app', 'Update'),);
?>
EOT;
echo PHP_EOL;
?>
<?php echo <<<'EOT'
<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
	'title' => Yii::t('app', 'Update') . ' ' . $model->label()  . ' ' . GxHtml::encode(GxHtml::valueEx($model)),
        'headerIcon' => 'icon-edit',
));
$this->renderPartial('_form', array('model' => $model, 'mode'=>'update', 'buttons' => 'update'));
?>
EOT;
echo PHP_EOL;
echo <<<'EOT'
<?php $this->endWidget();?>
EOT;
?>
