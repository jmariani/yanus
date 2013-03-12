<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CastrolProcessIncomingInvoiceFile:
 *
 * This process performs the following tasks:
 *  1) Opens the file in Castrol format.
 *  2) Validates the contents of the file.
 *  3) Produces a Native XML file to be processed
 *
 * @author jmariani
 */
class CastrolCfdProcessCommand extends CConsoleCommand {

    public function run($args) {
        // 1 - Run castroltonativexml {csv} {xml}
        // 2 - Run importnativexml {xml}
        // 3 - Run cfdtoxml {cfd_id}
        // 4 - Run cfdsignxml {cfd_id}
        // 5 - Run cfdstampxml {cfd_id}
        // 6 - Run castrolcfdtopdf {cfd_id}


    }

}

?>
