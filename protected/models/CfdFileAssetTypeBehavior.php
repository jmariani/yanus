<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CfdFileAssetTypeBehavior
 *
 * @author jmariani
 */
class CfdFileAssetTypeBehavior extends ListBehavior {

    const CFD = 'cfd';
    const GRAPHIC_VERSION = 'graphic_version';

    public function data() {
        return array(
            self::CFD => array('text' => yii::t('app', yii::app()->string->generateAttributeLabel(self::CFD))),
            self::GRAPHIC_VERSION => array('text' => yii::t('app', yii::app()->string->generateAttributeLabel(self::GRAPHIC_VERSION))),
        );
    }
}

?>
