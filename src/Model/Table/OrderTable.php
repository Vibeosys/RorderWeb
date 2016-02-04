<?php
namespace App\Model\Table;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use App\DTO\UploadDTO;
use Cake\Log\Log;
use App\DTO\DownloadDTO;
/**
 * Description of OrderTable
 *
 * @author niteen
 */
class OrderTable extends Table{
    
    
    private function connect() {
        return TableRegistry::get('orders');
    }
    
    public function insert($orderId, $orderNo, $custId, $orderStatus, $orderDate, $orderTime, $orderAmount, $userId, $tableId) {
        $tableObj = $this->connect();
        $newOrder = $tableObj->newEntity();
        $newOrder->OrderId = $orderId;
        $newOrder->OrderNo = $orderNo;
        $newOrder->CustId = $custId;
        $newOrder->OrderStatus = $orderStatus;
        $newOrder->OrderDate = $orderDate;
        $newOrder->OrderTime = $orderTime;
        $newOrder->CreatedDate = date('Y-m-d H:i:s');
        $newOrder->UpdatedDate = date('Y-m-d H:i:s');
        $newOrder->OrderAmount = $orderAmount;
        $newOrder->UserId = $userId;
        $newOrder->TableId = $tableId;
        if($tableObj->save($newOrder)){
            Log::debug('order has been placed for OrderId :-'.$orderId);
            return $newOrder->OrderNo;
        }
        Log::error('error ocurred in order placing for OrderId :-'.$orderId);
        return false;
    }
    
    public function update($orderId, $orderNo, $orderStatus , $orderAmount) {
        $tableObj = $this->connect();
        $oldOrder = $tableObj->query()->update();
        $udate = date('Y-m-d H:i:s');
        $oldOrder->set(['OrderStatus =' =>$orderStatus, 'OrderAmount = ' =>$orderAmount,'UpdatedDate = ' => $udate]);
        $oldOrder->where(['OrderId =' => $orderId, 'OrderNo = ' =>$orderNo]);
        if($oldOrder->execute()){
            Log::debug('order has been updated for OrderId :-'.$orderId .'date = '.$udate);
                return true;
            }
            Log::error('error ocurred in order updation for OrderId :-'.$orderId);
            return false;
    }
    
    public function isOrderPresent($orderId) {
        $order = $this->connect()->find()->where(['OrderId =' => $orderId]);
        Log::debug('order count for orderId :- '.$orderId);
        return $order->count();
    }
    
    public function getOrderNo() {
        $order = $this->connect()->find();
        Log::debug('Order Number generated for new order orderNo is :- '.$order->count());
        return $order->count() + 1;
    }
    
    public function getOrder($orderId) {
        $orders = $this->connect()->find()->where(['OrderId =' => $orderId]);
        if($orders->count()){
            foreach ($orders as $order)
            {
                $orderDto = new DownloadDTO\OrderDownloadDto($order->OrderId, $order->OrderNo, 
                    $order -> CustId, $order->OrderStatus, $order->OrderDate, $order->OrderTime, 
                    $order->CreatedDate, $order->UpdatedDate, $order->OrderAmount, 
                    $order->UserId, $order->TableId);
            }
            return $orderDto;
        }
    }
}
