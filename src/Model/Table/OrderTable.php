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
use Cake\Datasource\ConnectionManager;

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
        $newOrder->TakeawayNo = $orderEntry->takeawayNo;
        $newOrder->DeliveryNo = $orderEntry->deliveryNo;
        $newOrder->OrderType = $orderEntry->orderType;
        if ($tableObj->save($newOrder)) {
            Log::debug('order has been placed for OrderId :-' .
                    $orderEntry->orderId);
            return array('orderId' => $orderEntry->orderId,'orderNo' => $orderEntry->orderNo);
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

//    public function isOrderPresent($orderId) {
//        $order = $this->connect()->find()->where(['OrderId =' => $orderId]);
//        Log::debug('order count for orderId :- ' . $orderId);
//        return $order->count();
//    }

    public function getOrderNo($restaurantId) {
        $datasource = ConnectionManager::config('default');
        $connection = mysql_connect($datasource['host'], $datasource['username'], $datasource['password']);
        mysql_select_db($datasource['database'], $connection);
        $query = "call RestaurantDB.getMaxOrderNo(".$restaurantId.", @ordermaxno);";
        $result =  mysql_query($query);
        $data = mysql_fetch_assoc($result);
        mysql_close($connection);
        return  $data['maxId'];
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
                        $order->OrderAmount, 
                        $order->UserId, 
                        $order->TableId,
                        $order->CustId,
                        $order->TakeawayNo,
                        $order->OrderType);
            }
        }
        return $orderDto;
    }

    public function getCustomerOrderList($custId, $restaurantId) {
        $allOrders = NULL;
        $condition = ['CustId =' => $custId, 
            'RestaurantId =' => $restaurantId, 
            'OrderStatus =' => FULFILLED_ORDER_STATUS];
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
    
    public function IsOrderPresent($custId, $restaurantId, $orderStatus) {
        $condition = [
            'CustId =' => $custId, 
            'RestaurantId =' => $restaurantId, 
            'OrderStatus =' => $orderStatus];
            $orders = $this->connect()->find()
                ->where($condition);
            $count = $orders->count();
        if ($count){
            return true;
        }
        return false;
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
            Log::error('Error occured in changing order Status for orderId : '.$orderId);
            return false;
        } catch (Exception $ex) {
            return false;
        }
    }
    
    public function getTableOrders($tableId, $takeawayNo,$deliveryNo, $restaurantId, $all) {
          $allOrders = NULL;
          
           $condition = ['RestaurantId =' => $restaurantId];
           if($all){
               $condition['OrderStatus !='] = BILLED_ORDER_STATUS;
           }  else {
                $condition['OrderStatus ='] = FULFILLED_ORDER_STATUS;
           }
                if($tableId){
                    $condition['TableId ='] = $tableId;
                }  else if($takeawayNo){
                    $condition['TakeawayNo ='] = $takeawayNo;
                }elseif ($deliveryNo) {
                    $condition['DeliveryNo ='] = $deliveryNo;
                }
            $condition['Active ='] = ACTIVE;     
           $orders = $this->connect()->find()
                ->where($condition)->orderDesc('OrderNo');
        if ($orders->count()) {
            $allOrders = array();
            $counter = 0;
            foreach ($orders as $order) {
                $orderDto = new DownloadDTO\OrderShowDownloadDto(
                        $order->OrderId, 
                        $order->OrderNo, 
                        $order->OrderTime, 
                        $order->UserId, 
                        $order->TableId,
                        $order->TakeawayNo,
                        $order->OrderType,
                        $order->DeliveryNo);

                $allOrders[$counter++] = $orderDto;
            }
        }
        return $allOrders;
    }
    public function deleteOrder($orderId) {
        
        $order = $this->connect()->get($orderId);
        $order->Active = 0;
        if($this->connect()->save($order)){
            return TRUE;
        }
        return FALSE;
    }
    
     public function getOrderStatus($orderId) {
        $orders = $this->connect()->find()->where(['OrderId =' => $orderId]);
        if ($orders->count()) {
            foreach ($orders as $order)
                return  $order->OrderStatus;
        }
        return FALSE;
    }

}
