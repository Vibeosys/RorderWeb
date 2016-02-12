<?php

namespace App\Model\Table;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Log\Log;
use App\DTO\DownloadDTO;
use App\DTO\UploadDTO;

/**
 * Description of OrderTable
 *
 * @author niteen
 */
class OrderTable extends Table {

    private function connect() {
        return TableRegistry::get('orders');
    }

    public function insert($orderEntry) {
        $tableObj = $this->connect();
        $newOrder = $tableObj->newEntity();
        $newOrder->OrderId = $orderEntry->orderId;
        $newOrder->OrderNo = $orderEntry->orderNo;
        $newOrder->CustId = $orderEntry->custId;
        $newOrder->OrderStatus = $orderEntry->orderStatus;
        $newOrder->OrderDate = $orderEntry->orderDt;
        $newOrder->OrderTime = $orderEntry->orderTm;
        $newOrder->CreatedDate = date('Y-m-d H:i:s');
        $newOrder->UpdatedDate = date('Y-m-d H:i:s');
        $newOrder->OrderAmount = $orderEntry->orderAmt;
        $newOrder->UserId = $orderEntry->userId;
        $newOrder->TableId = $orderEntry->tableId;
        $newOrder->RestaurantId = $orderEntry->restaurantId;
        if ($tableObj->save($newOrder)) {
            Log::debug('order has been placed for OrderId :-' .
                    $orderEntry->orderId);
            return $newOrder->OrderNo;
        }
        Log::error('error ocurred in order placing for OrderId :-' .
                $orderEntry->orderId);
        return 0;
    }

    public function update($orderId, $orderNo, $orderStatus, $orderAmount) {
        $tableObj = $this->connect();
        $oldOrder = $tableObj->query()->update();
        $udate = date('Y-m-d H:i:s');
        $oldOrder->set(['OrderStatus =' => $orderStatus, 'OrderAmount = ' => $orderAmount, 'UpdatedDate = ' => $udate]);
        $oldOrder->where(['OrderId =' => $orderId, 'OrderNo = ' => $orderNo]);
        if ($oldOrder->execute()) {
            Log::debug('order has been updated for OrderId :-' . $orderId . 'date = ' . $udate);
            return true;
        }
        Log::error('error ocurred in order updation for OrderId :-' . $orderId);
        return false;
    }

    public function isOrderPresent($orderId) {
        $order = $this->connect()->find()->where(['OrderId =' => $orderId]);
        Log::debug('order count for orderId :- ' . $orderId);
        return $order->count();
    }

    public function getOrderNo($restaurantId) {
        $conditions = array(
            'conditions' => array('orders.RestaurantId =' => $restaurantId),
            'fields' => array('maxOrderNo' => 'MAX(orders.OrderNo)'));
        $orderTableEntry = $this->connect()->find('all', $conditions)->toArray();
        $maxOrderNo = 0;
        if ($orderTableEntry) {
            $maxOrderNo = $orderTableEntry[0]['maxOrderNo'];
        }
        Log::debug('Order Number generated for new order orderNo is :- ' . $maxOrderNo);
        return $maxOrderNo;
    }

    public function getOrder($orderId) {
        $orderDto = NULL;
        $orders = $this->connect()->find()->where(['OrderId =' => $orderId]);
        if ($orders->count()) {
            foreach ($orders as $order) {
                $orderDto = new DownloadDTO\OrderDownloadDto(
                        $order->OrderId, 
                        $order->OrderNo, 
                        $order->OrderStatus, 
                        $order->OrderDate, 
                        $order->OrderTime, 
                        $order->CreatedDate, 
                        $order->UpdatedDate, 
                        $order->OrderAmount, 
                        $order->UserId, 
                        $order->TableId,
                        $order->CustId);
            }
        }
        return $orderDto;
    }

    public function getCustomerOrderList($custId, $restaurantId) {
        $allOrders = NULL;
        $condition = ['CustId =' => $custId, 'RestaurantId =' => $restaurantId, 'OrderStatus =' => 2];
        $orders = $this->connect()->find()
                ->where($condition);
        if ($orders->count()) {
            $allOrders = array();
            $counter = 0;
            foreach ($orders as $order) {
                $orderDto = new UploadDTO\CustomerOrderListDto(
                        $order->OrderId, 
                        $order->OrderNo, 
                        $order->OrderAmount, 
                        $order->UserId, 
                        $order->TableId);

                $allOrders[$counter++] = $orderDto;
            }
            Log::debug('Orders are retrived for customer ID : ' . $custId);
        }
        return $allOrders;
    }
    
    public function changeStatus($orderId, $status) {
        try{
            $oldOrder = $this->connect()->query()->update();
            $oldOrder->set(['OrderStatus' => $status]);
            $oldOrder->where(['OrderId =' =>$orderId ]);
            if($oldOrder->execute()){
                Log::debug('Order Status has been changed to : '.$status);
                return true;
            }
            Log::error('Error occured in changing order Status for custId : '.$custId);
            return false;
        } catch (Exception $ex) {
            return false;
        }
    }

}
