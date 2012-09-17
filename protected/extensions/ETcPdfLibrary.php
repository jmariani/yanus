<?php

/**
 *
 * @author Gencer Gen�giyen
 * @version 1.0.0
 *
 */
class ETcPdfLibrary extends CComponent {

    static $prefixes = array(
        'TCPDF'
    );
    static $basePath = null;

    public function init() {
        Yii::registerAutoloader(array("EtcPdfLibrary", "loadLibrary"));
    }

    public static function loadLibrary($className) {
        foreach (self::$prefixes as $prefix) {
            if (strpos($className, $prefix) !== false) {
                if (!self::$basePath)
                    self::$basePath = Yii::getPathOfAlias("application.vendors") . '/';
                require_once( self::$basePath . 'tcpdf/tcpdf.php' );
                return class_exists($className, false) || interface_exists($className, false);
            }
        }
        return false;
    }

}

?>