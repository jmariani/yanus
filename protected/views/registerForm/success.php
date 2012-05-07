<?php

$this->breadcrumbs = array(
	Yii::t('app', 'Registration form'),
);

//$this->menu = array(
//	array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url' => array('index')),
//	array('label'=>Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url' => array('admin')),
//);
?>

<?php
    $this->layout='column1';
?>
<?php $this->beginWidget('bootstrap.widgets.BootHero', array(
    'heading'=>yii::t('app', 'Thank you!'),
)); ?>
    <p><?php echo '<br/>';echo yii::t('app', 'Your registration was successfully fulfilled. Please check your email for your activation instructions.');?></p>
<?php $this->endWidget(); ?>