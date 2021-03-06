<?php
class CkMime {

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
		if (is_resource($res) && get_resource_type($res) === '_p_CkMime') {
			$this->_cPtr=$res;
			return;
		}
		$this->_cPtr=new_CkMime();
	}

	function Convert8Bit() {
		CkMime_Convert8Bit($this->_cPtr);
	}

	function get_UseMmDescription() {
		return CkMime_get_UseMmDescription($this->_cPtr);
	}

	function put_UseMmDescription($newVal) {
		CkMime_put_UseMmDescription($this->_cPtr,$newVal);
	}

	function GetMimeBytes($outBytes) {
		return CkMime_GetMimeBytes($this->_cPtr,$outBytes);
	}

	function ExtractPartsToFiles($dirPath) {
		$r=CkMime_ExtractPartsToFiles($this->_cPtr,$dirPath);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkStringArray($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function asnBodyToXml() {
		return CkMime_asnBodyToXml($this->_cPtr);
	}

	function get_CurrentDateTime($str) {
		CkMime_get_CurrentDateTime($this->_cPtr,$str);
	}

	function currentDateTime() {
		return CkMime_currentDateTime($this->_cPtr);
	}

	function EncryptN() {
		return CkMime_EncryptN($this->_cPtr);
	}

	function AddEncryptCert($cert) {
		return CkMime_AddEncryptCert($this->_cPtr,$cert);
	}

	function ClearEncryptCerts() {
		CkMime_ClearEncryptCerts($this->_cPtr);
	}

	function SetBody($str) {
		CkMime_SetBody($this->_cPtr,$str);
	}

	function UrlEncodeBody($charset) {
		CkMime_UrlEncodeBody($this->_cPtr,$charset);
	}

	function AddContentLength() {
		CkMime_AddContentLength($this->_cPtr);
	}

	function get_VerboseLogging() {
		return CkMime_get_VerboseLogging($this->_cPtr);
	}

	function put_VerboseLogging($newVal) {
		CkMime_put_VerboseLogging($this->_cPtr,$newVal);
	}

	function DecryptUsingPfxData($pfxData,$password) {
		return CkMime_DecryptUsingPfxData($this->_cPtr,$pfxData,$password);
	}

	function DecryptUsingPfxFile($pfxFilePath,$password) {
		return CkMime_DecryptUsingPfxFile($this->_cPtr,$pfxFilePath,$password);
	}

	function AddPfxSourceData($pfxData,$password) {
		return CkMime_AddPfxSourceData($this->_cPtr,$pfxData,$password);
	}

	function AddPfxSourceFile($pfxFilePath,$password) {
		return CkMime_AddPfxSourceFile($this->_cPtr,$pfxFilePath,$password);
	}

	function get_Pkcs7CryptAlg($str) {
		CkMime_get_Pkcs7CryptAlg($this->_cPtr,$str);
	}

	function pkcs7CryptAlg() {
		return CkMime_pkcs7CryptAlg($this->_cPtr);
	}

	function put_Pkcs7CryptAlg($newVal) {
		CkMime_put_Pkcs7CryptAlg($this->_cPtr,$newVal);
	}

	function get_Pkcs7KeyLength() {
		return CkMime_get_Pkcs7KeyLength($this->_cPtr);
	}

	function put_Pkcs7KeyLength($newVal) {
		CkMime_put_Pkcs7KeyLength($this->_cPtr,$newVal);
	}

	function get_SigningHashAlg($str) {
		CkMime_get_SigningHashAlg($this->_cPtr,$str);
	}

	function signingHashAlg() {
		return CkMime_signingHashAlg($this->_cPtr);
	}

	function put_SigningHashAlg($newVal) {
		CkMime_put_SigningHashAlg($this->_cPtr,$newVal);
	}

	function getHeaderFieldAttribute($name,$attrName) {
		return CkMime_getHeaderFieldAttribute($this->_cPtr,$name,$attrName);
	}

	function HasSignatureSigningTime($index) {
		return CkMime_HasSignatureSigningTime($this->_cPtr,$index);
	}

	function GetSignatureSigningTime($index,$sysTime) {
		return CkMime_GetSignatureSigningTime($this->_cPtr,$index,$sysTime);
	}

	function RemoveHeaderField($name,$bAllOccurances) {
		CkMime_RemoveHeaderField($this->_cPtr,$name,$bAllOccurances);
	}

	function get_UseXPkcs7() {
		return CkMime_get_UseXPkcs7($this->_cPtr);
	}

	function put_UseXPkcs7($newVal) {
		CkMime_put_UseXPkcs7($this->_cPtr,$newVal);
	}

	function entireHead() {
		return CkMime_entireHead($this->_cPtr);
	}

	function entireBody() {
		return CkMime_entireBody($this->_cPtr);
	}

	function xml() {
		return CkMime_xml($this->_cPtr);
	}

	function mime() {
		return CkMime_mime($this->_cPtr);
	}

	function bodyEncoded() {
		return CkMime_bodyEncoded($this->_cPtr);
	}

	function bodyDecoded() {
		return CkMime_bodyDecoded($this->_cPtr);
	}

	function charset() {
		return CkMime_charset($this->_cPtr);
	}

	function disposition() {
		return CkMime_disposition($this->_cPtr);
	}

	function encoding() {
		return CkMime_encoding($this->_cPtr);
	}

	function contentType() {
		return CkMime_contentType($this->_cPtr);
	}

	function filename() {
		return CkMime_filename($this->_cPtr);
	}

	function name() {
		return CkMime_name($this->_cPtr);
	}

	function boundary() {
		return CkMime_boundary($this->_cPtr);
	}

	function micalg() {
		return CkMime_micalg($this->_cPtr);
	}

	function protocol() {
		return CkMime_protocol($this->_cPtr);
	}

	function version() {
		return CkMime_version($this->_cPtr);
	}

	function header($name) {
		return CkMime_header($this->_cPtr,$name);
	}

	function headerName($index) {
		return CkMime_headerName($this->_cPtr,$index);
	}

	function headerValue($index) {
		return CkMime_headerValue($this->_cPtr,$index);
	}

	function getHeaderField($name) {
		return CkMime_getHeaderField($this->_cPtr,$name);
	}

	function getHeaderFieldName($index) {
		return CkMime_getHeaderFieldName($this->_cPtr,$index);
	}

	function getHeaderFieldValue($index) {
		return CkMime_getHeaderFieldValue($this->_cPtr,$index);
	}

	function getEntireHead() {
		return CkMime_getEntireHead($this->_cPtr);
	}

	function getEntireBody() {
		return CkMime_getEntireBody($this->_cPtr);
	}

	function getXml() {
		return CkMime_getXml($this->_cPtr);
	}

	function getMime() {
		return CkMime_getMime($this->_cPtr);
	}

	function getBodyEncoded() {
		return CkMime_getBodyEncoded($this->_cPtr);
	}

	function getBodyDecoded() {
		return CkMime_getBodyDecoded($this->_cPtr);
	}

	function lastErrorText() {
		return CkMime_lastErrorText($this->_cPtr);
	}

	function lastErrorXml() {
		return CkMime_lastErrorXml($this->_cPtr);
	}

	function lastErrorHtml() {
		return CkMime_lastErrorHtml($this->_cPtr);
	}

	function get_Utf8() {
		return CkMime_get_Utf8($this->_cPtr);
	}

	function put_Utf8($b) {
		CkMime_put_Utf8($this->_cPtr,$b);
	}

	function get_Version($str) {
		CkMime_get_Version($this->_cPtr,$str);
	}

	function SaveLastError($filename) {
		return CkMime_SaveLastError($this->_cPtr,$filename);
	}

	function AddDetachedSignaturePk($cert,$privateKey) {
		return CkMime_AddDetachedSignaturePk($this->_cPtr,$cert,$privateKey);
	}

	function AddDetachedSignaturePk2($cert,$privateKey,$transferHeaderFields) {
		return CkMime_AddDetachedSignaturePk2($this->_cPtr,$cert,$privateKey,$transferHeaderFields);
	}

	function ConvertToSignedPk($cert,$privateKey) {
		return CkMime_ConvertToSignedPk($this->_cPtr,$cert,$privateKey);
	}

	function Decrypt() {
		return CkMime_Decrypt($this->_cPtr);
	}

	function Decrypt2($cert,$privateKey) {
		return CkMime_Decrypt2($this->_cPtr,$cert,$privateKey);
	}

	function Verify() {
		return CkMime_Verify($this->_cPtr);
	}

	function ConvertToMultipartMixed() {
		CkMime_ConvertToMultipartMixed($this->_cPtr);
	}

	function ConvertToMultipartAlt() {
		CkMime_ConvertToMultipartAlt($this->_cPtr);
	}

	function SetBodyFromPlainText($str) {
		return CkMime_SetBodyFromPlainText($this->_cPtr,$str);
	}

	function SetHeaderField($name,$value) {
		return CkMime_SetHeaderField($this->_cPtr,$name,$value);
	}

	function AddDetachedSignature2($cert,$transferHeaderFields) {
		return CkMime_AddDetachedSignature2($this->_cPtr,$cert,$transferHeaderFields);
	}

	function AddHeaderField($name,$value) {
		return CkMime_AddHeaderField($this->_cPtr,$name,$value);
	}

	function SetVerifyCert($cert) {
		CkMime_SetVerifyCert($this->_cPtr,$cert);
	}

	function LoadMimeFile($fileName) {
		return CkMime_LoadMimeFile($this->_cPtr,$fileName);
	}

	function LoadMime($mimeMsg) {
		return CkMime_LoadMime($this->_cPtr,$mimeMsg);
	}

	function SaveMime($filename) {
		return CkMime_SaveMime($this->_cPtr,$filename);
	}

	function ToEmailObject() {
		$r=CkMime_ToEmailObject($this->_cPtr);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkEmail($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function get_NumParts() {
		return CkMime_get_NumParts($this->_cPtr);
	}

	function GetPart($index) {
		$r=CkMime_GetPart($this->_cPtr,$index);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkMime($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function get_Protocol($str) {
		CkMime_get_Protocol($this->_cPtr,$str);
	}

	function put_Protocol($newVal) {
		CkMime_put_Protocol($this->_cPtr,$newVal);
	}

	function get_Micalg($str) {
		CkMime_get_Micalg($this->_cPtr,$str);
	}

	function put_Micalg($newVal) {
		CkMime_put_Micalg($this->_cPtr,$newVal);
	}

	function get_Boundary($str) {
		CkMime_get_Boundary($this->_cPtr,$str);
	}

	function put_Boundary($newVal) {
		CkMime_put_Boundary($this->_cPtr,$newVal);
	}

	function get_Name($str) {
		CkMime_get_Name($this->_cPtr,$str);
	}

	function put_Name($newVal) {
		CkMime_put_Name($this->_cPtr,$newVal);
	}

	function get_Filename($str) {
		CkMime_get_Filename($this->_cPtr,$str);
	}

	function put_Filename($newVal) {
		CkMime_put_Filename($this->_cPtr,$newVal);
	}

	function get_Charset($sb) {
		CkMime_get_Charset($this->_cPtr,$sb);
	}

	function put_Charset($newVal) {
		CkMime_put_Charset($this->_cPtr,$newVal);
	}

	function get_Disposition($str) {
		CkMime_get_Disposition($this->_cPtr,$str);
	}

	function put_Disposition($newVal) {
		CkMime_put_Disposition($this->_cPtr,$newVal);
	}

	function get_Encoding($str) {
		CkMime_get_Encoding($this->_cPtr,$str);
	}

	function put_Encoding($newVal) {
		CkMime_put_Encoding($this->_cPtr,$newVal);
	}

	function get_ContentType($str) {
		CkMime_get_ContentType($this->_cPtr,$str);
	}

	function put_ContentType($newVal) {
		CkMime_put_ContentType($this->_cPtr,$newVal);
	}

	function UnlockComponent($unlockCode) {
		return CkMime_UnlockComponent($this->_cPtr,$unlockCode);
	}

	function IsUnlocked() {
		return CkMime_IsUnlocked($this->_cPtr);
	}

	function get_NumHeaderFields() {
		return CkMime_get_NumHeaderFields($this->_cPtr);
	}

	function get_NumSignerCerts() {
		return CkMime_get_NumSignerCerts($this->_cPtr);
	}

	function get_NumEncryptCerts() {
		return CkMime_get_NumEncryptCerts($this->_cPtr);
	}

	function get_UnwrapExtras() {
		return CkMime_get_UnwrapExtras($this->_cPtr);
	}

	function put_UnwrapExtras($newVal) {
		CkMime_put_UnwrapExtras($this->_cPtr,$newVal);
	}

	function AppendPart($mime) {
		return CkMime_AppendPart($this->_cPtr,$mime);
	}

	function AppendPartFromFile($filename) {
		return CkMime_AppendPartFromFile($this->_cPtr,$filename);
	}

	function NewMultipartMixed() {
		return CkMime_NewMultipartMixed($this->_cPtr);
	}

	function NewMultipartRelated() {
		return CkMime_NewMultipartRelated($this->_cPtr);
	}

	function NewMultipartAlternative() {
		return CkMime_NewMultipartAlternative($this->_cPtr);
	}

	function NewMessageRfc822($mimeObject) {
		return CkMime_NewMessageRfc822($this->_cPtr,$mimeObject);
	}

	function SaveBody($filename) {
		return CkMime_SaveBody($this->_cPtr,$filename);
	}

	function IsMultipart() {
		return CkMime_IsMultipart($this->_cPtr);
	}

	function IsPlainText() {
		return CkMime_IsPlainText($this->_cPtr);
	}

	function IsHtml() {
		return CkMime_IsHtml($this->_cPtr);
	}

	function IsXml() {
		return CkMime_IsXml($this->_cPtr);
	}

	function IsSigned() {
		return CkMime_IsSigned($this->_cPtr);
	}

	function IsEncrypted() {
		return CkMime_IsEncrypted($this->_cPtr);
	}

	function IsMultipartMixed() {
		return CkMime_IsMultipartMixed($this->_cPtr);
	}

	function IsMultipartAlternative() {
		return CkMime_IsMultipartAlternative($this->_cPtr);
	}

	function IsMultipartRelated() {
		return CkMime_IsMultipartRelated($this->_cPtr);
	}

	function IsAttachment() {
		return CkMime_IsAttachment($this->_cPtr);
	}

	function IsText() {
		return CkMime_IsText($this->_cPtr);
	}

	function IsApplicationData() {
		return CkMime_IsApplicationData($this->_cPtr);
	}

	function IsImage() {
		return CkMime_IsImage($this->_cPtr);
	}

	function IsAudio() {
		return CkMime_IsAudio($this->_cPtr);
	}

	function IsVideo() {
		return CkMime_IsVideo($this->_cPtr);
	}

	function GetBodyBinary($db) {
		return CkMime_GetBodyBinary($this->_cPtr,$db);
	}

	function SetBodyFromEncoded($encoding,$str) {
		return CkMime_SetBodyFromEncoded($this->_cPtr,$encoding,$str);
	}

	function SetBodyFromHtml($str) {
		return CkMime_SetBodyFromHtml($this->_cPtr,$str);
	}

	function SetBodyFromXml($str) {
		return CkMime_SetBodyFromXml($this->_cPtr,$str);
	}

	function SetBodyFromBinary($dbuf) {
		return CkMime_SetBodyFromBinary($this->_cPtr,$dbuf);
	}

	function SetBodyFromFile($fileName) {
		return CkMime_SetBodyFromFile($this->_cPtr,$fileName);
	}

	function Encrypt($cert) {
		return CkMime_Encrypt($this->_cPtr,$cert);
	}

	function ConvertToSigned($cert) {
		return CkMime_ConvertToSigned($this->_cPtr,$cert);
	}

	function AddDetachedSignature($cert) {
		return CkMime_AddDetachedSignature($this->_cPtr,$cert);
	}

	function SaveXml($filename) {
		return CkMime_SaveXml($this->_cPtr,$filename);
	}

	function LoadXml($xml) {
		return CkMime_LoadXml($this->_cPtr,$xml);
	}

	function GetEncryptCert($index) {
		$r=CkMime_GetEncryptCert($this->_cPtr,$index);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkCert($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function GetSignerCert($index) {
		$r=CkMime_GetSignerCert($this->_cPtr,$index);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkCert($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function UnwrapSecurity() {
		return CkMime_UnwrapSecurity($this->_cPtr);
	}

	function LoadXmlFile($fileName) {
		return CkMime_LoadXmlFile($this->_cPtr,$fileName);
	}

	function RemovePart($index) {
		return CkMime_RemovePart($this->_cPtr,$index);
	}

	function ContainsEncryptedParts() {
		return CkMime_ContainsEncryptedParts($this->_cPtr);
	}

	function ContainsSignedParts() {
		return CkMime_ContainsSignedParts($this->_cPtr);
	}
}


?>