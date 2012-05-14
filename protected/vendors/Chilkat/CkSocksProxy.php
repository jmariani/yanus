<?php
class CkSocksProxy {

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
		if (is_resource($res) && get_resource_type($res) === '_p_CkSocksProxy') {
			$this->_cPtr=$res;
			return;
		}
		$this->_cPtr=new_CkSocksProxy();
	}

	function get_Utf8() {
		return CkSocksProxy_get_Utf8($this->_cPtr);
	}

	function put_Utf8($b) {
		CkSocksProxy_put_Utf8($this->_cPtr,$b);
	}

	function SaveLastError($filename) {
		return CkSocksProxy_SaveLastError($this->_cPtr,$filename);
	}

	function lastErrorText() {
		return CkSocksProxy_lastErrorText($this->_cPtr);
	}

	function lastErrorXml() {
		return CkSocksProxy_lastErrorXml($this->_cPtr);
	}

	function lastErrorHtml() {
		return CkSocksProxy_lastErrorHtml($this->_cPtr);
	}

	function UnlockComponent($unlockCode) {
		return CkSocksProxy_UnlockComponent($this->_cPtr,$unlockCode);
	}

	function get_SocksVersion() {
		return CkSocksProxy_get_SocksVersion($this->_cPtr);
	}

	function get_AuthenticatedSocks5() {
		return CkSocksProxy_get_AuthenticatedSocks5($this->_cPtr);
	}

	function get_ConnectionPending() {
		return CkSocksProxy_get_ConnectionPending($this->_cPtr);
	}

	function get_ClientPort() {
		return CkSocksProxy_get_ClientPort($this->_cPtr);
	}

	function get_ServerPort() {
		return CkSocksProxy_get_ServerPort($this->_cPtr);
	}

	function get_ClientIp($str) {
		CkSocksProxy_get_ClientIp($this->_cPtr,$str);
	}

	function clientIp() {
		return CkSocksProxy_clientIp($this->_cPtr);
	}

	function get_ServerIp($str) {
		CkSocksProxy_get_ServerIp($this->_cPtr,$str);
	}

	function serverIp() {
		return CkSocksProxy_serverIp($this->_cPtr);
	}

	function get_Login($str) {
		CkSocksProxy_get_Login($this->_cPtr,$str);
	}

	function login() {
		return CkSocksProxy_login($this->_cPtr);
	}

	function get_Password($str) {
		CkSocksProxy_get_Password($this->_cPtr,$str);
	}

	function password() {
		return CkSocksProxy_password($this->_cPtr);
	}

	function Initialize($port) {
		return CkSocksProxy_Initialize($this->_cPtr,$port);
	}

	function WaitForConnection($maxWaitMs) {
		return CkSocksProxy_WaitForConnection($this->_cPtr,$maxWaitMs);
	}

	function AllowConnection() {
		return CkSocksProxy_AllowConnection($this->_cPtr);
	}

	function ProceedSocks5() {
		return CkSocksProxy_ProceedSocks5($this->_cPtr);
	}

	function RejectConnection() {
		return CkSocksProxy_RejectConnection($this->_cPtr);
	}

	function get_AllowUnauthenticatedSocks5() {
		return CkSocksProxy_get_AllowUnauthenticatedSocks5($this->_cPtr);
	}

	function put_AllowUnauthenticatedSocks5($newVal) {
		CkSocksProxy_put_AllowUnauthenticatedSocks5($this->_cPtr,$newVal);
	}

	function get_ListenBindIpAddress($str) {
		CkSocksProxy_get_ListenBindIpAddress($this->_cPtr,$str);
	}

	function listenBindIpAddress() {
		return CkSocksProxy_listenBindIpAddress($this->_cPtr);
	}

	function put_ListenBindIpAddress($newVal) {
		CkSocksProxy_put_ListenBindIpAddress($this->_cPtr,$newVal);
	}

	function get_OutboundBindIpAddress($str) {
		CkSocksProxy_get_OutboundBindIpAddress($this->_cPtr,$str);
	}

	function outboundBindIpAddress() {
		return CkSocksProxy_outboundBindIpAddress($this->_cPtr);
	}

	function put_OutboundBindIpAddress($newVal) {
		CkSocksProxy_put_OutboundBindIpAddress($this->_cPtr,$newVal);
	}

	function get_OutboundBindPort() {
		return CkSocksProxy_get_OutboundBindPort($this->_cPtr);
	}

	function put_OutboundBindPort($newVal) {
		CkSocksProxy_put_OutboundBindPort($this->_cPtr,$newVal);
	}

	function getTunnelsXml() {
		return CkSocksProxy_getTunnelsXml($this->_cPtr);
	}

	function StopAllTunnels($maxWaitMs) {
		return CkSocksProxy_StopAllTunnels($this->_cPtr,$maxWaitMs);
	}
}


?>