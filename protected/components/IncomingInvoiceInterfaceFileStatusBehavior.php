<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CfdStatusBehavior
 *
 * @author jmariani
 */
class IncomingInvoiceInterfaceFileStatusBehavior extends ListBehavior {

    const PENDING = 1;
    const ERROR = 2;
    const PROCESSED = 3;

    public function data() {
        return array(
            self::PENDING => array('text' => yii::t('app', 'Pending')),
            self::ERROR => array('text' => yii::t('app', 'Error')),
            self::PROCESSED => array('text' => yii::t('app', 'Processed')),
        );
    }
}

?>
