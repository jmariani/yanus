<?php
$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
	'Error',
);
?>
<div class="flash-error"><?php echo CHtml::encode($message); ?></div>
