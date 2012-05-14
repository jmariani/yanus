<?php
class CkHtmlToXml {

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
		if (is_resource($res) && get_resource_type($res) === '_p_CkHtmlToXml') {
			$this->_cPtr=$res;
			return;
		}
		$this->_cPtr=new_CkHtmlToXml();
	}

	function get_Utf8() {
		return CkHtmlToXml_get_Utf8($this->_cPtr);
	}

	function put_Utf8($b) {
		CkHtmlToXml_put_Utf8($this->_cPtr,$b);
	}

	function SetHtmlBytes($inData) {
		CkHtmlToXml_SetHtmlBytes($this->_cPtr,$inData);
	}

	function UnlockComponent($code) {
		return CkHtmlToXml_UnlockComponent($this->_cPtr,$code);
	}

	function IsUnlocked() {
		return CkHtmlToXml_IsUnlocked($this->_cPtr);
	}

	function SaveLastError($filename) {
		return CkHtmlToXml_SaveLastError($this->_cPtr,$filename);
	}

	function get_Version($str) {
		CkHtmlToXml_get_Version($this->_cPtr,$str);
	}

	function put_Nbsp($v) {
		CkHtmlToXml_put_Nbsp($this->_cPtr,$v);
	}

	function get_Nbsp() {
		return CkHtmlToXml_get_Nbsp($this->_cPtr);
	}

	function put_Html($html) {
		CkHtmlToXml_put_Html($this->_cPtr,$html);
	}

	function get_Html($str) {
		CkHtmlToXml_get_Html($this->_cPtr,$str);
	}

	function put_XmlCharset($html) {
		CkHtmlToXml_put_XmlCharset($this->_cPtr,$html);
	}

	function get_XmlCharset($str) {
		CkHtmlToXml_get_XmlCharset($this->_cPtr,$str);
	}

	function SetHtmlFromFile($filename) {
		return CkHtmlToXml_SetHtmlFromFile($this->_cPtr,$filename);
	}

	function WriteStringToFile($str,$filename,$charset) {
		return CkHtmlToXml_WriteStringToFile($this->_cPtr,$str,$filename,$charset);
	}

	function ConvertFile($inHtmlFilename,$outXmlFilename) {
		return CkHtmlToXml_ConvertFile($this->_cPtr,$inHtmlFilename,$outXmlFilename);
	}

	function DropTagType($tagName) {
		CkHtmlToXml_DropTagType($this->_cPtr,$tagName);
	}

	function UndropTagType($tagName) {
		CkHtmlToXml_UndropTagType($this->_cPtr,$tagName);
	}

	function DropTextFormattingTags() {
		CkHtmlToXml_DropTextFormattingTags($this->_cPtr);
	}

	function UndropTextFormattingTags() {
		CkHtmlToXml_UndropTextFormattingTags($this->_cPtr);
	}

	function put_DropCustomTags($v) {
		CkHtmlToXml_put_DropCustomTags($this->_cPtr,$v);
	}

	function get_DropCustomTags() {
		return CkHtmlToXml_get_DropCustomTags($this->_cPtr);
	}

	function lastErrorText() {
		return CkHtmlToXml_lastErrorText($this->_cPtr);
	}

	function lastErrorXml() {
		return CkHtmlToXml_lastErrorXml($this->_cPtr);
	}

	function lastErrorHtml() {
		return CkHtmlToXml_lastErrorHtml($this->_cPtr);
	}

	function html() {
		return CkHtmlToXml_html($this->_cPtr);
	}

	function xmlCharset() {
		return CkHtmlToXml_xmlCharset($this->_cPtr);
	}

	function xml() {
		return CkHtmlToXml_xml($this->_cPtr);
	}

	function version() {
		return CkHtmlToXml_version($this->_cPtr);
	}

	function toXml() {
		return CkHtmlToXml_toXml($this->_cPtr);
	}

	function readFileToString($filename,$srcCharset) {
		return CkHtmlToXml_readFileToString($this->_cPtr,$filename,$srcCharset);
	}
}


?>