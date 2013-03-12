<?php

class EGoogleGeoCode extends CApplicationComponent {

    public $language = 'es';
    public $results;
    public $street;
    public $extNbr;
    public $neighborhood;
    public $municipality;
    public $city;
    public $state;
    public $country;
    public $zipCode;
    public $status;

    public function query($address, array $params = null) {
        $urlParms = array();
        $urlParms['address'] = $address;
        $urlParms['sensor'] = 'false';
        if ($params)
            $urlParms = array_merge($urlParms, $params);

        $url = 'http://maps.google.com/maps/api/geocode/json?' . http_build_query($urlParms);
        yii::trace($url, __METHOD__);
        $result = file_get_contents("$url");
        if ($result) {
            $json = json_decode($result);
            $this->status = $json->status;
            if ($json->status == 'OK') {
                $this->results = $json->results;

                foreach ($json->results as $result) {
                    foreach ($result->address_components as $addressPart) {
                        if ((in_array('locality', $addressPart->types)) && (in_array('political', $addressPart->types)))
                            $this->city = $addressPart;
                        else if ((in_array('sublocality', $addressPart->types)) && (in_array('political', $addressPart->types)))
                            $this->municipality = $addressPart;
                        else if ((in_array('administrative_area_level_1', $addressPart->types)) && (in_array('political', $addressPart->types)))
                            $this->state = $addressPart;
                        else if ((in_array('country', $addressPart->types)) && (in_array('political', $addressPart->types)))
                            $this->country = $addressPart;
                        else if ((in_array('route', $addressPart->types)))
                            $this->street = $addressPart;
                        else if ((in_array('street_number', $addressPart->types)))
                            $this->extNbr = $addressPart;
                        else if ((in_array('postal_code', $addressPart->types)))
                            $this->zipCode = $addressPart;
                        else if ((in_array('neighborhood', $addressPart->types)) && (in_array('political', $addressPart->types)))
                            $this->neighborhood = $addressPart;
                    }
                }
                return $this;
            }
        } else
            return false;
    }

}
