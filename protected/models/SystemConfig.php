<?php

Yii::import('application.models._base.BaseSystemConfig');

class SystemConfig extends BaseSystemConfig {

    const CFD_XSD = 'CFD_XSD_';
    const CFD_OS_XSLT = 'CFD_OS_XSLT_';

    const CURRENT_CFD_VERSION = 'CURRENT_CFD_VERSION';

    const DEMO_RFC = 'DEMO_RFC';

    const INCOMING_INVOICE_INTERFACE_FILE_CMD_PROCESSOR = 'INCOMING_INVOICE_INTERFACE_FILE_CMD_PROCESSOR';
    const INCOMING_INVOICE_INTERFACE_FILE_PATH = 'INCOMING_INVOICE_INTERFACE_FILE_PATH';

    const LOG_PATH = 'LOG_PATH';

    const NATIVE_XML_STORAGE_PATH = 'NATIVE_XML_STORAGE_PATH';

    const RUN_MODE = 'RUN_MODE';
    const RUN_MODE_DEVELOPMENT = 'DEVELOPMENT';
    const RUN_MODE_TEST = 'TEST';
    const RUN_MODE_PRODUCTION = 'PRODUCTION';

    const SAT_FILES_PATH = 'SAT_FILES_PATH';
    const SYSTEM_TIMEZONE = 'SYSTEM_TIMEZONE';

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function rules() {
        return array(
            array('description, code, value', 'required'),
            array('description', 'length', 'max' => 255),
            array('code', 'length', 'max' => 45),
            array('id, description, code, value', 'safe', 'on' => 'search'),
        );
    }

    public static function getRecord($code) {
        $rec = self::model()->find('code = :code', array(':code' => $code));
        if (!$rec)
            throw new CException(yii::t('app', 'System Config code {code} is not defined.', array('{code}' => $code)));
        else
            return $rec;
    }

    public static function getValue($code) {
        $rec = self::model()->find('code = :code', array(':code' => $code));
        if (!$rec)
            throw new CException(yii::t('app', 'System Config code {code} is not defined.', array('{code}' => $code)));
        else
            return $rec->value;
    }

    public static function getLogPath() {
        $logPath = SystemConfig::getValue(SystemConfig::LOG_PATH);
        if (!file_exists($logPath))
            mkdir($logPath, 0777, true);
        return $logPath;
    }
}