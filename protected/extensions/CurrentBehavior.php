<?php

class CurrentBehavior extends CActiveRecordBehavior {

    public $config;
    public $idColumn;

    public function current($date = null, $column = 'effDt', $idColumn = null) {

//    echo $column;
//    echo $date;
        if (!$date)
            $date = new CDbExpression('now()');

//            $date = date(DateTime::ISO8601);


        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";

        $alias = substr(str_shuffle($chars), 0, 8);

        if (!$idColumn)
            $idColumn = $this->idColumn;
        $criteria = new CDbCriteria();
        $criteria->select = 'max(' . $alias . '.' . $column . ')';
        $criteria->condition = $alias . '.' . $column . " <= $date ";

        $_idColumns = array();
        $_idColumn = ($idColumn ? : $this->idColumn);
        if (!is_array($_idColumn))
            $_idColumns[] = $_idColumn;
        else
            $_idColumns = $_idColumn;

        foreach ($_idColumns as $__idColumn) {
            $criteria->condition .= ' and ' . $alias . ".$__idColumn = " . $this->owner->getTableAlias(false, false) . ".$__idColumn";
        }

        $subQuery = $this->Owner->getCommandBuilder()->createFindCommand($this->Owner->getTableSchema(), $criteria, $alias)->getText();

        $criteria = $this->Owner->getDbCriteria()->mergeWith(array(
            'condition' => $this->owner->getTableAlias(false, false) . '.' . $column . ' = (' . $subQuery . ')',
                ));
        return $this->Owner;
    }

}

?>
