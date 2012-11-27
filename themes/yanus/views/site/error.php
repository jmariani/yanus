<?php
$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
	'Error',
);
?>

<!--<h2 class="error_header">Error <?php echo $code; ?></h2>-->
<!--
<div class="error error_message">
<?php echo CHtml::encode($message); ?>
</div>
-->
<?php $this->beginWidget('bootstrap.widgets.TbHeroUnit', array(
	'heading'=> yii::t('app', 'Error') . ' ' . $code,
)); ?>
<?php
Yii::app()->user->setFlash('error', $message);
$this->widget('bootstrap.widgets.TbAlert', array(
    'block'=>true, // display a larger alert block?
    'fade'=>true, // use transitions?
    'closeText'=>false, // close link text - if set to false, no close link is displayed
//    'alerts'=>array( // configurations per alert type
//        'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'×'), // success, info, warning, error or danger
//        'info'=>array('block'=>true, 'fade'=>true, ), // success, info, warning, error or danger
//    ),
));
?>

<?php $this->endWidget(); ?>