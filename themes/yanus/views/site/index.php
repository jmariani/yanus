<?php
  $baseUrl = Yii::app()->theme->baseUrl;
  $cs = Yii::app()->getClientScript();
  $cs->registerScriptFile('http://www.google.com/jsapi');
  $cs->registerCoreScript('jquery');
  $cs->registerScriptFile($baseUrl.'/js/jquery.gvChart-1.0.1.min.js');
  $cs->registerScriptFile($baseUrl.'/js/pbs.init.js');
  $cs->registerCssFile($baseUrl.'/css/jquery.css');

?>

<?php $this->pageTitle=Yii::app()->name; ?>


<!--<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i> Dashboard</h1>-->
<!--<div class="flash-error">This is an example of an error message to show you that things have gone wrong.</div>
<div class="flash-notice">This is an example of a notice message.</div>
<div class="flash-success">This is an example of a success message to show you that things have gone according to plan.</div>-->
<div class="span-23 showgrid">
<div class="dashboardIcons span-22">
    <div class="dashIcon span-3">
        <a href="#"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/big_icons/icon-inbox.png" alt="Inbox" /></a>
        <div class="dashIconText "><a href="#">Inbox</a></div>
    </div>

    <div class="dashIcon span-3">
        <a href="#"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/big_icons/icon-shopping-cart2.png" alt="Order History" /></a>
        <div class="dashIconText"><a href="#">Order History</a></div>
    </div>

    <div class="dashIcon span-3">
        <a href="#"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/big_icons/icon-cash2.png" alt="Manage Prices" /></a>
        <div class="dashIconText"><a href="#">Manage Prices</a></div>
    </div>

    <div class="dashIcon span-3">
        <a href="#"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/big_icons/icon-people.png" alt="Customers" /></a>
        <div class="dashIconText"><a href="#">Customers</a></div>
    </div>

    <div class="dashIcon span-3">
        <a href="#"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/big_icons/icon-chart.png" alt="Page" /></a>
        <div class="dashIconText"><a href="#">Reports</a></div>
    </div>

    <div class="dashIcon span-3">
        <a href="#"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/big_icons/icon-barcode.png" alt="Products" /></a>
        <div class="dashIconText"><a href="#">Products</a></div>
    </div>

    <div class="dashIcon span-3">
        <a href="#"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/big_icons/icon-address-book.png" alt="Contacts" /></a>
        <div class="dashIconText"><a href="#">Contacts</a></div>
    </div>

    <div class="dashIcon span-3">
        <a href="#"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/big_icons/icon-calendar.png" alt="Calendar" /></a>
        <div class="dashIconText"><a href="#">Calendar</a></div>
    </div>

    <div class="dashIcon span-3">
        <a href="#"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/big_icons/icon-recycle-bin.png" alt="Trash" /></a>
        <div class="dashIconText"><a href="#">Trash</a></div>
    </div>

    <div class="dashIcon span-3">
        <a href="#"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/big_icons/icon-warning.png" alt="System Alerts" /></a>
        <div class="dashIconText"><a href="#">System Alerts</a></div>
    </div>


</div>
</div>
