<?php
class CkTar {

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
		if (is_resource($res) && get_resource_type($res) === '_p_CkTar') {
			$this->_cPtr=$res;
			return;
		}
		$this->_cPtr=new_CkTar();
	}

	function get_Utf8() {
		return CkTar_get_Utf8($this->_cPtr);
	}

	function put_Utf8($b) {
		CkTar_put_Utf8($this->_cPtr,$b);
	}

	function SaveLastError($filename) {
		return CkTar_SaveLastError($this->_cPtr,$filename);
	}

	function get_Version($str) {
		CkTar_get_Version($this->_cPtr,$str);
	}

	function lastErrorText() {
		return CkTar_lastErrorText($this->_cPtr);
	}

	function lastErrorXml() {
		return CkTar_lastErrorXml($this->_cPtr);
	}

	function lastErrorHtml() {
		return CkTar_lastErrorHtml($this->_cPtr);
	}

	function version() {
		return CkTar_version($this->_cPtr);
	}

	function get_NoAbsolutePaths() {
		return CkTar_get_NoAbsolutePaths($this->_cPtr);
	}

	function put_NoAbsolutePaths($newVal) {
		CkTar_put_NoAbsolutePaths($this->_cPtr,$newVal);
	}

	function get_UntarCaseSensitive() {
		return CkTar_get_UntarCaseSensitive($this->_cPtr);
	}

	function put_UntarCaseSensitive($newVal) {
		CkTar_put_UntarCaseSensitive($this->_cPtr,$newVal);
	}

	function get_UntarDebugLog() {
		return CkTar_get_UntarDebugLog($this->_cPtr);
	}

	function put_UntarDebugLog($newVal) {
		CkTar_put_UntarDebugLog($this->_cPtr,$newVal);
	}

	function get_UntarDiscardPaths() {
		return CkTar_get_UntarDiscardPaths($this->_cPtr);
	}

	function put_UntarDiscardPaths($newVal) {
		CkTar_put_UntarDiscardPaths($this->_cPtr,$newVal);
	}

	function get_UntarFromDir($str) {
		CkTar_get_UntarFromDir($this->_cPtr,$str);
	}

	function untarFromDir() {
		return CkTar_untarFromDir($this->_cPtr);
	}

	function put_UntarFromDir($newVal) {
		CkTar_put_UntarFromDir($this->_cPtr,$newVal);
	}

	function get_UntarMatchPattern($str) {
		CkTar_get_UntarMatchPattern($this->_cPtr,$str);
	}

	function untarMatchPattern() {
		return CkTar_untarMatchPattern($this->_cPtr);
	}

	function put_UntarMatchPattern($newVal) {
		CkTar_put_UntarMatchPattern($this->_cPtr,$newVal);
	}

	function get_UntarMaxCount() {
		return CkTar_get_UntarMaxCount($this->_cPtr);
	}

	function put_UntarMaxCount($newVal) {
		CkTar_put_UntarMaxCount($this->_cPtr,$newVal);
	}

	function UnlockComponent($unlockCode) {
		return CkTar_UnlockComponent($this->_cPtr,$unlockCode);
	}

	function Untar($tarFilename) {
		return CkTar_Untar($this->_cPtr,$tarFilename);
	}

	function UntarFromMemory($tarFileBytes) {
		return CkTar_UntarFromMemory($this->_cPtr,$tarFileBytes);
	}

	function UntarFirstMatchingToMemory($tarFileBytes,$matchPattern,$outBytes) {
		return CkTar_UntarFirstMatchingToMemory($this->_cPtr,$tarFileBytes,$matchPattern,$outBytes);
	}

	function AddDirRoot($dirPath) {
		return CkTar_AddDirRoot($this->_cPtr,$dirPath);
	}

	function get_NumDirRoots() {
		return CkTar_get_NumDirRoots($this->_cPtr);
	}

	function getDirRoot($index) {
		return CkTar_getDirRoot($this->_cPtr,$index);
	}

	function WriteTar($tarFilename) {
		return CkTar_WriteTar($this->_cPtr,$tarFilename);
	}

	function WriteTarGz($outFilename) {
		return CkTar_WriteTarGz($this->_cPtr,$outFilename);
	}

	function WriteTarBz2($outFilename) {
		return CkTar_WriteTarBz2($this->_cPtr,$outFilename);
	}

	function listXml($tarFilename) {
		return CkTar_listXml($this->_cPtr,$tarFilename);
	}

	function get_Charset($str) {
		CkTar_get_Charset($this->_cPtr,$str);
	}

	function charset() {
		return CkTar_charset($this->_cPtr);
	}

	function put_Charset($newVal) {
		CkTar_put_Charset($this->_cPtr,$newVal);
	}

	function UntarZ($tarFilename) {
		return CkTar_UntarZ($this->_cPtr,$tarFilename);
	}

	function UntarGz($tarFilename) {
		return CkTar_UntarGz($this->_cPtr,$tarFilename);
	}

	function UntarBz2($tarFilename) {
		return CkTar_UntarBz2($this->_cPtr,$tarFilename);
	}

	function get_UserName($str) {
		CkTar_get_UserName($this->_cPtr,$str);
	}

	function userName() {
		return CkTar_userName($this->_cPtr);
	}

	function put_UserName($newVal) {
		CkTar_put_UserName($this->_cPtr,$newVal);
	}

	function get_GroupName($str) {
		CkTar_get_GroupName($this->_cPtr,$str);
	}

	function groupName() {
		return CkTar_groupName($this->_cPtr);
	}

	function put_GroupName($newVal) {
		CkTar_put_GroupName($this->_cPtr,$newVal);
	}

	function get_UserId() {
		return CkTar_get_UserId($this->_cPtr);
	}

	function put_UserId($newVal) {
		CkTar_put_UserId($this->_cPtr,$newVal);
	}

	function get_GroupId() {
		return CkTar_get_GroupId($this->_cPtr);
	}

	function put_GroupId($newVal) {
		CkTar_put_GroupId($this->_cPtr,$newVal);
	}

	function get_DirMode() {
		return CkTar_get_DirMode($this->_cPtr);
	}

	function put_DirMode($newVal) {
		CkTar_put_DirMode($this->_cPtr,$newVal);
	}

	function get_FileMode() {
		return CkTar_get_FileMode($this->_cPtr);
	}

	function put_FileMode($newVal) {
		CkTar_put_FileMode($this->_cPtr,$newVal);
	}

	function get_VerboseLogging() {
		return CkTar_get_VerboseLogging($this->_cPtr);
	}

	function put_VerboseLogging($newVal) {
		CkTar_put_VerboseLogging($this->_cPtr,$newVal);
	}

	function get_WriteFormat($str) {
		CkTar_get_WriteFormat($this->_cPtr,$str);
	}

	function writeFormat() {
		return CkTar_writeFormat($this->_cPtr);
	}

	function put_WriteFormat($newVal) {
		CkTar_put_WriteFormat($this->_cPtr,$newVal);
	}

	function get_HeartbeatMs() {
		return CkTar_get_HeartbeatMs($this->_cPtr);
	}

	function put_HeartbeatMs($newVal) {
		CkTar_put_HeartbeatMs($this->_cPtr,$newVal);
	}

	function get_ScriptFileMode() {
		return CkTar_get_ScriptFileMode($this->_cPtr);
	}

	function put_ScriptFileMode($newVal) {
		CkTar_put_ScriptFileMode($this->_cPtr,$newVal);
	}

	function get_DirPrefix($str) {
		CkTar_get_DirPrefix($this->_cPtr,$str);
	}

	function dirPrefix() {
		return CkTar_dirPrefix($this->_cPtr);
	}

	function put_DirPrefix($newVal) {
		CkTar_put_DirPrefix($this->_cPtr,$newVal);
	}

	function VerifyTar($tarFilename) {
		return CkTar_VerifyTar($this->_cPtr,$tarFilename);
	}

	function get_DebugLogFilePath($str) {
		CkTar_get_DebugLogFilePath($this->_cPtr,$str);
	}

	function debugLogFilePath() {
		return CkTar_debugLogFilePath($this->_cPtr);
	}

	function put_DebugLogFilePath($newVal) {
		CkTar_put_DebugLogFilePath($this->_cPtr,$newVal);
	}
}


?>