<?php
/*
* Display text/html representation of attribute value
* @author Vitaliy Potapov <noginsk@rambler.ru>
*/
class ModelAttributesBehavior extends CActiveRecordBehavior
{
    /**
    * name of attribute that holds value
    *
    * @var mixed
    */
    public $attributeTable;

    /**
     * PHP getter magic method.
     * This method is overridden so that AR attributes can be accessed like properties.
     * @param string $name property name
     * @return mixed property value
     * @see getAttribute
     */
    public function __get($name) {
        error_log($name);
        try {
            return parent::__get($name);
        } catch (Exception $e) {
            foreach ($this->{$this->attributeTable} as $modelAttribute) {
                if ($modelAttribute->code == strtoupper($name)) {
                    return $modelAttribute->value;
                }
            }
            throw new CException($e->getMessage());
        }
    }
}