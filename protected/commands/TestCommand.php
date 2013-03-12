<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CastrolProcessIncomingInvoiceFile:
 *
 * This process performs the following tasks:
 *  1) Opens the file in Castrol format.
 *  2) Validates the contents of the file.
 *  3) Produces a Native XML file to be processed<
 *
 * @author jmariani
 */
class TestCommand extends CConsoleCommand {

    public function run($args) {

        $p = new EString('pepe');
        echo $p->generateAttributeLabel();
        
        echo yii::app()->string->set('pepe')->generateAttributeLabel();

//        CVarDumper::dump(PartyMail::model()->Type->getList());≤
//        echo Role::model()->Party()->filterBycode('SUPPLIER')->find()->id;

//        ini_set('auto_detect_line_endings',TRUE);
//
//        $fName = '/Users/jmariani/Documents/Office Projects/Castrol/Correos/customerEmails.csv';
//        $fHandle = fopen($fName, "r");
//        if (!$fHandle)
//            return false;
//        while (($data = fgetcsv($fHandle, 0, ',')) !== FALSE) {
//            print_r($data);
////            if (count($data) == 3) {
////                if ($data[0] == $invoice->CastrolCustomer->code) {
////                    fclose($fHandle);
////                    if (!trim($data[2]))
////                        return false;
////                    else
////                        return $data;
////                }
////            }
//        }
//        fclose($fHandle);
//        ini_set('auto_detect_line_endings',FALSE);

//        foreach (Party::model()->findAll() as $party) {
//            echo count($party->paymentMethods);
////            foreach ($party->partyPaymentMethods as $method) {
////                echo (count($party->partyPaymentMethods) != 0) . ' ' . $method->method . PHP_EOL;
////            }
//        }

//        $identifier = Identifier::model()->find('type = :type and value = :value', array(':type' => 'rfc', ':value' => 'NWM9709244W4'));
//        $name = Name::model()->find('name = :name', array(':name' => 'NUEVA WALMART DE MEXICO S DE RL DE CV'));
//        $party = Party::model()->identifiedBy($identifier)->namedAs($name)->find();
//        echo $identifier->type . ' ' . $identifier->value . ' ' . $party->id . ' ' . $party->name . ' ' . ($party->hasRole('SUPPLIER') ? 1 : 0) . ' ' . ($party->hasRole('CUSTOMER') ? 1 : 0) . PHP_EOL;
//
//        foreach (Identifier::model()->findAll() as $identifier) {
//            $party1 = Party::model()->identifiedBy($identifier)->find();
//            if ($party1) {
//                $party = Party::model()->identifiedBy($identifier)->namedAs($party1->name)->find();
//                echo $identifier->type . ' ' . $identifier->value . ' ' . $party->id . ' ' . $party->name . ' ' . ($party->hasRole('SUPPLIER') ? 1 : 0) . ' ' . ($party->hasRole('CUSTOMER') ? 1 : 0) . PHP_EOL;
//            }
//        }
//        foreach (cfd::model()->findAll() as $cfd) {
//            echo $cfd->vendor->rfc . ' ' . $cfd->vendor->name . PHP_EOL;
//            echo $cfd->customer->rfc . ' ' . $cfd->customer->name . PHP_EOL;
//            if ($cfd->cfdFile) echo $cfd->cfdFile->location . PHP_EOL;
//            echo $cfd->getFilebaseName(false). PHP_EOL;
//        }
//        $geo = yii::app()->geocode->query('SCHAFFHAUSEN%2C8200%2CCH', array('language' => 'es'));
//        CVarDumper::dump($geo);
//        foreach (Address::model()->findAll() as $address) {
//            $oAddress = $address->street . ',' . $address->extNbr . ',' .
//                    //$address->neighbourhood . ',' .
//                    $address->city . ',' .
//                    $address->municipality . ',' . $address->zipCode . ',MX';
//            $geo = yii::app()->geocode->query('MX', array('language' => 'es'));
////            CVarDumper::dump($geo);
//        }
//        $url = "http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false&language=es";
//        $result = file_get_contents("$url");
//        $json = json_decode($result);

        yii::app()->end();
    }

}

?>
