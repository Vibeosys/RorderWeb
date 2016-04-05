<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;
use App\Model\Table;
/**
 * Description of DeliveryController
 *
 * @author niteen
 */
class DeliveryController extends ApiController{
    
    public function getTableObj() {
        return New Table\DeliveryTable();
    }
    
    public function getDeliveryNo($restaurantId) {
         return  $this->getTableObj()->getMaxNo($restaurantId) + 1;
    }
    
    public function addDeliveryEntry($deliveryRequest, $userInfo) {
        $deliveryResult = $this->getTableObj()->insert(
                $deliveryRequest, 
                $userInfo->restaurantId);
        if($deliveryResult){
            $deliveryEntry = $this->getTableObj()->getSingleDelivery(
                    $deliveryResult, $userInfo->restaurantId);
            $syncController = new SyncController();
            $syncResult = $syncController->deliveryEntry(
                    $deliveryRequest->userId, 
                    json_encode($deliveryEntry), 
                    INSERT_OPERATION, 
                    $userInfo->restaurantId);
        }
        return $deliveryResult;
    }
}
