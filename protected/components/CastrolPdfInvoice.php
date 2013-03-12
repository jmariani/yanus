<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of castrolPdfInvoice
 *
 * @author jorgemariani
 */
class CastrolPdfInvoice extends TCPDF {

    const REAL_WIDTH = 196;
    const INVOICE_DATA_CELL_WIDTH = 21.77;
    const TRANSACTION_ORDER_DT_WIDTH = 17;
    const PAYMENT_TERM_WIDTH = 70.61;
    const CUSTOMER_ID_WIDTH = 14;
    const AGENT_WIDTH = 10;
    const ZONE_WIDTH = 7;
    const TRANSPORT_WIDTH = 12;
    const ITEM_COLUMN_WIDTH = 28;
    const ITEM_CODE_WIDTH = 16.77;
    const ITEM_UOM_WIDTH = 10;
    const ITEM_AMT_WIDTH = 29;
    const ITEM_DESC_WIDTH = 85.61;
    const SUBTOTAL_FILLER_WIDTH = 96.39;
    const CBB_WIDTH = 45;
    const FISCAL_WIDTH = 60;
    const FISCAL_DATA_WIDTH = 82;
    const TAX_FILLER_WIDTH = 60.54;
    const TAX_CELL_WIDTH = 28.20;
    const CUSTOMS_DT_WIDTH = 13.20;
    const CUSTOMS_OFFICE_WIDTH = 43.20;

    public $invoice;
    public $cfdFile;
    public $logoFile;
    public $master;
    private $xml;
    private $sumItem = 0;
    private $sumTax = 0;
    private $sumDiscount = 0;
    private $invoicedFrom;

