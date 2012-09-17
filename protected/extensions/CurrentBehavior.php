<?php

class CurrentBehavior extends CActiveRecordBehavior {

  public $config;

  public function current($date = null, $column = 'effDt') {
//    echo $column;
//    echo $date;
    if (!$date)
      $date = date(DateTime::ISO8601);
    $this->Owner->getDbCriteria()->mergeWith(array(
        'order' => $this->owner->getTableAlias(false, false) . '.' . $column . ' DESC',
        'condition' => $this->owner->getTableAlias(false, false) . '.' . $column . ' <= :date',
        'params' => array(':date' => $date),
        'limit' => 1
    ));
    return $this->Owner;
  }

}

?>
