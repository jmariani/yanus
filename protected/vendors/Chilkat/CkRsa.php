<?php
class CkRsa {

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
		return CkRsa_get_Utf8($this->_cPtr);
	}

	function put_Utf8($b) {
		CkRsa_put_Utf8($this->_cPtr,$b);
	}

	function get_LittleEndian() {
		return CkRsa_get_LittleEndian($this->_cPtr);
	}

	function put_LittleEndian($newVal) {
		CkRsa_put_LittleEndian($this->_cPtr,$newVal);
	}

	function get_Version($str) {
		CkRsa_get_Version($this->_cPtr,$str);
	}

	function version() {
		return CkRsa_version($this->_cPtr);
	}

	function OpenSslVerifyBytes($signature,$outBytes) {
		return CkRsa_OpenSslVerifyBytes($this->_cPtr,$signature,$outBytes);
	}

	function OpenSslSignBytes($data,$outBytes) {
		return CkRsa_OpenSslSignBytes($this->_cPtr,$data,$outBytes);
	}

	function openSslSignBytesENC($data) {
		return CkRsa_openSslSignBytesENC($this->_cPtr,$data);
	}

	function OpenSslSignString($str,$outBytes) {
		return CkRsa_OpenSslSignString($this->_cPtr,$str,$outBytes);
	}

	function openSslSignStringENC($str) {
		return CkRsa_openSslSignStringENC($this->_cPtr,$str);
	}

	function OpenSslVerifyBytesENC($str,$outBytes) {
		return CkRsa_OpenSslVerifyBytesENC($this->_cPtr,$str,$outBytes);
	}

	function openSslVerifyString($data) {
		return CkRsa_openSslVerifyString($this->_cPtr,$data);
	}

	function openSslVerifyStringENC($str) {
		return CkRsa_openSslVerifyStringENC($this->_cPtr,$str);
	}

	function VerifyPrivateKey($xml) {
		return CkRsa_VerifyPrivateKey($this->_cPtr,$xml);
	}

	function VerifyHash($hashBytes,$hashAlg,$sigBytes) {
		return CkRsa_VerifyHash($this->_cPtr,$hashBytes,$hashAlg,$sigBytes);
	}

	function VerifyHashENC($encodedHash,$hashAlg,$encodedSig) {
		return CkRsa_VerifyHashENC($this->_cPtr,$encodedHash,$hashAlg,$encodedSig);
	}

	function SignHash($hashBytes,$hashAlg,$outBytes) {
		return CkRsa_SignHash($this->_cPtr,$hashBytes,$hashAlg,$outBytes);
	}

	function signHashENC($encodedHash,$hashAlg) {
		return CkRsa_signHashENC($this->_cPtr,$encodedHash,$hashAlg);
	}

	function get_VerboseLogging() {
		return CkRsa_get_VerboseLogging($this->_cPtr);
	}

	function put_VerboseLogging($newVal) {
		CkRsa_put_VerboseLogging($this->_cPtr,$newVal);
	}

	function get_NoUnpad() {
		return CkRsa_get_NoUnpad($this->_cPtr);
	}

	function put_NoUnpad($newVal) {
		CkRsa_put_NoUnpad($this->_cPtr,$newVal);
	}

	function get_DebugLogFilePath($str) {
		CkRsa_get_DebugLogFilePath($this->_cPtr,$str);
	}

	function debugLogFilePath() {
		return CkRsa_debugLogFilePath($this->_cPtr);
	}

	function put_DebugLogFilePath($newVal) {
		CkRsa_put_DebugLogFilePath($this->_cPtr,$newVal);
	}

	function UnlockComponent($unlockCode) {
		return CkRsa_UnlockComponent($this->_cPtr,$unlockCode);
	}

	function SaveLastError($filename) {
		return CkRsa_SaveLastError($this->_cPtr,$filename);
	}

	function VerifyStringENC($str,$hashAlg,$sig) {
		return CkRsa_VerifyStringENC($this->_cPtr,$str,$hashAlg,$sig);
	}

	function VerifyString($str,$hashAlg,$sigData) {
		return CkRsa_VerifyString($this->_cPtr,$str,$hashAlg,$sigData);
	}

	function VerifyBytesENC($bData,$hashAlg,$encodedSig) {
		return CkRsa_VerifyBytesENC($this->_cPtr,$bData,$hashAlg,$encodedSig);
	}

	function VerifyBytes($bData,$hashAlg,$sigData) {
		return CkRsa_VerifyBytes($this->_cPtr,$bData,$hashAlg,$sigData);
	}

	function signStringENC($str,$hashAlg) {
		return CkRsa_signStringENC($this->_cPtr,$str,$hashAlg);
	}

	function signBytesENC($bData,$hashAlg) {
		return CkRsa_signBytesENC($this->_cPtr,$bData,$hashAlg);
	}

	function SignString($str,$hashAlg,$out) {
		return CkRsa_SignString($this->_cPtr,$str,$hashAlg,$out);
	}

	function SignBytes($bData,$hashAlg,$out) {
		return CkRsa_SignBytes($this->_cPtr,$bData,$hashAlg,$out);
	}

	function DecryptBytesENC($str,$bUsePrivateKey,$out) {
		return CkRsa_DecryptBytesENC($this->_cPtr,$str,$bUsePrivateKey,$out);
	}

	function DecryptBytes($bData,$bUsePrivateKey,$out) {
		return CkRsa_DecryptBytes($this->_cPtr,$bData,$bUsePrivateKey,$out);
	}

	function EncryptString($str,$bUsePrivateKey,$out) {
		return CkRsa_EncryptString($this->_cPtr,$str,$bUsePrivateKey,$out);
	}

	function EncryptBytes($bData,$bUsePrivateKey,$out) {
		return CkRsa_EncryptBytes($this->_cPtr,$bData,$bUsePrivateKey,$out);
	}

	function get_EncodingMode($out) {
		CkRsa_get_EncodingMode($this->_cPtr,$out);
	}

	function put_EncodingMode($str) {
		CkRsa_put_EncodingMode($this->_cPtr,$str);
	}

	function get_Charset($out) {
		CkRsa_get_Charset($this->_cPtr,$out);
	}

	function put_Charset($str) {
		CkRsa_put_Charset($this->_cPtr,$str);
	}

	function GenerateKey($numBits) {
		return CkRsa_GenerateKey($this->_cPtr,$numBits);
	}

	function ImportPublicKey($strXml) {
		return CkRsa_ImportPublicKey($this->_cPtr,$strXml);
	}

	function ImportPrivateKey($strXml) {
		return CkRsa_ImportPrivateKey($this->_cPtr,$strXml);
	}

	function get_NumBits() {
		return CkRsa_get_NumBits($this->_cPtr);
	}

	function get_OaepPadding() {
		return CkRsa_get_OaepPadding($this->_cPtr);
	}

	function put_OaepPadding($newVal) {
		CkRsa_put_OaepPadding($this->_cPtr,$newVal);
	}

	function lastErrorText() {
		return CkRsa_lastErrorText($this->_cPtr);
	}

	function lastErrorXml() {
		return CkRsa_lastErrorXml($this->_cPtr);
	}

	function lastErrorHtml() {
		return CkRsa_lastErrorHtml($this->_cPtr);
	}

	function decryptStringENC($str,$bUsePrivateKey) {
		return CkRsa_decryptStringENC($this->_cPtr,$str,$bUsePrivateKey);
	}

	function decryptString($data,$bUsePrivateKey) {
		return CkRsa_decryptString($this->_cPtr,$data,$bUsePrivateKey);
	}

	function encryptStringENC($str,$bUsePrivateKey) {
		return CkRsa_encryptStringENC($this->_cPtr,$str,$bUsePrivateKey);
	}

	function encryptBytesENC($data,$bUsePrivateKey) {
		return CkRsa_encryptBytesENC($this->_cPtr,$data,$bUsePrivateKey);
	}

	function encodingMode() {
		return CkRsa_encodingMode($this->_cPtr);
	}

	function charset() {
		return CkRsa_charset($this->_cPtr);
	}

	function exportPublicKey() {
		return CkRsa_exportPublicKey($this->_cPtr);
	}

	function exportPrivateKey() {
		return CkRsa_exportPrivateKey($this->_cPtr);
	}

	function snkToXml($filename) {
		return CkRsa_snkToXml($this->_cPtr,$filename);
	}

	function __construct($res=null) {
		if (is_resource($res) && get_resource_type($res) === '_p_CkRsa') {
			$this->_cPtr=$res;
			return;
		}
		$this->_cPtr=new_CkRsa();
	}
}


?>