<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PartyIdentifierNameBehavior
 *
 * @author jmariani
 */
class PartyIdentifierTypeBehavior extends ListBehavior {

    const RFC = 'rfc';
    const CUSTOMER_ID = 'customerId';

    public function data() {
        return array(
            self::CUSTOMER_ID => array('text' => yii::t('app', yii::app()->string->generateAttributeLabel(self::CUSTOMER_ID))),
            self::RFC => array('text' => yii::t('app', yii::app()->string->generateAttributeLabel(self::RFC))),
        );
    }
}

?>
