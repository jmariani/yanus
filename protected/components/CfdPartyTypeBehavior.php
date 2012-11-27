<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CfdPartyTypeBehavior
 *
 * @author jmariani
 */
class CfdPartyTypeBehavior extends ListBehavior {

    const VENDOR = 'vendor';
    const CUSTOMER = 'customer';

    public function data() {
        return array(
            self::VENDOR => array('text' => yii::t('app', 'Vendor')),
            self::CUSTOMER => array('text' => yii::t('app', 'Customer')),
        );
    }
}

?>
