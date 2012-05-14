<?php
class CkCrypt2 {

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
		if (is_resource($res) && get_resource_type($res) === '_p_CkCrypt2') {
			$this->_cPtr=$res;
			return;
		}
		$this->_cPtr=new_CkCrypt2();
	}

	function get_Utf8() {
		return CkCrypt2_get_Utf8($this->_cPtr);
	}

	function put_Utf8($b) {
		CkCrypt2_put_Utf8($this->_cPtr,$b);
	}

	function get_IncludeCertChain() {
		return CkCrypt2_get_IncludeCertChain($this->_cPtr);
	}

	function put_IncludeCertChain($newVal) {
		CkCrypt2_put_IncludeCertChain($this->_cPtr,$newVal);
	}

	function ReadFile($filename,$outBytes) {
		return CkCrypt2_ReadFile($this->_cPtr,$filename,$outBytes);
	}

	function StringToBytes($inStr,$charset,$outBytes) {
		return CkCrypt2_StringToBytes($this->_cPtr,$inStr,$charset,$outBytes);
	}

	function bytesToString($inData,$charset) {
		return CkCrypt2_bytesToString($this->_cPtr,$inData,$charset);
	}

	function trimEndingWith($inStr,$ending) {
		return CkCrypt2_trimEndingWith($this->_cPtr,$inStr,$ending);
	}

	function WriteFile($filename,$fileData) {
		return CkCrypt2_WriteFile($this->_cPtr,$filename,$fileData);
	}

	function SetDecryptCert($cert) {
		return CkCrypt2_SetDecryptCert($this->_cPtr,$cert);
	}

	function encryptEncoded($str) {
		return CkCrypt2_encryptEncoded($this->_cPtr,$str);
	}

	function decryptEncoded($str) {
		return CkCrypt2_decryptEncoded($this->_cPtr,$str);
	}

	function reEncode($data,$fromEncoding,$toEncoding) {
		return CkCrypt2_reEncode($this->_cPtr,$data,$fromEncoding,$toEncoding);
	}

	function RandomizeKey() {
		CkCrypt2_RandomizeKey($this->_cPtr);
	}

	function AddEncryptCert($cert) {
		CkCrypt2_AddEncryptCert($this->_cPtr,$cert);
	}

	function ClearEncryptCerts() {
		CkCrypt2_ClearEncryptCerts($this->_cPtr);
	}

	function genRandomBytesENC($numBytes) {
		return CkCrypt2_genRandomBytesENC($this->_cPtr,$numBytes);
	}

	function pbkdf1($password,$charset,$hashAlg,$salt,$iterationCount,$outputKeyBitLen,$encoding) {
		return CkCrypt2_pbkdf1($this->_cPtr,$password,$charset,$hashAlg,$salt,$iterationCount,$outputKeyBitLen,$encoding);
	}

	function pbkdf2($password,$charset,$hashAlg,$salt,$iterationCount,$outputKeyBitLen,$encoding) {
		return CkCrypt2_pbkdf2($this->_cPtr,$password,$charset,$hashAlg,$salt,$iterationCount,$outputKeyBitLen,$encoding);
	}

	function get_PbesPassword($str) {
		CkCrypt2_get_PbesPassword($this->_cPtr,$str);
	}

	function pbesPassword() {
		return CkCrypt2_pbesPassword($this->_cPtr);
	}

	function put_PbesPassword($newVal) {
		CkCrypt2_put_PbesPassword($this->_cPtr,$newVal);
	}

	function get_Salt($data) {
		CkCrypt2_get_Salt($this->_cPtr,$data);
	}

	function put_Salt($data) {
		CkCrypt2_put_Salt($this->_cPtr,$data);
	}

	function get_IterationCount() {
		return CkCrypt2_get_IterationCount($this->_cPtr);
	}

	function put_IterationCount($newVal) {
		CkCrypt2_put_IterationCount($this->_cPtr,$newVal);
	}

	function SetEncodedSalt($saltStr,$encoding) {
		CkCrypt2_SetEncodedSalt($this->_cPtr,$saltStr,$encoding);
	}

	function getEncodedSalt($encoding) {
		return CkCrypt2_getEncodedSalt($this->_cPtr,$encoding);
	}

	function get_PbesAlgorithm($str) {
		CkCrypt2_get_PbesAlgorithm($this->_cPtr,$str);
	}

	function pbesAlgorithm() {
		return CkCrypt2_pbesAlgorithm($this->_cPtr);
	}

	function put_PbesAlgorithm($newVal) {
		CkCrypt2_put_PbesAlgorithm($this->_cPtr,$newVal);
	}

	function HashBeginBytes($data) {
		return CkCrypt2_HashBeginBytes($this->_cPtr,$data);
	}

	function HashBeginString($strData) {
		return CkCrypt2_HashBeginString($this->_cPtr,$strData);
	}

	function HashMoreString($strData) {
		return CkCrypt2_HashMoreString($this->_cPtr,$strData);
	}

	function HashMoreBytes($data) {
		return CkCrypt2_HashMoreBytes($this->_cPtr,$data);
	}

	function HashFinal($outBytes) {
		return CkCrypt2_HashFinal($this->_cPtr,$outBytes);
	}

	function hashFinalENC() {
		return CkCrypt2_hashFinalENC($this->_cPtr);
	}

	function mySqlAesEncrypt($strData,$strKey) {
		return CkCrypt2_mySqlAesEncrypt($this->_cPtr,$strData,$strKey);
	}

	function mySqlAesDecrypt($strEncrypted,$strKey) {
		return CkCrypt2_mySqlAesDecrypt($this->_cPtr,$strEncrypted,$strKey);
	}

	function encodeString($inStr,$charset,$encoding) {
		return CkCrypt2_encodeString($this->_cPtr,$inStr,$charset,$encoding);
	}

	function decodeString($inStr,$charset,$encoding) {
		return CkCrypt2_decodeString($this->_cPtr,$inStr,$charset,$encoding);
	}

	function get_UuMode($str) {
		CkCrypt2_get_UuMode($this->_cPtr,$str);
	}

	function uuMode() {
		return CkCrypt2_uuMode($this->_cPtr);
	}

	function put_UuMode($newVal) {
		CkCrypt2_put_UuMode($this->_cPtr,$newVal);
	}

	function get_UuFilename($str) {
		CkCrypt2_get_UuFilename($this->_cPtr,$str);
	}

	function uuFilename() {
		return CkCrypt2_uuFilename($this->_cPtr);
	}

	function put_UuFilename($newVal) {
		CkCrypt2_put_UuFilename($this->_cPtr,$newVal);
	}

	function get_VerboseLogging() {
		return CkCrypt2_get_VerboseLogging($this->_cPtr);
	}

	function put_VerboseLogging($newVal) {
		CkCrypt2_put_VerboseLogging($this->_cPtr,$newVal);
	}

	function AddPfxSourceData($pfxData,$password) {
		return CkCrypt2_AddPfxSourceData($this->_cPtr,$pfxData,$password);
	}

	function AddPfxSourceFile($pfxFilePath,$password) {
		return CkCrypt2_AddPfxSourceFile($this->_cPtr,$pfxFilePath,$password);
	}

	function get_Pkcs7CryptAlg($str) {
		CkCrypt2_get_Pkcs7CryptAlg($this->_cPtr,$str);
	}

	function pkcs7CryptAlg() {
		return CkCrypt2_pkcs7CryptAlg($this->_cPtr);
	}

	function put_Pkcs7CryptAlg($newVal) {
		CkCrypt2_put_Pkcs7CryptAlg($this->_cPtr,$newVal);
	}

	function get_NumSignerCerts() {
		return CkCrypt2_get_NumSignerCerts($this->_cPtr);
	}

	function GetSignerCert($index) {
		$r=CkCrypt2_GetSignerCert($this->_cPtr,$index);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkCert($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function HasSignatureSigningTime($index) {
		return CkCrypt2_HasSignatureSigningTime($this->_cPtr,$index);
	}

	function GetSignatureSigningTime($index,$outSysTime) {
		return CkCrypt2_GetSignatureSigningTime($this->_cPtr,$index,$outSysTime);
	}

	function get_CadesEnabled() {
		return CkCrypt2_get_CadesEnabled($this->_cPtr);
	}

	function put_CadesEnabled($newVal) {
		CkCrypt2_put_CadesEnabled($this->_cPtr,$newVal);
	}

	function get_CadesSigPolicyId($str) {
		CkCrypt2_get_CadesSigPolicyId($this->_cPtr,$str);
	}

	function cadesSigPolicyId() {
		return CkCrypt2_cadesSigPolicyId($this->_cPtr);
	}

	function put_CadesSigPolicyId($newVal) {
		CkCrypt2_put_CadesSigPolicyId($this->_cPtr,$newVal);
	}

	function get_CadesSigPolicyUri($str) {
		CkCrypt2_get_CadesSigPolicyUri($this->_cPtr,$str);
	}

	function cadesSigPolicyUri() {
		return CkCrypt2_cadesSigPolicyUri($this->_cPtr);
	}

	function put_CadesSigPolicyUri($newVal) {
		CkCrypt2_put_CadesSigPolicyUri($this->_cPtr,$newVal);
	}

	function get_CadesSigPolicyHash($str) {
		CkCrypt2_get_CadesSigPolicyHash($this->_cPtr,$str);
	}

	function cadesSigPolicyHash() {
		return CkCrypt2_cadesSigPolicyHash($this->_cPtr);
	}

	function put_CadesSigPolicyHash($newVal) {
		CkCrypt2_put_CadesSigPolicyHash($this->_cPtr,$newVal);
	}

	function get_FirstChunk() {
		return CkCrypt2_get_FirstChunk($this->_cPtr);
	}

	function put_FirstChunk($b) {
		CkCrypt2_put_FirstChunk($this->_cPtr,$b);
	}

	function get_LastChunk() {
		return CkCrypt2_get_LastChunk($this->_cPtr);
	}

	function put_LastChunk($b) {
		CkCrypt2_put_LastChunk($this->_cPtr,$b);
	}

	function get_BlockSize() {
		return CkCrypt2_get_BlockSize($this->_cPtr);
	}

	function genEncodedSecretKey($password,$encoding) {
		return CkCrypt2_genEncodedSecretKey($this->_cPtr,$password,$encoding);
	}

	function SetSecretKeyViaPassword($password) {
		CkCrypt2_SetSecretKeyViaPassword($this->_cPtr,$password);
	}

	function get_HavalRounds() {
		return CkCrypt2_get_HavalRounds($this->_cPtr);
	}

	function put_HavalRounds($newVal) {
		CkCrypt2_put_HavalRounds($this->_cPtr,$newVal);
	}

	function get_Rc2EffectiveKeyLength() {
		return CkCrypt2_get_Rc2EffectiveKeyLength($this->_cPtr);
	}

	function put_Rc2EffectiveKeyLength($newVal) {
		CkCrypt2_put_Rc2EffectiveKeyLength($this->_cPtr,$newVal);
	}

	function CreateDetachedSignature($inFile,$sigFile) {
		return CkCrypt2_CreateDetachedSignature($this->_cPtr,$inFile,$sigFile);
	}

	function VerifyDetachedSignature($inFile,$sigFile) {
		return CkCrypt2_VerifyDetachedSignature($this->_cPtr,$inFile,$sigFile);
	}

	function SetSigningCert2($cert,$key) {
		return CkCrypt2_SetSigningCert2($this->_cPtr,$cert,$key);
	}

	function SetDecryptCert2($cert,$key) {
		return CkCrypt2_SetDecryptCert2($this->_cPtr,$cert,$key);
	}

	function HashFile($filename,$out) {
		return CkCrypt2_HashFile($this->_cPtr,$filename,$out);
	}

	function hashFileENC($filename) {
		return CkCrypt2_hashFileENC($this->_cPtr,$filename);
	}

	function SetHmacKeyBytes($keyBytes) {
		CkCrypt2_SetHmacKeyBytes($this->_cPtr,$keyBytes);
	}

	function SetHmacKeyString($key) {
		CkCrypt2_SetHmacKeyString($this->_cPtr,$key);
	}

	function SetHmacKeyEncoded($key,$encoding) {
		CkCrypt2_SetHmacKeyEncoded($this->_cPtr,$key,$encoding);
	}

	function HmacBytes($inBytes,$hmacOut) {
		CkCrypt2_HmacBytes($this->_cPtr,$inBytes,$hmacOut);
	}

	function HmacString($inText,$hmacOut) {
		CkCrypt2_HmacString($this->_cPtr,$inText,$hmacOut);
	}

	function hmacStringENC($inText) {
		return CkCrypt2_hmacStringENC($this->_cPtr,$inText);
	}

	function hmacBytesENC($inBytes) {
		return CkCrypt2_hmacBytesENC($this->_cPtr,$inBytes);
	}

	function CreateP7S($inFilename,$p7sFilename) {
		return CkCrypt2_CreateP7S($this->_cPtr,$inFilename,$p7sFilename);
	}

	function VerifyP7S($inFilename,$p7sFilename) {
		return CkCrypt2_VerifyP7S($this->_cPtr,$inFilename,$p7sFilename);
	}

	function CreateP7M($inFilename,$p7mFilename) {
		return CkCrypt2_CreateP7M($this->_cPtr,$inFilename,$p7mFilename);
	}

	function VerifyP7M($p7mFilename,$outFilename) {
		return CkCrypt2_VerifyP7M($this->_cPtr,$p7mFilename,$outFilename);
	}

	function OpaqueVerifyBytesENC($p7s,$original) {
		return CkCrypt2_OpaqueVerifyBytesENC($this->_cPtr,$p7s,$original);
	}

	function OpaqueVerifyBytes($p7s,$original) {
		return CkCrypt2_OpaqueVerifyBytes($this->_cPtr,$p7s,$original);
	}

	function OpaqueSignString($str,$out) {
		return CkCrypt2_OpaqueSignString($this->_cPtr,$str,$out);
	}

	function OpaqueSignBytes($bData,$out) {
		return CkCrypt2_OpaqueSignBytes($this->_cPtr,$bData,$out);
	}

	function opaqueSignStringENC($str) {
		return CkCrypt2_opaqueSignStringENC($this->_cPtr,$str);
	}

	function opaqueSignBytesENC($bData) {
		return CkCrypt2_opaqueSignBytesENC($this->_cPtr,$bData);
	}

	function opaqueVerifyStringENC($p7s) {
		return CkCrypt2_opaqueVerifyStringENC($this->_cPtr,$p7s);
	}

	function opaqueVerifyString($p7s) {
		return CkCrypt2_opaqueVerifyString($this->_cPtr,$p7s);
	}

	function signStringENC($str) {
		return CkCrypt2_signStringENC($this->_cPtr,$str);
	}

	function signBytesENC($bData) {
		return CkCrypt2_signBytesENC($this->_cPtr,$bData);
	}

	function inflateStringENC($str) {
		return CkCrypt2_inflateStringENC($this->_cPtr,$str);
	}

	function inflateString($bData) {
		return CkCrypt2_inflateString($this->_cPtr,$bData);
	}

	function compressStringENC($str) {
		return CkCrypt2_compressStringENC($this->_cPtr,$str);
	}

	function compressBytesENC($bData) {
		return CkCrypt2_compressBytesENC($this->_cPtr,$bData);
	}

	function encryptStringENC($str) {
		return CkCrypt2_encryptStringENC($this->_cPtr,$str);
	}

	function encryptBytesENC($bData) {
		return CkCrypt2_encryptBytesENC($this->_cPtr,$bData);
	}

	function decryptString($bData) {
		return CkCrypt2_decryptString($this->_cPtr,$bData);
	}

	function decryptStringENC($str) {
		return CkCrypt2_decryptStringENC($this->_cPtr,$str);
	}

	function hashStringENC($str) {
		return CkCrypt2_hashStringENC($this->_cPtr,$str);
	}

	function hashBytesENC($bData) {
		return CkCrypt2_hashBytesENC($this->_cPtr,$bData);
	}

	function getEncodedKey($encoding) {
		return CkCrypt2_getEncodedKey($this->_cPtr,$encoding);
	}

	function getEncodedIV($encoding) {
		return CkCrypt2_getEncodedIV($this->_cPtr,$encoding);
	}

	function encode($bData,$encoding) {
		return CkCrypt2_encode($this->_cPtr,$bData,$encoding);
	}

	function encodingMode() {
		return CkCrypt2_encodingMode($this->_cPtr);
	}

	function compressionAlgorithm() {
		return CkCrypt2_compressionAlgorithm($this->_cPtr);
	}

	function cryptAlgorithm() {
		return CkCrypt2_cryptAlgorithm($this->_cPtr);
	}

	function hashAlgorithm() {
		return CkCrypt2_hashAlgorithm($this->_cPtr);
	}

	function charset() {
		return CkCrypt2_charset($this->_cPtr);
	}

	function cipherMode() {
		return CkCrypt2_cipherMode($this->_cPtr);
	}

	function version() {
		return CkCrypt2_version($this->_cPtr);
	}

	function lastErrorText() {
		return CkCrypt2_lastErrorText($this->_cPtr);
	}

	function lastErrorXml() {
		return CkCrypt2_lastErrorXml($this->_cPtr);
	}

	function lastErrorHtml() {
		return CkCrypt2_lastErrorHtml($this->_cPtr);
	}

	function SetEncodedKey($keyStr,$encoding) {
		CkCrypt2_SetEncodedKey($this->_cPtr,$keyStr,$encoding);
	}

	function SetEncodedIV($ivStr,$encoding) {
		CkCrypt2_SetEncodedIV($this->_cPtr,$ivStr,$encoding);
	}

	function Decode($str,$encoding,$bData) {
		CkCrypt2_Decode($this->_cPtr,$str,$encoding,$bData);
	}

	function RandomizeIV() {
		CkCrypt2_RandomizeIV($this->_cPtr);
	}

	function GetLastCert() {
		$r=CkCrypt2_GetLastCert($this->_cPtr);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkCert($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function SetEncryptCert($cert) {
		CkCrypt2_SetEncryptCert($this->_cPtr,$cert);
	}

	function SetSigningCert($cert) {
		CkCrypt2_SetSigningCert($this->_cPtr,$cert);
	}

	function SetVerifyCert($cert) {
		CkCrypt2_SetVerifyCert($this->_cPtr,$cert);
	}

	function CkEncryptFile($inFile,$outFile) {
		return CkCrypt2_CkEncryptFile($this->_cPtr,$inFile,$outFile);
	}

	function CkDecryptFile($inFile,$outFile) {
		return CkCrypt2_CkDecryptFile($this->_cPtr,$inFile,$outFile);
	}

	function VerifyStringENC($str,$encodedSig) {
		return CkCrypt2_VerifyStringENC($this->_cPtr,$str,$encodedSig);
	}

	function VerifyString($str,$sigData) {
		return CkCrypt2_VerifyString($this->_cPtr,$str,$sigData);
	}

	function VerifyBytesENC($bData,$encodedSig) {
		return CkCrypt2_VerifyBytesENC($this->_cPtr,$bData,$encodedSig);
	}

	function VerifyBytes($bData1,$sigData) {
		return CkCrypt2_VerifyBytes($this->_cPtr,$bData1,$sigData);
	}

	function SignString($str,$out) {
		return CkCrypt2_SignString($this->_cPtr,$str,$out);
	}

	function SignBytes($bData,$out) {
		return CkCrypt2_SignBytes($this->_cPtr,$bData,$out);
	}

	function InflateBytesENC($str,$out) {
		return CkCrypt2_InflateBytesENC($this->_cPtr,$str,$out);
	}

	function InflateBytes($bData,$out) {
		return CkCrypt2_InflateBytes($this->_cPtr,$bData,$out);
	}

	function CompressString($str,$out) {
		return CkCrypt2_CompressString($this->_cPtr,$str,$out);
	}

	function CompressBytes($bData,$out) {
		return CkCrypt2_CompressBytes($this->_cPtr,$bData,$out);
	}

	function DecryptBytesENC($str,$out) {
		return CkCrypt2_DecryptBytesENC($this->_cPtr,$str,$out);
	}

	function DecryptBytes($bData,$out) {
		return CkCrypt2_DecryptBytes($this->_cPtr,$bData,$out);
	}

	function EncryptString($str,$out) {
		return CkCrypt2_EncryptString($this->_cPtr,$str,$out);
	}

	function EncryptBytes($bData,$out) {
		return CkCrypt2_EncryptBytes($this->_cPtr,$bData,$out);
	}

	function HashBytes($bData,$out) {
		return CkCrypt2_HashBytes($this->_cPtr,$bData,$out);
	}

	function HashString($str,$out) {
		return CkCrypt2_HashString($this->_cPtr,$str,$out);
	}

	function get_EncodingMode($out) {
		CkCrypt2_get_EncodingMode($this->_cPtr,$out);
	}

	function put_EncodingMode($str) {
		CkCrypt2_put_EncodingMode($this->_cPtr,$str);
	}

	function get_CryptAlgorithm($out) {
		CkCrypt2_get_CryptAlgorithm($this->_cPtr,$out);
	}

	function put_CryptAlgorithm($str) {
		CkCrypt2_put_CryptAlgorithm($this->_cPtr,$str);
	}

	function get_HashAlgorithm($out) {
		CkCrypt2_get_HashAlgorithm($this->_cPtr,$out);
	}

	function put_HashAlgorithm($str) {
		CkCrypt2_put_HashAlgorithm($this->_cPtr,$str);
	}

	function get_Charset($out) {
		CkCrypt2_get_Charset($this->_cPtr,$out);
	}

	function put_Charset($str) {
		CkCrypt2_put_Charset($this->_cPtr,$str);
	}

	function GenerateSecretKey($password,$out) {
		CkCrypt2_GenerateSecretKey($this->_cPtr,$password,$out);
	}

	function get_CipherMode($out) {
		CkCrypt2_get_CipherMode($this->_cPtr,$out);
	}

	function put_CipherMode($newVal) {
		CkCrypt2_put_CipherMode($this->_cPtr,$newVal);
	}

	function get_PaddingScheme() {
		return CkCrypt2_get_PaddingScheme($this->_cPtr);
	}

	function put_PaddingScheme($newVal) {
		CkCrypt2_put_PaddingScheme($this->_cPtr,$newVal);
	}

	function get_KeyLength() {
		return CkCrypt2_get_KeyLength($this->_cPtr);
	}

	function put_KeyLength($newVal) {
		CkCrypt2_put_KeyLength($this->_cPtr,$newVal);
	}

	function get_IV($bData) {
		CkCrypt2_get_IV($this->_cPtr,$bData);
	}

	function put_IV($bData) {
		CkCrypt2_put_IV($this->_cPtr,$bData);
	}

	function get_SecretKey($bData) {
		CkCrypt2_get_SecretKey($this->_cPtr,$bData);
	}

	function put_SecretKey($bData) {
		CkCrypt2_put_SecretKey($this->_cPtr,$bData);
	}

	function get_Version($out) {
		CkCrypt2_get_Version($this->_cPtr,$out);
	}

	function IsUnlocked() {
		return CkCrypt2_IsUnlocked($this->_cPtr);
	}

	function UnlockComponent($unlockCode) {
		return CkCrypt2_UnlockComponent($this->_cPtr,$unlockCode);
	}

	function SaveLastError($filename) {
		return CkCrypt2_SaveLastError($this->_cPtr,$filename);
	}
}


?>