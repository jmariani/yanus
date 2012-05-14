<?php
/**
 * 
 * @author Gencer Gençgiyen
 * @version 1.0.0
 *
 */
class EChilkatLibrary extends CComponent {
	static $prefixes = array(
		'Ck'
	);
    static $basePath = null;

    public function init() {
    	Yii::registerAutoloader(array("EChilkatLibrary", "loadLibrary"));
    	//It has to be required once:
    	require_once (self::$basePath.'Chilkat/SYSTEMTIME.php');
    	//Chilkat v9.3.1 introduces a new DateTime handler instead of SYSTEMTIME...
    	require_once (self::$basePath.'Chilkat/CkDateTime.php');
    }
    
    public static function loadLibrary($className){
    	foreach(self::$prefixes as $prefix){
    		if(strpos($className, $prefix)!==false){
    			if(!self::$basePath) self::$basePath = Yii::getPathOfAlias("application.vendors").'/';
    			require_once( self::$basePath.'Chilkat/'.$className.'.php' );
    			return class_exists($className, false) || interface_exists($className, false);
    		}
    	}
    	return false;
    }

}
?>