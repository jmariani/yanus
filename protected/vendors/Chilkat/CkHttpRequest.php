<?php
class CkHttpRequest {

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
		if (is_resource($res) && get_resource_type($res) === '_p_CkHttpRequest') {
			$this->_cPtr=$res;
			return;
		}
		$this->_cPtr=new_CkHttpRequest();
	}

	function RemoveAllParams() {
		CkHttpRequest_RemoveAllParams($this->_cPtr);
	}

	function LoadBodyFromFile($filename) {
		return CkHttpRequest_LoadBodyFromFile($this->_cPtr,$filename);
	}

	function LoadBodyFromBytes($binaryData) {
		return CkHttpRequest_LoadBodyFromBytes($this->_cPtr,$binaryData);
	}

	function LoadBodyFromString($bodyStr,$charset) {
		return CkHttpRequest_LoadBodyFromString($this->_cPtr,$bodyStr,$charset);
	}

	function UsePut() {
		CkHttpRequest_UsePut($this->_cPtr);
	}

	function AddBytesForUpload($name,$filename,$byteData) {
		return CkHttpRequest_AddBytesForUpload($this->_cPtr,$name,$filename,$byteData);
	}

	function UsePostMultipartForm() {
		CkHttpRequest_UsePostMultipartForm($this->_cPtr);
	}

	function getUrlEncodedParams() {
		return CkHttpRequest_getUrlEncodedParams($this->_cPtr);
	}

	function AddStringForUpload($name,$filename,$strData,$charset) {
		return CkHttpRequest_AddStringForUpload($this->_cPtr,$name,$filename,$strData,$charset);
	}

	function AddFileForUpload2($name,$filename,$contentType) {
		return CkHttpRequest_AddFileForUpload2($this->_cPtr,$name,$filename,$contentType);
	}

	function AddStringForUpload2($name,$filename,$strData,$charset,$contentType) {
		return CkHttpRequest_AddStringForUpload2($this->_cPtr,$name,$filename,$strData,$charset,$contentType);
	}

	function AddBytesForUpload2($name,$filename,$byteData,$contentType) {
		return CkHttpRequest_AddBytesForUpload2($this->_cPtr,$name,$filename,$byteData,$contentType);
	}

	function UseUploadPut() {
		CkHttpRequest_UseUploadPut($this->_cPtr);
	}

	function get_HttpVerb($str) {
		CkHttpRequest_get_HttpVerb($this->_cPtr,$str);
	}

	function httpVerb() {
		return CkHttpRequest_httpVerb($this->_cPtr);
	}

	function put_HttpVerb($newVal) {
		CkHttpRequest_put_HttpVerb($this->_cPtr,$newVal);
	}

	function get_ContentType($str) {
		CkHttpRequest_get_ContentType($this->_cPtr,$str);
	}

	function contentType() {
		return CkHttpRequest_contentType($this->_cPtr);
	}

	function put_ContentType($newVal) {
		CkHttpRequest_put_ContentType($this->_cPtr,$newVal);
	}

	function get_EntireHeader($str) {
		CkHttpRequest_get_EntireHeader($this->_cPtr,$str);
	}

	function entireHeader() {
		return CkHttpRequest_entireHeader($this->_cPtr);
	}

	function put_EntireHeader($newVal) {
		CkHttpRequest_put_EntireHeader($this->_cPtr,$newVal);
	}

	function StreamBodyFromFile($filename) {
		return CkHttpRequest_StreamBodyFromFile($this->_cPtr,$filename);
	}

	function path() {
		return CkHttpRequest_path($this->_cPtr);
	}

	function charset() {
		return CkHttpRequest_charset($this->_cPtr);
	}

	function httpVersion() {
		return CkHttpRequest_httpVersion($this->_cPtr);
	}

	function getHeaderField($name) {
		return CkHttpRequest_getHeaderField($this->_cPtr,$name);
	}

	function getHeaderName($index) {
		return CkHttpRequest_getHeaderName($this->_cPtr,$index);
	}

	function getHeaderValue($index) {
		return CkHttpRequest_getHeaderValue($this->_cPtr,$index);
	}

	function getParam($name) {
		return CkHttpRequest_getParam($this->_cPtr,$name);
	}

	function getParamName($index) {
		return CkHttpRequest_getParamName($this->_cPtr,$index);
	}

	function getParamValue($index) {
		return CkHttpRequest_getParamValue($this->_cPtr,$index);
	}

	function lastErrorText() {
		return CkHttpRequest_lastErrorText($this->_cPtr);
	}

	function lastErrorXml() {
		return CkHttpRequest_lastErrorXml($this->_cPtr);
	}

	function lastErrorHtml() {
		return CkHttpRequest_lastErrorHtml($this->_cPtr);
	}

	function RemoveParam($name) {
		CkHttpRequest_RemoveParam($this->_cPtr,$name);
	}

	function SaveLastError($filename) {
		return CkHttpRequest_SaveLastError($this->_cPtr,$filename);
	}

	function get_Utf8() {
		return CkHttpRequest_get_Utf8($this->_cPtr);
	}

	function put_Utf8($b) {
		CkHttpRequest_put_Utf8($this->_cPtr,$b);
	}

	function UsePost() {
		CkHttpRequest_UsePost($this->_cPtr);
	}

	function UseGet() {
		CkHttpRequest_UseGet($this->_cPtr);
	}

	function UseHead() {
		CkHttpRequest_UseHead($this->_cPtr);
	}

	function UseXmlHttp($xmlBody) {
		CkHttpRequest_UseXmlHttp($this->_cPtr,$xmlBody);
	}

	function UseUpload() {
		CkHttpRequest_UseUpload($this->_cPtr);
	}

	function SetFromUrl($url) {
		CkHttpRequest_SetFromUrl($this->_cPtr,$url);
	}

	function put_Path($path) {
		CkHttpRequest_put_Path($this->_cPtr,$path);
	}

	function get_Path($str) {
		CkHttpRequest_get_Path($this->_cPtr,$str);
	}

	function put_Charset($charset) {
		CkHttpRequest_put_Charset($this->_cPtr,$charset);
	}

	function get_Charset($str) {
		CkHttpRequest_get_Charset($this->_cPtr,$str);
	}

	function put_SendCharset($val) {
		CkHttpRequest_put_SendCharset($this->_cPtr,$val);
	}

	function get_SendCharset() {
		return CkHttpRequest_get_SendCharset($this->_cPtr);
	}

	function put_HttpVersion($version) {
		CkHttpRequest_put_HttpVersion($this->_cPtr,$version);
	}

	function get_HttpVersion($str) {
		CkHttpRequest_get_HttpVersion($this->_cPtr,$str);
	}

	function AddHeader($name,$value) {
		CkHttpRequest_AddHeader($this->_cPtr,$name,$value);
	}

	function AddParam($name,$value) {
		CkHttpRequest_AddParam($this->_cPtr,$name,$value);
	}

	function AddFileForUpload($name,$filename) {
		return CkHttpRequest_AddFileForUpload($this->_cPtr,$name,$filename);
	}

	function generateRequestText() {
		return CkHttpRequest_generateRequestText($this->_cPtr);
	}

	function get_NumHeaderFields() {
		return CkHttpRequest_get_NumHeaderFields($this->_cPtr);
	}

	function get_NumParams() {
		return CkHttpRequest_get_NumParams($this->_cPtr);
	}
}


?>