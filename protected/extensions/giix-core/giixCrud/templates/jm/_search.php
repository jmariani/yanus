<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<div class="wide form">
<?php echo "<?php \$form = \$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action' => Yii::app()->createUrl(\$this->route),
	'method' => 'get',
        'htmlOptions'=>array('class'=>'well'),
        'type' => 'horizontal',
)); ?>\n"; ?>

<?php foreach($this->tableSchema->columns as $column): ?>
<?php
	$field = $this->generateInputField($this->modelClass, $column);
	if (strpos($field, 'password') !== false)
		continue;
        if ($column->name == 'id') continue;
?>
	<div class="row">
<!--
		<?php echo "<?php echo \$form->label(\$model, '{$column->name}'); ?>\n"; ?>
            -->
<!--                <?php // echo "<?php echo ".$this->generateActiveRow($this->modelClass,$column)."; ?>\n"; ?>-->

		<?php echo "<?php " . $this->generateSearchBootField($this->modelClass, $column)."; ?>\n"; ?>

	</div>

<?php endforeach; ?>
	<div class="form-actions">
		<?php echo "<?php \$this->widget('bootstrap.widgets.TbButton', array(
			'type'=>'primary',
                        'buttonType'=>'submit',
                        'icon' => 'search',
			'label'=>yii::t('app', 'Search'),
		)); ?>\n"; ?>
	</div>

<?php echo "<?php \$this->endWidget(); ?>\n"; ?>

</div><!-- search-form -->
