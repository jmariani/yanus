<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CfdTypeBehavior
 *
 * @author jmariani
 */
class CfdTypeBehavior extends ListBehavior {

    const INVOICE = 0;
    const CREDIT_MEMO = 1;
    const TRANSPORT = 2;

    public function data() {
        return array(
            self::INVOICE => array('text' => 'ingreso'),
            self::CREDIT_MEMO => array('text' => 'egreso'),
            self::TRANSPORT => array('text' => 'traslado'),
        );
    }
}

?>
