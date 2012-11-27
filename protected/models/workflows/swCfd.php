<?php

return array(
    'initial' => Cfd::STATUS_NEW,
    'node' => array(
        array(
            'id' => Cfd::STATUS_NEW,
            'label' => yii::t('app', CActiveRecord::generateAttributeLabel(cfd::STATUS_NEW)),
            'transition' => array(
                // From NEW to CREATING_XML
                cfd::STATUS_ERROR,
                cfd::STATUS_CREATING_XML,
            )
        ),
        array(
            'id' => Cfd::STATUS_ERROR,
            'label' => yii::t('app', CActiveRecord::generateAttributeLabel(cfd::STATUS_ERROR)),
        ),
        array(
            'id' => Cfd::STATUS_CREATING_XML,
            'label' => yii::t('app', CActiveRecord::generateAttributeLabel(cfd::STATUS_CREATING_XML)),
            'transition' => array(
                cfd::STATUS_XML_CREATION_ERROR,
                cfd::STATUS_XML_CREATED
            )
        ),
        array(
            'id' => Cfd::STATUS_XML_CREATED,
            'label' => yii::t('app', CActiveRecord::generateAttributeLabel(cfd::STATUS_XML_CREATED)),
            'transition' => array(
                cfd::STATUS_SIGNING_XML,
            )
        ),
        array(  // Transitional status while signing Cfd
            'id' => Cfd::STATUS_SIGNING_XML,
            'label' => yii::t('app', CActiveRecord::generateAttributeLabel(cfd::STATUS_SIGNING_XML)),
            'transition' => array(
                Cfd::STATUS_XML_SIGNED,
                Cfd::STATUS_XML_SIGNATURE_ERROR,
            )
        ),
        array(
            'id' => Cfd::STATUS_XML_SIGNED,
            'label' => yii::t('app', CActiveRecord::generateAttributeLabel(cfd::STATUS_XML_SIGNED)),
            'transition' => array(
                Cfd::STATUS_STAMPING_XML,
            )
        ),
        array(  // Transitional status while signing Cfd
            'id' => Cfd::STATUS_STAMPING_XML,
            'label' => yii::t('app', CActiveRecord::generateAttributeLabel(cfd::STATUS_STAMPING_XML)),
            'transition' => array(
                Cfd::STATUS_XML_STAMP_ERROR,
                Cfd::STATUS_XML_STAMPED
            )
        ),
        array(
            'id' => Cfd::STATUS_XML_STAMPED,
            'label' => yii::t('app', CActiveRecord::generateAttributeLabel(cfd::STATUS_XML_STAMPED)),
            'transition' => array(
                cfd::STATUS_CREATING_PDF
            )
        ),
        array(
            'id' => Cfd::STATUS_CREATING_PDF,
            'label' => yii::t('app', CActiveRecord::generateAttributeLabel(cfd::STATUS_CREATING_PDF)),
            'transition' => array(
                cfd::STATUS_PDF_CREATION_ERROR,
                Cfd::STATUS_PDF_CREATED,
            )
        ),
        array(
            'id' => Cfd::STATUS_PDF_CREATED,
            'label' => yii::t('app', CActiveRecord::generateAttributeLabel(cfd::STATUS_PDF_CREATED)),
            'transition' => array(
                cfd::STATUS_CREATING_ADDENDA,
                Cfd::STATUS_READY
            )
        ),
        array(
            'id' => Cfd::STATUS_CREATING_ADDENDA,
            'label' => yii::t('app', CActiveRecord::generateAttributeLabel(cfd::STATUS_CREATING_ADDENDA)),
            'transition' => array(
                cfd::STATUS_ADDENDA_CREATION_ERROR,
                Cfd::STATUS_READY
            )
        ),
        array(
            'id' => Cfd::STATUS_READY,
            'label' => yii::t('app', CActiveRecord::generateAttributeLabel(cfd::STATUS_READY)),
        ),
        array(
            'id' => Cfd::STATUS_XML_CREATION_ERROR,
            'label' => yii::t('app', CActiveRecord::generateAttributeLabel(cfd::STATUS_XML_CREATION_ERROR)),
        ),
        array(
            'id' => Cfd::STATUS_XML_SIGNATURE_ERROR,
            'label' => yii::t('app', CActiveRecord::generateAttributeLabel(cfd::STATUS_XML_SIGNATURE_ERROR)),
        ),
        array(
            'id' => Cfd::STATUS_XML_STAMP_ERROR,
            'label' => yii::t('app', CActiveRecord::generateAttributeLabel(cfd::STATUS_XML_STAMP_ERROR)),
        ),
        array(
            'id' => Cfd::STATUS_PDF_CREATION_ERROR,
            'label' => yii::t('app', CActiveRecord::generateAttributeLabel(cfd::STATUS_PDF_CREATION_ERROR)),
        ),
        array(
            'id' => Cfd::STATUS_ADDENDA_CREATION_ERROR,
            'label' => yii::t('app', CActiveRecord::generateAttributeLabel(cfd::STATUS_ADDENDA_CREATION_ERROR)),
        ),
    )
);

