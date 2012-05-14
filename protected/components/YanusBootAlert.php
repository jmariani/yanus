<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of YanusBootAlert
 *
 * @author jmariani
 */
class YanusBootAlert extends BootAlert {

    public $closable = true;

    /**
     * Initializes the widget.
     */
    public function init() {
        parent::init();

        if (!$this->closable)
            $this->template = '<div class="alert alert-block alert-{key}{class}">{message}</div>';
    }

}

?>
