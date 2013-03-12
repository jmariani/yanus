<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<div class="form">

<?php $ajax = ($this->enable_ajax_validation) ? 'true' : 'false'; ?>
<?php
echo <<< 'EOT'
<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => '
EOT;
echo $this->class2id($this->modelClass);
echo <<< 'EOT'
', 'enableAjaxValidation' =>
EOT;
echo $ajax . ', ';
echo <<< 'EOT'
        //'htmlOptions'=>array('class'=>'well'),
        'type' => 'horizontal',
    ));
?>
EOT;
echo PHP_EOL;
?>
<?php
echo <<< 'EOT'
<?php echo $form->errorSummary($model); ?>
EOT;
?>
<?php foreach ($this->tableSchema->columns as $column): ?>
<?php if (!$column->autoIncrement): ?>
<?php echo "<?php " . $this->generateActiveBootField($this->modelClass, $column) . "; ?>\n"; ?>
<?php endif; ?>
<?php endforeach; ?>
<div class="form-actions well well-small">
<?php
echo <<< 'EOT'
<?php $this->widget('bootstrap.widgets.TbButton',
    array(
        'buttonType'=>'submit',
        'type'=>'primary',
        'label'=> $model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save'),
    )); ?>
EOT;
?>
</div>

<?php echo "<?php \$this->endWidget(); ?>\n"; ?>

</div><!-- form -->