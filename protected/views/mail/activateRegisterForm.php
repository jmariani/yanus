<p><?php echo yii::t('app', 'Dear {name}:', array('{name}' => $model->contactName));?></p>
<p><?php echo yii::t('app', 'Thank you for registering. Please review your information below and follow the activation link to activate tour account.');?></p>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data' => $model,
	'attributes' => array(
            'businessName',
            'rfc',
            'userName',
            'contactName',
            'contactPhone',
            'contactEmail',
            'activationUrl'
        ),
)); ?>
<hr/>
<?php echo yii::t('app', 'Please do not answer this message. It was sent from an unattended account');?>

