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
use App\DTO;

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
            $orderEntry->tableId = $this->isNull($orderEntry->tableId);
            $orderEntry->takeawayNo = $this->isNull($orderEntry->takeawayNo);
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
            $this->response->body(DTO\ErrorDto::prepareError(106));
            $this->response->send();
            return null;
        }
        $result =  $this->getTableObj()->getCustomerOrderList($custId, $restaurantId);
        if(is_null($result)){
            $this->response->body(DTO\ErrorDto::prepareError(118));
             $this->response->send();
        }
        return $result;
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
    
    public function getLatestOrders($tableId, $takeawayNo, $restaurantId) {
        return $this->getTableObj()->getTableOrders($tableId, $takeawayNo, $restaurantId);
    }
    
    public function displayOrders() {
        $restId = parent::readCookie('cri');
        $result = key_exists('cti', $_COOKIE);
        Log::debug('Current restaurantId in order controller :- '.$restId);
        if(isset($restId) and $result){
            $tableId = $_COOKIE['cti'];
            $takeawayNo = $_COOKIE['ctn'];
            Log::debug('Now order list shows for table :-'.$tableId);
            $latestOrders = $this->getLatestOrders($tableId,$takeawayNo, $restId);
            if(is_null($latestOrders)){
                $this->set([MESSAGE => DTO\ErrorDto::prepareMessage(126)]);
                return;
            }
            $userController = new UserController();
            $rtableController = new RTablesController();
            foreach ($latestOrders as $order){
                $user = $userController->getUserName($order->user);
                $order->user = $user->userName;
                $order->tableId = $rtableController->getBillTableNo($order->tableId);
                $order->orderTime = date('H:i',strtotime('+330 minutes',strtotime($order->orderTime)));
                $order->tableId = $this->isNull($order->tableId);
                $order->takeawayNo = $this->isNull($order->takeawayNo);
            }
            $this->set(['orders' => $latestOrders]);
        }
        $this->set([MESSAGE => DTO\ErrorDto::prepareMessage(126)]);
    }

}
