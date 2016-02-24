<?php

namespace App\Controller;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use App\Model\Table;
use Cake\Log\Log;
use App\DTO\DownloadDTO;

/**
 * Description of OrderController
 *
 * @author niteen
 */
class OrderController extends ApiController {

    private $insert = 'insert';
    private $update = 'update';

    private function getTableObj() {
        return new Table\OrderTable();
    }

    public function getMaxOrderNo($restaurantId) {
        $orderNo = $this->getTableObj()->getOrderNo($restaurantId);
        if ($orderNo) {
            return $orderNo + 1;
        } else {
            return 1;
        }
    }

    public function addOrderEntry($orderEntry) {
        $orderNo = $this->getTableObj()->insert($orderEntry);
        if ($orderNo) {
            $this->makeSyncEntry($orderEntry);
        }
        return $orderNo;
    }


    private function makeSyncEntry($orderEntry) {
        $newOrder = $this->getTableObj()->getOrder($orderEntry->orderId);
        if ($newOrder) {
            $syncController = new SyncController();
            $result = $syncController->orderEntry(
                    $orderEntry->userId, 
                    json_encode($newOrder), 
                    $this->insert, 
                    $orderEntry->restaurantId);
        }
    }

    public function getCustomerOrders($custId, $restaurantId) {
        if($this->orderCheck($custId, $restaurantId, PLACED_ORDER_STATUS)){
            return null;
        }
        return $this->getTableObj()->getCustomerOrderList($custId, $restaurantId);
    }
    
    public function changeOrderStatus($orderId, $status, $restaurantId) {
        
        $statusResult = $this->getTableObj()->changeStatus($orderId, $status);
        if($statusResult){
            $orderStatusDto = new DownloadDTO\OrderStatusDto($orderId, $status);
             $syncController = new SyncController();
            $result = $syncController->orderEntry(
                    NULL, 
                    json_encode($orderStatusDto), 
                    UPDATE_OPERATION, 
                    $restaurantId);
        }
        return $statusResult;
    }
    
    public function orderCheck($custId, $restaurantId, $orderStatus) {
        return $this->getTableObj()->IsOrderPresent($custId, $restaurantId, $orderStatus);
    }

}
