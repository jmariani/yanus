<?php

/**
 * This is the model base class for the table "IncomingInvoiceInterfaceFile".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "IncomingInvoiceInterfaceFile".
 *
 * Columns in table "IncomingInvoiceInterfaceFile" available as properties of the model,
 * and there are no model relations.
 *
 * @property integer $id
 * @property string $fileName
 * @property string $status
 * @property string $receptionDttm
 * @property string $validationDttm
 * @property string $processDttm
 * @property string $note
 * @property string $fileLocation
 * @property string $logFileLocation
 *
 */
abstract class BaseIncomingInvoiceInterfaceFile extends EAVActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'IncomingInvoiceInterfaceFile';
	}

	public static function label($n = 1) {
        return Yii::t('app', 'Incoming Invoice Interface File|Incoming Invoice Interface Files', $n);
	}

	public static function representingColumn() {
		return 'fileName';
	}

	public function rules() {
		return array(
			array('status', 'length', 'max'=>255),
			array('fileName, receptionDttm, validationDttm, processDttm, note, fileLocation, logFileLocation', 'safe'),
			array('fileName, status, receptionDttm, validationDttm, processDttm, note, fileLocation, logFileLocation', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, fileName, status, receptionDttm, validationDttm, processDttm, note, fileLocation, logFileLocation', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
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
                			'status' => yii::t('app', 'Status'),
                			'receptionDttm' => yii::t('app', 'Reception Dttm'),
                			'validationDttm' => yii::t('app', 'Validation Dttm'),
                			'processDttm' => yii::t('app', 'Process Dttm'),
                			'note' => yii::t('app', 'Note'),
                			'fileLocation' => yii::t('app', 'File Location'),
                			'logFileLocation' => yii::t('app', 'Log File Location'),
		);
	}


	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('fileName', $this->fileName, true);
		$criteria->compare('status', $this->status, true);
		$criteria->compare('receptionDttm', $this->receptionDttm, true);
		$criteria->compare('validationDttm', $this->validationDttm, true);
		$criteria->compare('processDttm', $this->processDttm, true);
		$criteria->compare('note', $this->note, true);
		$criteria->compare('fileLocation', $this->fileLocation, true);
		$criteria->compare('logFileLocation', $this->logFileLocation, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
                        'pagination' => array('pageSize' => Yii::app()->user->getState('pageSize', Yii::app()->params['defaultPageSize'])),
		));
	}
}