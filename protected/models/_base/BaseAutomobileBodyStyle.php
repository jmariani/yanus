<?php

/**
 * This is the model base class for the table "AutomobileBodyStyle".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "AutomobileBodyStyle".
 *
 * Columns in table "AutomobileBodyStyle" available as properties of the model,
 * followed by relations of table "AutomobileBodyStyle" available as properties of the model.
 *
 * @property integer $id
 * @property string $name
 *
 * @property Automobile[] $automobiles
 */
abstract class BaseAutomobileBodyStyle extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'AutomobileBodyStyle';
	}

	public static function label($n = 1) {
        return Yii::t('app', 'Automobile Body Style|Automobile Body Styles', $n);
	}

	public static function representingColumn() {
		return 'name';
	}

	public function rules() {
		return array(
			array('name', 'length', 'max'=>45),
			array('name', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, name', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'automobiles' => array(self::HAS_MANY, 'Automobile', 'AutomobileBodyStyle_id'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
                			'id' => yii::t('app', 'Id'),
                			'name' => yii::t('app', 'Name'),
                        			                        'automobiles' => yii::t('app', 'Automobiles'),
		);
	}

    public function defaultScope() {
        return array('order' => BaseAutomobileBodyStyle::representingColumn() . ' ASC');
    }

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('name', $this->name, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}