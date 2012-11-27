<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
Yii::import('application.vendors.tcpdf.tcpdf');
/**
 * Description of castrolPdfInvoice
 *
 * @author jorgemariani
 */
class GamaPdfInvoice extends TCPDF {

    const REAL_WIDTH = 196;

    const WIDTH_DESC = 96;
    const WIDTH_QTY = 10;
    const WIDTH_UOM = 10;
    const WIDTH_AUTH = 10;
    const WIDTH_UNP = 30;
    const WIDTH_AMT = 40;

    const WIDTH_CUSTOMER_BOX = 131;
    const WIDTH_INVOICE_BOX = 65;

    const WIDTH_WORDAMOUNT_BOX = 126;

    const WIDTH_CBB = 50;
    const WIDTH_SAT_LABELS = 56;

    const WIDTH_ORIGINAL_STRING = 154;

    const ROWS_PER_PAGE = 60;

    public $invoice;
    public $cfdFile;
    public $logoFile;
    public $master;

    private $lastPage = false;
    private $xml;
    private $sumItem = 0;
    private $sumTax = 0;
    private $sumDiscount = 0;

    private $row = 0;
    private $cbb;

    public function Header() {
//        $primaryAddress = false;
//        $invoicedFrom = false;
//        $soldTo = false;
//        $shipTo = false;
//
//        // Get vendor attributes
//        $vendorAttr = $this->invoice->vendorParty->getAttributesAssocArray();
//        // Get customer attributes
//        $customerAttr = $this->invoice->customerParty->getAttributesAssocArray();
//
//        // Get addresses.
//        foreach ($this->invoice->cfdAddresses as $invoiceAddress) {
//            switch ($invoiceAddress->type) {
//                case AddressTypeBehavior::FISCAL:
//                    $primaryAddress = $invoiceAddress;
//                    break;
//                case AddressTypeBehavior::BILL_TO:
//                    $soldTo = $invoiceAddress;
//                    break;
//                default:
//                    break;
//            }
//        }

        // get RFC

        $this->setCellPaddings(0.5, '', 0.5);

        // CFDI SIGN
        $this->SetFont("helvetica", "", 7);
        $this->Cell(0, 0, "ESTE DOCUMENTO ES UNA REPRESENTACION IMPRESA DE UN CFDI.",
                "B",  // Draw bottom border
                1,    // Put cursor in next line
                "L"   // Align left
                );

        // GAMA Information
        $this->SetFont("helvetica", "BI", 7);
        $this->Cell(0, 0, $this->invoice->vendorParty->name,
                '',  // NO border
                1,    // Put cursor in next line
                "R"   // Align right
                );
        $this->Cell(0, 0, 'R.F.C: ' . $this->invoice->vendorParty->rfc,
                'B',  // No bottom border
                1,    // Put cursor in next line
                "R"   // Align right
                );

        // GAMA address
        $this->SetFont("helvetica", 'I', 5);
        $this->Cell(0, 0,
                $this->invoice->primaryAddress->street . ' ' .
                    'Colonia ' . $this->invoice->primaryAddress->neighbourhood . ' ' .
                    'Delegación ' . $this->invoice->primaryAddress->municipality,
                '',  // No bottom border
                1,    // Put cursor in next line
                "R"   // Align right
                );
        $this->Cell(0, 0,
                'C.P. ' . $this->invoice->primaryAddress->zipCode . ', ' .
                $this->invoice->primaryAddress->city . ', ' .
                $this->invoice->primaryAddress->state . ', ' .
                $this->invoice->primaryAddress->country,
                '',  // No bottom border
                1,    // Put cursor in next line
                "R"   // Align right
                );
        $phone = $this->invoice->vendorParty->primaryPhone;
        $this->Cell(0, 0,
                'TEL. ' . ($phone ? yii::app()->phoneFormatter->format($phone) : ''),
                '',  // No bottom border
                1,    // Put cursor in next line
                "R"   // Align right
                );
        $fiscalRegime = '';
        foreach ($this->invoice->cfdTaxRegimes as $taxRegime) {
            $fiscalRegime .= $taxRegime->name . ', ';
        }
        $this->Cell(0, 0,
                'Régimen fiscal: ' . $fiscalRegime,
                '',  // No bottom border
                1,    // Put cursor in next line
                "R"   // Align right
                );

        $this->Ln(3);
        // PAYMENT TYPE
        $this->SetFont("helvetica", "B", 10);
        $this->Cell(0, 0, $this->invoice->paymentType, "TB", 1, "C");

        // CUSTOMER NAME
        $this->SetFont("helvetica", '', 7);
        $this->Cell(self::WIDTH_CUSTOMER_BOX, 0, $this->invoice->customerParty->name, 'LTR', 0, 'L', false, '', 1);

        // INVOICE TYPE
        $this->SetFont("helvetica", 'BI', 7);
        $this->Cell(self::WIDTH_INVOICE_BOX, 0,
                ($this->invoice->voucherType == 'ingreso' ? 'FACTURA' : 'NOTA DE CREDITO'),
                1,    // Frame
                1,    // Put cursor next line
                "C"   // Align left
                );

        // CUSTOMER STREET
        $this->SetFont("helvetica", '', 7);
        $this->Cell(self::WIDTH_CUSTOMER_BOX, 0,
            $this->invoice->billToAddress->street,
            'LR',  // Left right border
            0,    // Put cursor to the right
            "L"   // Align left
            , false, '', 1);

        // INVOICE NUMBER
        $this->SetFont("helvetica", '', 7);
        $this->Cell(self::WIDTH_INVOICE_BOX, 0,
                'Folio Interno: ' . $this->invoice->folio,
                1,  // Frame
                1,    // Put cursor next line
                "C"   // Align left
                );

        // CUSTOMER COLONY
        $this->SetFont("helvetica", '', 7);
        $this->Cell(self::WIDTH_CUSTOMER_BOX, 0,
                'COLONIA: ' . $this->invoice->billToAddress->neighbourhood,
                'LR',  // Left right border
                0,    // Put cursor to the right
                "L"   // Align left
                , false, '', 1);

        // INVOICED FROM
        $this->SetFont("helvetica", '', 7);
        $this->Cell(self::WIDTH_INVOICE_BOX, 0,
                'MEXICO, D.F. A:',
                1,  // Frame
                1,    // Put cursor next line
                "C"   // Align left
                );

        // CUSTOMER MUNICIPALITY and ZIPCODE
        $this->SetFont("helvetica", '', 7);
        $this->Cell(self::WIDTH_CUSTOMER_BOX, 0,
                (trim($this->invoice->billToAddress->municipality) ? 'DELEGACION: ' . $this->invoice->billToAddress->municipality . ', ' : '') .
                'C.P. ' . $this->invoice->billToAddress->zipCode . ', ' .
                (trim($this->invoice->billToAddress->city) ? 'CIUDAD: ' . $this->invoice->billToAddress->city . ', ' : '') .
                (trim($this->invoice->billToAddress->state) ? $this->invoice->billToAddress->state  . ', ': '') .
                $this->invoice->billToAddress->country
                ,
                'LR',  // Left right border
                0,    // Put cursor to the right
                "L"   // Align left
                , false, '', 1);

        // INVOICED DATE
        $this->SetFont("helvetica", '', 7);
        $this->Cell(self::WIDTH_INVOICE_BOX, 0,
                $this->invoice->dttm,
                1,  // Frame
                1,    // Put cursor next line
                "C"   // Align left
                );

        // CUSTOMER RFC
        $this->SetFont("helvetica", '', 7);
        $this->Cell(self::WIDTH_CUSTOMER_BOX, 0,
                'CLAVE DEL R.F.C. ' . $this->invoice->customerParty->rfc,
                'LR',  // Left bottomright border
                0,    // Put cursor next line
                "L"   // Align left
                );
        // SUPPLIER NUMBER
        // find supplier number
        $phr = PartyHasRelationship::model()->find('party_id = :id and relatedParty_id = :rpid and type = :type',
                array(':id' => $this->invoice->customerParty->id, ':rpid' => $this->invoice->vendorParty->id, ':type' => PartyRelationshipTypeBehavior::SUPPLIER));
        $this->SetFont("helvetica", '', 7);
        $this->Cell(self::WIDTH_INVOICE_BOX, 0,
                ($phr && isset($phr->suppliercode) ?
                    'Nº de proveedor GAMA para el cliente: ' . $phr->supplierCode : ''),
                1,  // Frame
                1,    // Put cursor next line
                "C"   // Align left
                );

        // BLANK CELL
        $this->SetFont("helvetica", '', 7);
        $this->Cell(self::WIDTH_CUSTOMER_BOX, 0,
                '',
                'LBR',  // Left bottomright border
                0,    // Put cursor next line
                "L"   // Align left
                );
        // PAYMENT TERM
        $this->SetFont("helvetica", '', 7);
        $this->Cell(self::WIDTH_INVOICE_BOX, 0,
                'Condiciones de pago: ' . $this->invoice->paymentTerm,
                1,  // Frame
                1,    // Put cursor next line
                "C"   // Align left
                );
        // EXPEDITION PLACE
        $this->SetFont("helvetica", '', 7);
        $this->Cell(self::WIDTH_CUSTOMER_BOX, 0,
                'Lugar de Expedición: ' . $this->invoice->expeditionPlace,
                'LR',  // Frame
                0,    // Put cursor next line
                "L"   // Align left
                );
        // PAYMENT METHOD
        $this->SetFont("helvetica", '', 7);
        $this->Cell(self::WIDTH_INVOICE_BOX, 0,
                'Forma de pago: ' . $this->invoice->paymentMethod,
                1,  // Frame
                1,    // Put cursor next line
                "C"   // Align left
                );
        // BLANK CELL
        $this->SetFont("helvetica", '', 7);
        $this->Cell(self::WIDTH_CUSTOMER_BOX, 0,
                '',
                'LBR',  // Left bottomright border
                0,    // Put cursor next line
                "L"   // Align left
                );
        // BANK ACCOUNT NBR
        $this->SetFont("helvetica", '', 7);
        $this->Cell(self::WIDTH_INVOICE_BOX, 0,
                ($this->invoice->paymentAcctNbr ? 'Nº cuenta banco: ' . $this->invoice->paymentAcctNbr : ''),
                1,  // Frame
                1,    // Put cursor next line
                "C"   // Align left
                );


        // TABLE HEADER
        $this->SetFont("helvetica", "", 7);
        $this->cell(self::WIDTH_AUTH, 0, 'Nº Aut.',
                1, 0, 'R', false, '', 1, false, '', 'C');
        $this->cell(self::WIDTH_QTY, 0, 'Cantidad',
                1, 0, 'R', false, '', 1, false, '', 'C');
        $this->cell(self::WIDTH_QTY, 0, 'Unidad',
                1, 0, 'C', false, '', 1, false, '', 'C');
        $this->cell(self::WIDTH_DESC, 0, 'Descripción',
                1, 0, 'L', false, '', 1, false, '', 'C');
        $this->cell(self::WIDTH_UNP, 0, 'Precio unitario',
                1, 0, 'R', false, '', 1, false, '', 'C');
        $this->cell(self::WIDTH_AMT, 0, 'Importe',
                1, 1, 'R', false, '', 1, false, '', 'C');

//        $this->Image($this->invoice->MasterRecord->invoicelogofile, 10, 16, 60);
//        $this->Image($this->master->getAttr(MasterRecordAttribute::INVOICE_LOGO_FILE)->value, 10, 16, 60);
        $this->Image(yii::getPathOfAlias('application') . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'invoiceLogo' .
                DIRECTORY_SEPARATOR . $this->invoice->vendorParty->rfc . '.png', 10, 16, 60);
    }

