<?php

Yii::import('application.models._base.BaseIncomingInvoiceInterfaceFile');

class IncomingInvoiceInterfaceFile extends BaseIncomingInvoiceInterfaceFile {

    const PENDING_VALIDATION = 'PendingValidation';
    const VALIDATING = 'Validating';
    const VALID = 'Valid';
    const PROCESSED = 'Processed';

    const PENDING_PROCESSING = 'PendingProcessing';
    const PROCESSING = 'Processing';

    const ERROR = 'Error';
    const PROCESSING_ERROR = 'ProcessingError';
    const VALIDATION_ERROR = 'ValidationError';

    const SCENARIO_VALIDATE = 'validate';
    const SCENARIO_PROCESS = 'process';
    const SCENARIO_UPLOAD = 'upload';

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function behaviors() {
        $behaviors = parent::behaviors();
        $behaviors['swBehavior'] = array('class' => 'application.extensions.simpleWorkflow.SWActiveRecordBehavior', 'transitionBeforeSave' => true, 'enableEvent' => false);
        return $behaviors;
    }

    public static function getFilePath() {
        // protected/files/IncomingInvoiceInterfaceFile
        // Get path name
        $pathRec = SystemConfig::model()->find('code = :code', array(':code' => SystemConfig::INCOMING_INVOICE_INTERFACE_FILE_PATH));
        $path = yii::getPathOfAlias('application') . DIRECTORY_SEPARATOR . $pathRec->value;
        // Check if exists
        if (!file_exists($path)) mkdir($path, 0777, true);
        return $path;
    }

    public function getLogFileName() {
        return yii::app()->getRuntimePath() . DIRECTORY_SEPARATOR . 'log' . DIRECTORY_SEPARATOR . __CLASS__ . DIRECTORY_SEPARATOR . pathinfo($this->fileLocation, PATHINFO_FILENAME) . '.log';
    }

    public static function getLogFilePath() {
        return yii::app()->getRuntimePath() . DIRECTORY_SEPARATOR . 'log' . DIRECTORY_SEPARATOR . __CLASS__;
    }

    public static function getNativeXmlPath() {
        return yii::getPathOfAlias('application') . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'nativeXml';
    }

    public function getStatusLabelClass() {
        switch ($this->swGetStatus()->getId()) {
            case self::ERROR:
            case self::PROCESSING_ERROR:
            case self::VALIDATION_ERROR:
                return 'label-important';
                break;
            case self::VALIDATING:
            case self::PROCESSING:
                return 'label-warning';
                break;
            case self::PROCESSED:
                return 'label-success';
                break;
            default:
                return 'label-info';
                break;
        }
    }

    public function log($msg, $level = CLogger::LEVEL_INFO) {
        if (!$this->logFileLocation) {
            try {
                $logPath = SystemConfig::getValue(SystemConfig::LOG_PATH);
            } catch (Exception $e) {
                // if SystemConfig::LOG_PATH is not defined, use Yii log path.
            }
            // create folder if doesn't exists
            if (!file_exists($logPath)) mkdir($logPath, 0777, true);
            $this->logFileLocation = $logPath . DIRECTORY_SEPARATOR . YFileHelper::getName($this->fileName) . '.log';
        }
        yii::log($msg, $level, __CLASS__);
        error_log(date(DateTime::ISO8601) . ' - ' . '[' . $level . '] ' . $msg . PHP_EOL, 3, "$this->logFileLocation");
    }

    public function rules() {
        $rules = array();
//        $rules[] = array('fileName', 'file', 'on' => 'upload');
        $rules[] = array('status',  'SWValidator','enableSwValidation'=>true,);
        $rules[] = array('receptionDttm', 'default', 'value' => new CDbExpression('NOW()'), 'on' => 'update,insert,upload');
        $rules[] = array('validationDttm', 'default', 'value' => new CDbExpression('NOW()'), 'on' => 'sw:' . IncomingInvoiceInterfaceFile::PENDING_VALIDATION . '_' . IncomingInvoiceInterfaceFile::VALID);
//        $rules[] = array('id', 'ext.validators.GamaIncomingInvoiceInterfaceFileValidator');
        $rules[] = array('validationDttm', 'default', 'value' => new CDbExpression('null'), 'on' => array('upload', 'sw:' . IncomingInvoiceInterfaceFile::VALID . '_' . IncomingInvoiceInterfaceFile::PENDING_VALIDATION));
//        $rules[] = array('status', 'SWValidator');

//        $rules[] = array('IncomingInvoiceInterfaceFileStatus_id', 'default', 'value'
//            => IncomingInvoiceInterfaceFileStatus::model()->find('code = :code', array(':code' => IncomingInvoiceInterfaceFileStatus::PENDING))->id,
//            'on' => 'insert,upload');
        return array_merge($rules, parent::rules());
    }

    public function scopes() {
        $scopes = parent::scopes();
        $scopes['orderByReceptionDttmDesc'] = array('order' => $this->getTableAlias(false, false) . '.receptionDttm DESC');
        return $scopes;
    }

    public function search() {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('fileName', $this->fileName, true);
        $criteria->compare('receptionDttm', $this->receptionDttm, true);
        $criteria->compare('validationDttm', $this->validationDttm, true);
        $criteria->compare('processDttm', $this->processDttm, true);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('note', $this->note, true);
//        $criteria->compare('IncomingInvoiceInterfaceFileStatus_id', $this->IncomingInvoiceInterfaceFileStatus_id);

        return new CActiveDataProvider($this, array(
                    'sort' => array(
                        'defaultOrder' => array(
                            'receptionDttm' => true
                    )),
                    'criteria' => $criteria,
                    'pagination' => array('pageSize' => Yii::app()->user->getState('pageSize', Yii::app()->params['defaultPageSize'])),
                ));
    }

    public function runProcess() {

        // Run process command.
        // Find command to run
        // SystemConfig->PROCESS_INCOMING_INVOICE_FILE_CMD
        $cmd = SystemConfig::getValue(SystemConfig::INCOMING_INVOICE_INTERFACE_FILE_PROCESS_CMD);
        $console = new CConsole();
        $console->runCommand($cmd, array('process', '--modelId=' . $this->id), CConsole::RUN_SYNC);

//        if (!$cmd) {
////            $this->addError('fileName', yii::t('app', 'System Config code "{code}" is undefined.', array('{code}' => SystemConfig::INCOMING_INVOICE_INTERFACE_FILE_PROCESS_CMD)));
//            $this->swNextStatus(array('status' => IncomingInvoiceInterfaceFile::PROCESSING_ERROR));
//        } else {
//            $console = new CConsole();
//            $console->runCommand($cmd, array('"' . $this->fileLocation . '"'), false);
//        }
    }
    public function runValidation() {

        // Run validation command.
        // Find command to run
        // SystemConfig->INCOMING_INVOICE_INTERFACE_FILE_VALIDATION_CMD
        $cmd = SystemConfig::getValue(SystemConfig::INCOMING_INVOICE_INTERFACE_FILE_VALIDATION_CMD);
        $console = new CConsole();
        $console->runCommand($cmd, array('validate', '--modelId=' . $this->id), CConsole::RUN_SYNC);
    }
}