<?php
class CkZipCrc {

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
		if (is_resource($res) && get_resource_type($res) === '_p_CkZipCrc') {
			$this->_cPtr=$res;
			return;
		}
		$this->_cPtr=new_CkZipCrc();
	}

	function get_Utf8() {
		return CkZipCrc_get_Utf8($this->_cPtr);
	}

	function put_Utf8($b) {
		CkZipCrc_put_Utf8($this->_cPtr,$b);
	}

	function FileCrc($filename) {
		return CkZipCrc_FileCrc($this->_cPtr,$filename);
	}

	function CalculateCrc($byteData) {
		return CkZipCrc_CalculateCrc($this->_cPtr,$byteData);
	}

	function MoreData($byteData) {
		CkZipCrc_MoreData($this->_cPtr,$byteData);
	}

	function EndStream() {
		return CkZipCrc_EndStream($this->_cPtr);
	}

	function BeginStream() {
		CkZipCrc_BeginStream($this->_cPtr);
	}

	function toHex($crc) {
		return CkZipCrc_toHex($this->_cPtr,$crc);
	}
}


?>