    public function Footer(){
//        $total = $this->invoice->subtotal - $this->invoice->discount + $this->invoice->tax - $this->invoice->withholding;
        $this->setY(-9);
        $this->SetFont("helvetica", "", 7);
        $this->Cell(0, 0, "ESTE DOCUMENTO ES UNA REPRESENTACION IMPRESA DE UN CFDI.", "T", 0, "L");
        $this->Cell(0, 0, "Página " . $this->getAliasNumPage().' de '.$this->getAliasNbPages(), "T", 0, "R");
    }

    public function issuePageBreak($force = false) {
        if ($this->row > self::ROWS_PER_PAGE || $force) {
            $this->row = 0;
            $this->AddPage('P', 'LETTER');
            $this->SetY(65.5, true);
        }
    }

    public function grandTotal() {
        error_log($this->row);

        if ($this->row > 40) $this->issuePageBreak(true);

        $this->setCellPaddings(0.5, '', 0.5);

        // Draw line
        $this->SetY(-95, true);
        $this->SetFont("helvetica", "B", 7);
        $this->Cell(0, 0, "", "T", 1);


        $this->SetFont("helvetica", "B", 7);
        $this->Cell(self::WIDTH_WORDAMOUNT_BOX, 0, 'Cantidad con letra', 'LTR', 0, 'L');

        $this->SetFont("helvetica", "B", 7);
        $this->Cell(self::WIDTH_UNP, 0, 'SUB-TOTAL', 'LTR', 0, 'R');

        $this->SetFont("helvetica", '', 7);
        $this->Cell(self::WIDTH_AMT, 0, number_format($this->invoice->subTotal, 2), 'LTR', 1, 'R');

        $enLetras = strtoupper('(' . $this->num2letras(number_format($this->invoice->total, 2, ".", ""), false, false) .
                ' pesos ' .
                substr(
                        number_format($this->invoice->total, 2, ".", ""),
                        strpos(number_format($this->invoice->total, 2, ".", ""), ".")
                        + 1) .
                '/100 M.N.)');

        $this->SetFont("helvetica", "B", 7);
        $this->MultiCell(self::WIDTH_WORDAMOUNT_BOX, 0, $enLetras, 'LBR', 'L', false, 0);

        $this->SetFont("helvetica", "B", 7);
        $this->Cell(self::WIDTH_UNP, 0, 'I.V.A. (16%)', 'LR', 0, 'R');

        $this->SetFont("helvetica", '', 7);
        $this->Cell(self::WIDTH_AMT, 0, number_format($this->invoice->tax, 2), 'LR', 1, 'R');


        $this->SetFont("helvetica", "B", 7);
        $this->Cell(self::WIDTH_WORDAMOUNT_BOX, 0, '', 0, 0, 'L');

        $this->SetFont("helvetica", "B", 7);
        $this->Cell(self::WIDTH_UNP, 0, 'TOTAL', 'LBR', 0, 'R');

        $this->SetFont("helvetica", '', 7);
        $this->Cell(self::WIDTH_AMT, 0, number_format($this->invoice->total, 2), 'LR', 1, 'R');


        $pagare = 'DEBO (EMOS) Y PAGARE (MOS) INCONDICIONALMENTE A LA ORDEN DE ' . $this->invoice->vendorParty->name .
                ' EN SUS OFICINAS EN MEXICO DF EL DIA ___ POR LA CANTIDAD DE $ ' . number_format($this->invoice->total, 2) . ' MN '.
                'VALOR DE LA MERCANCIA QUE HE (MOS) RECIBIDO A ENTERA SATISFACCION. ' .
                'ESTE PAGARE ES MERCANTIL Y ESTA REGIDO POR LA LEY GENERAL DE TITULOS DE CREDITO EN SU ART. 73 PARTE FINAL ' .
                'Y ARTS. CORRELATIVOS POR NO SER PAGARE DOMICILIARIO. SI NO ES PAGADO A SU VENCIMIENTO CAUSARA INTERES DEL ___% ' .
                'MENSUAL HASTA CUBRIR EL ADEUDO.';

        $this->MultiCell(0, 0, $pagare, 'T', 'T', false, 1);

        $this->Ln(6);

        $this->Cell(0, 0, $this->invoice->vendorParty->name, "T", 1, "R");

        // Sello
        $this->ln(2);
        $this->setCellMargins(1);
        $this->SetFont("courier", "", 6);
        $this->Cell(self::WIDTH_CBB, 0, '', 0, 0);
        $this->SetFont("courier", "B", 6);
        $this->Cell(self::WIDTH_SAT_LABELS, 0, 'FOLIO FISCAL', 0, 0, 'R');
        $this->SetFont("courier", '', 6);
        $this->Cell(0, 0, $this->invoice->SatStamp->uuid, 0, 1);

        $this->SetFont("courier", "", 6);
        $this->Cell(self::WIDTH_CBB, 0, '', 0, 0);
        $this->SetFont("courier", "B", 6);
        $this->Cell(self::WIDTH_SAT_LABELS, 0, 'FECHA TIMBRADO', 0, 0, 'R');
        $this->SetFont("courier", '', 6);
        $this->Cell(0, 0, $this->invoice->SatStamp->dttm, 0, 1);

        $this->SetFont("courier", "", 6);
        $this->Cell(self::WIDTH_CBB, 0, '', 0, 0);
        $this->SetFont("courier", "B", 6);
        $this->Cell(self::WIDTH_SAT_LABELS, 0, 'Nº DE SERIE DEL CERTIFICADO DEL SAT', 0, 0, 'R');
        $this->SetFont("courier", '', 6);
        $this->Cell(0, 0, $this->invoice->SatStamp->certificate, 0, 1);

        $this->SetFont("courier", "", 6);
        $this->Cell(self::WIDTH_CBB, 0, '', 0, 0);
        $this->SetFont("courier", "B", 6);
        $this->Cell(self::WIDTH_SAT_LABELS, 0, 'Nº DE SERIE DEL CERTIFICADO DEL EMISOR', 0, 0, 'R');
        $this->SetFont("courier", '', 6);
        $this->Cell(0, 0, $this->invoice->satCertificate->nbr, 0, 1);

        $this->SetFont("courier", "", 6);
        $this->Cell(self::WIDTH_CBB, 0, '', 0, 0);
        $this->SetFont("courier", "B", 6);
        $this->Cell(self::WIDTH_SAT_LABELS, 0, 'SELLO DIGITAL DEL SAT', 0, 0, 'R');
        $this->SetFont("courier", '', 6);
        $this->MultiCell(0, 0, $this->invoice->SatStamp->stamp, 0, 'L', false, 1);

        $this->SetFont("courier", "", 6);
        $this->Cell(self::WIDTH_CBB, 0, '', 0, 0);
        $this->SetFont("courier", "B", 6);
        $this->Cell(self::WIDTH_SAT_LABELS, 0, 'SELLO DIGITAL DEL EMISOR', 0, 0, 'R');
        $this->SetFont("courier", '', 6);
        $this->MultiCell(0, 0, $this->invoice->seal, 0, 'L', false, 1);

        $this->SetFont("courier", "", 6);
        $this->Cell(self::WIDTH_CBB, 0, '', 0, 0);
        $this->SetFont("courier", "B", 6);
        $this->MultiCell(self::WIDTH_SAT_LABELS, 0, 'CADENA ORIGINAL DEL COMPLEMENTO DE CERTIFICACION DIGITAL DEL SAT', 0, 'R', false, 0);
        $this->SetFont("courier", '', 6);
        $this->MultiCell(0, 0, $this->invoice->SatStamp->originalString, 0, 'L', false, 1);

        // CBB
        $style = array(
            'border' => 0,
            'vpadding' => 0,
            'hpadding' => 0,
            'fgcolor' => array(0,0,0),
            'bgcolor' => false, //array(255,255,255)
            'module_width' => 1, // width of a single module in points
            'module_height' => 1 // height of a single module in points
        );
//        $this->SetY(-75.1);
        $this->write2DBarcode($this->invoice->cbb, "QRCODE,H", 10, 215, 55, 55, $style);

    }

