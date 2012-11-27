<?php

class EavBehavior extends CActiveRecordBehavior {

    public $_eav = array();

    public function __set($name, $value) {
        // Find code
        error_log('Hello! ' . $name);

        if (EavCode::model()->find('code = :code', array(':code' => strtolower($name)))) {
            $this->_eav[strtoupper($name)] = $value;
        } else
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

//    public function current($date = null, $column = 'effDt') {
////    echo $column;
////    echo $date;
//        if (!$date)
//            $date = date(DateTime::ISO8601);
//        $this->Owner->getDbCriteria()->mergeWith(array(
//            'order' => $this->owner->getTableAlias(false, false) . '.' . $column . ' DESC',
//            'condition' => $this->owner->getTableAlias(false, false) . '.' . $column . ' <= :date',
//            'params' => array(':date' => $date),
//            'limit' => 1
//        ));
//        return $this->Owner;
//    }
//
}

?>
