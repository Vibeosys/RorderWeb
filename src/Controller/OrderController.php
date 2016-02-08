<?php
namespace App\Controller;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use App\Model\Table;
use Cake\Log\Log;
/**
 * Description of OrderController
 *
 * @author niteen
 */
class OrderController extends ApiController{
    
    private $insert = 'insert';
    private $update = 'update';
    
    private function getTableObj() {
        return new Table\OrderTable();
    }
    
    public function getMaxOrderNo($restaurantId){
        $orderNo = $this->getTableObj()->getOrderNo($restaurantId);
        if($orderNo){
            return $orderNo + 1;
        }            
        else {
            return 1;   
        }
    }
    
    public function addOrderEntry($orderEntry)    {
        return $this->getTableObj()->insert($orderEntry);
    }
       
    public function updateOrder($userId, $restaurantId, $orderDto) {
        $result = $this->getTableObj()->update($orderDto->orderId, $orderDto->orderNo, 
                $orderDto->orderStatus, $orderDto->orderAmount);
        if($result){
              $this->makeSyncEntry($userId, $restaurantId,  $this->update, $orderDto->orderId);
              Log::debug('New order Update insert into sync for all user');
              return $result;
          }
    }
    
    private function makeSyncEntry($userId, $restaurantId,$operation, $orderId) {
        $newOrder = $this->getTableObj()->getOrder($orderId);
              if($newOrder){
              $syncController = new SyncController();
              $syncController->orderEntry($userId, json_encode($newOrder), $operation, $restaurantId);
              }
        
    }
    
    
    
    
}