    public function create($invoice, $fname, $target = 'F'){
        $this->invoice = $invoice;
        $this->cbb = $invoice->cbb;

        $items = array();

        $row = 0;

//        $this->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // Portrait, page break, 110 from the bottom of the page
//        $this->setPageOrientation('P', TRUE, 110);
        // Sets the margin between the header and the top of the page

        $this->setHeaderMargin(10);
        $this->setFooterMargin(0);
        $this->setPageOrientation('P', false, 10);

        $margins = $this->getMargins();
//        print_r($this->getMargins());
        $pw = $this->getPageWidth() - $margins['left'] + $margins['right'];
//        echo 'Page width: ' . $pw . PHP_EOL;

        $this->issuePageBreak(true);

        $group = '';

        // Get cfd items
        $cfdItemCriteria = new CDbCriteria();
        $cfdItemCriteria->condition = 'Cfd_id = :id';
        $cfdItemCriteria->params = array(':id' => $this->invoice->id);
        $cfdItems = CfdItem::model()->findAll($cfdItemCriteria);

        $grouping = array();
        foreach ($cfdItems as $item) {
            if (!isset($grouping[$item->group])) $grouping[$item->group] = array();
            $grouping[$item->group][] = $item;
        }
//        print_r($grouping);
        foreach ($grouping as $groupItem) {
            $this->row += 3;
            $this->issuePageBreak();
    ////                $this->SetFont("helvetica", "", 5);
            $this->SetFont("helvetica", "B", 7);
            if (isset($groupItem[0]->vehicle) || isset($groupItem[0]->licenseplate) || isset($groupItem[0]->km)) {
                $this->cell(0, 0, (isset($groupItem[0]->vehicle) ? 'Vehículo: ' . $groupItem[0]->vehicle . ' ' : '') .
                    (isset($groupItem[0]->licenseplate) ? 'Placas: ' . $groupItem[0]->licenseplate . ' ' : '') .
                    (isset($groupItem[0]->km) ? 'KM: ' . number_format($groupItem[0]->km, 0) : ''),
                    'LR', 1, 'L', false, '', 1, false, '', 'C');
            }
            if (isset($groupItem[0]->enginenbr) || isset($groupItem[0]->serialnbr) || isset($groupItem[0]->inventorynbr)) {
                $this->issuePageBreak();
                $this->cell(0, 0,
                        (isset($groupItem[0]->enginenbr) ? 'Nº de motor: ' . $groupItem[0]->enginenbr . ' ' : '') .
                        (isset($groupItem[0]->serialnbr) ? 'Nº de serie: ' . $groupItem[0]->serialnbr . ' ' : '') .
                        (isset($groupItem[0]->inventorynbr) ? 'Nº de inventario: ' . number_format($groupItem[0]->inventorynbr, 0) : ''),
                    'LR', 1, 'L', false, '', 1, false, '', 'C');
            }
            if (isset($groupItem[0]->username)) {
                $this->issuePageBreak();
                $this->cell(0, 0, (isset($groupItem[0]->username) ? 'Usuario: ' . $groupItem[0]->username : ''),
                    'LR', 1, 'L', false, '', 1, false, '', 'C');
            }
            foreach ($groupItem as $item) {
                switch ($item->description) {
                    case 'REFACCIONES':
                    case 'MANO DE OBRA':
                        $this->issuePageBreak();
                        $this->ln();
                        $this->row++;

                        $this->SetFont("helvetica", "B", 7);
                        $this->issuePageBreak();
                        $this->cell(0, 0, $item->description,
                                1, 1, 'L', false, '', 1, false, '', 'C');

                        $this->issuePageBreak();
                        $this->ln();
                        $this->row++;
                        break;
                    default:
                        $this->issuePageBreak();
                        $this->SetFont("helvetica", "", 7);
                        $this->cell(self::WIDTH_AUTH, 0, $item->authNbr,
                                1, 0, 'R', false, '', 1, false, '', 'C');
                        $this->cell(self::WIDTH_QTY, 0, number_format($item->qty, 0),
                                1, 0, 'R', false, '', 1, false, '', 'C');
                        $this->cell(self::WIDTH_UOM, 0, $item->uom,
                                1, 0, 'C', false, '', 1, false, '', 'C');
                        $this->cell(self::WIDTH_DESC, 0, $item->description,
                                1, 0, 'L', false, '', 1, false, '', 'C');
                        $this->cell(self::WIDTH_UNP, 0, number_format($item->unitPrice, 2),
                                1, 0, 'R', false, '', 1, false, '', 'C');
                        $this->cell(self::WIDTH_AMT, 0, number_format($item->amt, 2),
                                1, 1, 'R', false, '', 1, false, '', 'C');
                        $this->row++;
                }
            }
        }
//        foreach ($cfdItems as $item) {
//            if ($group != $item->group) {
//                $group = $item->group;
//                $this->row += 3;
//                $this->issuePageBreak();
//////                $this->SetFont("helvetica", "", 5);
//                $this->SetFont("helvetica", "B", 7);
//                if (isset($item->vehicle) || isset($item->licenseplate) || isset($item->km)) {
//                    $this->cell(0, 0, (isset($item->vehicle) ? 'Vehículo: ' . $item->vehicle . ' ' : '') .
//                        (isset($item->licenseplate) ? 'Placas: ' . $item->licenseplate . ' ' : '') .
//                        (isset($item->km) ? 'KM: ' . number_format($item->km, 0) : ''),
//                        'LR', 1, 'L', false, '', 1, false, '', 'C');
//                }
//                if (isset($item->enginenbr) || isset($item->serialnbr) || isset($item->inventorynbr)) {
//                    $this->issuePageBreak();
//                    $this->cell(0, 0,
//                            (isset($item->enginenbr) ? 'Nº de motor: ' . $item->enginenbr . ' ' : '') .
//                            (isset($item->serialnbr) ? 'Nº de serie: ' . $item->serialnbr . ' ' : '') .
//                            (isset($item->inventorynbr) ? 'Nº de inventario: ' . number_format($item->inventorynbr, 0) : ''),
//                        'LR', 1, 'L', false, '', 1, false, '', 'C');
//                }
//                if (isset($item->username)) {
//                    $this->issuePageBreak();
//                    $this->cell(0, 0, (isset($item->username) ? 'Usuario: ' . $item->username : ''),
//                        'LR', 1, 'L', false, '', 1, false, '', 'C');
//                }
//            }
////
//////            switch ($item->Product->name) {
//            switch ($item->description) {
//                case 'REFACCIONES':
//                case 'MANO DE OBRA':
//                    $this->issuePageBreak();
//                    $this->ln();
//                    $this->row++;
//
//                    $this->SetFont("helvetica", "B", 7);
//                    $this->issuePageBreak();
//                    $this->cell(0, 0, $item->description,
//                            1, 1, 'L', false, '', 1, false, '', 'C');
//
//                    $this->issuePageBreak();
//                    $this->ln();
//                    $this->row++;
//                    break;
//                default:
//                    $this->issuePageBreak();
//                    $this->SetFont("helvetica", "", 7);
//                    $this->cell(self::WIDTH_AUTH, 0, $item->authNbr,
//                            1, 0, 'R', false, '', 1, false, '', 'C');
//                    $this->cell(self::WIDTH_QTY, 0, number_format($item->qty, 0),
//                            1, 0, 'R', false, '', 1, false, '', 'C');
//                    $this->cell(self::WIDTH_UOM, 0, $item->uom,
//                            1, 0, 'C', false, '', 1, false, '', 'C');
//                    $this->cell(self::WIDTH_DESC, 0, $item->description,
//                            1, 0, 'L', false, '', 1, false, '', 'C');
//                    $this->cell(self::WIDTH_UNP, 0, number_format($item->unitPrice, 2),
//                            1, 0, 'R', false, '', 1, false, '', 'C');
//                    $this->cell(self::WIDTH_AMT, 0, number_format($item->amt, 2),
//                            1, 1, 'R', false, '', 1, false, '', 'C');
//                    $this->row++;
//            }
//        }
        $this->issuePageBreak();
        $this->ln();
        $this->row++;

        $this->issuePageBreak();
        $this->Cell(0, 0, 'Impuestos:', '', 1, 'L');
        $this->row++;
        foreach ($this->invoice->cfdTaxes as $tax) {
            $this->issuePageBreak();
            $this->Cell(0, 0, $tax->name . '(' . number_format($tax->rate, 2) . '%) ' . number_format($tax->amt, 2), '', 1, 'L');
            $this->row++;
        }

        // ORIGINAL STRING
        $this->issuePageBreak();
        $this->Cell(0, 0, '', '', 1, 'L');
        $this->row++;
        $this->issuePageBreak();
        $this->row++;
        $this->Cell(0, 0, 'Cadena Original:', '', 1, 'L');
        $this->SetFont("courier", "", 6);
        $originalString = chunk_split($this->invoice->originalString, self::WIDTH_ORIGINAL_STRING, "\n");
        $aoriginalString = explode("\n", $originalString);
        foreach ($aoriginalString as $osChunk) {
            $this->issuePageBreak();
            $this->row++;
            $this->Cell(0, 0, $osChunk, '', 1, 'L');
        }
        $this->grandTotal();
        return $this->Output($fname, $target);
    }


