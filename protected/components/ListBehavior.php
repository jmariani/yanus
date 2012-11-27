<?php
/*
* Display text/html representation of attribute value
* @author Vitaliy Potapov <noginsk@rambler.ru>
*/
abstract class ListBehavior extends CActiveRecordBehavior
{
    /**
    * name of attribute that holds value
    *
    * @var mixed
    */
    public $attribute;

    /**
    * template for html value. All tokens are keys of array defined in method data()
    *
    * @var mixed
    */
    public $htmlTemplate = '<span style="color: {color}">{text}</span>';

    /**
    * text when value not found in array
    *
    * @var mixed
    */
    public $undefinedText = 'undefined';

    /**
    * returns array of values related to each key. To be overwritten in descendants
    * Example:
    *  return array(
    *        self::CREATED          => array('text' => 'Created',     'color' => 'gray'),
    *        self::CONFIRMED        => array('text' => 'Confirmed',   'color' => 'green'),
    *        self::CANCELLED        => array('text' => 'Cancelled',   'color' => 'red'),
    *    );
    *
    */
    abstract public function data();

    /**
    * returns text representation of attribute
    *
    */
    public function getText()
    {
        $attr = $this->getAttributeValue();
        $data = $this->data();
        if(array_key_exists($attr, $data)) {
            return $this->extractText($data[$attr]);
        } else {
            return $this->undefinedText;
        }
    }

    /**
    * return html representation of attribute
    *
    */
    public function getHtml()
    {
        $attr = $this->getAttributeValue();
        $data = $this->data();
        if(array_key_exists($attr, $data)) {
            return $this->extractHtml($data[$attr]);
        } else {
            return $this->undefinedText;
        }
    }

    /**
    * returns array of key => text. Usefull for dropdown list.
    *
    */
    public function getList()
    {
        return array_map(array($this, 'extractText'), $this->data());
    }

    /**
    * returns array of key => html.
    *
    */
    public function getListHtml()
    {
        return array_map(array($this, 'extractHtml'), $this->data());
    }

    // ------------------ PRIVATE SECTION ---------------------
    /**
    * returns text by row from array in data() method
    *
    * @param mixed $value
    * @return string
    */
    private function extractText($textOrArray)
    {
        if(is_array($textOrArray)) {
            if(array_key_exists('text', $textOrArray)) {
                return $textOrArray['text'];
            } else {
                return $this->undefinedText;
            }
        } else {
            return strval($textOrArray);
        }
    }

    /**
    * returns text by row from array in data() method
    */
    private function extractHtml($textOrArray)
    {
        if(is_array($textOrArray)) {
            $tokens = array();
            foreach($textOrArray as $k => $v) {
                $tokens['{'.$k.'}'] = $v;
            }
            return strtr($this->htmlTemplate, $tokens);
        } else {
            return strval($textOrArray);
        }
    }

    /**
    * returns model's attribute value
    *
    */
    private function getAttributeValue()
    {
        if(empty($this->attribute)) throw new CException('Empty attribute property');
        if(!$this->owner->hasAttribute($this->attribute)) throw new CException('Model '.get_class($this->owner).' does not have attribute '.$this->attribute);
        return $this->owner->getAttribute($this->attribute);
    }
}