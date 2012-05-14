<?php
class CkPrivateKey {

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
		if (is_resource($res) && get_resource_type($res) === '_p_CkPrivateKey') {
			$this->_cPtr=$res;
			return;
		}
		$this->_cPtr=new_CkPrivateKey();
	}

	function get_Utf8() {
		return CkPrivateKey_get_Utf8($this->_cPtr);
	}

	function put_Utf8($b) {
		CkPrivateKey_put_Utf8($this->_cPtr,$b);
	}

	function LoadEncryptedPem($pemStr,$password) {
		return CkPrivateKey_LoadEncryptedPem($this->_cPtr,$pemStr,$password);
	}

	function LoadEncryptedPemFile($filename,$password) {
		return CkPrivateKey_LoadEncryptedPemFile($this->_cPtr,$filename,$password);
	}

	function LoadPkcs8Encrypted($data,$password) {
		return CkPrivateKey_LoadPkcs8Encrypted($this->_cPtr,$data,$password);
	}

	function LoadPkcs8EncryptedFile($filename,$password) {
		return CkPrivateKey_LoadPkcs8EncryptedFile($this->_cPtr,$filename,$password);
	}

	function GetPkcs8Encrypted($password,$outBytes) {
		return CkPrivateKey_GetPkcs8Encrypted($this->_cPtr,$password,$outBytes);
	}

	function getPkcs8EncryptedPem($password) {
		return CkPrivateKey_getPkcs8EncryptedPem($this->_cPtr,$password);
	}

	function SavePkcs8EncryptedFile($password,$filename) {
		return CkPrivateKey_SavePkcs8EncryptedFile($this->_cPtr,$password,$filename);
	}

	function SavePkcs8EncryptedPemFile($password,$filename) {
		return CkPrivateKey_SavePkcs8EncryptedPemFile($this->_cPtr,$password,$filename);
	}

	function LoadRsaDerFile($filename) {
		return CkPrivateKey_LoadRsaDerFile($this->_cPtr,$filename);
	}

	function LoadPkcs8File($filename) {
		return CkPrivateKey_LoadPkcs8File($this->_cPtr,$filename);
	}

	function LoadPemFile($filename) {
		return CkPrivateKey_LoadPemFile($this->_cPtr,$filename);
	}

	function LoadXmlFile($filename) {
		return CkPrivateKey_LoadXmlFile($this->_cPtr,$filename);
	}

	function LoadPem($str) {
		return CkPrivateKey_LoadPem($this->_cPtr,$str);
	}

	function LoadRsaDer($data) {
		return CkPrivateKey_LoadRsaDer($this->_cPtr,$data);
	}

	function LoadPkcs8($data) {
		return CkPrivateKey_LoadPkcs8($this->_cPtr,$data);
	}

	function LoadXml($xml) {
		return CkPrivateKey_LoadXml($this->_cPtr,$xml);
	}

	function SaveRsaDerFile($filename) {
		return CkPrivateKey_SaveRsaDerFile($this->_cPtr,$filename);
	}

	function SavePkcs8File($filename) {
		return CkPrivateKey_SavePkcs8File($this->_cPtr,$filename);
	}

	function SaveRsaPemFile($filename) {
		return CkPrivateKey_SaveRsaPemFile($this->_cPtr,$filename);
	}

	function SavePkcs8PemFile($filename) {
		return CkPrivateKey_SavePkcs8PemFile($this->_cPtr,$filename);
	}

	function SaveXmlFile($filename) {
		return CkPrivateKey_SaveXmlFile($this->_cPtr,$filename);
	}

	function GetRsaDer($data) {
		return CkPrivateKey_GetRsaDer($this->_cPtr,$data);
	}

	function GetPkcs8($data) {
		return CkPrivateKey_GetPkcs8($this->_cPtr,$data);
	}

	function SaveLastError($filename) {
		return CkPrivateKey_SaveLastError($this->_cPtr,$filename);
	}

	function lastErrorText() {
		return CkPrivateKey_lastErrorText($this->_cPtr);
	}

	function lastErrorXml() {
		return CkPrivateKey_lastErrorXml($this->_cPtr);
	}

	function lastErrorHtml() {
		return CkPrivateKey_lastErrorHtml($this->_cPtr);
	}

	function getRsaPem() {
		return CkPrivateKey_getRsaPem($this->_cPtr);
	}

	function getPkcs8Pem() {
		return CkPrivateKey_getPkcs8Pem($this->_cPtr);
	}

	function getXml() {
		return CkPrivateKey_getXml($this->_cPtr);
	}
}


?>