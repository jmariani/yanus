<?php

/**
 * This is the model base class for the table "PaymentMethod".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "PaymentMethod".
 *
 * Columns in table "PaymentMethod" available as properties of the model,
 * followed by relations of table "PaymentMethod" available as properties of the model.
 *
 * @property integer $id
 * @property string $name
 * @property string $bankAcctNbr
 *
 * @property PartyHasPaymentMethod[] $partyHasPaymentMethods
 */
abstract class BasePaymentMethod extends EAVActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'PaymentMethod';
	}

	public static function label($n = 1) {
        return Yii::t('app', 'Payment Method|Payment Methods', $n);
	}

	public static function representingColumn() {
		return 'name';
	}

	public function relations() {
		$relations = array(
			'partyHasPaymentMethods' => array(self::HAS_MANY, 'PartyHasPaymentMethod', 'PaymentMethod_id'),
		);
                return array_merge($relations, parent::relations());
	}
	public function rules() {
		return array(
			array('name, bankAcctNbr', 'safe'),
			array('name, bankAcctNbr', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, name, bankAcctNbr', 'safe', 'on'=>'search'),
		);
	}
	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('name', $this->name, true);
		$criteria->compare('bankAcctNbr', $this->bankAcctNbr, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
                        'pagination' => array('pageSize' => Yii::app()->user->getState('pageSize', Yii::app()->params['defaultPageSize'])),
		));
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
                			'id' => yii::t('app', 'Id'),
                			'name' => yii::t('app', 'Name'),
                			'bankAcctNbr' => yii::t('app', 'Bank Acct Nbr'),
                        			                        'partyHasPaymentMethods' => yii::t('app', 'Party Has Payment Methods'),
		);
	}
}