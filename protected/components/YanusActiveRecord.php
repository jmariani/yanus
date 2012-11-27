<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EEAVActiveRecord
 *
 * @author jmariani
 */
//class EAVActiveRecord extends CActiveRecord{
class YanusActiveRecord extends CActiveRecord {

    private $_eav = array();

    public function __set($name, $value) {
        // Find code on code catalog
        if (EavCode::model()->find('code = :code', array(':code' => strtolower($name))))
            $this->_eav[strtoupper($name)] = $value;
        else // Find not found continue with standard __set processing
            parent::__set($name, $value);
    }

    public function afterSave($event) {
        foreach ($this->_eav as $key => $value) {
            if ($this->isNewRecord)
                $char = new Eav();
            else {
                $char = Eav::model()->find('objectName = :name and objectId = :id and code = :code',
                        array(':name' => __CLASS__ , ':id' => $this->id, ':code' => strtolower($key)));
                if (!$char)
                    $char = new Eav();
            }
            $char->objectName = __CLASS__;
            $char->objectId = $this->id;
            $char->code = strtolower($key);
            $char->value = $value;
            $char->save();
        }
        return parent::afterSave();
    }

}

?>
