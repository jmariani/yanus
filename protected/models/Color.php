<?php

Yii::import('application.models._base.BaseColor');

class Color extends BaseColor {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function notAvailableAsAutomobileInteriorColor($automobileId = null) {
        $interiorColors = AutomobileAvailableColor::model()->active()->availableAsInteriorColor()->findAll('Automobile_id = :id', array(':id' => $automobileId));

        $idList = array();
        foreach ($interiorColors as $interiorColor) {
            $idList[] = $interiorColor->Color_id;
        }
        if (is_null($automobileId)) {
            $this->getDbCriteria()->mergeWith(array(
                'condition' => '1=0'
            ));
        } elseif (count($idList) != 0) {
            $this->getDbCriteria()->mergeWith(array(
                'condition' => 'id not in (' . implode(',', $idList) . ')'
            ));
        }
        return $this;
    }
    public function notAvailableAsAutomobileExteriorColor($automobileId = null) {
        $exteriorColors = AutomobileAvailableColor::model()->active()->availableAsExteriorColor()->findAll('Automobile_id = :id', array(':id' => $automobileId));

        $idList = array();
        foreach ($exteriorColors as $exteriorColor) {
            $idList[] = $exteriorColor->Color_id;
        }
        if (is_null($automobileId)) {
            $this->getDbCriteria()->mergeWith(array(
                'condition' => '1=0'
            ));
        } elseif (count($idList) != 0) {
            $this->getDbCriteria()->mergeWith(array(
                'condition' => 'id not in (' . implode(',', $idList) . ')'
            ));
        }
        return $this;
    }

    public function scopes() {
        $scopes = parent::scopes();
        $scopes['active'] = array('condition' => $this->getTableAlias(false, false) . '.active = 1');
        return $scopes;
    }

}