<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PartyNameTypeBehavior
 *
 * @author jmariani
 */
class PartyNameTypeBehavior extends ListBehavior {
    const PRIMARY = 'primary';
    const ALTERNATE = 'alternate';

    public function data() {
        return array(
            self::PRIMARY => array('text' => yii::t('app', yii::app()->string->generateAttributeLabel(self::PRIMARY))),
            self::ALTERNATE => array('text' => yii::t('app', yii::app()->string->generateAttributeLabel(self::ALTERNATE))),
        );
    }
}

?>
