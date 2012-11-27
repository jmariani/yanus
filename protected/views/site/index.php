<?php $this->pageTitle=Yii::app()->name; ?>

<?php $this->beginWidget('bootstrap.widgets.TbHeroUnit', array('heading'=>yii::t('app', 'Welcome'),)); ?>
<p><?php echo yii::t('app', 'Access to this application is allowed to authorized users only.'); ?></p>
<p><?php echo yii::t('app', 'Please log-in or register.'); ?></p>
<?php $this->widget('bootstrap.widgets.TbButtonGroup', array(
    'buttons'=>array(
        array('label'=>yii::t('app', 'Log in'), 'url'=>Yii::app()->getModule('user')->loginUrl),
        array('label'=>yii::t('app', 'Register'), 'url'=>Yii::app()->getModule('user')->registrationUrl),
    ),
)); ?>
<?php $this->endWidget(); ?>
