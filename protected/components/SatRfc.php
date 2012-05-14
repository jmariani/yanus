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
class SatRfc {
    const rfc_regex = '/^[A-Z,Ñ,&]{3,4}[0-9]{2}[0-1][0-9][0-3][0-9][A-Z,0-9]?[A-Z,0-9]?[0-9,A]+$/u';

    public static function validate($rfc) {
        if (!preg_match(self::rfc_regex, $rfc))
            throw new Exception(yii::t('app', 'RFC "{rfc}" is invalid.', array('{rfc}' => $rfc,)));
        // Validate RFC length
        switch (strlen($rfc)) {
            case 12:
                $innerPos = 3;
                break;
            case 13:
                $innerPos = 4;
                break;
            default:
                throw new Exception(yii::t('app', 'RFC "{rfc}" is invalid. Length is {length} and it must be 12 or 13 characters long.',
                        array('{rfc}' => $rfc, '{length}' => strlen($rfc))));
        }
        // Validate inner section.
        $rfcYear = substr($rfc, $innerPos, 2);
        $rfcMonth = substr($rfc, $innerPos + 2, 2);
        $rfcDay = substr($rfc, $innerPos + 4, 2);
        if (!checkdate($rfcMonth, $rfcDay, $rfcYear)) {
            // Try adding '20' to the year.
            $rfcYear = '20' . $rfcYear;
            if (!checkdate($rfcMonth, $rfcDay, $rfcYear)) {
                throw new Exception(yii::t('app', 'RFC "{rfc}" is invalid. Inner segment of RFC must be a valid date (YYMMDD). Value reported: {inner}',
                        array('{rfc}' => $rfc, '{inner}' => substr($rfc, $innerPos, 6))));
            }
        }
        // Validate checksum.
        $checkSum = substr($rfc, -1);
        switch ($checkSum) {
            case '0':
            case '1':
            case '2':
            case '3':
            case '4':
            case '5':
            case '6':
            case '7':
            case '8':
            case '9':
            case 'A':
                break;
            default:
            throw new Exception(yii::t('app', 'RFC "{rfc}" is invalid. Invalid checksum. Checksum must be a number (0-9) or the letter "A". Value reported: {chksum}',
                    array('{rfc}' => $rfc, '{chksum}' => $checkSum)));
        }
        return true;
    }
}

?>
