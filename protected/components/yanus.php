<?php

/**
 * EFontAwesome loader class file.
 * @author Jorge Mariani <jorgemariani@gmail.com>
 * @license http://creativecommons.org/licenses/by/3.0/ CC BY 3.0
 * Font Awesome - http://fortawesome.github.com/Font-Awesome
 */

/**
 * Bootstrap application component.
 */
class yanus extends CApplicationComponent {

    protected $_assetsUrl;

    /**
     * Initializes the component.
     */
    public function init() {
        if (Yii::getPathOfAlias('files') === false)
            Yii::setPathOfAlias('files', yii::getPathOfAlias('application') . DIRECTORY_SEPARATOR . 'files');
        $path = yii::app()->file->set(Yii::getPathOfAlias('files'));
        if (!$path->exists) $path->createDir();

        if (Yii::getPathOfAlias('cfd') === false)
            Yii::setPathOfAlias('cfd', yii::getPathOfAlias('files') . DIRECTORY_SEPARATOR . 'cfd');
        $path = yii::app()->file->set(Yii::getPathOfAlias('cfd'));
        if (!$path->exists) $path->createDir();

        if (Yii::getPathOfAlias('images') === false)
            Yii::setPathOfAlias('images', yii::getPathOfAlias('files') . DIRECTORY_SEPARATOR . 'images');
        $path = yii::app()->file->set(Yii::getPathOfAlias('images'));
        if (!$path->exists) $path->createDir();

        if (Yii::getPathOfAlias('nativeXml') === false)
            Yii::setPathOfAlias('nativeXml', yii::getPathOfAlias('files') . DIRECTORY_SEPARATOR . 'nativeXml');
        $path = yii::app()->file->set(Yii::getPathOfAlias('nativeXml'));
        if (!$path->exists) $path->createDir();
//
//        // Prevents the extension from registering scripts and publishing assets when ran from the command line.
//        if (Yii::app() instanceof CConsoleApplication)
//            return;
//        Yii::app()->getClientScript()->registerCssFile($this->getAssetsUrl() . "/css/font-awesome.css"); //, $media);

        parent::init();
    }

    /**
     * Returns the URL to the published assets folder.
     * @return string the URL
     */
    public function getAssetsUrl() {
        if (isset($this->_assetsUrl))
            return $this->_assetsUrl;
        else {
            $assetsPath = Yii::getPathOfAlias('efontawesome.assets');
            $assetsUrl = Yii::app()->assetManager->publish($assetsPath, false, -1, YII_DEBUG);
            return $this->_assetsUrl = $assetsUrl;
        }
    }
}
