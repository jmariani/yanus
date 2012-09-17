<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Manufacturers
 *
 * @author jmariani
 */
class Manufacturer extends Party {

    // Scope functions
    public function defaultScope() {
        $manufacturer = Industry::model()->find('name = :name', array(':name' => 'Automotriz'));
        $this->getDbCriteria()->mergeWith(array(
            'condition' => 'Industry_id = ' . $manufacturer->id,
        ));
        return $this;
    }
}

?>
