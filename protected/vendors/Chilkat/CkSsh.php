<?php
class CkSsh {

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
		if (is_resource($res) && get_resource_type($res) === '_p_CkSsh') {
			$this->_cPtr=$res;
			return;
		}
		$this->_cPtr=new_CkSsh();
	}

	function get_Utf8() {
		return CkSsh_get_Utf8($this->_cPtr);
	}

	function put_Utf8($b) {
		CkSsh_put_Utf8($this->_cPtr,$b);
	}

	function Connect($hostname,$port) {
		return CkSsh_Connect($this->_cPtr,$hostname,$port);
	}

	function UnlockComponent($unlockCode) {
		return CkSsh_UnlockComponent($this->_cPtr,$unlockCode);
	}

	function AuthenticatePw($login,$password) {
		return CkSsh_AuthenticatePw($this->_cPtr,$login,$password);
	}

	function get_Version($str) {
		CkSsh_get_Version($this->_cPtr,$str);
	}

	function version() {
		return CkSsh_version($this->_cPtr);
	}

	function get_KeepSessionLog() {
		return CkSsh_get_KeepSessionLog($this->_cPtr);
	}

	function put_KeepSessionLog($newVal) {
		CkSsh_put_KeepSessionLog($this->_cPtr,$newVal);
	}

	function get_SessionLog($str) {
		CkSsh_get_SessionLog($this->_cPtr,$str);
	}

	function sessionLog() {
		return CkSsh_sessionLog($this->_cPtr);
	}

	function get_IdleTimeoutMs() {
		return CkSsh_get_IdleTimeoutMs($this->_cPtr);
	}

	function put_IdleTimeoutMs($newVal) {
		CkSsh_put_IdleTimeoutMs($this->_cPtr,$newVal);
	}

	function get_ConnectTimeoutMs() {
		return CkSsh_get_ConnectTimeoutMs($this->_cPtr);
	}

	function put_ConnectTimeoutMs($newVal) {
		CkSsh_put_ConnectTimeoutMs($this->_cPtr,$newVal);
	}

	function get_ChannelOpenFailCode() {
		return CkSsh_get_ChannelOpenFailCode($this->_cPtr);
	}

	function get_DisconnectCode() {
		return CkSsh_get_DisconnectCode($this->_cPtr);
	}

	function get_DisconnectReason($str) {
		CkSsh_get_DisconnectReason($this->_cPtr,$str);
	}

	function disconnectReason() {
		return CkSsh_disconnectReason($this->_cPtr);
	}

	function get_ChannelOpenFailReason($str) {
		CkSsh_get_ChannelOpenFailReason($this->_cPtr,$str);
	}

	function channelOpenFailReason() {
		return CkSsh_channelOpenFailReason($this->_cPtr);
	}

	function get_MaxPacketSize() {
		return CkSsh_get_MaxPacketSize($this->_cPtr);
	}

	function put_MaxPacketSize($newVal) {
		CkSsh_put_MaxPacketSize($this->_cPtr,$newVal);
	}

	function Disconnect() {
		CkSsh_Disconnect($this->_cPtr);
	}

	function OpenSessionChannel() {
		return CkSsh_OpenSessionChannel($this->_cPtr);
	}

	function OpenCustomChannel($channelType) {
		return CkSsh_OpenCustomChannel($this->_cPtr,$channelType);
	}

	function get_NumOpenChannels() {
		return CkSsh_get_NumOpenChannels($this->_cPtr);
	}

	function GetChannelNumber($index) {
		return CkSsh_GetChannelNumber($this->_cPtr,$index);
	}

	function getChannelType($index) {
		return CkSsh_getChannelType($this->_cPtr,$index);
	}

	function SendReqPty($channelNum,$xTermEnvVar,$widthInChars,$heightInRows,$pixWidth,$pixHeight) {
		return CkSsh_SendReqPty($this->_cPtr,$channelNum,$xTermEnvVar,$widthInChars,$heightInRows,$pixWidth,$pixHeight);
	}

	function SendReqX11Forwarding($channelNum,$singleConnection,$authProt,$authCookie,$screenNum) {
		return CkSsh_SendReqX11Forwarding($this->_cPtr,$channelNum,$singleConnection,$authProt,$authCookie,$screenNum);
	}

	function SendReqSetEnv($channelNum,$name,$value) {
		return CkSsh_SendReqSetEnv($this->_cPtr,$channelNum,$name,$value);
	}

	function SendReqShell($channelNum) {
		return CkSsh_SendReqShell($this->_cPtr,$channelNum);
	}

	function SendReqExec($channelNum,$command) {
		return CkSsh_SendReqExec($this->_cPtr,$channelNum,$command);
	}

	function SendReqSubsystem($channelNum,$subsystemName) {
		return CkSsh_SendReqSubsystem($this->_cPtr,$channelNum,$subsystemName);
	}

	function SendReqWindowChange($channelNum,$widthInChars,$heightInRows,$pixWidth,$pixHeight) {
		return CkSsh_SendReqWindowChange($this->_cPtr,$channelNum,$widthInChars,$heightInRows,$pixWidth,$pixHeight);
	}

	function SendReqXonXoff($channelNum,$clientCanDo) {
		return CkSsh_SendReqXonXoff($this->_cPtr,$channelNum,$clientCanDo);
	}

	function SendReqSignal($channelNum,$signalName) {
		return CkSsh_SendReqSignal($this->_cPtr,$channelNum,$signalName);
	}

	function ChannelSendData($channelNum,$data) {
		return CkSsh_ChannelSendData($this->_cPtr,$channelNum,$data);
	}

	function ChannelSendString($channelNum,$strData,$charset) {
		return CkSsh_ChannelSendString($this->_cPtr,$channelNum,$strData,$charset);
	}

	function ChannelPoll($channelNum,$pollTimeoutMs) {
		return CkSsh_ChannelPoll($this->_cPtr,$channelNum,$pollTimeoutMs);
	}

	function ChannelReadAndPoll($channelNum,$pollTimeoutMs) {
		return CkSsh_ChannelReadAndPoll($this->_cPtr,$channelNum,$pollTimeoutMs);
	}

	function ChannelRead($channelNum) {
		return CkSsh_ChannelRead($this->_cPtr,$channelNum);
	}

	function GetReceivedData($channelNum,$outBytes) {
		CkSsh_GetReceivedData($this->_cPtr,$channelNum,$outBytes);
	}

	function GetReceivedStderr($channelNum,$outBytes) {
		CkSsh_GetReceivedStderr($this->_cPtr,$channelNum,$outBytes);
	}

	function ChannelReceivedEof($channelNum) {
		return CkSsh_ChannelReceivedEof($this->_cPtr,$channelNum);
	}

	function ChannelReceivedClose($channelNum) {
		return CkSsh_ChannelReceivedClose($this->_cPtr,$channelNum);
	}

	function ChannelSendClose($channelNum) {
		return CkSsh_ChannelSendClose($this->_cPtr,$channelNum);
	}

	function ChannelSendEof($channelNum) {
		return CkSsh_ChannelSendEof($this->_cPtr,$channelNum);
	}

	function ChannelIsOpen($channelNum) {
		return CkSsh_ChannelIsOpen($this->_cPtr,$channelNum);
	}

	function ChannelReceiveToClose($channelNum) {
		return CkSsh_ChannelReceiveToClose($this->_cPtr,$channelNum);
	}

	function ClearTtyModes() {
		CkSsh_ClearTtyModes($this->_cPtr);
	}

	function SetTtyMode($name,$value) {
		return CkSsh_SetTtyMode($this->_cPtr,$name,$value);
	}

	function get_IsConnected() {
		return CkSsh_get_IsConnected($this->_cPtr);
	}

	function ReKey() {
		return CkSsh_ReKey($this->_cPtr);
	}

	function AuthenticatePk($username,$privateKey) {
		return CkSsh_AuthenticatePk($this->_cPtr,$username,$privateKey);
	}

	function getReceivedText($channelNum,$charset) {
		return CkSsh_getReceivedText($this->_cPtr,$channelNum,$charset);
	}

	function GetReceivedNumBytes($channelNum) {
		return CkSsh_GetReceivedNumBytes($this->_cPtr,$channelNum);
	}

	function ChannelReceiveUntilMatch($channelNum,$matchPattern,$charset,$caseSensitive) {
		return CkSsh_ChannelReceiveUntilMatch($this->_cPtr,$channelNum,$matchPattern,$charset,$caseSensitive);
	}

	function SendIgnore() {
		return CkSsh_SendIgnore($this->_cPtr);
	}

	function OpenDirectTcpIpChannel($hostname,$port) {
		return CkSsh_OpenDirectTcpIpChannel($this->_cPtr,$hostname,$port);
	}

	function getReceivedTextS($channelNum,$substr,$charset) {
		return CkSsh_getReceivedTextS($this->_cPtr,$channelNum,$substr,$charset);
	}

	function GetReceivedDataN($channelNum,$numBytes,$outBytes) {
		return CkSsh_GetReceivedDataN($this->_cPtr,$channelNum,$numBytes,$outBytes);
	}

	function peekReceivedText($channelNum,$charset) {
		return CkSsh_peekReceivedText($this->_cPtr,$channelNum,$charset);
	}

	function get_HeartbeatMs() {
		return CkSsh_get_HeartbeatMs($this->_cPtr);
	}

	function put_HeartbeatMs($newVal) {
		CkSsh_put_HeartbeatMs($this->_cPtr,$newVal);
	}

	function ChannelReceivedExitStatus($channelNum) {
		return CkSsh_ChannelReceivedExitStatus($this->_cPtr,$channelNum);
	}

	function GetChannelExitStatus($channelNum) {
		return CkSsh_GetChannelExitStatus($this->_cPtr,$channelNum);
	}

	function get_ClientIdentifier($str) {
		CkSsh_get_ClientIdentifier($this->_cPtr,$str);
	}

	function clientIdentifier() {
		return CkSsh_clientIdentifier($this->_cPtr);
	}

	function put_ClientIdentifier($newVal) {
		CkSsh_put_ClientIdentifier($this->_cPtr,$newVal);
	}

	function get_ReadTimeoutMs() {
		return CkSsh_get_ReadTimeoutMs($this->_cPtr);
	}

	function put_ReadTimeoutMs($newVal) {
		CkSsh_put_ReadTimeoutMs($this->_cPtr,$newVal);
	}

	function get_TcpNoDelay() {
		return CkSsh_get_TcpNoDelay($this->_cPtr);
	}

	function put_TcpNoDelay($newVal) {
		CkSsh_put_TcpNoDelay($this->_cPtr,$newVal);
	}

	function get_VerboseLogging() {
		return CkSsh_get_VerboseLogging($this->_cPtr);
	}

	function put_VerboseLogging($newVal) {
		CkSsh_put_VerboseLogging($this->_cPtr,$newVal);
	}

	function get_HostKeyFingerprint($str) {
		CkSsh_get_HostKeyFingerprint($this->_cPtr,$str);
	}

	function hostKeyFingerprint() {
		return CkSsh_hostKeyFingerprint($this->_cPtr);
	}

	function get_SocksVersion() {
		return CkSsh_get_SocksVersion($this->_cPtr);
	}

	function put_SocksVersion($newVal) {
		CkSsh_put_SocksVersion($this->_cPtr,$newVal);
	}

	function get_SocksPort() {
		return CkSsh_get_SocksPort($this->_cPtr);
	}

	function put_SocksPort($newVal) {
		CkSsh_put_SocksPort($this->_cPtr,$newVal);
	}

	function get_SocksHostname($str) {
		CkSsh_get_SocksHostname($this->_cPtr,$str);
	}

	function socksHostname() {
		return CkSsh_socksHostname($this->_cPtr);
	}

	function put_SocksHostname($newVal) {
		CkSsh_put_SocksHostname($this->_cPtr,$newVal);
	}

	function get_SocksUsername($str) {
		CkSsh_get_SocksUsername($this->_cPtr,$str);
	}

	function socksUsername() {
		return CkSsh_socksUsername($this->_cPtr);
	}

	function put_SocksUsername($newVal) {
		CkSsh_put_SocksUsername($this->_cPtr,$newVal);
	}

	function get_SocksPassword($str) {
		CkSsh_get_SocksPassword($this->_cPtr,$str);
	}

	function socksPassword() {
		return CkSsh_socksPassword($this->_cPtr);
	}

	function put_SocksPassword($newVal) {
		CkSsh_put_SocksPassword($this->_cPtr,$newVal);
	}

	function get_HttpProxyAuthMethod($str) {
		CkSsh_get_HttpProxyAuthMethod($this->_cPtr,$str);
	}

	function httpProxyAuthMethod() {
		return CkSsh_httpProxyAuthMethod($this->_cPtr);
	}

	function put_HttpProxyAuthMethod($newVal) {
		CkSsh_put_HttpProxyAuthMethod($this->_cPtr,$newVal);
	}

	function get_HttpProxyHostname($str) {
		CkSsh_get_HttpProxyHostname($this->_cPtr,$str);
	}

	function httpProxyHostname() {
		return CkSsh_httpProxyHostname($this->_cPtr);
	}

	function put_HttpProxyHostname($newVal) {
		CkSsh_put_HttpProxyHostname($this->_cPtr,$newVal);
	}

	function get_HttpProxyPassword($str) {
		CkSsh_get_HttpProxyPassword($this->_cPtr,$str);
	}

	function httpProxyPassword() {
		return CkSsh_httpProxyPassword($this->_cPtr);
	}

	function put_HttpProxyPassword($newVal) {
		CkSsh_put_HttpProxyPassword($this->_cPtr,$newVal);
	}

	function get_HttpProxyPort() {
		return CkSsh_get_HttpProxyPort($this->_cPtr);
	}

	function put_HttpProxyPort($newVal) {
		CkSsh_put_HttpProxyPort($this->_cPtr,$newVal);
	}

	function get_HttpProxyUsername($str) {
		CkSsh_get_HttpProxyUsername($this->_cPtr,$str);
	}

	function httpProxyUsername() {
		return CkSsh_httpProxyUsername($this->_cPtr);
	}

	function put_HttpProxyUsername($newVal) {
		CkSsh_put_HttpProxyUsername($this->_cPtr,$newVal);
	}

	function ChannelReceiveUntilMatchN($channelNum,$matchPatterns,$charset,$caseSensitive) {
		return CkSsh_ChannelReceiveUntilMatchN($this->_cPtr,$channelNum,$matchPatterns,$charset,$caseSensitive);
	}

	function ChannelReadAndPoll2($channelNum,$pollTimeoutMs,$maxNumBytes) {
		return CkSsh_ChannelReadAndPoll2($this->_cPtr,$channelNum,$pollTimeoutMs,$maxNumBytes);
	}

	function AuthenticatePwPk($username,$password,$privateKey) {
		return CkSsh_AuthenticatePwPk($this->_cPtr,$username,$password,$privateKey);
	}

	function get_PasswordChangeRequested() {
		return CkSsh_get_PasswordChangeRequested($this->_cPtr);
	}

	function get_DebugLogFilePath($str) {
		CkSsh_get_DebugLogFilePath($this->_cPtr,$str);
	}

	function debugLogFilePath() {
		return CkSsh_debugLogFilePath($this->_cPtr);
	}

	function put_DebugLogFilePath($newVal) {
		CkSsh_put_DebugLogFilePath($this->_cPtr,$newVal);
	}

	function get_ClientIpAddress($str) {
		CkSsh_get_ClientIpAddress($this->_cPtr,$str);
	}

	function clientIpAddress() {
		return CkSsh_clientIpAddress($this->_cPtr);
	}

	function put_ClientIpAddress($newVal) {
		CkSsh_put_ClientIpAddress($this->_cPtr,$newVal);
	}

	function get_StderrToStdout() {
		return CkSsh_get_StderrToStdout($this->_cPtr);
	}

	function put_StderrToStdout($newVal) {
		CkSsh_put_StderrToStdout($this->_cPtr,$newVal);
	}

	function get_ForceCipher($str) {
		CkSsh_get_ForceCipher($this->_cPtr,$str);
	}

	function forceCipher() {
		return CkSsh_forceCipher($this->_cPtr);
	}

	function put_ForceCipher($newVal) {
		CkSsh_put_ForceCipher($this->_cPtr,$newVal);
	}

	function SaveLastError($filename) {
		return CkSsh_SaveLastError($this->_cPtr,$filename);
	}

	function lastErrorText() {
		return CkSsh_lastErrorText($this->_cPtr);
	}

	function lastErrorXml() {
		return CkSsh_lastErrorXml($this->_cPtr);
	}

	function lastErrorHtml() {
		return CkSsh_lastErrorHtml($this->_cPtr);
	}
}


?>