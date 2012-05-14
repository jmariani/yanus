<?php
class CkSshKey {

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
		if (is_resource($res) && get_resource_type($res) === '_p_CkSshKey') {
			$this->_cPtr=$res;
			return;
		}
		$this->_cPtr=new_CkSshKey();
	}

	function get_Utf8() {
		return CkSshKey_get_Utf8($this->_cPtr);
	}

	function put_Utf8($b) {
		CkSshKey_put_Utf8($this->_cPtr,$b);
	}

	function get_IsRsaKey() {
		return CkSshKey_get_IsRsaKey($this->_cPtr);
	}

	function get_IsDsaKey() {
		return CkSshKey_get_IsDsaKey($this->_cPtr);
	}

	function get_IsPrivateKey() {
		return CkSshKey_get_IsPrivateKey($this->_cPtr);
	}

	function get_Password($str) {
		CkSshKey_get_Password($this->_cPtr,$str);
	}

	function password() {
		return CkSshKey_password($this->_cPtr);
	}

	function put_Password($newVal) {
		CkSshKey_put_Password($this->_cPtr,$newVal);
	}

	function get_Comment($str) {
		CkSshKey_get_Comment($this->_cPtr,$str);
	}

	function comment() {
		return CkSshKey_comment($this->_cPtr);
	}

	function put_Comment($newVal) {
		CkSshKey_put_Comment($this->_cPtr,$newVal);
	}

	function genFingerprint() {
		return CkSshKey_genFingerprint($this->_cPtr);
	}

	function toXml() {
		return CkSshKey_toXml($this->_cPtr);
	}

	function toRfc4716PublicKey() {
		return CkSshKey_toRfc4716PublicKey($this->_cPtr);
	}

	function toOpenSshPublicKey() {
		return CkSshKey_toOpenSshPublicKey($this->_cPtr);
	}

	function FromXml($xmlKey) {
		return CkSshKey_FromXml($this->_cPtr,$xmlKey);
	}

	function FromRfc4716PublicKey($keyStr) {
		return CkSshKey_FromRfc4716PublicKey($this->_cPtr,$keyStr);
	}

	function FromOpenSshPublicKey($keyStr) {
		return CkSshKey_FromOpenSshPublicKey($this->_cPtr,$keyStr);
	}

	function FromPuttyPrivateKey($keyStr) {
		return CkSshKey_FromPuttyPrivateKey($this->_cPtr,$keyStr);
	}

	function FromOpenSshPrivateKey($keyStr) {
		return CkSshKey_FromOpenSshPrivateKey($this->_cPtr,$keyStr);
	}

	function GenerateRsaKey($numBits,$exponent) {
		return CkSshKey_GenerateRsaKey($this->_cPtr,$numBits,$exponent);
	}

	function GenerateDsaKey($numBits) {
		return CkSshKey_GenerateDsaKey($this->_cPtr,$numBits);
	}

	function SaveText($strToSave,$filename) {
		return CkSshKey_SaveText($this->_cPtr,$strToSave,$filename);
	}

	function loadText($filename) {
		return CkSshKey_loadText($this->_cPtr,$filename);
	}

	function toOpenSshPrivateKey($bEncrypt) {
		return CkSshKey_toOpenSshPrivateKey($this->_cPtr,$bEncrypt);
	}

	function toPuttyPrivateKey($bEncrypt) {
		return CkSshKey_toPuttyPrivateKey($this->_cPtr,$bEncrypt);
	}

	function SaveLastError($filename) {
		return CkSshKey_SaveLastError($this->_cPtr,$filename);
	}

	function lastErrorText() {
		return CkSshKey_lastErrorText($this->_cPtr);
	}

	function lastErrorXml() {
		return CkSshKey_lastErrorXml($this->_cPtr);
	}

	function lastErrorHtml() {
		return CkSshKey_lastErrorHtml($this->_cPtr);
	}
}


?>