<?php
class CkZipEntry {

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
		if (is_resource($res) && get_resource_type($res) === '_p_CkZipEntry') {
			$this->_cPtr=$res;
			return;
		}
		$this->_cPtr=new_CkZipEntry();
	}

	function get_Utf8() {
		return CkZipEntry_get_Utf8($this->_cPtr);
	}

	function put_Utf8($b) {
		CkZipEntry_put_Utf8($this->_cPtr,$b);
	}

	function GetDt() {
		$r=CkZipEntry_GetDt($this->_cPtr);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkDateTime($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function SetDt($dt) {
		CkZipEntry_SetDt($this->_cPtr,$dt);
	}

	function lastErrorText() {
		return CkZipEntry_lastErrorText($this->_cPtr);
	}

	function lastErrorXml() {
		return CkZipEntry_lastErrorXml($this->_cPtr);
	}

	function lastErrorHtml() {
		return CkZipEntry_lastErrorHtml($this->_cPtr);
	}

	function fileName() {
		return CkZipEntry_fileName($this->_cPtr);
	}

	function comment() {
		return CkZipEntry_comment($this->_cPtr);
	}

	function inflateToString($addCR) {
		return CkZipEntry_inflateToString($this->_cPtr,$addCR);
	}

	function inflateToString2() {
		return CkZipEntry_inflateToString2($this->_cPtr);
	}

	function copyToBase64() {
		return CkZipEntry_copyToBase64($this->_cPtr);
	}

	function copyToHex() {
		return CkZipEntry_copyToHex($this->_cPtr);
	}

	function get_FileName($str) {
		CkZipEntry_get_FileName($this->_cPtr,$str);
	}

	function put_FileName($pStr) {
		CkZipEntry_put_FileName($this->_cPtr,$pStr);
	}

	function get_UncompressedLength() {
		return CkZipEntry_get_UncompressedLength($this->_cPtr);
	}

	function get_CompressionLevel() {
		return CkZipEntry_get_CompressionLevel($this->_cPtr);
	}

	function put_CompressionLevel($newVal) {
		CkZipEntry_put_CompressionLevel($this->_cPtr,$newVal);
	}

	function get_CompressionMethod() {
		return CkZipEntry_get_CompressionMethod($this->_cPtr);
	}

	function put_CompressionMethod($newVal) {
		CkZipEntry_put_CompressionMethod($this->_cPtr,$newVal);
	}

	function get_CompressedLength() {
		return CkZipEntry_get_CompressedLength($this->_cPtr);
	}

	function get_Comment($str) {
		CkZipEntry_get_Comment($this->_cPtr,$str);
	}

	function put_Comment($pStr) {
		CkZipEntry_put_Comment($this->_cPtr,$pStr);
	}

	function get_EntryType() {
		return CkZipEntry_get_EntryType($this->_cPtr);
	}

	function get_FileDateTime($sysTime) {
		CkZipEntry_get_FileDateTime($this->_cPtr,$sysTime);
	}

	function put_FileDateTime($sysTime) {
		CkZipEntry_put_FileDateTime($this->_cPtr,$sysTime);
	}

	function get_IsDirectory() {
		return CkZipEntry_get_IsDirectory($this->_cPtr);
	}

	function get_EntryID() {
		return CkZipEntry_get_EntryID($this->_cPtr);
	}

	function Extract($dirPath) {
		return CkZipEntry_Extract($this->_cPtr,$dirPath);
	}

	function ExtractInto($dirPath) {
		return CkZipEntry_ExtractInto($this->_cPtr,$dirPath);
	}

	function Inflate($bdata) {
		return CkZipEntry_Inflate($this->_cPtr,$bdata);
	}

	function ReplaceData($bdata) {
		return CkZipEntry_ReplaceData($this->_cPtr,$bdata);
	}

	function AppendData($bdata) {
		return CkZipEntry_AppendData($this->_cPtr,$bdata);
	}

	function Copy($bdata) {
		return CkZipEntry_Copy($this->_cPtr,$bdata);
	}

	function NextEntry() {
		$r=CkZipEntry_NextEntry($this->_cPtr);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkZipEntry($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function SaveLastError($filename) {
		return CkZipEntry_SaveLastError($this->_cPtr,$filename);
	}
}


?>