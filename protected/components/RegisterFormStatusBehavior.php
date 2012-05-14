<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RegisterFormStatusBehavior
 *
 * @author jmariani
 */
class RegisterFormStatusBehavior extends ListBehavior {

    const CREATED = 0;
    const PENDING = 1;
    const ACTIVATED = 2;
    const REJECTED = 3;

    public function data() {
        return array(
            self::CREATED => array('text' => yii::t('app', 'New')),
            self::PENDING => array('text' => yii::t('app', 'Pending activation')),
            self::ACTIVATED => array('text' => yii::t('app', 'Active')),
            self::REJECTED => array('text' => yii::t('app', 'Rejected')),
        );
    }
}

?>
