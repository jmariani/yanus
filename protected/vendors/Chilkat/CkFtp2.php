<?php
class CkFtp2 {

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
		if (is_resource($res) && get_resource_type($res) === '_p_CkFtp2') {
			$this->_cPtr=$res;
			return;
		}
		$this->_cPtr=new_CkFtp2();
	}

	function lastErrorText() {
		return CkFtp2_lastErrorText($this->_cPtr);
	}

	function lastErrorXml() {
		return CkFtp2_lastErrorXml($this->_cPtr);
	}

	function lastErrorHtml() {
		return CkFtp2_lastErrorHtml($this->_cPtr);
	}

	function get_AllocateSize() {
		return CkFtp2_get_AllocateSize($this->_cPtr);
	}

	function get_ConnectVerified() {
		return CkFtp2_get_ConnectVerified($this->_cPtr);
	}

	function get_LoginVerified() {
		return CkFtp2_get_LoginVerified($this->_cPtr);
	}

	function get_PartialTransfer() {
		return CkFtp2_get_PartialTransfer($this->_cPtr);
	}

	function sendCommand($cmd) {
		return CkFtp2_sendCommand($this->_cPtr,$cmd);
	}

	function dirTreeXml() {
		return CkFtp2_dirTreeXml($this->_cPtr);
	}

	function get_BandwidthThrottleUp() {
		return CkFtp2_get_BandwidthThrottleUp($this->_cPtr);
	}

	function put_BandwidthThrottleUp($newVal) {
		CkFtp2_put_BandwidthThrottleUp($this->_cPtr,$newVal);
	}

	function get_BandwidthThrottleDown() {
		return CkFtp2_get_BandwidthThrottleDown($this->_cPtr);
	}

	function put_BandwidthThrottleDown($newVal) {
		CkFtp2_put_BandwidthThrottleDown($this->_cPtr,$newVal);
	}

	function get_ActivePortRangeStart() {
		return CkFtp2_get_ActivePortRangeStart($this->_cPtr);
	}

	function put_ActivePortRangeStart($newVal) {
		CkFtp2_put_ActivePortRangeStart($this->_cPtr,$newVal);
	}

	function get_ActivePortRangeEnd() {
		return CkFtp2_get_ActivePortRangeEnd($this->_cPtr);
	}

	function put_ActivePortRangeEnd($newVal) {
		CkFtp2_put_ActivePortRangeEnd($this->_cPtr,$newVal);
	}

	function ClearDirCache() {
		CkFtp2_ClearDirCache($this->_cPtr);
	}

	function get_Account($str) {
		CkFtp2_get_Account($this->_cPtr,$str);
	}

	function put_Account($newVal) {
		CkFtp2_put_Account($this->_cPtr,$newVal);
	}

	function account() {
		return CkFtp2_account($this->_cPtr);
	}

	function get_ProxyPort() {
		return CkFtp2_get_ProxyPort($this->_cPtr);
	}

	function put_ProxyPort($newVal) {
		CkFtp2_put_ProxyPort($this->_cPtr,$newVal);
	}

	function get_RestartNext() {
		return CkFtp2_get_RestartNext($this->_cPtr);
	}

	function put_RestartNext($newVal) {
		CkFtp2_put_RestartNext($this->_cPtr,$newVal);
	}

	function SetModeZ() {
		return CkFtp2_SetModeZ($this->_cPtr);
	}

	function get_HasModeZ() {
		return CkFtp2_get_HasModeZ($this->_cPtr);
	}

	function get_AutoXcrc() {
		return CkFtp2_get_AutoXcrc($this->_cPtr);
	}

	function put_AutoXcrc($newVal) {
		CkFtp2_put_AutoXcrc($this->_cPtr,$newVal);
	}

	function get_AutoFeat() {
		return CkFtp2_get_AutoFeat($this->_cPtr);
	}

	function put_AutoFeat($newVal) {
		CkFtp2_put_AutoFeat($this->_cPtr,$newVal);
	}

	function get_AutoSyst() {
		return CkFtp2_get_AutoSyst($this->_cPtr);
	}

	function put_AutoSyst($newVal) {
		CkFtp2_put_AutoSyst($this->_cPtr,$newVal);
	}

	function feat() {
		return CkFtp2_feat($this->_cPtr);
	}

	function SetSslClientCert($cert) {
		return CkFtp2_SetSslClientCert($this->_cPtr,$cert);
	}

	function dirListingCharset() {
		return CkFtp2_dirListingCharset($this->_cPtr);
	}

	function getFilename($index) {
		return CkFtp2_getFilename($this->_cPtr,$index);
	}

	function listPattern() {
		return CkFtp2_listPattern($this->_cPtr);
	}

	function password() {
		return CkFtp2_password($this->_cPtr);
	}

	function username() {
		return CkFtp2_username($this->_cPtr);
	}

	function hostname() {
		return CkFtp2_hostname($this->_cPtr);
	}

	function sessionLog() {
		return CkFtp2_sessionLog($this->_cPtr);
	}

	function getXmlDirListing($pattern) {
		return CkFtp2_getXmlDirListing($this->_cPtr,$pattern);
	}

	function getTextDirListing($pattern) {
		return CkFtp2_getTextDirListing($this->_cPtr,$pattern);
	}

	function getRemoteFileTextData($remoteFilename) {
		return CkFtp2_getRemoteFileTextData($this->_cPtr,$remoteFilename);
	}

	function getRemoteFileTextC($remoteFilename,$charset) {
		return CkFtp2_getRemoteFileTextC($this->_cPtr,$remoteFilename,$charset);
	}

	function version() {
		return CkFtp2_version($this->_cPtr);
	}

	function getCurrentRemoteDir() {
		return CkFtp2_getCurrentRemoteDir($this->_cPtr);
	}

	function proxyHostname() {
		return CkFtp2_proxyHostname($this->_cPtr);
	}

	function syst() {
		return CkFtp2_syst($this->_cPtr);
	}

	function ck_stat() {
		return CkFtp2_ck_stat($this->_cPtr);
	}

	function asyncLog() {
		return CkFtp2_asyncLog($this->_cPtr);
	}

	function get_Utf8() {
		return CkFtp2_get_Utf8($this->_cPtr);
	}

	function put_Utf8($b) {
		CkFtp2_put_Utf8($this->_cPtr,$b);
	}

	function get_SslServerCertVerified() {
		return CkFtp2_get_SslServerCertVerified($this->_cPtr);
	}

	function GetSslServerCert() {
		$r=CkFtp2_GetSslServerCert($this->_cPtr);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkCert($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function get_RequireSslCertVerify() {
		return CkFtp2_get_RequireSslCertVerify($this->_cPtr);
	}

	function put_RequireSslCertVerify($newVal) {
		CkFtp2_put_RequireSslCertVerify($this->_cPtr,$newVal);
	}

	function SetSslCertRequirement($name,$value) {
		CkFtp2_SetSslCertRequirement($this->_cPtr,$name,$value);
	}

	function get_AuthSsl() {
		return CkFtp2_get_AuthSsl($this->_cPtr);
	}

	function put_AuthSsl($newVal) {
		CkFtp2_put_AuthSsl($this->_cPtr,$newVal);
	}

	function determineSettings() {
		return CkFtp2_determineSettings($this->_cPtr);
	}

	function DetermineProxyMethod() {
		return CkFtp2_DetermineProxyMethod($this->_cPtr);
	}

	function get_PassiveUseHostAddr() {
		return CkFtp2_get_PassiveUseHostAddr($this->_cPtr);
	}

	function put_PassiveUseHostAddr($newVal) {
		CkFtp2_put_PassiveUseHostAddr($this->_cPtr,$newVal);
	}

	function get_CrlfMode() {
		return CkFtp2_get_CrlfMode($this->_cPtr);
	}

	function put_CrlfMode($newVal) {
		CkFtp2_put_CrlfMode($this->_cPtr,$newVal);
	}

	function get_ConnectFailReason() {
		return CkFtp2_get_ConnectFailReason($this->_cPtr);
	}

	function ClearControlChannel() {
		CkFtp2_ClearControlChannel($this->_cPtr);
	}

	function SleepMs($millisec) {
		CkFtp2_SleepMs($this->_cPtr,$millisec);
	}

	function AppendFile($localFilename,$remoteFilename) {
		return CkFtp2_AppendFile($this->_cPtr,$localFilename,$remoteFilename);
	}

	function AppendFileFromBinaryData($remoteFilename,$binaryData) {
		return CkFtp2_AppendFileFromBinaryData($this->_cPtr,$remoteFilename,$binaryData);
	}

	function AppendFileFromTextData($remoteFilename,$textData) {
		return CkFtp2_AppendFileFromTextData($this->_cPtr,$remoteFilename,$textData);
	}

	function UnlockComponent($code) {
		return CkFtp2_UnlockComponent($this->_cPtr,$code);
	}

	function IsUnlocked() {
		return CkFtp2_IsUnlocked($this->_cPtr);
	}

	function SaveLastError($filename) {
		return CkFtp2_SaveLastError($this->_cPtr,$filename);
	}

	function get_IsConnected() {
		return CkFtp2_get_IsConnected($this->_cPtr);
	}

	function DeleteMatching($remotePattern) {
		return CkFtp2_DeleteMatching($this->_cPtr,$remotePattern);
	}

	function MGetFiles($remotePattern,$localDir) {
		return CkFtp2_MGetFiles($this->_cPtr,$remotePattern,$localDir);
	}

	function MPutFiles($pattern) {
		return CkFtp2_MPutFiles($this->_cPtr,$pattern);
	}

	function PutTree($localDir) {
		return CkFtp2_PutTree($this->_cPtr,$localDir);
	}

	function GetFile($remoteFilename,$localFilename) {
		return CkFtp2_GetFile($this->_cPtr,$remoteFilename,$localFilename);
	}

	function PutFile($localFilename,$remoteFilename) {
		return CkFtp2_PutFile($this->_cPtr,$localFilename,$remoteFilename);
	}

	function PutFileFromBinaryData($remoteFilename,$binaryData) {
		return CkFtp2_PutFileFromBinaryData($this->_cPtr,$remoteFilename,$binaryData);
	}

	function PutFileFromTextData($remoteFilename,$textData) {
		return CkFtp2_PutFileFromTextData($this->_cPtr,$remoteFilename,$textData);
	}

	function GetRemoteFileBinaryData($remoteFilename,$data) {
		return CkFtp2_GetRemoteFileBinaryData($this->_cPtr,$remoteFilename,$data);
	}

	function get_Version($str) {
		CkFtp2_get_Version($this->_cPtr,$str);
	}

	function RenameRemoteFile($existingFilename,$newFilename) {
		return CkFtp2_RenameRemoteFile($this->_cPtr,$existingFilename,$newFilename);
	}

	function DeleteRemoteFile($filename) {
		return CkFtp2_DeleteRemoteFile($this->_cPtr,$filename);
	}

	function RemoveRemoteDir($dir) {
		return CkFtp2_RemoveRemoteDir($this->_cPtr,$dir);
	}

	function CreateRemoteDir($dir) {
		return CkFtp2_CreateRemoteDir($this->_cPtr,$dir);
	}

	function Disconnect() {
		return CkFtp2_Disconnect($this->_cPtr);
	}

	function Connect() {
		return CkFtp2_Connect($this->_cPtr);
	}

	function ChangeRemoteDir($relativeDirPath) {
		return CkFtp2_ChangeRemoteDir($this->_cPtr,$relativeDirPath);
	}

	function get_DirListingCharset($strCharset) {
		CkFtp2_get_DirListingCharset($this->_cPtr,$strCharset);
	}

	function put_DirListingCharset($charset) {
		CkFtp2_put_DirListingCharset($this->_cPtr,$charset);
	}

	function get_ListPattern($strPattern) {
		CkFtp2_get_ListPattern($this->_cPtr,$strPattern);
	}

	function put_ListPattern($pattern) {
		CkFtp2_put_ListPattern($this->_cPtr,$pattern);
	}

	function get_Password($str) {
		CkFtp2_get_Password($this->_cPtr,$str);
	}

	function put_Password($newVal) {
		CkFtp2_put_Password($this->_cPtr,$newVal);
	}

	function get_Username($str) {
		CkFtp2_get_Username($this->_cPtr,$str);
	}

	function put_Username($newVal) {
		CkFtp2_put_Username($this->_cPtr,$newVal);
	}

	function get_Port() {
		return CkFtp2_get_Port($this->_cPtr);
	}

	function put_Port($newVal) {
		CkFtp2_put_Port($this->_cPtr,$newVal);
	}

	function get_Hostname($str) {
		CkFtp2_get_Hostname($this->_cPtr,$str);
	}

	function put_Hostname($newVal) {
		CkFtp2_put_Hostname($this->_cPtr,$newVal);
	}

	function get_SessionLog($str) {
		CkFtp2_get_SessionLog($this->_cPtr,$str);
	}

	function get_Passive() {
		return CkFtp2_get_Passive($this->_cPtr);
	}

	function put_Passive($newVal) {
		CkFtp2_put_Passive($this->_cPtr,$newVal);
	}

	function get_KeepSessionLog() {
		return CkFtp2_get_KeepSessionLog($this->_cPtr);
	}

	function put_KeepSessionLog($newVal) {
		CkFtp2_put_KeepSessionLog($this->_cPtr,$newVal);
	}

	function GetSize($index) {
		return CkFtp2_GetSize($this->_cPtr,$index);
	}

	function GetIsDirectory($index) {
		return CkFtp2_GetIsDirectory($this->_cPtr,$index);
	}

	function GetCreateTime($index,$sysTime) {
		return CkFtp2_GetCreateTime($this->_cPtr,$index,$sysTime);
	}

	function GetLastAccessTime($index,$sysTime) {
		return CkFtp2_GetLastAccessTime($this->_cPtr,$index,$sysTime);
	}

	function GetLastModifiedTime($index,$sysTime) {
		return CkFtp2_GetLastModifiedTime($this->_cPtr,$index,$sysTime);
	}

	function get_NumFilesAndDirs() {
		return CkFtp2_get_NumFilesAndDirs($this->_cPtr);
	}

	function get_ProxyHostname($str) {
		CkFtp2_get_ProxyHostname($this->_cPtr,$str);
	}

	function put_ProxyHostname($newVal) {
		CkFtp2_put_ProxyHostname($this->_cPtr,$newVal);
	}

	function get_ProxyMethod() {
		return CkFtp2_get_ProxyMethod($this->_cPtr);
	}

	function put_ProxyMethod($newVal) {
		CkFtp2_put_ProxyMethod($this->_cPtr,$newVal);
	}

	function get_Ssl() {
		return CkFtp2_get_Ssl($this->_cPtr);
	}

	function put_Ssl($newVal) {
		CkFtp2_put_Ssl($this->_cPtr,$newVal);
	}

	function get_AuthTls() {
		return CkFtp2_get_AuthTls($this->_cPtr);
	}

	function put_AuthTls($newVal) {
		CkFtp2_put_AuthTls($this->_cPtr,$newVal);
	}

	function get_HeartbeatMs() {
		return CkFtp2_get_HeartbeatMs($this->_cPtr);
	}

	function put_HeartbeatMs($newVal) {
		CkFtp2_put_HeartbeatMs($this->_cPtr,$newVal);
	}

	function get_IdleTimeoutMs() {
		return CkFtp2_get_IdleTimeoutMs($this->_cPtr);
	}

	function put_IdleTimeoutMs($newVal) {
		CkFtp2_put_IdleTimeoutMs($this->_cPtr,$newVal);
	}

	function get_UploadRate() {
		return CkFtp2_get_UploadRate($this->_cPtr);
	}

	function get_DownloadRate() {
		return CkFtp2_get_DownloadRate($this->_cPtr);
	}

	function AsyncGetFileStart($remoteFilename,$localFilename) {
		return CkFtp2_AsyncGetFileStart($this->_cPtr,$remoteFilename,$localFilename);
	}

	function AsyncPutFileStart($localFilename,$remoteFilename) {
		return CkFtp2_AsyncPutFileStart($this->_cPtr,$localFilename,$remoteFilename);
	}

	function AsyncAppendFileStart($localFilename,$remoteFilename) {
		return CkFtp2_AsyncAppendFileStart($this->_cPtr,$localFilename,$remoteFilename);
	}

	function AsyncAbort() {
		CkFtp2_AsyncAbort($this->_cPtr);
	}

	function get_AsyncFinished() {
		return CkFtp2_get_AsyncFinished($this->_cPtr);
	}

	function get_AsyncLog($strLog) {
		CkFtp2_get_AsyncLog($this->_cPtr,$strLog);
	}

	function get_AsyncSuccess() {
		return CkFtp2_get_AsyncSuccess($this->_cPtr);
	}

	function get_AsyncBytesReceived() {
		return CkFtp2_get_AsyncBytesReceived($this->_cPtr);
	}

	function get_AsyncBytesSent() {
		return CkFtp2_get_AsyncBytesSent($this->_cPtr);
	}

	function DownloadTree($localRoot) {
		return CkFtp2_DownloadTree($this->_cPtr,$localRoot);
	}

	function DeleteTree() {
		return CkFtp2_DeleteTree($this->_cPtr);
	}

	function GetIsSymbolicLink($index) {
		return CkFtp2_GetIsSymbolicLink($this->_cPtr,$index);
	}

	function createPlan($localDir) {
		return CkFtp2_createPlan($this->_cPtr,$localDir);
	}

	function PutPlan($planUtf8,$planLogFilename) {
		return CkFtp2_PutPlan($this->_cPtr,$planUtf8,$planLogFilename);
	}

	function GetSizeByName($filname) {
		return CkFtp2_GetSizeByName($this->_cPtr,$filname);
	}

	function ClearSessionLog() {
		CkFtp2_ClearSessionLog($this->_cPtr);
	}

	function SetTypeBinary() {
		return CkFtp2_SetTypeBinary($this->_cPtr);
	}

	function SetTypeAscii() {
		return CkFtp2_SetTypeAscii($this->_cPtr);
	}

	function Site($params) {
		return CkFtp2_Site($this->_cPtr,$params);
	}

	function Quote($cmd) {
		return CkFtp2_Quote($this->_cPtr,$cmd);
	}

	function get_ReadTimeout() {
		return CkFtp2_get_ReadTimeout($this->_cPtr);
	}

	function put_ReadTimeout($newVal) {
		CkFtp2_put_ReadTimeout($this->_cPtr,$newVal);
	}

	function get_ConnectTimeout() {
		return CkFtp2_get_ConnectTimeout($this->_cPtr);
	}

	function put_ConnectTimeout($newVal) {
		CkFtp2_put_ConnectTimeout($this->_cPtr,$newVal);
	}

	function get_ProxyPassword($str) {
		CkFtp2_get_ProxyPassword($this->_cPtr,$str);
	}

	function proxyPassword() {
		return CkFtp2_proxyPassword($this->_cPtr);
	}

	function put_ProxyPassword($newVal) {
		CkFtp2_put_ProxyPassword($this->_cPtr,$newVal);
	}

	function get_ProxyUsername($str) {
		CkFtp2_get_ProxyUsername($this->_cPtr,$str);
	}

	function proxyUsername() {
		return CkFtp2_proxyUsername($this->_cPtr);
	}

	function put_ProxyUsername($newVal) {
		CkFtp2_put_ProxyUsername($this->_cPtr,$newVal);
	}

	function GetCreateTimeByName($filename,$sysTime) {
		return CkFtp2_GetCreateTimeByName($this->_cPtr,$filename,$sysTime);
	}

	function GetLastAccessTimeByName($filename,$sysTime) {
		return CkFtp2_GetLastAccessTimeByName($this->_cPtr,$filename,$sysTime);
	}

	function GetLastModifiedTimeByName($filename,$sysTime) {
		return CkFtp2_GetLastModifiedTimeByName($this->_cPtr,$filename,$sysTime);
	}

	function getSizeStr($index) {
		return CkFtp2_getSizeStr($this->_cPtr,$index);
	}

	function Noop() {
		return CkFtp2_Noop($this->_cPtr);
	}

	function SetOldestDate($oldestDateTime) {
		CkFtp2_SetOldestDate($this->_cPtr,$oldestDateTime);
	}

	function SyncLocalTree($localRoot,$mode) {
		return CkFtp2_SyncLocalTree($this->_cPtr,$localRoot,$mode);
	}

	function SyncRemoteTree($localRoot,$mode) {
		return CkFtp2_SyncRemoteTree($this->_cPtr,$localRoot,$mode);
	}

	function ConvertToTls() {
		return CkFtp2_ConvertToTls($this->_cPtr);
	}

	function getSizeStrByName($filename) {
		return CkFtp2_getSizeStrByName($this->_cPtr,$filename);
	}

	function SetRemoteFileDateTime($dt,$remoteFilename) {
		return CkFtp2_SetRemoteFileDateTime($this->_cPtr,$dt,$remoteFilename);
	}

	function get_SendBufferSize() {
		return CkFtp2_get_SendBufferSize($this->_cPtr);
	}

	function put_SendBufferSize($newVal) {
		CkFtp2_put_SendBufferSize($this->_cPtr,$newVal);
	}

	function get_UseEpsv() {
		return CkFtp2_get_UseEpsv($this->_cPtr);
	}

	function put_UseEpsv($newVal) {
		CkFtp2_put_UseEpsv($this->_cPtr,$newVal);
	}

	function get_ForcePortIpAddress($str) {
		CkFtp2_get_ForcePortIpAddress($this->_cPtr,$str);
	}

	function forcePortIpAddress() {
		return CkFtp2_forcePortIpAddress($this->_cPtr);
	}

	function put_ForcePortIpAddress($newVal) {
		CkFtp2_put_ForcePortIpAddress($this->_cPtr,$newVal);
	}

	function nlstXml($pattern) {
		return CkFtp2_nlstXml($this->_cPtr,$pattern);
	}

	function get_SocksVersion() {
		return CkFtp2_get_SocksVersion($this->_cPtr);
	}

	function put_SocksVersion($newVal) {
		CkFtp2_put_SocksVersion($this->_cPtr,$newVal);
	}

	function get_SocksPort() {
		return CkFtp2_get_SocksPort($this->_cPtr);
	}

	function put_SocksPort($newVal) {
		CkFtp2_put_SocksPort($this->_cPtr,$newVal);
	}

	function get_SocksUsername($str) {
		CkFtp2_get_SocksUsername($this->_cPtr,$str);
	}

	function socksUsername() {
		return CkFtp2_socksUsername($this->_cPtr);
	}

	function put_SocksUsername($newVal) {
		CkFtp2_put_SocksUsername($this->_cPtr,$newVal);
	}

	function get_SocksPassword($str) {
		CkFtp2_get_SocksPassword($this->_cPtr,$str);
	}

	function socksPassword() {
		return CkFtp2_socksPassword($this->_cPtr);
	}

	function put_SocksPassword($newVal) {
		CkFtp2_put_SocksPassword($this->_cPtr,$newVal);
	}

	function get_SocksHostname($str) {
		CkFtp2_get_SocksHostname($this->_cPtr,$str);
	}

	function socksHostname() {
		return CkFtp2_socksHostname($this->_cPtr);
	}

	function put_SocksHostname($newVal) {
		CkFtp2_put_SocksHostname($this->_cPtr,$newVal);
	}

	function get_Greeting($str) {
		CkFtp2_get_Greeting($this->_cPtr,$str);
	}

	function greeting() {
		return CkFtp2_greeting($this->_cPtr);
	}

	function SetSslClientCertPfx($pfxFilename,$pfxPassword,$certSubjectCN) {
		return CkFtp2_SetSslClientCertPfx($this->_cPtr,$pfxFilename,$pfxPassword,$certSubjectCN);
	}

	function get_VerboseLogging() {
		return CkFtp2_get_VerboseLogging($this->_cPtr);
	}

	function put_VerboseLogging($newVal) {
		CkFtp2_put_VerboseLogging($this->_cPtr,$newVal);
	}

	function get_SslProtocol($str) {
		CkFtp2_get_SslProtocol($this->_cPtr,$str);
	}

	function sslProtocol() {
		return CkFtp2_sslProtocol($this->_cPtr);
	}

	function put_SslProtocol($newVal) {
		CkFtp2_put_SslProtocol($this->_cPtr,$newVal);
	}

	function get_AutoGetSizeForProgress() {
		return CkFtp2_get_AutoGetSizeForProgress($this->_cPtr);
	}

	function put_AutoGetSizeForProgress($newVal) {
		CkFtp2_put_AutoGetSizeForProgress($this->_cPtr,$newVal);
	}

	function get_SyncPreview($str) {
		CkFtp2_get_SyncPreview($this->_cPtr,$str);
	}

	function syncPreview() {
		return CkFtp2_syncPreview($this->_cPtr);
	}

	function SyncRemoteTree2($localRoot,$mode,$bDescend,$bPreviewOnly) {
		return CkFtp2_SyncRemoteTree2($this->_cPtr,$localRoot,$mode,$bDescend,$bPreviewOnly);
	}

	function get_AutoFix() {
		return CkFtp2_get_AutoFix($this->_cPtr);
	}

	function put_AutoFix($newVal) {
		CkFtp2_put_AutoFix($this->_cPtr,$newVal);
	}

	function get_ClientIpAddress($str) {
		CkFtp2_get_ClientIpAddress($this->_cPtr,$str);
	}

	function clientIpAddress() {
		return CkFtp2_clientIpAddress($this->_cPtr);
	}

	function put_ClientIpAddress($newVal) {
		CkFtp2_put_ClientIpAddress($this->_cPtr,$newVal);
	}

	function SetSslClientCertPem($pemDataOrFilename,$pemPassword) {
		return CkFtp2_SetSslClientCertPem($this->_cPtr,$pemDataOrFilename,$pemPassword);
	}

	function get_PreferNlst() {
		return CkFtp2_get_PreferNlst($this->_cPtr);
	}

	function put_PreferNlst($newVal) {
		CkFtp2_put_PreferNlst($this->_cPtr,$newVal);
	}

	function get_DebugLogFilePath($str) {
		CkFtp2_get_DebugLogFilePath($this->_cPtr,$str);
	}

	function debugLogFilePath() {
		return CkFtp2_debugLogFilePath($this->_cPtr);
	}

	function put_DebugLogFilePath($newVal) {
		CkFtp2_put_DebugLogFilePath($this->_cPtr,$newVal);
	}

	function GetLastModDtByName($filename) {
		$r=CkFtp2_GetLastModDtByName($this->_cPtr,$filename);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkDateTime($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function GetLastAccessDtByName($filename) {
		$r=CkFtp2_GetLastAccessDtByName($this->_cPtr,$filename);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkDateTime($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function GetCreateDtByName($filename) {
		$r=CkFtp2_GetCreateDtByName($this->_cPtr,$filename);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkDateTime($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function GetCreateDt($index) {
		$r=CkFtp2_GetCreateDt($this->_cPtr,$index);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkDateTime($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function GetLastModDt($index) {
		$r=CkFtp2_GetLastModDt($this->_cPtr,$index);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkDateTime($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function GetLastAccessDt($index) {
		$r=CkFtp2_GetLastAccessDt($this->_cPtr,$index);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkDateTime($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function SetRemoteFileDt($dt,$remoteFilename) {
		return CkFtp2_SetRemoteFileDt($this->_cPtr,$dt,$remoteFilename);
	}

	function ConnectOnly() {
		return CkFtp2_ConnectOnly($this->_cPtr);
	}

	function LoginAfterConnectOnly() {
		return CkFtp2_LoginAfterConnectOnly($this->_cPtr);
	}
}


?>