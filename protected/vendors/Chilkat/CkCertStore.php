<?php
class CkCertStore {

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
		if (is_resource($res) && get_resource_type($res) === '_p_CkCertStore') {
			$this->_cPtr=$res;
			return;
		}
		$this->_cPtr=new_CkCertStore();
	}

	function FindCertByRfc822Name($name) {
		$r=CkCertStore_FindCertByRfc822Name($this->_cPtr,$name);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkCert($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function FindCertBySha1Thumbprint($str) {
		$r=CkCertStore_FindCertBySha1Thumbprint($this->_cPtr,$str);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkCert($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function get_VerboseLogging() {
		return CkCertStore_get_VerboseLogging($this->_cPtr);
	}

	function put_VerboseLogging($newVal) {
		CkCertStore_put_VerboseLogging($this->_cPtr,$newVal);
	}

	function get_AvoidWindowsPkAccess() {
		return CkCertStore_get_AvoidWindowsPkAccess($this->_cPtr);
	}

	function put_AvoidWindowsPkAccess($newVal) {
		CkCertStore_put_AvoidWindowsPkAccess($this->_cPtr,$newVal);
	}

	function lastErrorText() {
		return CkCertStore_lastErrorText($this->_cPtr);
	}

	function lastErrorXml() {
		return CkCertStore_lastErrorXml($this->_cPtr);
	}

	function lastErrorHtml() {
		return CkCertStore_lastErrorHtml($this->_cPtr);
	}

	function version() {
		return CkCertStore_version($this->_cPtr);
	}

	function get_Utf8() {
		return CkCertStore_get_Utf8($this->_cPtr);
	}

	function put_Utf8($b) {
		CkCertStore_put_Utf8($this->_cPtr,$b);
	}

	function LoadPfxFile($filename,$password) {
		return CkCertStore_LoadPfxFile($this->_cPtr,$filename,$password);
	}

	function LoadPfxData($pfxData,$password) {
		return CkCertStore_LoadPfxData($this->_cPtr,$pfxData,$password);
	}

	function LoadPfxData2($buf,$bufLen,$password) {
		return CkCertStore_LoadPfxData2($this->_cPtr,$buf,$bufLen,$password);
	}

	function FindCertBySerial($serialNumber) {
		$r=CkCertStore_FindCertBySerial($this->_cPtr,$serialNumber);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkCert($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function FindCertBySubjectE($emailAddress) {
		$r=CkCertStore_FindCertBySubjectE($this->_cPtr,$emailAddress);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkCert($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function FindCertBySubjectO($organization) {
		$r=CkCertStore_FindCertBySubjectO($this->_cPtr,$organization);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkCert($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function FindCertBySubjectCN($commonName) {
		$r=CkCertStore_FindCertBySubjectCN($this->_cPtr,$commonName);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkCert($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function FindCertBySubject($subject) {
		$r=CkCertStore_FindCertBySubject($this->_cPtr,$subject);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkCert($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function GetCertificate($index) {
		$r=CkCertStore_GetCertificate($this->_cPtr,$index);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkCert($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function get_NumCertificates() {
		return CkCertStore_get_NumCertificates($this->_cPtr);
	}

	function get_Version($version) {
		CkCertStore_get_Version($this->_cPtr,$version);
	}

	function SaveLastError($filename) {
		return CkCertStore_SaveLastError($this->_cPtr,$filename);
	}
}


?>