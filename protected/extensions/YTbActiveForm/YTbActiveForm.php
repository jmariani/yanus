<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
Yii::import('ext.YTbActiveForm.input.YTbInput');

/**
 * Description of YTbActiveForm
 *
 * @author jmariani
 */
class YTbActiveForm extends TbActiveForm {

    /**
     * Renders a JUI datepicker field row.
     * @param CModel $model the data model
     * @param string $attribute the attribute
     * @param array $htmlOptions additional HTML attributes. 'events' and 'options' key specify the events
     * and configuration options of datepicker respectively.
     * @return string the generated row
     * @since 1.0.2 Booster
     */
    public function juiDatepickerRow($model, $attribute, $htmlOptions = array()) {
        return $this->inputRow(YTbInput::TYPE_JUIDATEPICKER, $model, $attribute, null, $htmlOptions);
    }

}

?>
