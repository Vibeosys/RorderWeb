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
/**
 * Description of BillDetailsController
 *
 * @author niteen
 */
class BillDetailsController extends ApiController{
    


    private function getTableObj() {
        
        return new Table\BillDetailsTable();
    }
    
    
    public function addBillDetails($billDetailsEntryList, $userId, $restaurantId) {
        $billDetailsEntryResult = 0;
        if(is_array($billDetailsEntryList)){
            foreach ($billDetailsEntryList as $billDetailsEntry){
                $billDetailsEntryResult = $this->getTableObj()->insert($billDetailsEntry);  
                $billNo = $billDetailsEntry->billNo;
            }
           $result = $this->makeSyncEntry($billNo, $userId, $restaurantId);
           if(!$result){
               $this->transRollback();
           }
        }
        return $billDetailsEntryResult;
    }
    
    private function makeSyncEntry($billNo, $userId, $restaurantId) {
     
          $newBillDetailsEntryList = $this->getTableObj()->getNewDetails($billNo);
         if(!is_null($newBillDetailsEntryList)){
             $syncController = new SyncController();
             foreach ($newBillDetailsEntryList as $newBillDetails){
                $syncResult = $syncController->billDetailsEntry(
                        $userId, 
                        json_encode($newBillDetails), 
                        INSERT_OPERATION, 
                        $restaurantId);
                if(!$syncResult){
                    return $syncResult;
                }
             }
             Log::debug(' New bill Details entry successfully place in sync table');
             return $syncResult;
         }
         Log::error('Error occured in sync entry of new bill Details ');
         return;
    }
    
    public function getOrderId($billNo) {
        if(isset($billNo)){
            return $this->getTableObj()->getNewDetails($billNo);
        }
        return false;
    }
    
}
