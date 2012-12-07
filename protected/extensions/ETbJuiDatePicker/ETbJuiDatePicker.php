<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ETbJuiDatePicker
 *
 * @author jmariani
 */
class ETbJuiDatePicker {

    //put your code here
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
        return $this->inputRow(TbInput::TYPE_JUIDATEPICKER, $model, $attribute, null, $htmlOptions);
    }

    /**
     * Creates an input row of a specific type.
     * @param string $type the input type
     * @param CModel $model the data model
     * @param string $attribute the attribute
     * @param array $data the data for list inputs
     * @param array $htmlOptions additional HTML attributes
     * @return string the generated row
     */
    public function inputRow($type, $model, $attribute, $data = null, $htmlOptions = array()) {
        ob_start();
        Yii::app()->controller->widget($this->getInputClassName(), array(
            'type' => $type,
            'form' => $this,
            'model' => $model,
            'attribute' => $attribute,
            'data' => $data,
            'htmlOptions' => $htmlOptions,
        ));
        return ob_get_clean();
    }

    /**
     * Returns the input widget class name suitable for the form.
     * @return string the class name
     */
    protected function getInputClassName() {
        if (isset($this->input))
            return $this->input;
        else {
            switch ($this->type) {
                case self::TYPE_HORIZONTAL:
                    return self::INPUT_HORIZONTAL;
                    break;

                case self::TYPE_INLINE:
                    return self::INPUT_INLINE;
                    break;

                case self::TYPE_SEARCH:
                    return self::INPUT_SEARCH;
                    break;

                case self::TYPE_VERTICAL:
                default:
                    return self::INPUT_VERTICAL;
                    break;
            }
        }
    }

}

?>
