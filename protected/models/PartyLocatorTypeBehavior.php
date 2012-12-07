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
class PartyLocatorTypeBehavior extends ListBehavior {

    const PRIMARY = 'primary';
    const INVOICE_NOTIFICATION = 'invoiceNotification';

    public function data() {
        return array(
            self::PRIMARY => array('text' => yii::t('app', CModel::generateAttributeLabel(self::PRIMARY))),
            self::INVOICE_NOTIFICATION => array('text' => yii::t('app', CModel::generateAttributeLabel(self::INVOICE_NOTIFICATION))),
        );
    }
}

?>
