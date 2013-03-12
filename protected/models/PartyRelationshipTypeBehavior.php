<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PartyRelationshipTypeBehavior
 *
 * @author jmariani
 */
class PartyRelationshipTypeBehavior extends ListBehavior {

    const CUSTOMER = 'customer';
    const SUPPLIER = 'supplier';
    const USER = 'user';

    public function data() {
        return array(
            self::CUSTOMER => array('text' => yii::t('app', 'Customer')),
            self::SUPPLIER => array('text' => yii::t('app', 'Supplier')),
            self::USER => array('text' => yii::t('app', 'User')),
        );
    }
}

?>
