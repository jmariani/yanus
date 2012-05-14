<?php
class CkHttpResponse {

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
		if (is_resource($res) && get_resource_type($res) === '_p_CkHttpResponse') {
			$this->_cPtr=$res;
			return;
		}
		$this->_cPtr=new_CkHttpResponse();
	}

	function get_Utf8() {
		return CkHttpResponse_get_Utf8($this->_cPtr);
	}

	function put_Utf8($b) {
		CkHttpResponse_put_Utf8($this->_cPtr,$b);
	}

	function SaveBodyBinary($path) {
		return CkHttpResponse_SaveBodyBinary($this->_cPtr,$path);
	}

	function SaveBodyText($bCrlf,$path) {
		return CkHttpResponse_SaveBodyText($this->_cPtr,$bCrlf,$path);
	}

	function header() {
		return CkHttpResponse_header($this->_cPtr);
	}

	function bodyStr() {
		return CkHttpResponse_bodyStr($this->_cPtr);
	}

	function statusLine() {
		return CkHttpResponse_statusLine($this->_cPtr);
	}

	function charset() {
		return CkHttpResponse_charset($this->_cPtr);
	}

	function domain() {
		return CkHttpResponse_domain($this->_cPtr);
	}

	function getHeaderField($fieldName) {
		return CkHttpResponse_getHeaderField($this->_cPtr,$fieldName);
	}

	function getHeaderFieldAttr($fieldName,$attrName) {
		return CkHttpResponse_getHeaderFieldAttr($this->_cPtr,$fieldName,$attrName);
	}

	function getHeaderName($index) {
		return CkHttpResponse_getHeaderName($this->_cPtr,$index);
	}

	function getHeaderValue($index) {
		return CkHttpResponse_getHeaderValue($this->_cPtr,$index);
	}

	function getCookieDomain($index) {
		return CkHttpResponse_getCookieDomain($this->_cPtr,$index);
	}

	function getCookiePath($index) {
		return CkHttpResponse_getCookiePath($this->_cPtr,$index);
	}

	function getCookieExpiresStr($index) {
		return CkHttpResponse_getCookieExpiresStr($this->_cPtr,$index);
	}

	function getCookieName($index) {
		return CkHttpResponse_getCookieName($this->_cPtr,$index);
	}

	function getCookieValue($index) {
		return CkHttpResponse_getCookieValue($this->_cPtr,$index);
	}

	function get_Header($str) {
		CkHttpResponse_get_Header($this->_cPtr,$str);
	}

	function get_Body($data) {
		CkHttpResponse_get_Body($this->_cPtr,$data);
	}

	function get_BodyStr($str) {
		CkHttpResponse_get_BodyStr($this->_cPtr,$str);
	}

	function get_BodyQP($str) {
		CkHttpResponse_get_BodyQP($this->_cPtr,$str);
	}

	function get_StatusLine($str) {
		CkHttpResponse_get_StatusLine($this->_cPtr,$str);
	}

	function get_StatusCode() {
		return CkHttpResponse_get_StatusCode($this->_cPtr);
	}

	function get_Charset($str) {
		CkHttpResponse_get_Charset($this->_cPtr,$str);
	}

	function get_Domain($str) {
		CkHttpResponse_get_Domain($this->_cPtr,$str);
	}

	function get_ContentLength() {
		return CkHttpResponse_get_ContentLength($this->_cPtr);
	}

	function get_Date($sysTime) {
		CkHttpResponse_get_Date($this->_cPtr,$sysTime);
	}

	function get_NumHeaderFields() {
		return CkHttpResponse_get_NumHeaderFields($this->_cPtr);
	}

	function get_NumCookies() {
		return CkHttpResponse_get_NumCookies($this->_cPtr);
	}

	function GetCookieExpires($index,$sysTime) {
		return CkHttpResponse_GetCookieExpires($this->_cPtr,$index,$sysTime);
	}
}


?>