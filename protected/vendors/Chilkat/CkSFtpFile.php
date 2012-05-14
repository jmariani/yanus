<?php
class CkSFtpFile {

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
		if (is_resource($res) && get_resource_type($res) === '_p_CkSFtpFile') {
			$this->_cPtr=$res;
			return;
		}
		$this->_cPtr=new_CkSFtpFile();
	}

	function get_Utf8() {
		return CkSFtpFile_get_Utf8($this->_cPtr);
	}

	function put_Utf8($b) {
		CkSFtpFile_put_Utf8($this->_cPtr,$b);
	}

	function SaveLastError($filename) {
		return CkSFtpFile_SaveLastError($this->_cPtr,$filename);
	}

	function lastErrorText() {
		return CkSFtpFile_lastErrorText($this->_cPtr);
	}

	function lastErrorXml() {
		return CkSFtpFile_lastErrorXml($this->_cPtr);
	}

	function lastErrorHtml() {
		return CkSFtpFile_lastErrorHtml($this->_cPtr);
	}

	function get_Filename($str) {
		CkSFtpFile_get_Filename($this->_cPtr,$str);
	}

	function filename() {
		return CkSFtpFile_filename($this->_cPtr);
	}

	function get_Owner($str) {
		CkSFtpFile_get_Owner($this->_cPtr,$str);
	}

	function owner() {
		return CkSFtpFile_owner($this->_cPtr);
	}

	function get_Group($str) {
		CkSFtpFile_get_Group($this->_cPtr,$str);
	}

	function group() {
		return CkSFtpFile_group($this->_cPtr);
	}

	function get_FileType($str) {
		CkSFtpFile_get_FileType($this->_cPtr,$str);
	}

	function fileType() {
		return CkSFtpFile_fileType($this->_cPtr);
	}

	function get_IsRegular() {
		return CkSFtpFile_get_IsRegular($this->_cPtr);
	}

	function get_IsDirectory() {
		return CkSFtpFile_get_IsDirectory($this->_cPtr);
	}

	function get_IsSymLink() {
		return CkSFtpFile_get_IsSymLink($this->_cPtr);
	}

	function get_IsReadOnly() {
		return CkSFtpFile_get_IsReadOnly($this->_cPtr);
	}

	function get_IsSystem() {
		return CkSFtpFile_get_IsSystem($this->_cPtr);
	}

	function get_IsHidden() {
		return CkSFtpFile_get_IsHidden($this->_cPtr);
	}

	function get_IsCaseInsensitive() {
		return CkSFtpFile_get_IsCaseInsensitive($this->_cPtr);
	}

	function get_IsArchive() {
		return CkSFtpFile_get_IsArchive($this->_cPtr);
	}

	function get_IsEncrypted() {
		return CkSFtpFile_get_IsEncrypted($this->_cPtr);
	}

	function get_IsCompressed() {
		return CkSFtpFile_get_IsCompressed($this->_cPtr);
	}

	function get_IsSparse() {
		return CkSFtpFile_get_IsSparse($this->_cPtr);
	}

	function get_IsAppendOnly() {
		return CkSFtpFile_get_IsAppendOnly($this->_cPtr);
	}

	function get_IsImmutable() {
		return CkSFtpFile_get_IsImmutable($this->_cPtr);
	}

	function get_IsSync() {
		return CkSFtpFile_get_IsSync($this->_cPtr);
	}

	function get_Permissions() {
		return CkSFtpFile_get_Permissions($this->_cPtr);
	}

	function get_Size32() {
		return CkSFtpFile_get_Size32($this->_cPtr);
	}

	function get_LastModifiedTime($sysTime) {
		CkSFtpFile_get_LastModifiedTime($this->_cPtr,$sysTime);
	}

	function get_LastAccessTime($sysTime) {
		CkSFtpFile_get_LastAccessTime($this->_cPtr,$sysTime);
	}

	function get_CreateTime($sysTime) {
		CkSFtpFile_get_CreateTime($this->_cPtr,$sysTime);
	}

	function get_SizeStr($str) {
		CkSFtpFile_get_SizeStr($this->_cPtr,$str);
	}

	function sizeStr() {
		return CkSFtpFile_sizeStr($this->_cPtr);
	}

	function get_Uid() {
		return CkSFtpFile_get_Uid($this->_cPtr);
	}

	function get_Gid() {
		return CkSFtpFile_get_Gid($this->_cPtr);
	}

	function GetCreateDt() {
		$r=CkSFtpFile_GetCreateDt($this->_cPtr);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkDateTime($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function GetLastModifiedDt() {
		$r=CkSFtpFile_GetLastModifiedDt($this->_cPtr);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkDateTime($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function GetLastAccessDt() {
		$r=CkSFtpFile_GetLastAccessDt($this->_cPtr);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkDateTime($r);
			}
			return new $c($r);
		}
		return $r;
	}
}


?>