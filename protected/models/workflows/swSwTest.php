<?php

return array(
    'initial' => 'pending',
    'node' => array(
        array('id' => 'pending',    'label' => yii::t('app', 'Pending'),    'transition' => 'processing'),
        array('id' => 'processing', 'label' => yii::t('app', 'Processing')),
    )
);
?>
