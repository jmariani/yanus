<?php
class CkBounce {

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
		if (is_resource($res) && get_resource_type($res) === '_p_CkBounce') {
			$this->_cPtr=$res;
			return;
		}
		$this->_cPtr=new_CkBounce();
	}

	function lastErrorText() {
		return CkBounce_lastErrorText($this->_cPtr);
	}

	function lastErrorXml() {
		return CkBounce_lastErrorXml($this->_cPtr);
	}

	function lastErrorHtml() {
		return CkBounce_lastErrorHtml($this->_cPtr);
	}

	function bounceAddress() {
		return CkBounce_bounceAddress($this->_cPtr);
	}

	function bounceData() {
		return CkBounce_bounceData($this->_cPtr);
	}

	function get_Version($str) {
		CkBounce_get_Version($this->_cPtr,$str);
	}

	function get_Utf8() {
		return CkBounce_get_Utf8($this->_cPtr);
	}

	function put_Utf8($b) {
		CkBounce_put_Utf8($this->_cPtr,$b);
	}

	function UnlockComponent($unlockCode) {
		return CkBounce_UnlockComponent($this->_cPtr,$unlockCode);
	}

	function ExamineEmail($email) {
		return CkBounce_ExamineEmail($this->_cPtr,$email);
	}

	function ExamineEml($emlFilename) {
		return CkBounce_ExamineEml($this->_cPtr,$emlFilename);
	}

	function get_BounceType() {
		return CkBounce_get_BounceType($this->_cPtr);
	}

	function get_BounceAddress($bouncedEmailAddr) {
		CkBounce_get_BounceAddress($this->_cPtr,$bouncedEmailAddr);
	}

	function get_BounceData($mailBodyText) {
		CkBounce_get_BounceData($this->_cPtr,$mailBodyText);
	}

	function SaveLastError($filename) {
		return CkBounce_SaveLastError($this->_cPtr,$filename);
	}
}


?>