//return array(
//    'initial' => Cfd::STATUS_NEW,
//    'node' => array(
//        array(
//            'id' => Cfd::STATUS_NEW,
//            'label' => yii::t('app', CActiveRecord::generateAttributeLabel(cfd::STATUS_NEW)),
////            'label' => yii::t('app', 'New'),
//            'transition' => array(
//                // From NEW to CREATING_XML
//                cfd::STATUS_XML_CREATED,
//                cfd::STATUS_XML_CREATION_ERROR,
////                cfd::STATUS_PENDING_XML_CREATION => '$this->runCreateXmlTask()', // The task is run after the record is saved and it's in the status.
//            )
//        ),
////        array(
////            'id' => Cfd::STATUS_PENDING_XML_CREATION,
////            'label' => yii::t('app', 'Pending XML Creation'),
////            'transition' => array(
////                cfd::STATUS_XML_CREATION_ERROR,
////                Cfd::STATUS_XML_CREATED => '$this->runCfdCreatedTask()',
////            )
////        ),
//        array(
//            'id' => Cfd::STATUS_XML_CREATED,
//            'label' => yii::t('app', 'XML Created'),
//            'transition' => array(
//                cfd::STATUS_XML_SIGNED,
////                cfd::STATUS_PENDING_XML_SIGNATURE => '$this->runSignXmlTask()',
//                cfd::STATUS_XML_SIGNATURE_ERROR
//            )
//        ),
////        array(  // Transitional status while signing Cfd
////            'id' => Cfd::STATUS_PENDING_XML_SIGNATURE,
////            'label' => yii::t('app', 'Pending XML Signature'),
////            'transition' => array(
////                Cfd::STATUS_XML_SIGNED => '$this->runCfdSignedTask()',
////            )
////        ),
//        array(
//            'id' => Cfd::STATUS_XML_SIGNED,
//            'label' => yii::t('app', 'XML Signed'),
//            'transition' => array(
//                Cfd::STATUS_XML_STAMPED,
//                Cfd::STATUS_XML_STAMP_ERROR,
//                cfd::STATUS_XML_SIGNATURE_ERROR
////                cfd::STATUS_PENDING_XML_STAMP => '$this->runStampXmlTask()',
//            )
//        ),
//        array(  // Transitional status while signing Cfd
//            'id' => Cfd::STATUS_PENDING_XML_STAMP,
//            'label' => yii::t('app', 'Pending XML Stamp'),
//            'transition' => array(
//                Cfd::STATUS_XML_STAMPED => '$this->runCfdStampedTask()',
//                Cfd::STATUS_XML_STAMP_ERROR,
//            )
//        ),
//        array(
//            'id' => Cfd::STATUS_XML_STAMPED,
//            'label' => yii::t('app', 'XML Stamped'),
//            'transition' => array(
//                cfd::STATUS_PENDING_PDF_CREATION => '$this->runCfdPdfCreationTask()'
//            )
//        ),
//        array(
//            'id' => Cfd::STATUS_PENDING_PDF_CREATION,
//            'label' => yii::t('app', 'Pending PDF Creation'),
//            'transition' => array(
//                cfd::STATUS_PDF_CREATION_ERROR
//            )
//        ),
//        array(
//            'id' => Cfd::STATUS_XML_CREATION_ERROR,
//            'label' => yii::t('app', 'XML Creation Error'),
//        ),
//        array(
//            'id' => Cfd::STATUS_XML_SIGNATURE_ERROR,
//            'label' => yii::t('app', 'XML Signature Error'),
//        ),
//        array(
//            'id' => Cfd::STATUS_XML_STAMP_ERROR,
//            'label' => yii::t('app', 'XML Stamp Error'),
//        ),
//        array(
//            'id' => Cfd::STATUS_PDF_CREATION_ERROR,
//            'label' => yii::t('app', 'PDF Creation Error'),
//        ),
//    )
//);
?>
