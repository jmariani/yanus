<?php

return array(
    'initial' => 'pending',
    'node' => array(
        array('id' => 'pending',
            'label' => yii::t('app', 'Pending'),
            'transition' => array(
                'issued' => '$this->issue()',
                'error'
            )
        ),
        array('id' => 'issued', 'label' => yii::t('app', 'Issued')),
        array('id' => 'error', 'label' => yii::t('app', 'Error')),
    )
);
?>
