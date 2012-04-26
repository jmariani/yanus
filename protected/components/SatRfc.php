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
    public static function validate($rfc) {

        // Validate RFC length
        switch (strlen($rfc)) {
            case 12:
                $innerPos = 3;
                break;
            case 13:
                $innerPos = 4;
                break;
            default:
                $msg = '[SATRFC] ';
                $msg = yii::t('app', 'RFC length is {length} and it must be 12 or 13 characters long.', array('{length}' => strlen($rfc)));
                throw new Exception('[SATRFC] ' . $msg);
        }
        // Validate inner section.
        $rfcYear = substr($rfc, $innerPos, 2);
        $rfcMonth = substr($rfc, $innerPos + 2, 2);
        $rfcDay = substr($rfc, $innerPos + 4, 2);
        if (!checkdate($rfcMonth, $rfcDay, $rfcYear)) {
            throw new Exception('[SATRFC] ' . yii::t('app', 'Inner segment of RFC must be a valid date. Value reported: {inner}',
                    array('{inner}' => substr($rfc, $innerPos, 6))));
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
            throw new Exception('[SATRFC] ' . yii::t('app', 'Invalid checksum for RFC. Checksum must be a number (0-9) or the letter "A". Value reported: {chksum}',
                    array('{chksum}' => $checkSum)));
        }
        return true;
    }
}

?>
