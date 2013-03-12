<?php
/**
 * Geocode class file.
 *
 * @author Deepak Pradhan <deepak.pradhan@IncisiveSystem.com>
 * @link http://gemisoft.com
 * @version 0.2
 */
class Geocode extends CApplicationComponent {

	/**
	* Accuracy Codes
	* ==================
	* 0	Unknown location.
	* 1	Country level accuracy.
	* 2	Region (state, province, prefecture, etc.) level accuracy.
	* 3	Sub-region (county, municipality, etc.) level accuracy.
	* 4	Town (city, village) level accuracy.
	* 5	Post code (zip code) level accuracy.
	* 6	Street level accuracy.
	* 7	Intersection level accuracy.
	* 8	Address level accuracy.
	* 9	Premise (building name, property name, shopping center, etc.) level accuracy.
	*/

	// Accuracy 9 or 8: if AccuracyHigh is true, Med & Low is forced to false;
	public $AccuracyHigh = false; // Accuracy 9 or 8: if AccuracyHigh is true, Med & Low is forced to false;

	// Accuracy 7 to 9: if AccuracyMed  is true, Low is forced to false;
	public $AccuracyMed  = true;

	// Accuracy 1 to 6
	public $AccuracyLow  = true;


    // Limit geocoding in a country
	public $CountryCheck = true;

    // if CountryCheck then use the iso 3166 codes for valid Country
	public $ISO3166      = array('US');


	// AddressDetails returns State(Administrative), County(SubAdministrative), City(LocalityName) Street(Thoroughfare)
	// above are my interpretation!!!!!!!!!!!!!!!!!!!!!!
	public $AddressDetails   = true;


    // Geo Location box
	public $ExtendedData     = true;

	// Geo Cordinate : lat and  lang
	public $Points           = true; //

	// Return API Status details
	public $APIStatus        = true; // not implemented

	// Input Format = address, city, statce-code, zip
	public $address = null;

	// URL for Google Maps API
	public $url = 'http://maps.google.com/maps/geo?&output=xml&key=';

	// This will key obatined from http://code.google.com/apis/maps/signup.html
	public $key = null;

	//The final API URL
	public $api = '';

	/**
	* Std Class returned
	* The object has 3 data segment
	* 1. setup  : returns the extension config params used
	* 2. status :
	*    error   = {true|false}
	*    code    = {error code from google or custom| custom starts with 9XX}
	*    request = geocode (always)
	*    input   = query string used, spaces, tabs and newline stripped
	*    places  = Numbers of Placemarks found
	*    short   = short description of google status code
	*    lomg    = long description of googles status code
	*    result  = {place|places}
	*              if single Placemark found, the result is place, an object of placemark
	*              if multiple Placemarks found, the result is places, array of object placemarks/place
	* 3. place | places : Result of API call, see staus->result for detail
	*      Should be self explanatory
           [accuracy]
           [address]
           [country]
           [state]
           [county]
           [city]
           [street]
           [zip]
           [north]
           [south]
           [east]
           [west]
		   [latitude]
           [longitude]
	*/
	public $data = null;

    public function init()
	{
		//libxml_use_internal_errors(true);
		if (!extension_loaded('simpleXML')) {
			$this->data->status->error = true;
			$this->data->status->code  = '911';
			$this->data->status->msg   = 'simpleXML extension is not enabled!';
			return $this->data;
		}

		if ($this->AccuracyHigh) {
			$this->AccuracyMed = false;
			$this->AccuracyLow = false;
			$this->data->Setup->Accuracy = 'AccuracyHigh';
		}

		if ($this->AccuracyMed) {
			$this->AccuracyLow = false;
			$this->data->setup->Accuracy = 'AccuracyMed';
		}

		$this->data->setup->CountryCheck   = $this->CountryCheck;
		$this->data->setup->AddressDetails = $this->AddressDetails;
		$this->data->setup->ExtendedData   = $this->ExtendedData;
		$this->data->setup->Points         = $this->Points;
		$this->data->setup->APIStatus      = $this->APIStatus;

	}


	public function getGeocode($address)
	{
		//$address = 'dxdd 33';
		$address = 'sugar lake, MO, 63376';
		//$address = '909 sugar lake ct, st. peters, MO, 63376';

		$this->api = $this->makeAPIUrl($address);

		// Retrieve the XML
		$rXML = simplexml_load_file($this->api);

		if (!$rXML) {
			$this->data->status->error = true;
			$this->data->status->code  = '912';
			$this->data->status->msg   = 'Location unknown!';
			return $this->data;
		}

		$this->data->status->error = false;
		$this->data->status->code    = (string)$rXML->Response->Status->code;
		$this->data->status->request = (string)$rXML->Response->Status->request;
		$this->data->status->input   = (string)$rXML->Response->name;
		$this->data->status->places  = count($rXML->Response->Placemark);

		if ($this->APIStatus) $this->geoStatus();

		switch(true) {
			case $this->AccuracyHigh:
                if ($this->data->status->places > 1) {
					$this->data->status->error = true;
					$this->data->status->code  = '913';
					$this->data->status->msg   = 'More than one match';
					return $this->data;
			    }
				else {
					$this->data->place = $this->makePlace($rXML->Response->Placemark);
					$this->data->status->result  = 'place';
				}
				break;
			case $this->AccuracyMed:
				$this->data->places = $this->makePlaces($rXML->Response->Placemark);
				$this->data->status->result  = 'places';
				break;
			default:
				$this->data->status->error = true;
				$this->data->status->code  = '914';
				$this->data->status->msg   = 'Set up Error';
				break;
		}
		return $this->data;
	}

