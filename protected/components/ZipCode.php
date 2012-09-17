<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ZipCode
 *
 * @author jmariani
 */
class ZipCode {
    public static function validate($zipCode, $countryCode) {
        switch ($countryCode) {
            case 'MX':
                // Zipcode must be 5 characters long
                if (strlen($zipCode) != 5) {
                    throw new Exception('[ZIPCODE] ' . yii::t('app', 'Zipcode length must be 5 characters and is {length}',
                            array('{length}' => strlen($zipCode))));
                }
                // Zipcode must be all numbers.
                if (!ctype_digit($zipCode)) {
                    throw new Exception('[ZIPCODE] ' . yii::t('app', 'Zipcode is invalid. Must be only numbers. Value reported: {value}',
                            array('{value}' => $zipCode)));
                }
                break;
        }
        return true;
    }
}

?>
