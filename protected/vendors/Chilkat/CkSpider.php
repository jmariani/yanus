<?php
class CkSpider {

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
		if (is_resource($res) && get_resource_type($res) === '_p_CkSpider') {
			$this->_cPtr=$res;
			return;
		}
		$this->_cPtr=new_CkSpider();
	}

	function getAvoidPattern($index) {
		return CkSpider_getAvoidPattern($this->_cPtr,$index);
	}

	function getOutboundLink($index) {
		return CkSpider_getOutboundLink($this->_cPtr,$index);
	}

	function getFailedUrl($index) {
		return CkSpider_getFailedUrl($this->_cPtr,$index);
	}

	function getSpideredUrl($index) {
		return CkSpider_getSpideredUrl($this->_cPtr,$index);
	}

	function getUnspideredUrl($index) {
		return CkSpider_getUnspideredUrl($this->_cPtr,$index);
	}

	function get_ProxyDomain($str) {
		CkSpider_get_ProxyDomain($this->_cPtr,$str);
	}

	function proxyDomain() {
		return CkSpider_proxyDomain($this->_cPtr);
	}

	function put_ProxyDomain($newVal) {
		CkSpider_put_ProxyDomain($this->_cPtr,$newVal);
	}

	function get_ProxyLogin($str) {
		CkSpider_get_ProxyLogin($this->_cPtr,$str);
	}

	function proxyLogin() {
		return CkSpider_proxyLogin($this->_cPtr);
	}

	function put_ProxyLogin($newVal) {
		CkSpider_put_ProxyLogin($this->_cPtr,$newVal);
	}

	function get_ProxyPassword($str) {
		CkSpider_get_ProxyPassword($this->_cPtr,$str);
	}

	function proxyPassword() {
		return CkSpider_proxyPassword($this->_cPtr);
	}

	function put_ProxyPassword($newVal) {
		CkSpider_put_ProxyPassword($this->_cPtr,$newVal);
	}

	function get_ProxyPort() {
		return CkSpider_get_ProxyPort($this->_cPtr);
	}

	function put_ProxyPort($newVal) {
		CkSpider_put_ProxyPort($this->_cPtr,$newVal);
	}

	function get_VerboseLogging() {
		return CkSpider_get_VerboseLogging($this->_cPtr);
	}

	function put_VerboseLogging($newVal) {
		CkSpider_put_VerboseLogging($this->_cPtr,$newVal);
	}

	function put_UserAgent($ua) {
		CkSpider_put_UserAgent($this->_cPtr,$ua);
	}

	function userAgent() {
		return CkSpider_userAgent($this->_cPtr);
	}

	function get_UserAgent($strOut) {
		CkSpider_get_UserAgent($this->_cPtr,$strOut);
	}

	function cacheDir() {
		return CkSpider_cacheDir($this->_cPtr);
	}

	function avoidPattern($index) {
		return CkSpider_avoidPattern($this->_cPtr,$index);
	}

	function outboundLink($index) {
		return CkSpider_outboundLink($this->_cPtr,$index);
	}

	function failedUrl($index) {
		return CkSpider_failedUrl($this->_cPtr,$index);
	}

	function spideredUrl($index) {
		return CkSpider_spideredUrl($this->_cPtr,$index);
	}

	function unspideredUrl($index) {
		return CkSpider_unspideredUrl($this->_cPtr,$index);
	}

	function domain() {
		return CkSpider_domain($this->_cPtr);
	}

	function lastHtmlDescription() {
		return CkSpider_lastHtmlDescription($this->_cPtr);
	}

	function lastHtmlKeywords() {
		return CkSpider_lastHtmlKeywords($this->_cPtr);
	}

	function lastHtmlTitle() {
		return CkSpider_lastHtmlTitle($this->_cPtr);
	}

	function lastHtml() {
		return CkSpider_lastHtml($this->_cPtr);
	}

	function lastUrl() {
		return CkSpider_lastUrl($this->_cPtr);
	}

	function lastModDateStr() {
		return CkSpider_lastModDateStr($this->_cPtr);
	}

	function fetchRobotsText() {
		return CkSpider_fetchRobotsText($this->_cPtr);
	}

	function getUrlDomain($url) {
		return CkSpider_getUrlDomain($this->_cPtr,$url);
	}

	function getBaseDomain($domain) {
		return CkSpider_getBaseDomain($this->_cPtr,$domain);
	}

	function canonicalizeUrl($url) {
		return CkSpider_canonicalizeUrl($this->_cPtr,$url);
	}

	function lastErrorText() {
		return CkSpider_lastErrorText($this->_cPtr);
	}

	function lastErrorXml() {
		return CkSpider_lastErrorXml($this->_cPtr);
	}

	function lastErrorHtml() {
		return CkSpider_lastErrorHtml($this->_cPtr);
	}

	function get_LastHtmlDescription($strOut) {
		CkSpider_get_LastHtmlDescription($this->_cPtr,$strOut);
	}

	function get_LastHtmlKeywords($strOut) {
		CkSpider_get_LastHtmlKeywords($this->_cPtr,$strOut);
	}

	function get_LastHtmlTitle($strOut) {
		CkSpider_get_LastHtmlTitle($this->_cPtr,$strOut);
	}

	function get_LastHtml($strOut) {
		CkSpider_get_LastHtml($this->_cPtr,$strOut);
	}

	function get_LastFromCache() {
		return CkSpider_get_LastFromCache($this->_cPtr);
	}

	function get_LastModDate($sysTime) {
		CkSpider_get_LastModDate($this->_cPtr,$sysTime);
	}

	function get_LastUrl($strOut) {
		CkSpider_get_LastUrl($this->_cPtr,$strOut);
	}

	function get_LastModDateStr($strOut) {
		CkSpider_get_LastModDateStr($this->_cPtr,$strOut);
	}

	function SleepMs($millisec) {
		CkSpider_SleepMs($this->_cPtr,$millisec);
	}

	function SkipUnspidered($index) {
		CkSpider_SkipUnspidered($this->_cPtr,$index);
	}

	function get_Domain($strOut) {
		CkSpider_get_Domain($this->_cPtr,$strOut);
	}

	function AddMustMatchPattern($pattern) {
		CkSpider_AddMustMatchPattern($this->_cPtr,$pattern);
	}

	function AddAvoidOutboundLinkPattern($pattern) {
		CkSpider_AddAvoidOutboundLinkPattern($this->_cPtr,$pattern);
	}

	function AddAvoidPattern($pattern) {
		CkSpider_AddAvoidPattern($this->_cPtr,$pattern);
	}

	function RecrawlLast() {
		return CkSpider_RecrawlLast($this->_cPtr);
	}

	function ClearOutboundLinks() {
		CkSpider_ClearOutboundLinks($this->_cPtr);
	}

	function ClearFailedUrls() {
		CkSpider_ClearFailedUrls($this->_cPtr);
	}

	function ClearSpideredUrls() {
		CkSpider_ClearSpideredUrls($this->_cPtr);
	}

	function get_WindDownCount() {
		return CkSpider_get_WindDownCount($this->_cPtr);
	}

	function put_WindDownCount($newVal) {
		CkSpider_put_WindDownCount($this->_cPtr,$newVal);
	}

	function get_NumAvoidPatterns() {
		return CkSpider_get_NumAvoidPatterns($this->_cPtr);
	}

	function get_NumOutboundLinks() {
		return CkSpider_get_NumOutboundLinks($this->_cPtr);
	}

	function get_NumFailed() {
		return CkSpider_get_NumFailed($this->_cPtr);
	}

	function get_NumSpidered() {
		return CkSpider_get_NumSpidered($this->_cPtr);
	}

	function get_NumUnspidered() {
		return CkSpider_get_NumUnspidered($this->_cPtr);
	}

	function CrawlNext() {
		return CkSpider_CrawlNext($this->_cPtr);
	}

	function get_ChopAtQuery() {
		return CkSpider_get_ChopAtQuery($this->_cPtr);
	}

	function put_ChopAtQuery($newVal) {
		CkSpider_put_ChopAtQuery($this->_cPtr,$newVal);
	}

	function get_AvoidHttps() {
		return CkSpider_get_AvoidHttps($this->_cPtr);
	}

	function put_AvoidHttps($newVal) {
		CkSpider_put_AvoidHttps($this->_cPtr,$newVal);
	}

	function get_MaxResponseSize() {
		return CkSpider_get_MaxResponseSize($this->_cPtr);
	}

	function put_MaxResponseSize($newVal) {
		CkSpider_put_MaxResponseSize($this->_cPtr,$newVal);
	}

	function get_MaxUrlLen() {
		return CkSpider_get_MaxUrlLen($this->_cPtr);
	}

	function put_MaxUrlLen($newVal) {
		CkSpider_put_MaxUrlLen($this->_cPtr,$newVal);
	}

	function get_CacheDir($strOut) {
		CkSpider_get_CacheDir($this->_cPtr,$strOut);
	}

	function put_CacheDir($dir) {
		CkSpider_put_CacheDir($this->_cPtr,$dir);
	}

	function get_UpdateCache() {
		return CkSpider_get_UpdateCache($this->_cPtr);
	}

	function put_UpdateCache($newVal) {
		CkSpider_put_UpdateCache($this->_cPtr,$newVal);
	}

	function get_FetchFromCache() {
		return CkSpider_get_FetchFromCache($this->_cPtr);
	}

	function put_FetchFromCache($newVal) {
		CkSpider_put_FetchFromCache($this->_cPtr,$newVal);
	}

	function get_ConnectTimeout() {
		return CkSpider_get_ConnectTimeout($this->_cPtr);
	}

	function put_ConnectTimeout($newVal) {
		CkSpider_put_ConnectTimeout($this->_cPtr,$newVal);
	}

	function get_ReadTimeout() {
		return CkSpider_get_ReadTimeout($this->_cPtr);
	}

	function put_ReadTimeout($newVal) {
		CkSpider_put_ReadTimeout($this->_cPtr,$newVal);
	}

	function AddUnspidered($url) {
		CkSpider_AddUnspidered($this->_cPtr,$url);
	}

	function Initialize($domain) {
		CkSpider_Initialize($this->_cPtr,$domain);
	}
}


?>