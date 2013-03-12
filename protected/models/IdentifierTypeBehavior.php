<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IdentifierTypeBehavior
 *
 * @author jmariani
 */
class IdentifierTypeBehavior extends ListBehavior {

    const CUSTOMERID = 'customerId';
    const RFC = 'rfc';
    const SUPPLIERID = 'supplierId';
    const VENDORID = 'vendorId';

    public function data() {
        return array(
            self::CUSTOMERID => array('text' => yii::t('app', yii::app()->string->generateAttributeLabel(self::CUSTOMERID))),
            self::RFC => array('text' => yii::t('app', yii::app()->string->generateAttributeLabel(self::RFC))),
            self::SUPPLIERID => array('text' => yii::t('app', yii::app()->string->generateAttributeLabel(self::SUPPLIERID))),
            self::VENDORID => array('text' => yii::t('app', yii::app()->string->generateAttributeLabel(self::VENDORID))),
        );
    }
}

?>
