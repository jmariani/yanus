<?php
class CkPublicKey {

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
		if (is_resource($res) && get_resource_type($res) === '_p_CkPublicKey') {
			$this->_cPtr=$res;
			return;
		}
		$this->_cPtr=new_CkPublicKey();
	}

	function get_Utf8() {
		return CkPublicKey_get_Utf8($this->_cPtr);
	}

	function put_Utf8($b) {
		CkPublicKey_put_Utf8($this->_cPtr,$b);
	}

	function LoadPkcs1Pem($str) {
		return CkPublicKey_LoadPkcs1Pem($this->_cPtr,$str);
	}

	function LoadRsaDerFile($filename) {
		return CkPublicKey_LoadRsaDerFile($this->_cPtr,$filename);
	}

	function LoadOpenSslDerFile($filename) {
		return CkPublicKey_LoadOpenSslDerFile($this->_cPtr,$filename);
	}

	function LoadOpenSslPemFile($filename) {
		return CkPublicKey_LoadOpenSslPemFile($this->_cPtr,$filename);
	}

	function LoadXmlFile($filename) {
		return CkPublicKey_LoadXmlFile($this->_cPtr,$filename);
	}

	function LoadOpenSslPem($str) {
		return CkPublicKey_LoadOpenSslPem($this->_cPtr,$str);
	}

	function LoadOpenSslDer($data) {
		return CkPublicKey_LoadOpenSslDer($this->_cPtr,$data);
	}

	function LoadRsaDer($data) {
		return CkPublicKey_LoadRsaDer($this->_cPtr,$data);
	}

	function LoadXml($xml) {
		return CkPublicKey_LoadXml($this->_cPtr,$xml);
	}

	function SaveRsaDerFile($filename) {
		return CkPublicKey_SaveRsaDerFile($this->_cPtr,$filename);
	}

	function SaveOpenSslDerFile($filename) {
		return CkPublicKey_SaveOpenSslDerFile($this->_cPtr,$filename);
	}

	function SaveOpenSslPemFile($filename) {
		return CkPublicKey_SaveOpenSslPemFile($this->_cPtr,$filename);
	}

	function SaveXmlFile($filename) {
		return CkPublicKey_SaveXmlFile($this->_cPtr,$filename);
	}

	function GetRsaDer($data) {
		return CkPublicKey_GetRsaDer($this->_cPtr,$data);
	}

	function GetOpenSslDer($data) {
		return CkPublicKey_GetOpenSslDer($this->_cPtr,$data);
	}

	function SaveLastError($filename) {
		return CkPublicKey_SaveLastError($this->_cPtr,$filename);
	}

	function lastErrorText() {
		return CkPublicKey_lastErrorText($this->_cPtr);
	}

	function lastErrorXml() {
		return CkPublicKey_lastErrorXml($this->_cPtr);
	}

	function lastErrorHtml() {
		return CkPublicKey_lastErrorHtml($this->_cPtr);
	}

	function getOpenSslPem() {
		return CkPublicKey_getOpenSslPem($this->_cPtr);
	}

	function getXml() {
		return CkPublicKey_getXml($this->_cPtr);
	}
}


?>