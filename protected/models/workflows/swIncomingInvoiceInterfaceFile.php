<?php

return array(
    'initial' => 'pending',
    'node' => array(
        array('id' => 'pending',    'label' => yii::t('app', 'Pending'),    'transition' => 'processing'),
        array('id' => 'processing', 'label' => yii::t('app', 'Processing'), 'transition' => 'processed,error'),
        array('id' => 'error',      'label' => yii::t('app', 'Error'),      'transition' => 'pending'),
        array('id' => 'processed',  'label' => yii::t('app', 'Processed')),
    )
);
?>
