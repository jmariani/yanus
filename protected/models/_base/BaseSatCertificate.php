<?php

/**
 * This is the model base class for the table "SatCertificate".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "SatCertificate".
 *
 * Columns in table "SatCertificate" available as properties of the model,
 * followed by relations of table "SatCertificate" available as properties of the model.
 *
 * @property integer $id
 * @property string $nbr
 * @property string $serial
 * @property string $validFrom
 * @property string $validTo
 * @property string $name
 * @property string $rfc
 * @property string $pem
 * @property string $keyPem
 * @property string $keyPassword
 * @property string $issuerName
 *
 * @property Cfd[] $cfds
 * @property Cfd[] $cfds1
 * @property Party[] $parties
 */
abstract class BaseSatCertificate extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'SatCertificate';
	}

	public static function label($n = 1) {
        return Yii::t('app', 'SAT Certificate|SAT Certificates', $n);
	}

	public static function representingColumn() {
		return 'nbr';
	}

	public function rules() {
		return array(
			array('nbr, keyPassword', 'length', 'max'=>45),
			array('serial', 'length', 'max'=>50),
			array('rfc', 'length', 'max'=>13),
			array('validFrom, validTo, name, pem, keyPem, issuerName', 'safe'),
			array('nbr, serial, validFrom, validTo, name, rfc, pem, keyPem, keyPassword, issuerName', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, nbr, serial, validFrom, validTo, name, rfc, pem, keyPem, keyPassword, issuerName', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'cfds' => array(self::HAS_MANY, 'Cfd', 'dtsSatCertificate_id'),
			'cfds1' => array(self::HAS_MANY, 'Cfd', 'SatCertificate_id'),
			'parties' => array(self::MANY_MANY, 'Party', 'Party_has_SatCertificate(SatCertificate_id, Party_id)'),
		);
	}

	public function pivotModels() {
		return array(
			'parties' => 'PartyHasSatCertificate',
		);
	}

	public function attributeLabels() {
		return array(
                			'id' => yii::t('app', 'Id'),
                			'nbr' => yii::t('app', 'Nbr'),
                			'serial' => yii::t('app', 'Serial'),
                			'validFrom' => yii::t('app', 'Valid From'),
                			'validTo' => yii::t('app', 'Valid To'),
                			'name' => yii::t('app', 'Name'),
                			'rfc' => yii::t('app', 'Rfc'),
                			'pem' => yii::t('app', 'Pem'),
                			'keyPem' => yii::t('app', 'Key Pem'),
                			'keyPassword' => yii::t('app', 'Key Password'),
                			'issuerName' => yii::t('app', 'Issuer Name'),
                        			                        'cfds' => yii::t('app', 'Cfds'),
                        			                        'cfds1' => yii::t('app', 'Cfds1'),
                        			                        'parties' => yii::t('app', 'Parties'),
		);
	}

    public function defaultScope() {
        return array('order' => $this->getTableAlias(false, false) . '.' . BaseSatCertificate::representingColumn() . ' ASC');
    }

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('nbr', $this->nbr, true);
		$criteria->compare('serial', $this->serial, true);
		$criteria->compare('validFrom', $this->validFrom, true);
		$criteria->compare('validTo', $this->validTo, true);
		$criteria->compare('name', $this->name, true);
		$criteria->compare('rfc', $this->rfc, true);
		$criteria->compare('pem', $this->pem, true);
		$criteria->compare('keyPem', $this->keyPem, true);
		$criteria->compare('keyPassword', $this->keyPassword, true);
		$criteria->compare('issuerName', $this->issuerName, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
                        'pagination' => array('pageSize' => Yii::app()->user->getState('pageSize', Yii::app()->params['defaultPageSize'])),
		));
	}
}