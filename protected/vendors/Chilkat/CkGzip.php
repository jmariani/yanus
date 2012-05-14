<?php
class CkGzip {

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
		if (is_resource($res) && get_resource_type($res) === '_p_CkGzip') {
			$this->_cPtr=$res;
			return;
		}
		$this->_cPtr=new_CkGzip();
	}

	function get_Utf8() {
		return CkGzip_get_Utf8($this->_cPtr);
	}

	function put_Utf8($b) {
		CkGzip_put_Utf8($this->_cPtr,$b);
	}

	function get_Version($str) {
		CkGzip_get_Version($this->_cPtr,$str);
	}

	function version() {
		return CkGzip_version($this->_cPtr);
	}

	function CompressFile2($inFilename,$embeddedFilename,$outFilename) {
		return CkGzip_CompressFile2($this->_cPtr,$inFilename,$embeddedFilename,$outFilename);
	}

	function CompressString($inStr,$outCharset,$outBytes) {
		return CkGzip_CompressString($this->_cPtr,$inStr,$outCharset,$outBytes);
	}

	function CompressStringToFile($inStr,$outCharset,$outFilename) {
		return CkGzip_CompressStringToFile($this->_cPtr,$inStr,$outCharset,$outFilename);
	}

	function ReadFile($filename,$outBytes) {
		return CkGzip_ReadFile($this->_cPtr,$filename,$outBytes);
	}

	function UnTarGz($gzFilename,$destDir,$bNoAbsolute) {
		return CkGzip_UnTarGz($this->_cPtr,$gzFilename,$destDir,$bNoAbsolute);
	}

	function uncompressFileToString($inFilename,$inCharset) {
		return CkGzip_uncompressFileToString($this->_cPtr,$inFilename,$inCharset);
	}

	function uncompressString($inData,$inCharset) {
		return CkGzip_uncompressString($this->_cPtr,$inData,$inCharset);
	}

	function WriteFile($filename,$binaryData) {
		return CkGzip_WriteFile($this->_cPtr,$filename,$binaryData);
	}

	function ExamineFile($inGzFilename) {
		return CkGzip_ExamineFile($this->_cPtr,$inGzFilename);
	}

	function ExamineMemory($inGzData) {
		return CkGzip_ExamineMemory($this->_cPtr,$inGzData);
	}

	function Decode($str,$encoding,$outBytes) {
		return CkGzip_Decode($this->_cPtr,$str,$encoding,$outBytes);
	}

	function get_UseCurrentDate() {
		return CkGzip_get_UseCurrentDate($this->_cPtr);
	}

	function put_UseCurrentDate($newVal) {
		CkGzip_put_UseCurrentDate($this->_cPtr,$newVal);
	}

	function xfdlToXml($xfdl) {
		return CkGzip_xfdlToXml($this->_cPtr,$xfdl);
	}

	function encode($byteData,$encoding) {
		return CkGzip_encode($this->_cPtr,$byteData,$encoding);
	}

	function get_VerboseLogging() {
		return CkGzip_get_VerboseLogging($this->_cPtr);
	}

	function put_VerboseLogging($newVal) {
		CkGzip_put_VerboseLogging($this->_cPtr,$newVal);
	}

	function get_DebugLogFilePath($str) {
		CkGzip_get_DebugLogFilePath($this->_cPtr,$str);
	}

	function debugLogFilePath() {
		return CkGzip_debugLogFilePath($this->_cPtr);
	}

	function put_DebugLogFilePath($newVal) {
		CkGzip_put_DebugLogFilePath($this->_cPtr,$newVal);
	}

	function lastErrorText() {
		return CkGzip_lastErrorText($this->_cPtr);
	}

	function lastErrorXml() {
		return CkGzip_lastErrorXml($this->_cPtr);
	}

	function lastErrorHtml() {
		return CkGzip_lastErrorHtml($this->_cPtr);
	}

	function comment() {
		return CkGzip_comment($this->_cPtr);
	}

	function filename() {
		return CkGzip_filename($this->_cPtr);
	}

	function deflateStringENC($str,$charset,$encoding) {
		return CkGzip_deflateStringENC($this->_cPtr,$str,$charset,$encoding);
	}

	function inflateStringENC($str,$charset,$encoding) {
		return CkGzip_inflateStringENC($this->_cPtr,$str,$charset,$encoding);
	}

	function SaveLastError($filename) {
		return CkGzip_SaveLastError($this->_cPtr,$filename);
	}

	function UnlockComponent($unlockCode) {
		return CkGzip_UnlockComponent($this->_cPtr,$unlockCode);
	}

	function IsUnlocked() {
		return CkGzip_IsUnlocked($this->_cPtr);
	}

	function CompressFile($inFilename,$outFilename) {
		return CkGzip_CompressFile($this->_cPtr,$inFilename,$outFilename);
	}

	function UncompressFile($inFilename,$outFilename) {
		return CkGzip_UncompressFile($this->_cPtr,$inFilename,$outFilename);
	}

	function CompressFileToMem($inFilename,$db) {
		return CkGzip_CompressFileToMem($this->_cPtr,$inFilename,$db);
	}

	function UncompressFileToMem($inFilename,$db) {
		return CkGzip_UncompressFileToMem($this->_cPtr,$inFilename,$db);
	}

	function CompressMemToFile($db,$outFilename) {
		return CkGzip_CompressMemToFile($this->_cPtr,$db,$outFilename);
	}

	function UncompressMemToFile($db,$outFilename) {
		return CkGzip_UncompressMemToFile($this->_cPtr,$db,$outFilename);
	}

	function CompressMemory($dbIn,$dbOut) {
		return CkGzip_CompressMemory($this->_cPtr,$dbIn,$dbOut);
	}

	function UncompressMemory($dbIn,$dbOut) {
		return CkGzip_UncompressMemory($this->_cPtr,$dbIn,$dbOut);
	}

	function get_Filename($str) {
		CkGzip_get_Filename($this->_cPtr,$str);
	}

	function put_Filename($str) {
		CkGzip_put_Filename($this->_cPtr,$str);
	}

	function get_Comment($str) {
		CkGzip_get_Comment($this->_cPtr,$str);
	}

	function put_Comment($str) {
		CkGzip_put_Comment($this->_cPtr,$str);
	}

	function get_ExtraData($data) {
		CkGzip_get_ExtraData($this->_cPtr,$data);
	}

	function put_ExtraData($data) {
		CkGzip_put_ExtraData($this->_cPtr,$data);
	}

	function get_LastMod($sysTime) {
		CkGzip_get_LastMod($this->_cPtr,$sysTime);
	}

	function put_LastMod($sysTime) {
		CkGzip_put_LastMod($this->_cPtr,$sysTime);
	}
}


?>