<p><?php echo yii::t('app', 'Dear {name}:', array('{name}' => $model->contactName));?></p>
<p><?php echo yii::t('app', 'Thank you for registering. Please review your information below and follow the activation link to activate your account.');?></p>
<?php $this->widget('bootstrap.widgets.BootDetailView', array(
	'data' => $model,
	'attributes' => array(
            'businessName',
            'rfc',
            'userName',
            'contactName',
//            'contactLastName',
//            'motherName',
//            'firstName',
//            'secondName',
            'contactPhone',
            'contactEmail',
            array('type' => 'raw',
                'label' => $model->getAttributeLabel('activationKey'),
                'value' => yii::app()->createAbsoluteUrl('/registerForm/activate', array('activateKey' => $model->activationKey))
        ),
))); ?>
<hr/>
<?php echo yii::t('app', 'Please do not answer this message. It was sent from an unattended account');?>

