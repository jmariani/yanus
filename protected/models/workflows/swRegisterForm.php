<?php

return array(
    'initial' => 'pending',
    'node' => array(
        array('id' => 'pending',
            'label' => yii::t('app', 'Pending'),
            'transition' => array(
                'activated' => '$this->finalize()',
                'rejected'
            )
        ),
        array('id' => 'rejected',
            'label' => yii::t('app', 'Rejected'),
            'transition' => 'pending'),
        array('id' => 'activated', 'label' => yii::t('app', 'Activated')),
    )
);
?>
