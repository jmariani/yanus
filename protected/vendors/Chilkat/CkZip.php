<?php
class CkZip {

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
		if (is_resource($res) && get_resource_type($res) === '_p_CkZip') {
			$this->_cPtr=$res;
			return;
		}
		$this->_cPtr=new_CkZip();
	}

	function get_Utf8() {
		return CkZip_get_Utf8($this->_cPtr);
	}

	function put_Utf8($b) {
		CkZip_put_Utf8($this->_cPtr,$b);
	}

	function get_FileCount() {
		return CkZip_get_FileCount($this->_cPtr);
	}

	function get_HasZipFormatErrors() {
		return CkZip_get_HasZipFormatErrors($this->_cPtr);
	}

	function get_TextFlag() {
		return CkZip_get_TextFlag($this->_cPtr);
	}

	function put_TextFlag($newVal) {
		CkZip_put_TextFlag($this->_cPtr,$newVal);
	}

	function ExtractInto($dirPath) {
		return CkZip_ExtractInto($this->_cPtr,$dirPath);
	}

	function get_CaseSensitive() {
		return CkZip_get_CaseSensitive($this->_cPtr);
	}

	function put_CaseSensitive($newVal) {
		CkZip_put_CaseSensitive($this->_cPtr,$newVal);
	}

	function VerifyPassword() {
		return CkZip_VerifyPassword($this->_cPtr);
	}

	function get_OverwriteExisting() {
		return CkZip_get_OverwriteExisting($this->_cPtr);
	}

	function put_OverwriteExisting($newVal) {
		CkZip_put_OverwriteExisting($this->_cPtr,$newVal);
	}

	function AddNoCompressExtension($fileExtension) {
		CkZip_AddNoCompressExtension($this->_cPtr,$fileExtension);
	}

	function RemoveNoCompressExtension($fileExtension) {
		CkZip_RemoveNoCompressExtension($this->_cPtr,$fileExtension);
	}

	function IsNoCompressExtension($fileExtension) {
		return CkZip_IsNoCompressExtension($this->_cPtr,$fileExtension);
	}

	function get_VerboseLogging() {
		return CkZip_get_VerboseLogging($this->_cPtr);
	}

	function put_VerboseLogging($newVal) {
		CkZip_put_VerboseLogging($this->_cPtr,$newVal);
	}

	function get_IgnoreAccessDenied() {
		return CkZip_get_IgnoreAccessDenied($this->_cPtr);
	}

	function put_IgnoreAccessDenied($newVal) {
		CkZip_put_IgnoreAccessDenied($this->_cPtr,$newVal);
	}

	function get_ClearReadOnlyAttr() {
		return CkZip_get_ClearReadOnlyAttr($this->_cPtr);
	}

	function put_ClearReadOnlyAttr($newVal) {
		CkZip_put_ClearReadOnlyAttr($this->_cPtr,$newVal);
	}

	function get_DebugLogFilePath($str) {
		CkZip_get_DebugLogFilePath($this->_cPtr,$str);
	}

	function debugLogFilePath() {
		return CkZip_debugLogFilePath($this->_cPtr);
	}

	function put_DebugLogFilePath($newVal) {
		CkZip_put_DebugLogFilePath($this->_cPtr,$newVal);
	}

	function lastErrorText() {
		return CkZip_lastErrorText($this->_cPtr);
	}

	function lastErrorXml() {
		return CkZip_lastErrorXml($this->_cPtr);
	}

	function lastErrorHtml() {
		return CkZip_lastErrorHtml($this->_cPtr);
	}

	function QuickAppend($zipFilename) {
		return CkZip_QuickAppend($this->_cPtr,$zipFilename);
	}

	function version() {
		return CkZip_version($this->_cPtr);
	}

	function tempDir() {
		return CkZip_tempDir($this->_cPtr);
	}

	function appendFromDir() {
		return CkZip_appendFromDir($this->_cPtr);
	}

	function proxy() {
		return CkZip_proxy($this->_cPtr);
	}

	function fileName() {
		return CkZip_fileName($this->_cPtr);
	}

	function pathPrefix() {
		return CkZip_pathPrefix($this->_cPtr);
	}

	function getDirectoryAsXML() {
		return CkZip_getDirectoryAsXML($this->_cPtr);
	}

	function get_PasswordProtect() {
		return CkZip_get_PasswordProtect($this->_cPtr);
	}

	function put_PasswordProtect($newVal) {
		CkZip_put_PasswordProtect($this->_cPtr,$newVal);
	}

	function get_Encryption() {
		return CkZip_get_Encryption($this->_cPtr);
	}

	function put_Encryption($newVal) {
		CkZip_put_Encryption($this->_cPtr,$newVal);
	}

	function get_OemCodePage() {
		return CkZip_get_OemCodePage($this->_cPtr);
	}

	function put_OemCodePage($newVal) {
		CkZip_put_OemCodePage($this->_cPtr,$newVal);
	}

	function get_EncryptKeyLength() {
		return CkZip_get_EncryptKeyLength($this->_cPtr);
	}

	function put_EncryptKeyLength($newVal) {
		CkZip_put_EncryptKeyLength($this->_cPtr,$newVal);
	}

	function get_Version($pVal) {
		CkZip_get_Version($this->_cPtr,$pVal);
	}

	function get_TempDir($pVal) {
		CkZip_get_TempDir($this->_cPtr,$pVal);
	}

	function put_TempDir($newVal) {
		CkZip_put_TempDir($this->_cPtr,$newVal);
	}

	function get_AppendFromDir($pVal) {
		CkZip_get_AppendFromDir($this->_cPtr,$pVal);
	}

	function put_AppendFromDir($newVal) {
		CkZip_put_AppendFromDir($this->_cPtr,$newVal);
	}

	function get_Proxy($pVal) {
		CkZip_get_Proxy($this->_cPtr,$pVal);
	}

	function put_Proxy($newVal) {
		CkZip_put_Proxy($this->_cPtr,$newVal);
	}

	function get_DecryptPassword($pVal) {
		CkZip_get_DecryptPassword($this->_cPtr,$pVal);
	}

	function put_DecryptPassword($newVal) {
		CkZip_put_DecryptPassword($this->_cPtr,$newVal);
	}

	function get_EncryptPassword($pVal) {
		CkZip_get_EncryptPassword($this->_cPtr,$pVal);
	}

	function put_EncryptPassword($newVal) {
		CkZip_put_EncryptPassword($this->_cPtr,$newVal);
	}

	function encryptPassword() {
		return CkZip_encryptPassword($this->_cPtr);
	}

	function decryptPassword() {
		return CkZip_decryptPassword($this->_cPtr);
	}

	function get_ClearArchiveAttribute() {
		return CkZip_get_ClearArchiveAttribute($this->_cPtr);
	}

	function put_ClearArchiveAttribute($newVal) {
		CkZip_put_ClearArchiveAttribute($this->_cPtr,$newVal);
	}

	function get_NumEntries() {
		return CkZip_get_NumEntries($this->_cPtr);
	}

	function get_FileName($pVal) {
		CkZip_get_FileName($this->_cPtr,$pVal);
	}

	function put_FileName($newVal) {
		CkZip_put_FileName($this->_cPtr,$newVal);
	}

	function get_Comment($pVal) {
		CkZip_get_Comment($this->_cPtr,$pVal);
	}

	function put_Comment($newVal) {
		CkZip_put_Comment($this->_cPtr,$newVal);
	}

	function get_PathPrefix($pVal) {
		CkZip_get_PathPrefix($this->_cPtr,$pVal);
	}

	function put_PathPrefix($newVal) {
		CkZip_put_PathPrefix($this->_cPtr,$newVal);
	}

	function get_DiscardPaths() {
		return CkZip_get_DiscardPaths($this->_cPtr);
	}

	function put_DiscardPaths($newVal) {
		CkZip_put_DiscardPaths($this->_cPtr,$newVal);
	}

	function FirstEntry() {
		$r=CkZip_FirstEntry($this->_cPtr);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkZipEntry($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function ExcludeDir($dirName) {
		CkZip_ExcludeDir($this->_cPtr,$dirName);
	}

	function IsPasswordProtected($zipFilename) {
		return CkZip_IsPasswordProtected($this->_cPtr,$zipFilename);
	}

	function SetPassword($password) {
		CkZip_SetPassword($this->_cPtr,$password);
	}

	function SetExclusions($excludePatterns) {
		CkZip_SetExclusions($this->_cPtr,$excludePatterns);
	}

	function GetExclusions() {
		$r=CkZip_GetExclusions($this->_cPtr);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkStringArray($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function FirstMatchingEntry($pattern) {
		$r=CkZip_FirstMatchingEntry($this->_cPtr,$pattern);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkZipEntry($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function ExtractMatching($dirPath,$pattern) {
		return CkZip_ExtractMatching($this->_cPtr,$dirPath,$pattern);
	}

	function GetEntryByID($entryID) {
		$r=CkZip_GetEntryByID($this->_cPtr,$entryID);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkZipEntry($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function WriteZip() {
		return CkZip_WriteZip($this->_cPtr);
	}

	function WriteZipAndClose() {
		return CkZip_WriteZipAndClose($this->_cPtr);
	}

	function OpenZip($ZipFileName) {
		return CkZip_OpenZip($this->_cPtr,$ZipFileName);
	}

	function OpenFromWeb($url) {
		return CkZip_OpenFromWeb($this->_cPtr,$url);
	}

	function NewZip($ZipFileName) {
		return CkZip_NewZip($this->_cPtr,$ZipFileName);
	}

	function GetEntryByName($entryName) {
		$r=CkZip_GetEntryByName($this->_cPtr,$entryName);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkZipEntry($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function GetEntryByIndex($index) {
		$r=CkZip_GetEntryByIndex($this->_cPtr,$index);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkZipEntry($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function Extract($dirPath) {
		return CkZip_Extract($this->_cPtr,$dirPath);
	}

	function ExtractNewer($dirPath) {
		return CkZip_ExtractNewer($this->_cPtr,$dirPath);
	}

	function AppendZip($zipFileName) {
		return CkZip_AppendZip($this->_cPtr,$zipFileName);
	}

	function AppendOneFileOrDir($fileOrDirName,$saveExtraPath=null) {
		switch (func_num_args()) {
		case 1: $r=CkZip_AppendOneFileOrDir($this->_cPtr,$fileOrDirName); break;
		default: $r=CkZip_AppendOneFileOrDir($this->_cPtr,$fileOrDirName,$saveExtraPath);
		}
		return $r;
	}

	function AppendFiles($filePattern,$recurse) {
		return CkZip_AppendFiles($this->_cPtr,$filePattern,$recurse);
	}

	function AppendFilesEx($filePattern,$recurse,$saveExtraPath,$archiveOnly,$includeHidden,$includeSystem) {
		return CkZip_AppendFilesEx($this->_cPtr,$filePattern,$recurse,$saveExtraPath,$archiveOnly,$includeHidden,$includeSystem);
	}

	function AppendMultiple($fileSpecs,$recurse) {
		return CkZip_AppendMultiple($this->_cPtr,$fileSpecs,$recurse);
	}

	function AppendData($fileName,$data) {
		$r=CkZip_AppendData($this->_cPtr,$fileName,$data);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkZipEntry($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function AppendString($fileName,$str) {
		$r=CkZip_AppendString($this->_cPtr,$fileName,$str);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkZipEntry($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function AppendString2($fileName,$str,$charset) {
		$r=CkZip_AppendString2($this->_cPtr,$fileName,$str,$charset);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkZipEntry($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function AppendNew($fileName) {
		$r=CkZip_AppendNew($this->_cPtr,$fileName);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkZipEntry($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function AppendNewDir($dirName) {
		$r=CkZip_AppendNewDir($this->_cPtr,$dirName);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkZipEntry($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function InsertNew($fileName,$beforeIndex) {
		$r=CkZip_InsertNew($this->_cPtr,$fileName,$beforeIndex);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkZipEntry($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function AppendCompressed($fileName,$data) {
		$r=CkZip_AppendCompressed($this->_cPtr,$fileName,$data);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkZipEntry($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function DeleteEntry($entry) {
		return CkZip_DeleteEntry($this->_cPtr,$entry);
	}

	function AppendBase64($fileName,$data) {
		$r=CkZip_AppendBase64($this->_cPtr,$fileName,$data);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkZipEntry($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function AppendHex($fileName,$data) {
		$r=CkZip_AppendHex($this->_cPtr,$fileName,$data);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkZipEntry($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function WriteToMemory($bData) {
		return CkZip_WriteToMemory($this->_cPtr,$bData);
	}

	function CloseZip() {
		CkZip_CloseZip($this->_cPtr);
	}

	function UnlockComponent($regCode) {
		return CkZip_UnlockComponent($this->_cPtr,$regCode);
	}

	function IsUnlocked() {
		return CkZip_IsUnlocked($this->_cPtr);
	}

	function SaveLastError($filename) {
		return CkZip_SaveLastError($this->_cPtr,$filename);
	}

	function Unzip($dirPath) {
		return CkZip_Unzip($this->_cPtr,$dirPath);
	}

	function UnzipNewer($dirPath) {
		return CkZip_UnzipNewer($this->_cPtr,$dirPath);
	}

	function UnzipInto($dirPath) {
		return CkZip_UnzipInto($this->_cPtr,$dirPath);
	}

	function UnzipMatching($dirPath,$pattern,$verbose) {
		return CkZip_UnzipMatching($this->_cPtr,$dirPath,$pattern,$verbose);
	}

	function UnzipMatchingInto($dirPath,$pattern,$verbose) {
		return CkZip_UnzipMatchingInto($this->_cPtr,$dirPath,$pattern,$verbose);
	}

	function SetCompressionLevel($level) {
		CkZip_SetCompressionLevel($this->_cPtr,$level);
	}
}


?>