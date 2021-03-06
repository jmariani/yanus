<?php

/**
 * This is the model base class for the table "CfdNote".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "CfdNote".
 *
 * Columns in table "CfdNote" available as properties of the model,
 * followed by relations of table "CfdNote" available as properties of the model.
 *
 * @property integer $id
 * @property integer $Cfd_id
 * @property string $note
 *
 * @property Cfd $cfd
 */
abstract class BaseCfdNote extends EAVActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'CfdNote';
	}

	public static function label($n = 1) {
        return Yii::t('app', 'Cfd Note|Cfd Notes', $n);
	}

	public static function representingColumn() {
		return 'note';
	}

	public function relations() {
		$relations = array(
			'cfd' => array(self::BELONGS_TO, 'Cfd', 'Cfd_id'),
		);
                return array_merge($relations, parent::relations());
	}
	public function rules() {
		return array(
			array('Cfd_id', 'required'),
			array('Cfd_id', 'numerical', 'integerOnly'=>true),
			array('note', 'safe'),
			array('note', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, Cfd_id, note', 'safe', 'on'=>'search'),
		);
	}
	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('Cfd_id', $this->Cfd_id);
		$criteria->compare('note', $this->note, true);

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
                        			                        'Cfd_id' => yii::t('app', 'Cfd'),
                			'note' => yii::t('app', 'Note'),
                        			                        'cfd' => yii::t('app', 'Cfd'),
		);
	}
}