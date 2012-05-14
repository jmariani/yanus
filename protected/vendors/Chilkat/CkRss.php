<?php
class CkRss {

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
		if (is_resource($res) && get_resource_type($res) === '_p_CkRss') {
			$this->_cPtr=$res;
			return;
		}
		$this->_cPtr=new_CkRss();
	}

	function get_Utf8() {
		return CkRss_get_Utf8($this->_cPtr);
	}

	function put_Utf8($b) {
		CkRss_put_Utf8($this->_cPtr,$b);
	}

	function get_NumChannels() {
		return CkRss_get_NumChannels($this->_cPtr);
	}

	function get_NumItems() {
		return CkRss_get_NumItems($this->_cPtr);
	}

	function AddNewChannel() {
		$r=CkRss_AddNewChannel($this->_cPtr);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkRss($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function AddNewImage() {
		$r=CkRss_AddNewImage($this->_cPtr);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkRss($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function AddNewItem() {
		$r=CkRss_AddNewItem($this->_cPtr);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkRss($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function DownloadRss($url) {
		return CkRss_DownloadRss($this->_cPtr,$url);
	}

	function getAttr($tag,$attrName) {
		return CkRss_getAttr($this->_cPtr,$tag,$attrName);
	}

	function GetChannel($index) {
		$r=CkRss_GetChannel($this->_cPtr,$index);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkRss($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function GetCount($tag) {
		return CkRss_GetCount($this->_cPtr,$tag);
	}

	function GetDate($tag,$sysTime) {
		return CkRss_GetDate($this->_cPtr,$tag,$sysTime);
	}

	function GetImage() {
		$r=CkRss_GetImage($this->_cPtr);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkRss($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function GetInt($tag) {
		return CkRss_GetInt($this->_cPtr,$tag);
	}

	function GetItem($index) {
		$r=CkRss_GetItem($this->_cPtr,$index);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkRss($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function getString($tag) {
		return CkRss_getString($this->_cPtr,$tag);
	}

	function LoadRssFile($filename) {
		return CkRss_LoadRssFile($this->_cPtr,$filename);
	}

	function LoadRssString($rssString) {
		return CkRss_LoadRssString($this->_cPtr,$rssString);
	}

	function mGetAttr($tag,$idx,$attrName) {
		return CkRss_mGetAttr($this->_cPtr,$tag,$idx,$attrName);
	}

	function mGetString($tag,$idx) {
		return CkRss_mGetString($this->_cPtr,$tag,$idx);
	}

	function MSetAttr($tag,$idx,$attrName,$value) {
		return CkRss_MSetAttr($this->_cPtr,$tag,$idx,$attrName,$value);
	}

	function MSetString($tag,$idx,$value) {
		return CkRss_MSetString($this->_cPtr,$tag,$idx,$value);
	}

	function NewRss() {
		CkRss_NewRss($this->_cPtr);
	}

	function Remove($tag) {
		CkRss_Remove($this->_cPtr,$tag);
	}

	function SetAttr($tag,$attrName,$value) {
		CkRss_SetAttr($this->_cPtr,$tag,$attrName,$value);
	}

	function SetDate($tag,$d) {
		CkRss_SetDate($this->_cPtr,$tag,$d);
	}

	function SetDateNow($tag) {
		CkRss_SetDateNow($this->_cPtr,$tag);
	}

	function SetInt($tag,$value) {
		CkRss_SetInt($this->_cPtr,$tag,$value);
	}

	function SetString($tag,$value) {
		CkRss_SetString($this->_cPtr,$tag,$value);
	}

	function toXmlString() {
		return CkRss_toXmlString($this->_cPtr);
	}

	function SaveLastError($filename) {
		return CkRss_SaveLastError($this->_cPtr,$filename);
	}

	function lastErrorText() {
		return CkRss_lastErrorText($this->_cPtr);
	}

	function lastErrorXml() {
		return CkRss_lastErrorXml($this->_cPtr);
	}

	function lastErrorHtml() {
		return CkRss_lastErrorHtml($this->_cPtr);
	}
}


?>