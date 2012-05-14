<?php
class CkSFtp {

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
		if (is_resource($res) && get_resource_type($res) === '_p_CkSFtp') {
			$this->_cPtr=$res;
			return;
		}
		$this->_cPtr=new_CkSFtp();
	}

	function get_Utf8() {
		return CkSFtp_get_Utf8($this->_cPtr);
	}

	function put_Utf8($b) {
		CkSFtp_put_Utf8($this->_cPtr,$b);
	}

	function SaveLastError($filename) {
		return CkSFtp_SaveLastError($this->_cPtr,$filename);
	}

	function lastErrorText() {
		return CkSFtp_lastErrorText($this->_cPtr);
	}

	function lastErrorXml() {
		return CkSFtp_lastErrorXml($this->_cPtr);
	}

	function lastErrorHtml() {
		return CkSFtp_lastErrorHtml($this->_cPtr);
	}

	function UnlockComponent($unlockCode) {
		return CkSFtp_UnlockComponent($this->_cPtr,$unlockCode);
	}

	function get_ConnectTimeoutMs() {
		return CkSFtp_get_ConnectTimeoutMs($this->_cPtr);
	}

	function put_ConnectTimeoutMs($newVal) {
		CkSFtp_put_ConnectTimeoutMs($this->_cPtr,$newVal);
	}

	function get_DisconnectCode() {
		return CkSFtp_get_DisconnectCode($this->_cPtr);
	}

	function get_InitializeFailCode() {
		return CkSFtp_get_InitializeFailCode($this->_cPtr);
	}

	function get_MaxPacketSize() {
		return CkSFtp_get_MaxPacketSize($this->_cPtr);
	}

	function put_MaxPacketSize($newVal) {
		CkSFtp_put_MaxPacketSize($this->_cPtr,$newVal);
	}

	function get_IdleTimeoutMs() {
		return CkSFtp_get_IdleTimeoutMs($this->_cPtr);
	}

	function put_IdleTimeoutMs($newVal) {
		CkSFtp_put_IdleTimeoutMs($this->_cPtr,$newVal);
	}

	function get_InitializeFailReason($str) {
		CkSFtp_get_InitializeFailReason($this->_cPtr,$str);
	}

	function initializeFailReason() {
		return CkSFtp_initializeFailReason($this->_cPtr);
	}

	function get_DisconnectReason($str) {
		CkSFtp_get_DisconnectReason($this->_cPtr,$str);
	}

	function disconnectReason() {
		return CkSFtp_disconnectReason($this->_cPtr);
	}

	function get_Version($str) {
		CkSFtp_get_Version($this->_cPtr,$str);
	}

	function version() {
		return CkSFtp_version($this->_cPtr);
	}

	function get_IsConnected() {
		return CkSFtp_get_IsConnected($this->_cPtr);
	}

	function get_KeepSessionLog() {
		return CkSFtp_get_KeepSessionLog($this->_cPtr);
	}

	function put_KeepSessionLog($newVal) {
		CkSFtp_put_KeepSessionLog($this->_cPtr,$newVal);
	}

	function get_SessionLog($str) {
		CkSFtp_get_SessionLog($this->_cPtr,$str);
	}

	function sessionLog() {
		return CkSFtp_sessionLog($this->_cPtr);
	}

	function Disconnect() {
		CkSFtp_Disconnect($this->_cPtr);
	}

	function Connect($hostname,$port) {
		return CkSFtp_Connect($this->_cPtr,$hostname,$port);
	}

	function AuthenticatePk($username,$privateKey) {
		return CkSFtp_AuthenticatePk($this->_cPtr,$username,$privateKey);
	}

	function AuthenticatePw($login,$password) {
		return CkSFtp_AuthenticatePw($this->_cPtr,$login,$password);
	}

	function InitializeSftp() {
		return CkSFtp_InitializeSftp($this->_cPtr);
	}

	function openFile($filename,$access,$createDisp) {
		return CkSFtp_openFile($this->_cPtr,$filename,$access,$createDisp);
	}

	function openDir($path) {
		return CkSFtp_openDir($this->_cPtr,$path);
	}

	function CloseHandle($handle) {
		return CkSFtp_CloseHandle($this->_cPtr,$handle);
	}

	function GetFileSize32($filenameOrHandle,$bFollowLinks,$bIsHandle) {
		return CkSFtp_GetFileSize32($this->_cPtr,$filenameOrHandle,$bFollowLinks,$bIsHandle);
	}

	function getFileSizeStr($filenameOrHandle,$bFollowLinks,$bIsHandle) {
		return CkSFtp_getFileSizeStr($this->_cPtr,$filenameOrHandle,$bFollowLinks,$bIsHandle);
	}

	function GetFileLastAccess($filenameOrHandle,$bFollowLinks,$bIsHandle,$sysTime) {
		return CkSFtp_GetFileLastAccess($this->_cPtr,$filenameOrHandle,$bFollowLinks,$bIsHandle,$sysTime);
	}

	function GetFileLastModified($filenameOrHandle,$bFollowLinks,$bIsHandle,$sysTime) {
		return CkSFtp_GetFileLastModified($this->_cPtr,$filenameOrHandle,$bFollowLinks,$bIsHandle,$sysTime);
	}

	function GetFileCreateTime($filenameOrHandle,$bFollowLinks,$bIsHandle,$sysTime) {
		return CkSFtp_GetFileCreateTime($this->_cPtr,$filenameOrHandle,$bFollowLinks,$bIsHandle,$sysTime);
	}

	function getFileOwner($filenameOrHandle,$bFollowLinks,$bIsHandle) {
		return CkSFtp_getFileOwner($this->_cPtr,$filenameOrHandle,$bFollowLinks,$bIsHandle);
	}

	function getFileGroup($filenameOrHandle,$bFollowLinks,$bIsHandle) {
		return CkSFtp_getFileGroup($this->_cPtr,$filenameOrHandle,$bFollowLinks,$bIsHandle);
	}

	function GetFilePermissions($filenameOrHandle,$bFollowLinks,$bIsHandle) {
		return CkSFtp_GetFilePermissions($this->_cPtr,$filenameOrHandle,$bFollowLinks,$bIsHandle);
	}

	function add64($n1,$n2) {
		return CkSFtp_add64($this->_cPtr,$n1,$n2);
	}

	function ReadFileBytes32($handle,$offset,$numBytes,$outBytes) {
		return CkSFtp_ReadFileBytes32($this->_cPtr,$handle,$offset,$numBytes,$outBytes);
	}

	function ReadFileBytes64s($handle,$offset64,$numBytes,$outBytes) {
		return CkSFtp_ReadFileBytes64s($this->_cPtr,$handle,$offset64,$numBytes,$outBytes);
	}

	function readFileText64s($handle,$offset64,$numBytes,$charset) {
		return CkSFtp_readFileText64s($this->_cPtr,$handle,$offset64,$numBytes,$charset);
	}

	function readFileText32($handle,$offset32,$numBytes,$charset) {
		return CkSFtp_readFileText32($this->_cPtr,$handle,$offset32,$numBytes,$charset);
	}

	function DownloadFile($handle,$toFilename) {
		return CkSFtp_DownloadFile($this->_cPtr,$handle,$toFilename);
	}

	function Eof($handle) {
		return CkSFtp_Eof($this->_cPtr,$handle);
	}

	function ReadFileBytes($handle,$numBytes,$outBytes) {
		return CkSFtp_ReadFileBytes($this->_cPtr,$handle,$numBytes,$outBytes);
	}

	function readFileText($handle,$numBytes,$charset) {
		return CkSFtp_readFileText($this->_cPtr,$handle,$numBytes,$charset);
	}

	function LastReadFailed($handle) {
		return CkSFtp_LastReadFailed($this->_cPtr,$handle);
	}

	function LastReadNumBytes($handle) {
		return CkSFtp_LastReadNumBytes($this->_cPtr,$handle);
	}

	function WriteFileBytes($handle,$data) {
		return CkSFtp_WriteFileBytes($this->_cPtr,$handle,$data);
	}

	function WriteFileBytes32($handle,$offset,$data) {
		return CkSFtp_WriteFileBytes32($this->_cPtr,$handle,$offset,$data);
	}

	function WriteFileBytes64s($handle,$offset64,$data) {
		return CkSFtp_WriteFileBytes64s($this->_cPtr,$handle,$offset64,$data);
	}

	function WriteFileText($handle,$charset,$textData) {
		return CkSFtp_WriteFileText($this->_cPtr,$handle,$charset,$textData);
	}

	function WriteFileText32($handle,$offset32,$charset,$textData) {
		return CkSFtp_WriteFileText32($this->_cPtr,$handle,$offset32,$charset,$textData);
	}

	function WriteFileText64s($handle,$offset64,$charset,$textData) {
		return CkSFtp_WriteFileText64s($this->_cPtr,$handle,$offset64,$charset,$textData);
	}

	function UploadFile($handle,$fromFilename) {
		return CkSFtp_UploadFile($this->_cPtr,$handle,$fromFilename);
	}

	function realPath($originalPath,$composePath) {
		return CkSFtp_realPath($this->_cPtr,$originalPath,$composePath);
	}

	function ReadDir($handle) {
		$r=CkSFtp_ReadDir($this->_cPtr,$handle);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkSFtpDir($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function RemoveFile($filename) {
		return CkSFtp_RemoveFile($this->_cPtr,$filename);
	}

	function RemoveDir($path) {
		return CkSFtp_RemoveDir($this->_cPtr,$path);
	}

	function RenameFileOrDir($oldPath,$newPath) {
		return CkSFtp_RenameFileOrDir($this->_cPtr,$oldPath,$newPath);
	}

	function CreateDir($path) {
		return CkSFtp_CreateDir($this->_cPtr,$path);
	}

	function SetCreateTime($pathOrHandle,$bIsHandle,$createTime) {
		return CkSFtp_SetCreateTime($this->_cPtr,$pathOrHandle,$bIsHandle,$createTime);
	}

	function SetLastModifiedTime($pathOrHandle,$bIsHandle,$createTime) {
		return CkSFtp_SetLastModifiedTime($this->_cPtr,$pathOrHandle,$bIsHandle,$createTime);
	}

	function SetLastAccessTime($pathOrHandle,$bIsHandle,$createTime) {
		return CkSFtp_SetLastAccessTime($this->_cPtr,$pathOrHandle,$bIsHandle,$createTime);
	}

	function SetOwnerAndGroup($pathOrHandle,$bIsHandle,$owner,$group) {
		return CkSFtp_SetOwnerAndGroup($this->_cPtr,$pathOrHandle,$bIsHandle,$owner,$group);
	}

	function SetPermissions($pathOrHandle,$bIsHandle,$perm) {
		return CkSFtp_SetPermissions($this->_cPtr,$pathOrHandle,$bIsHandle,$perm);
	}

	function CopyFileAttr($localFilename,$remoteFilenameOrHandle,$bIsHandle) {
		return CkSFtp_CopyFileAttr($this->_cPtr,$localFilename,$remoteFilenameOrHandle,$bIsHandle);
	}

	function get_ProtocolVersion() {
		return CkSFtp_get_ProtocolVersion($this->_cPtr);
	}

	function get_EnableCache() {
		return CkSFtp_get_EnableCache($this->_cPtr);
	}

	function put_EnableCache($newVal) {
		CkSFtp_put_EnableCache($this->_cPtr,$newVal);
	}

	function ClearCache() {
		CkSFtp_ClearCache($this->_cPtr);
	}

	function DownloadFileByName($remoteFilePath,$localFilePath) {
		return CkSFtp_DownloadFileByName($this->_cPtr,$remoteFilePath,$localFilePath);
	}

	function get_HeartbeatMs() {
		return CkSFtp_get_HeartbeatMs($this->_cPtr);
	}

	function put_HeartbeatMs($newVal) {
		CkSFtp_put_HeartbeatMs($this->_cPtr,$newVal);
	}

	function UploadFileByName($remoteFilePath,$localFilePath) {
		return CkSFtp_UploadFileByName($this->_cPtr,$remoteFilePath,$localFilePath);
	}

	function ResumeUploadFileByName($remoteFilePath,$localFilePath) {
		return CkSFtp_ResumeUploadFileByName($this->_cPtr,$remoteFilePath,$localFilePath);
	}

	function ResumeDownloadFileByName($remoteFilePath,$localFilePath) {
		return CkSFtp_ResumeDownloadFileByName($this->_cPtr,$remoteFilePath,$localFilePath);
	}

	function get_VerboseLogging() {
		return CkSFtp_get_VerboseLogging($this->_cPtr);
	}

	function put_VerboseLogging($newVal) {
		CkSFtp_put_VerboseLogging($this->_cPtr,$newVal);
	}

	function get_FilenameCharset($str) {
		CkSFtp_get_FilenameCharset($this->_cPtr,$str);
	}

	function filenameCharset() {
		return CkSFtp_filenameCharset($this->_cPtr);
	}

	function put_FilenameCharset($newVal) {
		CkSFtp_put_FilenameCharset($this->_cPtr,$newVal);
	}

	function ClearSessionLog() {
		CkSFtp_ClearSessionLog($this->_cPtr);
	}

	function get_ForceV3() {
		return CkSFtp_get_ForceV3($this->_cPtr);
	}

	function put_ForceV3($newVal) {
		CkSFtp_put_ForceV3($this->_cPtr,$newVal);
	}

	function get_UtcMode() {
		return CkSFtp_get_UtcMode($this->_cPtr);
	}

	function put_UtcMode($newVal) {
		CkSFtp_put_UtcMode($this->_cPtr,$newVal);
	}

	function get_PreserveDate() {
		return CkSFtp_get_PreserveDate($this->_cPtr);
	}

	function put_PreserveDate($newVal) {
		CkSFtp_put_PreserveDate($this->_cPtr,$newVal);
	}

	function get_ClientIdentifier($str) {
		CkSFtp_get_ClientIdentifier($this->_cPtr,$str);
	}

	function clientIdentifier() {
		return CkSFtp_clientIdentifier($this->_cPtr);
	}

	function put_ClientIdentifier($newVal) {
		CkSFtp_put_ClientIdentifier($this->_cPtr,$newVal);
	}

	function get_HostKeyFingerprint($str) {
		CkSFtp_get_HostKeyFingerprint($this->_cPtr,$str);
	}

	function hostKeyFingerprint() {
		return CkSFtp_hostKeyFingerprint($this->_cPtr);
	}

	function get_SocksHostname($str) {
		CkSFtp_get_SocksHostname($this->_cPtr,$str);
	}

	function socksHostname() {
		return CkSFtp_socksHostname($this->_cPtr);
	}

	function put_SocksHostname($newVal) {
		CkSFtp_put_SocksHostname($this->_cPtr,$newVal);
	}

	function get_SocksUsername($str) {
		CkSFtp_get_SocksUsername($this->_cPtr,$str);
	}

	function socksUsername() {
		return CkSFtp_socksUsername($this->_cPtr);
	}

	function put_SocksUsername($newVal) {
		CkSFtp_put_SocksUsername($this->_cPtr,$newVal);
	}

	function get_SocksPassword($str) {
		CkSFtp_get_SocksPassword($this->_cPtr,$str);
	}

	function socksPassword() {
		return CkSFtp_socksPassword($this->_cPtr);
	}

	function put_SocksPassword($newVal) {
		CkSFtp_put_SocksPassword($this->_cPtr,$newVal);
	}

	function get_SocksPort() {
		return CkSFtp_get_SocksPort($this->_cPtr);
	}

	function put_SocksPort($newVal) {
		CkSFtp_put_SocksPort($this->_cPtr,$newVal);
	}

	function get_SocksVersion() {
		return CkSFtp_get_SocksVersion($this->_cPtr);
	}

	function put_SocksVersion($newVal) {
		CkSFtp_put_SocksVersion($this->_cPtr,$newVal);
	}

	function get_HttpProxyAuthMethod($str) {
		CkSFtp_get_HttpProxyAuthMethod($this->_cPtr,$str);
	}

	function httpProxyAuthMethod() {
		return CkSFtp_httpProxyAuthMethod($this->_cPtr);
	}

	function put_HttpProxyAuthMethod($newVal) {
		CkSFtp_put_HttpProxyAuthMethod($this->_cPtr,$newVal);
	}

	function get_HttpProxyHostname($str) {
		CkSFtp_get_HttpProxyHostname($this->_cPtr,$str);
	}

	function httpProxyHostname() {
		return CkSFtp_httpProxyHostname($this->_cPtr);
	}

	function put_HttpProxyHostname($newVal) {
		CkSFtp_put_HttpProxyHostname($this->_cPtr,$newVal);
	}

	function get_HttpProxyPassword($str) {
		CkSFtp_get_HttpProxyPassword($this->_cPtr,$str);
	}

	function httpProxyPassword() {
		return CkSFtp_httpProxyPassword($this->_cPtr);
	}

	function put_HttpProxyPassword($newVal) {
		CkSFtp_put_HttpProxyPassword($this->_cPtr,$newVal);
	}

	function get_HttpProxyPort() {
		return CkSFtp_get_HttpProxyPort($this->_cPtr);
	}

	function put_HttpProxyPort($newVal) {
		CkSFtp_put_HttpProxyPort($this->_cPtr,$newVal);
	}

	function get_HttpProxyUsername($str) {
		CkSFtp_get_HttpProxyUsername($this->_cPtr,$str);
	}

	function httpProxyUsername() {
		return CkSFtp_httpProxyUsername($this->_cPtr);
	}

	function put_HttpProxyUsername($newVal) {
		CkSFtp_put_HttpProxyUsername($this->_cPtr,$newVal);
	}

	function get_TcpNoDelay() {
		return CkSFtp_get_TcpNoDelay($this->_cPtr);
	}

	function put_TcpNoDelay($newVal) {
		CkSFtp_put_TcpNoDelay($this->_cPtr,$newVal);
	}

	function get_AccumulateBuffer($data) {
		CkSFtp_get_AccumulateBuffer($this->_cPtr,$data);
	}

	function ClearAccumulateBuffer() {
		CkSFtp_ClearAccumulateBuffer($this->_cPtr);
	}

	function AccumulateBytes($handle,$maxBytes) {
		return CkSFtp_AccumulateBytes($this->_cPtr,$handle,$maxBytes);
	}

	function AuthenticatePwPk($username,$password,$privateKey) {
		return CkSFtp_AuthenticatePwPk($this->_cPtr,$username,$password,$privateKey);
	}

	function get_PasswordChangeRequested() {
		return CkSFtp_get_PasswordChangeRequested($this->_cPtr);
	}

	function get_DebugLogFilePath($str) {
		CkSFtp_get_DebugLogFilePath($this->_cPtr,$str);
	}

	function debugLogFilePath() {
		return CkSFtp_debugLogFilePath($this->_cPtr);
	}

	function put_DebugLogFilePath($newVal) {
		CkSFtp_put_DebugLogFilePath($this->_cPtr,$newVal);
	}

	function get_ClientIpAddress($str) {
		CkSFtp_get_ClientIpAddress($this->_cPtr,$str);
	}

	function clientIpAddress() {
		return CkSFtp_clientIpAddress($this->_cPtr);
	}

	function put_ClientIpAddress($newVal) {
		CkSFtp_put_ClientIpAddress($this->_cPtr,$newVal);
	}

	function get_ForceCipher($str) {
		CkSFtp_get_ForceCipher($this->_cPtr,$str);
	}

	function forceCipher() {
		return CkSFtp_forceCipher($this->_cPtr);
	}

	function put_ForceCipher($newVal) {
		CkSFtp_put_ForceCipher($this->_cPtr,$newVal);
	}

	function GetFileCreateDt($filenameOrHandle,$bFollowLinks,$bIsHandle) {
		$r=CkSFtp_GetFileCreateDt($this->_cPtr,$filenameOrHandle,$bFollowLinks,$bIsHandle);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkDateTime($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function GetFileLastModifiedDt($filenameOrHandle,$bFollowLinks,$bIsHandle) {
		$r=CkSFtp_GetFileLastModifiedDt($this->_cPtr,$filenameOrHandle,$bFollowLinks,$bIsHandle);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkDateTime($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function GetFileLastAccessDt($filenameOrHandle,$bFollowLinks,$bIsHandle) {
		$r=CkSFtp_GetFileLastAccessDt($this->_cPtr,$filenameOrHandle,$bFollowLinks,$bIsHandle);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkDateTime($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function SetCreateDt($pathOrHandle,$bIsHandle,$createTime) {
		return CkSFtp_SetCreateDt($this->_cPtr,$pathOrHandle,$bIsHandle,$createTime);
	}

	function SetLastModifiedDt($pathOrHandle,$bIsHandle,$createTime) {
		return CkSFtp_SetLastModifiedDt($this->_cPtr,$pathOrHandle,$bIsHandle,$createTime);
	}

	function SetLastAccessDt($pathOrHandle,$bIsHandle,$createTime) {
		return CkSFtp_SetLastAccessDt($this->_cPtr,$pathOrHandle,$bIsHandle,$createTime);
	}
}


?>