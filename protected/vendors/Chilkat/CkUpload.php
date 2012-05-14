<?php
class CkUpload {

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
		if (is_resource($res) && get_resource_type($res) === '_p_CkUpload') {
			$this->_cPtr=$res;
			return;
		}
		$this->_cPtr=new_CkUpload();
	}

	function get_Utf8() {
		return CkUpload_get_Utf8($this->_cPtr);
	}

	function put_Utf8($b) {
		CkUpload_put_Utf8($this->_cPtr,$b);
	}

	function get_Ssl() {
		return CkUpload_get_Ssl($this->_cPtr);
	}

	function put_Ssl($newVal) {
		CkUpload_put_Ssl($this->_cPtr,$newVal);
	}

	function ClearFileReferences() {
		CkUpload_ClearFileReferences($this->_cPtr);
	}

	function ClearParams() {
		CkUpload_ClearParams($this->_cPtr);
	}

	function get_DebugLogFilePath($str) {
		CkUpload_get_DebugLogFilePath($this->_cPtr,$str);
	}

	function debugLogFilePath() {
		return CkUpload_debugLogFilePath($this->_cPtr);
	}

	function put_DebugLogFilePath($newVal) {
		CkUpload_put_DebugLogFilePath($this->_cPtr,$newVal);
	}

	function SaveLastError($filename) {
		return CkUpload_SaveLastError($this->_cPtr,$filename);
	}

	function get_Version($str) {
		CkUpload_get_Version($this->_cPtr,$str);
	}

	function SleepMs($millisec) {
		CkUpload_SleepMs($this->_cPtr,$millisec);
	}

	function get_ChunkSize() {
		return CkUpload_get_ChunkSize($this->_cPtr);
	}

	function put_ChunkSize($numBytes) {
		CkUpload_put_ChunkSize($this->_cPtr,$numBytes);
	}

	function get_IdleTimeoutMs() {
		return CkUpload_get_IdleTimeoutMs($this->_cPtr);
	}

	function put_IdleTimeoutMs($millisec) {
		CkUpload_put_IdleTimeoutMs($this->_cPtr,$millisec);
	}

	function get_UploadInProgress() {
		return CkUpload_get_UploadInProgress($this->_cPtr);
	}

	function get_UploadSuccess() {
		return CkUpload_get_UploadSuccess($this->_cPtr);
	}

	function get_Login($str) {
		CkUpload_get_Login($this->_cPtr,$str);
	}

	function put_Login($newVal) {
		CkUpload_put_Login($this->_cPtr,$newVal);
	}

	function get_Password($str) {
		CkUpload_get_Password($this->_cPtr,$str);
	}

	function put_Password($newVal) {
		CkUpload_put_Password($this->_cPtr,$newVal);
	}

	function login() {
		return CkUpload_login($this->_cPtr);
	}

	function password() {
		return CkUpload_password($this->_cPtr);
	}

	function get_ProxyPort() {
		return CkUpload_get_ProxyPort($this->_cPtr);
	}

	function put_ProxyPort($n) {
		CkUpload_put_ProxyPort($this->_cPtr,$n);
	}

	function put_ProxyDomain($v) {
		CkUpload_put_ProxyDomain($this->_cPtr,$v);
	}

	function get_ProxyDomain($str) {
		CkUpload_get_ProxyDomain($this->_cPtr,$str);
	}

	function get_ProxyLogin($str) {
		CkUpload_get_ProxyLogin($this->_cPtr,$str);
	}

	function put_ProxyLogin($newVal) {
		CkUpload_put_ProxyLogin($this->_cPtr,$newVal);
	}

	function get_ProxyPassword($str) {
		CkUpload_get_ProxyPassword($this->_cPtr,$str);
	}

	function put_ProxyPassword($newVal) {
		CkUpload_put_ProxyPassword($this->_cPtr,$newVal);
	}

	function proxyLogin() {
		return CkUpload_proxyLogin($this->_cPtr);
	}

	function proxyPassword() {
		return CkUpload_proxyPassword($this->_cPtr);
	}

	function proxyDomain() {
		return CkUpload_proxyDomain($this->_cPtr);
	}

	function AddCustomHeader($name,$value) {
		CkUpload_AddCustomHeader($this->_cPtr,$name,$value);
	}

	function AddParam($name,$value) {
		CkUpload_AddParam($this->_cPtr,$name,$value);
	}

	function AddFileReference($name,$filename) {
		CkUpload_AddFileReference($this->_cPtr,$name,$filename);
	}

	function get_Port() {
		return CkUpload_get_Port($this->_cPtr);
	}

	function put_Port($port) {
		CkUpload_put_Port($this->_cPtr,$port);
	}

	function get_Hostname($hostname) {
		CkUpload_get_Hostname($this->_cPtr,$hostname);
	}

	function put_Hostname($hostname) {
		CkUpload_put_Hostname($this->_cPtr,$hostname);
	}

	function get_Path($path) {
		CkUpload_get_Path($this->_cPtr,$path);
	}

	function put_Path($path) {
		CkUpload_put_Path($this->_cPtr,$path);
	}

	function get_TotalUploadSize() {
		return CkUpload_get_TotalUploadSize($this->_cPtr);
	}

	function get_NumBytesSent() {
		return CkUpload_get_NumBytesSent($this->_cPtr);
	}

	function get_PercentUploaded() {
		return CkUpload_get_PercentUploaded($this->_cPtr);
	}

	function get_ResponseStatus() {
		return CkUpload_get_ResponseStatus($this->_cPtr);
	}

	function get_ResponseHeader($header) {
		CkUpload_get_ResponseHeader($this->_cPtr,$header);
	}

	function get_ResponseBody($body) {
		CkUpload_get_ResponseBody($this->_cPtr,$body);
	}

	function BlockingUpload() {
		return CkUpload_BlockingUpload($this->_cPtr);
	}

	function BeginUpload() {
		return CkUpload_BeginUpload($this->_cPtr);
	}

	function AbortUpload() {
		CkUpload_AbortUpload($this->_cPtr);
	}

	function UploadToMemory($dataBuf) {
		return CkUpload_UploadToMemory($this->_cPtr,$dataBuf);
	}

	function lastErrorText() {
		return CkUpload_lastErrorText($this->_cPtr);
	}

	function lastErrorXml() {
		return CkUpload_lastErrorXml($this->_cPtr);
	}

	function lastErrorHtml() {
		return CkUpload_lastErrorHtml($this->_cPtr);
	}

	function hostname() {
		return CkUpload_hostname($this->_cPtr);
	}

	function path() {
		return CkUpload_path($this->_cPtr);
	}

	function responseHeader() {
		return CkUpload_responseHeader($this->_cPtr);
	}

	function version() {
		return CkUpload_version($this->_cPtr);
	}
}


?>