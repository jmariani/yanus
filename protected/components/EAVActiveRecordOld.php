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
class EAVActiveRecordOld extends SwActiveRecord {

    private $_eav = array();
    private $_relatedObjects = array();
    private $_fileAssets = array();

    public function __get($name) {
        yii::trace('__get("' . $name . '")', get_class($this));
        if (isset($this->_eav[strtoupper($name)])) {
            yii::trace('Getting EAV ' . $name);
            return $this->_eav[strtoupper($name)];
        } else {
            yii::trace('Getting Standard ' . $name);
            return parent::__get($name);
        }
    }

    public function __isset($name) {
        if (!parent::__isset($name))
            if (isset($this->_eav[strtoupper($name)])) return true;
            else return false;
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

    public function addFileAssetNew($fname, $type) {
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
    }

    public function addRelatedObject($o) {
        if (!isset($this->_relatedObjects[get_class($o)]))
            $this->_relatedObjects[get_class($o)] = array();
        $this->_relatedObjects[get_class($o)][] = $o;
    }

    public function afterFind() {
        // Load all attributes values from db
        $chars = Eav::model()->findAll('objectName = :name and objectId = :id', array(':name' => get_class($this), ':id' => $this->id));
        foreach ($chars as $char) {
            $this->_eav[strtoupper($char->code)] = $char->value;
        }
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
//                error_log('About to save: ' . get_class($object));
                $fk = get_class($this) . '_id';
//                error_log('fk: ' . $fk);
                $object->$fk = $this->id;
                if (!$object->save()) {
                    foreach ($object->getErrors() as $error) {
                        if (is_array($error)) {
                            error_log('[error] ' . get_class($object) . ': ' . implode(', ', $error));
                        } else
                            error_log('[error] ' . get_class($object) . ': ' . $error);
                    }
                }
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
        return parent::afterSave();
    }

    public function beforeValidate() {
        error_log(get_class($this) . '.beforeValidate');
        foreach ($this->getMetaData()->relations as $name => $relation) {
            switch (get_class($relation)) {
                case 'CBelongsToRelation':
                    error_log('testing ' . $name);
                    $fk = $relation->foreignKey;
                    error_log('fk: ' . $fk);
                    if (!$this->$fk) {
                        $className = $relation->className;
                        error_log('classname: ' . $className);
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

    public function relations() {
        $relations = parent::relations();

        $relations['EAV'] = array(self::HAS_MANY, 'Eav', 'objectId', 'on' => 'EAV.objectName = "' . get_class($this) . '"');

        $codes = EavCode::model()->findAll();
        foreach ($codes as $code) {
            $relations[$code->code . 'EAV'] = array(self::HAS_ONE, 'Eav',
                'objectId', //'on' => $code->code . 'EAV.objectName = "' . get_class($this) . '"',
                'scopes' => array(get_class($this) . $code->code));
//            $relations[$code->code] = array(self::HAS_ONE, 'Eav', 'objectId', 'scopes' => get_class($this) . $code->code);
        }

        $relations['fileAssets'] = array(self::HAS_MANY, 'ObjectHasFileAsset', 'objectId', 'scopes' => get_class($this));

//        $relations['objectHasFileAssets'] = array(self::HAS_MANY, 'ObjectHasFileAsset', 'objectId', 'scopes' => get_class($this));
//        $relations[lcfirst(get_class($this)) . 'FileAssets'] = array(self::HAS_MANY, 'ObjectHasFileAsset', 'objectId', 'scopes' => get_class($this));
//
////        $relations['CfdHas' . ucfirst($key) . 'Address'] = array(self::HAS_ONE, 'CfdAddress', 'Cfd_id', 'scopes' => $key);
//
//        $relations['fileAssets'] = array(self::HAS_MANY, 'FileAsset', array('FileAsset_id' => 'id'), 'through' => 'objectHasFileAssets');

        return $relations;
    }

    public function setAttribute($name, $value) {
        if (!parent::setAttribute($name, $value)) {
            yii::trace('setAttribute("' . $name . '")', get_class($this));
            if (!EavCode::model()->find('code = :code', array(':code' => strtolower($name))))
                return false;
            $this->_eav[strtoupper($name)] = $value; // If code found set value
        }
        return true;
    }

}

?>
