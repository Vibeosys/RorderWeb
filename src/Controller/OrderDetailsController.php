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
 * Description of OrderDetailsController
 *
 * @author niteen
 */
class OrderDetailsController extends ApiController{
    
    private $insert = 'insert';
    private $update = 'update';
    
    private function getTableObj() {
        return new Table\OrderDetailsTable();
    }
    
    public function placeOrderDetails($userId, $restaurantId, $orderDetailsDto) {
      if($this->getTableObj()->isOrderDetailsPresent($orderDetailsDto->orderDetailsId)){
          Log::debug('order details forword for updation');
          return  $this->updateOrderDetails($userId, $restaurantId, $orderDetailsDto);
      }else{
          Log::debug('New order Arrived for place');
          $result = $this->getTableObj()->insert($orderDetailsDto->orderDetailsId, $orderDetailsDto->orderPrice, 
                  $orderDetailsDto->orderQuantity, $orderDetailsDto->orderId, $orderDetailsDto->menuId, 
                  $orderDetailsDto->menuTitle);
          if($result){
              $this->makeSyncEntry($userId, $restaurantId,  $this->insert, $orderDetailsDto->orderDetailsId);
              Log::debug('New order Deatils Update insert into sync for all user');
              return $result;
          }
      }
      return false;
    }
    
    public function updateOrderDetails($userId, $restaurantId, $orderDetailsDto) {
        $result = $this->getTableObj()->update($orderDetailsDto->orderDetailsId, $orderDetailsDto->orderPrice, 
                $orderDetailsDto->orderQuantity, $orderDetailsDto->orderId);
        if($result){
              $this->makeSyncEntry($userId, $restaurantId,  $this->update, $orderDetailsDto->orderDetailsId);
              Log::debug('New order Update insert into sync for all user');
              return $result;
          }
    }
    
    private function makeSyncEntry($userId, $restaurantId,$operation, $orderDetailsId) {
        $newOrderDetails = $this->getTableObj()->getOrderDetails($orderDetailsId);
              if($newOrderDetails){
              $syncController = new SyncController();
              $syncController->orderEntry($userId, json_encode($newOrderDetails), $operation, $restaurantId);
              }
        
    }
    
    
}
