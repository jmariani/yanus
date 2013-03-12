<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EEAVActiveRecord
 *
 * @author jmariani
 */
class EAVActiveRecord extends SWActiveRecord {

    private $_eav = array();
    private $_relatedObjects = array();
    private $_fileAssets = array();
    private $_dirty = false;

//    public function __get($name) {
////        yii::trace('__get("' . $name . '")', get_class($this));
//        if (isset($this->_eav[strtoupper($name)])) {
////            yii::trace('Getting EAV ' . $name);
//            return $this->_eav[strtoupper($name)];
//        } else {
////            yii::trace('Getting Standard ' . $name);
//            return parent::__get($name);
//        }
//    }

    public function __call($name, $parameters) {
        try {
            return parent::__call($name, $parameters);
        } catch (CException $e) {
            if (strtolower(substr($name, 0, 8)) == 'filterby') {
                $fieldName = substr($name, 8);

                $criteria = new CDbCriteria();
                $criteria->compare($fieldName, $parameters[0]);

                $criteria = $this->getDbCriteria()->mergeWith($criteria);
                return $this;
            } else {
                throw new CException(Yii::t('yanus', 'Second chance exception : {class} and its behaviors do not have a method or closure named "{name}".', array('{class}' => get_class($this), '{name}' => $name)));
            }
        }
    }

    /**
     * Overrides the default magic method defined at the CComponent level in order to
     * return a metadata value if parent method fails.
     *
     * @see CComponent::__get()
     */
    public function __get($name) {
        try {
            return parent::__get($name);
        } catch (CException $e) {
            if (isset($this->_eav[strtoupper($name)])) {
                return $this->_eav[strtoupper($name)];
            } else {
                throw new CException(Yii::t('yanus', 'Second chance exception : Property "{class}.{property}" is not defined.', array('{class}' => get_class($this), '{property}' => $name)));
            }
        }
    }

    public function __isset($name) {
        if (!parent::__isset($name))
            if (isset($this->_eav[strtoupper($name)]))
                return true;
            else
                return false;
    }

//    // Sets the value of an attribute
//    public function __set($name, $value) {
//
////		if($this->setAttribute($name,$value)===false)
////		{
////			if(isset($this->getMetaData()->relations[$name]))
////				$this->_related[$name]=$value;
////			else
////				parent::__set($name,$value);
////		}
//        // Find code on code catalog
//        if (EavCode::model()->find('code = :code', array(':code' => strtolower($name))))
//            $this->_eav[strtoupper($name)] = $value; // If code found set value
//        else
//        error_log(get_class($this) . '.__set: ' . $name);
//        parent::__set($name, $value); // if code not found continue with normal processing
//    }

    public function addFileAsset($fname, $type) {
        $file = Yii::app()->file->set($fname, true);
        $fileAsset = FileAsset::model()->find('location = :location', array(':location' => $file->realpath));
        if (!$fileAsset) {
            $fileAsset = new FileAsset();
            $fileAsset->name = $file->basename;
            $fileAsset->location = $file->realpath;
            $fileAsset->save();
        }
        $objectHasFileAsset = new ObjectHasFileAsset();
        $objectHasFileAsset->fileAsset = $fileAsset;
        $objectHasFileAsset->type = $type;
        $this->_fileAssets[$file->realpath] = $objectHasFileAsset;
        $this->_dirty = true;
    }

    public function addRelatedObject($o) {
        if (!isset($this->_relatedObjects[get_class($o)]))
            $this->_relatedObjects[get_class($o)] = array();
        $this->_relatedObjects[get_class($o)][] = $o;
        $this->_dirty = true;
    }

    public function afterFind() {
        $chars = yii::app()->db->createCommand()
                ->select('code, value')
                ->from('Eav')
                ->where(array('and', 'objectName = :name', 'objectId = :id'), array(':name' => get_class($this), ':id' => $this->id))
                ->queryAll(true);

        // Load all attributes values from db
//        $chars = Eav::model()->findAll('objectName = :name and objectId = :id', array(':name' => get_class($this), ':id' => $this->id));
        foreach ($chars as $char) {
//            $this->_eav[strtoupper($char->code)] = $char->value;
            $this->_eav[strtoupper($char['code'])] = $char['value'];
        }
        $this->_dirty = FALSE;
        // Update CRUDLog
        $this->updateCrudLog('read');
        parent::afterFind();
    }

