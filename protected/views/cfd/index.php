<?php

$this->breadcrumbs = array(
	Cfd::label(2),
);

$this->menu = array(
	array('label'=>Yii::t('app', 'Create') . ' ' . Cfd::label(), 'url' => array('create')),
	array('label'=>Yii::t('app', 'Manage') . ' ' . Cfd::label(2), 'url' => array('admin')),
);
?>

<h1><?php echo GxHtml::encode(Cfd::label(2)); ?></h1>
<?php
//$this->beginWidget('zii.widgets.CPortlet', array(
//	'title'=>'<span>' . GxHtml::encode(Cfd::label(2)) . '</span>',
//));
?>
    <?php $this->widget('bootstrap.widgets.BootListView',array(
            'dataProvider'=>$dataProvider,
            'itemView'=>'_view',
    ));
    ?>
<?php // $this->endWidget();?>