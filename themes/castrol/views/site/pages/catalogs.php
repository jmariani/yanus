<?php
  $baseUrl = Yii::app()->theme->baseUrl;
  $cs = Yii::app()->getClientScript();
//  $cs->registerScriptFile('http://www.google.com/jsapi');
//  $cs->registerCoreScript('jquery');
//  $cs->registerScriptFile($baseUrl.'/js/jquery.gvChart-1.0.1.min.js');
//  $cs->registerScriptFile($baseUrl.'/js/pbs.init.js');
  $cs->registerCssFile($baseUrl.'/css/jquery.css');

?>

<?php $this->pageTitle=Yii::app()->name; ?>

<div class="span-23 showgrid">
<div class="dashboardIcons span-22">
    <?php $this->widget('bootstrap.widgets.BootTabbable', array(
    'type'=>'tabs',
    'placement'=>'left', // 'above', 'right', 'below' or 'left'
    'tabs'=>array(
        array('label'=>'System Catalogs', 'content'=>$this->renderPartial('pages/systemCatalogs',array(),true), 'active'=>true),
        array('label'=>'Section 2', 'content'=>'<p>Howdy, I\'m in Section 2.</p>'),
        array('label'=>'Section 3', 'content'=>'<p>What up girl, this is Section 3.</p>'),
    ),
)); ?>
</div><!-- END OF .dashIcons -->


</div>
