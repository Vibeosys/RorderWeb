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
use Cake\Datasource\ConnectionManager;
/**
 * Description of OrderDetailsTable
 *
 * @author niteen
 */
class OrderDetailsTable extends Table{
    
    private function connect() {
        return TableRegistry::get('order_details');
    }
    public function insert(UploadDTO\OrderDetailEntryDto $orderDetailsEntryDto){
        $conn = ConnectionManager::get('default');       
        $tableObj = $this->connect();
        $newOrder = $tableObj->newEntity();
        $newOrder->OrderPrice = $orderDetailsEntryDto->orderPrice;
        $newOrder->OrderQuantity = $orderDetailsEntryDto->orderQty;
        $newOrder->CreatedDate = date(VB_DATE_TIME_FORMAT);
        $newOrder->UpdatedDate = date(VB_DATE_TIME_FORMAT);
        $newOrder->OrderId = $orderDetailsEntryDto->orderId;
        $newOrder->MenuId = $orderDetailsEntryDto->menuId;
        $newOrder->MenuTitle = $orderDetailsEntryDto->menuTitle;
        $newOrder->Note = $orderDetailsEntryDto->note;
        if($tableObj->save($newOrder)){
            Log::debug('order Details has been saved for OrderDetailsId :-'.
                    $newOrder->OrderDetailsId);
            return $newOrder->OrderDetailsId;
        }
        $conn->rollback();
        Log::error('error ocurred in order Details for OrderId :-'.
                $orderDetailsEntryDto->orderId);
        return 0;
    }
  
    public function getOrderDetails($orderDetailsId) {
        $conditions = ['OrderDetailsId =' => $orderDetailsId];
        $orderDetails = $this->connect()->find()->where($conditions);
        if($orderDetails->count()){
            foreach ($orderDetails as $orderDetail){
                $orderDetailDto = new DownloadDTO\OrderDetailsDownloadDto (
                        $orderDetail->OrderDetailsId, 
                        $orderDetail->OrderPrice, 
                        $orderDetail->OrderQuantity, 
                        $orderDetail->OrderId, 
                        $orderDetail->MenuId, 
                        $orderDetail->MenuTitle, 
                        $orderDetail->Note);
                 Log::debug('OrderDetails goes in sync Table : Id -> '.
                         $orderDetailDto->orderDetailsId);
            }
            return $orderDetailDto;
        }
    }
    
    
}
