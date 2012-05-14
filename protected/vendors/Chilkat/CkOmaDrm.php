<?php
class CkOmaDrm {

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
		if (is_resource($res) && get_resource_type($res) === '_p_CkOmaDrm') {
			$this->_cPtr=$res;
			return;
		}
		$this->_cPtr=new_CkOmaDrm();
	}

	function get_Utf8() {
		return CkOmaDrm_get_Utf8($this->_cPtr);
	}

	function put_Utf8($b) {
		CkOmaDrm_put_Utf8($this->_cPtr,$b);
	}

	function UnlockComponent($unlockCode) {
		return CkOmaDrm_UnlockComponent($this->_cPtr,$unlockCode);
	}

	function SaveLastError($filename) {
		return CkOmaDrm_SaveLastError($this->_cPtr,$filename);
	}

	function LoadDcfFile($filename) {
		return CkOmaDrm_LoadDcfFile($this->_cPtr,$filename);
	}

	function LoadDcfData($data) {
		return CkOmaDrm_LoadDcfData($this->_cPtr,$data);
	}

	function get_Base64Key($str) {
		CkOmaDrm_get_Base64Key($this->_cPtr,$str);
	}

	function put_Base64Key($key) {
		CkOmaDrm_put_Base64Key($this->_cPtr,$key);
	}

	function get_DrmContentVersion() {
		return CkOmaDrm_get_DrmContentVersion($this->_cPtr);
	}

	function get_ContentType($str) {
		CkOmaDrm_get_ContentType($this->_cPtr,$str);
	}

	function put_ContentType($contentType) {
		CkOmaDrm_put_ContentType($this->_cPtr,$contentType);
	}

	function get_ContentUri($str) {
		CkOmaDrm_get_ContentUri($this->_cPtr,$str);
	}

	function put_ContentUri($contentUri) {
		CkOmaDrm_put_ContentUri($this->_cPtr,$contentUri);
	}

	function get_Headers($str) {
		CkOmaDrm_get_Headers($this->_cPtr,$str);
	}

	function put_Headers($headers) {
		CkOmaDrm_put_Headers($this->_cPtr,$headers);
	}

	function get_IV($data) {
		CkOmaDrm_get_IV($this->_cPtr,$data);
	}

	function put_IV($data) {
		CkOmaDrm_put_IV($this->_cPtr,$data);
	}

	function get_EncryptedData($data) {
		CkOmaDrm_get_EncryptedData($this->_cPtr,$data);
	}

	function get_DecryptedData($data) {
		CkOmaDrm_get_DecryptedData($this->_cPtr,$data);
	}

	function SaveDecrypted($filename) {
		return CkOmaDrm_SaveDecrypted($this->_cPtr,$filename);
	}

	function LoadUnencryptedData($data) {
		CkOmaDrm_LoadUnencryptedData($this->_cPtr,$data);
	}

	function LoadUnencryptedFile($filename) {
		return CkOmaDrm_LoadUnencryptedFile($this->_cPtr,$filename);
	}

	function SetEncodedIV($encodedIv,$encoding) {
		CkOmaDrm_SetEncodedIV($this->_cPtr,$encodedIv,$encoding);
	}

	function CreateDcfFile($filename) {
		return CkOmaDrm_CreateDcfFile($this->_cPtr,$filename);
	}

	function lastErrorText() {
		return CkOmaDrm_lastErrorText($this->_cPtr);
	}

	function lastErrorXml() {
		return CkOmaDrm_lastErrorXml($this->_cPtr);
	}

	function lastErrorHtml() {
		return CkOmaDrm_lastErrorHtml($this->_cPtr);
	}

	function base64Key() {
		return CkOmaDrm_base64Key($this->_cPtr);
	}

	function contentType() {
		return CkOmaDrm_contentType($this->_cPtr);
	}

	function contentUri() {
		return CkOmaDrm_contentUri($this->_cPtr);
	}

	function headers() {
		return CkOmaDrm_headers($this->_cPtr);
	}

	function getHeaderField($fieldName) {
		return CkOmaDrm_getHeaderField($this->_cPtr,$fieldName);
	}
}


?>