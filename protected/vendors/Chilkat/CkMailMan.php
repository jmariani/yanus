<?php
class CkMailMan {

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
		if (is_resource($res) && get_resource_type($res) === '_p_CkMailMan') {
			$this->_cPtr=$res;
			return;
		}
		$this->_cPtr=new_CkMailMan();
	}

	function GetSizeByUidl($uidl) {
		return CkMailMan_GetSizeByUidl($this->_cPtr,$uidl);
	}

	function SendMimeToList($from,$distListFile,$mimeText) {
		return CkMailMan_SendMimeToList($this->_cPtr,$from,$distListFile,$mimeText);
	}

	function SendToDistributionList($email,$array) {
		return CkMailMan_SendToDistributionList($this->_cPtr,$email,$array);
	}

	function get_ClientIpAddress($str) {
		CkMailMan_get_ClientIpAddress($this->_cPtr,$str);
	}

	function clientIpAddress() {
		return CkMailMan_clientIpAddress($this->_cPtr);
	}

	function put_ClientIpAddress($newVal) {
		CkMailMan_put_ClientIpAddress($this->_cPtr,$newVal);
	}

	function get_Pop3SessionId() {
		return CkMailMan_get_Pop3SessionId($this->_cPtr);
	}

	function MxLookupAll($emailAddress) {
		$r=CkMailMan_MxLookupAll($this->_cPtr,$emailAddress);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkStringArray($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function DeleteByMsgnum($msgnum) {
		return CkMailMan_DeleteByMsgnum($this->_cPtr,$msgnum);
	}

	function FetchByMsgnum($msgnum) {
		$r=CkMailMan_FetchByMsgnum($this->_cPtr,$msgnum);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkEmail($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function FetchMimeByMsgnum($msgnum,$outBytes) {
		return CkMailMan_FetchMimeByMsgnum($this->_cPtr,$msgnum,$outBytes);
	}

	function get_SendBufferSize() {
		return CkMailMan_get_SendBufferSize($this->_cPtr);
	}

	function put_SendBufferSize($newVal) {
		CkMailMan_put_SendBufferSize($this->_cPtr,$newVal);
	}

	function SshTunnel($bSmtp,$sshServerHostname,$sshServerPort) {
		return CkMailMan_SshTunnel($this->_cPtr,$bSmtp,$sshServerHostname,$sshServerPort);
	}

	function SshAuthenticatePw($bSmtp,$sshLogin,$sshPassword) {
		return CkMailMan_SshAuthenticatePw($this->_cPtr,$bSmtp,$sshLogin,$sshPassword);
	}

	function SshAuthenticatePk($bSmtp,$sshLogin,$privateKey) {
		return CkMailMan_SshAuthenticatePk($this->_cPtr,$bSmtp,$sshLogin,$privateKey);
	}

	function SshCloseTunnel($bSmtp) {
		return CkMailMan_SshCloseTunnel($this->_cPtr,$bSmtp);
	}

	function get_IncludeRootCert() {
		return CkMailMan_get_IncludeRootCert($this->_cPtr);
	}

	function put_IncludeRootCert($newVal) {
		CkMailMan_put_IncludeRootCert($this->_cPtr,$newVal);
	}

	function get_SocksHostname($str) {
		CkMailMan_get_SocksHostname($this->_cPtr,$str);
	}

	function socksHostname() {
		return CkMailMan_socksHostname($this->_cPtr);
	}

	function put_SocksHostname($newVal) {
		CkMailMan_put_SocksHostname($this->_cPtr,$newVal);
	}

	function get_SocksUsername($str) {
		CkMailMan_get_SocksUsername($this->_cPtr,$str);
	}

	function socksUsername() {
		return CkMailMan_socksUsername($this->_cPtr);
	}

	function put_SocksUsername($newVal) {
		CkMailMan_put_SocksUsername($this->_cPtr,$newVal);
	}

	function get_SocksPassword($str) {
		CkMailMan_get_SocksPassword($this->_cPtr,$str);
	}

	function socksPassword() {
		return CkMailMan_socksPassword($this->_cPtr);
	}

	function put_SocksPassword($newVal) {
		CkMailMan_put_SocksPassword($this->_cPtr,$newVal);
	}

	function get_SocksPort() {
		return CkMailMan_get_SocksPort($this->_cPtr);
	}

	function put_SocksPort($newVal) {
		CkMailMan_put_SocksPort($this->_cPtr,$newVal);
	}

	function get_SocksVersion() {
		return CkMailMan_get_SocksVersion($this->_cPtr);
	}

	function put_SocksVersion($newVal) {
		CkMailMan_put_SocksVersion($this->_cPtr,$newVal);
	}

	function SetSslClientCertPfx($pfxFilename,$pfxPassword,$certSubjectCN) {
		return CkMailMan_SetSslClientCertPfx($this->_cPtr,$pfxFilename,$pfxPassword,$certSubjectCN);
	}

	function SendMimeBytes($from,$recipients,$mimeData) {
		return CkMailMan_SendMimeBytes($this->_cPtr,$from,$recipients,$mimeData);
	}

	function RenderToMimeBytes($email,$outBytes) {
		return CkMailMan_RenderToMimeBytes($this->_cPtr,$email,$outBytes);
	}

	function SendMimeBytesQ($from,$recipients,$mimeData) {
		return CkMailMan_SendMimeBytesQ($this->_cPtr,$from,$recipients,$mimeData);
	}

	function get_HttpProxyHostname($str) {
		CkMailMan_get_HttpProxyHostname($this->_cPtr,$str);
	}

	function httpProxyHostname() {
		return CkMailMan_httpProxyHostname($this->_cPtr);
	}

	function put_HttpProxyHostname($newVal) {
		CkMailMan_put_HttpProxyHostname($this->_cPtr,$newVal);
	}

	function get_HttpProxyAuthMethod($str) {
		CkMailMan_get_HttpProxyAuthMethod($this->_cPtr,$str);
	}

	function httpProxyAuthMethod() {
		return CkMailMan_httpProxyAuthMethod($this->_cPtr);
	}

	function put_HttpProxyAuthMethod($newVal) {
		CkMailMan_put_HttpProxyAuthMethod($this->_cPtr,$newVal);
	}

	function get_HttpProxyUsername($str) {
		CkMailMan_get_HttpProxyUsername($this->_cPtr,$str);
	}

	function httpProxyUsername() {
		return CkMailMan_httpProxyUsername($this->_cPtr);
	}

	function put_HttpProxyUsername($newVal) {
		CkMailMan_put_HttpProxyUsername($this->_cPtr,$newVal);
	}

	function get_HttpProxyPassword($str) {
		CkMailMan_get_HttpProxyPassword($this->_cPtr,$str);
	}

	function httpProxyPassword() {
		return CkMailMan_httpProxyPassword($this->_cPtr);
	}

	function put_HttpProxyPassword($newVal) {
		CkMailMan_put_HttpProxyPassword($this->_cPtr,$newVal);
	}

	function get_HttpProxyPort() {
		return CkMailMan_get_HttpProxyPort($this->_cPtr);
	}

	function put_HttpProxyPort($newVal) {
		CkMailMan_put_HttpProxyPort($this->_cPtr,$newVal);
	}

	function get_AutoFix() {
		return CkMailMan_get_AutoFix($this->_cPtr);
	}

	function put_AutoFix($newVal) {
		CkMailMan_put_AutoFix($this->_cPtr,$newVal);
	}

	function get_VerboseLogging() {
		return CkMailMan_get_VerboseLogging($this->_cPtr);
	}

	function put_VerboseLogging($newVal) {
		CkMailMan_put_VerboseLogging($this->_cPtr,$newVal);
	}

	function get_Pop3Stls() {
		return CkMailMan_get_Pop3Stls($this->_cPtr);
	}

	function put_Pop3Stls($newVal) {
		CkMailMan_put_Pop3Stls($this->_cPtr,$newVal);
	}

	function AddPfxSourceData($pfxData,$password) {
		return CkMailMan_AddPfxSourceData($this->_cPtr,$pfxData,$password);
	}

	function AddPfxSourceFile($pfxFilePath,$password) {
		return CkMailMan_AddPfxSourceFile($this->_cPtr,$pfxFilePath,$password);
	}

	function smtpSendRawCommand($command,$charset,$bEncodeBase64) {
		return CkMailMan_smtpSendRawCommand($this->_cPtr,$command,$charset,$bEncodeBase64);
	}

	function pop3SendRawCommand($command,$charset) {
		return CkMailMan_pop3SendRawCommand($this->_cPtr,$command,$charset);
	}

	function Pop3EndSessionNoQuit() {
		return CkMailMan_Pop3EndSessionNoQuit($this->_cPtr);
	}

	function SetSslClientCertPem($pemDataOrFilename,$pemPassword) {
		return CkMailMan_SetSslClientCertPem($this->_cPtr,$pemDataOrFilename,$pemPassword);
	}

	function get_UseApop() {
		return CkMailMan_get_UseApop($this->_cPtr);
	}

	function put_UseApop($newVal) {
		CkMailMan_put_UseApop($this->_cPtr,$newVal);
	}

	function get_DebugLogFilePath($str) {
		CkMailMan_get_DebugLogFilePath($this->_cPtr,$str);
	}

	function debugLogFilePath() {
		return CkMailMan_debugLogFilePath($this->_cPtr);
	}

	function put_DebugLogFilePath($newVal) {
		CkMailMan_put_DebugLogFilePath($this->_cPtr,$newVal);
	}

	function get_RequireSslCertVerify() {
		return CkMailMan_get_RequireSslCertVerify($this->_cPtr);
	}

	function put_RequireSslCertVerify($newVal) {
		CkMailMan_put_RequireSslCertVerify($this->_cPtr,$newVal);
	}

	function get_IsSmtpConnected() {
		return CkMailMan_get_IsSmtpConnected($this->_cPtr);
	}

	function get_AutoSmtpRset() {
		return CkMailMan_get_AutoSmtpRset($this->_cPtr);
	}

	function put_AutoSmtpRset($newVal) {
		CkMailMan_put_AutoSmtpRset($this->_cPtr,$newVal);
	}

	function lastErrorText() {
		return CkMailMan_lastErrorText($this->_cPtr);
	}

	function lastErrorXml() {
		return CkMailMan_lastErrorXml($this->_cPtr);
	}

	function lastErrorHtml() {
		return CkMailMan_lastErrorHtml($this->_cPtr);
	}

	function smtpPassword() {
		return CkMailMan_smtpPassword($this->_cPtr);
	}

	function smtpUsername() {
		return CkMailMan_smtpUsername($this->_cPtr);
	}

	function dsnNotify() {
		return CkMailMan_dsnNotify($this->_cPtr);
	}

	function dsnEnvid() {
		return CkMailMan_dsnEnvid($this->_cPtr);
	}

	function dsnRet() {
		return CkMailMan_dsnRet($this->_cPtr);
	}

	function smtpAuthMethod() {
		return CkMailMan_smtpAuthMethod($this->_cPtr);
	}

	function smtpLoginDomain() {
		return CkMailMan_smtpLoginDomain($this->_cPtr);
	}

	function filter() {
		return CkMailMan_filter($this->_cPtr);
	}

	function popPassword() {
		return CkMailMan_popPassword($this->_cPtr);
	}

	function popUsername() {
		return CkMailMan_popUsername($this->_cPtr);
	}

	function mailHost() {
		return CkMailMan_mailHost($this->_cPtr);
	}

	function heloHostname() {
		return CkMailMan_heloHostname($this->_cPtr);
	}

	function lastSendQFilename() {
		return CkMailMan_lastSendQFilename($this->_cPtr);
	}

	function version() {
		return CkMailMan_version($this->_cPtr);
	}

	function smtpHost() {
		return CkMailMan_smtpHost($this->_cPtr);
	}

	function logMailReceivedFilename() {
		return CkMailMan_logMailReceivedFilename($this->_cPtr);
	}

	function logMailSentFilename() {
		return CkMailMan_logMailSentFilename($this->_cPtr);
	}

	function mxLookup($emailAddr) {
		return CkMailMan_mxLookup($this->_cPtr,$emailAddr);
	}

	function renderToMime($email) {
		return CkMailMan_renderToMime($this->_cPtr,$email);
	}

	function getMailboxInfoXml() {
		return CkMailMan_getMailboxInfoXml($this->_cPtr);
	}

	function VerifyRecipients($email,$saBadAddrs) {
		return CkMailMan_VerifyRecipients($this->_cPtr,$email,$saBadAddrs);
	}

	function SetSslClientCert($cert) {
		return CkMailMan_SetSslClientCert($this->_cPtr,$cert);
	}

	function GetPop3SslServerCert() {
		$r=CkMailMan_GetPop3SslServerCert($this->_cPtr);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkCert($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function GetSmtpSslServerCert() {
		$r=CkMailMan_GetSmtpSslServerCert($this->_cPtr);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkCert($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function get_Pop3SslServerCertVerified() {
		return CkMailMan_get_Pop3SslServerCertVerified($this->_cPtr);
	}

	function get_SmtpSslServerCertVerified() {
		return CkMailMan_get_SmtpSslServerCertVerified($this->_cPtr);
	}

	function GetMailboxSize() {
		return CkMailMan_GetMailboxSize($this->_cPtr);
	}

	function GetMailboxCount() {
		return CkMailMan_GetMailboxCount($this->_cPtr);
	}

	function Pop3BeginSession() {
		return CkMailMan_Pop3BeginSession($this->_cPtr);
	}

	function Pop3EndSession() {
		return CkMailMan_Pop3EndSession($this->_cPtr);
	}

	function Pop3Noop() {
		return CkMailMan_Pop3Noop($this->_cPtr);
	}

	function Pop3Reset() {
		return CkMailMan_Pop3Reset($this->_cPtr);
	}

	function get_Pop3SessionLog($log) {
		CkMailMan_get_Pop3SessionLog($this->_cPtr,$log);
	}

	function ClearPop3SessionLog() {
		CkMailMan_ClearPop3SessionLog($this->_cPtr);
	}

	function pop3SessionLog() {
		return CkMailMan_pop3SessionLog($this->_cPtr);
	}

	function SetDecryptCert2($cert,$key) {
		return CkMailMan_SetDecryptCert2($this->_cPtr,$cert,$key);
	}

	function get_SmtpSessionLog($log) {
		CkMailMan_get_SmtpSessionLog($this->_cPtr,$log);
	}

	function ClearSmtpSessionLog() {
		CkMailMan_ClearSmtpSessionLog($this->_cPtr);
	}

	function smtpSessionLog() {
		return CkMailMan_smtpSessionLog($this->_cPtr);
	}

	function get_Utf8() {
		return CkMailMan_get_Utf8($this->_cPtr);
	}

	function put_Utf8($b) {
		CkMailMan_put_Utf8($this->_cPtr,$b);
	}

	function OpenSmtpConnection() {
		return CkMailMan_OpenSmtpConnection($this->_cPtr);
	}

	function CloseSmtpConnection() {
		return CkMailMan_CloseSmtpConnection($this->_cPtr);
	}

	function SmtpReset() {
		return CkMailMan_SmtpReset($this->_cPtr);
	}

	function SmtpNoop() {
		return CkMailMan_SmtpNoop($this->_cPtr);
	}

	function get_HeartbeatMs() {
		return CkMailMan_get_HeartbeatMs($this->_cPtr);
	}

	function put_HeartbeatMs($millisec) {
		CkMailMan_put_HeartbeatMs($this->_cPtr,$millisec);
	}

	function get_HeloHostname($str) {
		CkMailMan_get_HeloHostname($this->_cPtr,$str);
	}

	function put_HeloHostname($str) {
		CkMailMan_put_HeloHostname($this->_cPtr,$str);
	}

	function SaveLastError($filename) {
		return CkMailMan_SaveLastError($this->_cPtr,$filename);
	}

	function get_SmtpPassword($str) {
		CkMailMan_get_SmtpPassword($this->_cPtr,$str);
	}

	function put_SmtpPassword($str) {
		CkMailMan_put_SmtpPassword($this->_cPtr,$str);
	}

	function get_SmtpUsername($str) {
		CkMailMan_get_SmtpUsername($this->_cPtr,$str);
	}

	function put_SmtpUsername($str) {
		CkMailMan_put_SmtpUsername($this->_cPtr,$str);
	}

	function get_DsnNotify($str) {
		CkMailMan_get_DsnNotify($this->_cPtr,$str);
	}

	function put_DsnNotify($str) {
		CkMailMan_put_DsnNotify($this->_cPtr,$str);
	}

	function get_DsnEnvid($str) {
		CkMailMan_get_DsnEnvid($this->_cPtr,$str);
	}

	function put_DsnEnvid($str) {
		CkMailMan_put_DsnEnvid($this->_cPtr,$str);
	}

	function get_DsnRet($str) {
		CkMailMan_get_DsnRet($this->_cPtr,$str);
	}

	function put_DsnRet($str) {
		CkMailMan_put_DsnRet($this->_cPtr,$str);
	}

	function get_LastSmtpStatus() {
		return CkMailMan_get_LastSmtpStatus($this->_cPtr);
	}

	function get_ReadTimeout() {
		return CkMailMan_get_ReadTimeout($this->_cPtr);
	}

	function put_ReadTimeout($newVal) {
		CkMailMan_put_ReadTimeout($this->_cPtr,$newVal);
	}

	function get_ConnectTimeout() {
		return CkMailMan_get_ConnectTimeout($this->_cPtr);
	}

	function put_ConnectTimeout($newVal) {
		CkMailMan_put_ConnectTimeout($this->_cPtr,$newVal);
	}

	function get_ResetDateOnLoad() {
		return CkMailMan_get_ResetDateOnLoad($this->_cPtr);
	}

	function put_ResetDateOnLoad($newVal) {
		CkMailMan_put_ResetDateOnLoad($this->_cPtr,$newVal);
	}

	function get_OpaqueSigning() {
		return CkMailMan_get_OpaqueSigning($this->_cPtr);
	}

	function put_OpaqueSigning($newVal) {
		CkMailMan_put_OpaqueSigning($this->_cPtr,$newVal);
	}

	function get_AllOrNone() {
		return CkMailMan_get_AllOrNone($this->_cPtr);
	}

	function put_AllOrNone($newVal) {
		CkMailMan_put_AllOrNone($this->_cPtr,$newVal);
	}

	function get_Pop3SPA() {
		return CkMailMan_get_Pop3SPA($this->_cPtr);
	}

	function put_Pop3SPA($newVal) {
		CkMailMan_put_Pop3SPA($this->_cPtr,$newVal);
	}

	function get_StartTLS() {
		return CkMailMan_get_StartTLS($this->_cPtr);
	}

	function put_StartTLS($newVal) {
		CkMailMan_put_StartTLS($this->_cPtr,$newVal);
	}

	function get_EmbedCertChain() {
		return CkMailMan_get_EmbedCertChain($this->_cPtr);
	}

	function put_EmbedCertChain($newVal) {
		CkMailMan_put_EmbedCertChain($this->_cPtr,$newVal);
	}

	function get_PopSsl() {
		return CkMailMan_get_PopSsl($this->_cPtr);
	}

	function put_PopSsl($newVal) {
		CkMailMan_put_PopSsl($this->_cPtr,$newVal);
	}

	function get_SmtpSsl() {
		return CkMailMan_get_SmtpSsl($this->_cPtr);
	}

	function put_SmtpSsl($newVal) {
		CkMailMan_put_SmtpSsl($this->_cPtr,$newVal);
	}

	function get_ImmediateDelete() {
		return CkMailMan_get_ImmediateDelete($this->_cPtr);
	}

	function put_ImmediateDelete($newVal) {
		CkMailMan_put_ImmediateDelete($this->_cPtr,$newVal);
	}

	function get_SendIndividual() {
		return CkMailMan_get_SendIndividual($this->_cPtr);
	}

	function put_SendIndividual($newVal) {
		CkMailMan_put_SendIndividual($this->_cPtr,$newVal);
	}

	function get_SmtpAuthMethod($str) {
		CkMailMan_get_SmtpAuthMethod($this->_cPtr,$str);
	}

	function put_SmtpAuthMethod($str) {
		CkMailMan_put_SmtpAuthMethod($this->_cPtr,$str);
	}

	function get_SmtpLoginDomain($str) {
		CkMailMan_get_SmtpLoginDomain($this->_cPtr,$str);
	}

	function put_SmtpLoginDomain($str) {
		CkMailMan_put_SmtpLoginDomain($this->_cPtr,$str);
	}

	function get_Filter($str) {
		CkMailMan_get_Filter($this->_cPtr,$str);
	}

	function put_Filter($str) {
		CkMailMan_put_Filter($this->_cPtr,$str);
	}

	function get_SizeLimit() {
		return CkMailMan_get_SizeLimit($this->_cPtr);
	}

	function put_SizeLimit($newVal) {
		CkMailMan_put_SizeLimit($this->_cPtr,$newVal);
	}

	function get_MaxCount() {
		return CkMailMan_get_MaxCount($this->_cPtr);
	}

	function put_MaxCount($newVal) {
		CkMailMan_put_MaxCount($this->_cPtr,$newVal);
	}

	function get_MailPort() {
		return CkMailMan_get_MailPort($this->_cPtr);
	}

	function put_MailPort($newVal) {
		CkMailMan_put_MailPort($this->_cPtr,$newVal);
	}

	function get_SmtpPort() {
		return CkMailMan_get_SmtpPort($this->_cPtr);
	}

	function put_SmtpPort($newVal) {
		CkMailMan_put_SmtpPort($this->_cPtr,$newVal);
	}

	function get_PopPassword($str) {
		CkMailMan_get_PopPassword($this->_cPtr,$str);
	}

	function put_PopPassword($str) {
		CkMailMan_put_PopPassword($this->_cPtr,$str);
	}

	function put_PopPasswordBase64($strBase64) {
		CkMailMan_put_PopPasswordBase64($this->_cPtr,$strBase64);
	}

	function get_PopUsername($str) {
		CkMailMan_get_PopUsername($this->_cPtr,$str);
	}

	function put_PopUsername($str) {
		CkMailMan_put_PopUsername($this->_cPtr,$str);
	}

	function get_MailHost($str) {
		CkMailMan_get_MailHost($this->_cPtr,$str);
	}

	function put_MailHost($str) {
		CkMailMan_put_MailHost($this->_cPtr,$str);
	}

	function get_LastSendQFilename($str) {
		CkMailMan_get_LastSendQFilename($this->_cPtr,$str);
	}

	function get_Version($str) {
		CkMailMan_get_Version($this->_cPtr,$str);
	}

	function get_SmtpHost($str) {
		CkMailMan_get_SmtpHost($this->_cPtr,$str);
	}

	function put_SmtpHost($str) {
		CkMailMan_put_SmtpHost($this->_cPtr,$str);
	}

	function get_AutoGenMessageId() {
		return CkMailMan_get_AutoGenMessageId($this->_cPtr);
	}

	function put_AutoGenMessageId($newVal) {
		CkMailMan_put_AutoGenMessageId($this->_cPtr,$newVal);
	}

	function get_LogMailReceivedFilename($str) {
		CkMailMan_get_LogMailReceivedFilename($this->_cPtr,$str);
	}

	function put_LogMailReceivedFilename($str) {
		CkMailMan_put_LogMailReceivedFilename($this->_cPtr,$str);
	}

	function get_LogMailSentFilename($str) {
		CkMailMan_get_LogMailSentFilename($this->_cPtr,$str);
	}

	function put_LogMailSentFilename($str) {
		CkMailMan_put_LogMailSentFilename($this->_cPtr,$str);
	}

	function ClearBadEmailAddresses() {
		CkMailMan_ClearBadEmailAddresses($this->_cPtr);
	}

	function GetBadEmailAddresses() {
		$r=CkMailMan_GetBadEmailAddresses($this->_cPtr);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkStringArray($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function GetUidls() {
		$r=CkMailMan_GetUidls($this->_cPtr);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkStringArray($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function IsSmtpDsnCapable() {
		return CkMailMan_IsSmtpDsnCapable($this->_cPtr);
	}

	function VerifySmtpLogin() {
		return CkMailMan_VerifySmtpLogin($this->_cPtr);
	}

	function VerifySmtpConnection() {
		return CkMailMan_VerifySmtpConnection($this->_cPtr);
	}

	function VerifyPopLogin() {
		return CkMailMan_VerifyPopLogin($this->_cPtr);
	}

	function VerifyPopConnection() {
		return CkMailMan_VerifyPopConnection($this->_cPtr);
	}

	function FetchMultiple($uidlArray) {
		$r=CkMailMan_FetchMultiple($this->_cPtr,$uidlArray);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkEmailBundle($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function FetchMultipleMime($uidlArray) {
		$r=CkMailMan_FetchMultipleMime($this->_cPtr,$uidlArray);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkStringArray($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function TransferMultipleMime($uidlArray) {
		$r=CkMailMan_TransferMultipleMime($this->_cPtr,$uidlArray);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkStringArray($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function FetchMultipleHeaders($uidlArray,$numBodyLines) {
		$r=CkMailMan_FetchMultipleHeaders($this->_cPtr,$uidlArray,$numBodyLines);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkEmailBundle($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function DeleteByUidl($uidl) {
		return CkMailMan_DeleteByUidl($this->_cPtr,$uidl);
	}

	function FetchEmail($uidl) {
		$r=CkMailMan_FetchEmail($this->_cPtr,$uidl);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkEmail($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function FetchMime($uidl,$mimeBytes) {
		return CkMailMan_FetchMime($this->_cPtr,$uidl,$mimeBytes);
	}

	function DeleteMultiple($uidlArray) {
		return CkMailMan_DeleteMultiple($this->_cPtr,$uidlArray);
	}

	function DeleteBundle($bundle) {
		return CkMailMan_DeleteBundle($this->_cPtr,$bundle);
	}

	function FetchSingleHeader($numBodyLines,$index) {
		$r=CkMailMan_FetchSingleHeader($this->_cPtr,$numBodyLines,$index);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkEmail($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function FetchSingleHeaderByUidl($numBodyLines,$uidl) {
		$r=CkMailMan_FetchSingleHeaderByUidl($this->_cPtr,$numBodyLines,$uidl);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkEmail($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function GetFullEmail($email) {
		$r=CkMailMan_GetFullEmail($this->_cPtr,$email);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkEmail($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function GetHeaders($numBodyLines,$fromIndex,$toIndex) {
		$r=CkMailMan_GetHeaders($this->_cPtr,$numBodyLines,$fromIndex,$toIndex);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkEmailBundle($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function DeleteEmail($email) {
		return CkMailMan_DeleteEmail($this->_cPtr,$email);
	}

	function GetAllHeaders($numBodyLines) {
		$r=CkMailMan_GetAllHeaders($this->_cPtr,$numBodyLines);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkEmailBundle($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function LoadXmlString($xmlString) {
		$r=CkMailMan_LoadXmlString($this->_cPtr,$xmlString);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkEmailBundle($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function LoadXmlFile($folderPath) {
		$r=CkMailMan_LoadXmlFile($this->_cPtr,$folderPath);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkEmailBundle($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function LoadXmlEmail($folderPath) {
		$r=CkMailMan_LoadXmlEmail($this->_cPtr,$folderPath);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkEmail($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function LoadXmlEmailString($xmlString) {
		$r=CkMailMan_LoadXmlEmailString($this->_cPtr,$xmlString);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkEmail($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function QuickSend($from,$to,$subject,$body,$smtpServer) {
		return CkMailMan_QuickSend($this->_cPtr,$from,$to,$subject,$body,$smtpServer);
	}

	function UnlockComponent($code) {
		return CkMailMan_UnlockComponent($this->_cPtr,$code);
	}

	function CheckMail() {
		return CkMailMan_CheckMail($this->_cPtr);
	}

	function TransferMail() {
		$r=CkMailMan_TransferMail($this->_cPtr);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkEmailBundle($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function CopyMail() {
		$r=CkMailMan_CopyMail($this->_cPtr);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkEmailBundle($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function SendBundle($bundle) {
		return CkMailMan_SendBundle($this->_cPtr,$bundle);
	}

	function SendEmail($email) {
		return CkMailMan_SendEmail($this->_cPtr,$email);
	}

	function SendQ($email) {
		return CkMailMan_SendQ($this->_cPtr,$email);
	}

	function SendQ2($email,$queueDir) {
		return CkMailMan_SendQ2($this->_cPtr,$email,$queueDir);
	}

	function LoadMbx($mbxFileName) {
		$r=CkMailMan_LoadMbx($this->_cPtr,$mbxFileName);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkEmailBundle($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function LoadEml($emlFilename) {
		$r=CkMailMan_LoadEml($this->_cPtr,$emlFilename);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkEmail($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function LoadMime($mimeText) {
		$r=CkMailMan_LoadMime($this->_cPtr,$mimeText);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkEmail($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function IsUnlocked() {
		return CkMailMan_IsUnlocked($this->_cPtr);
	}

	function SendMime($from,$recipients,$mimeMsg) {
		return CkMailMan_SendMime($this->_cPtr,$from,$recipients,$mimeMsg);
	}

	function SendMimeQ($from,$recipients,$mimeMsg) {
		return CkMailMan_SendMimeQ($this->_cPtr,$from,$recipients,$mimeMsg);
	}
}


?>