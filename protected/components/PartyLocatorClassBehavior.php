<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PartyLocatorClassBehavior
 *
 * @author jmariani
 */
class PartyLocatorClassBehavior extends ListBehavior {

    const ADDRESS = 'address';
    const PHONE = 'phone';

    public function data() {
        return array(
            self::ADDRESS => array('text' => yii::t('app', 'Address')),
            self::PHONE => array('text' => yii::t('app', 'Phone')),
        );
    }
}

?>
