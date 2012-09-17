<?php

class CurrentBehavior extends CActiveRecordBehavior {

    public $config;

//  public function current($date = null, $column = 'effDt') {
    public function current($column = 'effDt') {
        $this->Owner->getDbCriteria()->mergeWith(array(
            'order' => $column . ' DESC',
            'condition' => $this->Owner->tableAlias . '.' . $column . ' <= NOW()',
            'limit' => 1
        ));
        return $this->Owner;
    }

}

?>
