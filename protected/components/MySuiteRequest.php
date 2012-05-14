<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

Yii::import('application.vendors.nuSoap.nusoap');

/**
 * Description of MySuiteRequest
 *
 * @author jmariani
 */

class MySuiteResponse{
    public $result;
    public $timeStamp;
    public $lastResult;
    public $code;
    public $description;
    public $hint;
    public $data;
    public $processor;
    public $data1;
    public $data2;
    public $data3;
}

class MySuiteRequest {
    public $requestor;
    public $transaction;
    public $country = 'MX';
    public $entity;
//    'User' => $this->requestor,
    public $username;
    public $data1;
    public $data2;
    public $data3;
    public $url;

    public function requestTransaction() {
        $data1 = strstr($this->data1, "<cfdi:");
        $data1 = "<![CDATA[" . $data1 . "]]>";

        $param = array(
            'Requestor' => $this->requestor,
            //'Transaction' => $this->transaction,
            'Transaction' => 'TIMBRAR',
            'Country' => $this->country,
            'Entity' => $this->entity,
            'User' => $this->requestor,
            'UserName' => $this->username,
            'Data1' => $data1,
            'Data2' => "",
            'Data3' => "");

        $client = new nusoap_client($this->url, true);
        $requestResult = $client->call('RequestTransaction', $param);

        $response = new MySuiteResponse();
        $response->code = $requestResult['RequestTransactionResult']['Response']['Code'];
        $response->data = $requestResult['RequestTransactionResult']['Response']['Data'];
        $response->data1 = base64_decode($requestResult['RequestTransactionResult']['ResponseData']['ResponseData1']);
        $response->data2 = $requestResult['RequestTransactionResult']['ResponseData']['ResponseData2'];
        $response->data3 = $requestResult['RequestTransactionResult']['ResponseData']['ResponseData3'];
        $response->description = $requestResult['RequestTransactionResult']['Response']['Description'];
        $response->hint = $requestResult['RequestTransactionResult']['Response']['Hint'];
        $response->lastResult = $requestResult['RequestTransactionResult']['Response']['LastResult'];
        $response->processor = $requestResult['RequestTransactionResult']['Response']['Processor'];
        $response->result = $requestResult['RequestTransactionResult']['Response']['Result'];
        $response->timeStamp = $requestResult['RequestTransactionResult']['Response']['TimeStamp'];
        return $response;
    }
}

?>
