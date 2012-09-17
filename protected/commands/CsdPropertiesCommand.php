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
class CsdPropertiesCommand extends CConsoleCommand {

    public function run($args) {
//        Yii::import('application.vendors.*');
//        require_once('Chilkat/CkCert.php');


        $cert = new CkCert();

        if ($cert->LoadFromFile($args[0])) {
            echo 'CheckRevoked ' . $cert->CheckRevoked() . PHP_EOL;
            echo 'SubjectC ' . $cert->subjectC() . PHP_EOL;
            echo 'SubjectCN ' . $cert->subjectCN() . PHP_EOL;
            echo 'SubjectDN ' . $cert->subjectDN() . PHP_EOL;
            echo 'SubjectE ' . $cert->subjectE() . PHP_EOL;
            echo 'SubjectL ' . $cert->subjectL() . PHP_EOL;
            echo 'SubjectO ' . $cert->subjectO() . PHP_EOL;
            echo 'SubjectOU ' . $cert->subjectOU() . PHP_EOL;
            echo 'SubjectS ' . $cert->subjectS() . PHP_EOL;
            echo $cert->serialNumber() . PHP_EOL;
            $dn = explode(',', $cert->subjectDN());
            print_r($dn);
            foreach ($dn as $dnItems) {
                $dnItem = explode('=', $dnItems);
                if (trim($dnItem[0]) == 'OID.2.5.4.45') {
                    echo 'RFC ' . trim(substr($dnItem[1], 0, 13)) . PHP_EOL;
                }
            }
            echo str_replace("\r\n", "\n", $cert->getEncoded());

        }


        $certificate = @file_get_contents($args[0]);
        $pem = chunk_split(base64_encode($certificate), 64, "\n");
        $pem = "-----BEGIN CERTIFICATE-----\n" . $pem . "-----END CERTIFICATE-----\n";

        // extract information from PEM
        $data = openssl_x509_parse($pem, false);
        print_r($data);

    }
}

?>
