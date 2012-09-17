<?php

/**
 * This is the model base class for the table "CfdTaxRegime".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "CfdTaxRegime".
 *
 * Columns in table "CfdTaxRegime" available as properties of the model,
 * followed by relations of table "CfdTaxRegime" available as properties of the model.
 *
 * @property integer $id
 * @property integer $Cfd_id
 * @property string $name
 *
 * @property Cfd $cfd
 */
abstract class BaseCfdTaxRegime extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'CfdTaxRegime';
	}

	public static function label($n = 1) {
        return Yii::t('app', 'Cfd Tax Regime|Cfd Tax Regimes', $n);
	}

	public static function representingColumn() {
		return 'name';
	}

	public function rules() {
		return array(
			array('Cfd_id', 'required'),
			array('Cfd_id', 'numerical', 'integerOnly'=>true),
			array('name', 'safe'),
			array('name', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, Cfd_id, name', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'cfd' => array(self::BELONGS_TO, 'Cfd', 'Cfd_id'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
                			'id' => yii::t('app', 'Id'),
                        			                        'Cfd_id' => yii::t('app', 'Cfd'),
                			'name' => yii::t('app', 'Name'),
                        			                        'cfd' => yii::t('app', 'Cfd'),
		);
	}

    public function defaultScope() {
        return array('order' => $this->getTableAlias(false, false) . '.' . BaseCfdTaxRegime::representingColumn() . ' ASC');
    }

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('Cfd_id', $this->Cfd_id);
		$criteria->compare('name', $this->name, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
                        'pagination' => array('pageSize' => Yii::app()->user->getState('pageSize', Yii::app()->params['defaultPageSize'])),
		));
	}
}