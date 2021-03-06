<?php

/**
 * This is the model base class for the table "MySuiteConfig".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "MySuiteConfig".
 *
 * Columns in table "MySuiteConfig" available as properties of the model,
 * and there are no model relations.
 *
 * @property integer $id
 * @property string $entity
 * @property string $requestor
 * @property string $wsdl
 * @property string $country
 * @property string $userName
 * @property string $runMode
 *
 */
abstract class BaseMySuiteConfig extends EAVActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'MySuiteConfig';
	}

	public static function label($n = 1) {
        return Yii::t('app', 'My Suite Config|My Suite Configs', $n);
	}

	public static function representingColumn() {
		return 'entity';
	}

	public function relations() {
		$relations = array(
		);
                return array_merge($relations, parent::relations());
	}
	public function rules() {
		return array(
			array('entity, requestor, country, userName, runMode', 'length', 'max'=>45),
			array('wsdl', 'safe'),
			array('entity, requestor, wsdl, country, userName, runMode', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, entity, requestor, wsdl, country, userName, runMode', 'safe', 'on'=>'search'),
		);
	}
	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('entity', $this->entity, true);
		$criteria->compare('requestor', $this->requestor, true);
		$criteria->compare('wsdl', $this->wsdl, true);
		$criteria->compare('country', $this->country, true);
		$criteria->compare('userName', $this->userName, true);
		$criteria->compare('runMode', $this->runMode, true);

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
                			'entity' => yii::t('app', 'Entity'),
                			'requestor' => yii::t('app', 'Requestor'),
                			'wsdl' => yii::t('app', 'Wsdl'),
                			'country' => yii::t('app', 'Country'),
                			'userName' => yii::t('app', 'User Name'),
                			'runMode' => yii::t('app', 'Run Mode'),
		);
	}
}