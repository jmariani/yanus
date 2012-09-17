<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProcessIncomingInvoiceFile:
 *
 * Parameters:
 *  0 -> filename to process.
 * @author jmariani
 */
class ProcessIncomingInvoiceInterfaceFileCommand extends CConsoleCommand {

    public function run($args) {

        $sw = new SwTest();
        echo $sw->swGetStatus()->getLabel() . PHP_EOL;
        if (!$sw->save())
            print_r($sw->getErrors ());

        yii::app()->end();

        // Test if filename exists.
        $pathInfo = pathinfo($args[0]);
        $interfaceFile = IncomingInvoiceInterfaceFile::model()->find('fileName = :name', array(':name' => $pathInfo['filename']));

        if ($interfaceFile) {
            $interfaceFile->swNextStatus('pending');
        } else {
            $interfaceFile = new IncomingInvoiceInterfaceFile();
            if ($interfaceFile->swHasStatus())
                echo 'Has status ' . $interfaceFile->swGetStatus()->getLabel() . PHP_EOL;
            $interfaceFile->fileName = $pathInfo['filename'];
        }
        if (!$interfaceFile->save())
            print_r($interfaceFile->getErrors());
    }
}

?>
