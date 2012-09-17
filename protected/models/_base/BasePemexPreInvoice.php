<?php

/**
 * This is the model base class for the table "PemexPreInvoice".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "PemexPreInvoice".
 *
 * Columns in table "PemexPreInvoice" available as properties of the model,
 * followed by relations of table "PemexPreInvoice" available as properties of the model.
 *
 * @property integer $id
 * @property string $fileName
 * @property string $poNbr
 * @property string $copade
 * @property string $addenda
 *
 * @property PemexPreInvoiceItem[] $pemexPreInvoiceItems
 */
abstract class BasePemexPreInvoice extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'PemexPreInvoice';
	}

	public static function label($n = 1) {
        return Yii::t('app', 'Pemex Pre Invoice|Pemex Pre Invoices', $n);
	}

	public static function representingColumn() {
		return 'fileName';
	}

	public function rules() {
		return array(
			array('fileName, poNbr, copade', 'length', 'max'=>45),
			array('addenda', 'safe'),
			array('fileName, poNbr, copade, addenda', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, fileName, poNbr, copade, addenda', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'pemexPreInvoiceItems' => array(self::HAS_MANY, 'PemexPreInvoiceItem', 'PemexPreInvoice_id'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
                			'id' => yii::t('app', 'Id'),
                			'fileName' => yii::t('app', 'File Name'),
                			'poNbr' => yii::t('app', 'Po Nbr'),
                			'copade' => yii::t('app', 'Copade'),
                			'addenda' => yii::t('app', 'Addenda'),
                        			                        'pemexPreInvoiceItems' => yii::t('app', 'Pemex Pre Invoice Items'),
		);
	}


	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('fileName', $this->fileName, true);
		$criteria->compare('poNbr', $this->poNbr, true);
		$criteria->compare('copade', $this->copade, true);
		$criteria->compare('addenda', $this->addenda, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
                        'pagination' => array('pageSize' => Yii::app()->user->getState('pageSize', Yii::app()->params['defaultPageSize'])),
		));
	}
}