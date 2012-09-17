<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<div class="form">

<?php $ajax = ($this->enable_ajax_validation) ? 'true' : 'false'; ?>

<?php echo '<?php '; ?>
    /** @var BootActiveForm $form */
    $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
	'id' => '<?php echo $this->class2id($this->modelClass); ?>-form',
	'enableAjaxValidation' => <?php echo $ajax; ?>,
        'htmlOptions'=>array('class'=>'well'),
        'type' => 'horizontal',
    ));
<?php echo '?>'; ?>


<div class="flash-notice"><?php echo "<?php echo Yii::t('app', 'Fields with'); ?> <span class=\"required\">*</span> <?php echo Yii::t('app', 'are required'); ?>"; ?>.</div>
<?php echo "<?php echo \$form->errorSummary(\$model); ?>\n"; ?>

<?php foreach ($this->tableSchema->columns as $column): ?>
<?php if (!$column->autoIncrement): ?>
<!--		<div class="row">-->
<!--		<?php // echo "<?php echo " . $this->generateActiveLabel($this->modelClass, $column) . "; ?>\n"; ?>-->
		<?php echo "<?php " . $this->generateActiveBootField($this->modelClass, $column) . "; ?>\n"; ?>
<!--		<?php // echo "<?php echo \$form->error(\$model,'{$column->name}'); ?>\n"; ?>-->
<!--		</div> row -->
<?php endif; ?>
<?php endforeach; ?>

	<div class="form-actions">
		<?php echo "<?php \$this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>\$model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save'),
		)); ?>\n"; ?>
	</div>

<?php echo "<?php \$this->endWidget(); ?>\n"; ?>

</div><!-- form -->