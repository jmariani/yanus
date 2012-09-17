<?php

/**
 *
 * @author Gencer Gen�giyen
 * @version 1.0.0
 *
 */
class ENuSoapLibrary extends CComponent {

    static $prefixes = array(
        'nusoap'
    );
    static $basePath = null;

    public function init() {
        Yii::registerAutoloader(array("ENuSoapLibrary", "loadLibrary"));
    }

    public static function loadLibrary($className) {
        foreach (self::$prefixes as $prefix) {
            if (strpos($className, $prefix) !== false) {
                if (!self::$basePath)
                    self::$basePath = Yii::getPathOfAlias("application.vendors") . '/';
                require_once( self::$basePath . 'nusoap/nusoap.php' );
                return class_exists($className, false) || interface_exists($className, false);
            }
        }
        return false;
    }

}

?>