    public function Header() {
        $this->setCellPaddings(0.5, '', 0.5);

        if (SystemConfig::getValue(SystemConfig::RUN_MODE) != SystemConfig::RUN_MODE_PRODUCTION) {
// get the current page break margin
            $bMargin = $this->getBreakMargin();
// get current auto-page-break mode
            $auto_page_break = $this->AutoPageBreak;
// disable auto-page-break
            $this->SetAutoPageBreak(false, 0);
// set bacground image
            $img_file = yii::getPathOfAlias('images') . DIRECTORY_SEPARATOR . 'draft.png';
            $this->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
// restore auto-page-break status
            $this->SetAutoPageBreak($auto_page_break, $bMargin);
// set the starting point for the page content
            $this->setPageMark();
        }

        $this->SetFont("helvetica", "", 7);
        $this->Cell(0, 0, "ESTE DOCUMENTO ES UNA REPRESENTACION IMPRESA DE UN CFDI. - Página " . $this->getAliasNumPage() . ' de ' . $this->getAliasNbPages(), "B", // Draw bottom border
                0, // Put cursor in next line
                "L"   // Align left
        );
        if (SystemConfig::getValue(SystemConfig::RUN_MODE) != SystemConfig::RUN_MODE_PRODUCTION) {
            $this->SetFont("helvetica", 'B', 7);
            $this->SetTextColor(255, 0, 0);
            $this->Cell(0, 0, 'DEMO', '', // NO border
                    0, // Put cursor in next line
                    "R"   // Align right
            );
            $this->SetTextColor(0, 0, 0);
        }
        $this->Ln();

// CASTROL RFC
        $this->SetFont("helvetica", "B", 7);
        $this->Cell(0, 0, $this->invoice->vendor->rfc, '', // NO border
                1, // Put cursor in next line
                "L"   // Align right
        );
// CASTROL NAME
        $this->Cell(self::REAL_WIDTH / 5 - 2, 0, $this->invoice->vendor->name, '', // NO border
                0, // Put cursor in next line
                "L"   // Align right
        );

        $this->SetFont("helvetica", null, 7);
        // BILLED FROM BRANCH NAME (2ND COLUMMN)
        $this->Cell(self::REAL_WIDTH / 2, 0, ($this->invoice->billedFromAddress ? 'Suc. ' . $this->invoice->billedFromAddress->city : ''), '', // NO border
                1, // Put cursor in next line
                "L"   // Align right
        );

// CASTROL ADDRESS STREET
        $this->Cell(self::REAL_WIDTH / 5 - 2, 0, $this->invoice->primaryAddress->street . ' ' . $this->invoice->primaryAddress->extNbr . ' ' . $this->invoice->primaryAddress->intNbr, '', // NO border
                0, // Put cursor in next line
                "L"   // Align right
        );
// BILLED FROM STREET (2ND COLUMMN)
        $this->Cell(self::REAL_WIDTH / 2, 0, ($this->invoice->billedFromAddress ? $this->invoice->billedFromAddress->street . ' ' .
                        $this->invoice->billedFromAddress->extNbr . ' ' . $this->invoice->billedFromAddress->intNbr : ''), '', // NO border
                1, // Put cursor in next line
                "L"   // Align right
        );

// CASTROL ADDRESS NEIGHBOURHOOD
        $this->SetFont("helvetica", null, 7);
        $this->Cell(self::REAL_WIDTH / 5 - 2, 0, 'Col. ' . $this->invoice->primaryAddress->neighbourhood, '', // NO border
                0, // Put cursor in next line
                "L"   // Align right
        );

// BILLED FROM NEIGHBOURHOOD (2ND COLUMMN)
        $this->Cell(self::REAL_WIDTH / 2, 0, ($this->invoice->billedFromAddress ? $this->invoice->billedFromAddress->municipality : ''), '', // NO border
                1, // Put cursor in next line
                "L"   // Align right
        );

// CASTROL ADDRESS MUNICIPALITY
        $this->SetFont("helvetica", null, 7);
        $this->Cell(self::REAL_WIDTH / 5 - 2, 0, 'Deleg. ' . $this->invoice->primaryAddress->municipality, '', // NO border
                0, // Put cursor in next line
                "L"   // Align right
        );

// BILLED FROM city (2ND COLUMMN)
        $this->Cell(self::REAL_WIDTH / 2, 0, ($this->invoice->billedFromAddress ? $this->invoice->billedFromAddress->city : ''), '', // NO border
                1, // Put cursor in next line
                "L"   // Align right
        );

// CASTROL ADDRESS ZIPCODE
        $this->SetFont("helvetica", null, 7);
        $this->Cell(self::REAL_WIDTH / 5 - 2, 0, 'C.P.: ' . $this->invoice->primaryAddress->zipCode . ' ' . $this->invoice->primaryAddress->state->country->name, '', // NO border
                0, // Put cursor in next line
                "L"   // Align right
        );

// BILLED FROM ZIPCODE (2ND COLUMMN)
        $this->Cell(self::REAL_WIDTH / 2, 0, ($this->invoice->billedFromAddress ? $this->invoice->billedFromAddress->zipCode . ' ' .
                        ($this->invoice->billedFromAddress->state->code != 'N/A' ? $this->invoice->billedFromAddress->state->name : '') . ' ' .
                        $this->invoice->billedFromAddress->state->country->name : ''), '', // NO border
                1, // Put cursor in next line
                "L"   // Align right
        );

// CASTROL PHONE
        $this->SetFont("helvetica", null, 7);
        $this->Cell(self::REAL_WIDTH / 5 - 2, 0, 'Tel.: 5063-2000', '', // NO border
                1, // Put cursor in next line
                "L"   // Align right
        );

// Expedition place
        if ($this->invoice->billedFromAddress)
            $expeditionPlace = $this->invoice->billedFromAddress->state->country->name . ' ' . $this->invoice->billedFromAddress->state->name;
        else
            $expeditionPlace = $this->invoice->primaryAddress->state->country->name . ' ' . $this->invoice->primaryAddress->state->name;
        $expeditionPlace .= ' ' . $this->invoice->dttm;
        $this->SetFont("helvetica", null, 7);
        $this->Cell(0, 0, 'Lugar y fecha de expedición: ' . $expeditionPlace, 'TB', // NO border
                1, // Put cursor in next line
                "R"   // Align right
        );

// CUSTOMER INFO
        $this->SetFont("helvetica", "B", 7);
        $this->Cell(0, 0, 'Cliente: ' . $this->invoice->customer->rfc . ' ' . $this->invoice->customer->name, '', // NO border
                1, // Put cursor in next line
                "L"   // Align right
        );
// CUSTOMER ADDRESS
        $this->SetFont("helvetica", null, 7);
        $this->cell(self::REAL_WIDTH / 5 * 4, 0, $this->invoice->billToAddress->street . ' ' .
                $this->invoice->billToAddress->extNbr . ' ' .
                $this->invoice->billToAddress->intNbr . ' ' .
                $this->invoice->billToAddress->neighbourhood, 0, 0, 'L', false, '', 1, false, '', 'C');

        $this->SetFont("helvetica", 'B', 7);
        $this->cell(0, 0, strtoupper($this->invoice->voucherType), 0, 1, 'C', false, '', 1, false, '', 'C');

// CUSTOMER CITY
        $this->SetFont("helvetica", null, 7);
        $this->cell(self::REAL_WIDTH / 5 * 4, 0, $this->invoice->billToAddress->city, 0, 0, 'L', false, '', 1, false, '', 'C');

        $this->SetFont("helvetica", 'B', 7);
        switch ($this->invoice->voucherType) {
            case 'ingreso':
                $this->cell(0, 0, 'FACTURA', 0, 1, 'C', false, '', 1, false, '', 'C');
                break;
            case 'egreso':
                $this->cell(0, 0, 'NOTA DE CREDITO', 0, 1, 'C', false, '', 1, false, '', 'C');
                break;
            case 'traslado':
                $this->cell(0, 0, 'TRASLADO', 0, 1, 'C', false, '', 1, false, '', 'C');
                break;
        }

// CUSTOMER ZIPCODE STATE COUNTRY
        $this->SetFont("helvetica", null, 7);
        $this->cell(self::REAL_WIDTH / 5 * 4, 0, $this->invoice->billToAddress->zipCode . ' ' .
                ($this->invoice->billToAddress->state->code == 'N/A' ? '' : $this->invoice->billToAddress->state->name) . ' ' .
                $this->invoice->billToAddress->state->country->name, 0, 0, 'L', false, '', 1, false, '', 'C');

        $this->SetFont("helvetica", 'B', 7);
        $this->SetTextColor(255, 0, 0);
        $this->cell(0, 0, strtoupper($this->invoice->serial . substr($this->invoice->folio, 0, 1) . '-' . substr($this->invoice->folio, 1)), 0, 1, 'C', false, '', 1, false, '', 'C');
        $this->SetTextColor(0, 0, 0);

// CUSTOMER SHIP TO ADDRESS
        $this->SetFont("helvetica", "B", 7);
        $this->Cell(0, 0, ($this->invoice->shipToAddress ? 'Consignado: ' . $this->invoice->cfdShipToAddress->name : ''), '', // NO border
                1, // Put cursor in next line
                "L"   // Align right
        );
        $this->SetFont("helvetica", null, 7);
        $this->Cell(0, 0, ($this->invoice->shipToAddress ? $this->invoice->shipToAddress->street . ' ' .
                        $this->invoice->shipToAddress->extNbr . ' ' . $this->invoice->shipToAddress->intNbr . ' ' .
                        $this->invoice->shipToAddress->neighbourhood : ''), '', // NO border
                1, // Put cursor in next line
                "L"   // Align right
        );
        $this->Cell(0, 0, ($this->invoice->shipToAddress ? $this->invoice->shipToAddress->city : ''), '', // NO border
                1, // Put cursor in next line
                "L"   // Align right
        );
        $this->Cell(0, 0, $this->invoice->shipToAddress->zipCode . ' ' .
                ($this->invoice->shipToAddress->state->code == 'N/A' ? '' : $this->invoice->shipToAddress->state->name) . ' ' .
                $this->invoice->shipToAddress->state->country->name, '', // NO border
                1, // Put cursor in next line
                "L"   // Align right
        );
// PAYMENT TYPE
        $this->SetFont("helvetica", 'B', 7);
        $this->Cell(0, 0, $this->invoice->paymentType, 'TB', // TB border
                1, // Put cursor in next line
                "C"   // Align right
        );

// DUE DATE
        $this->SetFont("helvetica", 'B', 7);
        $this->cell(self::INVOICE_DATA_CELL_WIDTH, 0, 'Fecha Vencimiento', 1, 0, 'R', false, '', 1, false, '', 'C');
        $this->cell(self::INVOICE_DATA_CELL_WIDTH, 0, 'Pedido Nº', 1, 0, 'R', false, '', 1, false, '', 'C');
        $this->cell(self::TRANSACTION_ORDER_DT_WIDTH, 0, 'Fecha Pedido', 1, 0, 'R', false, '', 1, false, '', 'C');
        $this->cell(self::PAYMENT_TERM_WIDTH, 0, 'Condiciones de Pago', 1, 0, 'L', false, '', 1, false, '', 'C');
        $this->cell(self::CUSTOMER_ID_WIDTH, 0, 'Nº Cliente', 1, 0, 'R', false, '', 1, false, '', 'C');
        $this->cell(self::INVOICE_DATA_CELL_WIDTH, 0, 'Orden del Cliente', 1, 0, 'R', false, '', 1, false, '', 'C');
        $this->cell(self::AGENT_WIDTH, 0, 'Agente', 1, 0, 'R', false, '', 1, false, '', 'C');
        $this->cell(self::ZONE_WIDTH, 0, 'Zona', 1, 0, 'R', false, '', 1, false, '', 'C');
        $this->cell(self::TRANSPORT_WIDTH, 0, 'Transporte', 1, 1, 'R', false, '', 1, false, '', 'C');
        $this->SetFont("helvetica", null, 7);
        $this->cell(self::INVOICE_DATA_CELL_WIDTH, 0, date_format(new DateTime($this->invoice->dueDt), 'd/m/Y'), 1, 0, 'R', false, '', 1, false, '', 'C');
        $this->cell(self::INVOICE_DATA_CELL_WIDTH, 0, $this->invoice->orderNbr, 1, 0, 'R', false, '', 1, false, '', 'C');
        $this->cell(self::TRANSACTION_ORDER_DT_WIDTH, 0, date_format(new DateTime($this->invoice->transactionOrderDt), 'd/m/Y'), 1, 0, 'R', false, '', 1, false, '', 'C');
        $this->cell(self::PAYMENT_TERM_WIDTH, 0, $this->invoice->paymentTerm->name, 1, 0, 'L', false, '', 1, false, '', 'C');
        $this->cell(self::CUSTOMER_ID_WIDTH, 0, $this->invoice->customerParty->identifier, 1, 0, 'R', false, '', 1, false, '', 'C');
        $this->cell(self::INVOICE_DATA_CELL_WIDTH, 0, $this->invoice->customerOrderNbr, 1, 0, 'R', false, '', 1, false, '', 'C');
        $this->cell(self::AGENT_WIDTH, 0, $this->invoice->agent, 1, 0, 'R', false, '', 1, false, '', 'C');
        $this->cell(self::ZONE_WIDTH, 0, '', 1, 0, 'R', false, '', 1, false, '', 'C');
        $this->cell(self::TRANSPORT_WIDTH, 0, $this->invoice->transport, 1, 1, 'R', false, '', 1, false, '', 'C');

        $this->SetFont("helvetica", 'B', 7);
        $this->cell(self::INVOICE_DATA_CELL_WIDTH, 0, 'Régimen fiscal', 1, 0, 'L', false, '', 1, false, '', 'C');
        $strFiscalRegime = '';
        foreach ($this->invoice->cfdTaxRegimes as $taxRegime) {
            $strFiscalRegime .= $taxRegime->name . ',';
        }
        $this->SetFont("helvetica", null, 7);
        $this->cell(0, 0, substr($strFiscalRegime, 0, strlen($strFiscalRegime) - 1), 1, 1, 'L', false, '', 1, false, '', 'C');

        $this->SetFont("helvetica", 'B', 7);
        $this->cell(self::INVOICE_DATA_CELL_WIDTH, 0, 'Método de pago', 1, 0, 'L', false, '', 1, false, '', 'C');
        $this->SetFont("helvetica", null, 7);
        $this->cell((self::REAL_WIDTH - self::INVOICE_DATA_CELL_WIDTH * 2) / 2, 0, $this->invoice->paymentMethod, 1, 0, 'L', false, '', 1, false, '', 'C');
        $this->SetFont("helvetica", 'B', 7);
        $this->cell(self::INVOICE_DATA_CELL_WIDTH, 0, 'Nº cuenta pago', 1, 0, 'L', false, '', 1, false, '', 'C');
        $this->SetFont("helvetica", null, 7);
        $this->cell(0, 0, $this->invoice->paymentAcctNbr, 1, 1, 'L', false, '', 1, false, '', 'C');

        $this->ln();
// ITEM HEADER
        $this->SetFont("helvetica", 'B', 7);
        $this->cell(self::INVOICE_DATA_CELL_WIDTH, 0, 'Cantidad', 1, 0, 'R', false, '', 1, false, '', 'C');
        $this->cell(self::ITEM_CODE_WIDTH, 0, 'Clave Artículo', 1, 0, 'R', false, '', 1, false, '', 'C');
        $this->cell(self::ITEM_UOM_WIDTH, 0, 'Unidad', 1, 0, 'C', false, '', 1, false, '', 'C');
        $this->cell(self::ITEM_DESC_WIDTH, 0, 'Descripción', 1, 0, 'L', false, '', 1, false, '', 'C');
        $this->cell(self::CUSTOMER_ID_WIDTH, 0, 'Litros', 1, 0, 'R', false, '', 1, false, '', 'C');
        $this->cell(self::INVOICE_DATA_CELL_WIDTH, 0, 'Precio Unitario', 1, 0, 'R', false, '', 1, false, '', 'C');
        $this->cell(0, 0, 'Importe', 1, 1, 'R', false, '', 1, false, '', 'C');

        $this->Image(yii::getPathOfAlias('files') . DIRECTORY_SEPARATOR . 'castrol' . DIRECTORY_SEPARATOR . 'CAS_3D_RGB.png', 145, 16, 60);
    }

