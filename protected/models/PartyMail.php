<?php

Yii::import('application.models._base.BasePartyMail');

class PartyMail extends BasePartyMail {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function behaviors() {
        return array_merge(array(
//            'Type' => array(
//                'class' => 'PartyMailTypeBehavior',
//                'attribute' => 'type',
//            ),
                    'CTimestampBehavior' => array(
                        'class' => 'zii.behaviors.CTimestampBehavior',
                        'createAttribute' => 'effDt',
                        'updateAttribute' => null
                    ),
                    'relatedsearch' => array(
                        'class' => 'RelatedSearchBehavior',
                        'relations' => array(
                            'partyCustomerId' => 'party.customerId.value',
                            'partyName' => 'party.primaryName.value',
//                            'location' => 'device.location.description',
                        // Field where search value is different($this->deviceid)
//                            'fieldwithdifferentsearchvalue' => array(
//                                'field' => 'device.displayname',
//                                'searchvalue' => 'deviceid'
//                            ),
                        // Next line describes a field we do not search,
                        // but we define it here for convienience
                            'customerId' => 'party.customerId.value',
                            'name' => 'party.primaryName.value',
                        ),
                    ),
                        ), parent::behaviors());
    }

    public function rules() {
        $rules = parent::rules();
        $rules[] = array('partyCustomerId, partyName', 'safe', 'on' => 'search');
        $rules[] = array('value', 'email');
        return $rules;
    }

    public function scopes() {
        $scopes = parent::scopes();
        $scopes['active'] = array('condition' => $this->getTableAlias(false, false) . '.active = 1');
//        $types = new PartyIdentifierTypeBehavior();
//        foreach ($types->getList() as $type => $label) {
//            $scopes[$type] = array('condition' => $this->getTableAlias(false, false) . '.type = "' . $type . '"');
//        }
        return $scopes;
    }

    public function search() {
        $alias = $this->getTableAlias(true, false) . ".";

        $criteria = new CDbCriteria;

        $criteria->compare($alias . 'id', $this->id);
        $criteria->compare($alias . 'value', $this->value, true);
        $criteria->compare($alias . 'active', $this->active);
        $criteria->compare($alias . 'effDt', $this->effDt, true);
        $criteria->compare($alias . 'Party_id', $this->Party_id);
        $criteria->compare($alias . 'PartyMailType_id', $this->PartyMailType_id);
        $criteria->with = array('party', 'party.customerId', 'party.primaryName');

        $sort = new CSort();
//        $sort->defaultOrder = 'primaryName.value ASC';
//        $sort->attributes = array(
//            'partyCustomerId' => array(
//                'asc' => 'CAST(customerId.value as SIGNED) ASC',
//                'desc' => 'CAST(customerId.value as SIGNED) DESC',
//            ),
//            'partyName' => array(
//                'asc' => 'party.primaryName.value ASC, CAST(customerId.value as SIGNED)ASC',
//                'desc' => 'party.primaryName.value DESC, CAST(customerId.value as SIGNED) DESC',
//            ),
//            '*',
//        );
        $sort->defaultOrder = 'primaryName.value ASC';
        $sort->attributes = array(
            'customerId' => array(
                'asc' => 'CAST(customerId as SIGNED) ASC',
                'desc' => 'CAST(customerId as SIGNED) DESC',
            ),
            'name' => array(
                'asc' => 'name ASC, CAST(customerId as SIGNED)ASC',
                'desc' => 'name DESC, CAST(customerId as SIGNED) DESC',
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