<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AddressTypeBehavior
 *
 * @author jmariani
 */
class AddressTypeBehavior extends ListBehavior {
    const PRIMARY = 'primary';
    const SHIP_TO = 'shipTo';
    const BILL_TO = 'billTo';
    const BILLED_FROM = 'billedFrom';

    public function data() {
        return array(
            self::PRIMARY => array('text' => yii::t('app', 'Primary address')),
            self::SHIP_TO => array('text' => yii::t('app', 'Ship to address')),
            self::BILL_TO => array('text' => yii::t('app', 'Bill to address')),
            self::BILLED_FROM => array('text' => yii::t('app', 'Bill address')),
        );
    }
}

?>
