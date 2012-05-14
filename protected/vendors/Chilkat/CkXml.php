<?php
class CkXml {

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
		if (is_resource($res) && get_resource_type($res) === '_p_CkXml') {
			$this->_cPtr=$res;
			return;
		}
		$this->_cPtr=new_CkXml();
	}

	function GetChildWithContent($content) {
		$r=CkXml_GetChildWithContent($this->_cPtr,$content);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkXml($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function GetChildExact($tag,$content) {
		$r=CkXml_GetChildExact($this->_cPtr,$tag,$content);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkXml($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function get_ContentInt() {
		return CkXml_get_ContentInt($this->_cPtr);
	}

	function put_ContentInt($newVal) {
		CkXml_put_ContentInt($this->_cPtr,$newVal);
	}

	function GetChildBoolValue($tag) {
		return CkXml_GetChildBoolValue($this->_cPtr,$tag);
	}

	function AddAttributeInt($name,$value) {
		return CkXml_AddAttributeInt($this->_cPtr,$name,$value);
	}

	function decodeEntities($str) {
		return CkXml_decodeEntities($this->_cPtr,$str);
	}

	function FindChild2($tag) {
		return CkXml_FindChild2($this->_cPtr,$tag);
	}

	function GetAttrValueInt($name) {
		return CkXml_GetAttrValueInt($this->_cPtr,$name);
	}

	function GetAttributeValueInt($index) {
		return CkXml_GetAttributeValueInt($this->_cPtr,$index);
	}

	function getChildTagByIndex($index) {
		return CkXml_getChildTagByIndex($this->_cPtr,$index);
	}

	function SaveBinaryContent($filename,$unzipFlag,$decryptFlag,$password) {
		return CkXml_SaveBinaryContent($this->_cPtr,$filename,$unzipFlag,$decryptFlag,$password);
	}

	function SetBinaryContentFromFile($filename,$zipFlag,$encryptFlag,$password) {
		return CkXml_SetBinaryContentFromFile($this->_cPtr,$filename,$zipFlag,$encryptFlag,$password);
	}

	function SortByAttributeInt($attrName,$ascending) {
		CkXml_SortByAttributeInt($this->_cPtr,$attrName,$ascending);
	}

	function TagEquals($tag) {
		return CkXml_TagEquals($this->_cPtr,$tag);
	}

	function UpdateAttributeInt($attrName,$value) {
		return CkXml_UpdateAttributeInt($this->_cPtr,$attrName,$value);
	}

	function UpdateChildContentInt($tag,$value) {
		CkXml_UpdateChildContentInt($this->_cPtr,$tag,$value);
	}

	function AddStyleSheet($styleSheet) {
		CkXml_AddStyleSheet($this->_cPtr,$styleSheet);
	}

	function SortRecordsByContentInt($sortTag,$ascending) {
		CkXml_SortRecordsByContentInt($this->_cPtr,$sortTag,$ascending);
	}

	function tagContent($tag) {
		return CkXml_tagContent($this->_cPtr,$tag);
	}

	function GetSelf() {
		$r=CkXml_GetSelf($this->_cPtr);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkXml($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function get_DocType($str) {
		CkXml_get_DocType($this->_cPtr,$str);
	}

	function docType() {
		return CkXml_docType($this->_cPtr);
	}

	function put_DocType($newVal) {
		CkXml_put_DocType($this->_cPtr,$newVal);
	}

	function chilkatPath($pathCmd) {
		return CkXml_chilkatPath($this->_cPtr,$pathCmd);
	}

	function GetChildWithAttr($tag,$attrName,$attrValue) {
		$r=CkXml_GetChildWithAttr($this->_cPtr,$tag,$attrName,$attrValue);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkXml($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function CopyRef($node) {
		CkXml_CopyRef($this->_cPtr,$node);
	}

	function tag() {
		return CkXml_tag($this->_cPtr);
	}

	function content() {
		return CkXml_content($this->_cPtr);
	}

	function encoding() {
		return CkXml_encoding($this->_cPtr);
	}

	function getXml() {
		return CkXml_getXml($this->_cPtr);
	}

	function lastErrorText() {
		return CkXml_lastErrorText($this->_cPtr);
	}

	function lastErrorXml() {
		return CkXml_lastErrorXml($this->_cPtr);
	}

	function lastErrorHtml() {
		return CkXml_lastErrorHtml($this->_cPtr);
	}

	function getChildContent($tag) {
		return CkXml_getChildContent($this->_cPtr,$tag);
	}

	function getAttrValue($name) {
		return CkXml_getAttrValue($this->_cPtr,$name);
	}

	function getAttributeValue($index) {
		return CkXml_getAttributeValue($this->_cPtr,$index);
	}

	function getAttributeName($index) {
		return CkXml_getAttributeName($this->_cPtr,$index);
	}

	function version() {
		return CkXml_version($this->_cPtr);
	}

	function accumulateTagContent($tag,$skipTags) {
		return CkXml_accumulateTagContent($this->_cPtr,$tag,$skipTags);
	}

	function getChildContentByIndex($index) {
		return CkXml_getChildContentByIndex($this->_cPtr,$index);
	}

	function getChildTag($index) {
		return CkXml_getChildTag($this->_cPtr,$index);
	}

	function childContent($tag) {
		return CkXml_childContent($this->_cPtr,$tag);
	}

	function attr($name) {
		return CkXml_attr($this->_cPtr,$name);
	}

	function attrValue($index) {
		return CkXml_attrValue($this->_cPtr,$index);
	}

	function attrName($index) {
		return CkXml_attrName($this->_cPtr,$index);
	}

	function xml() {
		return CkXml_xml($this->_cPtr);
	}

	function get_Utf8() {
		return CkXml_get_Utf8($this->_cPtr);
	}

	function put_Utf8($b) {
		CkXml_put_Utf8($this->_cPtr,$b);
	}

	function get_SortCaseInsensitive() {
		return CkXml_get_SortCaseInsensitive($this->_cPtr);
	}

	function put_SortCaseInsensitive($newVal) {
		CkXml_put_SortCaseInsensitive($this->_cPtr,$newVal);
	}

	function GetRoot2() {
		CkXml_GetRoot2($this->_cPtr);
	}

	function GetParent2() {
		return CkXml_GetParent2($this->_cPtr);
	}

	function FirstChild2() {
		return CkXml_FirstChild2($this->_cPtr);
	}

	function LastChild2() {
		return CkXml_LastChild2($this->_cPtr);
	}

	function SetBinaryContent($bData,$zipFlag,$encryptFlag,$password) {
		return CkXml_SetBinaryContent($this->_cPtr,$bData,$zipFlag,$encryptFlag,$password);
	}

	function GetBinaryContent($data,$unzipFlag,$decryptFlag,$password) {
		return CkXml_GetBinaryContent($this->_cPtr,$data,$unzipFlag,$decryptFlag,$password);
	}

	function ZipTree() {
		return CkXml_ZipTree($this->_cPtr);
	}

	function ZipContent() {
		return CkXml_ZipContent($this->_cPtr);
	}

	function UnzipTree() {
		return CkXml_UnzipTree($this->_cPtr);
	}

	function UnzipContent() {
		return CkXml_UnzipContent($this->_cPtr);
	}

	function EncryptContent($password) {
		return CkXml_EncryptContent($this->_cPtr,$password);
	}

	function DecryptContent($password) {
		return CkXml_DecryptContent($this->_cPtr,$password);
	}

	function GetRoot() {
		$r=CkXml_GetRoot($this->_cPtr);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkXml($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function GetChildWithTag($tag) {
		$r=CkXml_GetChildWithTag($this->_cPtr,$tag);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkXml($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function get_TreeId() {
		return CkXml_get_TreeId($this->_cPtr);
	}

	function PreviousSibling() {
		$r=CkXml_PreviousSibling($this->_cPtr);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkXml($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function NextSibling() {
		$r=CkXml_NextSibling($this->_cPtr);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkXml($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function PreviousSibling2() {
		return CkXml_PreviousSibling2($this->_cPtr);
	}

	function NextSibling2() {
		return CkXml_NextSibling2($this->_cPtr);
	}

	function LastChild() {
		$r=CkXml_LastChild($this->_cPtr);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkXml($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function FirstChild() {
		$r=CkXml_FirstChild($this->_cPtr);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkXml($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function Clear() {
		return CkXml_Clear($this->_cPtr);
	}

	function Copy($node) {
		CkXml_Copy($this->_cPtr,$node);
	}

	function GetParent() {
		$r=CkXml_GetParent($this->_cPtr);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkXml($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function SearchForAttribute($after,$tag,$attr,$valuePattern) {
		$r=CkXml_SearchForAttribute($this->_cPtr,$after,$tag,$attr,$valuePattern);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkXml($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function SearchAllForContent($after,$contentPattern) {
		$r=CkXml_SearchAllForContent($this->_cPtr,$after,$contentPattern);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkXml($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function SearchForContent($after,$tag,$contentPattern) {
		$r=CkXml_SearchForContent($this->_cPtr,$after,$tag,$contentPattern);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkXml($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function SearchForTag($after,$tag) {
		$r=CkXml_SearchForTag($this->_cPtr,$after,$tag);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkXml($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function SearchForAttribute2($after,$tag,$attr,$valuePattern) {
		return CkXml_SearchForAttribute2($this->_cPtr,$after,$tag,$attr,$valuePattern);
	}

	function SearchAllForContent2($after,$contentPattern) {
		return CkXml_SearchAllForContent2($this->_cPtr,$after,$contentPattern);
	}

	function SearchForContent2($after,$tag,$contentPattern) {
		return CkXml_SearchForContent2($this->_cPtr,$after,$tag,$contentPattern);
	}

	function SearchForTag2($after,$tag) {
		return CkXml_SearchForTag2($this->_cPtr,$after,$tag);
	}

	function GetNthChildWithTag2($tag,$n) {
		return CkXml_GetNthChildWithTag2($this->_cPtr,$tag,$n);
	}

	function FindChild($tag) {
		$r=CkXml_FindChild($this->_cPtr,$tag);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkXml($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function FindOrAddNewChild($tag) {
		$r=CkXml_FindOrAddNewChild($this->_cPtr,$tag);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkXml($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function NewChild($tag,$content) {
		$r=CkXml_NewChild($this->_cPtr,$tag,$content);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkXml($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function NewChild2($tag,$content) {
		CkXml_NewChild2($this->_cPtr,$tag,$content);
	}

	function NewChildInt2($tag,$value) {
		CkXml_NewChildInt2($this->_cPtr,$tag,$value);
	}

	function GetNthChildWithTag($tag,$n) {
		$r=CkXml_GetNthChildWithTag($this->_cPtr,$tag,$n);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkXml($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function NumChildrenHavingTag($tag) {
		return CkXml_NumChildrenHavingTag($this->_cPtr,$tag);
	}

	function ExtractChildByName($tag,$attrName,$attrValue) {
		$r=CkXml_ExtractChildByName($this->_cPtr,$tag,$attrName,$attrValue);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkXml($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function ExtractChildByIndex($index) {
		$r=CkXml_ExtractChildByIndex($this->_cPtr,$index);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkXml($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function RemoveFromTree() {
		CkXml_RemoveFromTree($this->_cPtr);
	}

	function GetChild($index) {
		$r=CkXml_GetChild($this->_cPtr,$index);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkXml($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function GetChild2($index) {
		return CkXml_GetChild2($this->_cPtr,$index);
	}

	function AddChildTree($tree) {
		return CkXml_AddChildTree($this->_cPtr,$tree);
	}

	function SwapTree($tree) {
		return CkXml_SwapTree($this->_cPtr,$tree);
	}

	function SwapNode($node) {
		return CkXml_SwapNode($this->_cPtr,$node);
	}

	function HasAttrWithValue($name,$value) {
		return CkXml_HasAttrWithValue($this->_cPtr,$name,$value);
	}

	function RemoveAllAttributes() {
		return CkXml_RemoveAllAttributes($this->_cPtr);
	}

	function RemoveChild($tag) {
		CkXml_RemoveChild($this->_cPtr,$tag);
	}

	function RemoveAttribute($name) {
		return CkXml_RemoveAttribute($this->_cPtr,$name);
	}

	function AddAttribute($name,$value) {
		return CkXml_AddAttribute($this->_cPtr,$name,$value);
	}

	function AppendToContent($str) {
		return CkXml_AppendToContent($this->_cPtr,$str);
	}

	function SaveXml($fileName) {
		return CkXml_SaveXml($this->_cPtr,$fileName);
	}

	function LoadXmlFile($fileName) {
		return CkXml_LoadXmlFile($this->_cPtr,$fileName);
	}

	function LoadXml($xmlData) {
		return CkXml_LoadXml($this->_cPtr,$xmlData);
	}

	function LoadXmlFile2($fileName,$autoTrim) {
		return CkXml_LoadXmlFile2($this->_cPtr,$fileName,$autoTrim);
	}

	function LoadXml2($xmlData,$autoTrim) {
		return CkXml_LoadXml2($this->_cPtr,$xmlData,$autoTrim);
	}

	function get_Version($str=null) {
		switch (func_num_args()) {
		case 0: $r=CkXml_get_Version($this->_cPtr); break;
		default: $r=CkXml_get_Version($this->_cPtr,$str);
		}
		return $r;
	}

	function get_Cdata() {
		return CkXml_get_Cdata($this->_cPtr);
	}

	function put_Cdata($newVal) {
		return CkXml_put_Cdata($this->_cPtr,$newVal);
	}

	function get_NumChildren() {
		return CkXml_get_NumChildren($this->_cPtr);
	}

	function get_Content($str) {
		CkXml_get_Content($this->_cPtr,$str);
	}

	function put_Content($newVal) {
		CkXml_put_Content($this->_cPtr,$newVal);
	}

	function UpdateChildContent($tag,$value) {
		CkXml_UpdateChildContent($this->_cPtr,$tag,$value);
	}

	function ContentMatches($pattern,$caseSensitive) {
		return CkXml_ContentMatches($this->_cPtr,$pattern,$caseSensitive);
	}

	function ChildContentMatches($tag,$pattern,$caseSensitive) {
		return CkXml_ChildContentMatches($this->_cPtr,$tag,$pattern,$caseSensitive);
	}

	function get_Tag($str) {
		CkXml_get_Tag($this->_cPtr,$str);
	}

	function put_Tag($newVal) {
		CkXml_put_Tag($this->_cPtr,$newVal);
	}

	function get_NumAttributes() {
		return CkXml_get_NumAttributes($this->_cPtr);
	}

	function get_Standalone() {
		return CkXml_get_Standalone($this->_cPtr);
	}

	function put_Standalone($newVal) {
		CkXml_put_Standalone($this->_cPtr,$newVal);
	}

	function get_Encoding($str) {
		CkXml_get_Encoding($this->_cPtr,$str);
	}

	function put_Encoding($newVal) {
		CkXml_put_Encoding($this->_cPtr,$newVal);
	}

	function SaveLastError($filename) {
		return CkXml_SaveLastError($this->_cPtr,$filename);
	}

	function QEncodeContent($charset,$db) {
		return CkXml_QEncodeContent($this->_cPtr,$charset,$db);
	}

	function BEncodeContent($charset,$db) {
		return CkXml_BEncodeContent($this->_cPtr,$charset,$db);
	}

	function DecodeContent($db) {
		return CkXml_DecodeContent($this->_cPtr,$db);
	}

	function UpdateAttribute($attrName,$attrValue) {
		return CkXml_UpdateAttribute($this->_cPtr,$attrName,$attrValue);
	}

	function GetChildIntValue($tag,$value) {
		return CkXml_GetChildIntValue($this->_cPtr,$tag,$value);
	}

	function SortByTag($ascending) {
		CkXml_SortByTag($this->_cPtr,$ascending);
	}

	function SortByContent($ascending) {
		CkXml_SortByContent($this->_cPtr,$ascending);
	}

	function SortByAttribute($attrName,$ascending) {
		CkXml_SortByAttribute($this->_cPtr,$attrName,$ascending);
	}

	function SortRecordsByContent($sortTag,$ascending) {
		CkXml_SortRecordsByContent($this->_cPtr,$sortTag,$ascending);
	}

	function SortRecordsByAttribute($sortTag,$attrName,$ascending) {
		CkXml_SortRecordsByAttribute($this->_cPtr,$sortTag,$attrName,$ascending);
	}

	function FindNextRecord($tag,$contentPattern) {
		$r=CkXml_FindNextRecord($this->_cPtr,$tag,$contentPattern);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new CkXml($r);
			}
			return new $c($r);
		}
		return $r;
	}

	function HasChildWithTag($tag) {
		return CkXml_HasChildWithTag($this->_cPtr,$tag);
	}

	function RemoveChildWithContent($content) {
		CkXml_RemoveChildWithContent($this->_cPtr,$content);
	}

	function HasChildWithTagAndContent($tag,$content) {
		return CkXml_HasChildWithTagAndContent($this->_cPtr,$tag,$content);
	}

	function HasChildWithContent($content) {
		return CkXml_HasChildWithContent($this->_cPtr,$content);
	}

	function RemoveAllChildren() {
		CkXml_RemoveAllChildren($this->_cPtr);
	}

	function RemoveChildByIndex($index) {
		CkXml_RemoveChildByIndex($this->_cPtr,$index);
	}

	function AddToAttribute($name,$amount) {
		CkXml_AddToAttribute($this->_cPtr,$name,$amount);
	}

	function AddToContent($amount) {
		CkXml_AddToContent($this->_cPtr,$amount);
	}

	function AddToChildContent($tag,$amount) {
		CkXml_AddToChildContent($this->_cPtr,$tag,$amount);
	}

	function AddOrUpdateAttributeI($name,$value) {
		CkXml_AddOrUpdateAttributeI($this->_cPtr,$name,$value);
	}

	function AddOrUpdateAttribute($name,$value) {
		CkXml_AddOrUpdateAttribute($this->_cPtr,$name,$value);
	}

	function HasAttribute($name) {
		return CkXml_HasAttribute($this->_cPtr,$name);
	}
}


?>