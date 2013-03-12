<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PartyLocatorTypeBehavior
 *
 * @author jmariani
 */
class PartyMailTypeBehavior extends ListBehavior {

    const DEFAULT_ADDRESS = 'default';
    const INVOICE_NOTIFICATION = 'invoiceNotification';

    public function data() {
        return array(
            self::DEFAULT_ADDRESS => array('text' => yii::t('yanus', yii::app()->string->generateAttributeLabel(self::DEFAULT_ADDRESS))),
            self::INVOICE_NOTIFICATION => array('text' => yii::t('yanus', yii::app()->string->generateAttributeLabel(self::INVOICE_NOTIFICATION))),
        );
    }
}

?>
