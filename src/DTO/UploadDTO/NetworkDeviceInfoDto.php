<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DTO\UploadDTO;
use App\DTO;
/**
 * Description of NetworkDeviceInfoDto
 *
 * @author niteen
 */
class NetworkDeviceInfoDto extends DTO\JsonDeserializer{
    
  
    public $imei;
    public $brand;
    public $board;
    public $manufacturer;
    public $model;
    public $product;
    public $fmVersion;
    public $ip;
    public $city;
    public $region;
    public $country;
    
    public function __construct($imei = null, $brand = null, $board = null, $manufacturer = null, $model = null, $product = null, $fmVersion = null,$ip = null, $city = null, $region = null, $country = null) {
        $this->imei = $imei;
        $this->brand = $brand;
        $this->board = $board;
        $this->manufacturer = $manufacturer;
        $this->model = $model;
        $this->product = $product;
        $this->fmVersion = $fmVersion;
        $this->ip = $ip;
        $this->city = $city;
        $this->region = $region;
        $this->country = $country;
        
    }
}
