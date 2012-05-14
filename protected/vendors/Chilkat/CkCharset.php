<?php
class CkCharset {

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
		if (is_resource($res) && get_resource_type($res) === '_p_CkCharset') {
			$this->_cPtr=$res;
			return;
		}
		$this->_cPtr=new_CkCharset();
	}

	function lastErrorText() {
		return CkCharset_lastErrorText($this->_cPtr);
	}

	function lastErrorXml() {
		return CkCharset_lastErrorXml($this->_cPtr);
	}

	function lastErrorHtml() {
		return CkCharset_lastErrorHtml($this->_cPtr);
	}

	function urlDecodeStr($inStr) {
		return CkCharset_urlDecodeStr($this->_cPtr,$inStr);
	}

	function ConvertFileNoPreamble($inFilename,$outFilename) {
		return CkCharset_ConvertFileNoPreamble($this->_cPtr,$inFilename,$outFilename);
	}

	function getHtmlFileCharset($htmlFilename) {
		return CkCharset_getHtmlFileCharset($this->_cPtr,$htmlFilename);
	}

	function getHtmlCharset($htmlData) {
		return CkCharset_getHtmlCharset($this->_cPtr,$htmlData);
	}

	function lastOutputAsQP() {
		return CkCharset_lastOutputAsQP($this->_cPtr);
	}

	function lastInputAsQP() {
		return CkCharset_lastInputAsQP($this->_cPtr);
	}

	function lastOutputAsHex() {
		return CkCharset_lastOutputAsHex($this->_cPtr);
	}

	function lastInputAsHex() {
		return CkCharset_lastInputAsHex($this->_cPtr);
	}

	function htmlDecodeToStr($str) {
		return CkCharset_htmlDecodeToStr($this->_cPtr,$str);
	}

	function toCharset() {
		return CkCharset_toCharset($this->_cPtr);
	}

	function fromCharset() {
		return CkCharset_fromCharset($this->_cPtr);
	}

	function version() {
		return CkCharset_version($this->_cPtr);
	}

	function codePageToCharset($codePage) {
		return CkCharset_codePageToCharset($this->_cPtr,$codePage);
	}

	function altToCharset() {
		return CkCharset_altToCharset($this->_cPtr);
	}

	function upperCase($inStr) {
		return CkCharset_upperCase($this->_cPtr,$inStr);
	}

	function lowerCase($inStr) {
		return CkCharset_lowerCase($this->_cPtr,$inStr);
	}

	function get_Utf8() {
		return CkCharset_get_Utf8($this->_cPtr);
	}

	function put_Utf8($b) {
		CkCharset_put_Utf8($this->_cPtr,$b);
	}

	function ConvertHtmlFile($inFilename,$outFilename) {
		return CkCharset_ConvertHtmlFile($this->_cPtr,$inFilename,$outFilename);
	}

	function ConvertHtml($htmlIn,$htmlOut) {
		return CkCharset_ConvertHtml($this->_cPtr,$htmlIn,$htmlOut);
	}

	function get_LastOutputAsQP($str) {
		CkCharset_get_LastOutputAsQP($this->_cPtr,$str);
	}

	function get_LastInputAsQP($str) {
		CkCharset_get_LastInputAsQP($this->_cPtr,$str);
	}

	function get_LastOutputAsHex($str) {
		CkCharset_get_LastOutputAsHex($this->_cPtr,$str);
	}

	function get_LastInputAsHex($str) {
		CkCharset_get_LastInputAsHex($this->_cPtr,$str);
	}

	function put_SaveLast($value) {
		CkCharset_put_SaveLast($this->_cPtr,$value);
	}

	function get_SaveLast() {
		return CkCharset_get_SaveLast($this->_cPtr);
	}

	function entityEncodeHex($inStr) {
		return CkCharset_entityEncodeHex($this->_cPtr,$inStr);
	}

	function entityEncodeDec($inStr) {
		return CkCharset_entityEncodeDec($this->_cPtr,$inStr);
	}

	function WriteFile($filename,$dataBuf) {
		return CkCharset_WriteFile($this->_cPtr,$filename,$dataBuf);
	}

	function ReadFile($filename,$dataBuf) {
		return CkCharset_ReadFile($this->_cPtr,$filename,$dataBuf);
	}

	function ConvertFromUnicode($uniData,$mbData) {
		return CkCharset_ConvertFromUnicode($this->_cPtr,$uniData,$mbData);
	}

	function ConvertToUnicode($mbData,$uniData) {
		return CkCharset_ConvertToUnicode($this->_cPtr,$mbData,$uniData);
	}

	function VerifyFile($charset,$filename) {
		return CkCharset_VerifyFile($this->_cPtr,$charset,$filename);
	}

	function VerifyData($charset,$charData) {
		return CkCharset_VerifyData($this->_cPtr,$charset,$charData);
	}

	function HtmlEntityDecode($inData,$outData) {
		return CkCharset_HtmlEntityDecode($this->_cPtr,$inData,$outData);
	}

	function HtmlEntityDecodeFile($inFilename,$outFilename) {
		return CkCharset_HtmlEntityDecodeFile($this->_cPtr,$inFilename,$outFilename);
	}

	function ConvertFile($inFilename,$outFilename) {
		return CkCharset_ConvertFile($this->_cPtr,$inFilename,$outFilename);
	}

	function ConvertData($inData,$outData) {
		return CkCharset_ConvertData($this->_cPtr,$inData,$outData);
	}

	function get_ToCharset($str) {
		CkCharset_get_ToCharset($this->_cPtr,$str);
	}

	function put_ToCharset($charset) {
		CkCharset_put_ToCharset($this->_cPtr,$charset);
	}

	function get_FromCharset($str) {
		CkCharset_get_FromCharset($this->_cPtr,$str);
	}

	function put_FromCharset($charset) {
		CkCharset_put_FromCharset($this->_cPtr,$charset);
	}

	function get_Version($str) {
		CkCharset_get_Version($this->_cPtr,$str);
	}

	function UnlockComponent($unlockCode) {
		return CkCharset_UnlockComponent($this->_cPtr,$unlockCode);
	}

	function IsUnlocked() {
		return CkCharset_IsUnlocked($this->_cPtr);
	}

	function SaveLastError($filename) {
		return CkCharset_SaveLastError($this->_cPtr,$filename);
	}

	function CharsetToCodePage($charsetName) {
		return CkCharset_CharsetToCodePage($this->_cPtr,$charsetName);
	}

	function get_ErrorAction() {
		return CkCharset_get_ErrorAction($this->_cPtr);
	}

	function put_ErrorAction($val) {
		CkCharset_put_ErrorAction($this->_cPtr,$val);
	}

	function get_AltToCharset($str) {
		CkCharset_get_AltToCharset($this->_cPtr,$str);
	}

	function put_AltToCharset($charsetName) {
		CkCharset_put_AltToCharset($this->_cPtr,$charsetName);
	}

	function SetErrorString($str) {
		CkCharset_SetErrorString($this->_cPtr,$str);
	}
}


?>