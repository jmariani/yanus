<?php
class CkDkim {

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
		if (is_resource($res) && get_resource_type($res) === '_p_CkDkim') {
			$this->_cPtr=$res;
			return;
		}
		$this->_cPtr=new_CkDkim();
	}

	function get_Utf8() {
		return CkDkim_get_Utf8($this->_cPtr);
	}

	function put_Utf8($b) {
		CkDkim_put_Utf8($this->_cPtr,$b);
	}

	function UnlockComponent($unlockCode) {
		return CkDkim_UnlockComponent($this->_cPtr,$unlockCode);
	}

	function get_DkimCanon($str) {
		CkDkim_get_DkimCanon($this->_cPtr,$str);
	}

	function dkimCanon() {
		return CkDkim_dkimCanon($this->_cPtr);
	}

	function put_DkimCanon($newVal) {
		CkDkim_put_DkimCanon($this->_cPtr,$newVal);
	}

	function get_DomainKeyCanon($str) {
		CkDkim_get_DomainKeyCanon($this->_cPtr,$str);
	}

	function domainKeyCanon() {
		return CkDkim_domainKeyCanon($this->_cPtr);
	}

	function put_DomainKeyCanon($newVal) {
		CkDkim_put_DomainKeyCanon($this->_cPtr,$newVal);
	}

	function get_DkimAlg($str) {
		CkDkim_get_DkimAlg($this->_cPtr,$str);
	}

	function dkimAlg() {
		return CkDkim_dkimAlg($this->_cPtr);
	}

	function put_DkimAlg($newVal) {
		CkDkim_put_DkimAlg($this->_cPtr,$newVal);
	}

	function get_DomainKeyAlg($str) {
		CkDkim_get_DomainKeyAlg($this->_cPtr,$str);
	}

	function domainKeyAlg() {
		return CkDkim_domainKeyAlg($this->_cPtr);
	}

	function put_DomainKeyAlg($newVal) {
		CkDkim_put_DomainKeyAlg($this->_cPtr,$newVal);
	}

	function get_DkimHeaders($str) {
		CkDkim_get_DkimHeaders($this->_cPtr,$str);
	}

	function dkimHeaders() {
		return CkDkim_dkimHeaders($this->_cPtr);
	}

	function put_DkimHeaders($newVal) {
		CkDkim_put_DkimHeaders($this->_cPtr,$newVal);
	}

	function get_DomainKeyHeaders($str) {
		CkDkim_get_DomainKeyHeaders($this->_cPtr,$str);
	}

	function domainKeyHeaders() {
		return CkDkim_domainKeyHeaders($this->_cPtr);
	}

	function put_DomainKeyHeaders($newVal) {
		CkDkim_put_DomainKeyHeaders($this->_cPtr,$newVal);
	}

	function get_DkimDomain($str) {
		CkDkim_get_DkimDomain($this->_cPtr,$str);
	}

	function dkimDomain() {
		return CkDkim_dkimDomain($this->_cPtr);
	}

	function put_DkimDomain($newVal) {
		CkDkim_put_DkimDomain($this->_cPtr,$newVal);
	}

	function get_DomainKeyDomain($str) {
		CkDkim_get_DomainKeyDomain($this->_cPtr,$str);
	}

	function domainKeyDomain() {
		return CkDkim_domainKeyDomain($this->_cPtr);
	}

	function put_DomainKeyDomain($newVal) {
		CkDkim_put_DomainKeyDomain($this->_cPtr,$newVal);
	}

	function get_DkimSelector($str) {
		CkDkim_get_DkimSelector($this->_cPtr,$str);
	}

	function dkimSelector() {
		return CkDkim_dkimSelector($this->_cPtr);
	}

	function put_DkimSelector($newVal) {
		CkDkim_put_DkimSelector($this->_cPtr,$newVal);
	}

	function get_DomainKeySelector($str) {
		CkDkim_get_DomainKeySelector($this->_cPtr,$str);
	}

	function domainKeySelector() {
		return CkDkim_domainKeySelector($this->_cPtr);
	}

	function put_DomainKeySelector($newVal) {
		CkDkim_put_DomainKeySelector($this->_cPtr,$newVal);
	}

	function get_DkimBodyLengthCount() {
		return CkDkim_get_DkimBodyLengthCount($this->_cPtr);
	}

	function put_DkimBodyLengthCount($newVal) {
		CkDkim_put_DkimBodyLengthCount($this->_cPtr,$newVal);
	}

	function LoadDkimPk($privateKey,$optionalPassword) {
		return CkDkim_LoadDkimPk($this->_cPtr,$privateKey,$optionalPassword);
	}

	function LoadDomainKeyPk($privateKey,$optionalPassword) {
		return CkDkim_LoadDomainKeyPk($this->_cPtr,$privateKey,$optionalPassword);
	}

	function LoadDkimPkFile($privateKeyFilepath,$optionalPassword) {
		return CkDkim_LoadDkimPkFile($this->_cPtr,$privateKeyFilepath,$optionalPassword);
	}

	function LoadDomainKeyPkFile($privateKeyFilepath,$optionalPassword) {
		return CkDkim_LoadDomainKeyPkFile($this->_cPtr,$privateKeyFilepath,$optionalPassword);
	}

	function LoadPublicKey($selector,$domain,$publicKey) {
		return CkDkim_LoadPublicKey($this->_cPtr,$selector,$domain,$publicKey);
	}

	function LoadPublicKeyFile($selector,$domain,$publicKeyFilepath) {
		return CkDkim_LoadPublicKeyFile($this->_cPtr,$selector,$domain,$publicKeyFilepath);
	}

	function PrefetchPublicKey($selector,$domain) {
		return CkDkim_PrefetchPublicKey($this->_cPtr,$selector,$domain);
	}

	function VerifyDkimSignature($sigIdx,$mimeData) {
		return CkDkim_VerifyDkimSignature($this->_cPtr,$sigIdx,$mimeData);
	}

	function VerifyDomainKeySignature($sigIdx,$mimeData) {
		return CkDkim_VerifyDomainKeySignature($this->_cPtr,$sigIdx,$mimeData);
	}

	function NumDkimSignatures($mimeData) {
		return CkDkim_NumDkimSignatures($this->_cPtr,$mimeData);
	}

	function NumDomainKeySignatures($mimeData) {
		return CkDkim_NumDomainKeySignatures($this->_cPtr,$mimeData);
	}

	function AddDkimSignature($mimeIn,$outBytes) {
		return CkDkim_AddDkimSignature($this->_cPtr,$mimeIn,$outBytes);
	}

	function AddDomainKeySignature($mimeIn,$outBytes) {
		return CkDkim_AddDomainKeySignature($this->_cPtr,$mimeIn,$outBytes);
	}

	function LoadDkimPkBytes($privateKeyDer,$optionalPassword) {
		return CkDkim_LoadDkimPkBytes($this->_cPtr,$privateKeyDer,$optionalPassword);
	}

	function LoadDomainKeyPkBytes($privateKeyDer,$optionalPassword) {
		return CkDkim_LoadDomainKeyPkBytes($this->_cPtr,$privateKeyDer,$optionalPassword);
	}

	function SaveLastError($filename) {
		return CkDkim_SaveLastError($this->_cPtr,$filename);
	}

	function lastErrorText() {
		return CkDkim_lastErrorText($this->_cPtr);
	}

	function lastErrorXml() {
		return CkDkim_lastErrorXml($this->_cPtr);
	}

	function lastErrorHtml() {
		return CkDkim_lastErrorHtml($this->_cPtr);
	}
}


?>