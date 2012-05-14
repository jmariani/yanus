<?php
class CkSshTunnel {

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
		if (is_resource($res) && get_resource_type($res) === '_p_CkSshTunnel') {
			$this->_cPtr=$res;
			return;
		}
		$this->_cPtr=new_CkSshTunnel();
	}

	function get_Utf8() {
		return CkSshTunnel_get_Utf8($this->_cPtr);
	}

	function put_Utf8($b) {
		CkSshTunnel_put_Utf8($this->_cPtr,$b);
	}

	function SaveLastError($filename) {
		return CkSshTunnel_SaveLastError($this->_cPtr,$filename);
	}

	function lastErrorText() {
		return CkSshTunnel_lastErrorText($this->_cPtr);
	}

	function lastErrorXml() {
		return CkSshTunnel_lastErrorXml($this->_cPtr);
	}

	function lastErrorHtml() {
		return CkSshTunnel_lastErrorHtml($this->_cPtr);
	}

	function UnlockComponent($unlockCode) {
		return CkSshTunnel_UnlockComponent($this->_cPtr,$unlockCode);
	}

	function get_SshLogin($str) {
		CkSshTunnel_get_SshLogin($this->_cPtr,$str);
	}

	function sshLogin() {
		return CkSshTunnel_sshLogin($this->_cPtr);
	}

	function put_SshLogin($newVal) {
		CkSshTunnel_put_SshLogin($this->_cPtr,$newVal);
	}

	function get_SshPassword($str) {
		CkSshTunnel_get_SshPassword($this->_cPtr,$str);
	}

	function sshPassword() {
		return CkSshTunnel_sshPassword($this->_cPtr);
	}

	function put_SshPassword($newVal) {
		CkSshTunnel_put_SshPassword($this->_cPtr,$newVal);
	}

	function get_ConnectLog($str) {
		CkSshTunnel_get_ConnectLog($this->_cPtr,$str);
	}

	function connectLog() {
		return CkSshTunnel_connectLog($this->_cPtr);
	}

	function put_ConnectLog($newVal) {
		CkSshTunnel_put_ConnectLog($this->_cPtr,$newVal);
	}

	function get_DestHostname($str) {
		CkSshTunnel_get_DestHostname($this->_cPtr,$str);
	}

	function destHostname() {
		return CkSshTunnel_destHostname($this->_cPtr);
	}

	function put_DestHostname($newVal) {
		CkSshTunnel_put_DestHostname($this->_cPtr,$newVal);
	}

	function get_SshHostname($str) {
		CkSshTunnel_get_SshHostname($this->_cPtr,$str);
	}

	function sshHostname() {
		return CkSshTunnel_sshHostname($this->_cPtr);
	}

	function put_SshHostname($newVal) {
		CkSshTunnel_put_SshHostname($this->_cPtr,$newVal);
	}

	function get_SshPort() {
		return CkSshTunnel_get_SshPort($this->_cPtr);
	}

	function put_SshPort($newVal) {
		CkSshTunnel_put_SshPort($this->_cPtr,$newVal);
	}

	function get_DestPort() {
		return CkSshTunnel_get_DestPort($this->_cPtr);
	}

	function put_DestPort($newVal) {
		CkSshTunnel_put_DestPort($this->_cPtr,$newVal);
	}

	function get_IsAccepting() {
		return CkSshTunnel_get_IsAccepting($this->_cPtr);
	}

	function StopAllTunnels($maxWaitMs) {
		return CkSshTunnel_StopAllTunnels($this->_cPtr,$maxWaitMs);
	}

	function getTunnelsXml() {
		return CkSshTunnel_getTunnelsXml($this->_cPtr);
	}

	function StopAccepting() {
		return CkSshTunnel_StopAccepting($this->_cPtr);
	}

	function BeginAccepting($listenPort) {
		return CkSshTunnel_BeginAccepting($this->_cPtr,$listenPort);
	}

	function SetSshAuthenticationKey($key) {
		return CkSshTunnel_SetSshAuthenticationKey($this->_cPtr,$key);
	}

	function get_ListenBindIpAddress($str) {
		CkSshTunnel_get_ListenBindIpAddress($this->_cPtr,$str);
	}

	function listenBindIpAddress() {
		return CkSshTunnel_listenBindIpAddress($this->_cPtr);
	}

	function put_ListenBindIpAddress($newVal) {
		CkSshTunnel_put_ListenBindIpAddress($this->_cPtr,$newVal);
	}

	function get_OutboundBindIpAddress($str) {
		CkSshTunnel_get_OutboundBindIpAddress($this->_cPtr,$str);
	}

	function outboundBindIpAddress() {
		return CkSshTunnel_outboundBindIpAddress($this->_cPtr);
	}

	function put_OutboundBindIpAddress($newVal) {
		CkSshTunnel_put_OutboundBindIpAddress($this->_cPtr,$newVal);
	}

	function get_OutboundBindPort() {
		return CkSshTunnel_get_OutboundBindPort($this->_cPtr);
	}

	function put_OutboundBindPort($newVal) {
		CkSshTunnel_put_OutboundBindPort($this->_cPtr,$newVal);
	}

	function get_MaxPacketSize() {
		return CkSshTunnel_get_MaxPacketSize($this->_cPtr);
	}

	function put_MaxPacketSize($newVal) {
		CkSshTunnel_put_MaxPacketSize($this->_cPtr,$newVal);
	}

	function get_TcpNoDelay() {
		return CkSshTunnel_get_TcpNoDelay($this->_cPtr);
	}

	function put_TcpNoDelay($newVal) {
		CkSshTunnel_put_TcpNoDelay($this->_cPtr,$newVal);
	}

	function get_HttpProxyHostname($str) {
		CkSshTunnel_get_HttpProxyHostname($this->_cPtr,$str);
	}

	function httpProxyHostname() {
		return CkSshTunnel_httpProxyHostname($this->_cPtr);
	}

	function put_HttpProxyHostname($newVal) {
		CkSshTunnel_put_HttpProxyHostname($this->_cPtr,$newVal);
	}

	function get_HttpProxyUsername($str) {
		CkSshTunnel_get_HttpProxyUsername($this->_cPtr,$str);
	}

	function httpProxyUsername() {
		return CkSshTunnel_httpProxyUsername($this->_cPtr);
	}

	function put_HttpProxyUsername($newVal) {
		CkSshTunnel_put_HttpProxyUsername($this->_cPtr,$newVal);
	}

	function get_HttpProxyPassword($str) {
		CkSshTunnel_get_HttpProxyPassword($this->_cPtr,$str);
	}

	function httpProxyPassword() {
		return CkSshTunnel_httpProxyPassword($this->_cPtr);
	}

	function put_HttpProxyPassword($newVal) {
		CkSshTunnel_put_HttpProxyPassword($this->_cPtr,$newVal);
	}

	function get_HttpProxyAuthMethod($str) {
		CkSshTunnel_get_HttpProxyAuthMethod($this->_cPtr,$str);
	}

	function httpProxyAuthMethod() {
		return CkSshTunnel_httpProxyAuthMethod($this->_cPtr);
	}

	function put_HttpProxyAuthMethod($newVal) {
		CkSshTunnel_put_HttpProxyAuthMethod($this->_cPtr,$newVal);
	}

	function get_HttpProxyPort() {
		return CkSshTunnel_get_HttpProxyPort($this->_cPtr);
	}

	function put_HttpProxyPort($newVal) {
		CkSshTunnel_put_HttpProxyPort($this->_cPtr,$newVal);
	}

	function get_SocksPort() {
		return CkSshTunnel_get_SocksPort($this->_cPtr);
	}

	function put_SocksPort($newVal) {
		CkSshTunnel_put_SocksPort($this->_cPtr,$newVal);
	}

	function get_SocksHostname($str) {
		CkSshTunnel_get_SocksHostname($this->_cPtr,$str);
	}

	function socksHostname() {
		return CkSshTunnel_socksHostname($this->_cPtr);
	}

	function put_SocksHostname($newVal) {
		CkSshTunnel_put_SocksHostname($this->_cPtr,$newVal);
	}

	function get_SocksUsername($str) {
		CkSshTunnel_get_SocksUsername($this->_cPtr,$str);
	}

	function socksUsername() {
		return CkSshTunnel_socksUsername($this->_cPtr);
	}

	function put_SocksUsername($newVal) {
		CkSshTunnel_put_SocksUsername($this->_cPtr,$newVal);
	}

	function get_SocksPassword($str) {
		CkSshTunnel_get_SocksPassword($this->_cPtr,$str);
	}

	function socksPassword() {
		return CkSshTunnel_socksPassword($this->_cPtr);
	}

	function put_SocksPassword($newVal) {
		CkSshTunnel_put_SocksPassword($this->_cPtr,$newVal);
	}

	function get_SocksVersion() {
		return CkSshTunnel_get_SocksVersion($this->_cPtr);
	}

	function put_SocksVersion($newVal) {
		CkSshTunnel_put_SocksVersion($this->_cPtr,$newVal);
	}

	function get_ConnectTimeoutMs() {
		return CkSshTunnel_get_ConnectTimeoutMs($this->_cPtr);
	}

	function put_ConnectTimeoutMs($newVal) {
		CkSshTunnel_put_ConnectTimeoutMs($this->_cPtr,$newVal);
	}

	function get_ListenPort() {
		return CkSshTunnel_get_ListenPort($this->_cPtr);
	}

	function get_TunnelThreadSessionLogPath($str) {
		CkSshTunnel_get_TunnelThreadSessionLogPath($this->_cPtr,$str);
	}

	function tunnelThreadSessionLogPath() {
		return CkSshTunnel_tunnelThreadSessionLogPath($this->_cPtr);
	}

	function put_TunnelThreadSessionLogPath($newVal) {
		CkSshTunnel_put_TunnelThreadSessionLogPath($this->_cPtr,$newVal);
	}

	function get_AcceptThreadSessionLogPath($str) {
		CkSshTunnel_get_AcceptThreadSessionLogPath($this->_cPtr,$str);
	}

	function acceptThreadSessionLogPath() {
		return CkSshTunnel_acceptThreadSessionLogPath($this->_cPtr);
	}

	function put_AcceptThreadSessionLogPath($newVal) {
		CkSshTunnel_put_AcceptThreadSessionLogPath($this->_cPtr,$newVal);
	}

	function ClearTunnelErrors() {
		CkSshTunnel_ClearTunnelErrors($this->_cPtr);
	}

	function get_TunnelErrors($str) {
		CkSshTunnel_get_TunnelErrors($this->_cPtr,$str);
	}

	function tunnelErrors() {
		return CkSshTunnel_tunnelErrors($this->_cPtr);
	}
}


?>