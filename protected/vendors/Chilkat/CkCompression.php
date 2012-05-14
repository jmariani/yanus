<?php
class CkCompression {

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
		if (is_resource($res) && get_resource_type($res) === '_p_CkCompression') {
			$this->_cPtr=$res;
			return;
		}
		$this->_cPtr=new_CkCompression();
	}

	function get_Utf8() {
		return CkCompression_get_Utf8($this->_cPtr);
	}

	function put_Utf8($b) {
		CkCompression_put_Utf8($this->_cPtr,$b);
	}

	function get_Charset($str) {
		CkCompression_get_Charset($this->_cPtr,$str);
	}

	function charset() {
		return CkCompression_charset($this->_cPtr);
	}

	function put_Charset($newVal) {
		CkCompression_put_Charset($this->_cPtr,$newVal);
	}

	function get_EncodingMode($str) {
		CkCompression_get_EncodingMode($this->_cPtr,$str);
	}

	function encodingMode() {
		return CkCompression_encodingMode($this->_cPtr);
	}

	function put_EncodingMode($newVal) {
		CkCompression_put_EncodingMode($this->_cPtr,$newVal);
	}

	function UnlockComponent($unlockCode) {
		return CkCompression_UnlockComponent($this->_cPtr,$unlockCode);
	}

	function get_Algorithm($str) {
		CkCompression_get_Algorithm($this->_cPtr,$str);
	}

	function algorithm() {
		return CkCompression_algorithm($this->_cPtr);
	}

	function put_Algorithm($newVal) {
		CkCompression_put_Algorithm($this->_cPtr,$newVal);
	}

	function BeginCompressBytes($data,$outBytes) {
		return CkCompression_BeginCompressBytes($this->_cPtr,$data,$outBytes);
	}

	function beginCompressBytesENC($data) {
		return CkCompression_beginCompressBytesENC($this->_cPtr,$data);
	}

	function BeginCompressString($str,$outBytes) {
		return CkCompression_BeginCompressString($this->_cPtr,$str,$outBytes);
	}

	function beginCompressStringENC($str) {
		return CkCompression_beginCompressStringENC($this->_cPtr,$str);
	}

	function BeginDecompressBytes($data,$outBytes) {
		return CkCompression_BeginDecompressBytes($this->_cPtr,$data,$outBytes);
	}

	function BeginDecompressBytesENC($str,$outBytes) {
		return CkCompression_BeginDecompressBytesENC($this->_cPtr,$str,$outBytes);
	}

	function beginDecompressString($data) {
		return CkCompression_beginDecompressString($this->_cPtr,$data);
	}

	function beginDecompressStringENC($str) {
		return CkCompression_beginDecompressStringENC($this->_cPtr,$str);
	}

	function CompressBytes($data,$outBytes) {
		return CkCompression_CompressBytes($this->_cPtr,$data,$outBytes);
	}

	function compressBytesENC($data) {
		return CkCompression_compressBytesENC($this->_cPtr,$data);
	}

	function CompressFile($inFile,$outFile) {
		return CkCompression_CompressFile($this->_cPtr,$inFile,$outFile);
	}

	function CompressString($str,$outBytes) {
		return CkCompression_CompressString($this->_cPtr,$str,$outBytes);
	}

	function compressStringENC($str) {
		return CkCompression_compressStringENC($this->_cPtr,$str);
	}

	function DecompressBytes($data,$outBytes) {
		return CkCompression_DecompressBytes($this->_cPtr,$data,$outBytes);
	}

	function DecompressBytesENC($str,$outBytes) {
		return CkCompression_DecompressBytesENC($this->_cPtr,$str,$outBytes);
	}

	function DecompressFile($inFile,$outFile) {
		return CkCompression_DecompressFile($this->_cPtr,$inFile,$outFile);
	}

	function decompressString($data) {
		return CkCompression_decompressString($this->_cPtr,$data);
	}

	function decompressStringENC($str) {
		return CkCompression_decompressStringENC($this->_cPtr,$str);
	}

	function EndCompressBytes($outBytes) {
		return CkCompression_EndCompressBytes($this->_cPtr,$outBytes);
	}

	function endCompressBytesENC() {
		return CkCompression_endCompressBytesENC($this->_cPtr);
	}

	function EndCompressString($outBytes) {
		return CkCompression_EndCompressString($this->_cPtr,$outBytes);
	}

	function endCompressStringENC() {
		return CkCompression_endCompressStringENC($this->_cPtr);
	}

	function EndDecompressBytes($outBytes) {
		return CkCompression_EndDecompressBytes($this->_cPtr,$outBytes);
	}

	function EndDecompressBytesENC($outBytes) {
		return CkCompression_EndDecompressBytesENC($this->_cPtr,$outBytes);
	}

	function endDecompressString() {
		return CkCompression_endDecompressString($this->_cPtr);
	}

	function endDecompressStringENC() {
		return CkCompression_endDecompressStringENC($this->_cPtr);
	}

	function MoreCompressBytes($data,$outBytes) {
		return CkCompression_MoreCompressBytes($this->_cPtr,$data,$outBytes);
	}

	function moreCompressBytesENC($data) {
		return CkCompression_moreCompressBytesENC($this->_cPtr,$data);
	}

	function MoreCompressString($str,$outBytes) {
		return CkCompression_MoreCompressString($this->_cPtr,$str,$outBytes);
	}

	function moreCompressStringENC($str) {
		return CkCompression_moreCompressStringENC($this->_cPtr,$str);
	}

	function MoreDecompressBytes($data,$outBytes) {
		return CkCompression_MoreDecompressBytes($this->_cPtr,$data,$outBytes);
	}

	function MoreDecompressBytesENC($str,$outBytes) {
		return CkCompression_MoreDecompressBytesENC($this->_cPtr,$str,$outBytes);
	}

	function moreDecompressString($data) {
		return CkCompression_moreDecompressString($this->_cPtr,$data);
	}

	function moreDecompressStringENC($str) {
		return CkCompression_moreDecompressStringENC($this->_cPtr,$str);
	}

	function get_Version($str) {
		CkCompression_get_Version($this->_cPtr,$str);
	}

	function version() {
		return CkCompression_version($this->_cPtr);
	}

	function get_DebugLogFilePath($str) {
		CkCompression_get_DebugLogFilePath($this->_cPtr,$str);
	}

	function debugLogFilePath() {
		return CkCompression_debugLogFilePath($this->_cPtr);
	}

	function put_DebugLogFilePath($newVal) {
		CkCompression_put_DebugLogFilePath($this->_cPtr,$newVal);
	}

	function SaveLastError($filename) {
		return CkCompression_SaveLastError($this->_cPtr,$filename);
	}

	function lastErrorText() {
		return CkCompression_lastErrorText($this->_cPtr);
	}

	function lastErrorXml() {
		return CkCompression_lastErrorXml($this->_cPtr);
	}

	function lastErrorHtml() {
		return CkCompression_lastErrorHtml($this->_cPtr);
	}
}


?>