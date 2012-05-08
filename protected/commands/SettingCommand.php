<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Setting
 *
 * @author jmariani
 */
class SettingCommand extends CConsoleCommand {
    public function run($args) {
        yii::app()->settings->set($args[0], $args[1], $args[2]);
    }
}

?>
