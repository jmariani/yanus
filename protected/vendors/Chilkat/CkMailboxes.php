<?php
class CkMailboxes {

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
		if (is_resource($res) && get_resource_type($res) === '_p_CkMailboxes') {
			$this->_cPtr=$res;
			return;
		}
		$this->_cPtr=new_CkMailboxes();
	}

	function get_Utf8() {
		return CkMailboxes_get_Utf8($this->_cPtr);
	}

	function put_Utf8($b) {
		CkMailboxes_put_Utf8($this->_cPtr,$b);
	}

	function IsMarked($index) {
		return CkMailboxes_IsMarked($this->_cPtr,$index);
	}

	function HasInferiors($index) {
		return CkMailboxes_HasInferiors($this->_cPtr,$index);
	}

	function IsSelectable($index) {
		return CkMailboxes_IsSelectable($this->_cPtr,$index);
	}

	function get_Count() {
		return CkMailboxes_get_Count($this->_cPtr);
	}

	function getName($index) {
		return CkMailboxes_getName($this->_cPtr,$index);
	}
}


?>