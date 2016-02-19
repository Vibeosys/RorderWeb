<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;
use App\Model\Table;
use App\DTO\UploadDTO;
use Cake\Log\Log;
/**
 * Description of NetworkDeviceController
 *
 * @author niteen
 */
class NetworkDeviceController extends ApiController{
    private function getTableObj() {
        return new Table\NetworkDeviceTable();
    }
    
    public function addNetworkDeviceInfo(
            UploadDTO\NetworkDeviceInfoDto $networkDeviceInfoDto, 
            $restaurantId) {
        $restaurantIMEIController = new RestaurantImeiController();
        if($restaurantIMEIController->isPresent(
                $restaurantId, 
                $networkDeviceInfoDto->imei)){
            return $this->getTableObj()->insert($networkDeviceInfoDto);
        }
        return false;
    }
    
}
