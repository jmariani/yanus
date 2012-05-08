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
    * text representation of value
    *
    * @var mixed
    */
    public $text;

    /**
    * html representation of value
    *
    * @var mixed
    */
    public $html;

    /**
    * text when value not found in array
    *
    * @var mixed
    */
    public $undefinedText = 'undefined';

    /**
    * populate text and html properties
    *
    * @param mixed $event
    */
    public function afterFind($event)
    {
        $this->populateProperties();
//        if(empty($this->attribute)) throw new CException('Empty attribute property');
//        if(!$this->owner->hasAttribute($this->attribute)) throw new CException('Model '.get_class($this->owner).' does not have attribute '.$this->attribute);
//        $key = $this->owner->getAttribute($this->attribute);
//        $data = $this->data();
//        $this->text = $this->getText($key);
//        $this->html = $this->getHtml($key);
        return parent::afterFind($event);
    }

        /**
    * populate text and html properties
    *
    * @param mixed $event
    */
    public function afterSave($event) {
        $this->populateProperties();
//        if(empty($this->attribute)) throw new CException('Empty attribute property');
//        if(!$this->owner->hasAttribute($this->attribute)) throw new CException('Model '.get_class($this->owner).' does not have attribute '.$this->attribute);
//        $key = $this->owner->getAttribute($this->attribute);
//        $data = $this->data();
//        $this->text = $this->getText($key);
//        $this->html = $this->getHtml($key);
        return parent::beforeSave($event);
    }

    /**
    * returns array of key => text. Usefull for dropdown list.
    *
    */
    public function getList()
    {
        return array_map(array($this, 'getTextByValue'), $this->data());
    }

    /**
    * returns array of key => html.
    *
    */
    public function getListHtml()
    {
        return array_map(array($this, 'getHtmlByValue'), $this->data());
    }

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
    public function data()
    {
        return array();
    }

    public function getText($key)
    {
        $data = $this->data();
        if(array_key_exists($key, $data)) {
            return $this->getTextByValue($data[$key]);
        } else {
            return $this->undefinedText;
        }
    }

    public function getHtml($key)
    {
        $data = $this->data();
        if(array_key_exists($key, $data)) {
            return $this->getHtmlByValue($data[$key]);
        } else {
            return $this->undefinedText;
        }
    }

    // ------------------ PRIVATE SECTION ---------------------

    private function getHtmlByValue($value)
    {
        if(is_array($value)) {
            $tokens = array();
            foreach($value as $k => $v) {
                $tokens['{'.$k.'}'] = $v;
            }
            return strtr($this->htmlTemplate, $tokens);
        } else {
            return strval($value);
        }
    }

    private function getTextByValue($value)
    {
        if(is_array($value)) {
            if(array_key_exists('text', $value)) {
                return $value['text'];
            } else {
                return $this->undefinedText;
            }
        } else {
            return strval($value);
        }
    }

    private function populateProperties() {
        if(empty($this->attribute)) throw new CException('Empty attribute property');
        if(!$this->owner->hasAttribute($this->attribute)) throw new CException('Model '.get_class($this->owner).' does not have attribute '.$this->attribute);
        $key = $this->owner->getAttribute($this->attribute);
        $data = $this->data();
        $this->text = $this->getText($key);
        $this->html = $this->getHtml($key);
    }
}