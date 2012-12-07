<?php

return array(
    'initial' => RunProcess::STATUS_RUNNING,
    'node' => array(
        array(
            'id' => RunProcess::STATUS_RUNNING,
            'label' => yii::t('yanus', CModel::generateAttributeLabel(RunProcess::STATUS_RUNNING)),
            'transition' => array(
                RunProcess::STATUS_SUCCESS,
                 RunProcess::STATUS_ERROR
            )
        ),
        array(
            'id' => RunProcess::STATUS_SUCCESS,
            'label' => yii::t('yanus', CModel::generateAttributeLabel(RunProcess::STATUS_SUCCESS)),
        ),
        array(
            'id' => RunProcess::STATUS_ERROR,
            'label' => yii::t('yanus', CModel::generateAttributeLabel(RunProcess::STATUS_ERROR)),
        ),
    )
);
?>
