<?php

$this->breadcrumbs = array(
	$model->label(2) => array('admin'),
	Yii::t('app', 'Upload'),
);
//$this->layout = 'column1';
//$this->menu = array(
//	array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url' => array('index')),
//	array('label'=>Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url' => array('admin')),
//);
?>



<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
	'title' => Yii::t('app', 'Upload') . ' ' . GxHtml::encode($model->label()),
        'headerIcon' => 'icon-upload',
	// when displaying a table, if we include bootstra-widget-table class
	// the table will be 0-padding to the box
//	'htmlOptions' => array('class'=>'bootstrap-widget-table')
//    'headerButtonActionsLabel' => 'My actions',
//    'headerActions' => array(
//	    array('label'=>'first action', 'url'=>'#', 'icon'=>'plus'),
//	    array('label'=>'second action', 'url'=>'#', 'icon'=>'icon-headphones'),
//	    '---',
//	    array('label'=>'third action', 'url'=>'#', 'icon'=>'icon-facetime-video')
//    )
));?>


<?php
$this->renderPartial('_formUpload', array(
		'model' => $model,
		'buttons' => 'upload'));
?>
<?php $this->endWidget();?>