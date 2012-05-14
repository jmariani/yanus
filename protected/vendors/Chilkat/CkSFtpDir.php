<?php
class CkSFtpDir {

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
		if (is_resource($res) && get_resource_type($res) === '_p_CkSFtpDir') {
			$this->_cPtr=$res;
			return;
		}
		$this->_cPtr=new_CkSFtpDir();
	}

	function get_Utf8() {
		return CkSFtpDir_get_Utf8($this->_cPtr);
	}

	function put_Utf8($b) {
		CkSFtpDir_put_Utf8($this->_cPtr,$b);
	}

	function SaveLastError($filename) {
		return CkSFtpDir_SaveLastError($this->_cPtr,$filename);
	}

	function lastErrorText() {
		return CkSFtpDir_lastErrorText($this->_cPtr);
	}

	function lastErrorXml() {
		return CkSFtpDir_lastErrorXml($this->_cPtr);
	}

	function lastErrorHtml() {
		return CkSFtpDir_lastErrorHtml($this->_cPtr);
	}

	function get_NumFilesAndDirs() {
		return CkSFtpDir_get_NumFilesAndDirs($this->_cPtr);
	}

	function get_OriginalPath($str) {
		CkSFtpDir_get_OriginalPath($this->_cPtr,$str);
	}

	function originalPath() {
		return CkSFtpDir_originalPath($this->_cPtr);
	}

	function GetFileObject($index) {
		$r=CkSFtpDir_GetFileObject($this->_cPtr,$index);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkSFtpFile($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function getFilename($index) {
		return CkSFtpDir_getFilename($this->_cPtr,$index);
	}
}


?>