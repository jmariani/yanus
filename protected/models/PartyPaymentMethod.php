<?php

Yii::import('application.models._base.BasePartyPaymentMethod');

class PartyPaymentMethod extends BasePartyPaymentMethod {

    public function behaviors() {
        return array(
            'CTimestampBehavior' => array(
                'class' => 'zii.behaviors.CTimestampBehavior',
                'createAttribute' => 'effDt',
                'updateAttribute' => null
            ),
            'current' => array('class' => 'ext.CurrentBehavior',
                'idColumn' => array('Party_id')),
            'relatedsearch' => array(
                'class' => 'RelatedSearchBehavior',
                'relations' => array(
                    'partyCustomerId' => 'party.customerId.value',
                    'partyName' => 'party.primaryName.value'
//                            'location' => 'device.location.description',
                // Field where search value is different($this->deviceid)
//                            'fieldwithdifferentsearchvalue' => array(
//                                'field' => 'device.displayname',
//                                'searchvalue' => 'deviceid'
//                            ),
                // Next line describes a field we do not search,
                // but we define it here for convienience
//                            'mylocalreference' => 'field.very.far.away.in.the.relation.tree',
                ),
            ),
        );
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function scopes() {
        $scopes = parent::scopes();
        $scopes['active'] = array('condition' => $this->getTableAlias(false, false) . '.active = 1');
        return $scopes;
    }

    public function search() {
        $alias = $this->getTableAlias(true, false) . ".";

        $criteria = new CDbCriteria;

        $criteria->compare($alias . 'id', $this->id);
        $criteria->compare($alias . 'method', $this->method, true);
        $criteria->compare($alias . 'bankAcct', $this->bankAcct, true);
        $criteria->compare($alias . 'active', $this->active);
        $criteria->compare($alias . 'effDt', $this->effDt, true);
        $criteria->compare($alias . 'Party_id', $this->Party_id);
        $criteria->with = array('party', 'party.customerId', 'party.primaryName');

        $sort = new CSort();
        $sort->defaultOrder = 'primaryName.value ASC';
        $sort->attributes = array(
            'partyCustomerId' => array(
                'asc' => 'CAST(customerId.value as SIGNED) ASC',
                'desc' => 'CAST(customerId.value as SIGNED) DESC',
            ),
            'partyName' => array(
                'asc' => 'party.primaryName.value ASC, CAST(customerId.value as SIGNED)ASC',
                'desc' => 'party.primaryName.value DESC, CAST(customerId.value as SIGNED) DESC',
            ),
            '*',
        );
        return $this->relatedSearch(
                        $criteria, array(
                    'sort' => $sort,
                    'pagination' => array('pageSize' => 20),
                        )
        );
//		return new CActiveDataProvider($this, array(
//			'criteria' => $criteria,
//                        'pagination' => array('pageSize' => Yii::app()->user->getState('pageSize', Yii::app()->params['defaultPageSize'])),
//                        'sort' => array(
//                            'defaultOrder' => array(
//                                $this->representingColumn() => CSort::SORT_ASC
//                            )
//                        )
//		));
    }

}