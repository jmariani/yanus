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
    <?php if (Yii::app()->user->checkAccess('Cfd.AdminIssued')): ?>
    <div class="dashIcon span-3">
        <a href="<?php echo Yii::app()->baseUrl; ?>/cfd/adminIssued"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/big_icons/invoice.png" alt="<?php echo yii::t('app', 'Issued CFDs'); ?>"/></a>
        <div class="dashIconText "><a href="<?php echo Yii::app()->baseUrl; ?>/cfd/adminIssued"><?php echo yii::t('app', 'Issued CFDs'); ?></a></div>
    </div>
    <?php endif; ?>
    <?php if (Yii::app()->user->checkAccess('Cfd.AdminReceived')): ?>
    <div class="dashIcon span-3">
        <a href="<?php echo Yii::app()->baseUrl; ?>/cfd/adminReceived"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/big_icons/invoice.png" alt="<?php echo yii::t('app', 'Received CFDs'); ?>"/></a>
        <div class="dashIconText "><a href="<?php echo Yii::app()->baseUrl; ?>/cfd/adminReceived"><?php echo yii::t('app', 'Received CFDs'); ?></a></div>
    </div>
    <?php endif; ?>
    <?php if (Yii::app()->user->checkAccess('CustomsPermit.Admin')): ?>
    <div class="dashIcon span-3">
        <a href="<?php echo Yii::app()->baseUrl; ?>/customsPermit/admin"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/big_icons/aduana.png" alt="<?php echo yii::t('app', 'Customs Permits'); ?>" /></a>
        <div class="dashIconText"><a href="<?php echo Yii::app()->baseUrl; ?>/customsPermit/admin"><?php echo yii::t('app', 'Customs Permits'); ?></a></div>
    </div>
    <?php endif; ?>
    <?php if (Yii::app()->user->checkAccess('IncomingInvoiceInterfaceFile.Admin')): ?>
    <div class="dashIcon span-3">
        <a href="<?php echo Yii::app()->baseUrl; ?>/incominginvoiceinterfacefile/admin"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/big_icons/icon-inbox.png" alt="<?php echo yii::t('app', 'Interface Files'); ?>" /></a>
        <div class="dashIconText"><a href="<?php echo Yii::app()->baseUrl; ?>/incominginvoiceinterfacefile/admin"><?php echo yii::t('app', 'Interface Files'); ?></a></div>
    </div>
    <?php endif; ?>
    <?php if (Yii::app()->user->checkAccess('Party.AdminCustomers')): ?>
    <div class="dashIcon span-3">
        <a href="<?php echo Yii::app()->baseUrl; ?>/party/adminCustomers"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/big_icons/icon-people.png" alt="<?php echo yii::t('app', 'Customers'); ?>" /></a>
        <div class="dashIconText"><a href="<?php echo Yii::app()->baseUrl; ?>/party/adminCustomers"><?php echo yii::t('app', 'Customers'); ?></a></div>
    </div>
    <?php endif; ?>
    <div class="dashIcon span-3">
        <a href="#"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/big_icons/icon-chart.png" alt="Page" /></a>
        <div class="dashIconText"><a href="#"><?php echo yii::t('app', 'Reports'); ?></a></div>
    </div>

    <div class="dashIcon span-3">
        <a href="#"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/big_icons/icon-barcode.png" alt="Products" /></a>
        <div class="dashIconText"><a href="#"><?php echo yii::t('app', 'Products'); ?></a></div>
    </div>
    <?php if (Yii::app()->user->checkAccess('SatCertificate.Admin')): ?>
    <div class="dashIcon span-3">
        <a href="<?php echo Yii::app()->baseUrl; ?>/SatCertificate/admin"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/big_icons/1337975376_safe_mail.png" alt="<?php echo yii::t('app', 'Certificates'); ?>" /></a>
        <div class="dashIconText"><a href="<?php echo Yii::app()->baseUrl; ?>/satCertificate/admin"><?php echo yii::t('app', 'Certificates'); ?></a></div>
    </div>
    <?php endif; ?>
    <?php if (Yii::app()->user->checkAccess('PemexPreInvoice.Admin')): ?>
    <div class="dashIcon span-3">
        <a href="<?php echo Yii::app()->baseUrl; ?>/pemexPreInvoice/admin"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/big_icons/pemex.png" alt="<?php echo yii::t('app', 'Pemex Pre Invoice'); ?>" /></a>
        <div class="dashIconText"><a href="<?php echo Yii::app()->baseUrl; ?>/pemexPreInvoice/admin"><?php echo yii::t('app', 'Pemex Pre Invoice'); ?></a></div>
    </div>
    <?php endif; ?>
    <div class="dashIcon span-3">
        <a href="page?view=catalogs"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/big_icons/catalog.png" alt="<?php echo yii::t('app', 'Catalogs'); ?>" /></a>
        <div class="dashIconText"><a href="page?view=catalogs"><?php echo yii::t('app', 'Catalogs'); ?></a></div>
    </div>

    <div class="dashIcon span-3">
        <a href="#"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/big_icons/icon-warning.png" alt="System Alerts" /></a>
        <div class="dashIconText"><a href="#">System Alerts</a></div>
    </div>
    <?php if (Yii::app()->user->checkAccess('User.Admin')): ?>
    <div class="dashIcon span-3">
        <a href="<?php echo Yii::app()->baseUrl; ?>/user/admin"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/big_icons/icon-people.png" alt="<?php echo yii::t('app', 'Users'); ?>" /></a>
        <div class="dashIconText"><a href="<?php echo Yii::app()->baseUrl; ?>/user/admin"><?php echo yii::t('app', 'Users'); ?></a></div>
    </div>
    <?php endif; ?>

</div><!-- END OF .dashIcons -->
</div>
