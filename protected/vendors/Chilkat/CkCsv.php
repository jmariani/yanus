<?php
class CkCsv {

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
		if (is_resource($res) && get_resource_type($res) === '_p_CkCsv') {
			$this->_cPtr=$res;
			return;
		}
		$this->_cPtr=new_CkCsv();
	}

	function get_Utf8() {
		return CkCsv_get_Utf8($this->_cPtr);
	}

	function put_Utf8($b) {
		CkCsv_put_Utf8($this->_cPtr,$b);
	}

	function SaveLastError($filename) {
		return CkCsv_SaveLastError($this->_cPtr,$filename);
	}

	function lastErrorText() {
		return CkCsv_lastErrorText($this->_cPtr);
	}

	function lastErrorXml() {
		return CkCsv_lastErrorXml($this->_cPtr);
	}

	function lastErrorHtml() {
		return CkCsv_lastErrorHtml($this->_cPtr);
	}

	function LoadFile($filename) {
		return CkCsv_LoadFile($this->_cPtr,$filename);
	}

	function SaveFile($filename) {
		return CkCsv_SaveFile($this->_cPtr,$filename);
	}

	function SaveFile2($filename,$charset) {
		return CkCsv_SaveFile2($this->_cPtr,$filename,$charset);
	}

	function LoadFile2($filename,$charset) {
		return CkCsv_LoadFile2($this->_cPtr,$filename,$charset);
	}

	function getCell($row,$col) {
		return CkCsv_getCell($this->_cPtr,$row,$col);
	}

	function get_NumRows() {
		return CkCsv_get_NumRows($this->_cPtr);
	}

	function SetCell($row,$col,$content) {
		return CkCsv_SetCell($this->_cPtr,$row,$col,$content);
	}

	function GetNumCols($row) {
		return CkCsv_GetNumCols($this->_cPtr,$row);
	}

	function get_Delimiter($str) {
		CkCsv_get_Delimiter($this->_cPtr,$str);
	}

	function delimiter() {
		return CkCsv_delimiter($this->_cPtr);
	}

	function put_Delimiter($newVal) {
		CkCsv_put_Delimiter($this->_cPtr,$newVal);
	}

	function get_Crlf() {
		return CkCsv_get_Crlf($this->_cPtr);
	}

	function put_Crlf($newVal) {
		CkCsv_put_Crlf($this->_cPtr,$newVal);
	}

	function get_HasColumnNames() {
		return CkCsv_get_HasColumnNames($this->_cPtr);
	}

	function put_HasColumnNames($newVal) {
		CkCsv_put_HasColumnNames($this->_cPtr,$newVal);
	}

	function get_NumColumns() {
		return CkCsv_get_NumColumns($this->_cPtr);
	}

	function GetIndex($columnName) {
		return CkCsv_GetIndex($this->_cPtr,$columnName);
	}

	function getColumnName($index) {
		return CkCsv_getColumnName($this->_cPtr,$index);
	}

	function LoadFromString($csvData) {
		return CkCsv_LoadFromString($this->_cPtr,$csvData);
	}

	function saveToString() {
		return CkCsv_saveToString($this->_cPtr);
	}

	function SetColumnName($index,$columnName) {
		return CkCsv_SetColumnName($this->_cPtr,$index,$columnName);
	}
}


?>