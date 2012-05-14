<?php
class CkXmp {

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
		if (is_resource($res) && get_resource_type($res) === '_p_CkXmp') {
			$this->_cPtr=$res;
			return;
		}
		$this->_cPtr=new_CkXmp();
	}

	function get_Utf8() {
		return CkXmp_get_Utf8($this->_cPtr);
	}

	function put_Utf8($b) {
		CkXmp_put_Utf8($this->_cPtr,$b);
	}

	function lastErrorText() {
		return CkXmp_lastErrorText($this->_cPtr);
	}

	function lastErrorXml() {
		return CkXmp_lastErrorXml($this->_cPtr);
	}

	function lastErrorHtml() {
		return CkXmp_lastErrorHtml($this->_cPtr);
	}

	function getSimpleStr($xml,$propName) {
		return CkXmp_getSimpleStr($this->_cPtr,$xml,$propName);
	}

	function getStructValue($xml,$structName,$propName) {
		return CkXmp_getStructValue($this->_cPtr,$xml,$structName,$propName);
	}

	function simpleStr($xml,$propName) {
		return CkXmp_simpleStr($this->_cPtr,$xml,$propName);
	}

	function structValue($xml,$structName,$propName) {
		return CkXmp_structValue($this->_cPtr,$xml,$structName,$propName);
	}

	function version() {
		return CkXmp_version($this->_cPtr);
	}

	function dateToString($sysTime) {
		return CkXmp_dateToString($this->_cPtr,$sysTime);
	}

	function LoadFromBuffer($byteData,$ext) {
		return CkXmp_LoadFromBuffer($this->_cPtr,$byteData,$ext);
	}

	function SaveToBuffer($byteData) {
		return CkXmp_SaveToBuffer($this->_cPtr,$byteData);
	}

	function SaveLastError($filename) {
		return CkXmp_SaveLastError($this->_cPtr,$filename);
	}

	function UnlockComponent($unlockCode) {
		return CkXmp_UnlockComponent($this->_cPtr,$unlockCode);
	}

	function get_Version($strOut) {
		CkXmp_get_Version($this->_cPtr,$strOut);
	}

	function get_NumEmbedded() {
		return CkXmp_get_NumEmbedded($this->_cPtr);
	}

	function LoadAppFile($filename) {
		return CkXmp_LoadAppFile($this->_cPtr,$filename);
	}

	function SaveAppFile($filename) {
		return CkXmp_SaveAppFile($this->_cPtr,$filename);
	}

	function GetEmbedded($index) {
		$r=CkXmp_GetEmbedded($this->_cPtr,$index);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkXml($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function GetSimpleInt($xml,$propName) {
		return CkXmp_GetSimpleInt($this->_cPtr,$xml,$propName);
	}

	function GetSimpleDate($xml,$propName,$sysTime) {
		return CkXmp_GetSimpleDate($this->_cPtr,$xml,$propName,$sysTime);
	}

	function AddSimpleStr($xml,$propName,$propVal) {
		return CkXmp_AddSimpleStr($this->_cPtr,$xml,$propName,$propVal);
	}

	function AddSimpleInt($xml,$propName,$propVal) {
		return CkXmp_AddSimpleInt($this->_cPtr,$xml,$propName,$propVal);
	}

	function AddSimpleDate($xml,$propName,$sysTime) {
		return CkXmp_AddSimpleDate($this->_cPtr,$xml,$propName,$sysTime);
	}

	function AddNsMapping($ns,$uri) {
		CkXmp_AddNsMapping($this->_cPtr,$ns,$uri);
	}

	function RemoveNsMapping($ns) {
		CkXmp_RemoveNsMapping($this->_cPtr,$ns);
	}

	function NewXmp($xmlOut) {
		CkXmp_NewXmp($this->_cPtr,$xmlOut);
	}

	function StringToDate($str,$sysTime) {
		return CkXmp_StringToDate($this->_cPtr,$str,$sysTime);
	}

	function RemoveSimple($xml,$propName) {
		return CkXmp_RemoveSimple($this->_cPtr,$xml,$propName);
	}

	function Append($xml) {
		return CkXmp_Append($this->_cPtr,$xml);
	}

	function RemoveAllEmbedded() {
		CkXmp_RemoveAllEmbedded($this->_cPtr);
	}

	function RemoveEmbedded($index) {
		CkXmp_RemoveEmbedded($this->_cPtr,$index);
	}

	function get_StructInnerDescrip() {
		return CkXmp_get_StructInnerDescrip($this->_cPtr);
	}

	function put_StructInnerDescrip($val) {
		CkXmp_put_StructInnerDescrip($this->_cPtr,$val);
	}

	function GetProperty($xml,$propName) {
		$r=CkXmp_GetProperty($this->_cPtr,$xml,$propName);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkXml($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function GetArray($xml,$propName,$array) {
		return CkXmp_GetArray($this->_cPtr,$xml,$propName,$array);
	}

	function RemoveArray($xml,$propName) {
		return CkXmp_RemoveArray($this->_cPtr,$xml,$propName);
	}

	function AddArray($xml,$arrType,$propName,$values) {
		return CkXmp_AddArray($this->_cPtr,$xml,$arrType,$propName,$values);
	}

	function GetStructPropNames($xml,$structName,$array) {
		return CkXmp_GetStructPropNames($this->_cPtr,$xml,$structName,$array);
	}

	function RemoveStruct($xml,$structName) {
		return CkXmp_RemoveStruct($this->_cPtr,$xml,$structName);
	}

	function RemoveStructProp($xml,$structName,$propName) {
		return CkXmp_RemoveStructProp($this->_cPtr,$xml,$structName,$propName);
	}

	function AddStructProp($xml,$structName,$propName,$propVal) {
		return CkXmp_AddStructProp($this->_cPtr,$xml,$structName,$propName,$propVal);
	}
}


?>