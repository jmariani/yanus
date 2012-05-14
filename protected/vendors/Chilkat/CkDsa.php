<?php
class CkDsa {

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
		if (is_resource($res) && get_resource_type($res) === '_p_CkDsa') {
			$this->_cPtr=$res;
			return;
		}
		$this->_cPtr=new_CkDsa();
	}

	function get_Utf8() {
		return CkDsa_get_Utf8($this->_cPtr);
	}

	function put_Utf8($b) {
		CkDsa_put_Utf8($this->_cPtr,$b);
	}

	function get_GroupSize() {
		return CkDsa_get_GroupSize($this->_cPtr);
	}

	function put_GroupSize($newVal) {
		CkDsa_put_GroupSize($this->_cPtr,$newVal);
	}

	function GenKey($numBits) {
		return CkDsa_GenKey($this->_cPtr,$numBits);
	}

	function GenKeyFromParamsDerFile($filename) {
		return CkDsa_GenKeyFromParamsDerFile($this->_cPtr,$filename);
	}

	function GenKeyFromParamsPemFile($filename) {
		return CkDsa_GenKeyFromParamsPemFile($this->_cPtr,$filename);
	}

	function GenKeyFromParamsDer($derBytes) {
		return CkDsa_GenKeyFromParamsDer($this->_cPtr,$derBytes);
	}

	function GenKeyFromParamsPem($pem) {
		return CkDsa_GenKeyFromParamsPem($this->_cPtr,$pem);
	}

	function UnlockComponent($unlockCode) {
		return CkDsa_UnlockComponent($this->_cPtr,$unlockCode);
	}

	function VerifyKey() {
		return CkDsa_VerifyKey($this->_cPtr);
	}

	function toXml($bPublicOnly) {
		return CkDsa_toXml($this->_cPtr,$bPublicOnly);
	}

	function FromXml($xmlKey) {
		return CkDsa_FromXml($this->_cPtr,$xmlKey);
	}

	function FromEncryptedPem($password,$pemData) {
		return CkDsa_FromEncryptedPem($this->_cPtr,$password,$pemData);
	}

	function FromPem($pemData) {
		return CkDsa_FromPem($this->_cPtr,$pemData);
	}

	function SaveText($strToSave,$filename) {
		return CkDsa_SaveText($this->_cPtr,$strToSave,$filename);
	}

	function toEncryptedPem($password) {
		return CkDsa_toEncryptedPem($this->_cPtr,$password);
	}

	function toPem() {
		return CkDsa_toPem($this->_cPtr);
	}

	function ToDer($outBytes) {
		return CkDsa_ToDer($this->_cPtr,$outBytes);
	}

	function ToDerFile($filename) {
		return CkDsa_ToDerFile($this->_cPtr,$filename);
	}

	function FromDer($derData) {
		return CkDsa_FromDer($this->_cPtr,$derData);
	}

	function FromDerFile($filename) {
		return CkDsa_FromDerFile($this->_cPtr,$filename);
	}

	function FromPublicPem($pemData) {
		return CkDsa_FromPublicPem($this->_cPtr,$pemData);
	}

	function toPublicPem() {
		return CkDsa_toPublicPem($this->_cPtr);
	}

	function get_Hash($data) {
		CkDsa_get_Hash($this->_cPtr,$data);
	}

	function put_Hash($data) {
		CkDsa_put_Hash($this->_cPtr,$data);
	}

	function get_Signature($data) {
		CkDsa_get_Signature($this->_cPtr,$data);
	}

	function put_Signature($data) {
		CkDsa_put_Signature($this->_cPtr,$data);
	}

	function SetEncodedHash($encoding,$encodedHash) {
		return CkDsa_SetEncodedHash($this->_cPtr,$encoding,$encodedHash);
	}

	function SetEncodedSignature($encoding,$encodedSig) {
		return CkDsa_SetEncodedSignature($this->_cPtr,$encoding,$encodedSig);
	}

	function getEncodedSignature($encoding) {
		return CkDsa_getEncodedSignature($this->_cPtr,$encoding);
	}

	function getEncodedHash($encoding) {
		return CkDsa_getEncodedHash($this->_cPtr,$encoding);
	}

	function SignHash() {
		return CkDsa_SignHash($this->_cPtr);
	}

	function Verify() {
		return CkDsa_Verify($this->_cPtr);
	}

	function SetKeyExplicit($groupSizeInBytes,$pHex,$qHex,$gHex,$xHex) {
		return CkDsa_SetKeyExplicit($this->_cPtr,$groupSizeInBytes,$pHex,$qHex,$gHex,$xHex);
	}

	function ToPublicDerFile($filename) {
		return CkDsa_ToPublicDerFile($this->_cPtr,$filename);
	}

	function ToPublicDer($outBytes) {
		return CkDsa_ToPublicDer($this->_cPtr,$outBytes);
	}

	function FromPublicDer($derData) {
		return CkDsa_FromPublicDer($this->_cPtr,$derData);
	}

	function FromPublicDerFile($filename) {
		return CkDsa_FromPublicDerFile($this->_cPtr,$filename);
	}

	function get_HexP($str) {
		CkDsa_get_HexP($this->_cPtr,$str);
	}

	function hexP() {
		return CkDsa_hexP($this->_cPtr);
	}

	function get_HexQ($str) {
		CkDsa_get_HexQ($this->_cPtr,$str);
	}

	function hexQ() {
		return CkDsa_hexQ($this->_cPtr);
	}

	function get_HexG($str) {
		CkDsa_get_HexG($this->_cPtr,$str);
	}

	function hexG() {
		return CkDsa_hexG($this->_cPtr);
	}

	function get_HexX($str) {
		CkDsa_get_HexX($this->_cPtr,$str);
	}

	function hexX() {
		return CkDsa_hexX($this->_cPtr);
	}

	function get_HexY($str) {
		CkDsa_get_HexY($this->_cPtr,$str);
	}

	function hexY() {
		return CkDsa_hexY($this->_cPtr);
	}

	function SetPubKeyExplicit($groupSizeInBytes,$pHex,$qHex,$gHex,$yHex) {
		return CkDsa_SetPubKeyExplicit($this->_cPtr,$groupSizeInBytes,$pHex,$qHex,$gHex,$yHex);
	}

	function get_Version($str) {
		CkDsa_get_Version($this->_cPtr,$str);
	}

	function version() {
		return CkDsa_version($this->_cPtr);
	}

	function loadText($filename) {
		return CkDsa_loadText($this->_cPtr,$filename);
	}

	function SaveLastError($filename) {
		return CkDsa_SaveLastError($this->_cPtr,$filename);
	}

	function lastErrorText() {
		return CkDsa_lastErrorText($this->_cPtr);
	}

	function lastErrorXml() {
		return CkDsa_lastErrorXml($this->_cPtr);
	}

	function lastErrorHtml() {
		return CkDsa_lastErrorHtml($this->_cPtr);
	}
}


?>