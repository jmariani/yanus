<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SatRfc
 *
 * @author jmariani
 */
class YanusLog {
    private $_logFile;
    public function __construct($logFile = null, $newFile = false) {
        if (!file_exists(pathinfo($logFile, PATHINFO_DIRNAME))) mkdir(pathinfo($logFile, PATHINFO_DIRNAME), 0777, true);
        if ($newFile) @unlink($logFile);
        $this->_logFile = $logFile;
    }

    public function log($msg, $level = CLogger::LEVEL_INFO, $category = 'application', $debug = false) {
        yii::log($msg, $level, $category);
        if ($this->_logFile) {
            $sMsg = yii::t('app', '[{date}] - [{level}] {msg}', array(
                '{date}' => date(DateTime::ISO8601),
                '{level}' => $level,
                '{msg}' => $msg)) . PHP_EOL;
            error_log($sMsg, 3, "$this->_logFile");
            if ($debug) echo $sMsg;
        }
    }
}

?>
