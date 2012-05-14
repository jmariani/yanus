<?php
class CkHttp {

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
		if (is_resource($res) && get_resource_type($res) === '_p_CkHttp') {
			$this->_cPtr=$res;
			return;
		}
		$this->_cPtr=new_CkHttp();
	}

	function lastErrorText() {
		return CkHttp_lastErrorText($this->_cPtr);
	}

	function lastErrorXml() {
		return CkHttp_lastErrorXml($this->_cPtr);
	}

	function lastErrorHtml() {
		return CkHttp_lastErrorHtml($this->_cPtr);
	}

	function renderGet($url) {
		return CkHttp_renderGet($this->_cPtr,$url);
	}

	function getCookieXml($domain) {
		return CkHttp_getCookieXml($this->_cPtr,$domain);
	}

	function get_RequiredContentType($str) {
		CkHttp_get_RequiredContentType($this->_cPtr,$str);
	}

	function requiredContentType() {
		return CkHttp_requiredContentType($this->_cPtr);
	}

	function put_RequiredContentType($newVal) {
		CkHttp_put_RequiredContentType($this->_cPtr,$newVal);
	}

	function DownloadAppend($url,$filename) {
		return CkHttp_DownloadAppend($this->_cPtr,$url,$filename);
	}

	function PostMime($url,$mime) {
		$r=CkHttp_PostMime($this->_cPtr,$url,$mime);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkHttpResponse($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function urlDecode($str) {
		return CkHttp_urlDecode($this->_cPtr,$str);
	}

	function urlEncode($str) {
		return CkHttp_urlEncode($this->_cPtr,$str);
	}

	function get_SslProtocol($str) {
		CkHttp_get_SslProtocol($this->_cPtr,$str);
	}

	function sslProtocol() {
		return CkHttp_sslProtocol($this->_cPtr);
	}

	function put_SslProtocol($newVal) {
		CkHttp_put_SslProtocol($this->_cPtr,$newVal);
	}

	function GetHead($url) {
		$r=CkHttp_GetHead($this->_cPtr,$url);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkHttpResponse($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function xmlRpc($urlEndpoint,$xmlIn) {
		return CkHttp_xmlRpc($this->_cPtr,$urlEndpoint,$xmlIn);
	}

	function genTimeStamp() {
		return CkHttp_genTimeStamp($this->_cPtr);
	}

	function xmlRpcPut($urlEndpoint,$xmlIn) {
		return CkHttp_xmlRpcPut($this->_cPtr,$urlEndpoint,$xmlIn);
	}

	function quickPutStr($url) {
		return CkHttp_quickPutStr($this->_cPtr,$url);
	}

	function quickDeleteStr($url) {
		return CkHttp_quickDeleteStr($this->_cPtr,$url);
	}

	function putText($url,$textData,$charset,$contentType,$md5,$gzip) {
		return CkHttp_putText($this->_cPtr,$url,$textData,$charset,$contentType,$md5,$gzip);
	}

	function putBinary($url,$byteData,$contentType,$md5,$gzip) {
		return CkHttp_putBinary($this->_cPtr,$url,$byteData,$contentType,$md5,$gzip);
	}

	function get_SendBufferSize() {
		return CkHttp_get_SendBufferSize($this->_cPtr);
	}

	function put_SendBufferSize($newVal) {
		CkHttp_put_SendBufferSize($this->_cPtr,$newVal);
	}

	function get_NegotiateAuth() {
		return CkHttp_get_NegotiateAuth($this->_cPtr);
	}

	function put_NegotiateAuth($newVal) {
		CkHttp_put_NegotiateAuth($this->_cPtr,$newVal);
	}

	function get_LoginDomain($str) {
		CkHttp_get_LoginDomain($this->_cPtr,$str);
	}

	function loginDomain() {
		return CkHttp_loginDomain($this->_cPtr);
	}

	function put_LoginDomain($newVal) {
		CkHttp_put_LoginDomain($this->_cPtr,$newVal);
	}

	function get_SocksVersion() {
		return CkHttp_get_SocksVersion($this->_cPtr);
	}

	function put_SocksVersion($newVal) {
		CkHttp_put_SocksVersion($this->_cPtr,$newVal);
	}

	function get_SocksPort() {
		return CkHttp_get_SocksPort($this->_cPtr);
	}

	function put_SocksPort($newVal) {
		CkHttp_put_SocksPort($this->_cPtr,$newVal);
	}

	function get_SocksUsername($str) {
		CkHttp_get_SocksUsername($this->_cPtr,$str);
	}

	function socksUsername() {
		return CkHttp_socksUsername($this->_cPtr);
	}

	function put_SocksUsername($newVal) {
		CkHttp_put_SocksUsername($this->_cPtr,$newVal);
	}

	function get_SocksPassword($str) {
		CkHttp_get_SocksPassword($this->_cPtr,$str);
	}

	function socksPassword() {
		return CkHttp_socksPassword($this->_cPtr);
	}

	function put_SocksPassword($newVal) {
		CkHttp_put_SocksPassword($this->_cPtr,$newVal);
	}

	function get_SocksHostname($str) {
		CkHttp_get_SocksHostname($this->_cPtr,$str);
	}

	function socksHostname() {
		return CkHttp_socksHostname($this->_cPtr);
	}

	function put_SocksHostname($newVal) {
		CkHttp_put_SocksHostname($this->_cPtr,$newVal);
	}

	function PostXml($url,$xmlDoc,$charset) {
		$r=CkHttp_PostXml($this->_cPtr,$url,$xmlDoc,$charset);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkHttpResponse($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function get_ProxyPartialUrl() {
		return CkHttp_get_ProxyPartialUrl($this->_cPtr);
	}

	function put_ProxyPartialUrl($newVal) {
		CkHttp_put_ProxyPartialUrl($this->_cPtr,$newVal);
	}

	function GetServerSslCert($domain,$port) {
		$r=CkHttp_GetServerSslCert($this->_cPtr,$domain,$port);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkCert($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function get_DigestAuth() {
		return CkHttp_get_DigestAuth($this->_cPtr);
	}

	function put_DigestAuth($newVal) {
		CkHttp_put_DigestAuth($this->_cPtr,$newVal);
	}

	function SetSslClientCertPfx($pfxFilename,$pfxPassword,$certSubjectCN) {
		return CkHttp_SetSslClientCertPfx($this->_cPtr,$pfxFilename,$pfxPassword,$certSubjectCN);
	}

	function get_VerboseLogging() {
		return CkHttp_get_VerboseLogging($this->_cPtr);
	}

	function put_VerboseLogging($newVal) {
		CkHttp_put_VerboseLogging($this->_cPtr,$newVal);
	}

	function ClearInMemoryCookies() {
		CkHttp_ClearInMemoryCookies($this->_cPtr);
	}

	function SetCookieXml($domain,$cookieXml) {
		return CkHttp_SetCookieXml($this->_cPtr,$domain,$cookieXml);
	}

	function PostUrlEncoded($url,$req) {
		$r=CkHttp_PostUrlEncoded($this->_cPtr,$url,$req);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkHttpResponse($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function postBinary($url,$byteData,$contentType,$md5,$gzip) {
		return CkHttp_postBinary($this->_cPtr,$url,$byteData,$contentType,$md5,$gzip);
	}

	function QuickGetObj($url) {
		$r=CkHttp_QuickGetObj($this->_cPtr,$url);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkHttpResponse($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function get_SessionLogFilename($str) {
		CkHttp_get_SessionLogFilename($this->_cPtr,$str);
	}

	function sessionLogFilename() {
		return CkHttp_sessionLogFilename($this->_cPtr);
	}

	function put_SessionLogFilename($newVal) {
		CkHttp_put_SessionLogFilename($this->_cPtr,$newVal);
	}

	function get_BgLastErrorText($str) {
		CkHttp_get_BgLastErrorText($this->_cPtr,$str);
	}

	function bgLastErrorText() {
		return CkHttp_bgLastErrorText($this->_cPtr);
	}

	function get_BgResultData($data) {
		CkHttp_get_BgResultData($this->_cPtr,$data);
	}

	function get_BgResultInt() {
		return CkHttp_get_BgResultInt($this->_cPtr);
	}

	function get_BgResultString($str) {
		CkHttp_get_BgResultString($this->_cPtr,$str);
	}

	function bgResultString() {
		return CkHttp_bgResultString($this->_cPtr);
	}

	function get_BgTaskFinished() {
		return CkHttp_get_BgTaskFinished($this->_cPtr);
	}

	function get_BgTaskRunning() {
		return CkHttp_get_BgTaskRunning($this->_cPtr);
	}

	function get_BgTaskSuccess() {
		return CkHttp_get_BgTaskSuccess($this->_cPtr);
	}

	function get_EventLogCount() {
		return CkHttp_get_EventLogCount($this->_cPtr);
	}

	function get_KeepEventLog() {
		return CkHttp_get_KeepEventLog($this->_cPtr);
	}

	function put_KeepEventLog($newVal) {
		CkHttp_put_KeepEventLog($this->_cPtr,$newVal);
	}

	function get_UseBgThread() {
		return CkHttp_get_UseBgThread($this->_cPtr);
	}

	function put_UseBgThread($newVal) {
		CkHttp_put_UseBgThread($this->_cPtr,$newVal);
	}

	function BgResponseObject() {
		$r=CkHttp_BgResponseObject($this->_cPtr);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkHttpResponse($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function BgTaskAbort() {
		CkHttp_BgTaskAbort($this->_cPtr);
	}

	function ClearBgEventLog() {
		CkHttp_ClearBgEventLog($this->_cPtr);
	}

	function eventLogName($index) {
		return CkHttp_eventLogName($this->_cPtr,$index);
	}

	function eventLogValue($index) {
		return CkHttp_eventLogValue($this->_cPtr,$index);
	}

	function SleepMs($millisec) {
		CkHttp_SleepMs($this->_cPtr,$millisec);
	}

	function get_ClientIpAddress($str) {
		CkHttp_get_ClientIpAddress($this->_cPtr,$str);
	}

	function clientIpAddress() {
		return CkHttp_clientIpAddress($this->_cPtr);
	}

	function put_ClientIpAddress($newVal) {
		CkHttp_put_ClientIpAddress($this->_cPtr,$newVal);
	}

	function get_ProxyAuthMethod($str) {
		CkHttp_get_ProxyAuthMethod($this->_cPtr,$str);
	}

	function proxyAuthMethod() {
		return CkHttp_proxyAuthMethod($this->_cPtr);
	}

	function put_ProxyAuthMethod($newVal) {
		CkHttp_put_ProxyAuthMethod($this->_cPtr,$newVal);
	}

	function AddQuickHeader($name,$value) {
		return CkHttp_AddQuickHeader($this->_cPtr,$name,$value);
	}

	function RemoveQuickHeader($name) {
		return CkHttp_RemoveQuickHeader($this->_cPtr,$name);
	}

	function SetSslClientCertPem($pemDataOrFilename,$pemPassword) {
		return CkHttp_SetSslClientCertPem($this->_cPtr,$pemDataOrFilename,$pemPassword);
	}

	function get_AllowGzip() {
		return CkHttp_get_AllowGzip($this->_cPtr);
	}

	function put_AllowGzip($newVal) {
		CkHttp_put_AllowGzip($this->_cPtr,$newVal);
	}

	function get_BgPercentDone() {
		return CkHttp_get_BgPercentDone($this->_cPtr);
	}

	function get_RedirectVerb($str) {
		CkHttp_get_RedirectVerb($this->_cPtr,$str);
	}

	function redirectVerb() {
		return CkHttp_redirectVerb($this->_cPtr);
	}

	function put_RedirectVerb($newVal) {
		CkHttp_put_RedirectVerb($this->_cPtr,$newVal);
	}

	function get_DebugLogFilePath($str) {
		CkHttp_get_DebugLogFilePath($this->_cPtr,$str);
	}

	function debugLogFilePath() {
		return CkHttp_debugLogFilePath($this->_cPtr);
	}

	function put_DebugLogFilePath($newVal) {
		CkHttp_put_DebugLogFilePath($this->_cPtr,$newVal);
	}

	function extractMetaRefreshUrl($html) {
		return CkHttp_extractMetaRefreshUrl($this->_cPtr,$html);
	}

	function get_AwsAccessKey($str) {
		CkHttp_get_AwsAccessKey($this->_cPtr,$str);
	}

	function awsAccessKey() {
		return CkHttp_awsAccessKey($this->_cPtr);
	}

	function put_AwsAccessKey($newVal) {
		CkHttp_put_AwsAccessKey($this->_cPtr,$newVal);
	}

	function get_AwsSecretKey($str) {
		CkHttp_get_AwsSecretKey($this->_cPtr,$str);
	}

	function awsSecretKey() {
		return CkHttp_awsSecretKey($this->_cPtr);
	}

	function put_AwsSecretKey($newVal) {
		CkHttp_put_AwsSecretKey($this->_cPtr,$newVal);
	}

	function s3_ListBuckets() {
		return CkHttp_s3_ListBuckets($this->_cPtr);
	}

	function S3_UploadString($objectContent,$charset,$contentType,$bucketName,$ObjectName) {
		return CkHttp_S3_UploadString($this->_cPtr,$objectContent,$charset,$contentType,$bucketName,$ObjectName);
	}

	function S3_DeleteObject($bucketName,$objectName) {
		return CkHttp_S3_DeleteObject($this->_cPtr,$bucketName,$objectName);
	}

	function S3_UploadBytes($objectContent,$contentType,$bucketName,$objectName) {
		return CkHttp_S3_UploadBytes($this->_cPtr,$objectContent,$contentType,$bucketName,$objectName);
	}

	function S3_CreateBucket($bucketName) {
		return CkHttp_S3_CreateBucket($this->_cPtr,$bucketName);
	}

	function S3_DeleteBucket($bucketName) {
		return CkHttp_S3_DeleteBucket($this->_cPtr,$bucketName);
	}

	function S3_DownloadBytes($bucketName,$objectName,$outBytes) {
		return CkHttp_S3_DownloadBytes($this->_cPtr,$bucketName,$objectName,$outBytes);
	}

	function s3_DownloadString($bucketName,$objectName,$charset) {
		return CkHttp_s3_DownloadString($this->_cPtr,$bucketName,$objectName,$charset);
	}

	function s3_ListBucketObjects($bucketName) {
		return CkHttp_s3_ListBucketObjects($this->_cPtr,$bucketName);
	}

	function S3_DownloadFile($bucketName,$objectName,$localFilePath) {
		return CkHttp_S3_DownloadFile($this->_cPtr,$bucketName,$objectName,$localFilePath);
	}

	function S3_UploadFile($localFilePath,$contentType,$bucketName,$ObjectName) {
		return CkHttp_S3_UploadFile($this->_cPtr,$localFilePath,$contentType,$bucketName,$ObjectName);
	}

	function CloseAllConnections() {
		return CkHttp_CloseAllConnections($this->_cPtr);
	}

	function downloadHash($url,$hashAlgorithm,$encoding) {
		return CkHttp_downloadHash($this->_cPtr,$url,$hashAlgorithm,$encoding);
	}

	function PostJson($url,$jsonText) {
		$r=CkHttp_PostJson($this->_cPtr,$url,$jsonText);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkHttpResponse($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function get_AwsSubResources($str) {
		CkHttp_get_AwsSubResources($this->_cPtr,$str);
	}

	function awsSubResources() {
		return CkHttp_awsSubResources($this->_cPtr);
	}

	function put_AwsSubResources($newVal) {
		CkHttp_put_AwsSubResources($this->_cPtr,$newVal);
	}

	function SetSslClientCert($cert) {
		return CkHttp_SetSslClientCert($this->_cPtr,$cert);
	}

	function get_LastHeader($str) {
		CkHttp_get_LastHeader($this->_cPtr,$str);
	}

	function lastHeader() {
		return CkHttp_lastHeader($this->_cPtr);
	}

	function put_UseIEProxy($b) {
		CkHttp_put_UseIEProxy($this->_cPtr,$b);
	}

	function get_UseIEProxy() {
		return CkHttp_get_UseIEProxy($this->_cPtr);
	}

	function get_ProxyLogin($str) {
		CkHttp_get_ProxyLogin($this->_cPtr,$str);
	}

	function put_ProxyLogin($newVal) {
		CkHttp_put_ProxyLogin($this->_cPtr,$newVal);
	}

	function get_ProxyPassword($str) {
		CkHttp_get_ProxyPassword($this->_cPtr,$str);
	}

	function put_ProxyPassword($newVal) {
		CkHttp_put_ProxyPassword($this->_cPtr,$newVal);
	}

	function proxyLogin() {
		return CkHttp_proxyLogin($this->_cPtr);
	}

	function proxyPassword() {
		return CkHttp_proxyPassword($this->_cPtr);
	}

	function version() {
		return CkHttp_version($this->_cPtr);
	}

	function cookieDir() {
		return CkHttp_cookieDir($this->_cPtr);
	}

	function quickGetStr($url) {
		return CkHttp_quickGetStr($this->_cPtr,$url);
	}

	function proxyDomain() {
		return CkHttp_proxyDomain($this->_cPtr);
	}

	function password() {
		return CkHttp_password($this->_cPtr);
	}

	function login() {
		return CkHttp_login($this->_cPtr);
	}

	function getRequestHeader($name) {
		return CkHttp_getRequestHeader($this->_cPtr,$name);
	}

	function userAgent() {
		return CkHttp_userAgent($this->_cPtr);
	}

	function referer() {
		return CkHttp_referer($this->_cPtr);
	}

	function ck_accept() {
		return CkHttp_ck_accept($this->_cPtr);
	}

	function acceptCharset() {
		return CkHttp_acceptCharset($this->_cPtr);
	}

	function acceptLanguage() {
		return CkHttp_acceptLanguage($this->_cPtr);
	}

	function connection() {
		return CkHttp_connection($this->_cPtr);
	}

	function getDomain($url) {
		return CkHttp_getDomain($this->_cPtr,$url);
	}

	function finalRedirectUrl() {
		return CkHttp_finalRedirectUrl($this->_cPtr);
	}

	function getCacheRoot($index) {
		return CkHttp_getCacheRoot($this->_cPtr,$index);
	}

	function getUrlPath($url) {
		return CkHttp_getUrlPath($this->_cPtr,$url);
	}

	function lastContentType() {
		return CkHttp_lastContentType($this->_cPtr);
	}

	function lastResponseHeader() {
		return CkHttp_lastResponseHeader($this->_cPtr);
	}

	function lastModDate() {
		return CkHttp_lastModDate($this->_cPtr);
	}

	function get_Utf8() {
		return CkHttp_get_Utf8($this->_cPtr);
	}

	function put_Utf8($b) {
		CkHttp_put_Utf8($this->_cPtr,$b);
	}

	function put_NtlmAuth($b) {
		CkHttp_put_NtlmAuth($this->_cPtr,$b);
	}

	function get_NtlmAuth() {
		return CkHttp_get_NtlmAuth($this->_cPtr);
	}

	function UnlockComponent($unlockCode) {
		return CkHttp_UnlockComponent($this->_cPtr,$unlockCode);
	}

	function IsUnlocked() {
		return CkHttp_IsUnlocked($this->_cPtr);
	}

	function Download($url,$filename) {
		return CkHttp_Download($this->_cPtr,$url,$filename);
	}

	function ResumeDownload($url,$filename) {
		return CkHttp_ResumeDownload($this->_cPtr,$url,$filename);
	}

	function get_Version($str) {
		CkHttp_get_Version($this->_cPtr,$str);
	}

	function get_MaxConnections() {
		return CkHttp_get_MaxConnections($this->_cPtr);
	}

	function put_MaxConnections($n) {
		CkHttp_put_MaxConnections($this->_cPtr,$n);
	}

	function put_CookieDir($dir) {
		CkHttp_put_CookieDir($this->_cPtr,$dir);
	}

	function get_CookieDir($str) {
		CkHttp_get_CookieDir($this->_cPtr,$str);
	}

	function put_SaveCookies($b) {
		CkHttp_put_SaveCookies($this->_cPtr,$b);
	}

	function get_SaveCookies() {
		return CkHttp_get_SaveCookies($this->_cPtr);
	}

	function put_SendCookies($b) {
		CkHttp_put_SendCookies($this->_cPtr,$b);
	}

	function get_SendCookies() {
		return CkHttp_get_SendCookies($this->_cPtr);
	}

	function QuickGet($url,$data) {
		return CkHttp_QuickGet($this->_cPtr,$url,$data);
	}

	function SynchronousRequest($domain,$port,$ssl,$req) {
		$r=CkHttp_SynchronousRequest($this->_cPtr,$domain,$port,$ssl,$req);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkHttpResponse($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function get_ProxyPort() {
		return CkHttp_get_ProxyPort($this->_cPtr);
	}

	function put_ProxyPort($n) {
		CkHttp_put_ProxyPort($this->_cPtr,$n);
	}

	function put_ProxyDomain($v) {
		CkHttp_put_ProxyDomain($this->_cPtr,$v);
	}

	function get_ProxyDomain($str) {
		CkHttp_get_ProxyDomain($this->_cPtr,$str);
	}

	function put_Login($v) {
		CkHttp_put_Login($this->_cPtr,$v);
	}

	function get_Login($str) {
		CkHttp_get_Login($this->_cPtr,$str);
	}

	function put_Password($v) {
		CkHttp_put_Password($this->_cPtr,$v);
	}

	function get_Password($str) {
		CkHttp_get_Password($this->_cPtr,$str);
	}

	function SetRequestHeader($name,$value) {
		CkHttp_SetRequestHeader($this->_cPtr,$name,$value);
	}

	function HasRequestHeader($name) {
		return CkHttp_HasRequestHeader($this->_cPtr,$name);
	}

	function RemoveRequestHeader($name) {
		CkHttp_RemoveRequestHeader($this->_cPtr,$name);
	}

	function put_UserAgent($v) {
		CkHttp_put_UserAgent($this->_cPtr,$v);
	}

	function get_UserAgent($str) {
		CkHttp_get_UserAgent($this->_cPtr,$str);
	}

	function put_Referer($v) {
		CkHttp_put_Referer($this->_cPtr,$v);
	}

	function get_Referer($str) {
		CkHttp_get_Referer($this->_cPtr,$str);
	}

	function put_Accept($v) {
		CkHttp_put_Accept($this->_cPtr,$v);
	}

	function get_Accept($str) {
		CkHttp_get_Accept($this->_cPtr,$str);
	}

	function put_AcceptCharset($v) {
		CkHttp_put_AcceptCharset($this->_cPtr,$v);
	}

	function get_AcceptCharset($str) {
		CkHttp_get_AcceptCharset($this->_cPtr,$str);
	}

	function put_AcceptLanguage($v) {
		CkHttp_put_AcceptLanguage($this->_cPtr,$v);
	}

	function get_AcceptLanguage($str) {
		CkHttp_get_AcceptLanguage($this->_cPtr,$str);
	}

	function put_Connection($v) {
		CkHttp_put_Connection($this->_cPtr,$v);
	}

	function get_Connection($str) {
		CkHttp_get_Connection($this->_cPtr,$str);
	}

	function get_MaxUrlLen() {
		return CkHttp_get_MaxUrlLen($this->_cPtr);
	}

	function put_MaxUrlLen($n) {
		CkHttp_put_MaxUrlLen($this->_cPtr,$n);
	}

	function get_MaxResponseSize() {
		return CkHttp_get_MaxResponseSize($this->_cPtr);
	}

	function put_MaxResponseSize($n) {
		CkHttp_put_MaxResponseSize($this->_cPtr,$n);
	}

	function put_MimicIE($b) {
		CkHttp_put_MimicIE($this->_cPtr,$b);
	}

	function get_MimicIE() {
		return CkHttp_get_MimicIE($this->_cPtr);
	}

	function put_MimicFireFox($b) {
		CkHttp_put_MimicFireFox($this->_cPtr,$b);
	}

	function get_MimicFireFox() {
		return CkHttp_get_MimicFireFox($this->_cPtr);
	}

	function put_AutoAddHostHeader($b) {
		CkHttp_put_AutoAddHostHeader($this->_cPtr,$b);
	}

	function get_AutoAddHostHeader() {
		return CkHttp_get_AutoAddHostHeader($this->_cPtr);
	}

	function get_ConnectTimeout() {
		return CkHttp_get_ConnectTimeout($this->_cPtr);
	}

	function put_ConnectTimeout($numSeconds) {
		CkHttp_put_ConnectTimeout($this->_cPtr,$numSeconds);
	}

	function get_ReadTimeout() {
		return CkHttp_get_ReadTimeout($this->_cPtr);
	}

	function put_ReadTimeout($numSeconds) {
		CkHttp_put_ReadTimeout($this->_cPtr,$numSeconds);
	}

	function get_WasRedirected() {
		return CkHttp_get_WasRedirected($this->_cPtr);
	}

	function get_FinalRedirectUrl($str) {
		CkHttp_get_FinalRedirectUrl($this->_cPtr,$str);
	}

	function put_FollowRedirects($b) {
		CkHttp_put_FollowRedirects($this->_cPtr,$b);
	}

	function get_FollowRedirects() {
		return CkHttp_get_FollowRedirects($this->_cPtr);
	}

	function put_NumCacheLevels($v) {
		CkHttp_put_NumCacheLevels($this->_cPtr,$v);
	}

	function get_NumCacheLevels() {
		return CkHttp_get_NumCacheLevels($this->_cPtr);
	}

	function get_NumCacheRoots() {
		return CkHttp_get_NumCacheRoots($this->_cPtr);
	}

	function AddCacheRoot($dir) {
		CkHttp_AddCacheRoot($this->_cPtr,$dir);
	}

	function get_LastStatus() {
		return CkHttp_get_LastStatus($this->_cPtr);
	}

	function get_LastContentType($strContentType) {
		CkHttp_get_LastContentType($this->_cPtr,$strContentType);
	}

	function get_LastResponseHeader($strHeader) {
		CkHttp_get_LastResponseHeader($this->_cPtr,$strHeader);
	}

	function get_LastModDate($str) {
		CkHttp_get_LastModDate($this->_cPtr,$str);
	}

	function get_UpdateCache() {
		return CkHttp_get_UpdateCache($this->_cPtr);
	}

	function put_UpdateCache($b) {
		CkHttp_put_UpdateCache($this->_cPtr,$b);
	}

	function get_FetchFromCache() {
		return CkHttp_get_FetchFromCache($this->_cPtr);
	}

	function put_FetchFromCache($b) {
		CkHttp_put_FetchFromCache($this->_cPtr,$b);
	}

	function get_IgnoreNoCache() {
		return CkHttp_get_IgnoreNoCache($this->_cPtr);
	}

	function put_IgnoreNoCache($b) {
		CkHttp_put_IgnoreNoCache($this->_cPtr,$b);
	}

	function get_IgnoreMustRevalidate() {
		return CkHttp_get_IgnoreMustRevalidate($this->_cPtr);
	}

	function put_IgnoreMustRevalidate($b) {
		CkHttp_put_IgnoreMustRevalidate($this->_cPtr,$b);
	}

	function get_DefaultFreshPeriod() {
		return CkHttp_get_DefaultFreshPeriod($this->_cPtr);
	}

	function put_DefaultFreshPeriod($numMinutes) {
		CkHttp_put_DefaultFreshPeriod($this->_cPtr,$numMinutes);
	}

	function get_FreshnessAlgorithm() {
		return CkHttp_get_FreshnessAlgorithm($this->_cPtr);
	}

	function put_FreshnessAlgorithm($v) {
		CkHttp_put_FreshnessAlgorithm($this->_cPtr,$v);
	}

	function get_LMFactor() {
		return CkHttp_get_LMFactor($this->_cPtr);
	}

	function put_LMFactor($v) {
		CkHttp_put_LMFactor($this->_cPtr,$v);
	}

	function get_MaxFreshPeriod() {
		return CkHttp_get_MaxFreshPeriod($this->_cPtr);
	}

	function put_MaxFreshPeriod($numMinutes) {
		CkHttp_put_MaxFreshPeriod($this->_cPtr,$numMinutes);
	}

	function get_MinFreshPeriod() {
		return CkHttp_get_MinFreshPeriod($this->_cPtr);
	}

	function put_MinFreshPeriod($numMinutes) {
		CkHttp_put_MinFreshPeriod($this->_cPtr,$numMinutes);
	}

	function SaveLastError($filename) {
		return CkHttp_SaveLastError($this->_cPtr,$filename);
	}
}


?>