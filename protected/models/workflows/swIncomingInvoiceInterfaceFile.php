<?php

return array(
    'initial' => IncomingInvoiceInterfaceFile::PENDING_VALIDATION,
    'node' => array(
        array(
            'id' => IncomingInvoiceInterfaceFile::PENDING_VALIDATION,
//            'label' => yii::t('app', 'Pending Validation'),
            'label' => yii::t('app', CActiveRecord::generateAttributeLabel(IncomingInvoiceInterfaceFile::PENDING_VALIDATION)),
            'transition' => array(
                IncomingInvoiceInterfaceFile::ERROR,
                IncomingInvoiceInterfaceFile::VALIDATING,
            )
        ),
        array(
            'id' => IncomingInvoiceInterfaceFile::ERROR,
            'label' => yii::t('app', CActiveRecord::generateAttributeLabel(IncomingInvoiceInterfaceFile::ERROR)),
//            'label' => yii::t('app', 'Error'),
//            'transition' => IncomingInvoiceInterfaceFile::PENDING_VALIDATION
        ),
        array(
            'id' => IncomingInvoiceInterfaceFile::VALIDATING,
            'label' => yii::t('app', CActiveRecord::generateAttributeLabel(IncomingInvoiceInterfaceFile::VALIDATING)),
//            'label' => yii::t('app', 'Validating'),
            'transition' => array(
                IncomingInvoiceInterfaceFile::PENDING_PROCESSING,
                IncomingInvoiceInterfaceFile::VALIDATION_ERROR,
            )
        ),
        array(
            'id' => IncomingInvoiceInterfaceFile::VALIDATION_ERROR,
            'label' => yii::t('app', CActiveRecord::generateAttributeLabel(IncomingInvoiceInterfaceFile::VALIDATION_ERROR)),
//            'label' => yii::t('app', 'Validation Error'),
//            'transition' => IncomingInvoiceInterfaceFile::PENDING_VALIDATION
        ),
        array(
            'id' => IncomingInvoiceInterfaceFile::PENDING_PROCESSING,
            'label' => yii::t('app', CActiveRecord::generateAttributeLabel(IncomingInvoiceInterfaceFile::PENDING_PROCESSING)),
//            'label' => yii::t('app', 'Pending processing'),
            'transition' => array(
                IncomingInvoiceInterfaceFile::PROCESSING,
                IncomingInvoiceInterfaceFile::ERROR,
            )
        ),
        array(
            'id' => IncomingInvoiceInterfaceFile::PROCESSING,
            'label' => yii::t('app', CActiveRecord::generateAttributeLabel(IncomingInvoiceInterfaceFile::PROCESSING)),
//            'label' => yii::t('app', 'Processing'),
            'transition' => array(
                IncomingInvoiceInterfaceFile::PROCESSING_ERROR,
                IncomingInvoiceInterfaceFile::PROCESSED,
            )
        ),
        array(
            'id' => IncomingInvoiceInterfaceFile::PROCESSING_ERROR,
            'label' => yii::t('app', CActiveRecord::generateAttributeLabel(IncomingInvoiceInterfaceFile::PROCESSING_ERROR)),
//            'label' => yii::t('app', 'Processing Error'),
//            'transition' => IncomingInvoiceInterfaceFile::PENDING_VALIDATION
        ),
        array(
            'id' => IncomingInvoiceInterfaceFile::PROCESSED,
            'label' => yii::t('app', CActiveRecord::generateAttributeLabel(IncomingInvoiceInterfaceFile::PROCESSED)),
//            'label' => yii::t('app', 'Processed'),
//            'transition' => array(IncomingInvoiceInterfaceFile::PENDING_VALIDATION)
        ),
    )
);

