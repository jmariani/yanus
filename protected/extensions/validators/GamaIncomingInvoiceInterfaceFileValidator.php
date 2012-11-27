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
class GamaIncomingInvoiceInterfaceFileValidator extends CValidator {

    public function clientValidateAttribute($object, $attribute) {

    }

    /**
     * Validates the attribute of the object.
     * If there is any error, the error message is added to the object.
     * @param CModel $object the object being validated
     * @param string $attribute the attribute being validated
     */
    protected function validateAttribute($object, $attribute) {
        error_log('ENTER THE VALIDATOR');
        error_log($object->swGetStatus()->getId());
        // Depending on my scenario, I will do stuff.
        switch ($object->scenario) {
            case IncomingInvoiceInterfaceFile::SCENARIO_VALIDATE:
                error_log('Start validation');
                GamaHelper::validateIncomingInvoiceInterfaceFile($object);
                break;
            case IncomingInvoiceInterfaceFile::SCENARIO_PROCESS:
                error_log('Start processing');
                GamaHelper::processIncomingInvoiceInterfaceFile($object);
                break;
        }
    }

}

?>
