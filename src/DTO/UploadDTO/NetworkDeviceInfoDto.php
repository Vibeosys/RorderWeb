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
}
