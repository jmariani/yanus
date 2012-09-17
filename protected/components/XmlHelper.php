<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SatRfc
 *
 * @author jmariani
 */
class XmlHelper {

    public static function loadXml($xmlFile, $parentIdField = null, $parentId = null) {
        if (!($xmlFile instanceof SimpleXMLElement))
            if ($xmlFile instanceof DOMDocument)
                $xml = simplexml_import_dom($xmlFile);
            else
                $xml = simplexml_load_file($xmlFile);
        else
            $xml = $xmlFile;

        foreach ($xml->children() as $node) {
            echo $node->getName() . PHP_EOL;
            $objectName = $node->getName();
            $object = new $objectName;
            foreach ($node->attributes() as $field => $value) {
                $object->setAttribute($field, $value);
            }
            if ($parentIdField && $parentId)
                if ($objectName != 'Characteristic')
                    $object->setAttribute($parentIdField, $parentId);
                else
                    $object->setAttribute('objectId', $parentId);
            if (!$object->save()) print_r($object->getErrors());
            foreach ($node->children() as $child) {
                self::loadXml($child, $objectName . '_id', $object->id);
            }
//            self::loadXml($node, $objectName, $object->id);
        }
    }
}

?>
