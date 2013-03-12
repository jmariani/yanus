<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class CastrolToNativeXmlCommand extends CConsoleCommand {
    // Columns from the input file

    const COL_COUNT = 91;
    const INVOICE_VERSION_COL = 0;  // IGNORED
    const INVOICE_NBR_COL = 1;   // REQUIRED. INVOICE SERIAL & FOLIO
    const FOLIO_APPROVAL_YEAR_COL = 2;  // IGNORED
    const INVOICE_PAYMENT_TYPE = 3; // IGNORED. REPLACED BY 'PAGO EN UNA SOLA EXHIBICION'
    const PAYMENT_TERM_COL = 4; // REQUIRED. MUST EXIST ON PaymentTerm OBJECT.
    const INVOICE_PAYMENT_COL = 5;  // IGNORED
    const DOCUMENT_TYPE_COL = 6; // OPTIONAL. IF IT'S EMPTY, IT'S A COMMENT LINE. IF IT'S NOT, MUST BE 'INGRESO' OR 'EGRESO'.
    // VENDOR DATA
    const VENDOR_RFC_COL = 7;   // REQUIRED. MUST BE A VALID RFC
    const VENDOR_NAME_COL = 8;  // REQUIRED.
    // VENDOR FISCAL ADDRESS
    const VENDOR_ADDRESS_STREET_COL = 9;    // REQUIRED
    const VENDOR_ADDRESS_EXTNUM_COL = 10;   // OPTIONAL
    const VENDOR_ADDRESS_INTNUM_COL = 11;   // OPTIONAL
    const VENDOR_ADDRESS_NEIGHBOURHOOD_COL = 12;    // REQUIRED. MUNICIPALITY
    const VENDOR_ADDRESS_MUNICIPALITY_COL = 13; // OPTIONAL
    const VENDOR_ADDRESS_STATE_COL = 14;    // REQUIRED
    const VENDOR_ADDRESS_COUNTRY_COL = 15;  // REQUIRED
    const VENDOR_ADDRESS_ZIPCODE_COL = 16;  // REQUIRED
    // VENDOR INVOICED FROM ADDRESS
    // OPTIONAL
    const INVOICE_FROM_NAME_COL = 17;
    const INVOICE_FROM_ADDRESS_STREET_COL = 18;
    const INVOICE_FROM_ADDRESS_EXTNUM_COL = 19;
    const INVOICE_FROM_ADDRESS_INTNUM_COL = 20;
    const INVOICE_FROM_ADDRESS_NEIGHBOURHOOD_COL = 21;
    const INVOICE_FROM_ADDRESS_CITY_COL = 22;
    const INVOICE_FROM_ADDRESS_STATE_COL = 23;
    const INVOICE_FROM_ADDRESS_COUNTRY_COL = 24;
    const INVOICE_FROM_ADDRESS_ZIPCODE_COL = 25;

    // CUSTOMER DATA
    const CUSTOMER_RFC_COL = 26;
    const CUSTOMER_NAME_COL = 27;
    // CUSTOMER ADDRESS
    const CUSTOMER_SOLD_TO_ADDRESS_STREET_COL = 28; // OPTIONAL - VW STREET
    const CUSTOMER_SOLD_TO_ADDRESS_EXTNUM_COL = 29; // OPTIONAL - VW CITY
    const CUSTOMER_SOLD_TO_ADDRESS_INTNUM_COL = 30; // OPTIONAL - VW MUNICIPALITY
    const CUSTOMER_SOLD_TO_ADDRESS_NEIGHBOURHOOD_COL = 31;  // OPTIONAL - VW BLANK
    const CUSTOMER_SOLD_TO_ADDRESS_CITY_COL = 32;   // OPTIONAL - VW BLANK
    const CUSTOMER_SOLD_TO_ADDRESS_STATE_COL = 33;  // OPTIONAL - VW STATE
    const CUSTOMER_SOLD_TO_ADDRESS_COUNTRY_COL = 34;    // REQUIRED - VW COUNTYR
    const CUSTOMER_SOLD_TO_ADDRESS_ZIPCODE_COL = 35;    // OPTIONAL - VW ZIPCODE
    // Item
    const ITEM_QTY = 36;    // REQUIRED
    const PRODUCT_UOM_COL = 37; // OPTIONAL. DEFAULT TO EA
    const PRODUCT_CODE_COL = 38;    // OPTIONAL
    const PRODUCT_DESCRIPTION_COL_1 = 39;   // REQUIRED
    const PRODUCT_DESCRIPTION_COL_2 = 40;   // OPTIONAL
    const ITEM_UNIT_PRICE = 41; // REQUIRED
    const ITEM_TOTAL_PRICE = 42;    // REQUIRED
    // Pedimento
    const CUSTOMS_DOCUMENT_NUMBER_COL = 43;
    const CUSTOMS_DOCUMENT_DATE_COL = 44;
    const CUSTOMS_NAME_COL = 45;

    // TAX
    const TAX_TYPE = 46;
    const TAX_RATE = 47;
    const TAX_AMOUNT = 48;
    const TAX_TOTAL_AMOUNT = 49;
    const TOTAL_BEFORE_DISCOUNT = 50;
    const DISCOUNT_AMOUNT = 51;
    const DISCOUNT_REASON = 52;
    const TOTAL_AFTER_DISCOUNT = 53;
    const DISCOUNT_AMOUNT_2 = 54;
    const DISCOUNT_REASON_2 = 55;
    const DISCOUNT_AMOUNT_3 = 56;
    const DISCOUNT_REASON_3 = 57;
    const DISCOUNT_AMOUNT_4 = 58;
    const DISCOUNT_REASON_4 = 59;
    const CURRENCY_COL = 60;
    const CURRENCY_RATE_COL = 61;
    const QUANTITY_IN_LT_COL = 62;
    const PROMISED_DATE_COL = 63;
    const TIME_OF_DAY_COL = 64;
    const BP_ORDER_NBR_COL = 65;
    const CUSTOMER_ORDER_NBR_COL = 66;
    const BP_CUSTOMER_CODE_COL = 67;
    const EMAIL_ADDRESS_COL = 68;


    // Customer Ship To address
    const CUSTOMER_SHIP_TO_RFC_COL = 69;
    const CUSTOMER_SHIP_TO_NAME_COL = 70;
    const CUSTOMER_SHIP_TO_ADDRESS_STREET_COL = 71;
    const CUSTOMER_SHIP_TO_ADDRESS_EXTNUM_COL = 72;
    const CUSTOMER_SHIP_TO_ADDRESS_INTNUM_COL = 73;
    const CUSTOMER_SHIP_TO_ADDRESS_NEIGHBOURHOOD_COL = 74;
    const CUSTOMER_SHIP_TO_ADDRESS_CITY_COL = 75;
    const CUSTOMER_SHIP_TO_ADDRESS_STATE_COL = 76;
    const CUSTOMER_SHIP_TO_ADDRESS_COUNTRY_COL = 77;
    const CUSTOMER_SHIP_TO_ADDRESS_ZIPCODE_COL = 78;
    const INVOICE_DATE_COL = 79;
    const AGENT_COL = 80;
    const TRANSPORT_COL = 81;
    const TRANSACTION_ORDER_DATE_COL = 82;
    const FOREIGN_UNIT_PRICE_COL = 83;
    const FOREIGN_EXTENDED_PRICE_COL = 84;
    const FOREIGN_TAX_COL = 85;
    const FOREIGN_DISCOUNT = 86;
    const FOREIGN_DISCOUNT_2 = 87;
    const FOREIGN_DISCOUNT_3 = 88;
    const FOREIGN_DISCOUNT_4 = 89;
    const VW_RFC = 'VME640813HF6';

    private $row = 1;
    private $invoiceNbr = 'XXX';
    private $runMode;
    private $paymentMethods = array();
    private $customerEmails = array();

    public function run($args) {
        // args[0] = Source file
        // args[1] = Target file

        ini_set('auto_detect_line_endings', TRUE);

        $log = new CLogger();
        // Find if the file is on the database
        $incomingInvoiceInterfaceFile = IncomingInvoiceInterfaceFile::model()->filterByfileName(pathinfo($args[0], PATHINFO_FILENAME))->find();
        // if file exists but its status is not the initial, delete the record and create a new one.
        if ($incomingInvoiceInterfaceFile) {
            if (!$incomingInvoiceInterfaceFile->swIsInitialStatus()) {
                $incomingInvoiceInterfaceFile->delete();
                $incomingInvoiceInterfaceFile = false;
            }
        }
        if (!$incomingInvoiceInterfaceFile)
            $incomingInvoiceInterfaceFile = IncomingInvoiceInterfaceFile::model()->importXml("<IncomingInvoiceInterfaceFile " .
                    "fileName='" . pathinfo($args[0], PATHINFO_FILENAME) . "' " .
                    "fileLocation='" . $args[0] . "'>" .
                    "</IncomingInvoiceInterfaceFile>");
        try {
            $incomingInvoiceInterfaceFile->swNextStatus(IncomingInvoiceInterfaceFile::PROCESSING);
            $incomingInvoiceInterfaceFile->save();

            // Load payment method files
            $this->loadPaymentMethodFile();
            // Load email file
            $this->loadEmailFile();

            // Open source file
            $fHandle = fopen($args[0], 'r');
            @unlink($args[1]);
            $this->runMode = SystemConfig::getValue(SystemConfig::RUN_MODE);

            // Create XML
            $nativeXml = new DOMDocument("1.0", "UTF-8");
            $root = $nativeXml->createElement('Cfds');
            $root = $nativeXml->appendChild($root);
            while (($data = fgetcsv($fHandle, 0, '|')) !== FALSE) {
                $data = self::normalizeDataRow($data);
                // Skip if colcount is not right
                if (count($data) != self::COL_COUNT)
                    continue;
                if (!$data[self::INVOICE_NBR_COL])
                    throw new CException(yii::t('yanus', 'Invoice number cannot be null'));
                if ($this->invoiceNbr != $data[self::INVOICE_NBR_COL]) {
                    // Process invoice header
                    $invoice = false;
                    $this->invoiceNbr = $data[self::INVOICE_NBR_COL];

                    // Find if invoice already exists.
                    if (Cfd::model()
                                    ->filterBymd5(Cfd::model()->createMd5($data[self::VENDOR_RFC_COL], $this->invoiceNbr, $data[self::CUSTOMER_RFC_COL]))
                                    ->find()) {
                        $log->log(yii::t('yanus', 'Invoice {id} already exists.', array('{id}' => $this->invoiceNbr)), CLogger::LEVEL_INFO, __METHOD__);
                        continue;
                    } else
                        echo yii::t('yanus', 'Processing invoice {id}.', array('{id}' => $this->invoiceNbr)) . PHP_EOL;


                    // VALIDATIONS FOR THE INVOICE HEADER
                    // Get invoice date time.
                    $dt = $this->testInvoiceDt($data);

                    // Get invoice currency
                    $currency = $this->testCurrency($data);

                    // Get vendor RFC
                    $vendorRfc = $this->testRfc($data, 'vendor');

                    // Test certificate
                    $certificate = $this->testCertificate(($this->runMode == SystemConfig::RUN_MODE_PRODUCTION ? $data[self::VENDOR_RFC_COL] : SystemConfig::getValue(SystemConfig::DEMO_RFC)), $dt);

                    // Test document type
                    $docType = $this->testDocType($data);

                    // Test customer code
                    $customerCode = $this->testCustomerCode($data);

                    // Test promised date
                    $promisedDt = $this->testPromisedDt($data);

                    // Test transaction order Date
                    $transactionOrderDt = $this->testTransactionOrderDt($data);

                    // Test customer RFC
                    $customerRfc = $this->testRfc($data, 'customer');

                    // Test payment term
                    $paymentTerm = $this->testPaymentTerm($data);

                    // Test exchange rate
                    $exchangeRate = $this->testExchangeRate($data);

                    // Test addresses
                    $addresses = $this->testAddresses($data);

                    // Test parties
                    $parties = $this->testParties($data);

                    $invoice = $root->appendChild($nativeXml->createElement('Cfd'));
                    $invoice->setAttribute('serial', substr($data[self::INVOICE_NBR_COL], 0, 1));
                    $invoice->setAttribute('folio', substr($data[self::INVOICE_NBR_COL], 1));
                    $invoice->setAttribute('voucherType', strtolower($data[self::DOCUMENT_TYPE_COL]));
                    $invoice->setAttribute('dttm', $dt->format(DateTime::ISO8601));
                    $invoice->setAttribute('paymentType', 'PAGO EN UNA SOLA EXHIBICION');
                    if (isset($this->paymentMethods[$data[self::BP_CUSTOMER_CODE_COL]])) {
                        $invoice->setAttribute('paymentMethod', $this->paymentMethods[$data[self::BP_CUSTOMER_CODE_COL]][0]);
                        if (isset($this->paymentMethods[$data[self::BP_CUSTOMER_CODE_COL]][1]))
                            $invoice->setAttribute('paymentAcctNbr', $this->paymentMethods[$data[self::BP_CUSTOMER_CODE_COL]][1]);
                    } else
                        $invoice->setAttribute('paymentMethod', 'NO IDENTIFICADO');

                    $invoice->setAttribute('orderNbr', $data[self::BP_ORDER_NBR_COL]);
                    $invoice->setAttribute('customerOrderNbr', $data[self::CUSTOMER_ORDER_NBR_COL]);
//                    $invoice->setAttribute('emailAddress', $data[self::EMAIL_ADDRESS_COL]);
                    $invoice->setAttribute('agent', $data[self::AGENT_COL]);
                    $invoice->setAttribute('transport', $data[self::TRANSPORT_COL]);
                    if ($data[self::PROMISED_DATE_COL])
                        $invoice->setAttribute('promisedDt', $promisedDt->format("Y-m-d"));
                    if ($data[self::TRANSACTION_ORDER_DATE_COL])
                        $invoice->setAttribute('transactionOrderDt', $transactionOrderDt->format("Y-m-d"));
                    if ($data[self::CUSTOMER_RFC_COL] == self::VW_RFC) {
                        $invoice->setAttribute('petitionerName', 'Blanca Patricia Upton Merino');
                        $invoice->setAttribute('petitionerMail', 'patricia.upton@vw.com.mx');
                    }

                    $paymentTermNode = $invoice->appendChild($nativeXml->createElement('PaymentTerm'));
                    $paymentTermNode->setAttribute('name', $data[self::PAYMENT_TERM_COL]);
                    $dueDt = $dt;
                    if ($paymentTerm->days != 0)
                        $dueDt->add(new DateInterval('P' . $paymentTerm->days . 'D'));

                    $invoice->setAttribute('dueDt', $dueDt->format('Y-m-d'));

                    $currency = $invoice->appendChild($nativeXml->createElement('Currency'));
                    $currency->setAttribute('code', $data[self::CURRENCY_COL]);
                    if ($data[self::CURRENCY_COL] != 'MXP')
                        $invoice->setAttribute('exchangeRate', (float) $data[self::CURRENCY_RATE_COL]);

                    // Parties
                    // Vendor
                    $cfdParty = $invoice->appendChild($nativeXml->createElement('CfdParty'));
                    $cfdParty->setAttribute('type', CfdPartyTypeBehavior::VENDOR);
                    if ($data[self::CUSTOMER_RFC_COL] == self::VW_RFC)
                        $cfdParty->setAttribute('identifier', '6001007232');

                    $party = $cfdParty->appendChild($nativeXml->createElement('Party'));
                    $party->setAttribute('person', (strlen($data[self::VENDOR_RFC_COL]) == 13) ? 1 : 0);

                    $partyIdentifier = $party->appendChild($nativeXml->createElement('PartyIdentifier'));
                    $partyIdentifier->setAttribute('type', IdentifierTypeBehavior::RFC);
                    $partyIdentifier->setAttribute('value', $data[self::VENDOR_RFC_COL]);

                    $partyName = $party->appendChild($nativeXml->createElement('PartyName'));
                    $partyName->setAttribute('type', 'primary');
                    $name = $partyName->appendChild($nativeXml->createElement('Name'));
                    $name->setAttribute('name', $data[self::VENDOR_NAME_COL]);

                    // Customer
                    $cfdParty = $invoice->appendChild($nativeXml->createElement('CfdParty'));
                    $cfdParty->setAttribute('type', CfdPartyTypeBehavior::CUSTOMER);
                    $cfdParty->setAttribute('identifier', $data[self::BP_CUSTOMER_CODE_COL]);

                    $party = $cfdParty->appendChild($nativeXml->createElement('Party'));
                    $party->setAttribute('person', (strlen($data[self::CUSTOMER_RFC_COL]) == 13) ? 1 : 0);

                    $partyIdentifier = $party->appendChild($nativeXml->createElement('PartyIdentifier'));
                    $partyIdentifier->setAttribute('type', IdentifierTypeBehavior::RFC);
                    $partyIdentifier->setAttribute('value', $data[self::CUSTOMER_RFC_COL]);

//                    $partyIdentifier = $party->appendChild($nativeXml->createElement('PartyIdentifier'));
//                    $partyIdentifier->setAttribute('type', IdentifierTypeBehavior::CUSTOMERID);
//                    $partyIdentifier->setAttribute('value', $data[self::BP_CUSTOMER_CODE_COL]);
                    // CUSTOMER ID
//                    $partyIdentifier = $party->appendChild($nativeXml->createElement('PartyIdentifier'));
//                    $partyIdentifier->setAttribute('type', PartyIdentifierTypeBehavior::PRIMARY);
//                    $identifier = $partyIdentifier->appendChild($nativeXml->createElement('Identifier'));
//                    $identifier->setAttribute('type', IdentifierTypeBehavior::CUSTOMERID);
//                    $identifier->setAttribute('value', $data[self::BP_CUSTOMER_CODE_COL]);
//                        $partyNames = $party->appendChild($nativeXml->createElement('PartyNames'));
                    $partyName = $party->appendChild($nativeXml->createElement('PartyName'));
                    $partyName->setAttribute('type', 'primary');
                    $name = $partyName->appendChild($nativeXml->createElement('Name'));
                    $name->setAttribute('name', $data[self::CUSTOMER_NAME_COL]);

                    // Vendor Primary Address
                    $cfdAddress = $invoice->appendChild($nativeXml->createElement('CfdAddress'));
                    $cfdAddress->setAttribute('type', AddressTypeBehavior::PRIMARY);
//                    $cfdAddress->setAttribute('reference', $data[self::VENDOR_ADDRESS_REFERENCE_COL]);
                    $address = $cfdAddress->appendChild($nativeXml->createElement('Address'));
                    $address->setAttribute('street', $data[self::VENDOR_ADDRESS_STREET_COL]);
                    $address->setAttribute('extNbr', $data[self::VENDOR_ADDRESS_EXTNUM_COL]);
                    $address->setAttribute('intNbr', $data[self::VENDOR_ADDRESS_INTNUM_COL]);
                    $address->setAttribute('neighbourhood', $data[self::VENDOR_ADDRESS_NEIGHBOURHOOD_COL]);
                    $address->setAttribute('municipality', $data[self::VENDOR_ADDRESS_MUNICIPALITY_COL]);
                    $address->setAttribute('country', $data[self::VENDOR_ADDRESS_COUNTRY_COL]);
                    $address->setAttribute('state', $data[self::VENDOR_ADDRESS_STATE_COL]);
                    $address->setAttribute('zipCode', substr('00000' . $data[self::VENDOR_ADDRESS_ZIPCODE_COL], -5));
                    $invoice->setAttribute('expeditionPlace', $data[self::VENDOR_ADDRESS_STATE_COL] . ', ' . $data[self::VENDOR_ADDRESS_COUNTRY_COL]);
                    // Vendor billed from address
                    if ($data[self::INVOICE_FROM_ADDRESS_STREET_COL]) {
                        $cfdAddress = $invoice->appendChild($nativeXml->createElement('CfdAddress'));
                        $cfdAddress->setAttribute('type', AddressTypeBehavior::BILLED_FROM);
                        $cfdAddress->setAttribute('name', $data[self::INVOICE_FROM_NAME_COL]);

                        $address = $cfdAddress->appendChild($nativeXml->createElement('Address'));
                        $address->setAttribute('street', $data[self::INVOICE_FROM_ADDRESS_STREET_COL]);
                        $address->setAttribute('extNbr', $data[self::INVOICE_FROM_ADDRESS_EXTNUM_COL]);
                        $address->setAttribute('neighbourhood', $data[self::INVOICE_FROM_ADDRESS_INTNUM_COL]);
                        $address->setAttribute('municipality', $data[self::INVOICE_FROM_ADDRESS_NEIGHBOURHOOD_COL]);
                        $address->setAttribute('city', $data[self::INVOICE_FROM_ADDRESS_CITY_COL]);
                        $address->setAttribute('country', $data[self::INVOICE_FROM_ADDRESS_COUNTRY_COL]);
                        $address->setAttribute('state', $data[self::INVOICE_FROM_ADDRESS_STATE_COL]);
                        $address->setAttribute('zipCode', substr('00000' . $data[self::INVOICE_FROM_ADDRESS_ZIPCODE_COL], -5));
                        $invoice->setAttribute('expeditionPlace', $data[self::INVOICE_FROM_ADDRESS_CITY_COL] . ', ' . $data[self::INVOICE_FROM_ADDRESS_STATE_COL] . ', ' . $data[self::INVOICE_FROM_ADDRESS_COUNTRY_COL]);
                    }
                    // Customer bill to address
                    $cfdAddress = $invoice->appendChild($nativeXml->createElement('CfdAddress'));
                    $cfdAddress->setAttribute('type', AddressTypeBehavior::BILL_TO);
                    $address = $cfdAddress->appendChild($nativeXml->createElement('Address'));
                    if ($data[self::CUSTOMER_RFC_COL] == self::VW_RFC) {
                        $address->setAttribute('street', $data[self::CUSTOMER_SOLD_TO_ADDRESS_STREET_COL]);
                        $address->setAttribute('city', $data[self::CUSTOMER_SOLD_TO_ADDRESS_EXTNUM_COL]);
                        $address->setAttribute('country', $data[self::CUSTOMER_SOLD_TO_ADDRESS_COUNTRY_COL]);
                        $address->setAttribute('municipality', $data[self::CUSTOMER_SOLD_TO_ADDRESS_INTNUM_COL]);
                        if ($data[self::CUSTOMER_SOLD_TO_ADDRESS_STATE_COL])
                            $address->setAttribute('state', $data[self::CUSTOMER_SOLD_TO_ADDRESS_STATE_COL]);
                        switch ($data[self::CUSTOMER_SOLD_TO_ADDRESS_COUNTRY_COL]) {
                            case 'MX':
                            case 'MEX':
                                $address->setAttribute('zipCode', substr('00000' . $data[self::CUSTOMER_SOLD_TO_ADDRESS_ZIPCODE_COL], -5));
                                break;
                            default:
                                $address->setAttribute('zipCode', $data[self::CUSTOMER_SOLD_TO_ADDRESS_ZIPCODE_COL]);
                        }
                    } else {
                        $address->setAttribute('street', $data[self::CUSTOMER_SOLD_TO_ADDRESS_STREET_COL]);
                        $address->setAttribute('extNbr', $data[self::CUSTOMER_SOLD_TO_ADDRESS_EXTNUM_COL]);
                        if ($data[self::CUSTOMER_SOLD_TO_ADDRESS_INTNUM_COL] != $data[self::CUSTOMER_SOLD_TO_ADDRESS_NEIGHBOURHOOD_COL]) {
                            if ($data[self::CUSTOMER_SOLD_TO_ADDRESS_INTNUM_COL])
                                $address->setAttribute('intNbr', $data[self::CUSTOMER_SOLD_TO_ADDRESS_INTNUM_COL]);
                        }

                        if ($data[self::CUSTOMER_SOLD_TO_ADDRESS_NEIGHBOURHOOD_COL])
                            $address->setAttribute('neighbourhood', $data[self::CUSTOMER_SOLD_TO_ADDRESS_NEIGHBOURHOOD_COL]);
                        $address->setAttribute('city', $data[self::CUSTOMER_SOLD_TO_ADDRESS_CITY_COL]);
                        $address->setAttribute('country', $data[self::CUSTOMER_SOLD_TO_ADDRESS_COUNTRY_COL]);
//                    $address->setAttribute('municipality', $data[self::CUSTOMER_ADDRESS_MUNICIPALITY_COL]);
                        if ($data[self::CUSTOMER_SOLD_TO_ADDRESS_STATE_COL])
                            $address->setAttribute('state', $data[self::CUSTOMER_SOLD_TO_ADDRESS_STATE_COL]);
                        if ($data[self::CUSTOMER_SOLD_TO_ADDRESS_COUNTRY_COL] == 'MX')
                            $address->setAttribute('zipCode', substr('00000' . $data[self::CUSTOMER_SOLD_TO_ADDRESS_ZIPCODE_COL], -5));
                        else
                            $address->setAttribute('zipCode', $data[self::CUSTOMER_SOLD_TO_ADDRESS_ZIPCODE_COL]);
                    }
                    // Customer ship to
                    if ($data[self::CUSTOMER_SHIP_TO_NAME_COL]) {
                        $cfdAddress = $invoice->appendChild($nativeXml->createElement('CfdAddress'));
                        $cfdAddress->setAttribute('type', AddressTypeBehavior::SHIP_TO);
                        $cfdAddress->setAttribute('name', $data[self::CUSTOMER_SHIP_TO_NAME_COL]);
                        $address = $cfdAddress->appendChild($nativeXml->createElement('Address'));
                        $address->setAttribute('street', $data[self::CUSTOMER_SHIP_TO_ADDRESS_STREET_COL]);
                        $address->setAttribute('extNbr', $data[self::CUSTOMER_SHIP_TO_ADDRESS_EXTNUM_COL]);
                        if ($data[self::CUSTOMER_SHIP_TO_ADDRESS_INTNUM_COL] != $data[self::CUSTOMER_SHIP_TO_ADDRESS_NEIGHBOURHOOD_COL]) {
                            if ($data[self::CUSTOMER_SHIP_TO_ADDRESS_INTNUM_COL])
                                $address->setAttribute('intNbr', $data[self::CUSTOMER_SHIP_TO_ADDRESS_INTNUM_COL]);
                        }

                        if ($data[self::CUSTOMER_SHIP_TO_ADDRESS_NEIGHBOURHOOD_COL])
                            $address->setAttribute('neighbourhood', $data[self::CUSTOMER_SHIP_TO_ADDRESS_NEIGHBOURHOOD_COL]);
                        $address->setAttribute('city', $data[self::CUSTOMER_SHIP_TO_ADDRESS_CITY_COL]);
                        $address->setAttribute('country', $data[self::CUSTOMER_SHIP_TO_ADDRESS_COUNTRY_COL]);
//                    $address->setAttribute('municipality', $data[self::CUSTOMER_ADDRESS_MUNICIPALITY_COL]);
                        if ($data[self::CUSTOMER_SHIP_TO_ADDRESS_STATE_COL])
                            $address->setAttribute('state', $data[self::CUSTOMER_SHIP_TO_ADDRESS_STATE_COL]);
                        if ($data[self::CUSTOMER_SHIP_TO_ADDRESS_COUNTRY_COL] == 'MX')
                            $address->setAttribute('zipCode', substr('00000' . $data[self::CUSTOMER_SHIP_TO_ADDRESS_ZIPCODE_COL], -5));
                        else
                            $address->setAttribute('zipCode', $data[self::CUSTOMER_SHIP_TO_ADDRESS_ZIPCODE_COL]);
                    }


//                        $cfdTaxRegimes = $invoice->appendChild($nativeXml->createElement('CfdTaxRegimes'));
                    $cfdTaxRegime = $invoice->appendChild($nativeXml->createElement('CfdTaxRegime'));
                    $cfdTaxRegime->setAttribute('name', 'Régimen General de Ley Personas Morales');

                    $subTotal = 0;
                    $total = 0;
                    $cfdTax = 0;
                    $cfdDiscount = 0;
                }
                if ($invoice) {
                    if ($data[self::DOCUMENT_TYPE_COL]) {
                        $lineDiscount = 0;
                        switch ($data[self::BP_CUSTOMER_CODE_COL]) {
                            case 124443:
//                            if ($data[self::CURRENCY_COL] == "MXP") {
//                                $unitPrice = (float)$data[self::ITEM_UNIT_PRICE];
//                            } else {
//                                $unitPrice = (float)$data[self::FOREIGN_UNIT_PRICE_COL];
//                            }
                                // TOTAL_AFTER_DISCOUNT is always MXP
                                $itemAmt = (float) trim($data[self::TOTAL_AFTER_DISCOUNT]);
                                // Get unit price
                                $unitPrice = $itemAmt / (float) trim($data[self::ITEM_QTY]);
                                // If invoice currency is not MXP, get price in currency.
                                if ($data[self::CURRENCY_COL] != 'MXP') {
                                    // Convert unit price to currency
                                    $unitPrice /= (float) $data[self::CURRENCY_RATE_COL];
                                    $unitPrice = round($unitPrice, 6);
                                }
                                $itemAmt *= $unitPrice;
                                $itemAmt = round($itemAmt, 2);
                                break;
                            default:
                                $unitPrice = ($data[self::CURRENCY_COL] == "MXP" ? (float) $data[self::ITEM_UNIT_PRICE] : (float) $data[self::FOREIGN_UNIT_PRICE_COL]);
                                $itemAmt = (float) $data[self::ITEM_QTY] * $unitPrice;

                                // discounts
                                $lineDiscount = 0;
                                if ($data[self::DISCOUNT_REASON]) {
                                    $discount = $invoice->appendChild($nativeXml->createElement('CfdDiscount'));
                                    $discount->setAttribute('reason', $data[self::DISCOUNT_REASON]);
                                    $amt = ($data[self::CURRENCY_COL] == "MXP" ? (float) $data[self::DISCOUNT_AMOUNT] : (float) $data[self::FOREIGN_DISCOUNT]);
                                    $lineDiscount += $amt;
                                    $discount->setAttribute('amt', $amt);
                                }
                                if ($data[self::DISCOUNT_REASON_2]) {
                                    $discount = $invoice->appendChild($nativeXml->createElement('CfdDiscount'));
                                    $discount->setAttribute('reason', $data[self::DISCOUNT_REASON_2]);
                                    $amt = ($data[self::CURRENCY_COL] == "MXP" ? (float) $data[self::DISCOUNT_AMOUNT_2] : (float) $data[self::FOREIGN_DISCOUNT_2]);
                                    $lineDiscount += $amt;
                                    $discount->setAttribute('amt', $amt);
                                }
                                if ($data[self::DISCOUNT_REASON_3]) {
                                    $discount = $invoice->appendChild($nativeXml->createElement('CfdDiscount'));
                                    $discount->setAttribute('reason', $data[self::DISCOUNT_REASON_3]);
                                    $amt = ($data[self::CURRENCY_COL] == "MXP" ? (float) $data[self::DISCOUNT_AMOUNT_3] : (float) $data[self::FOREIGN_DISCOUNT_3]);
                                    $lineDiscount += $amt;
                                    $discount->setAttribute('amt', $amt);
                                }
                                if ($data[self::DISCOUNT_REASON_4]) {
                                    $discount = $invoice->appendChild($nativeXml->createElement('CfdDiscount'));
                                    $discount->setAttribute('reason', $data[self::DISCOUNT_REASON_4]);
                                    $amt = ($data[self::CURRENCY_COL] == "MXP" ? (float) $data[self::DISCOUNT_AMOUNT_4] : (float) $data[self::FOREIGN_DISCOUNT_4]);
                                    $lineDiscount += $amt;
                                    $discount->setAttribute('amt', $amt);
                                }
                        }
                        // Process items
                        $item = $invoice->appendChild($nativeXml->createElement('CfdItem'));
                        $item->setAttribute('qty', $data[self::ITEM_QTY]);

                        $uomCd = 'PZA';
                        switch ($data[self::PRODUCT_UOM_COL]) {
                            case 'L':
                            case 'LT':
                                $uomCd = 'L';
                                break;
                            case 'EA':
                                if ($data[self::CUSTOMER_RFC_COL] == 'VME640813HF6')
                                    $uomCd = 'PZA';
                                else
                                    $uomCd = 'No aplica';
                                break;
                        }

                        $item->setAttribute('uom', $uomCd);
                        $item->setAttribute('productCode', $data[self::PRODUCT_CODE_COL]);
                        $item->setAttribute('description', $data[self::PRODUCT_DESCRIPTION_COL_1] . $data[self::PRODUCT_DESCRIPTION_COL_2]);
                        $item->setAttribute('unitPrice', $unitPrice);
                        $item->setAttribute('amt', $itemAmt);
                        $item->setAttribute('lts', (float) $data[self::QUANTITY_IN_LT_COL]);

                        $taxAmt = ($itemAmt - $lineDiscount) * (float) $data[self::TAX_RATE];
                        // Tax
                        $tax = $invoice->appendChild($nativeXml->createElement('CfdTax'));
                        $tax->setAttribute('name', $data[self::TAX_TYPE]);
                        $tax->setAttribute('rate', $data[self::TAX_RATE] * 100);
                        $tax->setAttribute('amt', $taxAmt);

                        if ($data[self::CUSTOMS_DOCUMENT_NUMBER_COL]) {
                            $dt = DateTime::createFromFormat("Y/m/d", $data[self::CUSTOMS_DOCUMENT_DATE_COL]);
                            if ($dt) {
                                $itemHasCustomsPermit = $item->appendChild($nativeXml->createElement('CfdItemHasCustomsPermit'));
                                $customsPermit = $itemHasCustomsPermit->appendChild($nativeXml->createElement('CustomsPermit'));
                                $customsPermit->setAttribute('nbr', $data[self::CUSTOMS_DOCUMENT_NUMBER_COL]);
                                $customsPermit->setAttribute('dt', $dt->format("Y-m-d"));
                                $customsPermit->setAttribute('office', $data[self::CUSTOMS_NAME_COL]);
                            }
                        }

                        $subTotal += $itemAmt;
                        $cfdTax += $taxAmt;
                        $cfdDiscount += $lineDiscount;

                        $total = $subTotal - $cfdDiscount + $cfdTax;

                        $invoice->setAttribute('subTotal', $subTotal);
                        $invoice->setAttribute('total', $total);
                        $invoice->setAttribute('tax', $cfdTax);
                        $invoice->setAttribute('discount', $cfdDiscount);
                    } else {
                        // It's a note line
                        if ($data[self::PRODUCT_DESCRIPTION_COL_1]) {
                            $cfdHasAnnotation = $invoice->appendChild($nativeXml->createElement('CfdHasAnnotation'));
                            $note = $cfdHasAnnotation->appendChild($nativeXml->createElement('Annotation'));
                            $note->setAttribute('note', $data[self::PRODUCT_DESCRIPTION_COL_1]);
                        }
                        if ($data[self::PRODUCT_DESCRIPTION_COL_2]) {
                            $cfdHasAnnotation = $invoice->appendChild($nativeXml->createElement('CfdHasAnnotation'));
                            $note = $cfdHasAnnotation->appendChild($nativeXml->createElement('Annotation'));
                            $note->setAttribute('note', $data[self::PRODUCT_DESCRIPTION_COL_2]);
                        }
                    }
                }
                $this->row++;
            }
            fclose($fHandle);
            $nativeXml->save($args[1]);
            $incomingInvoiceInterfaceFile->validationDttm = date(DateTime::ISO8601);
            $incomingInvoiceInterfaceFile->processDttm = date(DateTime::ISO8601);
            $incomingInvoiceInterfaceFile->swNextStatus(IncomingInvoiceInterfaceFile::PROCESSED);
            $incomingInvoiceInterfaceFile->save();
            CVarDumper::dump($log->logs);
        } catch (Exception $e) {
            $incomingInvoiceInterfaceFile->note = '[' . __METHOD__ . '] ' . $e->getMessage();
            $incomingInvoiceInterfaceFile->swNextStatus(IncomingInvoiceInterfaceFile::ERROR);
            $incomingInvoiceInterfaceFile->save();
            yii::trace($e->getMessage(), __METHOD__);
            $log->log($e->getMessage(), CLogger::LEVEL_ERROR, __METHOD__);
            CVarDumper::dump($log->getLogs(CLogger::LEVEL_ERROR, __METHOD__));
        }
    }

    private static function normalizeDataRow($data) {
        // Normalize UTF8
        foreach ($data as $key => $value) {
            $data[$key] = trim(mb_convert_encoding($value, 'utf8'));
        }
        return $data;
    }

    /**
     *
     */
    private function loadEmailFile() {
        // Load email file
        $pmFile = yii::app()->file->set(yii::getPathOfAlias('files') . DIRECTORY_SEPARATOR . 'castrol' . DIRECTORY_SEPARATOR . 'customerEmails.csv');
        if ($pmFile->exists) {
            $fHandle = @fopen($pmFile->realPath, 'r');
            if ($fHandle) {
                while (($data = fgetcsv($fHandle, 0, ',')) !== FALSE) {
                    $this->customerEmails[$data[0]] = str_replace(' ', '', strtolower($data[2]));
                }
            }
        }
    }

    /**
     *
     */
    private function loadPaymentMethodFile() {
        // Load payment method files
        $pmFile = yii::app()->file->set(yii::getPathOfAlias('files') . DIRECTORY_SEPARATOR . 'castrol' . DIRECTORY_SEPARATOR . 'metodoDePago.csv');
        if ($pmFile->exists) {
            $fHandle = @fopen($pmFile->realPath, 'r');
            if ($fHandle) {
                while (($data = fgetcsv($fHandle, 0, ',')) !== FALSE) {
                    $this->paymentMethods[$data[0]] = array($data[1], $data[2]);
                }
            }
        }
    }

    /**
     * Test if address is valid
     * If address doesn't exists, creates a new one.
     *
     * @param type $data
     * @throws CException
     */
    private function testAddresses($data) {
        $retVal = array();
        // Test vendor address
        // Test street
        if (!$data[self::VENDOR_ADDRESS_STREET_COL])
            throw new CException(yii::t('yanus', 'Vendor address street cannot be null'));
        // Test municipality
        if (!$data[self::VENDOR_ADDRESS_MUNICIPALITY_COL])
            throw new CException(yii::t('yanus', 'Vendor address municipality cannot be null'));
        // Test country
        if (!$data[self::VENDOR_ADDRESS_COUNTRY_COL])
            throw new CException(yii::t('yanus', 'Vendor address country cannot be null'));
        $country = $this->testCountry($data[self::VENDOR_ADDRESS_COUNTRY_COL]);
        if (!$country->name)
            throw new CException(yii::t('yanus', 'Vendor address country "{code}" has no name defined.', array('{code}' => $data[self::VENDOR_ADDRESS_COUNTRY_COL])));
        // Test state
        if (!$data[self::VENDOR_ADDRESS_STATE_COL])
            throw new CException(yii::t('yanus', 'Vendor address state cannot be null'));
        $state = $this->testState($country, $data[self::VENDOR_ADDRESS_STATE_COL]);
        if (!$state->name)
            throw new CException(yii::t('yanus', 'Vendor address state "{code}" has no name defined.', array('{code}' => $data[self::VENDOR_ADDRESS_STATE_COL])));
        // Test zipcode
        if (!$data[self::VENDOR_ADDRESS_ZIPCODE_COL])
            throw new CException(yii::t('yanus', 'Vendor address zip code cannot be null'));
        $vendorAddr = Address::model()->importXml(new SimpleXMLElement('<Address ' .
                        'street="' . $data[self::VENDOR_ADDRESS_STREET_COL] . '" ' .
                        ($data[self::VENDOR_ADDRESS_EXTNUM_COL] ? 'extNbr="' . $data[self::VENDOR_ADDRESS_EXTNUM_COL] . '" ' : '') .
                        'intNbr="' . $data[self::VENDOR_ADDRESS_INTNUM_COL] . '" ' .
                        'neighbourhood="' . $data[self::VENDOR_ADDRESS_NEIGHBOURHOOD_COL] . '" ' .
                        'municipality="' . $data[self::VENDOR_ADDRESS_MUNICIPALITY_COL] . '" ' .
                        'State_id="' . $state->id . '" ' .
                        'zipCode="' . substr('00000' . $data[self::VENDOR_ADDRESS_ZIPCODE_COL], -5) . '" ' .
                        '></Address>'
                ), FALSE);
        $vendorAddress = Address::model()->filterBymd5($vendorAddr->getMd5())->find();
        if (!$vendorAddress) {
            $vendorAddr->save();
            $vendorAddress = $vendorAddr;
        }
        $retVal[AddressTypeBehavior::PRIMARY] = $vendorAddress;

        // Test vendor invoiced from address
        if ($data[self::INVOICE_FROM_ADDRESS_STREET_COL]) {
            // Test country
            if (!$data[self::INVOICE_FROM_ADDRESS_COUNTRY_COL])
                throw new CException(yii::t('yanus', 'Invoiced from address country cannot be null'));
            $country = $this->testCountry($data[self::INVOICE_FROM_ADDRESS_COUNTRY_COL]);
            if (!$country->name)
                throw new CException(yii::t('yanus', 'Invoiced from address country "{code}" has no name defined.', array('{code}' => $data[self::INVOICE_FROM_ADDRESS_COUNTRY_COL])));
            // Test state
            if (!$data[self::INVOICE_FROM_ADDRESS_STATE_COL])
                throw new CException(yii::t('yanus', 'Invoiced from address state cannot be null'));
            $state = $this->testState($country, $data[self::INVOICE_FROM_ADDRESS_STATE_COL]);
            if (!$state->name)
                throw new CException(yii::t('yanus', 'Invoiced from address state "{code}" has no name defined.', array('{code}' => $data[self::INVOICE_FROM_ADDRESS_STATE_COL])));
            // Test zipcode
            if (!$data[self::INVOICE_FROM_ADDRESS_ZIPCODE_COL])
                throw new CException(yii::t('yanus', 'Invoiced from address zip code cannot be null'));

            $invoicedFromAddr = Address::model()->importXml(new SimpleXMLElement('<Address ' .
                            'street="' . $data[self::INVOICE_FROM_ADDRESS_STREET_COL] . '" ' .
                            'extNbr="' . $data[self::INVOICE_FROM_ADDRESS_EXTNUM_COL] . '" ' .
                            'city="' . $data[self::INVOICE_FROM_ADDRESS_CITY_COL] . '" ' .
                            'neighbourhood="' . $data[self::INVOICE_FROM_ADDRESS_INTNUM_COL] . '" ' .
                            'municipality="' . $data[self::INVOICE_FROM_ADDRESS_CITY_COL] . '" ' .
                            'State_id="' . $state->id . '" ' .
                            'zipCode="' . substr('00000' . $data[self::INVOICE_FROM_ADDRESS_ZIPCODE_COL], -5) . '" ' .
                            '></Address>'
                    ), FALSE);
            $invoicedFromAddress = Address::model()->filterBymd5($invoicedFromAddr->getMd5())->find();
            if (!$invoicedFromAddress) {
                $invoicedFromAddr->save();
                $invoicedFromAddress = $invoicedFromAddr;
            }
            $retVal[AddressTypeBehavior::BILLED_FROM] = $vendorAddress;
        }

        // Test customer address
        // Test country
        if (!$data[self::CUSTOMER_SOLD_TO_ADDRESS_COUNTRY_COL])
            throw new CException(yii::t('yanus', 'Customer address country cannot be null'));
        $country = $this->testCountry($data[self::CUSTOMER_SOLD_TO_ADDRESS_COUNTRY_COL]);
        if (!$country->name)
            throw new CException(yii::t('yanus', 'Customer address country "{code}" has no name defined.', array('{code}' => $data[self::CUSTOMER_SOLD_TO_ADDRESS_COUNTRY_COL])));
        // Test state
        if (!$data[self::CUSTOMER_SOLD_TO_ADDRESS_STATE_COL])
            $data[self::CUSTOMER_SOLD_TO_ADDRESS_STATE_COL] = 'N/A';
//            throw new CException(yii::t('yanus', 'Customer address state cannot be null'));
        $state = $this->testState($country, $data[self::CUSTOMER_SOLD_TO_ADDRESS_STATE_COL]);
        if (!$state->name)
            throw new CException(yii::t('yanus', 'Customer address state "{code}" has no name defined.', array('{code}' => $data[self::CUSTOMER_SOLD_TO_ADDRESS_STATE_COL])));

        $customerAddr = Address::model()->importXml(new SimpleXMLElement('<Address ' .
                        'street="' . $data[self::CUSTOMER_SOLD_TO_ADDRESS_STREET_COL] . '" ' .
                        'extNbr="' . $data[self::CUSTOMER_SOLD_TO_ADDRESS_EXTNUM_COL] . '" ' .
                        ($data[self::CUSTOMER_RFC_COL] == self::VW_RFC ? '' : ($data[self::CUSTOMER_SOLD_TO_ADDRESS_INTNUM_COL] != $data[self::CUSTOMER_SOLD_TO_ADDRESS_NEIGHBOURHOOD_COL] ? 'intNbr="' . $data[self::CUSTOMER_SOLD_TO_ADDRESS_INTNUM_COL] . '" ' : '') ) .
                        ($data[self::CUSTOMER_SOLD_TO_ADDRESS_CITY_COL] ? 'city="' . $data[self::CUSTOMER_SOLD_TO_ADDRESS_CITY_COL] . '" ' : '') .
                        'municipality="' . ($data[self::CUSTOMER_RFC_COL] == self::VW_RFC ? $data[self::CUSTOMER_SOLD_TO_ADDRESS_INTNUM_COL] : $data[self::CUSTOMER_SOLD_TO_ADDRESS_NEIGHBOURHOOD_COL]) . '" ' .
                        'State_id="' . $state->id . '" ' .
                        'zipCode="' . ($data[self::CUSTOMER_SOLD_TO_ADDRESS_COUNTRY_COL] == 'MX' ? substr('00000' . $data[self::CUSTOMER_SOLD_TO_ADDRESS_ZIPCODE_COL], -5) : $data[self::CUSTOMER_SOLD_TO_ADDRESS_ZIPCODE_COL]) . '" ' .
                        '></Address>'
                ), FALSE);
        $customerAddress = Address::model()->filterBymd5($customerAddr->getMd5())->find();
        if (!$customerAddress) {
            $customerAddr->save();
            $customerAddress = $customerAddr;
        }
        $retVal[AddressTypeBehavior::BILL_TO] = $customerAddress;

        // Customer ship to
        if ($data[self::CUSTOMER_SHIP_TO_NAME_COL]) {
            // Test country
            if (!$data[self::CUSTOMER_SHIP_TO_ADDRESS_COUNTRY_COL])
                throw new CException(yii::t('yanus', 'Vendor address country cannot be null'));
            $country = $this->testCountry($data[self::CUSTOMER_SHIP_TO_ADDRESS_COUNTRY_COL]);
            if (!$country->name)
                throw new CException(yii::t('yanus', 'Vendor address country "{code}" has no name defined.', array('{code}' => $data[self::CUSTOMER_SHIP_TO_ADDRESS_COUNTRY_COL])));
            // Test state
            if (!$data[self::CUSTOMER_SHIP_TO_ADDRESS_STATE_COL])
                throw new CException(yii::t('yanus', 'Vendor address state cannot be null'));
            $state = $this->testState($country, $data[self::CUSTOMER_SHIP_TO_ADDRESS_STATE_COL]);
            if (!$state->name)
                throw new CException(yii::t('yanus', 'Vendor address state "{code}" has no name defined.', array('{code}' => $data[self::CUSTOMER_SHIP_TO_ADDRESS_STATE_COL])));

            $shipToAddr = Address::model()->importXml(new SimpleXMLElement('<Address ' .
                            'street="' . $data[self::CUSTOMER_SHIP_TO_ADDRESS_STREET_COL] . '" ' .
                            'extNbr="' . $data[self::CUSTOMER_SHIP_TO_ADDRESS_EXTNUM_COL] . '" ' .
                            ($data[self::CUSTOMER_RFC_COL] == self::VW_RFC ? '' : ($data[self::CUSTOMER_SHIP_TO_ADDRESS_INTNUM_COL] != $data[self::CUSTOMER_SHIP_TO_ADDRESS_NEIGHBOURHOOD_COL] ? 'intNbr="' . $data[self::CUSTOMER_SHIP_TO_ADDRESS_INTNUM_COL] . '" ' : '')) .
                            ($data[self::CUSTOMER_RFC_COL] == self::VW_RFC ? 'municipality="' . $data[self::CUSTOMER_SHIP_TO_ADDRESS_INTNUM_COL] . '" ' : '') .
                            ($data[self::CUSTOMER_SHIP_TO_ADDRESS_NEIGHBOURHOOD_COL] ? 'neighbourhood="' . $data[self::CUSTOMER_SHIP_TO_ADDRESS_NEIGHBOURHOOD_COL] . '" ' : '') .
                            ($data[self::CUSTOMER_SHIP_TO_ADDRESS_CITY_COL] ? 'city="' . $data[self::CUSTOMER_SHIP_TO_ADDRESS_CITY_COL] . '" ' : '') .
                            'State_id="' . $state->id . '" ' .
                            'zipCode="' . ($data[self::CUSTOMER_SHIP_TO_ADDRESS_ZIPCODE_COL] == 'MX' ? substr('00000' . $data[self::CUSTOMER_SHIP_TO_ADDRESS_ZIPCODE_COL], -5) : $data[self::CUSTOMER_SHIP_TO_ADDRESS_ZIPCODE_COL]) . '" ' .
                            '></Address>'
                    ), FALSE);
            $shipToAddress = Address::model()->filterBymd5($shipToAddr->getMd5())->find();
            if (!$shipToAddress) {
                $shipToAddr->save();
                $shipToAddress = $shipToAddr;
            }
            $retVal[AddressTypeBehavior::SHIP_TO] = $shipToAddress;
        }
        return $retVal;
    }

    /**
     * Test for valid certificate
     *
     * @param type $rfc
     * @param type $dt
     * @return type
     * @throws CException
     */
    private function testCertificate($rfc, $dt) {
        // Test certificate
        $certificate = SatCertificate::model()->validAsOf($dt)
                        ->filterByrfc($rfc)->find();
        if (!$certificate)
            throw new CException(yii::t('yanus', 'Cannot find a valid certificate for RFC "{rfc}"', array('{rfc}' => $rfc)));
        return $certificate;
    }

    /**
     * Test if country is valid.
     * Creates a new one if doesn't exists.
     *
     * @param type $code
     * @return type
     * @throws CException
     */
    private function testCountry($code) {
        $country = Country::model()->filterBycode($code)->find();
        if (!$country)
            $country = Country::model()->importXml(new SimpleXMLElement("<Country code='$code' active='1'></Country>"));
        return $country;
    }

    /**
     *
     * @param type $data
     * @return type
     * @throws Exception
     */
    private function testCurrency($data) {
        // Test currency
        $code = $data[self::CURRENCY_COL];
        $currencyRec = Currency::model()->filterBycode($code)->find();
        if (!$currencyRec)
            $currencyRec = Currency::model()->importXml(new SimpleXMLElement("<Currency code='$code' active='1'></Currency>"));
        if (!$currencyRec->name || !$currencyRec->plural)
            throw new Exception(yii::t('yanus', 'Currency "{code}" definition is incomplete. Please add the required information and reprocess file.', array('{code}' => $data[self::CURRENCY_COL])));
        return $currencyRec;
    }

    /**
     * Test document type
     *
     * @param type $data
     * @return type
     * @throws CException
     */
    private function testDocType($data) {
        if (!$data[self::DOCUMENT_TYPE_COL])
            throw new CException(yii::t('yanus', 'Document type cannot be null'));
        switch (strtolower($data[self::DOCUMENT_TYPE_COL])) {
            case 'ingreso':
            case 'egreso':
            case 'traslado':
                break;
            default:
                throw new CException(yii::t('yanus', 'Invalid document type "{type}"', array('{type}' => $data[self::DOCUMENT_TYPE_COL])));
        }
        return strtolower($data[self::DOCUMENT_TYPE_COL]);
    }

    /**
     * Test customer code
     *
     * @param type $data
     * @return type
     * @throws CException
     */
    private function testCustomerCode($data) {
        if (!$data[self::BP_CUSTOMER_CODE_COL])
            throw new CException(yii::t('yanus', 'Customer code cannot be null'));
        return $data[self::BP_CUSTOMER_CODE_COL];
    }

    /**
     * Test exchange rate
     *
     * @param type $data
     * @return type
     * @throws CException
     */
    private function testExchangeRate($data) {
        if ($data[self::CURRENCY_COL] != 'MXP') {
            if (!$data[self::CURRENCY_RATE_COL])
                throw new CException(yii::t('yanus', 'Exchange rate cannot be null'));
            return $data[self::CURRENCY_RATE_COL];
        }
    }

    /**
     * Test if invoice date is a valid datetime.
     *
     * @param type $data
     * @return \DateTime
     * @throws CException
     */
    private function testInvoiceDt(array $data) {
        // Test invoice time
        $invoiceTmStr = $data[self::TIME_OF_DAY_COL];
        if (!$invoiceTmStr)
            throw new CException(yii::t('app', '[{row},{col}][{invoice}] Invoice time cannot be null', array('{row}' => $this->row,
                        '{col}' => self::TIME_OF_DAY_COL, '{invoice}' => $this->invoiceNbr)));
        if (strlen($invoiceTmStr) == 5)
            $invoiceTmStr = '0' . $invoiceTmStr;

        $invoiceTm = DateTime::createFromFormat("His", $invoiceTmStr);
        if (!$invoiceTm)
            throw new CException(yii::t('app', '[{row},{col}][{invoice}] Invalid invoice time "{tm}".', array('{row}' => $this->row,
                        '{col}' => self::TIME_OF_DAY_COL, '{tm}' => $data[self::TIME_OF_DAY_COL], '{invoice}' => $this->invoiceNbr)));

        // Test invoice date
        if (!$data[self::INVOICE_DATE_COL])
            throw new CException(yii::t('app', '[{row},{col}][{invoice}] Invoice date cannot be null', array('{row}' => $this->row,
                        '{col}' => self::INVOICE_DATE_COL, '{invoice}' => $this->invoiceNbr)));

        try {
            $invoiceDt = new DateTime($data[self::INVOICE_DATE_COL]);
        } catch (Exception $e) {
            throw new CException(yii::t('app', '[{row},{col}][{invoice}] Invalid invoice date "{dt}".', array('{row}' => $this->row,
                        '{col}' => self::INVOICE_DATE_COL, '{dt}' => trim($data[self::INVOICE_DATE_COL]), '{invoice}' => $this->invoiceNbr)));
        }

        $dt = DateTime::createFromFormat("Y-m-d H:i:s", $invoiceDt->format("Y-m-d") . " " . $invoiceTm->format("H:i:s"), new DateTimeZone('America/New_York'));
//        CVarDumper::dump($dt);

        $dt->setTimeZone(new DateTimeZone('America/Mexico_City'));
//        CVarDumper::dump($dt);

        return $dt;
    }

    private function testParties($data) {
        $parties = array();

        // Test vendor
        // Find vendor by RFC
        $vendor = Party::model()->findByPartyIdentifierValue($data[self::VENDOR_RFC_COL], PartyIdentifierTypeBehavior::RFC);
        if (!$vendor) {
            $xml = '<Party ' .
                    'person="' . (strlen($data[self::VENDOR_RFC_COL]) == 13 ? 1 : 0) . '" ' .
                    '>' .
                    '<PartyIdentifier ' .
                    'value="' . $data[self::VENDOR_RFC_COL] . '" ' .
                    'type="' . PartyIdentifierTypeBehavior::RFC . '" ' .
                    '></PartyIdentifier>' .
                    '<PartyName ' .
                    'value="' . $data[self::VENDOR_NAME_COL] . '" ' .
                    'type="' . PartyNameTypeBehavior::PRIMARY . '" ' .
                    '></PartyName>' .
                    '<PartyRole ' .
                    'Role_id="' . Role::model()->Party()->filterByCode('SUPPLIER')->find()->id . '" ' .
                    'enabled="1" ' .
                    '></PartyRole>' .
                    '</Party>';
//            CVarDumper::dump($xml);
//            yii::app()->end();
            $vendor = Party::model()->importXml(new SimpleXMLElement($xml));
        }
        // Check name
        if ($vendor->primaryName != $data[self::VENDOR_NAME_COL])
            PartyName::model()->importXml(new SimpleXMLElement('<PartyName ' .
                            'value="' . $data[self::VENDOR_NAME_COL] . '" ' .
                            'type="' . PartyNameTypeBehavior::PRIMARY . '" ' .
                            'Party_id="' . $vendor->id . '" ' .
                            '></PartyName>'));

        // check if it has the SUPPLIER role.
        if (!$vendor->hasRole('SUPPLIER'))
            PartyRole::model()->importXml(new SimpleXMLElement('<PartyRole ' .
                            'Role_id="' . Role::model()->Party()->filterByCode('SUPPLIER')->find()->id . '" ' .
                            'enabled="1" ' .
                            'Party_id="' . $vendor->id . '" ' .
                            '></PartyRole>'));

//        CVarDumper::dump($vendor->id);
        // Test customer
        // Find customer by customer Id
        $customer = Party::model()->findByPartyIdentifierValue($data[self::BP_CUSTOMER_CODE_COL], PartyIdentifierTypeBehavior::CUSTOMER_ID);
        if (!$customer) {
            $xml = '<Party ' .
                    'person="' . (strlen($data[self::CUSTOMER_RFC_COL]) == 13 ? 1 : 0) . '" ' .
                    '>' .
                    '<PartyIdentifier ' .
                    'value="' . $data[self::CUSTOMER_RFC_COL] . '" ' .
                    'type="' . PartyIdentifierTypeBehavior::RFC . '" ' .
                    '></PartyIdentifier>' .
                    '<PartyIdentifier ' .
                    'value="' . $data[self::BP_CUSTOMER_CODE_COL] . '" ' .
                    'type="' . PartyIdentifierTypeBehavior::CUSTOMER_ID . '" ' .
                    '></PartyIdentifier>' .
                    '<PartyName ' .
                    'value="' . $data[self::CUSTOMER_NAME_COL] . '" ' .
                    'type="' . PartyNameTypeBehavior::PRIMARY . '" ' .
                    '></PartyName>' .
                    '<PartyRole ' .
                    'Role_id="' . Role::model()->Party()->filterByCode('CUSTOMER')->find()->id . '" ' .
                    'enabled="1" ' .
                    '></PartyRole>' .
                    '</Party>';
            $customer = Party::model()->importXml(new SimpleXMLElement($xml));
        }
        // Check if name has changed
        if ($customer->primaryName != $data[self::CUSTOMER_NAME_COL])
            PartyName::model()->importXml(new SimpleXMLElement('<PartyName ' .
                            'value="' . $data[self::CUSTOMER_NAME_COL] . '" ' .
                            'type="' . PartyNameTypeBehavior::PRIMARY . '" ' .
                            'Party_id="' . $customer->id . '" ' .
                            '></PartyName>'));
        // Check if RFC has changed
        if ($customer->rfc != $data[self::CUSTOMER_RFC_COL])
            PartyIdentifier::model()->importXml(new SimpleXMLElement('<PartyIdentifier ' .
                            'value="' . $data[self::CUSTOMER_RFC_COL] . '" ' .
                            'type="' . PartyIdentifierTypeBehavior::RFC . '" ' .
                            'Party_id="' . $customer->id . '" ' .
                            '></PartyIdentifier>'
            ));
        // check if it has the CUSTOMER role.
        if (!$customer->getRole('CUSTOMER'))
            PartyRole::model()->importXml(new SimpleXMLElement('<PartyRole ' .
                            'Role_id="' . Role::model()->Party()->filterByCode('CUSTOMER')->find()->id . '" ' .
                            'enabled="1" ' .
                            'Party_id="' . $customer->id . '" ' .
                            '></PartyRole>'));

        // add relatonships
        // SUPPLIER -> CUSTOMER
        if (!PartyRelationship::model()->filterByfromPartyRole_id($vendor->getRole('SUPPLIER')->id)->filterByToPartyRole_id($customer->getRole('CUSTOMER')->id)->enabled()->find())
            PartyRelationship::model()->importXml(new SimpleXMLElement('<PartyRelationship ' .
                            'fromPartyRole_id="' . $vendor->getRole('SUPPLIER')->id . '" ' .
                            'toPartyRole_id="' . $customer->getRole('CUSTOMER')->id . '" ' .
                            'enabled="1" ' .
                            ($data[self::CUSTOMER_RFC_COL] == self::VW_RFC ? 'identifier="6001007232" ' : '') .
                            '></PartyRelationship>'
            ));

        // test payment methods
        if (count($customer->paymentMethods) == 0) {
            if (isset($this->paymentMethods[$data[self::BP_CUSTOMER_CODE_COL]])) {
                PartyPaymentMethod::model()->importXml(new SimpleXMLElement('<PartyPaymentMethod ' .
                                'method="' . $this->paymentMethods[$data[self::BP_CUSTOMER_CODE_COL]][0] . '" ' .
                                'bankAcct="' . $this->paymentMethods[$data[self::BP_CUSTOMER_CODE_COL]][1] . '" ' .
                                'active="1" ' .
                                'Party_id="' . $customer->id . '" ' .
                                '></PartyPaymentMethod>'
                ));
            }
        }

        // Test email file.
        if (count($customer->partyMails) == 0) {
            if (isset($this->customerEmails[$data[self::BP_CUSTOMER_CODE_COL]])) {
                $invoiceDeliveryPartyMailType = PartyMailType::model()->filterBycode('invoiceDelivery')->find();
                $emails = explode(',', $this->customerEmails[$data[self::BP_CUSTOMER_CODE_COL]]);
                foreach ($emails as $email) {
                    if (!PartyMail::model()->filterByvalue($email)->filterBytype(PartyMailTypeBehavior::INVOICE_NOTIFICATION)->filterByParty_id($customer->id)->find())
                        PartyMail::model()->importXml(new SimpleXMLElement('<PartyMail ' .
                                        'value="' . $email . '" ' .
                                        'PartyMailType_id="' . $invoiceDeliveryPartyMailType->id . '" ' .
                                        'active="1" ' .
                                        'Party_id="' . $customer->id . '" ' .
                                        '></PartyMail>'
                        ));
                }
            }
        }

        // Check if vendor and customer has the relationships
        // Check SUPPLIER -> CUSTOMER

        $parties['customer'] = $customer;

        return $parties;
    }

    /**
     * Test payment term
     *
     * @param type $data
     * @return type
     * @throws CException
     */
    private function testPaymentTerm($data) {
        if (!$data[self::PAYMENT_TERM_COL])
            throw new CException(yii::t('yanus', 'Payment term cannot be null'));
        $paymentTermRec = PaymentTerm::model()->filterByName($data[self::PAYMENT_TERM_COL])->find();
        if (!$paymentTermRec)
            throw new CException(yii::t('yanus', 'Payment term "{pt}" not found.', array('{pt}' => $data[self::PAYMENT_TERM_COL])));
        return $paymentTermRec;
    }

    /**
     * Test promised date
     *
     * @param type $data
     * @return \DateTime|boolean
     * @throws CException
     */
    private function testPromisedDt($data) {
        if ($data[self::PROMISED_DATE_COL]) {
            try {
                $promisedDate = new DateTime($data[self::PROMISED_DATE_COL]);
            } catch (Exception $e) {
                throw new CException(yii::t('yanus', 'Invalid promised date "{dt}"', array('{dt}' => $data[self::PROMISED_DATE_COL])));
            }
            return $promisedDate;
        }
        return false;
    }

    /**
     * Test RFC
     *
     * @param type $data
     * @param type $type
     * @return type
     * @throws CException
     */
    private function testRfc($data, $type) {
        switch ($type) {
            case 'vendor':
                $rfc = $data[self::VENDOR_RFC_COL];
                break;
            case 'customer':
                $rfc = $data[self::CUSTOMER_RFC_COL];
                break;
        }
        if (!$rfc)
            throw new CException(yii::t('yanus', '{type} RFC cannot be null', array('{type}', ucfirst($type))));
        SatHelper::validateRfc($rfc);
        return $rfc;
    }

    /**
     * Test state
     *
     * @param Country $country
     * @param type $code
     * @return type
     * @throws CException
     */
    private function testState(Country $country, $code) {

        $state = State::model()->filterByCountry_id($country->id)->find();
        if (!$state)
            $state = State::model()->importXml(new SimpleXMLElement("<State code='$code' Country_id = '$country->id'></State>"));
        return $state;
    }

    /**
     * Test transaction order date
     *
     * @param type $data
     * @return \DateTime|boolean
     * @throws CException
     */
    private function testTransactionOrderDt($data) {
        if ($data[self::TRANSACTION_ORDER_DATE_COL]) {
            try {
                $transactionOrderDt = new DateTime($data[self::TRANSACTION_ORDER_DATE_COL]);
            } catch (Exception $e) {
                throw new CException(yii::t('yanus', 'Invalid transaction order date "{dt}"', array('{dt}' => $data[self::TRANSACTION_ORDER_DATE_COL])));
            }
            return $transactionOrderDt;
        }
        return false;
    }

}

?>
