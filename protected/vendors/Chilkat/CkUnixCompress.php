<?php
class CkUnixCompress {

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
		if (is_resource($res) && get_resource_type($res) === '_p_CkUnixCompress') {
			$this->_cPtr=$res;
			return;
		}
		$this->_cPtr=new_CkUnixCompress();
	}

	function get_Utf8() {
		return CkUnixCompress_get_Utf8($this->_cPtr);
	}

	function put_Utf8($b) {
		CkUnixCompress_put_Utf8($this->_cPtr,$b);
	}

	function uncompressString($inData,$inCharset) {
		return CkUnixCompress_uncompressString($this->_cPtr,$inData,$inCharset);
	}

	function uncompressFileToString($inFilename,$inCharset) {
		return CkUnixCompress_uncompressFileToString($this->_cPtr,$inFilename,$inCharset);
	}

	function UnTarZ($zFilename,$destDir,$bNoAbsolute) {
		return CkUnixCompress_UnTarZ($this->_cPtr,$zFilename,$destDir,$bNoAbsolute);
	}

	function CompressStringToFile($inStr,$outCharset,$outFilename) {
		return CkUnixCompress_CompressStringToFile($this->_cPtr,$inStr,$outCharset,$outFilename);
	}

	function CompressString($inStr,$outCharset,$outBytes) {
		return CkUnixCompress_CompressString($this->_cPtr,$inStr,$outCharset,$outBytes);
	}

	function lastErrorText() {
		return CkUnixCompress_lastErrorText($this->_cPtr);
	}

	function lastErrorXml() {
		return CkUnixCompress_lastErrorXml($this->_cPtr);
	}

	function lastErrorHtml() {
		return CkUnixCompress_lastErrorHtml($this->_cPtr);
	}

	function SaveLastError($filename) {
		return CkUnixCompress_SaveLastError($this->_cPtr,$filename);
	}

	function UnlockComponent($unlockCode) {
		return CkUnixCompress_UnlockComponent($this->_cPtr,$unlockCode);
	}

	function IsUnlocked() {
		return CkUnixCompress_IsUnlocked($this->_cPtr);
	}

	function CompressFile($inFilename,$outFilename) {
		return CkUnixCompress_CompressFile($this->_cPtr,$inFilename,$outFilename);
	}

	function UncompressFile($inFilename,$outFilename) {
		return CkUnixCompress_UncompressFile($this->_cPtr,$inFilename,$outFilename);
	}

	function CompressFileToMem($inFilename,$db) {
		return CkUnixCompress_CompressFileToMem($this->_cPtr,$inFilename,$db);
	}

	function UncompressFileToMem($inFilename,$db) {
		return CkUnixCompress_UncompressFileToMem($this->_cPtr,$inFilename,$db);
	}

	function CompressMemToFile($db,$outFilename) {
		return CkUnixCompress_CompressMemToFile($this->_cPtr,$db,$outFilename);
	}

	function UncompressMemToFile($db,$outFilename) {
		return CkUnixCompress_UncompressMemToFile($this->_cPtr,$db,$outFilename);
	}

	function CompressMemory($dbIn,$dbOut) {
		return CkUnixCompress_CompressMemory($this->_cPtr,$dbIn,$dbOut);
	}

	function UncompressMemory($dbIn,$dbOut) {
		return CkUnixCompress_UncompressMemory($this->_cPtr,$dbIn,$dbOut);
	}
}


?>