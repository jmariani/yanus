<?php
class CkEmailBundle {

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
		if (is_resource($res) && get_resource_type($res) === '_p_CkEmailBundle') {
			$this->_cPtr=$res;
			return;
		}
		$this->_cPtr=new_CkEmailBundle();
	}

	function FindByHeader($name,$value) {
		$r=CkEmailBundle_FindByHeader($this->_cPtr,$name,$value);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkEmail($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function RemoveEmailByIndex($index) {
		return CkEmailBundle_RemoveEmailByIndex($this->_cPtr,$index);
	}

	function lastErrorText() {
		return CkEmailBundle_lastErrorText($this->_cPtr);
	}

	function lastErrorXml() {
		return CkEmailBundle_lastErrorXml($this->_cPtr);
	}

	function lastErrorHtml() {
		return CkEmailBundle_lastErrorHtml($this->_cPtr);
	}

	function getXml() {
		return CkEmailBundle_getXml($this->_cPtr);
	}

	function get_Utf8() {
		return CkEmailBundle_get_Utf8($this->_cPtr);
	}

	function put_Utf8($b) {
		CkEmailBundle_put_Utf8($this->_cPtr,$b);
	}

	function GetUidls() {
		$r=CkEmailBundle_GetUidls($this->_cPtr);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkStringArray($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function RemoveEmail($email) {
		return CkEmailBundle_RemoveEmail($this->_cPtr,$email);
	}

	function GetEmail($index) {
		$r=CkEmailBundle_GetEmail($this->_cPtr,$index);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkEmail($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function AddEmail($email) {
		return CkEmailBundle_AddEmail($this->_cPtr,$email);
	}

	function get_MessageCount() {
		return CkEmailBundle_get_MessageCount($this->_cPtr);
	}

	function SaveXml($filename) {
		return CkEmailBundle_SaveXml($this->_cPtr,$filename);
	}

	function LoadXml($filename) {
		return CkEmailBundle_LoadXml($this->_cPtr,$filename);
	}

	function LoadXmlString($xmlStr) {
		return CkEmailBundle_LoadXmlString($this->_cPtr,$xmlStr);
	}

	function SaveLastError($filename) {
		return CkEmailBundle_SaveLastError($this->_cPtr,$filename);
	}

	function SortBySubject($ascending) {
		CkEmailBundle_SortBySubject($this->_cPtr,$ascending);
	}

	function SortBySender($ascending) {
		CkEmailBundle_SortBySender($this->_cPtr,$ascending);
	}

	function SortByRecipient($ascending) {
		CkEmailBundle_SortByRecipient($this->_cPtr,$ascending);
	}

	function SortByDate($ascending) {
		CkEmailBundle_SortByDate($this->_cPtr,$ascending);
	}
}


?>