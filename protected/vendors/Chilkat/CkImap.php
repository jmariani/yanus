<?php
class CkImap {

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
		if (is_resource($res) && get_resource_type($res) === '_p_CkImap') {
			$this->_cPtr=$res;
			return;
		}
		$this->_cPtr=new_CkImap();
	}

	function get_Utf8() {
		return CkImap_get_Utf8($this->_cPtr);
	}

	function put_Utf8($b) {
		CkImap_put_Utf8($this->_cPtr,$b);
	}

	function get_LastAppendedMime($str) {
		CkImap_get_LastAppendedMime($this->_cPtr,$str);
	}

	function lastAppendedMime() {
		return CkImap_lastAppendedMime($this->_cPtr);
	}

	function get_LastIntermediateResponse($str) {
		CkImap_get_LastIntermediateResponse($this->_cPtr,$str);
	}

	function lastIntermediateResponse() {
		return CkImap_lastIntermediateResponse($this->_cPtr);
	}

	function get_LastResponse($str) {
		CkImap_get_LastResponse($this->_cPtr,$str);
	}

	function lastResponse() {
		return CkImap_lastResponse($this->_cPtr);
	}

	function get_LastCommand($str) {
		CkImap_get_LastCommand($this->_cPtr,$str);
	}

	function lastCommand() {
		return CkImap_lastCommand($this->_cPtr);
	}

	function get_Version($str) {
		CkImap_get_Version($this->_cPtr,$str);
	}

	function version() {
		return CkImap_version($this->_cPtr);
	}

	function AppendMimeWithFlags($mailbox,$mimeText,$seen,$flagged,$answered,$draft) {
		return CkImap_AppendMimeWithFlags($this->_cPtr,$mailbox,$mimeText,$seen,$flagged,$answered,$draft);
	}

	function Subscribe($mailbox) {
		return CkImap_Subscribe($this->_cPtr,$mailbox);
	}

	function Unsubscribe($mailbox) {
		return CkImap_Unsubscribe($this->_cPtr,$mailbox);
	}

	function fetchSingleHeaderAsMime($msgId,$bUID) {
		return CkImap_fetchSingleHeaderAsMime($this->_cPtr,$msgId,$bUID);
	}

	function AppendMimeWithDate($mailbox,$mimeText,$internalDate) {
		return CkImap_AppendMimeWithDate($this->_cPtr,$mailbox,$mimeText,$internalDate);
	}

	function get_SelectedMailbox($str) {
		CkImap_get_SelectedMailbox($this->_cPtr,$str);
	}

	function selectedMailbox() {
		return CkImap_selectedMailbox($this->_cPtr);
	}

	function get_AppendUid() {
		return CkImap_get_AppendUid($this->_cPtr);
	}

	function get_AuthzId($str) {
		CkImap_get_AuthzId($this->_cPtr,$str);
	}

	function authzId() {
		return CkImap_authzId($this->_cPtr);
	}

	function put_AuthzId($newVal) {
		CkImap_put_AuthzId($this->_cPtr,$newVal);
	}

	function get_SendBufferSize() {
		return CkImap_get_SendBufferSize($this->_cPtr);
	}

	function put_SendBufferSize($newVal) {
		CkImap_put_SendBufferSize($this->_cPtr,$newVal);
	}

	function SshTunnel($sshServerHostname,$sshServerPort) {
		return CkImap_SshTunnel($this->_cPtr,$sshServerHostname,$sshServerPort);
	}

	function SshAuthenticatePw($sshLogin,$sshPassword) {
		return CkImap_SshAuthenticatePw($this->_cPtr,$sshLogin,$sshPassword);
	}

	function SshAuthenticatePk($sshLogin,$privateKey) {
		return CkImap_SshAuthenticatePk($this->_cPtr,$sshLogin,$privateKey);
	}

	function Noop() {
		return CkImap_Noop($this->_cPtr);
	}

	function get_SocksHostname($str) {
		CkImap_get_SocksHostname($this->_cPtr,$str);
	}

	function socksHostname() {
		return CkImap_socksHostname($this->_cPtr);
	}

	function put_SocksHostname($newVal) {
		CkImap_put_SocksHostname($this->_cPtr,$newVal);
	}

	function get_SocksUsername($str) {
		CkImap_get_SocksUsername($this->_cPtr,$str);
	}

	function socksUsername() {
		return CkImap_socksUsername($this->_cPtr);
	}

	function put_SocksUsername($newVal) {
		CkImap_put_SocksUsername($this->_cPtr,$newVal);
	}

	function get_SocksPassword($str) {
		CkImap_get_SocksPassword($this->_cPtr,$str);
	}

	function socksPassword() {
		return CkImap_socksPassword($this->_cPtr);
	}

	function put_SocksPassword($newVal) {
		CkImap_put_SocksPassword($this->_cPtr,$newVal);
	}

	function get_SocksPort() {
		return CkImap_get_SocksPort($this->_cPtr);
	}

	function put_SocksPort($newVal) {
		CkImap_put_SocksPort($this->_cPtr,$newVal);
	}

	function get_SocksVersion() {
		return CkImap_get_SocksVersion($this->_cPtr);
	}

	function put_SocksVersion($newVal) {
		CkImap_put_SocksVersion($this->_cPtr,$newVal);
	}

	function SetSslClientCertPfx($pfxFilename,$pfxPassword,$certSubjectCN) {
		return CkImap_SetSslClientCertPfx($this->_cPtr,$pfxFilename,$pfxPassword,$certSubjectCN);
	}

	function get_StartTls() {
		return CkImap_get_StartTls($this->_cPtr);
	}

	function put_StartTls($newVal) {
		CkImap_put_StartTls($this->_cPtr,$newVal);
	}

	function get_SslProtocol($str) {
		CkImap_get_SslProtocol($this->_cPtr,$str);
	}

	function sslProtocol() {
		return CkImap_sslProtocol($this->_cPtr);
	}

	function put_SslProtocol($newVal) {
		CkImap_put_SslProtocol($this->_cPtr,$newVal);
	}

	function get_HttpProxyUsername($str) {
		CkImap_get_HttpProxyUsername($this->_cPtr,$str);
	}

	function httpProxyUsername() {
		return CkImap_httpProxyUsername($this->_cPtr);
	}

	function put_HttpProxyUsername($newVal) {
		CkImap_put_HttpProxyUsername($this->_cPtr,$newVal);
	}

	function get_HttpProxyPassword($str) {
		CkImap_get_HttpProxyPassword($this->_cPtr,$str);
	}

	function httpProxyPassword() {
		return CkImap_httpProxyPassword($this->_cPtr);
	}

	function put_HttpProxyPassword($newVal) {
		CkImap_put_HttpProxyPassword($this->_cPtr,$newVal);
	}

	function get_HttpProxyAuthMethod($str) {
		CkImap_get_HttpProxyAuthMethod($this->_cPtr,$str);
	}

	function httpProxyAuthMethod() {
		return CkImap_httpProxyAuthMethod($this->_cPtr);
	}

	function put_HttpProxyAuthMethod($newVal) {
		CkImap_put_HttpProxyAuthMethod($this->_cPtr,$newVal);
	}

	function get_HttpProxyHostname($str) {
		CkImap_get_HttpProxyHostname($this->_cPtr,$str);
	}

	function httpProxyHostname() {
		return CkImap_httpProxyHostname($this->_cPtr);
	}

	function put_HttpProxyHostname($newVal) {
		CkImap_put_HttpProxyHostname($this->_cPtr,$newVal);
	}

	function get_HttpProxyPort() {
		return CkImap_get_HttpProxyPort($this->_cPtr);
	}

	function put_HttpProxyPort($newVal) {
		CkImap_put_HttpProxyPort($this->_cPtr,$newVal);
	}

	function get_UidNext() {
		return CkImap_get_UidNext($this->_cPtr);
	}

	function get_AutoFix() {
		return CkImap_get_AutoFix($this->_cPtr);
	}

	function put_AutoFix($newVal) {
		CkImap_put_AutoFix($this->_cPtr,$newVal);
	}

	function AddPfxSourceData($pfxData,$password) {
		return CkImap_AddPfxSourceData($this->_cPtr,$pfxData,$password);
	}

	function AddPfxSourceFile($pfxFilePath,$password) {
		return CkImap_AddPfxSourceFile($this->_cPtr,$pfxFilePath,$password);
	}

	function SetSslClientCertPem($pemDataOrFilename,$pemPassword) {
		return CkImap_SetSslClientCertPem($this->_cPtr,$pemDataOrFilename,$pemPassword);
	}

	function get_DebugLogFilePath($str) {
		CkImap_get_DebugLogFilePath($this->_cPtr,$str);
	}

	function debugLogFilePath() {
		return CkImap_debugLogFilePath($this->_cPtr);
	}

	function put_DebugLogFilePath($newVal) {
		CkImap_put_DebugLogFilePath($this->_cPtr,$newVal);
	}

	function get_UidValidity() {
		return CkImap_get_UidValidity($this->_cPtr);
	}

	function get_ClientIpAddress($str) {
		CkImap_get_ClientIpAddress($this->_cPtr,$str);
	}

	function clientIpAddress() {
		return CkImap_clientIpAddress($this->_cPtr);
	}

	function put_ClientIpAddress($newVal) {
		CkImap_put_ClientIpAddress($this->_cPtr,$newVal);
	}

	function get_VerboseLogging() {
		return CkImap_get_VerboseLogging($this->_cPtr);
	}

	function put_VerboseLogging($newVal) {
		CkImap_put_VerboseLogging($this->_cPtr,$newVal);
	}

	function get_AutoDownloadAttachments() {
		return CkImap_get_AutoDownloadAttachments($this->_cPtr);
	}

	function put_AutoDownloadAttachments($newVal) {
		CkImap_put_AutoDownloadAttachments($this->_cPtr,$newVal);
	}

	function FetchAttachmentBytes($email,$attachIndex,$outBytes) {
		return CkImap_FetchAttachmentBytes($this->_cPtr,$email,$attachIndex,$outBytes);
	}

	function fetchAttachmentString($email,$attachIndex,$charset) {
		return CkImap_fetchAttachmentString($this->_cPtr,$email,$attachIndex,$charset);
	}

	function FetchAttachment($email,$attachIndex,$saveToPath) {
		return CkImap_FetchAttachment($this->_cPtr,$email,$attachIndex,$saveToPath);
	}

	function Connect($hostname) {
		return CkImap_Connect($this->_cPtr,$hostname);
	}

	function Disconnect() {
		return CkImap_Disconnect($this->_cPtr);
	}

	function IsConnected() {
		return CkImap_IsConnected($this->_cPtr);
	}

	function get_SeparatorChar() {
		return CkImap_get_SeparatorChar($this->_cPtr);
	}

	function put_SeparatorChar($c_) {
		CkImap_put_SeparatorChar($this->_cPtr,$c_);
	}

	function get_NumMessages() {
		return CkImap_get_NumMessages($this->_cPtr);
	}

	function FetchSequenceAsMime($startSeqNum,$count) {
		$r=CkImap_FetchSequenceAsMime($this->_cPtr,$startSeqNum,$count);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkStringArray($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function Login($login,$password) {
		return CkImap_Login($this->_cPtr,$login,$password);
	}

	function Logout() {
		return CkImap_Logout($this->_cPtr);
	}

	function IsLoggedIn() {
		return CkImap_IsLoggedIn($this->_cPtr);
	}

	function SetSslClientCert($cert) {
		return CkImap_SetSslClientCert($this->_cPtr,$cert);
	}

	function GetSslServerCert() {
		$r=CkImap_GetSslServerCert($this->_cPtr);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkCert($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function get_SslServerCertVerified() {
		return CkImap_get_SslServerCertVerified($this->_cPtr);
	}

	function get_LoggedInUser($str) {
		CkImap_get_LoggedInUser($this->_cPtr,$str);
	}

	function get_ConnectedToHost($str) {
		CkImap_get_ConnectedToHost($this->_cPtr,$str);
	}

	function CreateMailbox($mailbox) {
		return CkImap_CreateMailbox($this->_cPtr,$mailbox);
	}

	function DeleteMailbox($mailbox) {
		return CkImap_DeleteMailbox($this->_cPtr,$mailbox);
	}

	function RenameMailbox($fromMailbox,$toMailbox) {
		return CkImap_RenameMailbox($this->_cPtr,$fromMailbox,$toMailbox);
	}

	function CopyMultiple($messageSet,$copyToMailbox) {
		return CkImap_CopyMultiple($this->_cPtr,$messageSet,$copyToMailbox);
	}

	function CopySequence($startSeqNum,$count,$copyToMailbox) {
		return CkImap_CopySequence($this->_cPtr,$startSeqNum,$count,$copyToMailbox);
	}

	function SetDecryptCert2($cert,$key) {
		return CkImap_SetDecryptCert2($this->_cPtr,$cert,$key);
	}

	function ListMailboxes($reference,$wildcardedMailbox) {
		$r=CkImap_ListMailboxes($this->_cPtr,$reference,$wildcardedMailbox);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkMailboxes($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function SelectMailbox($mailbox) {
		return CkImap_SelectMailbox($this->_cPtr,$mailbox);
	}

	function ExamineMailbox($mailbox) {
		return CkImap_ExamineMailbox($this->_cPtr,$mailbox);
	}

	function Search($criteria,$bUid) {
		$r=CkImap_Search($this->_cPtr,$criteria,$bUid);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkMessageSet($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function ClearSessionLog() {
		CkImap_ClearSessionLog($this->_cPtr);
	}

	function GetAllUids() {
		$r=CkImap_GetAllUids($this->_cPtr);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkMessageSet($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function FetchSingle($msgId,$bUid) {
		$r=CkImap_FetchSingle($this->_cPtr,$msgId,$bUid);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkEmail($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function FetchSingleHeader($msgId,$bUid) {
		$r=CkImap_FetchSingleHeader($this->_cPtr,$msgId,$bUid);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkEmail($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function FetchBundle($messageSet) {
		$r=CkImap_FetchBundle($this->_cPtr,$messageSet);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkEmailBundle($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function FetchHeaders($messageSet) {
		$r=CkImap_FetchHeaders($this->_cPtr,$messageSet);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkEmailBundle($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function FetchChunk($startSeqNum,$fetchCount,$failedSet,$fetchedSet) {
		$r=CkImap_FetchChunk($this->_cPtr,$startSeqNum,$fetchCount,$failedSet,$fetchedSet);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkEmailBundle($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function FetchSequence($startSeqNum,$numMessages) {
		$r=CkImap_FetchSequence($this->_cPtr,$startSeqNum,$numMessages);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkEmailBundle($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function FetchSequenceHeaders($startSeqNum,$numMessages) {
		$r=CkImap_FetchSequenceHeaders($this->_cPtr,$startSeqNum,$numMessages);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkEmailBundle($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function FetchBundleAsMime($messageSet) {
		$r=CkImap_FetchBundleAsMime($this->_cPtr,$messageSet);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkStringArray($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function Expunge() {
		return CkImap_Expunge($this->_cPtr);
	}

	function ExpungeAndClose() {
		return CkImap_ExpungeAndClose($this->_cPtr);
	}

	function StoreFlags($msgId,$bUid,$flagName,$value) {
		return CkImap_StoreFlags($this->_cPtr,$msgId,$bUid,$flagName,$value);
	}

	function SetFlag($msgId,$bUid,$flagName,$value) {
		return CkImap_SetFlag($this->_cPtr,$msgId,$bUid,$flagName,$value);
	}

	function SetFlags($messageSet,$flagName,$value) {
		return CkImap_SetFlags($this->_cPtr,$messageSet,$flagName,$value);
	}

	function get_AuthMethod($str) {
		CkImap_get_AuthMethod($this->_cPtr,$str);
	}

	function put_AuthMethod($str) {
		CkImap_put_AuthMethod($this->_cPtr,$str);
	}

	function get_Domain($str) {
		CkImap_get_Domain($this->_cPtr,$str);
	}

	function put_Domain($str) {
		CkImap_put_Domain($this->_cPtr,$str);
	}

	function get_Port() {
		return CkImap_get_Port($this->_cPtr);
	}

	function put_Port($port) {
		CkImap_put_Port($this->_cPtr,$port);
	}

	function get_Ssl() {
		return CkImap_get_Ssl($this->_cPtr);
	}

	function put_Ssl($s) {
		CkImap_put_Ssl($this->_cPtr,$s);
	}

	function AppendMime($mailbox,$mimeText) {
		return CkImap_AppendMime($this->_cPtr,$mailbox,$mimeText);
	}

	function AppendMail($mailbox,$email) {
		return CkImap_AppendMail($this->_cPtr,$mailbox,$email);
	}

	function Copy($msgId,$bUid,$copyToMailbox) {
		return CkImap_Copy($this->_cPtr,$msgId,$bUid,$copyToMailbox);
	}

	function SetMailFlag($email,$flagName,$value) {
		return CkImap_SetMailFlag($this->_cPtr,$email,$flagName,$value);
	}

	function GetMailFlag($email,$flagName) {
		return CkImap_GetMailFlag($this->_cPtr,$email,$flagName);
	}

	function RefetchMailFlags($emailInOut) {
		return CkImap_RefetchMailFlags($this->_cPtr,$emailInOut);
	}

	function GetMailSize($email) {
		return CkImap_GetMailSize($this->_cPtr,$email);
	}

	function GetMailNumAttach($email) {
		return CkImap_GetMailNumAttach($this->_cPtr,$email);
	}

	function GetMailAttachSize($email,$attachIndex) {
		return CkImap_GetMailAttachSize($this->_cPtr,$email,$attachIndex);
	}

	function get_PeekMode() {
		return CkImap_get_PeekMode($this->_cPtr);
	}

	function put_PeekMode($bPeek) {
		CkImap_put_PeekMode($this->_cPtr,$bPeek);
	}

	function get_SessionLog($str) {
		CkImap_get_SessionLog($this->_cPtr,$str);
	}

	function get_KeepSessionLog() {
		return CkImap_get_KeepSessionLog($this->_cPtr);
	}

	function put_KeepSessionLog($newVal) {
		CkImap_put_KeepSessionLog($this->_cPtr,$newVal);
	}

	function get_AppendSeen() {
		return CkImap_get_AppendSeen($this->_cPtr);
	}

	function put_AppendSeen($alreadySeen) {
		CkImap_put_AppendSeen($this->_cPtr,$alreadySeen);
	}

	function SaveLastError($filename) {
		return CkImap_SaveLastError($this->_cPtr,$filename);
	}

	function UnlockComponent($unlockCode) {
		return CkImap_UnlockComponent($this->_cPtr,$unlockCode);
	}

	function IsUnlocked() {
		return CkImap_IsUnlocked($this->_cPtr);
	}

	function get_ReadTimeout() {
		return CkImap_get_ReadTimeout($this->_cPtr);
	}

	function put_ReadTimeout($numSec) {
		CkImap_put_ReadTimeout($this->_cPtr,$numSec);
	}

	function get_ConnectTimeout() {
		return CkImap_get_ConnectTimeout($this->_cPtr);
	}

	function put_ConnectTimeout($numSec) {
		CkImap_put_ConnectTimeout($this->_cPtr,$numSec);
	}

	function lastErrorText() {
		return CkImap_lastErrorText($this->_cPtr);
	}

	function lastErrorXml() {
		return CkImap_lastErrorXml($this->_cPtr);
	}

	function lastErrorHtml() {
		return CkImap_lastErrorHtml($this->_cPtr);
	}

	function getMailAttachFilename($email,$attachIndex) {
		return CkImap_getMailAttachFilename($this->_cPtr,$email,$attachIndex);
	}

	function fetchFlags($msgId,$bUid) {
		return CkImap_fetchFlags($this->_cPtr,$msgId,$bUid);
	}

	function authMethod() {
		return CkImap_authMethod($this->_cPtr);
	}

	function domain() {
		return CkImap_domain($this->_cPtr);
	}

	function fetchSingleAsMime($msgId,$bUid) {
		return CkImap_fetchSingleAsMime($this->_cPtr,$msgId,$bUid);
	}

	function loggedInUser() {
		return CkImap_loggedInUser($this->_cPtr);
	}

	function connectedToHost() {
		return CkImap_connectedToHost($this->_cPtr);
	}

	function sendRawCommand($rawCommand) {
		return CkImap_sendRawCommand($this->_cPtr,$rawCommand);
	}

	function sessionLog() {
		return CkImap_sessionLog($this->_cPtr);
	}
}


?>