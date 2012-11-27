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
 *  3) Produces a Native XML file to be processed
 *
 * @author jmariani
 */
class TestCommand extends CConsoleCommand {

    public function run($args) {
//        $o = Party::model()->findByPk(93);
//        print_r($o->relations());
//        // Locators->Phone->Primary
//        $pl = new PartyLocator();
//        print_r($pl->scopes());
////        foreach ($o->Phones as $locator) {
////            echo $locator->Phone()->id . ' ' . $locator->Phone()->class . PHP_EOL;
////        }
//        if (isset($o->PrimaryPhoneLocator->Phone))
//            echo $o->PrimaryPhoneLocator->Phone . PHP_EOL;
//
//        print_r($o->partyHasRelationships);
//        $o = new PartyHasRelationship();
//        CVarDumper::dump($o->relations());
//        print_r($o->scopes());
//

//        print_r(Yii::app()->db->getSchema()->getTableNames());

//        $phr = PartyHasRelationship::model()->find('party_id = :id and relatedParty_id = :rpid and type = :type', array(':id' => 94, ':rpid' => 93, ':type' => PartyRelationshipTypeBehavior::SUPPLIER));
//        print_r($phr->relations());
//        echo $phr->supplierCodeEAV . PHP_EOL;
//        echo $phr->supplierCode . PHP_EOL;
//        $o = Cfd::model()->findByPk(754);
//        foreach ($o->cfdItems as $item) {
////            CVarDumper::dump($item->relations());
//            echo $item->GroupEAV . PHP_EOL;
//        }

        print_r(Cfd::model()->relations());

//        foreach (Cfd::model()->findAll() as $cfd) {
//            echo $cfd->invoice . PHP_EOL;
//            echo $cfd->cfdFile . PHP_EOL;
//            foreach ($cfd->fileAssets as $fa) {
//                echo $fa->type . PHP_EOL;
//                echo $fa->fileAsset . PHP_EOL;
//            }
//        }

//        print_r(CfdItem::model()->relations());
//
//        foreach (CfdItem::model()->findAll() as $cfdItem) {
//            echo $cfdItem->vehicle . PHP_EOL;
//            echo $cfdItem->km . PHP_EOL;
//            $cfdItem->km = 25;
//            echo $cfdItem->km . PHP_EOL;
//            echo $cfdItem->kmEAV . PHP_EOL;
////            $cfdItem->save();
//        }

//        foreach (Party::model()->findAll() as $party) {
//            echo $party->name . ' ' . $party->primaryPhone . PHP_EOL;
//            CVarDumper::dump($party->primaryPhone);
//        }
        foreach (cfd::model()->with(array('cfdFile','pdfFile'))->findAll() as $cfd) {
            echo $cfd->invoice . ' ' . ($cfd->cfdFile !== null ?'Si':'No') . ' ' . ($cfd->pdfFile !== null ?'Si':'No') . PHP_EOL;
//            print_r($cfd->cfdFile);
        }
    }


}

?>
