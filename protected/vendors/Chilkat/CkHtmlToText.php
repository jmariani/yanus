<?php
class CkHtmlToText {

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
		if (is_resource($res) && get_resource_type($res) === '_p_CkHtmlToText') {
			$this->_cPtr=$res;
			return;
		}
		$this->_cPtr=new_CkHtmlToText();
	}

	function get_Utf8() {
		return CkHtmlToText_get_Utf8($this->_cPtr);
	}

	function put_Utf8($b) {
		CkHtmlToText_put_Utf8($this->_cPtr,$b);
	}

	function IsUnlocked() {
		return CkHtmlToText_IsUnlocked($this->_cPtr);
	}

	function toText($html) {
		return CkHtmlToText_toText($this->_cPtr,$html);
	}

	function UnlockComponent($code) {
		return CkHtmlToText_UnlockComponent($this->_cPtr,$code);
	}

	function WriteStringToFile($str,$filename,$charset) {
		return CkHtmlToText_WriteStringToFile($this->_cPtr,$str,$filename,$charset);
	}

	function readFileToString($filename,$srcCharset) {
		return CkHtmlToText_readFileToString($this->_cPtr,$filename,$srcCharset);
	}

	function get_RightMargin() {
		return CkHtmlToText_get_RightMargin($this->_cPtr);
	}

	function put_RightMargin($newVal) {
		CkHtmlToText_put_RightMargin($this->_cPtr,$newVal);
	}

	function get_SuppressLinks() {
		return CkHtmlToText_get_SuppressLinks($this->_cPtr);
	}

	function put_SuppressLinks($newVal) {
		CkHtmlToText_put_SuppressLinks($this->_cPtr,$newVal);
	}

	function get_DecodeHtmlEntities() {
		return CkHtmlToText_get_DecodeHtmlEntities($this->_cPtr);
	}

	function put_DecodeHtmlEntities($newVal) {
		CkHtmlToText_put_DecodeHtmlEntities($this->_cPtr,$newVal);
	}

	function get_DebugLogFilePath($str) {
		CkHtmlToText_get_DebugLogFilePath($this->_cPtr,$str);
	}

	function debugLogFilePath() {
		return CkHtmlToText_debugLogFilePath($this->_cPtr);
	}

	function put_DebugLogFilePath($newVal) {
		CkHtmlToText_put_DebugLogFilePath($this->_cPtr,$newVal);
	}

	function SaveLastError($filename) {
		return CkHtmlToText_SaveLastError($this->_cPtr,$filename);
	}

	function lastErrorText() {
		return CkHtmlToText_lastErrorText($this->_cPtr);
	}

	function lastErrorXml() {
		return CkHtmlToText_lastErrorXml($this->_cPtr);
	}

	function lastErrorHtml() {
		return CkHtmlToText_lastErrorHtml($this->_cPtr);
	}
}


?>