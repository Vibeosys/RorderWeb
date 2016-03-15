<?php

namespace App\Controller;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use App\Model\Table;
use Cake\Log\Log;
use App\DTO\UploadDTO;
use App\DTO\DownloadDTO;
use App\DTO;

/**
 * Description of OrderDetailsController
 *
 * @author niteen
 */
class OrderDetailsController extends ApiController {

    private $insert = 'insert';
    private $update = 'update';

    private function getTableObj() {
        return new Table\OrderDetailsTable();
    }

    public function addOrderEntries($orderDetailsList, $userInfo) {
        $orderCounter = 0;
        foreach ($orderDetailsList as $orderDetailsEntry) {
            $orderDetailsId = $this->getTableObj()->insert($orderDetailsEntry);
            if ($orderDetailsId) {
                $this->makeSyncEntry($userInfo, $orderDetailsId);
                $orderCounter ++;
            }
        }
        return $orderCounter;
    }

    private function makeSyncEntry($userInfo, $orderDetailsId) {
        $newOrderDetails = $this->getTableObj()->getOrderDetails($orderDetailsId);
        if ($newOrderDetails) {
            $syncController = new SyncController();
            $orderDetailsEntry = $syncController->orderDetailsEntry(
                    $userInfo->userId, 
                    json_encode($newOrderDetails), 
                    $this->insert, 
                    $userInfo->restaurantId);
            if ($orderDetailsEntry) {
                $this->transCommit();
            } else {
                $this->transRollback();
            }
        }
    }
    
    public function getbillOrderDetails($orders) {
        if(is_array($orders)){
            return $this->getTableObj()->getDetails($orders);
        }
        return NULL;
    }
    
    public function orderPrintPreview() {
        $result = isset($_COOKIE['coi']);
        if(1){
            $orderId = $_COOKIE['coi'];
            $orderNo = $_COOKIE['cono'];
            $tableNo = $_COOKIE['ctno'];
            $userName = $_COOKIE['csb'];
            $orderTime = $_COOKIE['cot'];
            $orderDetails = $this->getTableObj()->getKotDetails($orderId);
            Log::debug('letest order details :-'.json_encode($orderDetails));
            $this->set([
                'orderNo' => $orderNo,
                'tableNo' => $tableNo,
                'user' => $userName,
                'time' => $orderTime,
                'menus' => $orderDetails
                ]);
        }else{
          $this->set([MESSAGE => DTO\ErrorDto::prepareMessage(126)]);
        }
    
    }

}
