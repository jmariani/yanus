<?php
class CkBz2 {

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
		if (is_resource($res) && get_resource_type($res) === '_p_CkBz2') {
			$this->_cPtr=$res;
			return;
		}
		$this->_cPtr=new_CkBz2();
	}

	function get_Utf8() {
		return CkBz2_get_Utf8($this->_cPtr);
	}

	function put_Utf8($b) {
		CkBz2_put_Utf8($this->_cPtr,$b);
	}

	function UncompressFile($inFilename,$outFilename) {
		return CkBz2_UncompressFile($this->_cPtr,$inFilename,$outFilename);
	}

	function CompressFile($inFilename,$outFilename) {
		return CkBz2_CompressFile($this->_cPtr,$inFilename,$outFilename);
	}

	function UncompressFileToMem($inFilename,$outBytes) {
		return CkBz2_UncompressFileToMem($this->_cPtr,$inFilename,$outBytes);
	}

	function CompressFileToMem($inFilename,$outBytes) {
		return CkBz2_CompressFileToMem($this->_cPtr,$inFilename,$outBytes);
	}

	function CompressMemToFile($inData,$outFilename) {
		return CkBz2_CompressMemToFile($this->_cPtr,$inData,$outFilename);
	}

	function UncompressMemToFile($inData,$outFilename) {
		return CkBz2_UncompressMemToFile($this->_cPtr,$inData,$outFilename);
	}

	function CompressMemory($inData,$outBytes) {
		return CkBz2_CompressMemory($this->_cPtr,$inData,$outBytes);
	}

	function UncompressMemory($inData,$outBytes) {
		return CkBz2_UncompressMemory($this->_cPtr,$inData,$outBytes);
	}

	function UnlockComponent($regCode) {
		return CkBz2_UnlockComponent($this->_cPtr,$regCode);
	}

	function SaveLastError($filename) {
		return CkBz2_SaveLastError($this->_cPtr,$filename);
	}

	function lastErrorText() {
		return CkBz2_lastErrorText($this->_cPtr);
	}

	function lastErrorXml() {
		return CkBz2_lastErrorXml($this->_cPtr);
	}

	function lastErrorHtml() {
		return CkBz2_lastErrorHtml($this->_cPtr);
	}
}


?>