    public function Footer() {
        $this->SetFont("helvetica", "", 7);
        $this->Cell(0, 0, "ESTE DOCUMENTO ES UNA REPRESENTACION IMPRESA DE UN CFDI. - Página " . $this->getAliasNumPage() . ' de ' . $this->getAliasNbPages(), "T", // Draw top border
                0, // Put cursor in next line
                "L"   // Align left
        );
        if (SystemConfig::getValue(SystemConfig::RUN_MODE) != SystemConfig::RUN_MODE_PRODUCTION) {
            $this->SetFont("helvetica", 'B', 7);
            $this->SetTextColor(255, 0, 0);
            $this->Cell(0, 0, 'DEMO', '', // NO border
                    0, // Put cursor in next line
                    "R"   // Align right
            );
            $this->SetTextColor(0, 0, 0);
        }
    }

    private function pageBreak($force = false) {
        $this->AddPage('P', 'LETTER');
//        $this->SetY(82.5, true);
    }

    public function create(Cfd $invoice, $fname, $target = 'F') {
        $this->invoice = $invoice;

        $this->SetAuthor($invoice->vendor->name);
        $this->SetCreator(yii::app()->name);
        $this->SetAutoPageBreak(TRUE, 10);
        $this->setHeaderMargin(11);
        $this->setFooterMargin(10);
        $this->SetTopMargin(86.6);

        $this->AddPage();

        $this->SetFont("helvetica", null, 7);
        foreach ($this->invoice->cfdItems as $item) {
            $this->cell(self::INVOICE_DATA_CELL_WIDTH, 0, number_format($item->qty, 2), 1, 0, 'R', false, '', 1, false, '', 'C');
            $this->cell(self::ITEM_CODE_WIDTH, 0, $item->productCode, 1, 0, 'R', false, '', 1, false, '', 'C');
            $this->cell(self::ITEM_UOM_WIDTH, 0, $item->uom, 1, 0, 'C', false, '', 1, false, '', 'C');
            $this->cell(self::ITEM_DESC_WIDTH, 0, $item->description, 1, 0, 'L', false, '', 1, false, '', 'C');
            $this->cell(self::CUSTOMER_ID_WIDTH, 0, number_format($item->lts, 2), 1, 0, 'R', false, '', 1, false, '', 'C');
            $this->cell(self::INVOICE_DATA_CELL_WIDTH, 0, number_format($item->unitPrice, 2), 1, 0, 'R', false, '', 1, false, '', 'C');
            $this->cell(0, 0, number_format($item->amt, 2), 1, 1, 'R', false, '', 1, false, '', 'C');
        }

        $taxes = yii::app()->db->createCommand()
                ->select(array('name, rate, sum(amt) as amt'))
                ->from('CfdTax')
                ->where(array('and', 'Cfd_id = :id', 'local = 0', 'withHolding = 0'), array(':id' => $this->invoice->id))
                ->group(array('name', 'rate'))
                ->queryAll(true);

        if (count($taxes) != 0) {
            $doItAgain = true;
            while ($doItAgain) {
                $this->startTransaction();
                $start_page = $this->getPage();
                $this->SetFont("helvetica", 'B', 7);
                $this->Ln();
                $this->cell(self::TAX_FILLER_WIDTH, 0, '', 0, 0, 'R', false, '', 1, false, '', 'C');
                $this->cell(self::TAX_CELL_WIDTH, 0, 'Impuesto', 1, 0, 'L', false, '', 1, false, '', 'C');
                $this->cell(self::TAX_CELL_WIDTH, 0, 'Tasa', 1, 0, 'R', false, '', 1, false, '', 'C');
                $this->cell(self::TAX_CELL_WIDTH, 0, 'Importe', 1, 1, 'R', false, '', 1, false, '', 'C');

                foreach ($taxes as $tax) {
                    $this->cell(self::TAX_FILLER_WIDTH, 0, '', 0, 0, 'R', false, '', 1, false, '', 'C');
                    $this->SetFont("helvetica", 'B', 7);
                    $this->cell(self::TAX_CELL_WIDTH, 0, $tax['name'], 1, 0, 'L', false, '', 1, false, '', 'C');
                    $this->SetFont("helvetica", null, 7);
                    $this->cell(self::TAX_CELL_WIDTH, 0, number_format($tax['rate'], 2), 1, 0, 'R', false, '', 1, false, '', 'C');
                    $this->cell(self::TAX_CELL_WIDTH, 0, number_format($tax['amt'], 2), 1, 1, 'R', false, '', 1, false, '', 'C');
                }
                $end_page = $this->getPage();
                if ($end_page != $start_page) {
                    $this->rollbackTransaction(true);
                    $this->AddPage();
                } else {
                    $this->commitTransaction();
                    $doItAgain = false;
                }
            }
        }

//        $customsPermits = yii::app()->db->createCommand()
//                ->select(array('c.nbr', 'c.dt', 'c.office'))
//                ->from('CfdItem a')
//                ->leftJoin('CfdItem_has_CustomsPermit b', 'b.CfdItem_id = a.id')
//                ->leftJoin('CustomsPermit c', 'c.id = b.CustomsPermit_id')
//                ->where(array('and', 'a.Cfd_id = :id', 'c.nbr is not null'), array(':id' => $this->invoice->id))
//                ->group('c.nbr')
//                ->queryAll(true);

        $customsPermits = $this->invoice->getCustomsPermits();
        if ($customsPermits) {
            $this->SetFont("helvetica", null, 7);
            $doItAgain = true;
            while ($doItAgain) {
                $this->startTransaction();
                $start_page = $this->getPage();
                $this->SetFont("helvetica", 'B', 7);
                $this->Ln();
                $this->cell(self::TAX_FILLER_WIDTH, 0, '', 0, 0, 'R', false, '', 1, false, '', 'C');
                $this->cell(self::TAX_CELL_WIDTH, 0, 'Nº Pedimento', 1, 0, 'L', false, '', 1, false, '', 'C');
                $this->cell(self::CUSTOMS_OFFICE_WIDTH, 0, 'Aduana', 1, 0, 'L', false, '', 1, false, '', 'C');
                $this->cell(self::CUSTOMS_DT_WIDTH, 0, 'Fecha', 1, 1, 'R', false, '', 1, false, '', 'C');

                $this->SetFont("helvetica", null, 7);
                foreach ($customsPermits as $customsPermit) {
                    $this->cell(self::TAX_FILLER_WIDTH, 0, '', 0, 0, 'R', false, '', 1, false, '', 'C');
                    $this->cell(self::TAX_CELL_WIDTH, 0, $customsPermit['nbr'], 1, 0, 'L', false, '', 1, false, '', 'C');
                    $this->cell(self::CUSTOMS_OFFICE_WIDTH, 0, $customsPermit['office'], 1, 0, 'L', false, '', 1, false, '', 'C');
                    $this->cell(self::CUSTOMS_DT_WIDTH, 0, date_format(new DateTime($customsPermit['dt']), 'd/m/Y'), 1, 1, 'R', false, '', 1, false, '', 'C');
                }
                $end_page = $this->getPage();
                if ($end_page != $start_page) {
                    $this->rollbackTransaction(true);
                    $this->AddPage();
                } else {
                    $this->commitTransaction();
                    $doItAgain = false;
                }
            }
        }

        $notes = '';
        foreach ($this->invoice->annotations as $annotation) {
            $notes .= $annotation->note . ' ';
        }
        if ($notes) {
            $this->cell(0, 0, '', 0, 1, 'R', false, '', 1, false, '', 'C');
            while (strlen($notes) != 0) {
//            echo $originalString . PHP_EOL;
                $notes = $this->Write(0, $notes, null, false, 'L', true, 0, true);
            }
        }
        $this->cell(0, 0, '', 0, 1, 'L', false, '', 1, false, '', 'C');
        $this->cell(0, 0, 'Cadena original', 0, 1, 'L', false, '', 1, false, '', 'C');
        $this->SetFont("courier", "", 5);
        $originalString = $this->invoice->originalString;
        while (strlen($originalString) != 0) {
//            echo $originalString . PHP_EOL;
            $originalString = $this->Write(0, $originalString, null, false, 'L', true, 0, true);
        }

// Draw line
        if ($this->GetY() > 184.4)
            $this->AddPage();
//        echo $this->getY() . PHP_EOL;
        $this->SetY(-95, true);
//        echo $this->getY() . PHP_EOL;
        $this->SetFont("helvetica", "B", 7);
        $this->Cell(0, 0, "", "T", 1);

// SUBTOTAL
// FILLER
        $this->cell(self::SUBTOTAL_FILLER_WIDTH, 0, '', 0, 0, 'L', false, '', 1, false, '', 'C');
        $this->cell(self::PAYMENT_TERM_WIDTH, 0, 'SubTotal', 0, 0, 'L', false, '', 1, false, '', 'C');
        $this->SetFont("helvetica", null, 7);
        $this->cell(self::ITEM_AMT_WIDTH, 0, number_format($this->invoice->subTotal, 2), 0, 1, 'R', false, '', 1, false, '', 'C');

// DISCOUNTS
// FILLER
        $this->cell(self::SUBTOTAL_FILLER_WIDTH, 0, '', 0, 0, 'L', false, '', 1, false, '', 'C');
        $this->SetFont("helvetica", "B", 7);
        $this->cell(self::PAYMENT_TERM_WIDTH, 0, 'Descuentos', 0, 0, 'L', false, '', 1, false, '', 'C');
        $this->SetFont("helvetica", null, 7);
        $this->cell(self::ITEM_AMT_WIDTH, 0, number_format($this->invoice->discount, 2), 0, 1, 'R', false, '', 1, false, '', 'C');

// WITHHOLDINGS
// FILLER
        $this->cell(self::SUBTOTAL_FILLER_WIDTH, 0, '', 0, 0, 'L', false, '', 1, false, '', 'C');
        $this->SetFont("helvetica", "B", 7);
        $this->cell(self::PAYMENT_TERM_WIDTH, 0, 'Impuestos Federales Retenidos', 0, 0, 'L', false, '', 1, false, '', 'C');
        $this->SetFont("helvetica", null, 7);
        $this->cell(self::ITEM_AMT_WIDTH, 0, number_format(0, 2), 0, 1, 'R', false, '', 1, false, '', 'C');

// TAX
// FILLER
        $this->cell(self::SUBTOTAL_FILLER_WIDTH, 0, '', 0, 0, 'L', false, '', 1, false, '', 'C');
        $this->SetFont("helvetica", "B", 7);
        $this->cell(self::PAYMENT_TERM_WIDTH, 0, 'Impuestos Federales Trasladados', 0, 0, 'L', false, '', 1, false, '', 'C');
        $this->SetFont("helvetica", null, 7);
        $this->cell(self::ITEM_AMT_WIDTH, 0, number_format($this->invoice->tax, 2), 0, 1, 'R', false, '', 1, false, '', 'C');

// TOTAL
// FILLER
        $this->cell(self::SUBTOTAL_FILLER_WIDTH, 0, '', 0, 0, 'L', false, '', 1, false, '', 'C');
        $this->SetFont("helvetica", "B", 7);
        $this->cell(self::PAYMENT_TERM_WIDTH, 0, 'Total', 0, 0, 'L', false, '', 1, false, '', 'C');
        $this->SetFont("helvetica", null, 7);
        $this->cell(self::ITEM_AMT_WIDTH, 0, number_format($this->invoice->total, 2), 1, 1, 'R', false, '', 1, false, '', 'C');

// TOTAL IN WORDS
        $this->SetFont("helvetica", "B", 7);
        $this->cell(0, 0, $this->invoice->currency->plural . ' ' .
                yii::app()->string->num2letras($this->invoice->total, false, false) . ' con ' .
                substr(number_format($this->invoice->total, 2, ".", ""), strpos(number_format($this->invoice->total, 2, ".", ""), ".") + 1) . '/100', 'TB', 1, 'R', false, '', 1, false, '', 'C');
// CURRENCY
        if ($this->invoice->currency->code != 'MXP')
            $this->cell(0, 0, 'Moneda: ' . $this->invoice->currency->name . ' - Tipo de Cambio: ' . $this->invoice->exchangeRate, 'TB', 1, 'R', false, '', 1, false, '', 'C');
        else
            $this->cell(0, 0, '', 'TB', 1, 'R', false, '', 1, false, '', 'C');

// NOTICE
        $this->cell(0, 0, 'SI ESTA FACTURA NO ES CUBIERTA EN LA FECHA DE VENCIMIENTO CAUSARA UN INTERES DEL 3% MENSUAL', 'TB', 1, 'C', false, '', 1, false, '', 'C');
// NOTICE 2
        $this->SetFont("helvetica", null, 5);
        $this->cell(0, 0, 'Por este pagaré me (nos) obligo(amos) a cubrir incondicionalmente en la Ciudad de México, DF, a la orden de CASTROL MEXICO, S.A. DE C.V. la cantidad monetaria total de este documento a su fecha de vencimiento, valor recibido y aceptado a mi (nuestra) entera satisfacción.', 0, 1, 'C', false, '', 1, false, '', 'C');

        $this->Cell(0, 0, "", "", 1, "R");
        $this->Cell(0, 0, "", "", 1, "R");
        $this->Cell(0, 0, "", "", 1, "R");
        $this->Cell(0, 0, "", "", 1, "R");
        $this->Cell(0, 0, "SELLO, NOMBRE Y FIRMA DE LA PERSONA AUTORIZADA", "T", 1, "R");

// filler
        $this->cell(self::CBB_WIDTH, 0, '', 0, 0, 'L', false, '', 1, false, '', 'C');
        $this->SetFont("helvetica", "B", 7);
        $this->cell(self::FISCAL_WIDTH, 0, 'FOLIO FISCAL', 0, 0, 'L', false, '', 1, false, '', 'C');
        $this->SetFont("courier", "", 6);
        $this->cell(0, 0, $this->invoice->satStamp->uuid, 0, 1, 'L', false, '', 1, false, '', 'C');

        $this->cell(self::CBB_WIDTH, 0, '', 0, 0, 'L', false, '', 1, false, '', 'C');
        $this->SetFont("helvetica", "B", 7);
        $this->cell(self::FISCAL_WIDTH, 0, 'FECHA TIMBRADO', 0, 0, 'L', false, '', 1, false, '', 'C');
        $this->SetFont("courier", "", 6);
        $this->cell(0, 0, $this->invoice->satStamp->dttm, 0, 1, 'L', false, '', 1, false, '', 'C');

        $this->cell(self::CBB_WIDTH, 0, '', 0, 0, 'L', false, '', 1, false, '', 'C');
        $this->SetFont("helvetica", "B", 7);
        $this->cell(self::FISCAL_WIDTH, 0, 'Nº DE SERIE DEL CERTIFICADO SAT', 0, 0, 'L', false, '', 1, false, '', 'C');
        $this->SetFont("courier", "", 6);
        $this->cell(0, 0, $this->invoice->satStamp->certificate, 0, 1, 'L', false, '', 1, false, '', 'C');

        $this->cell(self::CBB_WIDTH, 0, '', 0, 0, 'L', false, '', 1, false, '', 'C');
        $this->SetFont("helvetica", "B", 7);
        $this->cell(self::FISCAL_WIDTH, 0, 'Nº DE SERIE DEL CERTIFICADO DEL EMISOR', 0, 0, 'L', false, '', 1, false, '', 'C');
        $this->SetFont("courier", "", 6);
        $this->cell(0, 0, $this->invoice->satCertificate->nbr, 0, 1, 'L', false, '', 1, false, '', 'C');

        $this->cell(self::CBB_WIDTH, 0, '', 0, 0, 'L', false, '', 1, false, '', 'C');
        $this->SetFont("helvetica", "B", 7);
        $this->cell(self::FISCAL_WIDTH, 0, 'SELLO DIGITAL DEL SAT', 0, 0, 'L', false, '', 1, false, '', 'C');
        $this->SetFont("courier", "", 6);
        $this->MultiCell(0, 0, $this->invoice->satStamp->stamp, 0, 'L');

        $this->cell(self::CBB_WIDTH, 0, '', 0, 0, 'L', false, '', 1, false, '', 'C');
        $this->SetFont("helvetica", "B", 7);
        $this->cell(self::FISCAL_WIDTH, 0, 'SELLO DIGITAL DEL EMISOR', 0, 0, 'L', false, '', 1, false, '', 'C');
        $this->SetFont("courier", "", 6);
        $this->MultiCell(0, 0, $this->invoice->seal, 0, 'L');

        $this->cell(self::CBB_WIDTH, 0, '', 0, 0, 'L', false, '', 1, false, '', 'C');
        $this->SetFont("helvetica", "B", 7);
        $this->MultiCell(self::FISCAL_WIDTH, 0, 'CADENA ORIGINAL DEL COMPLEMENTO DE CERTIFICACION DIGITAL DEL SAT', 0, 'L', false, 0);
        $this->SetFont("courier", "", 6);
        $this->MultiCell(0, 0, $this->invoice->satStamp->originalString, 0, 'L');

        // CBB
        $style = array(
            'border' => 0,
            'vpadding' => 0,
            'hpadding' => 0,
            'fgcolor' => array(0, 0, 0),
            'bgcolor' => false, //array(255,255,255)
            'module_width' => 1, // width of a single module in points
            'module_height' => 1 // height of a single module in points
        );
//        $this->SetY(-75.1);
        $this->write2DBarcode($this->invoice->cbb, "QRCODE,H", 10, 224, 45, 45, $style);
        return $this->Output($fname, $target);
    }

}

?>
