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
use App\DTO\UploadDTO;
use App\DTO\DownloadDTO;
/**
 * Description of OrderDetailsTable
 *
 * @author niteen
 */
class OrderDetailsTable extends Table{
    
    private function connect() {
        return TableRegistry::get('order_details');
    }
    public function insert($orderDetailsId, $orderPrice, $orderQuantity, $orderId, $menuId, $menuTitle) {
        $tableObj = $this->connect();
        $newOrder = $tableObj->newEntity();
        $newOrder->OrderDetailsId = $orderDetailsId;
        $newOrder->OrderPrice = $orderPrice;
        $newOrder->OrderQuantity = $orderQuantity;
        $newOrder->CreatedDate = date('Y-m-d H:i:s');
        $newOrder->UpdatedDate = date('Y-m-d H:i:s');
        $newOrder->OrderId = $orderId;
        $newOrder->MenuId = $menuId;
        $newOrder->MenuTitle = $menuTitle;
        if($tableObj->save($newOrder)){
            Log::debug('order Details has been saved for OrderDetailsId :-'.$orderDetailsId);
            return $newOrder->OrderDetailsId;
        }
        Log::error('error ocurred in order Details for OrderDetailsId :-'.$orderDetailsIdId);
        return false;
    }
    
    public function update($orderDetailsId, $orderPrice, $orderQuantity, $orderId) {
        $tableObj = $this->connect();
        $oldOrder = $tableObj->query()->update();
        $udate = date('Y-m-d H:i:s');
        $oldOrder->set(['OrderPrice =' =>$orderPrice, 'OrderQuantity = ' =>$orderQuantity,'UpdatedDate = ' => $udate]);
        $oldOrder->where(['OrderDetailsId =' => $orderDetailsId, 'OrderId = ' =>$orderId]);
        if($oldOrder->execute()){
            Log::debug('order details has been updated for OrderDetailsId :-'.$orderDetailsId .'date = '.$udate);
                return true;
            }
            Log::error('error ocurred in order details updation for OrderDetailsId :-'.$orderDetailsId);
            return false;
    }
    
    public function isOrderDetailsPresent($orderDetailsId) {
        $order = $this->connect()->find()->where(['OrderDetailsId =' => $orderDetailsId]);
        Log::debug('order count for orderDetailsId :- '.$orderDetailsId);
        return $order->count();
    }
    
    
    public function getOrderDetails($orderDetailsId) {
        $orderDetails = $this->connect()->find()->where(['OrderDetailsId =' => $orderDetailsId]);
        if($orderDetails->count()){
            foreach ($orderDetails as $orderDetail)
                $orderDetailDto = new DownloadDTO\OrderDetailsDownloadDto ($orderDetail->OrderDetailsId, 
                        $orderDetail->OrderPrice, $orderDetail->OrderQuantity, 
                        $orderDetail->CreatedDate, $orderDetail->UpdatedDate, 
                        $orderDetail->OrderId, $orderDetail->MenuId, $orderDetail->MenuTitle);
            
            return $orderDetailDto;
        }
    }
    
    
}