    public function afterSave() {
        // Save attributes to database
        foreach ($this->_eav as $key => $value) {
            if ($this->isNewRecord)
                $char = new Eav();
            else {
                // Find if value exists on db
                $char = Eav::model()->find('objectName = :name and objectId = :id and code = :code', array(':name' => get_class($this), ':id' => $this->id, ':code' => strtolower($key)));
                if (!$char)
                    $char = new Eav(); // If doesn'r exists
                else
                if ($char->value == $value)
                    continue; // if exists.
            }
            $char->objectName = get_class($this);
            $char->objectId = $this->id;
            $char->code = strtolower($key);
            $char->value = $value;
            $char->save();
        }

        // Save the related objects attached thru addRelatedObject
        // _relatedObject structure:
        // [Object Class Name][Object instance]
        //                    [Object instance]
        // [Object Class Name][Object instance]
        foreach ($this->_relatedObjects as $class => $ro) {
            foreach ($ro as $object) {
                // Get the foreign key for this object
                $fk = get_class($this) . '_id';
                // Set the fk with this id.
                $object->$fk = $this->id;
                if (!$object->save()) {
                    foreach ($object->getErrors() as $error) {
                        if (is_array($error)) {
                            error_log('[error] ' . get_class($object) . ': ' . implode(', ', $error));
                            $this->addError('id', get_class($object) . ': ' . implode(', ', $error));
                        } else {
                            error_log('[error] ' . get_class($object) . ': ' . $error);
                            $this->addError('id', get_class($object) . ': ' . $error);
                        }
                    }
                    return false;
                }
                if ($object->isDirty())
                    if (!$object->save())
                        CVarDumper::dump($object->getErrors());
                // Add the record to the relationshiptable
//                $relatedModel = new RelatedModel();
//                $relatedModel->parentModel = get_class($this);
//                $relatedModel->parentId = $this->id;
//                $relatedModel->childModel = $class;
//                $relatedModel->childId = $object->id;
//                if (!$relatedModel->save())
//                    CVarDumper::dump($relatedModel->getErrors());
            }
        }


        // Save file assets
        foreach ($this->_fileAssets as $fileAsset) {
            $fileAsset->objectName = get_class($this);
            $fileAsset->objectId = $this->id;
            $fileAsset->save();
        }
        // [satCertificate] => CBelongsToRelation Object (
        //      [joinType] => LEFT OUTER JOIN
        //      [on] =>
        //      [alias] =>
        //      [with] => Array ( )
        //      [together] =>
        //      [scopes] =>
        //      [name] => satCertificate
        //      [className] => SatCertificate
        //      [foreignKey] => SatCertificate_id
        //      [select] => *
        //      [condition] =>
        //      [params] => Array ( )
        //      [group] =>
        //      [join] =>
        //      [having] =>
        //      [order] =>
        //      [_e:CComponent:private] =>
        //      [_m:CComponent:private] => )
//        foreach ($this->getMetaData()->relations as $name => $relation) {
//            switch (get_class($relation)) {
//                case 'CBelongsToRelation':
//
//            }
//        }
        $this->_dirty = false;
        if ($this->isNewRecord)
            $this->updateCrudLog('create');
        else
            $this->updateCrudLog('update');

        return parent::afterSave();
    }

    public function beforeValidate() {
        foreach ($this->getMetaData()->relations as $name => $relation) {
            switch (get_class($relation)) {
                case 'CBelongsToRelation':
                    $fk = $relation->foreignKey;
                    if (!$this->$fk) {
                        $className = $relation->className;
                        if ($this->$name) {
                            if ($this->$name->isNewRecord)
                                $this->$name->save();
                            $this->$fk = $this->$name->id;
                        }
                    }
                    break;
            }
        }
        return parent::beforeValidate();
    }

    public function importJson($json) {
        $data = json_decode($json);
    }

    public function importXml($data, $save = true, $params = array()) {
        if (!($data instanceof SimpleXMLElement))
            $xml = simplexml_load_string($data);
        else
            $xml = $data;

        $models = yii::app()->db->getSchema()->getTableNames();

//        CVarDumper::dump($xml);
//        echo $xml->getName() . PHP_EOL;
        if (array_search($xml->getName(), $models) !== false) {
            $objectName = $xml->getName();
            $object = new $objectName;
            foreach ($xml->attributes() as $attrName => $attrValue) {
                $object->$attrName = $attrValue;
            }
//            CVarDumper::dump($params);
            foreach ($params as $paramName => $paramValue) {
                $object->$paramName = $paramValue;
            }
            if ($save)
                if (!$object->save())
                    CVarDumper::dump($object->getErrors());
            foreach ($xml->children() as $child) {
                $childName = $child->getName();
                $fk = yii::app()->db->getSchema()->getTable($objectName)->primaryKey;
                $childObject = $childName::model()->importXml($child, $save, array($objectName . '_' . $fk => $object->id));
            }
            return $object;
        }
    }

