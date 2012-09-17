<?php

Yii::import('application.models._base.BasePemexPreInvoice');

class PemexPreInvoice extends BasePemexPreInvoice {

    public $pemexPreInvoiceFile;

    public $items = array(); // Array of PemexPreInvoiceItem()

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function afterSave() {
        if ($this->isNewRecord) {
            foreach ($this->items as $item) {
                $item->PemexPreInvoice_id = $this->id;
                $item->save();
            }
        }
        return parent::afterSave();
    }

    public function loadFromFile($fileName) {
        libxml_use_internal_errors(true);
        $xml = @simplexml_load_file($fileName);
        if (!$xml) {
            $errors = array();
            foreach (libxml_get_errors() as $error) {
                $errors[] = yii::t('app', 'XML syntax error') . ': ' . yii::t('libxml_error', $error->message) . ' ' . yii::t('app', 'at line {line}', array('{line}' => $error->line));
            }
            $this->addErrors(array('pemexPreInvoiceFile' => $errors));
            return false;
        } else {
            $addenda = $xml->Addenda;
            if (!$addenda) {
                $this->addError('pemexPreInvoiceFile', yii::t('app', 'File is not a valid Pemex Pre Invoice. Node "Addenda" not found'));
                return false;
            } else {
                $aAddenda = explode("|", $addenda);
                $this->poNbr = $aAddenda[1];
                $this->copade = $aAddenda[0];
                $this->addenda = $addenda;

                foreach ($xml->children() as $child) {
                    switch ($child->getName()) {
                        case 'Addenda':
                            break;
                        case 'Conceptos':
                            foreach ($child->children() as $item) {
                                $pemexPreinvoiceItem = new PemexPreInvoiceItem();
                                foreach ($item->attributes() as $aName => $aValue) {
                                    switch ($aName) {
                                        case 'cantidad':
                                            $pemexPreinvoiceItem->qty = (float)$aValue;
                                            break;
                                        case 'descripcion':
                                            $pemexPreinvoiceItem->description = $aValue;
                                            break;
                                        case 'importe':
                                            $pemexPreinvoiceItem->amount = (float)$aValue;
                                            break;
                                        case 'unidad':
                                            $pemexPreinvoiceItem->uom = $aValue;
                                            break;
                                        case 'valorUnitario':
                                            $pemexPreinvoiceItem->unitPrice = (float)$aValue;
                                            break;
                                    }
                                }
                                $this->items[] = $pemexPreinvoiceItem;
                            }
                            break;
                    }
                }
                return $this->save();
//                foreach ($items as $item) {
//                    $item->PemexPreInvoice_id = $this->id;
//                    $item->save();
//                }
            }
        }
    }

    public function rules() {
        $rules = array();
        $rules[] = array('pemexPreInvoiceFile', 'file', 'allowEmpty' => false, 'types' => 'xml', 'on' => 'upload');
        $rules[] = array('pemexPreInvoiceFile', 'ext.isXmlValidator', 'on' => 'upload');
        $rules[] = array('addenda', 'unique', 'allowEmpty' => false);
        return array_merge($rules, parent::rules());
    }
}