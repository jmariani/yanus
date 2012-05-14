<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PartyTypeBehavior
 *
 * @author jmariani
 */
class PartyTypeBehavior extends ListBehavior {
    const PERSON = 1;
    const COMPANY = 2;

    public function data() {
        return array(
            self::PERSON => array('text' => yii::t('app', 'Person')),
            self::COMPANY => array('text' => yii::t('app', 'Company')),
        );
    }
}

?>
