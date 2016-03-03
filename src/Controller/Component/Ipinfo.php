<?php
namespace App\Controller\Component;

use App\DTO\UploadDTO;
class Ipinfo {
	const BASE_URL = "http://ipinfo.io/";
	const IP = "ip";
	const HOSTNAME = "hostname";
	const LOC = "loc";
	const ORG = "org";
	const CITY = "city";
	const REGION = "region";
	const COUNTRY = "country";
	const PHONE = "phone";
	const GEO = "geo";
	const POSTAL = "postal";
	protected $settings;
	public function __construct($settings = array()){
		$this->settings = array_merge(array(
				'token' => '',
				'debug' => false
		), $settings);
	}
	public function getYourOwnIpDetails(){
		$response = $this->makeCurlRequest($this::BASE_URL . "json");
		$response = json_decode($response, true);
		return new Host($response);
	}
	public function getFullIpDetails($imei,UploadDTO\NetworkDeviceInfoDto $networkDeviceInfoDto, $ipAddress){
		$response = $this->makeCurlRequest($this::BASE_URL . $ipAddress);
		$response = json_decode($response, true);
                $networkDeviceInfoDto->imei = $imei;
                $networkDeviceInfoDto->ip = $response['ip'];
                if(key_exists('city', $response) and key_exists('region', $response) and key_exists('country', $response)){
                    $networkDeviceInfoDto->city = $response['city'];
                    $networkDeviceInfoDto->region = $response['region'];
                    $networkDeviceInfoDto->country = $response['country'];
                }  else {
                    $networkDeviceInfoDto->city = null;
                    $networkDeviceInfoDto->region = null;
                    $networkDeviceInfoDto->country = null;
                }
                \Cake\Log\Log::debug("response send to database for ip : ".$ipAddress);
		return $networkDeviceInfoDto;
	}
	public function getSpecificField($ipAddress, $field){
		$response = $this->makeCurlRequest($this::BASE_URL . $ipAddress . "/" . $field);
		$response = $this->checkGeo($field, $response);
		return $response;
	}
	public function getYourOwnIpSpecificField($field){
		$response = $this->makeCurlRequest($this::BASE_URL . $field);
		$response = $this->checkGeo($field, $response);
		return $response;
	}
	public function getIpGeoDetails($ipAddress)
	{
		return $this->getSpecificField($ipAddress, $this::GEO);
	}
	private function checkGeo($field, $response){
		if($field == $this::GEO){
			$response = json_decode($response, true);
			$response = new Host($response);
		}
		else{
			$response = substr($response, 0, -1);
		}
		
		return $response;
	}
	private function makeCurlRequest($address){
		$curl = curl_init();
		
		if(!empty($this->settings['token'])){
			$address .= "?token=" . $this->settings['token'];
		}
		
		if($this->settings['debug']){
			echo "Request address: " . $address . "\n";
		}
		
		curl_setopt_array($curl, array(
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => $address
		));
		
		$response = curl_exec($curl);
		
		curl_close($curl);
		
		return $response;
	}
}