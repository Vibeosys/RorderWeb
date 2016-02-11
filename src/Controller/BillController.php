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
 * Description of BillController
 *
 * @author niteen
 */
class BillController  extends ApiController{
    
    private $insert = 'insert';


    private function getTableObj() {
        
        return new Table\BillTable();
    }
    
    public function getMaxBillNo($restaurantId) {
        $billNo = $this->getTableObj()->getBillNo($restaurantId);
        if ($billNo) {
            return $billNo + 1;
        } else {
            return 1;
        }
    }
    public function addBillEntry($billEntryDto) {
        $billEntryResult = $this->getTableObj()->insert($billEntryDto);
        if($billEntryResult){
            Log::debug('you bill is generated');
            $this->makeSyncEntry($billEntryDto);
            return $billEntryResult;
        }
        return false;
    }
    
    private function makeSyncEntry(UploadDTO\BillEntryDto $billEntryDto) {
     
          $newBillEntry = $this->getTableObj()->getNewBill(
                  $billEntryDto->billNo, 
                  $billEntryDto->restaurantId, 
                  $billEntryDto->userId);
         if(!is_null($newBillEntry)){
             $syncController = new SyncController();
             $syncController->billEntry($billEntryDto->userId, 
                     json_encode($newBillEntry), 
                     $this->insert, 
                     $billEntryDto->restaurantId);
             Log::debug(' New bill entry successfully place in sync table');
             return ;
         }
         Log::error('Error occured in sync entry of new bill');
         return;
    }
    
    
}
