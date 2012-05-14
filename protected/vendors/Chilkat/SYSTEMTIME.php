<?php
class SYSTEMTIME {

	public $_cPtr=null;
	protected $_pData=array();

	function __set($var,$value) {
		$func = 'SYSTEMTIME_'.$var.'_set';
		if (function_exists($func)) return call_user_func($func,$this->_cPtr,$value);
		if ($var === 'thisown') return swig_chilkat_9_3_1_alter_newobject($this->_cPtr,$value);
		$this->_pData[$var] = $value;
	}

	function __isset($var) {
		if (function_exists('SYSTEMTIME_'.$var.'_set')) return true;
		if ($var === 'thisown') return true;
		return array_key_exists($var, $this->_pData);
	}

	function __get($var) {
		$func = 'SYSTEMTIME_'.$var.'_get';
		if (function_exists($func)) {
			$r = call_user_func($func,$this->_cPtr);
			if (!is_resource($r)) return $r;
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			return new $c($r);
		}
		if ($var === 'thisown') return swig_chilkat_9_3_1_get_newobject($this->_cPtr);
		return $this->_pData[$var];
	}

	function __construct($res=null) {
		if (is_resource($res) && get_resource_type($res) === '_p_SYSTEMTIME') {
			$this->_cPtr=$res;
			return;
		}
		$this->_cPtr=new_SYSTEMTIME();
	}
}


?>