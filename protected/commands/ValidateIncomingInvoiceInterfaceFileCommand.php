<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ValidateIncomingInvoiceInterfaceFileCommand:
 *
 * This process performs the following tasks:
 *  1) Opens the file in Castrol format.
 *  2) Validates the contents of the file.
 *  3) Produces a Native XML file to be processed
 *
 * @author jmariani
 */
class ValidateIncomingInvoiceInterfaceFileCommand extends CConsoleCommand {

    private $fileName;
    private $logFile;

    /**
     * Processes a file with CASTROL format.
     * @param array $args arguments for the process.
     * The first parameter is the invoice file with path.
     * @return string the translated message
     */
    private function log($msg, $level = CLogger::LEVEL_INFO) {
        yii::log($msg, $level, $this->name);
        error_log(date(DateTime::ISO8601) . ' - ' . '[' . $level . '] ' . $msg . PHP_EOL, 3, "$this->logFile");
    }

    public function run($args) {
        // - LOCK FILE
        // - When file is locked, try to open it.
        // - Castrol file is a CSV file.
        // - Produce a native XML and save it to NATIVE_XML_PATH

        $this->fileName = $args[0];
        $pathInfo = pathinfo($this->fileName);

        $logPath = SystemConfig::getValue(SystemConfig::LOG_PATH);
        if (!file_exists($logPath))
            mkdir($logPath, 0777, true);

        $this->logFile = $logPath . DIRECTORY_SEPARATOR . $pathInfo['filename'] . '.log';
        @unlink($this->logFile);

        // Check if it exists in IncomingInvoiceInterfaceFile
        $model = IncomingInvoiceInterfaceFile::model()->find('fileName = :name', array(':name' => $pathInfo['basename']));
        $model->validationDttm = new CDbExpression('NOW()');
        $model->logFileLocation = $this->logFile;

        try {
            // Try to lock file to ensure is not still be written.
            $fp = @fopen($this->fileName, 'r');
            if ($fp) {
                while (!flock($fp, LOCK_EX)) {
                    $this->log(yii::t('app', 'Waiting to lock file {file}', array('{file}' => $this->fileName)));
                }
                flock($fp, LOCK_UN);

                $this->log(yii::t('app', 'Validating file "{file}"', array('{file}' => $this->fileName)), CLogger::LEVEL_INFO);

                // VALIDATE FILE

                // Move to next step
                $model->swNextStatus(array('status' => IncomingInvoiceInterfaceFile::PROCESSING));
                $model->save();
            } else {
                $this->log(yii::t('app', 'Failed to open file "{file}"', array('{file}' => $this->fileName)), CLogger::LEVEL_ERROR);
                $model->swNextStatus(array('status' => IncomingInvoiceInterfaceFile::VALIDATION_ERROR));
                $model->save();
            }
        } catch (Exception $e) {
            $this->log($e->getMessage(), CLogger::LEVEL_ERROR);
            $model->swNextStatus(array('status' => IncomingInvoiceInterfaceFile::VALIDATION_ERROR));
            $model->save();
        }
    }
}

?>
