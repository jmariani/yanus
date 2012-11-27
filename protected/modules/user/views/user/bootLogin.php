<?php
$this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Login");
$this->breadcrumbs=array(
	UserModule::t("Login"),
);
?>

<!--<h1><?php echo UserModule::t("Login"); ?></h1>-->

<?php if(Yii::app()->user->hasFlash('loginMessage')): ?>

<div class="success">
	<?php echo Yii::app()->user->getFlash('loginMessage'); ?>
</div>

<?php endif; ?>
<?php
    $this->widget('bootstrap.widgets.TbBox', array(
    'title' => 'Login',
    'headerIcon' => 'icon-home',
    'content' => $this->renderPartial(Yii::app()->controller->module->_bootLogin, array('model'=>$model), true)
    ));
?>

<?php
Yii::app()->user->setFlash('info', yii::t('app', "This site is intended solely for use by authorized users. Use of this site is subject to the Legal Notices, Terms for Use and Privacy Statement located on this site. Use of the site by customers and partners, if authorized, is also subject to the terms of your contract(s) with us. Use of this site by our employees is also subject to company policies, including the Code of Conduct. Unauthorized access or breach of these terms may result in termination of your authorization to use this site and/or civil and criminal penalties."));
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
