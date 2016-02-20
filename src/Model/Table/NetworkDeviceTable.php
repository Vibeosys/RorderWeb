<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model\Table;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Log\Log;
use App\DTO\UploadDTO;
/**
 * Description of NetworkDeviceTable
 *
 * @author niteen
 */
class NetworkDeviceTable extends Table{
    
    private function connect() {
        return TableRegistry::get('network_device_info');
    }
    
    public function insert(UploadDTO\NetworkDeviceInfoDto $networkDeviceDto) {
        $tableObj = $this->connect();
        $newEntry = $tableObj->newEntity();
        $newEntry->IMEI = $networkDeviceDto->imei;
        $newEntry->IpAddress = $networkDeviceDto->ip;
        $newEntry->City = $networkDeviceDto->city;
        $newEntry->Region  = $networkDeviceDto->region;
        $newEntry->Country = $networkDeviceDto->country;
        $newEntry->Brand = $networkDeviceDto->brand;
        $newEntry->Board = $networkDeviceDto->board;
        $newEntry->Manufacturer = $networkDeviceDto->manufacturer;
        $newEntry->Model = $networkDeviceDto->model;
        $newEntry->Product = $networkDeviceDto->product;
        $newEntry->FmVersion = $networkDeviceDto->fmVersion;
        if($tableObj->save($newEntry)){
            Log::debug("User Network Device Info save in database for userid : ".$networkDeviceDto->imei);
            return true;
        }
        Log::error("User Network Device Info not save in database for userid : ".$networkDeviceDto->imei);
        return false;
    }
}
