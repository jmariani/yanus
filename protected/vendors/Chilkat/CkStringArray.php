<?php
class CkStringArray {

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
		if (is_resource($res) && get_resource_type($res) === '_p_CkStringArray') {
			$this->_cPtr=$res;
			return;
		}
		$this->_cPtr=new_CkStringArray();
	}

	function strAt($index) {
		return CkStringArray_strAt($this->_cPtr,$index);
	}

	function getString($index) {
		return CkStringArray_getString($this->_cPtr,$index);
	}

	function serialize() {
		return CkStringArray_serialize($this->_cPtr);
	}

	function pop() {
		return CkStringArray_pop($this->_cPtr);
	}

	function lastString() {
		return CkStringArray_lastString($this->_cPtr);
	}

	function LoadFromText($str) {
		CkStringArray_LoadFromText($this->_cPtr,$str);
	}

	function SaveNthToFile($index,$filename) {
		return CkStringArray_SaveNthToFile($this->_cPtr,$index,$filename);
	}

	function saveToText() {
		return CkStringArray_saveToText($this->_cPtr);
	}

	function FindFirstMatch($str,$firstIndex) {
		return CkStringArray_FindFirstMatch($this->_cPtr,$str,$firstIndex);
	}

	function Union($array) {
		CkStringArray_Union($this->_cPtr,$array);
	}

	function GetStringLen($index) {
		return CkStringArray_GetStringLen($this->_cPtr,$index);
	}

	function get_Utf8() {
		return CkStringArray_get_Utf8($this->_cPtr);
	}

	function put_Utf8($b) {
		CkStringArray_put_Utf8($this->_cPtr,$b);
	}

	function SplitAndAppend($str,$boundary) {
		CkStringArray_SplitAndAppend($this->_cPtr,$str,$boundary);
	}

	function Append($str) {
		CkStringArray_Append($this->_cPtr,$str);
	}

	function get_Count() {
		return CkStringArray_get_Count($this->_cPtr);
	}

	function LoadFromFile($filename) {
		return CkStringArray_LoadFromFile($this->_cPtr,$filename);
	}

	function SaveToFile($filename) {
		return CkStringArray_SaveToFile($this->_cPtr,$filename);
	}

	function RemoveAt($index) {
		return CkStringArray_RemoveAt($this->_cPtr,$index);
	}

	function InsertAt($index,$str) {
		CkStringArray_InsertAt($this->_cPtr,$index,$str);
	}

	function Find($str,$firstIndex) {
		return CkStringArray_Find($this->_cPtr,$str,$firstIndex);
	}

	function Prepend($str) {
		CkStringArray_Prepend($this->_cPtr,$str);
	}

	function get_Crlf() {
		return CkStringArray_get_Crlf($this->_cPtr);
	}

	function put_Crlf($newVal) {
		CkStringArray_put_Crlf($this->_cPtr,$newVal);
	}

	function get_Trim() {
		return CkStringArray_get_Trim($this->_cPtr);
	}

	function put_Trim($newVal) {
		CkStringArray_put_Trim($this->_cPtr,$newVal);
	}

	function get_Unique() {
		return CkStringArray_get_Unique($this->_cPtr);
	}

	function put_Unique($newVal) {
		CkStringArray_put_Unique($this->_cPtr,$newVal);
	}

	function AppendSerialized($encodedStr) {
		return CkStringArray_AppendSerialized($this->_cPtr,$encodedStr);
	}

	function Remove($str) {
		CkStringArray_Remove($this->_cPtr,$str);
	}

	function Contains($str) {
		return CkStringArray_Contains($this->_cPtr,$str);
	}

	function Clear() {
		CkStringArray_Clear($this->_cPtr);
	}

	function Sort($ascending) {
		CkStringArray_Sort($this->_cPtr,$ascending);
	}
}


?>