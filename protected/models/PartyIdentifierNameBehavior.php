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
class PartyIdentifierNameBehavior extends ListBehavior {
    const RFC = 'rfc';
    const CUSTOMER_CODE = 'customerCode';

    public function data() {
        return array(
            self::CUSTOMER_CODE => array('text' => yii::t('app', CModel::generateAttributeLabel(self::CUSTOMER_CODE))),
            self::RFC => array('text' => yii::t('app', CModel::generateAttributeLabel(self::RFC))),
        );
    }
}

?>
