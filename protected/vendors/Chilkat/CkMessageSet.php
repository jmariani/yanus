<?php
class CkMessageSet {

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
		if (is_resource($res) && get_resource_type($res) === '_p_CkMessageSet') {
			$this->_cPtr=$res;
			return;
		}
		$this->_cPtr=new_CkMessageSet();
	}

	function toString() {
		return CkMessageSet_toString($this->_cPtr);
	}

	function toCompactString() {
		return CkMessageSet_toCompactString($this->_cPtr);
	}

	function FromCompactString($str) {
		return CkMessageSet_FromCompactString($this->_cPtr,$str);
	}

	function ContainsId($id) {
		return CkMessageSet_ContainsId($this->_cPtr,$id);
	}

	function RemoveId($id) {
		CkMessageSet_RemoveId($this->_cPtr,$id);
	}

	function InsertId($id) {
		CkMessageSet_InsertId($this->_cPtr,$id);
	}

	function GetId($index) {
		return CkMessageSet_GetId($this->_cPtr,$index);
	}

	function get_Count() {
		return CkMessageSet_get_Count($this->_cPtr);
	}

	function put_HasUids($value) {
		CkMessageSet_put_HasUids($this->_cPtr,$value);
	}

	function get_HasUids() {
		return CkMessageSet_get_HasUids($this->_cPtr);
	}
}


?>