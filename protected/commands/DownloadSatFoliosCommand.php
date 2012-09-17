<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CsdProperties
 *
 * @author jmariani
 */
class DownloadSatFoliosCommand extends CConsoleCommand {

    public function run($args) {
        // Connect to SAT ftp server.
        $localFile = sys_get_temp_dir() . '/FoliosCfd.txt';
        file_put_contents($localFile, file_get_contents('ftp://ftp2.sat.gob.mx/agti_ftp/cfds_ftp/FoliosCFD.txt'));

        $handle = fopen($localFile, "r");
        $row = 1;
        while (($data = fgetcsv($handle, 0, '|')) !== FALSE) {
            if ($row > 1) { //Skip first line. Heading only
                if (count($data) == 6) {
                    $satFolio = new SatFoliosCfd();
                    $satFolio->rfc = $data[0];
                    $satFolio->approvalNbr = $data[1];
                    $satFolio->approvalYear = $data[2];
                    $satFolio->serial = $data[3];
                    $satFolio->startFolio = $data[4];
                    $satFolio->endFolio = $data[5];
                    if (!SatFoliosCfd::model()->find('md5 = :md5', array(':md5' => md5($satFolio->getHash()))))
                        if (!$satFolio->save()) CVarDumper::dump($satFolio->getErrors ());
                }
            }
            $row++;
        }
        fclose($handle);
        unlink($localFile);
    }

}

?>