    public function isDirty() {
        return $this->_dirty;
    }

    public function relations() {
        $relations = parent::relations();

        $models = yii::app()->db->getSchema()->getTableNames();

//        $relations['EAV'] = array(self::HAS_MANY, 'Eav', 'objectId', 'on' => 'EAV.objectName = "' . get_class($this) . '"');
//
//        $codes = EavCode::model()->findAll();
//        foreach ($codes as $code) {
//            // This will define a relation between a model and an attribute, so the attribute can be accessed as:
//            // This is for accessing attributes in SQL.
//            // $model->modelAttribute
//            // Example: $cfdItem->CfdItemVehicle
//            $relations[get_class($this) . ucfirst($code->code)] = array(self::HAS_ONE, 'Eav',
//                'objectId',
//                'scopes' => array(get_class($this) . $code->code));
////
////            $relations[$code->code . 'EAV'] = array(self::HAS_ONE, 'Eav',
////                'objectId', //'on' => $code->code . 'EAV.objectName = "' . get_class($this) . '"',
////                'scopes' => array(get_class($this) . $code->code));
//////            $relations[$code->code] = array(self::HAS_ONE, 'Eav', 'objectId', 'scopes' => get_class($this) . $code->code);
//        }
//
//        // This defines, for every model based on EAVActiveRecord
//        // a relationship between the model and the ObjectHasFileAsset model.
//        // Represents filess attached to model.
//        // Cfd->fileAssets[]
//        $relations['fileAssets'] = array(self::HAS_MANY, 'ObjectHasFileAsset', 'objectId', 'scopes' => get_class($this));
//
//        $fileAssetType = new FileAssetTypeBehavior();
//        foreach ($fileAssetType->getList() as $key => $value) {
//            $relations[get_class($this) . 'Has' . ucfirst($key) . 'FileAsset'] = array(self::HAS_MANY, 'ObjectHasFileAsset', 'objectId', 'scopes' => array(get_class($this), $key));
//            $relations[ucfirst($key) . 'File'] = array(self::HAS_MANY, 'FileAsset', array('FileAsset_id' => 'id'), 'through' => get_class($this) . 'Has' . ucfirst($key) . 'FileAsset');
//        }
//        $relations['fileAssets'] = array(self::HAS_MANY, 'ObjectHasFileAsset', 'objectId', 'scopes' => get_class($this));

        $relations['Children'] = array(self::HAS_MANY, 'RelatedModel', 'parentId', 'scopes' => get_class($this) . 'AsParent');
        $relations['Parents'] = array(self::HAS_MANY, 'RelatedModel', 'childId', 'scopes' => get_class($this) . 'AsChild');
//        $relations['Children'] = array(self::HAS_MANY, 'RelatedModel', 'parentId', 'on' => 'Children.parentModel = :p', 'params' => array(':p' => get_class($this)));
//        $relations['Parents'] = array(self::HAS_MANY, 'RelatedModel', 'childId', 'on' => 'Parents.childModel = :p', 'params' => array(':p' => get_class($this)));
        foreach ($models as $model) {
            $relations['_' . $model] = array(self::HAS_MANY, 'RelatedModel', 'parentId',
                'scopes' => array(get_class($this) . 'AsParent', $model . 'AsChild')
//                'on' => '_' . $model . '.parentModel = :p and ' . '_' . $model . '.childModel = :c', 'params' => array(':p' => get_class($this), ':c' => $model)
            );
        }
        return $relations;
    }

    public function setAttribute($name, $value) {
        if (!parent::setAttribute($name, $value)) {
//            yii::trace('setAttribute("' . $name . '")', get_class($this));
            if (!EavCode::model()->find('code = :code', array(':code' => strtolower($name))))
                return false;
            $this->_eav[strtoupper($name)] = $value; // If code found set value
        }
        $this->_dirty = true;
        return true;
    }

    private function updateCrudLog($action = 'create') {
        if (get_class($this) != 'CrudLog') {
            try {
                $found = new CrudLog();
                $found->model = get_class($this);
                $found->modelId = $this->id;
                $found->action = $action;
                $found->save();
            } catch (Exception $e) {

            }
        }
    }

}

?>
