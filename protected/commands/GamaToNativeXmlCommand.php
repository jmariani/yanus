<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class GamaToNativeXmlCommand extends CConsoleCommand {

    const COL_COUNT = 43;
    const DOCUMENT_TYPE_COL = 0;
    const INVOICE_NBR_COL = 1;
    const INVOICE_DATE_COL = 2;
    const PAYMENT_TERM_COL = 3;
    const CAR_COL = 4;
    const CAR_KM_COL = 5;
    const LICENSE_PLATE_COL = 6;
    const VENDOR_RFC_COL = 7;
    const VENDOR_NAME_COL = 8;
    const VENDOR_ADDRESS_STREET_COL = 9;
    const VENDOR_ADDRESS_COLONY_COL = 10;
    const VENDOR_ADDRESS_CITY_COL = 11;
    const VENDOR_ADDRESS_REFERENCE_COL = 12;
    const VENDOR_ADDRESS_MUNICIPALITY_COL = 13;
    const VENDOR_ADDRESS_STATE_COL = 14;
    const VENDOR_ADDRESS_COUNTRY_COL = 15;
    const VENDOR_ADDRESS_ZIPCODE_COL = 16;
    const VENDOR_PHONE_NBR_COL = 17;
    const BILLABLE_COUNTRY_COL = 18;
    const CUSTOMER_RFC_COL = 19;
    const CUSTOMER_NAME_COL = 20;
    const CUSTOMER_VENDOR_NBR_COL = 21;
    const CUSTOMER_ADDRESS_STREET_COL = 22;
    const CUSTOMER_ADDRESS_COLONY_COL = 23;
    const CUSTOMER_ADDRESS_CITY_COL = 24;
    const CUSTOMER_ADDRESS_MUNICIPALITY_COL = 25;
    const CUSTOMER_ADDRESS_STATE_COL = 26;
    const CUSTOMER_ADDRESS_COUNTRY_COL = 27;
    const CUSTOMER_ADDRESS_ZIPCODE_COL = 28;
    const ITEM_QTY_COL = 29;
    const ITEM_DESCRIPTION_COL = 30;
    const ITEM_UNIT_PRICE_COL = 31;
    const ITEM_AMOUNT_COL = 32;
    const TAX_NAME_COL = 33;
    const TAX_RATE_COL = 34;
    const TAX_AMOUNT_COL = 35;
    const CAR_USERNAME_COL = 36;
    const CAR_ENGINE_NBR_COL = 37;
    const CAR_SERIAL_NBR_COL = 38;
    const CAR_INVENTORY_NBR_COL = 39;
    const AUTH_NBR_COL = 40;
    const PAYMENT_METHOD_COL = 41;
    const BANK_ACCT_COL = 42;

    public function run($args) {
        // args[0] = Source file
        // args[1] = Target file
        try {
            // Open source file
            $fHandle = fopen($args[0], 'r');
            @unlink($args[1]);
            // Create XML
            $nativeXml = new DOMDocument("1.0", "UTF-8");
            $root = $nativeXml->createElement('Cfds');
            $root = $nativeXml->appendChild($root);
            $invoiceNbr = 'XXX';
            $row = 1;
            while (($data = fgetcsv($fHandle, 0, ',')) !== FALSE) {
                // Skip first row
                if ($row != 1) {
                    $data = self::normalizeDataRow($data);
                    // Skip if colcount is not right
                    if (count($data) != self::COL_COUNT)
                        continue;
                    if ($invoiceNbr != $data[self::INVOICE_NBR_COL]) {
                        $invoiceNbr = $data[self::INVOICE_NBR_COL];
                        // Find SAT certificate for vendor RFC
                        $dt = self::getInvoiceDt($data[self::INVOICE_DATE_COL]);
                        $certificate = SatCertificate::model()->validAsOf($dt)->find('rfc = :rfc', array(':rfc' => $data[self::VENDOR_RFC_COL]));
                        if (!$certificate)
                            throw new CException(yii::t('yanus', 'Cannot find a valid certifate for RFC "{rfc}"', array('{rfc}' => $data[self::VENDOR_RFC_COL])));
                        $invoice = $root->appendChild($nativeXml->createElement('Cfd'));

                        $invoice->setAttribute('folio', $data[self::INVOICE_NBR_COL]);
                        $invoice->setAttribute('dttm', $dt->format(DateTime::ISO8601));
                        $invoice->setAttribute('paymentType', 'PAGO EN UNA SOLA EXHIBICION');
//                        $invoice->setAttribute('paymentTerm', $data[self::PAYMENT_TERM_COL]);
//                        $invoice->setAttribute('currency', 'MXP');
                        $invoice->setAttribute('voucherType', ($data[GamaHelper::DOCUMENT_TYPE_COL] == 0 ? 'ingreso' : 'egreso'));
                        $invoice->setAttribute('paymentMethod', $data[self::PAYMENT_METHOD_COL]);
                        if ($data[self::PAYMENT_METHOD_COL] != 'NO IDENTIFICADO')
                            $invoice->setAttribute('paymentAcctNbr', $data[self::BANK_ACCT_COL]);


                        // Parties
//                        $cfdParties = $invoice->appendChild($nativeXml->createElement('CfdParties'));
                        // Currency
                        $currency = $invoice->appendChild($nativeXml->createElement('Currency'));
                        $currency->setAttribute('code', 'MXP');

                        $paymentTerm = $invoice->appendChild($nativeXml->createElement('PaymentTerm'));
                        $paymentTerm->setAttribute('name', $data[self::PAYMENT_TERM_COL]);

                        // Vendor
                        $cfdParty = $invoice->appendChild($nativeXml->createElement('CfdParty'));
                        $cfdParty->setAttribute('type', CfdPartyTypeBehavior::VENDOR);
                        $party = $cfdParty->appendChild($nativeXml->createElement('Party'));
                        $party->setAttribute('person', (strlen($data[self::VENDOR_RFC_COL]) == 13) ? 1 : 0);

//                        $partyIdentifiers = $party->appendChild($nativeXml->createElement('PartyIdentifiers'));
                        $partyIdentifier = $party->appendChild($nativeXml->createElement('PartyIdentifier'));
                        $partyIdentifier->setAttribute('type', 'primary');
                        $identifier = $partyIdentifier->appendChild($nativeXml->createElement('Identifier'));
                        $identifier->setAttribute('type', IdentifierTypeBehavior::RFC);
                        $identifier->setAttribute('value', $data[self::VENDOR_RFC_COL]);

//                        $partyNames = $party->appendChild($nativeXml->createElement('PartyNames'));
                        $partyName = $party->appendChild($nativeXml->createElement('PartyName'));
                        $partyName->setAttribute('type', 'primary');
                        $name = $partyName->appendChild($nativeXml->createElement('Name'));
                        $name->setAttribute('name', $data[self::VENDOR_NAME_COL]);

                        // Customer
                        $cfdParty = $invoice->appendChild($nativeXml->createElement('CfdParty'));
                        $cfdParty->setAttribute('type', CfdPartyTypeBehavior::CUSTOMER);
                        $party = $cfdParty->appendChild($nativeXml->createElement('Party'));
                        $party->setAttribute('person', (strlen($data[self::CUSTOMER_RFC_COL]) == 13) ? 1 : 0);

//                        $partyIdentifiers = $party->appendChild($nativeXml->createElement('PartyIdentifiers'));
                        $partyIdentifier = $party->appendChild($nativeXml->createElement('PartyIdentifier'));
                        $partyIdentifier->setAttribute('type', 'primary');
                        $identifier = $partyIdentifier->appendChild($nativeXml->createElement('Identifier'));
                        $identifier->setAttribute('type', IdentifierTypeBehavior::RFC);
                        $identifier->setAttribute('value', $data[self::CUSTOMER_RFC_COL]);

//                        $partyNames = $party->appendChild($nativeXml->createElement('PartyNames'));
                        $partyName = $party->appendChild($nativeXml->createElement('PartyName'));
                        $partyName->setAttribute('type', 'primary');
                        $name = $partyName->appendChild($nativeXml->createElement('Name'));
                        $name->setAttribute('name', $data[self::CUSTOMER_NAME_COL]);

                        // Address
//                        $cfdAddresses = $invoice->appendChild($nativeXml->createElement('CfdAddresses'));
//
                        $cfdAddress = $invoice->appendChild($nativeXml->createElement('CfdAddress'));
                        $cfdAddress->setAttribute('type', AddressTypeBehavior::PRIMARY);
                        $cfdAddress->setAttribute('reference', $data[self::VENDOR_ADDRESS_REFERENCE_COL]);
                        $address = $cfdAddress->appendChild($nativeXml->createElement('Address'));
                        $address->setAttribute('street', $data[self::VENDOR_ADDRESS_STREET_COL]);
                        $address->setAttribute('neighbourhood', $data[self::VENDOR_ADDRESS_COLONY_COL]);
                        $address->setAttribute('city', $data[self::VENDOR_ADDRESS_CITY_COL]);
                        $address->setAttribute('country', $data[self::VENDOR_ADDRESS_COUNTRY_COL]);
                        $address->setAttribute('municipality', $data[self::VENDOR_ADDRESS_MUNICIPALITY_COL]);
                        $address->setAttribute('state', $data[self::VENDOR_ADDRESS_STATE_COL]);
                        $address->setAttribute('zipCode', substr('00000' . $data[self::VENDOR_ADDRESS_ZIPCODE_COL], -5));
//
                        $cfdAddress = $invoice->appendChild($nativeXml->createElement('CfdAddress'));
                        $cfdAddress->setAttribute('type', AddressTypeBehavior::BILL_TO);
                        $address = $cfdAddress->appendChild($nativeXml->createElement('Address'));
                        $address->setAttribute('street', $data[self::CUSTOMER_ADDRESS_STREET_COL]);
                        $address->setAttribute('neighbourhood', $data[self::CUSTOMER_ADDRESS_COLONY_COL]);
                        $address->setAttribute('city', $data[self::CUSTOMER_ADDRESS_CITY_COL]);
                        $address->setAttribute('country', $data[self::CUSTOMER_ADDRESS_COUNTRY_COL]);
                        $address->setAttribute('municipality', $data[self::CUSTOMER_ADDRESS_MUNICIPALITY_COL]);
                        $address->setAttribute('state', $data[self::CUSTOMER_ADDRESS_STATE_COL]);
                        $address->setAttribute('zipCode', substr('00000' . $data[self::CUSTOMER_ADDRESS_ZIPCODE_COL], -5));
//
//                        $cfdTaxRegimes = $invoice->appendChild($nativeXml->createElement('CfdTaxRegimes'));
                        $cfdTaxRegime = $invoice->appendChild($nativeXml->createElement('CfdTaxRegime'));
                        $cfdTaxRegime->setAttribute('name', 'Régimen General de Ley Personas Morales');

//                        $cfdTaxes = $invoice->appendChild($nativeXml->createElement('CfdTaxes'));
                        $cfdTax = $invoice->appendChild($nativeXml->createElement('CfdTax'));
                        $cfdTax->setAttribute('name', $data[self::TAX_NAME_COL]);
                        $cfdTax->setAttribute('rate', $data[self::TAX_RATE_COL]);
                        $cfdTax->setAttribute('amt', $data[self::TAX_AMOUNT_COL]);
                        $invoice->setAttribute('tax', $data[self::TAX_AMOUNT_COL]);

//                        $cfdItems = $invoice->appendChild($nativeXml->createElement('CfdItems'));
                        $subTotal = 0;
                        $total = $data[self::TAX_AMOUNT_COL];
                    }
                    // Process items
                    $item = $invoice->appendChild($nativeXml->createElement('CfdItem'));
                    $item->setAttribute('qty', $data[self::ITEM_QTY_COL]);
                    $item->setAttribute('uom', 'EA');
                    $item->setAttribute('description', $data[self::ITEM_DESCRIPTION_COL]);
                    $item->setAttribute('unitPrice', $data[self::ITEM_UNIT_PRICE_COL]);
                    $item->setAttribute('amt', $data[self::ITEM_AMOUNT_COL]);
                    if ($data[self::CAR_COL])
                        $item->setAttribute('vehicle', $data[self::CAR_COL]);
                    if ($data[self::CAR_KM_COL])
                        $item->setAttribute('km', $data[self::CAR_KM_COL]);
                    if ($data[self::LICENSE_PLATE_COL])
                        $item->setAttribute('licensePlate', $data[self::LICENSE_PLATE_COL]);
                    if ($data[self::CAR_USERNAME_COL])
                        $item->setAttribute('userName', $data[self::CAR_USERNAME_COL]);
                    if ($data[self::CAR_ENGINE_NBR_COL])
                        $item->setAttribute('engineNbr', $data[self::CAR_ENGINE_NBR_COL]);
                    if ($data[self::CAR_SERIAL_NBR_COL])
                        $item->setAttribute('serialNbr', $data[self::CAR_SERIAL_NBR_COL]);
                    if ($data[self::CAR_INVENTORY_NBR_COL])
                        $item->setAttribute('inventoryNbr', $data[self::CAR_INVENTORY_NBR_COL]);
                    if ($data[self::AUTH_NBR_COL])
                        $item->setAttribute('authNbr', $data[self::AUTH_NBR_COL]);

                    $subTotal += $data[self::ITEM_AMOUNT_COL];
                    $total += $data[self::ITEM_AMOUNT_COL];
                    $invoice->setAttribute('subTotal', $subTotal);
                    $invoice->setAttribute('total', $total);
                }
                $row++;
            }
            fclose($fHandle);
            $nativeXml->save($args[1]);
        } catch (Exception $e) {
            yii::trace($e->getMessage(), __METHOD__);
        }
    }

    public static function getInvoiceDt($dt) {
        echo $dt;
        return new DateTime(str_replace(' ', '', $dt), new DateTimeZone('America/Mexico_City'));
    }

    private static function normalizeDataRow($data) {
        // Normalize UTF8
        foreach ($data as $key => $value) {
            $data[$key] = trim(mb_convert_encoding($value, 'utf8'));
        }
        return $data;
    }

}

?>
