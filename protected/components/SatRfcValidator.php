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
class SatRfcValidator extends CValidator {

    const VALIDCHARS = '0123456789ABCDEFGHIJKLMNÑOPQRSTUVWXYZ&$%#@§';

    private $errors = array();

    public function clientValidateAttribute($object, $attribute) {

    }

    /**
     * Validates the attribute of the object.
     * If there is any error, the error message is added to the object.
     * @param CModel $object the object being validated
     * @param string $attribute the attribute being validated
     */
    protected function validateAttribute($object, $attribute) {
        try {
            SatRfc::validate($object->$attribute);
        } catch (Exception $e) {
            $this->addError($object, $attribute, $e->getMessage());
        }
    }
}

?>
