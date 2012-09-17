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
class CfdStatusBehavior extends ListBehavior {

    const CREATED = 1;
    const ERROR = 2;
    const SIGNED = 3;
    const SEALED = 4;

    const VALID = 5;

    public function data() {
        return array(
            self::CREATED => array('text' => yii::t('app', 'New')),
            self::ERROR => array('text' => yii::t('app', 'Error')),
            self::SIGNED => array('text' => yii::t('app', 'Signed')),
            self::SEALED => array('text' => yii::t('app', 'Sealed')),
            self::VALID => array('text' => yii::t('app', 'Valid')),
        );
    }
}

?>
