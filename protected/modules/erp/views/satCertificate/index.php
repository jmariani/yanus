<?php

$this->breadcrumbs = array(
	SatCertificate::label(2),
);

$this->menu = array(
	array('label'=>Yii::t('app', 'Upload') . ' ' . SatCertificate::label(), 'url' => array('upload')),
	array('label'=>Yii::t('app', 'Manage') . ' ' . SatCertificate::label(2), 'url' => array('admin')),
);
?>

<h1><?php echo GxHtml::encode(SatCertificate::label(2)); ?></h1>

<?php $this->widget('bootstrap.widgets.BootListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
));