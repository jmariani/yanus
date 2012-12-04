<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CfdItemCodeBehavior
 *
 * @author jmariani
 */
class CfdItemCodeBehavior extends ListBehavior {

    // CFD Item attribute codes used by GAMA

    const AUTH_NBR = 'authnbr';
    const ENGINE_NBR = 'enginenbr';
    const GROUP = 'group';
    const INVENTORY_NBR = 'inventorynbr';
    const KM = 'km';
    const LICENSE_PLATE = 'licenseplate';
    const SERIAL_NBR = 'serialnbr';
    const USERNAME = 'username';
    const VEHICLE = 'vehicle';

    public function data() {
        return array(
            self::AUTH_NBR => array('text' => yii::t('app', 'Authorization Nº')),
            self::ENGINE_NBR => array('text' => yii::t('app', 'Engine Nº')),
            self::GROUP => array('text' => yii::t('app', 'Group')),
            self::INVENTORY_NBR => array('text' => yii::t('app', 'Inventory Nº')),
            self::KM => array('text' => yii::t('app', 'Km')),
            self::LICENSE_PLATE => array('text' => yii::t('app', 'License Plate')),
            self::SERIAL_NBR => array('text' => yii::t('app', 'Serial Nº')),
            self::USERNAME => array('text' => yii::t('app', 'User Name')),
            self::VEHICLE => array('text' => yii::t('app', 'Vehicle')),
        );
    }
}

?>
