<?php

Yii::import('application.models._base.BaseIncomingInvoiceInterfaceFile');

class IncomingInvoiceInterfaceFile extends BaseIncomingInvoiceInterfaceFile {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function attributeLabels() {
        $attributeLabels = parent::attributeLabels();
        $attributeLabels['IncomingInvoiceInterfaceFileStatus_id'] = 'Status';
        $attributeLabels['incomingInvoiceInterfaceFileStatus'] = 'Status';
        return $attributeLabels;
    }

    public function behaviors() {
        $behaviors = parent::behaviors();
//        $behaviors['swBehavior'] = array('class' => 'application.extensions.simpleWorkflow.SWActiveRecordBehavior');
//        $behaviors['Status'] = array(
//            'class' => 'IncomingInvoiceInterfaceFileStatusBehavior',
//            'attribute' => 'status',
//        );
        return $behaviors;
    }

    public static function getFilePath() {
        // protected/files/IncomingInvoiceInterfaceFile
        // Get path name
        $pathRec = SystemConfig::model()->find('code = :code', array(':code' => SystemConfig::INCOMING_INVOICE_INTERFACE_FILE_PATH));
        $path = yii::getPathOfAlias('application') . DIRECTORY_SEPARATOR . $pathRec->value;
        // Check if exists
        if (!file_exists($path))
            mkdir($path, 0777, true);
        return $path;
    }

    public static function getNativeXmlPath() {
        return yii::getPathOfAlias('application') . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'nativeXml';
    }

    public function rules() {
        $rules = array();
        $rules[] = array('fileName', 'file', 'on' => 'upload');
        $rules[] = array('receptionDttm', 'default', 'value' => new CDbExpression('NOW()'), 'on' => 'update,insert,upload');
//        $rules[] = array('status', 'SWValidator');

        $rules[] = array('IncomingInvoiceInterfaceFileStatus_id', 'default', 'value'
            => IncomingInvoiceInterfaceFileStatus::model()->find('code = :code', array(':code' => IncomingInvoiceInterfaceFileStatus::PENDING))->id,
            'on' => 'insert,upload');
        return array_merge($rules, parent::rules());
    }

    public function scopes() {
        $scopes = parent::scopes();
        $scopes['orderByReceptionDttmDesc'] = array('order' => $this->getTableAlias(false, false) . '.receptionDttm DESC');
        return $scopes;
    }

    public function search() {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('fileName', $this->fileName, true);
        $criteria->compare('receptionDttm', $this->receptionDttm, true);
        $criteria->compare('processDttm', $this->processDttm, true);
        $criteria->compare('note', $this->note, true);
        $criteria->compare('nativeXmlFile', $this->nativeXmlFile, true);
        $criteria->compare('IncomingInvoiceInterfaceFileStatus_id', $this->IncomingInvoiceInterfaceFileStatus_id);

        return new CActiveDataProvider($this, array(
                    'sort' => array(
                        'defaultOrder' => array(
                            'receptionDttm' => true
                    )),
                    'criteria' => $criteria,
                    'pagination' => array('pageSize' => Yii::app()->user->getState('pageSize', Yii::app()->params['defaultPageSize'])),
                ));
    }

}