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



 <?php
echo CHtml::ajaxLink(Yii::t('job','ADD NEW LOCATION'),array('location/create'),array(
        'success'=>'js:function(data){
      $("#jobDialog").dialog("open");
    document.getElementById("add_location").innerHTML=data;
}'));
$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
                'id'=>'jobDialog',
                'options'=>array(
                    'title'=>Yii::t('job','Create Job'),
                    'autoOpen'=>false,
                    'modal'=>'true',
                    'width'=>'auto',
                    'height'=>'auto',
                ),
                ));


 echo "<div id='add_location'></div>";


 $this->endWidget('zii.widgets.jui.CJuiDialog');
?>