//return array(
//    'initial' => 'PENDING_VALIDATION',
//    'node' => array(
//        array(
//            'id' => IncomingInvoiceInterfaceFile::PENDING_VALIDATION,
//            'label' => yii::t('app', 'Pending Validation'),
//            'transition' => array(
//                IncomingInvoiceInterfaceFile::VALID => '$this->runValidation()',
//                IncomingInvoiceInterfaceFile::VALIDATION_ERROR,
//                IncomingInvoiceInterfaceFile::ERROR)
//        ),
//        array(
//            'id' => IncomingInvoiceInterfaceFile::VALID,
//            'label' => yii::t('app', 'Valid'),
//            'transition' => array(
//                            IncomingInvoiceInterfaceFile::PROCESSED => '$this->runProcess()',
//                            IncomingInvoiceInterfaceFile::PROCESSING_ERROR,
//                            IncomingInvoiceInterfaceFile::ERROR,
//                            IncomingInvoiceInterfaceFile::PENDING_VALIDATION)
//        ),
//        array(
//            'id' => IncomingInvoiceInterfaceFile::VALIDATION_ERROR,
//            'label' => yii::t('app', 'Validation Error'),
//            'transition' => IncomingInvoiceInterfaceFile::PENDING_VALIDATION
//        ),
//        array(
//            'id' => IncomingInvoiceInterfaceFile::PROCESSING_ERROR,
//            'label' => yii::t('app', 'Processing Error'),
//            'transition' => IncomingInvoiceInterfaceFile::PENDING_VALIDATION
//        ),
//    )
//);
//return array(
//    'initial' => 'PENDING_VALIDATION',
//    'node' => array(
//        array(
//            'id' => IncomingInvoiceInterfaceFile::PENDING_VALIDATION,
//            'label' => yii::t('app', 'Pending Validation'),
//            'transition' => array(
//                IncomingInvoiceInterfaceFile::VALIDATING => '$this->runValidation()',
//                IncomingInvoiceInterfaceFile::ERROR)
//        ),
//        array(
//            'id' => IncomingInvoiceInterfaceFile::VALIDATING,
//            'label' => yii::t('app', 'Validating'),
//            'transition' => array(
//                            IncomingInvoiceInterfaceFile::PROCESSING => '$this->runProcess()',
//                            IncomingInvoiceInterfaceFile::VALIDATION_ERROR,
//                            IncomingInvoiceInterfaceFile::PENDING_VALIDATION)
//        ),
//        array(
//            'id' => IncomingInvoiceInterfaceFile::PENDING_PROCESSING,
//            'label' => yii::t('app', 'Pending Processing'),
//            'transition' => array(
//                            IncomingInvoiceInterfaceFile::PROCESSING,
//                            IncomingInvoiceInterfaceFile::ERROR)
//        ),
//        array(
//            'id' => IncomingInvoiceInterfaceFile::PROCESSING,
//            'label' => yii::t('app', 'Processing'),
//            'transition' => IncomingInvoiceInterfaceFile::PROCESSED . ',' .
//                            IncomingInvoiceInterfaceFile::PROCESSING_ERROR . ',' .
//                            IncomingInvoiceInterfaceFile::PENDING_VALIDATION
//        ),
//        array(
//            'id' => IncomingInvoiceInterfaceFile::PROCESSED,
//            'label' => yii::t('app', 'Processed'),
//            'transition' => IncomingInvoiceInterfaceFile::PENDING_VALIDATION . ',' .
//                IncomingInvoiceInterfaceFile::VALIDATION_ERROR . ',' .
//                IncomingInvoiceInterfaceFile::PROCESSING
//        ),
//        array(
//            'id' => IncomingInvoiceInterfaceFile::ERROR,
//            'label' => yii::t('app', 'Error'),
//            'transition' => IncomingInvoiceInterfaceFile::PENDING_VALIDATION
//        ),
//        array(
//            'id' => IncomingInvoiceInterfaceFile::VALIDATION_ERROR,
//            'label' => yii::t('app', 'Validation Error'),
//            'transition' => IncomingInvoiceInterfaceFile::PENDING_VALIDATION
//        ),
//        array(
//            'id' => IncomingInvoiceInterfaceFile::PROCESSING_ERROR,
//            'label' => yii::t('app', 'Processing Error'),
//            'transition' => IncomingInvoiceInterfaceFile::PENDING_VALIDATION
//        ),
//    )
//);
?>
