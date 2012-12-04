<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FileAssetTypeBehavior
 *
 * @author jmariani
 */
class FileAssetTypeBehavior extends ListBehavior {

    const CFD = 'cfd';
    const PDF = 'pdf';
    const GRAPHIC_REPRESENTATION= 'graphicRepresentation';
    const LOG = 'log';

    public function data() {
        return array(
            self::CFD => array('text' => yii::t('app', CActiveRecord::generateAttributeLabel(self::CFD))),
            self::GRAPHIC_REPRESENTATION => array('text' => yii::t('app', CActiveRecord::generateAttributeLabel(self::GRAPHIC_REPRESENTATION))),
            self::LOG => array('text' => yii::t('app', CActiveRecord::generateAttributeLabel(self::LOG))),
        );
    }
}

?>
