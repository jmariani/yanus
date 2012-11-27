<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of YFileHelper
 *
 * @author jmariani
 */
class YFileHelper extends CFileHelper {

    /**
     * Returns the extension name of a file path.
     * For example, the path "path/to/something.php" would return "php".
     * @param string $path the file path
     * @return string the extension name without the dot character.
     * @since 1.1.2
     */
    public static function getName($path) {
        return pathinfo($path, PATHINFO_FILENAME);
    }

    /**
     * Opens a file and tries to lock it
     * @param string $path the file path
     * @return file handle
     */

    public static function openExclusive($fileName, $mode = 'r') {
        // Try to lock file to ensure is not still be written.
        $fp = @fopen($fileName, $mode);
        if ($fp) {
            while (!flock($fp, LOCK_EX)) {

            }
        }
        return $fp;
    }

}

?>
