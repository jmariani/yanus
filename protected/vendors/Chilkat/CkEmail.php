<?php
class CkEmail {

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
		if (is_resource($res) && get_resource_type($res) === '_p_CkEmail') {
			$this->_cPtr=$res;
			return;
		}
		$this->_cPtr=new_CkEmail();
	}

	function lastErrorText() {
		return CkEmail_lastErrorText($this->_cPtr);
	}

	function lastErrorXml() {
		return CkEmail_lastErrorXml($this->_cPtr);
	}

	function lastErrorHtml() {
		return CkEmail_lastErrorHtml($this->_cPtr);
	}

	function AddDataAttachment2($fileName,$content,$contentType) {
		return CkEmail_AddDataAttachment2($this->_cPtr,$fileName,$content,$contentType);
	}

	function AppendToBody($str) {
		CkEmail_AppendToBody($this->_cPtr,$str);
	}

	function getAltHeaderField($index,$fieldName) {
		return CkEmail_getAltHeaderField($this->_cPtr,$index,$fieldName);
	}

	function getDeliveryStatusInfo($fieldName) {
		return CkEmail_getDeliveryStatusInfo($this->_cPtr,$fieldName);
	}

	function getAttachedMessageFilename($index) {
		return CkEmail_getAttachedMessageFilename($this->_cPtr,$index);
	}

	function LoadXmlString($xmlStr) {
		return CkEmail_LoadXmlString($this->_cPtr,$xmlStr);
	}

	function SetAttachmentCharset($index,$charset) {
		return CkEmail_SetAttachmentCharset($this->_cPtr,$index,$charset);
	}

	function SetFromMimeObject($mime) {
		return CkEmail_SetFromMimeObject($this->_cPtr,$mime);
	}

	function AspUnpack($prefix,$saveDir,$urlPath,$cleanFiles) {
		return CkEmail_AspUnpack($this->_cPtr,$prefix,$saveDir,$urlPath,$cleanFiles);
	}

	function AspUnpack2($prefix,$saveDir,$urlPath,$cleanFiles,$outBytes) {
		return CkEmail_AspUnpack2($this->_cPtr,$prefix,$saveDir,$urlPath,$cleanFiles,$outBytes);
	}

	function GetImapUid() {
		return CkEmail_GetImapUid($this->_cPtr);
	}

	function HasHeaderMatching($fieldName,$valuePattern,$caseInsensitive) {
		return CkEmail_HasHeaderMatching($this->_cPtr,$fieldName,$valuePattern,$caseInsensitive);
	}

	function get_Language($str) {
		CkEmail_get_Language($this->_cPtr,$str);
	}

	function language() {
		return CkEmail_language($this->_cPtr);
	}

	function GetDsnFinalRecipients() {
		$r=CkEmail_GetDsnFinalRecipients($this->_cPtr);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkStringArray($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function getRelatedContentLocation($index) {
		return CkEmail_getRelatedContentLocation($this->_cPtr,$index);
	}

	function GetMimeBinary($outBytes) {
		CkEmail_GetMimeBinary($this->_cPtr,$outBytes);
	}

	function AttachMessage($mimeBytes) {
		return CkEmail_AttachMessage($this->_cPtr,$mimeBytes);
	}

	function computeGlobalKey($encoding,$bFold) {
		return CkEmail_computeGlobalKey($this->_cPtr,$encoding,$bFold);
	}

	function get_NumDaysOld() {
		return CkEmail_get_NumDaysOld($this->_cPtr);
	}

	function get_PreferredCharset($str) {
		CkEmail_get_PreferredCharset($this->_cPtr,$str);
	}

	function preferredCharset() {
		return CkEmail_preferredCharset($this->_cPtr);
	}

	function put_PreferredCharset($newVal) {
		CkEmail_put_PreferredCharset($this->_cPtr,$newVal);
	}

	function get_VerboseLogging() {
		return CkEmail_get_VerboseLogging($this->_cPtr);
	}

	function put_VerboseLogging($newVal) {
		CkEmail_put_VerboseLogging($this->_cPtr,$newVal);
	}

	function AddRelatedHeader($index,$fieldName,$fieldValue) {
		CkEmail_AddRelatedHeader($this->_cPtr,$index,$fieldName,$fieldValue);
	}

	function ClearEncryptCerts() {
		CkEmail_ClearEncryptCerts($this->_cPtr);
	}

	function AddEncryptCert($cert) {
		return CkEmail_AddEncryptCert($this->_cPtr,$cert);
	}

	function UnpackHtml($unpackDir,$htmlFilename,$partsSubdir) {
		return CkEmail_UnpackHtml($this->_cPtr,$unpackDir,$htmlFilename,$partsSubdir);
	}

	function SetFromMimeBytes($mimeBytes) {
		return CkEmail_SetFromMimeBytes($this->_cPtr,$mimeBytes);
	}

	function SetAttachmentDisposition($index,$disposition) {
		return CkEmail_SetAttachmentDisposition($this->_cPtr,$index,$disposition);
	}

	function RemoveHtmlAlternative() {
		CkEmail_RemoveHtmlAlternative($this->_cPtr);
	}

	function RemovePlainTextAlternative() {
		CkEmail_RemovePlainTextAlternative($this->_cPtr);
	}

	function AddHeaderField2($fieldName,$fieldValue) {
		CkEmail_AddHeaderField2($this->_cPtr,$fieldName,$fieldValue);
	}

	function get_PrependHeaders() {
		return CkEmail_get_PrependHeaders($this->_cPtr);
	}

	function put_PrependHeaders($newVal) {
		CkEmail_put_PrependHeaders($this->_cPtr,$newVal);
	}

	function CreateDsn($explanation,$xmlDeliveryStatus,$bHeaderOnly) {
		$r=CkEmail_CreateDsn($this->_cPtr,$explanation,$xmlDeliveryStatus,$bHeaderOnly);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkEmail($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function CreateMdn($explanation,$xmlMdnFields,$bHeaderOnly) {
		$r=CkEmail_CreateMdn($this->_cPtr,$explanation,$xmlMdnFields,$bHeaderOnly);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkEmail($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function get_SigningHashAlg($str) {
		CkEmail_get_SigningHashAlg($this->_cPtr,$str);
	}

	function signingHashAlg() {
		return CkEmail_signingHashAlg($this->_cPtr);
	}

	function put_SigningHashAlg($newVal) {
		CkEmail_put_SigningHashAlg($this->_cPtr,$newVal);
	}

	function get_Pkcs7CryptAlg($str) {
		CkEmail_get_Pkcs7CryptAlg($this->_cPtr,$str);
	}

	function pkcs7CryptAlg() {
		return CkEmail_pkcs7CryptAlg($this->_cPtr);
	}

	function put_Pkcs7CryptAlg($newVal) {
		CkEmail_put_Pkcs7CryptAlg($this->_cPtr,$newVal);
	}

	function get_Pkcs7KeyLength() {
		return CkEmail_get_Pkcs7KeyLength($this->_cPtr);
	}

	function put_Pkcs7KeyLength($newVal) {
		CkEmail_put_Pkcs7KeyLength($this->_cPtr,$newVal);
	}

	function get_NumReports() {
		return CkEmail_get_NumReports($this->_cPtr);
	}

	function getReport($index) {
		return CkEmail_getReport($this->_cPtr,$index);
	}

	function getAlternativeBodyByContentType($contentType) {
		return CkEmail_getAlternativeBodyByContentType($this->_cPtr,$contentType);
	}

	function AddPfxSourceData($pfxData,$password) {
		return CkEmail_AddPfxSourceData($this->_cPtr,$pfxData,$password);
	}

	function AddPfxSourceFile($pfxFilePath,$password) {
		return CkEmail_AddPfxSourceFile($this->_cPtr,$pfxFilePath,$password);
	}

	function get_UnpackUseRelPaths() {
		return CkEmail_get_UnpackUseRelPaths($this->_cPtr);
	}

	function put_UnpackUseRelPaths($newVal) {
		CkEmail_put_UnpackUseRelPaths($this->_cPtr,$newVal);
	}

	function AddiCalendarAlternativeBody($body,$methodName) {
		return CkEmail_AddiCalendarAlternativeBody($this->_cPtr,$body,$methodName);
	}

	function addRelatedData($fileName,$inData) {
		return CkEmail_addRelatedData($this->_cPtr,$fileName,$inData);
	}

	function AddRelatedData2($inData,$fileNameInHtml) {
		CkEmail_AddRelatedData2($this->_cPtr,$inData,$fileNameInHtml);
	}

	function SetFromMimeBytes2($mimeBytes,$charset) {
		return CkEmail_SetFromMimeBytes2($this->_cPtr,$mimeBytes,$charset);
	}

	function GetDt() {
		$r=CkEmail_GetDt($this->_cPtr);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkDateTime($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function SetDt($dt) {
		return CkEmail_SetDt($this->_cPtr,$dt);
	}

	function SetTextBody($bodyText,$contentType) {
		CkEmail_SetTextBody($this->_cPtr,$bodyText,$contentType);
	}

	function getRelatedStringCrLf($index,$charset) {
		return CkEmail_getRelatedStringCrLf($this->_cPtr,$index,$charset);
	}

	function getRelatedContentID($index) {
		return CkEmail_getRelatedContentID($this->_cPtr,$index);
	}

	function getRelatedFilename($index) {
		return CkEmail_getRelatedFilename($this->_cPtr,$index);
	}

	function getRelatedString($index,$charset) {
		return CkEmail_getRelatedString($this->_cPtr,$index,$charset);
	}

	function getAlternativeBody($index) {
		return CkEmail_getAlternativeBody($this->_cPtr,$index);
	}

	function getAlternativeContentType($index) {
		return CkEmail_getAlternativeContentType($this->_cPtr,$index);
	}

	function getHtmlBody() {
		return CkEmail_getHtmlBody($this->_cPtr);
	}

	function getPlainTextBody() {
		return CkEmail_getPlainTextBody($this->_cPtr);
	}

	function getHeaderFieldName($index) {
		return CkEmail_getHeaderFieldName($this->_cPtr,$index);
	}

	function getHeaderFieldValue($index) {
		return CkEmail_getHeaderFieldValue($this->_cPtr,$index);
	}

	function getAttachmentStringCrLf($index,$charset) {
		return CkEmail_getAttachmentStringCrLf($this->_cPtr,$index,$charset);
	}

	function getAttachmentContentID($index) {
		return CkEmail_getAttachmentContentID($this->_cPtr,$index);
	}

	function getAttachmentContentType($index) {
		return CkEmail_getAttachmentContentType($this->_cPtr,$index);
	}

	function getAttachmentHeader($index,$fieldName) {
		return CkEmail_getAttachmentHeader($this->_cPtr,$index,$fieldName);
	}

	function getAttachmentString($index,$charset) {
		return CkEmail_getAttachmentString($this->_cPtr,$index,$charset);
	}

	function getAttachmentFilename($index) {
		return CkEmail_getAttachmentFilename($this->_cPtr,$index);
	}

	function getHeaderField($fieldName) {
		return CkEmail_getHeaderField($this->_cPtr,$fieldName);
	}

	function getBcc($index) {
		return CkEmail_getBcc($this->_cPtr,$index);
	}

	function getCC($index) {
		return CkEmail_getCC($this->_cPtr,$index);
	}

	function getTo($index) {
		return CkEmail_getTo($this->_cPtr,$index);
	}

	function getBccAddr($index) {
		return CkEmail_getBccAddr($this->_cPtr,$index);
	}

	function getCcAddr($index) {
		return CkEmail_getCcAddr($this->_cPtr,$index);
	}

	function getToAddr($index) {
		return CkEmail_getToAddr($this->_cPtr,$index);
	}

	function getBccName($index) {
		return CkEmail_getBccName($this->_cPtr,$index);
	}

	function getCcName($index) {
		return CkEmail_getCcName($this->_cPtr,$index);
	}

	function getToName($index) {
		return CkEmail_getToName($this->_cPtr,$index);
	}

	function getMime() {
		return CkEmail_getMime($this->_cPtr);
	}

	function getXml() {
		return CkEmail_getXml($this->_cPtr);
	}

	function uidl() {
		return CkEmail_uidl($this->_cPtr);
	}

	function charset() {
		return CkEmail_charset($this->_cPtr);
	}

	function encryptedBy() {
		return CkEmail_encryptedBy($this->_cPtr);
	}

	function signedBy() {
		return CkEmail_signedBy($this->_cPtr);
	}

	function fromAddress() {
		return CkEmail_fromAddress($this->_cPtr);
	}

	function fromName() {
		return CkEmail_fromName($this->_cPtr);
	}

	function mailer() {
		return CkEmail_mailer($this->_cPtr);
	}

	function header() {
		return CkEmail_header($this->_cPtr);
	}

	function ck_from() {
		return CkEmail_ck_from($this->_cPtr);
	}

	function subject() {
		return CkEmail_subject($this->_cPtr);
	}

	function replyTo() {
		return CkEmail_replyTo($this->_cPtr);
	}

	function bounceAddress() {
		return CkEmail_bounceAddress($this->_cPtr);
	}

	function body() {
		return CkEmail_body($this->_cPtr);
	}

	function qEncodeString($str,$charset) {
		return CkEmail_qEncodeString($this->_cPtr,$str,$charset);
	}

	function bEncodeString($str,$charset) {
		return CkEmail_bEncodeString($this->_cPtr,$str,$charset);
	}

	function addFileAttachment($fileName) {
		return CkEmail_addFileAttachment($this->_cPtr,$fileName);
	}

	function addRelatedFile($fileName) {
		return CkEmail_addRelatedFile($this->_cPtr,$fileName);
	}

	function addRelatedString($nameInHtml,$str,$charset) {
		return CkEmail_addRelatedString($this->_cPtr,$nameInHtml,$str,$charset);
	}

	function getReplaceString2($pattern) {
		return CkEmail_getReplaceString2($this->_cPtr,$pattern);
	}

	function getReplaceString($index) {
		return CkEmail_getReplaceString($this->_cPtr,$index);
	}

	function getReplacePattern($index) {
		return CkEmail_getReplacePattern($this->_cPtr,$index);
	}

	function generateFilename() {
		return CkEmail_generateFilename($this->_cPtr);
	}

	function fileDistList() {
		return CkEmail_fileDistList($this->_cPtr);
	}

	function createTempMht($inFilename) {
		return CkEmail_createTempMht($this->_cPtr,$inFilename);
	}

	function getRelatedContentType($index) {
		return CkEmail_getRelatedContentType($this->_cPtr,$index);
	}

	function AddRelatedString2($str,$charset,$filenameInHtml) {
		CkEmail_AddRelatedString2($this->_cPtr,$str,$charset,$filenameInHtml);
	}

	function AddRelatedFile2($filenameOnDisk,$filenameInHtml) {
		return CkEmail_AddRelatedFile2($this->_cPtr,$filenameOnDisk,$filenameInHtml);
	}

	function AddStringAttachment($fileName,$str) {
		return CkEmail_AddStringAttachment($this->_cPtr,$fileName,$str);
	}

	function AddStringAttachment2($fileName,$str,$charset) {
		return CkEmail_AddStringAttachment2($this->_cPtr,$fileName,$str,$charset);
	}

	function SetFromMimeText($mimeText) {
		return CkEmail_SetFromMimeText($this->_cPtr,$mimeText);
	}

	function SetFromMimeText2($mimeText,$numBytes) {
		return CkEmail_SetFromMimeText2($this->_cPtr,$mimeText,$numBytes);
	}

	function LoadEml($mimeFilename) {
		return CkEmail_LoadEml($this->_cPtr,$mimeFilename);
	}

	function LoadXml($xmlFilename) {
		return CkEmail_LoadXml($this->_cPtr,$xmlFilename);
	}

	function SetFromXmlText($xmlStr) {
		return CkEmail_SetFromXmlText($this->_cPtr,$xmlStr);
	}

	function ZipAttachments($zipFilename) {
		return CkEmail_ZipAttachments($this->_cPtr,$zipFilename);
	}

	function UnzipAttachments() {
		return CkEmail_UnzipAttachments($this->_cPtr);
	}

	function AesEncrypt($password) {
		return CkEmail_AesEncrypt($this->_cPtr,$password);
	}

	function AesDecrypt($password) {
		return CkEmail_AesDecrypt($this->_cPtr,$password);
	}

	function c_Clone() {
		$r=CkEmail_c_Clone($this->_cPtr);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkEmail($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function CreateForward() {
		$r=CkEmail_CreateForward($this->_cPtr);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkEmail($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function CreateReply() {
		$r=CkEmail_CreateReply($this->_cPtr);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkEmail($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function GetSignedByCert() {
		$r=CkEmail_GetSignedByCert($this->_cPtr);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkCert($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function GetEncryptedByCert() {
		$r=CkEmail_GetEncryptedByCert($this->_cPtr);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkCert($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function GetEncryptCert() {
		$r=CkEmail_GetEncryptCert($this->_cPtr);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkCert($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function GetSigningCert() {
		$r=CkEmail_GetSigningCert($this->_cPtr);
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
		return CkEmail_SetEncryptCert($this->_cPtr,$cert);
	}

	function SetSigningCert($cert) {
		return CkEmail_SetSigningCert($this->_cPtr,$cert);
	}

	function SetSigningCert2($cert,$key) {
		return CkEmail_SetSigningCert2($this->_cPtr,$cert,$key);
	}

	function GetFileContent($filename,$bData) {
		return CkEmail_GetFileContent($this->_cPtr,$filename,$bData);
	}

	function GetRelatedData($index,$buffer) {
		return CkEmail_GetRelatedData($this->_cPtr,$index,$buffer);
	}

	function AddHeaderField($fieldName,$fieldValue) {
		CkEmail_AddHeaderField($this->_cPtr,$fieldName,$fieldValue);
	}

	function RemoveHeaderField($fieldName) {
		CkEmail_RemoveHeaderField($this->_cPtr,$fieldName);
	}

	function SetHtmlBody($html) {
		CkEmail_SetHtmlBody($this->_cPtr,$html);
	}

	function SaveRelatedItem($index,$directory) {
		return CkEmail_SaveRelatedItem($this->_cPtr,$index,$directory);
	}

	function DropRelatedItem($index) {
		CkEmail_DropRelatedItem($this->_cPtr,$index);
	}

	function DropRelatedItems() {
		CkEmail_DropRelatedItems($this->_cPtr);
	}

	function AddHtmlAlternativeBody($body) {
		return CkEmail_AddHtmlAlternativeBody($this->_cPtr,$body);
	}

	function AddPlainTextAlternativeBody($body) {
		return CkEmail_AddPlainTextAlternativeBody($this->_cPtr,$body);
	}

	function get_NumHeaderFields() {
		return CkEmail_get_NumHeaderFields($this->_cPtr);
	}

	function GetAttachmentSize($index) {
		return CkEmail_GetAttachmentSize($this->_cPtr,$index);
	}

	function SaveAllAttachments($directory) {
		return CkEmail_SaveAllAttachments($this->_cPtr,$directory);
	}

	function SaveAttachedFile($index,$directory) {
		return CkEmail_SaveAttachedFile($this->_cPtr,$index,$directory);
	}

	function GetAttachmentData($index,$buffer) {
		return CkEmail_GetAttachmentData($this->_cPtr,$index,$buffer);
	}

	function DropSingleAttachment($index) {
		return CkEmail_DropSingleAttachment($this->_cPtr,$index);
	}

	function SetAttachmentFilename($index,$filename) {
		return CkEmail_SetAttachmentFilename($this->_cPtr,$index,$filename);
	}

	function AddAttachmentHeader($index,$fieldName,$fieldValue) {
		CkEmail_AddAttachmentHeader($this->_cPtr,$index,$fieldName,$fieldValue);
	}

	function DropAttachments() {
		CkEmail_DropAttachments($this->_cPtr);
	}

	function AddFileAttachment2($fileName,$contentType) {
		return CkEmail_AddFileAttachment2($this->_cPtr,$fileName,$contentType);
	}

	function get_NumReplacePatterns() {
		return CkEmail_get_NumReplacePatterns($this->_cPtr);
	}

	function SetReplacePattern($pattern,$replaceString) {
		return CkEmail_SetReplacePattern($this->_cPtr,$pattern,$replaceString);
	}

	function AddMultipleBcc($commaSeparatedAddresses) {
		return CkEmail_AddMultipleBcc($this->_cPtr,$commaSeparatedAddresses);
	}

	function AddMultipleCC($commaSeparatedAddresses) {
		return CkEmail_AddMultipleCC($this->_cPtr,$commaSeparatedAddresses);
	}

	function AddMultipleTo($commaSeparatedAddresses) {
		return CkEmail_AddMultipleTo($this->_cPtr,$commaSeparatedAddresses);
	}

	function ClearBcc() {
		CkEmail_ClearBcc($this->_cPtr);
	}

	function ClearCC() {
		CkEmail_ClearCC($this->_cPtr);
	}

	function ClearTo() {
		CkEmail_ClearTo($this->_cPtr);
	}

	function AddBcc($friendlyName,$emailAddress) {
		return CkEmail_AddBcc($this->_cPtr,$friendlyName,$emailAddress);
	}

	function AddCC($friendlyName,$emailAddress) {
		return CkEmail_AddCC($this->_cPtr,$friendlyName,$emailAddress);
	}

	function AddTo($friendlyName,$emailAddress) {
		return CkEmail_AddTo($this->_cPtr,$friendlyName,$emailAddress);
	}

	function SaveXml($filename) {
		return CkEmail_SaveXml($this->_cPtr,$filename);
	}

	function SaveEml($filename) {
		return CkEmail_SaveEml($this->_cPtr,$filename);
	}

	function get_Uidl($str) {
		CkEmail_get_Uidl($this->_cPtr,$str);
	}

	function get_ReturnReceipt() {
		return CkEmail_get_ReturnReceipt($this->_cPtr);
	}

	function put_ReturnReceipt($newVal) {
		CkEmail_put_ReturnReceipt($this->_cPtr,$newVal);
	}

	function get_Size() {
		return CkEmail_get_Size($this->_cPtr);
	}

	function get_NumAlternatives() {
		return CkEmail_get_NumAlternatives($this->_cPtr);
	}

	function get_NumRelatedItems() {
		return CkEmail_get_NumRelatedItems($this->_cPtr);
	}

	function get_SendEncrypted() {
		return CkEmail_get_SendEncrypted($this->_cPtr);
	}

	function put_SendEncrypted($newVal) {
		CkEmail_put_SendEncrypted($this->_cPtr,$newVal);
	}

	function get_FileDistList($str) {
		CkEmail_get_FileDistList($this->_cPtr,$str);
	}

	function put_FileDistList($str) {
		CkEmail_put_FileDistList($this->_cPtr,$str);
	}

	function get_Charset($str) {
		CkEmail_get_Charset($this->_cPtr,$str);
	}

	function put_Charset($str) {
		CkEmail_put_Charset($this->_cPtr,$str);
	}

	function get_OverwriteExisting() {
		return CkEmail_get_OverwriteExisting($this->_cPtr);
	}

	function put_OverwriteExisting($newVal) {
		CkEmail_put_OverwriteExisting($this->_cPtr,$newVal);
	}

	function get_SendSigned() {
		return CkEmail_get_SendSigned($this->_cPtr);
	}

	function put_SendSigned($newVal) {
		CkEmail_put_SendSigned($this->_cPtr,$newVal);
	}

	function get_EncryptedBy($str) {
		CkEmail_get_EncryptedBy($this->_cPtr,$str);
	}

	function get_Decrypted() {
		return CkEmail_get_Decrypted($this->_cPtr);
	}

	function get_SignaturesValid() {
		return CkEmail_get_SignaturesValid($this->_cPtr);
	}

	function get_SignedBy($str) {
		CkEmail_get_SignedBy($this->_cPtr,$str);
	}

	function get_ReceivedSigned() {
		return CkEmail_get_ReceivedSigned($this->_cPtr);
	}

	function get_ReceivedEncrypted() {
		return CkEmail_get_ReceivedEncrypted($this->_cPtr);
	}

	function get_NumAttachments() {
		return CkEmail_get_NumAttachments($this->_cPtr);
	}

	function get_FromAddress($str) {
		CkEmail_get_FromAddress($this->_cPtr,$str);
	}

	function put_FromAddress($str) {
		CkEmail_put_FromAddress($this->_cPtr,$str);
	}

	function get_FromName($str) {
		CkEmail_get_FromName($this->_cPtr,$str);
	}

	function put_FromName($str) {
		CkEmail_put_FromName($this->_cPtr,$str);
	}

	function get_LocalDate($sysTime) {
		CkEmail_get_LocalDate($this->_cPtr,$sysTime);
	}

	function get_EmailDate($sysTime) {
		CkEmail_get_EmailDate($this->_cPtr,$sysTime);
	}

	function put_LocalDate($sysTime) {
		CkEmail_put_LocalDate($this->_cPtr,$sysTime);
	}

	function put_EmailDate($sysTime) {
		CkEmail_put_EmailDate($this->_cPtr,$sysTime);
	}

	function get_Mailer($str) {
		CkEmail_get_Mailer($this->_cPtr,$str);
	}

	function put_Mailer($str) {
		CkEmail_put_Mailer($this->_cPtr,$str);
	}

	function get_Header($str) {
		CkEmail_get_Header($this->_cPtr,$str);
	}

	function get_NumBcc() {
		return CkEmail_get_NumBcc($this->_cPtr);
	}

	function get_NumCC() {
		return CkEmail_get_NumCC($this->_cPtr);
	}

	function get_NumTo() {
		return CkEmail_get_NumTo($this->_cPtr);
	}

	function get_From($str) {
		CkEmail_get_From($this->_cPtr,$str);
	}

	function put_From($str) {
		CkEmail_put_From($this->_cPtr,$str);
	}

	function get_Subject($str) {
		CkEmail_get_Subject($this->_cPtr,$str);
	}

	function put_Subject($str) {
		CkEmail_put_Subject($this->_cPtr,$str);
	}

	function get_ReplyTo($str) {
		CkEmail_get_ReplyTo($this->_cPtr,$str);
	}

	function put_ReplyTo($str) {
		CkEmail_put_ReplyTo($this->_cPtr,$str);
	}

	function get_BounceAddress($str) {
		CkEmail_get_BounceAddress($this->_cPtr,$str);
	}

	function put_BounceAddress($str) {
		CkEmail_put_BounceAddress($this->_cPtr,$str);
	}

	function get_Body($str) {
		CkEmail_get_Body($this->_cPtr,$str);
	}

	function put_Body($str) {
		CkEmail_put_Body($this->_cPtr,$str);
	}

	function UidlEquals($e) {
		return CkEmail_UidlEquals($this->_cPtr,$e);
	}

	function GetMimeObject() {
		$r=CkEmail_GetMimeObject($this->_cPtr);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkMime($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function SaveLastError($filename) {
		return CkEmail_SaveLastError($this->_cPtr,$filename);
	}

	function GetMbPlainTextBody($charset,$data) {
		return CkEmail_GetMbPlainTextBody($this->_cPtr,$charset,$data);
	}

	function GetMbHtmlBody($charset,$data) {
		return CkEmail_GetMbHtmlBody($this->_cPtr,$charset,$data);
	}

	function GetMbHeaderField($fieldName,$fieldData) {
		return CkEmail_GetMbHeaderField($this->_cPtr,$fieldName,$fieldData);
	}

	function GetMbHeaderField2($charset,$fieldName,$fieldData) {
		return CkEmail_GetMbHeaderField2($this->_cPtr,$charset,$fieldName,$fieldData);
	}

	function UnlockComponent($unlockCode) {
		return CkEmail_UnlockComponent($this->_cPtr,$unlockCode);
	}

	function get_NumAttachedMessages() {
		return CkEmail_get_NumAttachedMessages($this->_cPtr);
	}

	function GetAttachedMessage($index) {
		$r=CkEmail_GetAttachedMessage($this->_cPtr,$index);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkEmail($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function RemoveAttachedMessages() {
		CkEmail_RemoveAttachedMessages($this->_cPtr);
	}

	function RemoveAttachedMessage($index) {
		CkEmail_RemoveAttachedMessage($this->_cPtr,$index);
	}

	function GetLinkedDomains($array) {
		CkEmail_GetLinkedDomains($this->_cPtr,$array);
	}

	function UnSpamify() {
		CkEmail_UnSpamify($this->_cPtr);
	}

	function IsMultipartReport() {
		return CkEmail_IsMultipartReport($this->_cPtr);
	}

	function HasHtmlBody() {
		return CkEmail_HasHtmlBody($this->_cPtr);
	}

	function HasPlainTextBody() {
		return CkEmail_HasPlainTextBody($this->_cPtr);
	}

	function RemoveAttachmentPaths() {
		CkEmail_RemoveAttachmentPaths($this->_cPtr);
	}

	function get_Utf8() {
		return CkEmail_get_Utf8($this->_cPtr);
	}

	function put_Utf8($b) {
		CkEmail_put_Utf8($this->_cPtr,$b);
	}
}


?>