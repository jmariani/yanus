<?php

Yii::import('application.models._base.BaseSatCertificate');

class SatCertificate extends BaseSatCertificate {

    const SAT_FTP = 'ftp://ftp2.sat.gob.mx';

    public $certificateFile;
    public $keyFile;

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function attributeLabels() {
        $attributeLabels = parent::attributeLabels();
        $attributeLabels['nbr'] = yii::t('app', 'Number');
        return $attributeLabels;
    }

    public function downloadFromSat() {
        $cerFileName = Yii::app()->params['SAT_CER_BASE_PATH'] . '/';
        $cerFileName .= substr($this->nbr, 0, 6) . "/";
        $cerFileName .= substr($this->nbr, 6, 6) . "/";
        $cerFileName .= substr($this->nbr, 12, 2) . "/";
        $cerFileName .= substr($this->nbr, 14, 2) . "/";
        $cerFileName .= substr($this->nbr, 16, 2) . "/";
        $cerFileName .= $this->nbr . ".cer";

        $certificate = @file_get_contents($cerFileName);
        if (!$certificate) {
            $this->addError('nbr', yii::t('app', 'Unable to download certificate "{cert}" from SAT FTP server.', array('{cert}' => $cerFileName)));
            return false;
        } else {
            file_put_contents(sys_get_temp_dir() . '/' . $this->nbr . ".cer", $certificate);
            $this->loadFromFile(sys_get_temp_dir() . '/' . $this->nbr . ".cer");
            if (!$this->save())
                return false;
            unlink(sys_get_temp_dir() . '/' . $this->nbr . ".cer");
        }
        return true;
    }

    public function getPem() {
        return "-----BEGIN CERTIFICATE-----\n" . chunk_split($this->pem, 64, "\n") . "-----END CERTIFICATE-----\n";
    }

    public function getStatus() {
        $cert = new CkCert();
        $cert->SetFromEncoded($this->pem);
        if ($cert->get_Expired()) {
            return yii::t('app', 'Expired');
        } else if ($cert->CheckRevoked()) {
            return yii::t('app', 'Revoked');
        } else {
            return yii::t('app', 'Valid');
        }
    }

    public function loadFromFile($file) {
//        Yii::import('application.vendors.*');
//        require_once('Chilkat/CkCert.php');

        $cert = new CkCert();
        $cert->LoadFromFile($file);
        // Extract serial number
        $nbr = '';
        $this->serial = $cert->serialNumber();
        for ($i = 1; $i <= strlen($cert->serialNumber()); $i+=2) {
            $nbr .= $this->serial[$i];
        }
        $this->nbr = $nbr;
        $this->validFrom = date(DateTime::ISO8601, $cert->GetValidFromDt()->GetAsUnixTime(true));
        $this->validTo = date(DateTime::ISO8601, $cert->GetValidToDt()->GetAsUnixTime(true));
        $this->name = utf8_encode($cert->subjectCN());
        $this->issuerName = $cert->issuerCN();

        // Extract RFC
        $dn = explode(',', $cert->subjectDN());
        foreach ($dn as $dnItems) {
            $dnItem = explode('=', $dnItems);
            if (trim($dnItem[0]) == 'OID.2.5.4.45') {
                $rfc = trim(str_replace('/', '', substr($dnItem[1], 0, 13)));
                $this->rfc = utf8_encode($rfc);
            } else if (trim($dnItem[0]) == 'x500UniqueIdentifier') {
                $rfc = trim(str_replace('/', '', substr($dnItem[1], 0, 13)));
                $this->rfc = utf8_encode($rfc);
            }
        }
        // Get pem
        $certificate = @file_get_contents($file);
        $this->pem = base64_encode($certificate);

        return true;
        // Try to relate the certificate with the Party.
//        $certificate = @file_get_contents($file);
//        $pem = chunk_split(base64_encode($certificate), 64, "\n");
//        $pem = "-----BEGIN CERTIFICATE-----\n" . $pem . "-----END CERTIFICATE-----\n";
//        $this->pem = $pem;
//        // extract information from PEM
//        $data = openssl_x509_parse($this->pem, true);
//        $this->serial = $data['serialNumber'];
//        if (isset($data['validFrom_time_t'])) {
//            $this->validFrom = date('Y-m-d H:i:s', $data['validFrom_time_t']);
//        } else {
//            throw new Exception('[ERROR] El certificado ' . $csdNbr . ' no contiene información de VALIDFROM.');
//        }
//        if (isset($data['validTo_time_t'])) {
//            $this->validTo = date('Y-m-d H:i:s', $data['validTo_time_t']);
//        } else {
//            throw new Exception('[ERROR] El certificado ' . $csdNbr . ' no contiene información de VALIDTO.');
//        }
//        $this->rfc = trim(substr($data['subject']['x500UniqueIdentifier'], 0, 13));
//        $this->name = trim($data['subject']['name']);
    }

    public function loadKeyFromFile($file) {
//        Yii::import('application.vendors.*');
//        require_once('Chilkat/CkCert.php');

        $key = file_get_contents($file);
        // Convert certificate to PEM
        //$pem = chunk_split(base64_encode($key), 64, "\n");
        //$pem = base64_encode($key);
        $this->keyPem = base64_encode($key);
//
//        $cert = new CkCert();
//        $cert->LoadFromFile($file);
//        $this->keyPem = $cert->getEncoded();
        // Try to relate the certificate with the Party.
//        $certificate = @file_get_contents($file);
//        $pem = chunk_split(base64_encode($certificate), 64, "\n");
//        $pem = "-----BEGIN CERTIFICATE-----\n" . $pem . "-----END CERTIFICATE-----\n";
//        $this->pem = $pem;
//        // extract information from PEM
//        $data = openssl_x509_parse($this->pem, true);
//        $this->serial = $data['serialNumber'];
//        if (isset($data['validFrom_time_t'])) {
//            $this->validFrom = date('Y-m-d H:i:s', $data['validFrom_time_t']);
//        } else {
//            throw new Exception('[ERROR] El certificado ' . $csdNbr . ' no contiene información de VALIDFROM.');
//        }
//        if (isset($data['validTo_time_t'])) {
//            $this->validTo = date('Y-m-d H:i:s', $data['validTo_time_t']);
//        } else {
//            throw new Exception('[ERROR] El certificado ' . $csdNbr . ' no contiene información de VALIDTO.');
//        }
//        $this->rfc = trim(substr($data['subject']['x500UniqueIdentifier'], 0, 13));
//        $this->name = trim($data['subject']['name']);
    }

    public function rules() {
        $rules = parent::rules();
        $rules[] = array('keyFile, certificateFile', 'safe');
        $rules[] = array('certificateFile', 'file', 'types' => 'cer', 'allowEmpty' => false, 'on' => 'upload');
        $rules[] = array('keyFile', 'file', 'types' => 'key', 'allowEmpty' => false, 'on' => 'upload');
        $rules[] = array('keyPassword', 'required', 'on' => 'upload');
        $rules[] = array('nbr', 'unique');
        return $rules;
    }

    public function current($date = null) {
        $criteria = new CDbCriteria();
        if (is_null($date))
            $date = date(DateTime::ISO8601);
        $criteria->addCondition('validFrom <= :date1');
        $criteria->addCondition('validTo >= :date2');
        $criteria->params = array(':date1' => $date, ':date2' => $date);
        $this->getDbCriteria()->mergeWith($criteria);
        return $this;
    }

}