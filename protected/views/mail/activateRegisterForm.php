<p><?php echo yii::t('app', 'Dear {name}:', array('{name}' => $model->contactName));?></p>
<p><?php echo yii::t('app', 'Thank you for registering. Please review your information below and follow the activation link to activate your account.');?></p>
<?php $this->widget('bootstrap.widgets.BootDetailView', array(
	'data' => $model,
	'attributes' => array(
            'businessName',
            'rfc',
            'userName',
            'lastName',
            'motherName',
            'firstName',
            'secondName',
            'contactPhone',
            'contactEmail',
            'activationUrl'
        ),
)); ?>
<hr/>
<?php echo yii::t('app', 'Please do not answer this message. It was sent from an unattended account');?>

