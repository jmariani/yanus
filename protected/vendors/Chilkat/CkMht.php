<?php
class CkMht {

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
		if (is_resource($res) && get_resource_type($res) === '_p_CkMht') {
			$this->_cPtr=$res;
			return;
		}
		$this->_cPtr=new_CkMht();
	}

	function lastErrorText() {
		return CkMht_lastErrorText($this->_cPtr);
	}

	function lastErrorXml() {
		return CkMht_lastErrorXml($this->_cPtr);
	}

	function lastErrorHtml() {
		return CkMht_lastErrorHtml($this->_cPtr);
	}

	function get_UseIEProxy() {
		return CkMht_get_UseIEProxy($this->_cPtr);
	}

	function put_UseIEProxy($newVal) {
		CkMht_put_UseIEProxy($this->_cPtr,$newVal);
	}

	function get_UseFilename() {
		return CkMht_get_UseFilename($this->_cPtr);
	}

	function put_UseFilename($newVal) {
		CkMht_put_UseFilename($this->_cPtr,$newVal);
	}

	function get_UseInline() {
		return CkMht_get_UseInline($this->_cPtr);
	}

	function put_UseInline($newVal) {
		CkMht_put_UseInline($this->_cPtr,$newVal);
	}

	function GetMime($url) {
		$r=CkMht_GetMime($this->_cPtr,$url);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkMime($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function HtmlToEMLFile($html,$emlFilename) {
		return CkMht_HtmlToEMLFile($this->_cPtr,$html,$emlFilename);
	}

	function HtmlToMHTFile($html,$mhtFilename) {
		return CkMht_HtmlToMHTFile($this->_cPtr,$html,$mhtFilename);
	}

	function get_EmbedLocalOnly() {
		return CkMht_get_EmbedLocalOnly($this->_cPtr);
	}

	function put_EmbedLocalOnly($newVal) {
		CkMht_put_EmbedLocalOnly($this->_cPtr,$newVal);
	}

	function get_SocksUsername($str) {
		CkMht_get_SocksUsername($this->_cPtr,$str);
	}

	function socksUsername() {
		return CkMht_socksUsername($this->_cPtr);
	}

	function put_SocksUsername($newVal) {
		CkMht_put_SocksUsername($this->_cPtr,$newVal);
	}

	function get_SocksPassword($str) {
		CkMht_get_SocksPassword($this->_cPtr,$str);
	}

	function socksPassword() {
		return CkMht_socksPassword($this->_cPtr);
	}

	function put_SocksPassword($newVal) {
		CkMht_put_SocksPassword($this->_cPtr,$newVal);
	}

	function get_SocksHostname($str) {
		CkMht_get_SocksHostname($this->_cPtr,$str);
	}

	function socksHostname() {
		return CkMht_socksHostname($this->_cPtr);
	}

	function put_SocksHostname($newVal) {
		CkMht_put_SocksHostname($this->_cPtr,$newVal);
	}

	function get_SocksPort() {
		return CkMht_get_SocksPort($this->_cPtr);
	}

	function put_SocksPort($newVal) {
		CkMht_put_SocksPort($this->_cPtr,$newVal);
	}

	function get_SocksVersion() {
		return CkMht_get_SocksVersion($this->_cPtr);
	}

	function put_SocksVersion($newVal) {
		CkMht_put_SocksVersion($this->_cPtr,$newVal);
	}

	function get_VerboseLogging() {
		return CkMht_get_VerboseLogging($this->_cPtr);
	}

	function put_VerboseLogging($newVal) {
		CkMht_put_VerboseLogging($this->_cPtr,$newVal);
	}

	function get_UnpackUseRelPaths() {
		return CkMht_get_UnpackUseRelPaths($this->_cPtr);
	}

	function put_UnpackUseRelPaths($newVal) {
		CkMht_put_UnpackUseRelPaths($this->_cPtr,$newVal);
	}

	function get_DebugLogFilePath($str) {
		CkMht_get_DebugLogFilePath($this->_cPtr,$str);
	}

	function debugLogFilePath() {
		return CkMht_debugLogFilePath($this->_cPtr);
	}

	function put_DebugLogFilePath($newVal) {
		CkMht_put_DebugLogFilePath($this->_cPtr,$newVal);
	}

	function get_WebSiteLoginDomain($str) {
		CkMht_get_WebSiteLoginDomain($this->_cPtr,$str);
	}

	function webSiteLoginDomain() {
		return CkMht_webSiteLoginDomain($this->_cPtr);
	}

	function put_WebSiteLoginDomain($newVal) {
		CkMht_put_WebSiteLoginDomain($this->_cPtr,$newVal);
	}

	function get_ProxyLogin($str) {
		CkMht_get_ProxyLogin($this->_cPtr,$str);
	}

	function put_ProxyLogin($newVal) {
		CkMht_put_ProxyLogin($this->_cPtr,$newVal);
	}

	function get_ProxyPassword($str) {
		CkMht_get_ProxyPassword($this->_cPtr,$str);
	}

	function put_ProxyPassword($newVal) {
		CkMht_put_ProxyPassword($this->_cPtr,$newVal);
	}

	function proxyLogin() {
		return CkMht_proxyLogin($this->_cPtr);
	}

	function proxyPassword() {
		return CkMht_proxyPassword($this->_cPtr);
	}

	function put_NumCacheLevels($v) {
		CkMht_put_NumCacheLevels($this->_cPtr,$v);
	}

	function get_NumCacheLevels() {
		return CkMht_get_NumCacheLevels($this->_cPtr);
	}

	function get_NumCacheRoots() {
		return CkMht_get_NumCacheRoots($this->_cPtr);
	}

	function getCacheRoot($index) {
		return CkMht_getCacheRoot($this->_cPtr,$index);
	}

	function AddCacheRoot($dir) {
		CkMht_AddCacheRoot($this->_cPtr,$dir);
	}

	function get_UpdateCache() {
		return CkMht_get_UpdateCache($this->_cPtr);
	}

	function put_UpdateCache($b) {
		CkMht_put_UpdateCache($this->_cPtr,$b);
	}

	function get_FetchFromCache() {
		return CkMht_get_FetchFromCache($this->_cPtr);
	}

	function put_FetchFromCache($b) {
		CkMht_put_FetchFromCache($this->_cPtr,$b);
	}

	function get_IgnoreNoCache() {
		return CkMht_get_IgnoreNoCache($this->_cPtr);
	}

	function put_IgnoreNoCache($b) {
		CkMht_put_IgnoreNoCache($this->_cPtr,$b);
	}

	function get_IgnoreMustRevalidate() {
		return CkMht_get_IgnoreMustRevalidate($this->_cPtr);
	}

	function put_IgnoreMustRevalidate($b) {
		CkMht_put_IgnoreMustRevalidate($this->_cPtr,$b);
	}

	function getMHT($url) {
		return CkMht_getMHT($this->_cPtr,$url);
	}

	function getEML($url) {
		return CkMht_getEML($this->_cPtr,$url);
	}

	function htmlToMHT($htmlText) {
		return CkMht_htmlToMHT($this->_cPtr,$htmlText);
	}

	function htmlToEML($htmlText) {
		return CkMht_htmlToEML($this->_cPtr,$htmlText);
	}

	function webSiteLogin() {
		return CkMht_webSiteLogin($this->_cPtr);
	}

	function webSitePassword() {
		return CkMht_webSitePassword($this->_cPtr);
	}

	function debugHtmlBefore() {
		return CkMht_debugHtmlBefore($this->_cPtr);
	}

	function debugHtmlAfter() {
		return CkMht_debugHtmlAfter($this->_cPtr);
	}

	function baseUrl() {
		return CkMht_baseUrl($this->_cPtr);
	}

	function proxy() {
		return CkMht_proxy($this->_cPtr);
	}

	function version() {
		return CkMht_version($this->_cPtr);
	}

	function get_Utf8() {
		return CkMht_get_Utf8($this->_cPtr);
	}

	function put_Utf8($b) {
		CkMht_put_Utf8($this->_cPtr,$b);
	}

	function get_NtlmAuth() {
		return CkMht_get_NtlmAuth($this->_cPtr);
	}

	function put_NtlmAuth($newVal) {
		CkMht_put_NtlmAuth($this->_cPtr,$newVal);
	}

	function UnpackMHT($mhtFilename,$unpackDir,$htmlFilename,$partsSubDir) {
		return CkMht_UnpackMHT($this->_cPtr,$mhtFilename,$unpackDir,$htmlFilename,$partsSubDir);
	}

	function UnpackMHTString($mhtContents,$unpackDir,$htmlFilename,$partsSubDir) {
		return CkMht_UnpackMHTString($this->_cPtr,$mhtContents,$unpackDir,$htmlFilename,$partsSubDir);
	}

	function GetAndZipMHT($url,$zipEntryFilename,$zipFilename) {
		return CkMht_GetAndZipMHT($this->_cPtr,$url,$zipEntryFilename,$zipFilename);
	}

	function GetAndZipEML($url,$zipEntryFilename,$zipFilename) {
		return CkMht_GetAndZipEML($this->_cPtr,$url,$zipEntryFilename,$zipFilename);
	}

	function GetEmail($url) {
		$r=CkMht_GetEmail($this->_cPtr,$url);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkEmail($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function GetAndSaveMHT($url,$mhtFilename) {
		return CkMht_GetAndSaveMHT($this->_cPtr,$url,$mhtFilename);
	}

	function GetAndSaveEML($url,$emlFilename) {
		return CkMht_GetAndSaveEML($this->_cPtr,$url,$emlFilename);
	}

	function HtmlToEmail($htmlText) {
		$r=CkMht_HtmlToEmail($this->_cPtr,$htmlText);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkEmail($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function UnlockComponent($unlockCode) {
		return CkMht_UnlockComponent($this->_cPtr,$unlockCode);
	}

	function IsUnlocked() {
		return CkMht_IsUnlocked($this->_cPtr);
	}

	function AddExternalStyleSheet($url) {
		CkMht_AddExternalStyleSheet($this->_cPtr,$url);
	}

	function ExcludeImagesMatching($pattern) {
		CkMht_ExcludeImagesMatching($this->_cPtr,$pattern);
	}

	function RestoreDefaults() {
		CkMht_RestoreDefaults($this->_cPtr);
	}

	function get_PreferMHTScripts() {
		return CkMht_get_PreferMHTScripts($this->_cPtr);
	}

	function put_PreferMHTScripts($newVal) {
		CkMht_put_PreferMHTScripts($this->_cPtr,$newVal);
	}

	function get_NoScripts() {
		return CkMht_get_NoScripts($this->_cPtr);
	}

	function put_NoScripts($newVal) {
		CkMht_put_NoScripts($this->_cPtr,$newVal);
	}

	function get_UseCids() {
		return CkMht_get_UseCids($this->_cPtr);
	}

	function put_UseCids($newVal) {
		CkMht_put_UseCids($this->_cPtr,$newVal);
	}

	function get_EmbedImages() {
		return CkMht_get_EmbedImages($this->_cPtr);
	}

	function put_EmbedImages($newVal) {
		CkMht_put_EmbedImages($this->_cPtr,$newVal);
	}

	function get_DebugTagCleaning() {
		return CkMht_get_DebugTagCleaning($this->_cPtr);
	}

	function put_DebugTagCleaning($newVal) {
		CkMht_put_DebugTagCleaning($this->_cPtr,$newVal);
	}

	function get_WebSiteLogin($str) {
		CkMht_get_WebSiteLogin($this->_cPtr,$str);
	}

	function put_WebSiteLogin($newVal) {
		CkMht_put_WebSiteLogin($this->_cPtr,$newVal);
	}

	function get_WebSitePassword($str) {
		CkMht_get_WebSitePassword($this->_cPtr,$str);
	}

	function put_WebSitePassword($newVal) {
		CkMht_put_WebSitePassword($this->_cPtr,$newVal);
	}

	function get_DebugHtmlBefore($str) {
		CkMht_get_DebugHtmlBefore($this->_cPtr,$str);
	}

	function put_DebugHtmlBefore($newVal) {
		CkMht_put_DebugHtmlBefore($this->_cPtr,$newVal);
	}

	function get_DebugHtmlAfter($str) {
		CkMht_get_DebugHtmlAfter($this->_cPtr,$str);
	}

	function put_DebugHtmlAfter($newVal) {
		CkMht_put_DebugHtmlAfter($this->_cPtr,$newVal);
	}

	function get_BaseUrl($str) {
		CkMht_get_BaseUrl($this->_cPtr,$str);
	}

	function put_BaseUrl($newVal) {
		CkMht_put_BaseUrl($this->_cPtr,$newVal);
	}

	function get_Proxy($str) {
		CkMht_get_Proxy($this->_cPtr,$str);
	}

	function put_Proxy($newVal) {
		CkMht_put_Proxy($this->_cPtr,$newVal);
	}

	function get_Version($str) {
		CkMht_get_Version($this->_cPtr,$str);
	}

	function get_ReadTimeout() {
		return CkMht_get_ReadTimeout($this->_cPtr);
	}

	function put_ReadTimeout($newVal) {
		CkMht_put_ReadTimeout($this->_cPtr,$newVal);
	}

	function get_ConnectTimeout() {
		return CkMht_get_ConnectTimeout($this->_cPtr);
	}

	function put_ConnectTimeout($newVal) {
		CkMht_put_ConnectTimeout($this->_cPtr,$newVal);
	}

	function AddCustomHeader($name,$value) {
		CkMht_AddCustomHeader($this->_cPtr,$name,$value);
	}

	function RemoveCustomHeader($name) {
		CkMht_RemoveCustomHeader($this->_cPtr,$name);
	}

	function ClearCustomHeaders() {
		CkMht_ClearCustomHeaders($this->_cPtr);
	}

	function SaveLastError($filename) {
		return CkMht_SaveLastError($this->_cPtr,$filename);
	}
}


?>