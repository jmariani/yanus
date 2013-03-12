<?php
  $baseUrl = Yii::app()->theme->baseUrl;
//  $cs = Yii::app()->getClientScript();
//  $cs->registerScriptFile('http://www.google.com/jsapi');
//  $cs->registerCoreScript('jquery');
//  $cs->registerScriptFile($baseUrl.'/js/jquery.gvChart-1.0.1.min.js');
//  $cs->registerScriptFile($baseUrl.'/js/pbs.init.js');
//  $cs->registerCssFile($baseUrl.'/css/jquery.css');

?>
<?php $brand = SystemConfig::getValue('NAVBAR_BRAND');?>
<?php $this->pageTitle=$brand; ?>

<!--<h1>Welcome to <i><?php echo CHtml::encode($brand); ?></i> Dashboard</h1>-->
<!--<div class="flash-error">This is an example of an error message to show you that things have gone wrong.</div>
<div class="flash-notice">This is an example of a notice message.</div>
<div class="flash-success">This is an example of a success message to show you that things have gone according to plan.</div>-->
<?php
//Yii::app()->user->setFlash('info', 'Please choose an option');
//$this->widget('bootstrap.widgets.TbAlert', array(
//    'block'=>true, // display a larger alert block?
//    'fade'=>true, // use transitions?
//    'closeText'=>false, // close link text - if set to false, no close link is displayed
////    'alerts'=>array( // configurations per alert type
////        'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'×'), // success, info, warning, error or danger
////        'info'=>array('block'=>true, 'fade'=>true, ), // success, info, warning, error or danger
////    ),
//));
?>

<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
	'title' => Yii::t('app', 'Please choose an option'),
        'headerIcon' => 'icon-home',
	// when displaying a table, if we include bootstra-widget-table class
	// the table will be 0-padding to the box
//	'htmlOptions' => array('class'=>'bootstrap-widget-table')
));?>

<?php
$this->widget('bootstrap.widgets.TbMenu', array(
    'type'=>'list',
    'items' => array(
//            array('label'=> Yii::t('app', 'Please choose an option'), 'itemOptions'=>array('class'=>'nav-header')),
        array('label'=> Yii::t('app', 'Billing'), 'itemOptions'=>array('class'=>'nav-header')),
        array('label'=> yii::t('app', 'Manage' . ' ' . Cfd::label(2)), 'url'=>Yii::app()->baseUrl . "/cfd", //'itemOptions'=>array('class'=>'active')
        'icon' => 'icon-qrcode'),
        array('label'=> yii::t('app', 'Manage' . ' ' . CustomsPermit::label(2)), 'url'=>Yii::app()->baseUrl . '/customsPermit', 'icon' => 'icon-list'),
        array('label'=> yii::t('app', 'Manage' . ' ' . PaymentTerm::label(2)), 'url'=>'#', 'icon' => 'icon-list'),

        array('label'=> Yii::t('app', 'Customers'), 'itemOptions'=>array('class'=>'nav-header')),
        array('label'=> yii::t('app', 'Manage Invoice Notification Mail Addresses'), 'url'=>Yii::app()->baseUrl . '/party', 'icon' => 'icon-envelope'),
        array('label'=> yii::t('app', 'Files'), 'itemOptions'=>array('class'=>'nav-header'), ),
        array('label'=> yii::t('app', 'Manage' . ' ' . IncomingInvoiceInterfaceFile::label(2)), 'url'=>Yii::app()->baseUrl . '/incomingInvoiceInterfaceFile', 'icon' => 'icon-file'),
        array('label'=> yii::t('app', 'Manage' . ' ' . SatCertificate::label(2)), 'url'=>Yii::app()->baseUrl . '/satCertificate', 'icon' => 'icon-certificate'),
        array('label'=> yii::t('app', 'Manage' . ' ' . PemexPreInvoice::label(2)), 'url'=>Yii::app()->baseUrl . '/pemexPreInvoice', 'icon' => 'icon-file'),

        array('label'=> yii::t('app', 'Settings'), 'itemOptions'=>array('class'=>'nav-header')),
        array('label'=> yii::t('app', 'Manage' . ' ' . Country::label(2)), 'url'=>Yii::app()->baseUrl . "/country", 'icon' => 'icon-list'),
        array('label'=> yii::t('app', 'Manage' . ' ' . Currency::label(2)), 'url'=>Yii::app()->baseUrl . "/currency", 'icon' => 'icon-list'),
        array('label'=> yii::t('app', 'Manage' . ' ' . State::label(2)), 'url'=>Yii::app()->baseUrl . "/state", 'icon' => 'icon-list'),

        array('label'=>'Settings', 'url'=>'#', 'icon' => 'icon-wrench'),
        '',
        array('label'=>'Help', 'url'=>'#'),
    )
));
?>
<?php $this->endWidget();?>

<!--
<div class="span-23 showgrid">
<div class="dashboardIcons span-22">
    <?php if (Yii::app()->user->checkAccess('Cfd.Admin')): ?>
    <div class="dashIcon span-3">
        <a href="<?php echo Yii::app()->baseUrl; ?>/cfd"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/big_icons/invoice.png" alt="<?php echo yii::t('app', Cfd::label(2)); ?>"/></a>
        <div class="dashIconText "><a href="<?php echo Yii::app()->baseUrl; ?>/cfd"><?php echo yii::t('app', Cfd::label(2)); ?></a></div>
    </div>
    <?php endif; ?>
    <?php if (Yii::app()->user->checkAccess('IncomingInvoiceInterfaceFile.Admin')): ?>
    <div class="dashIcon span-3">
        <a href="<?php echo Yii::app()->baseUrl; ?>/incomingInvoiceInterfaceFile"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/big_icons/icon-filing-cabinet.png" alt="<?php echo yii::t('app', Cfd::label(2)); ?>"/></a>
        <div class="dashIconText "><a href="<?php echo Yii::app()->baseUrl; ?>/incomingInvoiceInterfaceFile"><?php echo yii::t('app', IncomingInvoiceInterfaceFile::label(2)); ?></a></div>
    </div>
    <?php endif; ?>

    <div class="dashIcon span-3">
        <a href="#"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/big_icons/icon-inbox.png" alt="Inbox" /></a>
        <div class="dashIconText "><a href="erp">Inbox</a></div>
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
</div>-->

