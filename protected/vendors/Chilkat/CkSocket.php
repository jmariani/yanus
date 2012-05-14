<?php
class CkSocket {

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
		if (is_resource($res) && get_resource_type($res) === '_p_CkSocket') {
			$this->_cPtr=$res;
			return;
		}
		$this->_cPtr=new_CkSocket();
	}

	function get_Utf8() {
		return CkSocket_get_Utf8($this->_cPtr);
	}

	function put_Utf8($b) {
		CkSocket_put_Utf8($this->_cPtr,$b);
	}

	function dnsLookup($hostname,$maxWaitMs) {
		return CkSocket_dnsLookup($this->_cPtr,$hostname,$maxWaitMs);
	}

	function GetMyCert() {
		$r=CkSocket_GetMyCert($this->_cPtr);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkCert($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function GetSslServerCert() {
		$r=CkSocket_GetSslServerCert($this->_cPtr);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkCert($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function receiveToCRLF() {
		return CkSocket_receiveToCRLF($this->_cPtr);
	}

	function get_SessionLog($str) {
		CkSocket_get_SessionLog($this->_cPtr,$str);
	}

	function sessionLog() {
		return CkSocket_sessionLog($this->_cPtr);
	}

	function get_KeepSessionLog() {
		return CkSocket_get_KeepSessionLog($this->_cPtr);
	}

	function put_KeepSessionLog($newVal) {
		CkSocket_put_KeepSessionLog($this->_cPtr,$newVal);
	}

	function get_SessionLogEncoding($str) {
		CkSocket_get_SessionLogEncoding($this->_cPtr,$str);
	}

	function sessionLogEncoding() {
		return CkSocket_sessionLogEncoding($this->_cPtr);
	}

	function put_SessionLogEncoding($newVal) {
		CkSocket_put_SessionLogEncoding($this->_cPtr,$newVal);
	}

	function ReceiveUntilByte($byteValue,$outBytes) {
		return CkSocket_ReceiveUntilByte($this->_cPtr,$byteValue,$outBytes);
	}

	function ClearSessionLog() {
		CkSocket_ClearSessionLog($this->_cPtr);
	}

	function receiveStringUntilByte($byteValue) {
		return CkSocket_receiveStringUntilByte($this->_cPtr,$byteValue);
	}

	function receiveStringMaxN($maxBytes) {
		return CkSocket_receiveStringMaxN($this->_cPtr,$maxBytes);
	}

	function get_SslProtocol($str) {
		CkSocket_get_SslProtocol($this->_cPtr,$str);
	}

	function sslProtocol() {
		return CkSocket_sslProtocol($this->_cPtr);
	}

	function put_SslProtocol($newVal) {
		CkSocket_put_SslProtocol($this->_cPtr,$newVal);
	}

	function SetSslClientCert($cert) {
		return CkSocket_SetSslClientCert($this->_cPtr,$cert);
	}

	function get_ClientIpAddress($str) {
		CkSocket_get_ClientIpAddress($this->_cPtr,$str);
	}

	function clientIpAddress() {
		return CkSocket_clientIpAddress($this->_cPtr);
	}

	function put_ClientIpAddress($newVal) {
		CkSocket_put_ClientIpAddress($this->_cPtr,$newVal);
	}

	function SendCount($byteCount) {
		return CkSocket_SendCount($this->_cPtr,$byteCount);
	}

	function ReceiveCount() {
		return CkSocket_ReceiveCount($this->_cPtr);
	}

	function get_LastMethodFailed() {
		return CkSocket_get_LastMethodFailed($this->_cPtr);
	}

	function ConvertToSsl() {
		return CkSocket_ConvertToSsl($this->_cPtr);
	}

	function ConvertFromSsl() {
		return CkSocket_ConvertFromSsl($this->_cPtr);
	}

	function get_SoSndBuf() {
		return CkSocket_get_SoSndBuf($this->_cPtr);
	}

	function put_SoSndBuf($newVal) {
		CkSocket_put_SoSndBuf($this->_cPtr,$newVal);
	}

	function get_SoRcvBuf() {
		return CkSocket_get_SoRcvBuf($this->_cPtr);
	}

	function put_SoRcvBuf($newVal) {
		CkSocket_put_SoRcvBuf($this->_cPtr,$newVal);
	}

	function get_ClientPort() {
		return CkSocket_get_ClientPort($this->_cPtr);
	}

	function put_ClientPort($newVal) {
		CkSocket_put_ClientPort($this->_cPtr,$newVal);
	}

	function get_LocalIpAddress($str) {
		CkSocket_get_LocalIpAddress($this->_cPtr,$str);
	}

	function localIpAddress() {
		return CkSocket_localIpAddress($this->_cPtr);
	}

	function get_LocalPort() {
		return CkSocket_get_LocalPort($this->_cPtr);
	}

	function get_SocksPort() {
		return CkSocket_get_SocksPort($this->_cPtr);
	}

	function put_SocksPort($newVal) {
		CkSocket_put_SocksPort($this->_cPtr,$newVal);
	}

	function get_SocksVersion() {
		return CkSocket_get_SocksVersion($this->_cPtr);
	}

	function put_SocksVersion($newVal) {
		CkSocket_put_SocksVersion($this->_cPtr,$newVal);
	}

	function get_SocksUsername($str) {
		CkSocket_get_SocksUsername($this->_cPtr,$str);
	}

	function socksUsername() {
		return CkSocket_socksUsername($this->_cPtr);
	}

	function put_SocksUsername($newVal) {
		CkSocket_put_SocksUsername($this->_cPtr,$newVal);
	}

	function get_SocksPassword($str) {
		CkSocket_get_SocksPassword($this->_cPtr,$str);
	}

	function socksPassword() {
		return CkSocket_socksPassword($this->_cPtr);
	}

	function put_SocksPassword($newVal) {
		CkSocket_put_SocksPassword($this->_cPtr,$newVal);
	}

	function get_SocksHostname($str) {
		CkSocket_get_SocksHostname($this->_cPtr,$str);
	}

	function socksHostname() {
		return CkSocket_socksHostname($this->_cPtr);
	}

	function put_SocksHostname($newVal) {
		CkSocket_put_SocksHostname($this->_cPtr,$newVal);
	}

	function CheckWriteable($maxWaitMs) {
		return CkSocket_CheckWriteable($this->_cPtr,$maxWaitMs);
	}

	function SetSslClientCertPfx($pfxFilename,$pfxPassword,$certSubjectCN) {
		return CkSocket_SetSslClientCertPfx($this->_cPtr,$pfxFilename,$pfxPassword,$certSubjectCN);
	}

	function get_TcpNoDelay() {
		return CkSocket_get_TcpNoDelay($this->_cPtr);
	}

	function put_TcpNoDelay($newVal) {
		CkSocket_put_TcpNoDelay($this->_cPtr,$newVal);
	}

	function get_BigEndian() {
		return CkSocket_get_BigEndian($this->_cPtr);
	}

	function put_BigEndian($newVal) {
		CkSocket_put_BigEndian($this->_cPtr,$newVal);
	}

	function PollDataAvailable() {
		return CkSocket_PollDataAvailable($this->_cPtr);
	}

	function get_VerboseLogging() {
		return CkSocket_get_VerboseLogging($this->_cPtr);
	}

	function put_VerboseLogging($newVal) {
		CkSocket_put_VerboseLogging($this->_cPtr,$newVal);
	}

	function TakeSocket($sock) {
		return CkSocket_TakeSocket($this->_cPtr,$sock);
	}

	function SelectForReading($timeoutMs) {
		return CkSocket_SelectForReading($this->_cPtr,$timeoutMs);
	}

	function SelectForWriting($timeoutMs) {
		return CkSocket_SelectForWriting($this->_cPtr,$timeoutMs);
	}

	function get_SelectorIndex() {
		return CkSocket_get_SelectorIndex($this->_cPtr);
	}

	function put_SelectorIndex($newVal) {
		CkSocket_put_SelectorIndex($this->_cPtr,$newVal);
	}

	function get_SelectorReadIndex() {
		return CkSocket_get_SelectorReadIndex($this->_cPtr);
	}

	function put_SelectorReadIndex($newVal) {
		CkSocket_put_SelectorReadIndex($this->_cPtr,$newVal);
	}

	function get_SelectorWriteIndex() {
		return CkSocket_get_SelectorWriteIndex($this->_cPtr);
	}

	function put_SelectorWriteIndex($newVal) {
		CkSocket_put_SelectorWriteIndex($this->_cPtr,$newVal);
	}

	function get_NumSocketsInSet() {
		return CkSocket_get_NumSocketsInSet($this->_cPtr);
	}

	function get_UserData($str) {
		CkSocket_get_UserData($this->_cPtr,$str);
	}

	function userData() {
		return CkSocket_userData($this->_cPtr);
	}

	function put_UserData($newVal) {
		CkSocket_put_UserData($this->_cPtr,$newVal);
	}

	function StartTiming() {
		CkSocket_StartTiming($this->_cPtr);
	}

	function get_ElapsedSeconds() {
		return CkSocket_get_ElapsedSeconds($this->_cPtr);
	}

	function ReceiveBytesToFile($appendFilename) {
		return CkSocket_ReceiveBytesToFile($this->_cPtr,$appendFilename);
	}

	function get_HttpProxyUsername($str) {
		CkSocket_get_HttpProxyUsername($this->_cPtr,$str);
	}

	function httpProxyUsername() {
		return CkSocket_httpProxyUsername($this->_cPtr);
	}

	function put_HttpProxyUsername($newVal) {
		CkSocket_put_HttpProxyUsername($this->_cPtr,$newVal);
	}

	function get_HttpProxyPassword($str) {
		CkSocket_get_HttpProxyPassword($this->_cPtr,$str);
	}

	function httpProxyPassword() {
		return CkSocket_httpProxyPassword($this->_cPtr);
	}

	function put_HttpProxyPassword($newVal) {
		CkSocket_put_HttpProxyPassword($this->_cPtr,$newVal);
	}

	function get_HttpProxyAuthMethod($str) {
		CkSocket_get_HttpProxyAuthMethod($this->_cPtr,$str);
	}

	function httpProxyAuthMethod() {
		return CkSocket_httpProxyAuthMethod($this->_cPtr);
	}

	function put_HttpProxyAuthMethod($newVal) {
		CkSocket_put_HttpProxyAuthMethod($this->_cPtr,$newVal);
	}

	function get_HttpProxyHostname($str) {
		CkSocket_get_HttpProxyHostname($this->_cPtr,$str);
	}

	function httpProxyHostname() {
		return CkSocket_httpProxyHostname($this->_cPtr);
	}

	function put_HttpProxyHostname($newVal) {
		CkSocket_put_HttpProxyHostname($this->_cPtr,$newVal);
	}

	function get_HttpProxyPort() {
		return CkSocket_get_HttpProxyPort($this->_cPtr);
	}

	function put_HttpProxyPort($newVal) {
		CkSocket_put_HttpProxyPort($this->_cPtr,$newVal);
	}

	function get_NumSslAcceptableClientCAs() {
		return CkSocket_get_NumSslAcceptableClientCAs($this->_cPtr);
	}

	function getSslAcceptableClientCaDn($index) {
		return CkSocket_getSslAcceptableClientCaDn($this->_cPtr,$index);
	}

	function AddSslAcceptableClientCaDn($certAuthDN) {
		return CkSocket_AddSslAcceptableClientCaDn($this->_cPtr,$certAuthDN);
	}

	function get_ReceivedCount() {
		return CkSocket_get_ReceivedCount($this->_cPtr);
	}

	function put_ReceivedCount($newVal) {
		CkSocket_put_ReceivedCount($this->_cPtr,$newVal);
	}

	function SetSslClientCertPem($pemDataOrFilename,$pemPassword) {
		return CkSocket_SetSslClientCertPem($this->_cPtr,$pemDataOrFilename,$pemPassword);
	}

	function get_DebugLogFilePath($str) {
		CkSocket_get_DebugLogFilePath($this->_cPtr,$str);
	}

	function debugLogFilePath() {
		return CkSocket_debugLogFilePath($this->_cPtr);
	}

	function put_DebugLogFilePath($newVal) {
		CkSocket_put_DebugLogFilePath($this->_cPtr,$newVal);
	}

	function SendByteData($data) {
		return CkSocket_SendByteData($this->_cPtr,$data);
	}

	function AsyncSendByteData($data) {
		return CkSocket_AsyncSendByteData($this->_cPtr,$data);
	}

	function get_NumReceivedClientCerts() {
		return CkSocket_get_NumReceivedClientCerts($this->_cPtr);
	}

	function GetReceivedClientCert($index) {
		$r=CkSocket_GetReceivedClientCert($this->_cPtr,$index);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkCert($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function UnlockComponent($code) {
		return CkSocket_UnlockComponent($this->_cPtr,$code);
	}

	function IsUnlocked() {
		return CkSocket_IsUnlocked($this->_cPtr);
	}

	function AsyncSendBytes($byteData,$numBytes) {
		return CkSocket_AsyncSendBytes($this->_cPtr,$byteData,$numBytes);
	}

	function AsyncSendString($str) {
		return CkSocket_AsyncSendString($this->_cPtr,$str);
	}

	function get_AsyncSendFinished() {
		return CkSocket_get_AsyncSendFinished($this->_cPtr);
	}

	function AsyncSendAbort() {
		CkSocket_AsyncSendAbort($this->_cPtr);
	}

	function get_AsyncSendLog($str) {
		CkSocket_get_AsyncSendLog($this->_cPtr,$str);
	}

	function get_AsyncSendSuccess() {
		return CkSocket_get_AsyncSendSuccess($this->_cPtr);
	}

	function AsyncReceiveBytes() {
		return CkSocket_AsyncReceiveBytes($this->_cPtr);
	}

	function AsyncReceiveBytesN($numBytes) {
		return CkSocket_AsyncReceiveBytesN($this->_cPtr,$numBytes);
	}

	function AsyncReceiveString() {
		return CkSocket_AsyncReceiveString($this->_cPtr);
	}

	function AsyncReceiveToCRLF() {
		return CkSocket_AsyncReceiveToCRLF($this->_cPtr);
	}

	function AsyncReceiveUntilMatch($matchStr) {
		return CkSocket_AsyncReceiveUntilMatch($this->_cPtr,$matchStr);
	}

	function get_AsyncReceiveFinished() {
		return CkSocket_get_AsyncReceiveFinished($this->_cPtr);
	}

	function AsyncReceiveAbort() {
		CkSocket_AsyncReceiveAbort($this->_cPtr);
	}

	function get_AsyncReceiveLog($str) {
		CkSocket_get_AsyncReceiveLog($this->_cPtr,$str);
	}

	function get_AsyncReceiveSuccess() {
		return CkSocket_get_AsyncReceiveSuccess($this->_cPtr);
	}

	function get_AsyncReceivedString($str) {
		CkSocket_get_AsyncReceivedString($this->_cPtr,$str);
	}

	function get_AsyncReceivedBytes($byteData) {
		CkSocket_get_AsyncReceivedBytes($this->_cPtr,$byteData);
	}

	function asyncReceivedString() {
		return CkSocket_asyncReceivedString($this->_cPtr);
	}

	function asyncReceiveLog() {
		return CkSocket_asyncReceiveLog($this->_cPtr);
	}

	function asyncSendLog() {
		return CkSocket_asyncSendLog($this->_cPtr);
	}

	function SleepMs($millisec) {
		CkSocket_SleepMs($this->_cPtr,$millisec);
	}

	function Close($maxWaitMs) {
		CkSocket_Close($this->_cPtr,$maxWaitMs);
	}

	function get_ObjectId() {
		return CkSocket_get_ObjectId($this->_cPtr);
	}

	function SaveLastError($filename) {
		return CkSocket_SaveLastError($this->_cPtr,$filename);
	}

	function get_Version($str) {
		CkSocket_get_Version($this->_cPtr,$str);
	}

	function AsyncDnsStart($hostname,$maxWaitMs) {
		return CkSocket_AsyncDnsStart($this->_cPtr,$hostname,$maxWaitMs);
	}

	function get_AsyncDnsFinished() {
		return CkSocket_get_AsyncDnsFinished($this->_cPtr);
	}

	function get_AsyncDnsResult($str) {
		CkSocket_get_AsyncDnsResult($this->_cPtr,$str);
	}

	function AsyncDnsAbort() {
		CkSocket_AsyncDnsAbort($this->_cPtr);
	}

	function get_AsyncDnsLog($str) {
		CkSocket_get_AsyncDnsLog($this->_cPtr,$str);
	}

	function get_AsyncDnsSuccess() {
		return CkSocket_get_AsyncDnsSuccess($this->_cPtr);
	}

	function AsyncConnectStart($hostname,$port,$ssl,$maxWaitMs) {
		return CkSocket_AsyncConnectStart($this->_cPtr,$hostname,$port,$ssl,$maxWaitMs);
	}

	function get_AsyncConnectFinished() {
		return CkSocket_get_AsyncConnectFinished($this->_cPtr);
	}

	function AsyncConnectAbort() {
		CkSocket_AsyncConnectAbort($this->_cPtr);
	}

	function get_AsyncConnectLog($str) {
		CkSocket_get_AsyncConnectLog($this->_cPtr,$str);
	}

	function get_AsyncConnectSuccess() {
		return CkSocket_get_AsyncConnectSuccess($this->_cPtr);
	}

	function get_MyIpAddress($str) {
		CkSocket_get_MyIpAddress($this->_cPtr,$str);
	}

	function BindAndListen($port,$backlog) {
		return CkSocket_BindAndListen($this->_cPtr,$port,$backlog);
	}

	function Connect($hostname,$port,$ssl,$maxWaitMs) {
		return CkSocket_Connect($this->_cPtr,$hostname,$port,$ssl,$maxWaitMs);
	}

	function AcceptNextConnection($maxWaitMs) {
		$r=CkSocket_AcceptNextConnection($this->_cPtr,$maxWaitMs);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkSocket($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function get_Ssl() {
		return CkSocket_get_Ssl($this->_cPtr);
	}

	function put_Ssl($newVal) {
		CkSocket_put_Ssl($this->_cPtr,$newVal);
	}

	function InitSslServer($cert) {
		return CkSocket_InitSslServer($this->_cPtr,$cert);
	}

	function get_ConnectFailReason() {
		return CkSocket_get_ConnectFailReason($this->_cPtr);
	}

	function get_HeartbeatMs() {
		return CkSocket_get_HeartbeatMs($this->_cPtr);
	}

	function put_HeartbeatMs($millisec) {
		CkSocket_put_HeartbeatMs($this->_cPtr,$millisec);
	}

	function get_MaxSendIdleMs() {
		return CkSocket_get_MaxSendIdleMs($this->_cPtr);
	}

	function put_MaxSendIdleMs($millisec) {
		CkSocket_put_MaxSendIdleMs($this->_cPtr,$millisec);
	}

	function get_MaxReadIdleMs() {
		return CkSocket_get_MaxReadIdleMs($this->_cPtr);
	}

	function put_MaxReadIdleMs($millisec) {
		CkSocket_put_MaxReadIdleMs($this->_cPtr,$millisec);
	}

	function get_StringCharset($str) {
		CkSocket_get_StringCharset($this->_cPtr,$str);
	}

	function put_StringCharset($str) {
		CkSocket_put_StringCharset($this->_cPtr,$str);
	}

	function get_DebugDnsDelayMs() {
		return CkSocket_get_DebugDnsDelayMs($this->_cPtr);
	}

	function put_DebugDnsDelayMs($millisec) {
		CkSocket_put_DebugDnsDelayMs($this->_cPtr,$millisec);
	}

	function get_DebugConnectDelayMs() {
		return CkSocket_get_DebugConnectDelayMs($this->_cPtr);
	}

	function put_DebugConnectDelayMs($millisec) {
		CkSocket_put_DebugConnectDelayMs($this->_cPtr,$millisec);
	}

	function get_IsConnected() {
		return CkSocket_get_IsConnected($this->_cPtr);
	}

	function get_RemotePort() {
		return CkSocket_get_RemotePort($this->_cPtr);
	}

	function get_RemoteIpAddress($str) {
		CkSocket_get_RemoteIpAddress($this->_cPtr,$str);
	}

	function AsyncAcceptStart($maxWaitMs) {
		return CkSocket_AsyncAcceptStart($this->_cPtr,$maxWaitMs);
	}

	function get_AsyncAcceptFinished() {
		return CkSocket_get_AsyncAcceptFinished($this->_cPtr);
	}

	function AsyncAcceptAbort() {
		CkSocket_AsyncAcceptAbort($this->_cPtr);
	}

	function get_AsyncAcceptLog($str) {
		CkSocket_get_AsyncAcceptLog($this->_cPtr,$str);
	}

	function get_AsyncAcceptSuccess() {
		return CkSocket_get_AsyncAcceptSuccess($this->_cPtr);
	}

	function AsyncAcceptSocket() {
		$r=CkSocket_AsyncAcceptSocket($this->_cPtr);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkSocket($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function get_SendPacketSize() {
		return CkSocket_get_SendPacketSize($this->_cPtr);
	}

	function put_SendPacketSize($sizeInBytes) {
		CkSocket_put_SendPacketSize($this->_cPtr,$sizeInBytes);
	}

	function get_ReceivePacketSize() {
		return CkSocket_get_ReceivePacketSize($this->_cPtr);
	}

	function put_ReceivePacketSize($sizeInBytes) {
		CkSocket_put_ReceivePacketSize($this->_cPtr,$sizeInBytes);
	}

	function SendString($str) {
		return CkSocket_SendString($this->_cPtr,$str);
	}

	function SendBytes($byteData,$numBytes) {
		return CkSocket_SendBytes($this->_cPtr,$byteData,$numBytes);
	}

	function ReceiveBytes($byteData) {
		return CkSocket_ReceiveBytes($this->_cPtr,$byteData);
	}

	function ReceiveBytesN($numBytes,$byteData) {
		return CkSocket_ReceiveBytesN($this->_cPtr,$numBytes,$byteData);
	}

	function stringCharset() {
		return CkSocket_stringCharset($this->_cPtr);
	}

	function remoteIpAddress() {
		return CkSocket_remoteIpAddress($this->_cPtr);
	}

	function asyncAcceptLog() {
		return CkSocket_asyncAcceptLog($this->_cPtr);
	}

	function buildHttpGetRequest($url) {
		return CkSocket_buildHttpGetRequest($this->_cPtr,$url);
	}

	function receiveString() {
		return CkSocket_receiveString($this->_cPtr);
	}

	function receiveUntilMatch($matchStr) {
		return CkSocket_receiveUntilMatch($this->_cPtr,$matchStr);
	}

	function lastErrorText() {
		return CkSocket_lastErrorText($this->_cPtr);
	}

	function lastErrorXml() {
		return CkSocket_lastErrorXml($this->_cPtr);
	}

	function lastErrorHtml() {
		return CkSocket_lastErrorHtml($this->_cPtr);
	}

	function asyncDnsResult() {
		return CkSocket_asyncDnsResult($this->_cPtr);
	}

	function asyncDnsLog() {
		return CkSocket_asyncDnsLog($this->_cPtr);
	}

	function asyncConnectLog() {
		return CkSocket_asyncConnectLog($this->_cPtr);
	}

	function myIpAddress() {
		return CkSocket_myIpAddress($this->_cPtr);
	}

	function version() {
		return CkSocket_version($this->_cPtr);
	}
}


?>