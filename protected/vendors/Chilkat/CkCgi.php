<?php
class CkCgi {

	public $_cPtr=null;
	protected $_pData=array();

	function __set($var,$value) {
		if ($var === 'thisown') return swig_chilkat_9_3_1_alter_newobject($this->_cPtr,$value);
		$this->_pData[$var] = $value;
	}

	function __isset($var) {
		if ($var === 'thisown') return true;
		return array_key_exists($var, $this->_pData);
	}

	function __get($var) {
		if ($var === 'thisown') return swig_chilkat_9_3_1_get_newobject($this->_cPtr);
		return $this->_pData[$var];
	}

	function __construct($res=null) {
		if (is_resource($res) && get_resource_type($res) === '_p_CkCgi') {
			$this->_cPtr=$res;
			return;
		}
		$this->_cPtr=new_CkCgi();
	}

	function get_Utf8() {
		return CkCgi_get_Utf8($this->_cPtr);
	}

	function put_Utf8($b) {
		CkCgi_put_Utf8($this->_cPtr,$b);
	}

	function SaveLastError($filename) {
		return CkCgi_SaveLastError($this->_cPtr,$filename);
	}

	function lastErrorText() {
		return CkCgi_lastErrorText($this->_cPtr);
	}

	function lastErrorXml() {
		return CkCgi_lastErrorXml($this->_cPtr);
	}

	function lastErrorHtml() {
		return CkCgi_lastErrorHtml($this->_cPtr);
	}
}


?>