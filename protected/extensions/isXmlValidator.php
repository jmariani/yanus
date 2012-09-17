<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of satRfc
 *
 * @author jmariani
 */
class isXmlValidator extends CValidator {

  public function clientValidateAttribute($object, $attribute) {

  }

  /**
   * Validates the attribute of the object.
   * If there is any error, the error message is added to the object.
   * @param CModel $object the object being validated
   * @param string $attribute the attribute being validated
   */
  protected function validateAttribute($object, $attribute) {
    $file = CUploadedFile::getInstance($object, $attribute);
    if ($file) {
      $prev = libxml_use_internal_errors(true);
      $xml = @simplexml_load_file($file->tempName);
      if (!$xml) {
        if (!$object->hasErrors($attribute)) {
          $errors = array();
          $errors[] = yii::t('app', 'File "{fileName}" has syntax errors:', array('{fileName}' => $file->name));
          foreach (libxml_get_errors() as $xmlError) {
            $errors[] = $xmlError->message . ' ' . yii::t('app', 'at line {line}', array('{line}' => $xmlError->line));
          }
          $object->addErrors(array($attribute => $errors));
        }
      }
      libxml_use_internal_errors($prev);
    }
  }
}

?>