    public function num2letras($num, $fem = true, $dec = true) {
        //if (strlen($num) > 14) die("El n?mero introducido es demasiado grande");
        $matuni[2] = "dos";
        $matuni[3] = "tres";
        $matuni[4] = "cuatro";
        $matuni[5] = "cinco";
        $matuni[6] = "seis";
        $matuni[7] = "siete";
        $matuni[8] = "ocho";
        $matuni[9] = "nueve";
        $matuni[10] = "diez";
        $matuni[11] = "once";
        $matuni[12] = "doce";
        $matuni[13] = "trece";
        $matuni[14] = "catorce";
        $matuni[15] = "quince";
        $matuni[16] = "dieciseis";
        $matuni[17] = "diecisiete";
        $matuni[18] = "dieciocho";
        $matuni[19] = "diecinueve";
        $matuni[20] = "veinte";
        $matunisub[2] = "dos";
        $matunisub[3] = "tres";
        $matunisub[4] = "cuatro";
        $matunisub[5] = "quin";
        $matunisub[6] = "seis";
        $matunisub[7] = "sete";
        $matunisub[8] = "ocho";
        $matunisub[9] = "nove";

        $matdec[2] = "veint";
        $matdec[3] = "treinta";
        $matdec[4] = "cuarenta";
        $matdec[5] = "cincuenta";
        $matdec[6] = "sesenta";
        $matdec[7] = "setenta";
        $matdec[8] = "ochenta";
        $matdec[9] = "noventa";
        $matsub[3] = 'mill';
        $matsub[5] = 'bill';
        $matsub[7] = 'mill';
        $matsub[9] = 'trill';
        $matsub[11] = 'mill';
        $matsub[13] = 'bill';
        $matsub[15] = 'mill';
        $matmil[4] = 'millones';
        $matmil[6] = 'billones';
        $matmil[7] = 'de billones';
        $matmil[8] = 'millones de billones';
        $matmil[10] = 'trillones';
        $matmil[11] = 'de trillones';
        $matmil[12] = 'millones de trillones';
        $matmil[13] = 'de trillones';
        $matmil[14] = 'billones de trillones';
        $matmil[15] = 'de billones de trillones';
        $matmil[16] = 'millones de billones de trillones';

        $num = trim((string) @$num);
        if ($num[0] == '-') {
            $neg = 'menos ';
            $num = substr($num, 1);
        } else
            $neg = '';
        while ($num[0] == '0')
            $num = substr($num, 1);
        if ($num[0] < '1' or $num[0] > 9)
            $num = '0'.$num;
        $zeros = true;
        $punt = false;
        $ent = '';
        $fra = '';
        for ($c = 0; $c < strlen($num); $c++) {
            $n = $num[$c];
            if (!(strpos(".,'''", $n) === false)) {
                if ($punt)
                    break;
                else {
                    $punt = true;
                    continue;
                }

            } elseif (!(strpos('0123456789', $n) === false)) {
                if ($punt) {
                    if ($n != '0')
                        $zeros = false;
                    $fra .= $n;
                } else

                    $ent .= $n;
            } else

                break;

        }
        $ent = '     '.$ent;
        if ($dec and $fra and !$zeros) {
            $fin = ' coma';
            for ($n = 0; $n < strlen($fra); $n++) {
                if (($s = $fra[$n]) == '0')
                    $fin .= ' cero';
                elseif ($s == '1')
                    $fin .= $fem ? ' una' : ' un';
                else
                    $fin .= ' '.$matuni[$s];
            }
        } else
            $fin = '';
        if ((int) $ent === 0)
            return 'Cero '.$fin;
        $tex = '';
        $sub = 0;
        $mils = 0;
        $neutro = false;
        while (($num = substr($ent, -3)) != '   ') {
            $ent = substr($ent, 0, -3);
            if (++$sub < 3 and $fem) {
                $matuni[1] = 'una';
                $subcent = 'as';
            } else {
                $matuni[1] = $neutro ? 'un' : 'uno';
                $subcent = 'os';
            }
            $t = '';
            $n2 = substr($num, 1);
            if ($n2 == '00') {
            } elseif ($n2 < 21)
                $t = ' '.$matuni[(int) $n2];
            elseif ($n2 < 30) {
                $n3 = $num[2];
                if ($n3 != 0)
                    $t = 'i'.$matuni[$n3];
                $n2 = $num[1];
                $t = ' '.$matdec[$n2].$t;
            } else {
                $n3 = $num[2];
                if ($n3 != 0)
                    $t = ' y '.$matuni[$n3];
                $n2 = $num[1];
                $t = ' '.$matdec[$n2].$t;
            }
            $n = $num[0];
            if ($n == 1) {
                $t = ' ciento'.$t;
            } elseif ($n == 5) {
                $t = ' '.$matunisub[$n].'ient'.$subcent.$t;
            } elseif ($n != 0) {
                $t = ' '.$matunisub[$n].'cient'.$subcent.$t;
            }
            if ($sub == 1) {
            } elseif (!isset($matsub[$sub])) {
                if ($num == 1) {
                    $t = ' un mil';
                } elseif ($num > 1) {
                    $t .= ' mil';
                }
            } elseif ($num == 1) {
                $t .= ' '.$matsub[$sub].'ón';
            } elseif ($num > 1) {
                $t .= ' '.$matsub[$sub].'ones';
            }
            if ($num == '000')
                $mils++;
            elseif ($mils != 0) {
                if (isset($matmil[$sub]))
                    $t .= ' '.$matmil[$sub];
                $mils = 0;
            }
            $neutro = true;
            $tex = $t.$tex;
        }
        $tex = $neg.substr($tex, 1).$fin;
        return ucwords($tex);
    }

    public function loadXml($xml) {
        $this->xml = simplexml_load_file($xml);
    }
}
