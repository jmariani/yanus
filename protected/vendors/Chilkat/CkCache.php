<?php
class CkCache {

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
		if (is_resource($res) && get_resource_type($res) === '_p_CkCache') {
			$this->_cPtr=$res;
			return;
		}
		$this->_cPtr=new_CkCache();
	}

	function get_Utf8() {
		return CkCache_get_Utf8($this->_cPtr);
	}

	function put_Utf8($b) {
		CkCache_put_Utf8($this->_cPtr,$b);
	}

	function get_LastEtagFetched($str) {
		CkCache_get_LastEtagFetched($this->_cPtr,$str);
	}

	function lastEtagFetched() {
		return CkCache_lastEtagFetched($this->_cPtr);
	}

	function get_LastExpirationFetched($sysTime) {
		CkCache_get_LastExpirationFetched($this->_cPtr,$sysTime);
	}

	function get_LastHitExpired() {
		return CkCache_get_LastHitExpired($this->_cPtr);
	}

	function get_LastKeyFetched($str) {
		CkCache_get_LastKeyFetched($this->_cPtr,$str);
	}

	function lastKeyFetched() {
		return CkCache_lastKeyFetched($this->_cPtr);
	}

	function get_Level() {
		return CkCache_get_Level($this->_cPtr);
	}

	function put_Level($newVal) {
		CkCache_put_Level($this->_cPtr,$newVal);
	}

	function get_NumRoots() {
		return CkCache_get_NumRoots($this->_cPtr);
	}

	function AddRoot($path) {
		CkCache_AddRoot($this->_cPtr,$path);
	}

	function DeleteAll() {
		return CkCache_DeleteAll($this->_cPtr);
	}

	function DeleteAllExpired() {
		return CkCache_DeleteAllExpired($this->_cPtr);
	}

	function DeleteFromCache($url) {
		return CkCache_DeleteFromCache($this->_cPtr,$url);
	}

	function DeleteOlder($dt) {
		return CkCache_DeleteOlder($this->_cPtr,$dt);
	}

	function FetchFromCache($url,$outBytes) {
		return CkCache_FetchFromCache($this->_cPtr,$url,$outBytes);
	}

	function getEtag($url) {
		return CkCache_getEtag($this->_cPtr,$url);
	}

	function GetExpiration($url,$sysTime) {
		return CkCache_GetExpiration($this->_cPtr,$url,$sysTime);
	}

	function getFilename($url) {
		return CkCache_getFilename($this->_cPtr,$url);
	}

	function getRoot($index) {
		return CkCache_getRoot($this->_cPtr,$index);
	}

	function IsCached($url) {
		return CkCache_IsCached($this->_cPtr,$url);
	}

	function SaveToCache($url,$expire,$eTag,$data) {
		return CkCache_SaveToCache($this->_cPtr,$url,$expire,$eTag,$data);
	}

	function SaveToCacheNoExpire($url,$eTag,$data) {
		return CkCache_SaveToCacheNoExpire($this->_cPtr,$url,$eTag,$data);
	}

	function UpdateExpiration($url,$dt) {
		return CkCache_UpdateExpiration($this->_cPtr,$url,$dt);
	}

	function fetchText($key) {
		return CkCache_fetchText($this->_cPtr,$key);
	}

	function SaveText($key,$expire,$eTag,$strData) {
		return CkCache_SaveText($this->_cPtr,$key,$expire,$eTag,$strData);
	}

	function SaveTextNoExpire($key,$eTag,$strData) {
		return CkCache_SaveTextNoExpire($this->_cPtr,$key,$eTag,$strData);
	}

	function SaveLastError($filename) {
		return CkCache_SaveLastError($this->_cPtr,$filename);
	}

	function lastErrorText() {
		return CkCache_lastErrorText($this->_cPtr);
	}

	function lastErrorXml() {
		return CkCache_lastErrorXml($this->_cPtr);
	}

	function lastErrorHtml() {
		return CkCache_lastErrorHtml($this->_cPtr);
	}
}


?>