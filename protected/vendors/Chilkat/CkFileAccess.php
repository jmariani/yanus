<?php
class CkFileAccess {

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

	function get_Utf8() {
		return CkFileAccess_get_Utf8($this->_cPtr);
	}

	function put_Utf8($b) {
		CkFileAccess_put_Utf8($this->_cPtr,$b);
	}

	function SaveLastError($filename) {
		return CkFileAccess_SaveLastError($this->_cPtr,$filename);
	}

	function lastErrorText() {
		return CkFileAccess_lastErrorText($this->_cPtr);
	}

	function lastErrorXml() {
		return CkFileAccess_lastErrorXml($this->_cPtr);
	}

	function lastErrorHtml() {
		return CkFileAccess_lastErrorHtml($this->_cPtr);
	}

	function readEntireTextFile($filename,$charset) {
		return CkFileAccess_readEntireTextFile($this->_cPtr,$filename,$charset);
	}

	function get_CurrentDir($str) {
		CkFileAccess_get_CurrentDir($this->_cPtr,$str);
	}

	function currentDir() {
		return CkFileAccess_currentDir($this->_cPtr);
	}

	function get_EndOfFile() {
		return CkFileAccess_get_EndOfFile($this->_cPtr);
	}

	function SetCurrentDir($path) {
		return CkFileAccess_SetCurrentDir($this->_cPtr,$path);
	}

	function AppendAnsi($text) {
		return CkFileAccess_AppendAnsi($this->_cPtr,$text);
	}

	function AppendText($text,$charset) {
		return CkFileAccess_AppendText($this->_cPtr,$text,$charset);
	}

	function AppendUnicodeBOM() {
		return CkFileAccess_AppendUnicodeBOM($this->_cPtr);
	}

	function AppendUtf8BOM() {
		return CkFileAccess_AppendUtf8BOM($this->_cPtr);
	}

	function DirAutoCreate($path) {
		return CkFileAccess_DirAutoCreate($this->_cPtr,$path);
	}

	function DirCreate($path) {
		return CkFileAccess_DirCreate($this->_cPtr,$path);
	}

	function DirDelete($path) {
		return CkFileAccess_DirDelete($this->_cPtr,$path);
	}

	function DirEnsureExists($filePath) {
		return CkFileAccess_DirEnsureExists($this->_cPtr,$filePath);
	}

	function FileClose() {
		CkFileAccess_FileClose($this->_cPtr);
	}

	function FileCopy($existing,$newFilename,$failIfExists) {
		return CkFileAccess_FileCopy($this->_cPtr,$existing,$newFilename,$failIfExists);
	}

	function FileDelete($filename) {
		return CkFileAccess_FileDelete($this->_cPtr,$filename);
	}

	function FileExists($filename) {
		return CkFileAccess_FileExists($this->_cPtr,$filename);
	}

	function FileOpen($filename,$accessMode,$shareMode,$createDisp,$attr) {
		return CkFileAccess_FileOpen($this->_cPtr,$filename,$accessMode,$shareMode,$createDisp,$attr);
	}

	function FileRead($numBytes,$outBytes) {
		return CkFileAccess_FileRead($this->_cPtr,$numBytes,$outBytes);
	}

	function FileRename($existing,$newFilename) {
		return CkFileAccess_FileRename($this->_cPtr,$existing,$newFilename);
	}

	function FileSeek($offset,$origin) {
		return CkFileAccess_FileSeek($this->_cPtr,$offset,$origin);
	}

	function FileSize($filename) {
		return CkFileAccess_FileSize($this->_cPtr,$filename);
	}

	function FileWrite($data) {
		return CkFileAccess_FileWrite($this->_cPtr,$data);
	}

	function getTempFilename($dirName,$prefix) {
		return CkFileAccess_getTempFilename($this->_cPtr,$dirName,$prefix);
	}

	function ReadEntireFile($filename,$outBytes) {
		return CkFileAccess_ReadEntireFile($this->_cPtr,$filename,$outBytes);
	}

	function TreeDelete($path) {
		return CkFileAccess_TreeDelete($this->_cPtr,$path);
	}

	function WriteEntireFile($filename,$fileData) {
		return CkFileAccess_WriteEntireFile($this->_cPtr,$filename,$fileData);
	}

	function WriteEntireTextFile($filename,$fileData,$charset,$includePreamble) {
		return CkFileAccess_WriteEntireTextFile($this->_cPtr,$filename,$fileData,$charset,$includePreamble);
	}

	function SplitFile($fileToSplit,$partPrefix,$partExtension,$partSize,$outputDirPath) {
		return CkFileAccess_SplitFile($this->_cPtr,$fileToSplit,$partPrefix,$partExtension,$partSize,$outputDirPath);
	}

	function ReassembleFile($partsDirPath,$partPrefix,$partExtension,$reassembledFilename) {
		return CkFileAccess_ReassembleFile($this->_cPtr,$partsDirPath,$partPrefix,$partExtension,$reassembledFilename);
	}

	function readBinaryToEncoded($filename,$encoding) {
		return CkFileAccess_readBinaryToEncoded($this->_cPtr,$filename,$encoding);
	}

	function get_FileOpenError() {
		return CkFileAccess_get_FileOpenError($this->_cPtr);
	}

	function get_FileOpenErrorMsg($str) {
		CkFileAccess_get_FileOpenErrorMsg($this->_cPtr,$str);
	}

	function fileOpenErrorMsg() {
		return CkFileAccess_fileOpenErrorMsg($this->_cPtr);
	}

	function OpenForRead($filePath) {
		return CkFileAccess_OpenForRead($this->_cPtr,$filePath);
	}

	function OpenForWrite($filePath) {
		return CkFileAccess_OpenForWrite($this->_cPtr,$filePath);
	}

	function OpenForReadWrite($filePath) {
		return CkFileAccess_OpenForReadWrite($this->_cPtr,$filePath);
	}

	function OpenForAppend($filePath) {
		return CkFileAccess_OpenForAppend($this->_cPtr,$filePath);
	}

	function ReplaceStrings($path,$charset,$existingString,$replacementString) {
		return CkFileAccess_ReplaceStrings($this->_cPtr,$path,$charset,$existingString,$replacementString);
	}

	function __construct($res=null) {
		if (is_resource($res) && get_resource_type($res) === '_p_CkFileAccess') {
			$this->_cPtr=$res;
			return;
		}
		$this->_cPtr=new_CkFileAccess();
	}
}


?>