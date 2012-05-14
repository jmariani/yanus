<?php
class CkCert {

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
		if (is_resource($res) && get_resource_type($res) === '_p_CkCert') {
			$this->_cPtr=$res;
			return;
		}
		$this->_cPtr=new_CkCert();
	}

	function CheckRevoked() {
		return CkCert_CheckRevoked($this->_cPtr);
	}

	function get_Sha1Thumbprint($str) {
		CkCert_get_Sha1Thumbprint($this->_cPtr,$str);
	}

	function exportCertXml() {
		return CkCert_exportCertXml($this->_cPtr);
	}

	function get_VerboseLogging() {
		return CkCert_get_VerboseLogging($this->_cPtr);
	}

	function put_VerboseLogging($newVal) {
		CkCert_put_VerboseLogging($this->_cPtr,$newVal);
	}

	function get_CertVersion() {
		return CkCert_get_CertVersion($this->_cPtr);
	}

	function SetPrivateKey($privKey) {
		return CkCert_SetPrivateKey($this->_cPtr,$privKey);
	}

	function get_OcspUrl($str) {
		CkCert_get_OcspUrl($this->_cPtr,$str);
	}

	function ocspUrl() {
		return CkCert_ocspUrl($this->_cPtr);
	}

	function FindIssuer() {
		$r=CkCert_FindIssuer($this->_cPtr);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkCert($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function LoadByIssuerAndSerialNumber($issuerCN,$serialNum) {
		return CkCert_LoadByIssuerAndSerialNumber($this->_cPtr,$issuerCN,$serialNum);
	}

	function get_SelfSigned() {
		return CkCert_get_SelfSigned($this->_cPtr);
	}

	function SetPrivateKeyPem($privKeyPem) {
		return CkCert_SetPrivateKeyPem($this->_cPtr,$privKeyPem);
	}

	function getPrivateKeyPem() {
		return CkCert_getPrivateKeyPem($this->_cPtr);
	}

	function get_PrivateKeyExportable() {
		return CkCert_get_PrivateKeyExportable($this->_cPtr);
	}

	function get_AvoidWindowsPkAccess() {
		return CkCert_get_AvoidWindowsPkAccess($this->_cPtr);
	}

	function put_AvoidWindowsPkAccess($newVal) {
		CkCert_put_AvoidWindowsPkAccess($this->_cPtr,$newVal);
	}

	function GetValidToDt() {
		$r=CkCert_GetValidToDt($this->_cPtr);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkDateTime($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function GetValidFromDt() {
		$r=CkCert_GetValidFromDt($this->_cPtr);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkDateTime($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function getEncoded() {
		return CkCert_getEncoded($this->_cPtr);
	}

	function issuerE() {
		return CkCert_issuerE($this->_cPtr);
	}

	function issuerC() {
		return CkCert_issuerC($this->_cPtr);
	}

	function issuerS() {
		return CkCert_issuerS($this->_cPtr);
	}

	function issuerL() {
		return CkCert_issuerL($this->_cPtr);
	}

	function issuerO() {
		return CkCert_issuerO($this->_cPtr);
	}

	function issuerOU() {
		return CkCert_issuerOU($this->_cPtr);
	}

	function issuerCN() {
		return CkCert_issuerCN($this->_cPtr);
	}

	function issuerDN() {
		return CkCert_issuerDN($this->_cPtr);
	}

	function subjectE() {
		return CkCert_subjectE($this->_cPtr);
	}

	function subjectC() {
		return CkCert_subjectC($this->_cPtr);
	}

	function subjectS() {
		return CkCert_subjectS($this->_cPtr);
	}

	function subjectL() {
		return CkCert_subjectL($this->_cPtr);
	}

	function subjectO() {
		return CkCert_subjectO($this->_cPtr);
	}

	function subjectOU() {
		return CkCert_subjectOU($this->_cPtr);
	}

	function subjectCN() {
		return CkCert_subjectCN($this->_cPtr);
	}

	function subjectDN() {
		return CkCert_subjectDN($this->_cPtr);
	}

	function sha1Thumbprint() {
		return CkCert_sha1Thumbprint($this->_cPtr);
	}

	function rfc822Name() {
		return CkCert_rfc822Name($this->_cPtr);
	}

	function serialNumber() {
		return CkCert_serialNumber($this->_cPtr);
	}

	function version() {
		return CkCert_version($this->_cPtr);
	}

	function lastErrorText() {
		return CkCert_lastErrorText($this->_cPtr);
	}

	function lastErrorXml() {
		return CkCert_lastErrorXml($this->_cPtr);
	}

	function lastErrorHtml() {
		return CkCert_lastErrorHtml($this->_cPtr);
	}

	function get_IntendedKeyUsage() {
		return CkCert_get_IntendedKeyUsage($this->_cPtr);
	}

	function LoadPfxFile($filename,$password) {
		return CkCert_LoadPfxFile($this->_cPtr,$filename,$password);
	}

	function LoadPfxData($pfxData,$password) {
		return CkCert_LoadPfxData($this->_cPtr,$pfxData,$password);
	}

	function LoadPfxData2($buf,$bufLen,$password) {
		return CkCert_LoadPfxData2($this->_cPtr,$buf,$bufLen,$password);
	}

	function get_Utf8() {
		return CkCert_get_Utf8($this->_cPtr);
	}

	function put_Utf8($b) {
		CkCert_put_Utf8($this->_cPtr,$b);
	}

	function LoadFromFile($filename) {
		return CkCert_LoadFromFile($this->_cPtr,$filename);
	}

	function LoadFromBase64($encodedCert) {
		return CkCert_LoadFromBase64($this->_cPtr,$encodedCert);
	}

	function SetFromEncoded($encodedCert) {
		return CkCert_SetFromEncoded($this->_cPtr,$encodedCert);
	}

	function get_IsRoot() {
		return CkCert_get_IsRoot($this->_cPtr);
	}

	function get_IssuerE($str) {
		CkCert_get_IssuerE($this->_cPtr,$str);
	}

	function get_IssuerC($str) {
		CkCert_get_IssuerC($this->_cPtr,$str);
	}

	function get_IssuerS($str) {
		CkCert_get_IssuerS($this->_cPtr,$str);
	}

	function get_IssuerL($str) {
		CkCert_get_IssuerL($this->_cPtr,$str);
	}

	function get_IssuerO($str) {
		CkCert_get_IssuerO($this->_cPtr,$str);
	}

	function get_IssuerOU($str) {
		CkCert_get_IssuerOU($this->_cPtr,$str);
	}

	function get_IssuerCN($str) {
		CkCert_get_IssuerCN($this->_cPtr,$str);
	}

	function get_IssuerDN($str) {
		CkCert_get_IssuerDN($this->_cPtr,$str);
	}

	function get_SubjectE($str) {
		CkCert_get_SubjectE($this->_cPtr,$str);
	}

	function get_SubjectC($str) {
		CkCert_get_SubjectC($this->_cPtr,$str);
	}

	function get_SubjectS($str) {
		CkCert_get_SubjectS($this->_cPtr,$str);
	}

	function get_SubjectL($str) {
		CkCert_get_SubjectL($this->_cPtr,$str);
	}

	function get_SubjectO($str) {
		CkCert_get_SubjectO($this->_cPtr,$str);
	}

	function get_SubjectOU($str) {
		CkCert_get_SubjectOU($this->_cPtr,$str);
	}

	function get_SubjectCN($str) {
		CkCert_get_SubjectCN($this->_cPtr,$str);
	}

	function get_SubjectDN($str) {
		CkCert_get_SubjectDN($this->_cPtr,$str);
	}

	function get_SignatureVerified() {
		return CkCert_get_SignatureVerified($this->_cPtr);
	}

	function get_TrustedRoot() {
		return CkCert_get_TrustedRoot($this->_cPtr);
	}

	function get_Revoked() {
		return CkCert_get_Revoked($this->_cPtr);
	}

	function get_Expired() {
		return CkCert_get_Expired($this->_cPtr);
	}

	function HasPrivateKey() {
		return CkCert_HasPrivateKey($this->_cPtr);
	}

	function SaveToFile($filename) {
		return CkCert_SaveToFile($this->_cPtr,$filename);
	}

	function get_Rfc822Name($str) {
		CkCert_get_Rfc822Name($this->_cPtr,$str);
	}

	function get_ValidTo($sysTime) {
		CkCert_get_ValidTo($this->_cPtr,$sysTime);
	}

	function get_ValidFrom($sysTime) {
		CkCert_get_ValidFrom($this->_cPtr,$sysTime);
	}

	function get_SerialNumber($str) {
		CkCert_get_SerialNumber($this->_cPtr,$str);
	}

	function get_ForTimeStamping() {
		return CkCert_get_ForTimeStamping($this->_cPtr);
	}

	function get_ForCodeSigning() {
		return CkCert_get_ForCodeSigning($this->_cPtr);
	}

	function get_ForClientAuthentication() {
		return CkCert_get_ForClientAuthentication($this->_cPtr);
	}

	function get_ForServerAuthentication() {
		return CkCert_get_ForServerAuthentication($this->_cPtr);
	}

	function get_ForSecureEmail() {
		return CkCert_get_ForSecureEmail($this->_cPtr);
	}

	function get_Version($str) {
		CkCert_get_Version($this->_cPtr,$str);
	}

	function SaveLastError($filename) {
		return CkCert_SaveLastError($this->_cPtr,$filename);
	}

	function get_HasKeyContainer() {
		return CkCert_get_HasKeyContainer($this->_cPtr);
	}

	function get_KeyContainerName($str) {
		CkCert_get_KeyContainerName($this->_cPtr,$str);
	}

	function keyContainerName() {
		return CkCert_keyContainerName($this->_cPtr);
	}

	function get_CspName($str) {
		CkCert_get_CspName($this->_cPtr,$str);
	}

	function cspName() {
		return CkCert_cspName($this->_cPtr);
	}

	function get_MachineKeyset() {
		return CkCert_get_MachineKeyset($this->_cPtr);
	}

	function get_Silent() {
		return CkCert_get_Silent($this->_cPtr);
	}

	function LoadByEmailAddress($emailAddress) {
		return CkCert_LoadByEmailAddress($this->_cPtr,$emailAddress);
	}

	function LoadByCommonName($cn) {
		return CkCert_LoadByCommonName($this->_cPtr,$cn);
	}

	function ExportCertPemFile($filename) {
		return CkCert_ExportCertPemFile($this->_cPtr,$filename);
	}

	function ExportCertDer($data) {
		return CkCert_ExportCertDer($this->_cPtr,$data);
	}

	function ExportCertDerFile($filename) {
		return CkCert_ExportCertDerFile($this->_cPtr,$filename);
	}

	function PemFileToDerFile($inFilename,$outFilename) {
		return CkCert_PemFileToDerFile($this->_cPtr,$inFilename,$outFilename);
	}

	function ExportPublicKey() {
		$r=CkCert_ExportPublicKey($this->_cPtr);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkPublicKey($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function ExportPrivateKey() {
		$r=CkCert_ExportPrivateKey($this->_cPtr);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkPrivateKey($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function exportCertPem() {
		return CkCert_exportCertPem($this->_cPtr);
	}
}


?>