	private function makePlace($Placemark) {
		$place->accuracy = (integer)$Placemark->AddressDetails->attributes()->Accuracy;

		if ( ($this->AccuracyHigh) && ($place->accuracy < 8) ) echo "error";

		if ( ($this->AccuracyMed ) && ($place->accuracy < 6) ) echo "error";

		if ($place->accuracy == 0) echo "error";

		$place->address  = (string) $Placemark->address;

		$country  = (string)$Placemark->AddressDetails->Country->CountryNameCode;
        if ($this->CountryCheck) {
			$found = in_array($country, $this->ISO3166);
			if (!$found) {
				$place = "r $country error";
				return $place;
			}
		}

		if ($this->AddressDetails) {
			$AddressDetails        = $Placemark->AddressDetails;
			$AdministrativeArea    = $AddressDetails->Country->AdministrativeArea;
			$SubAdministrativeArea = $AdministrativeArea->SubAdministrativeArea;

			$place->country = (string)$AddressDetails->Country->CountryNameCode;
			$place->state   = (string)$AdministrativeArea->AdministrativeAreaName;
			$place->county  = (string)$SubAdministrativeArea->SubAdministrativeAreaName;
			$place->city    = (string)$SubAdministrativeArea->Locality->LocalityName;
			$place->street  = (string)$SubAdministrativeArea->Locality->Thoroughfare->ThoroughfareName;
			$place->zip     = (string)($SubAdministrativeArea->Locality->PostalCode->PostalCodeNumber);
		}

		if ($this->ExtendedData) {
			$ExtendedData     = $Placemark->ExtendedData->LatLonBox;
			foreach($ExtendedData->attributes() as $direction => $point) {
				$place->$direction = (float)$point;
			}
		}

		list($lng, $lat, $altitude) = explode(",", $Placemark->Point->coordinates);
		if ($lat):
			$place->latitude  = $lat;
			$place->longitude = $lng;
			$place->altitude  = $altitude;
		endif;

		return $place;
	}


	private function makePlaces($Placemarks) {
		foreach ($Placemarks as $x => $Placemark) {
		   $places[] = $this->makePlace($Placemark);
		}
		return $places;
	}

	private function makeAPIUrl($address) {
        // Replace all spaces, tabs and newlines, the urlencode
		$this->address = urlencode(preg_replace('/\s\s+/', ' ',$address));

		// Construct the final API URL
		return $this->url . $this->key . '&q=' . $this->address;
	}


	private function geoStatus() {
	    //Ref: http://code.google.com/apis/maps/documentation/reference.html#GGeoStatusCode
		switch ($this->data->status->code) {
			case 200:
				$this->data->status->short = 'G_GEO_SUCCESS';
				$this->data->status->long  = 'No errors occurred; the address was successfully parsed and its geocode has been returned.';
				break;

			case 400:
				$this->data->status->short = 'G_GEO_BAD_REQUEST';
				$this->data->status->long  = 'A directions request could not be successfully parsed. For example, the request may have been rejected if it contained more than the maximum number of waypoints allowed.';
				break;

			case 500:
				$this->data->status->short = 'G_GEO_SERVER_ERROR';
				$this->data->status->long  = 'A geocoding, directions or maximum zoom level request could not be successfully processed, yet the exact reason for the failure is not known.';
				break;

			case 601:
				$this->data->status->short = 'G_GEO_MISSING_QUERY';
				$this->data->status->long  = 'The HTTP q parameter was either missing or had no value. For geocoding requests, this means that an empty address was specified as input. For directions requests, this means that no query was specified in the input.';
				break;

			case 602:
				$this->data->status->short = 'G_GEO_UNKNOWN_ADDRESS';
				$this->data->status->long  = 'No corresponding geographic location could be found for the specified address. This may be due to the fact that the address is relatively new, or it may be incorrect.';
				break;

			case 603:
				$this->data->status->short = 'G_GEO_UNAVAILABLE_ADDRESS';
				$this->data->status->long  = 'The geocode for the given address or the route for the given directions query cannot be returned due to legal or contractual reasons.';
				break;

			case 604:
				$this->data->status->short = 'G_GEO_UNKNOWN_DIRECTIONS';
				$this->data->status->long  = 'The GDirections object could not compute directions between the points mentioned in the query. This is usually because there is no route available between the two points, or because we do not have data for routing in that region.';
				break;

			case 610:
				$this->data->status->short = 'G_GEO_BAD_KEY';
				$this->data->status->long  = 'The given key is either invalid or does not match the domain for which it was given.';
				break;

			case 620:
				$this->data->status->short = 'G_GEO_TOO_MANY_QUERIES';
				$this->data->status->long  = 'The given key has gone over the requests limit in the 24 hour period or has submitted too many requests in too short a period of time. If you\'re sending multiple requests in parallel or in a tight loop, use a timer or pause in your code to make sure you don\'t send the requests too quickly.';
				break;
			}
	}
}