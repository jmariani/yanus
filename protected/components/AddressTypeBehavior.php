<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AddressTypeBehavior
 *
 * @author jmariani
 */
class AddressTypeBehavior extends ListBehavior {
    const FISCAL = 1;
    const SHIP_TO = 2;
    const BILL_TO = 3;
    const ISSUING = 4;

    public function data() {
        return array(
            self::FISCAL  => array('text' => yii::t('app', 'Fiscal address')),
            self::SHIP_TO => array('text' => yii::t('app', 'Ship to address')),
            self::BILL_TO => array('text' => yii::t('app', 'Bill to address')),
            self::ISSUING => array('text' => yii::t('app', 'Issuing address')),
        );
    }
}

?>
