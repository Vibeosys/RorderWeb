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
            $restaurantId, $macId) {
        $restaurantIMEIController = new RestaurantImeiController();
        if($restaurantIMEIController->isPresent(
                $restaurantId, 
                $networkDeviceInfoDto->imei,$macId)){
            return $this->getTableObj()->insert($networkDeviceInfoDto);
        }
        return false;
    }
    
    public function deviceList() {
        $info = $this->getTableObj()->getAllDevice();
        if($info){
            $this->set([
            'rows' => $info]);
        }
    }
    
}
