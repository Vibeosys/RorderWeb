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
            $result = $this->makeSyncEntry($billEntryDto);
            if(!$result){
                $this->transRollback();
            }
            return $billEntryResult;
        }
        return false;
    }
    
    public function changeBillPaymetStatus($billPaymentRequest, $userInfo) {
        $chagePaymentStatusResult = $this->getTableObj()->changePaymentStatus($billPaymentRequest, $userInfo->restaurantId);
          if($chagePaymentStatusResult){
             $syncController = new SyncController();
             $syncController->billEntry($userInfo->userId, 
                     json_encode($billPaymentRequest), 
                     UPDATE_OPERATION, 
                     $userInfo->restaurantId);
             Log::debug('Payment is done successfully for BillNo :- '.$billPaymentRequest->billNo);
             return $chagePaymentStatusResult;
         }
         Log::error('Error in Payment for BillNo :- '.$billPaymentRequest->billNo);
         return $chagePaymentStatusResult;
    }
    
    private function makeSyncEntry(UploadDTO\BillEntryDto $billEntryDto) {
     
          $newBillEntry = $this->getTableObj()->getNewBill(
                  $billEntryDto->billNo, 
                  $billEntryDto->restaurantId, 
                  $billEntryDto->userId);
         if(!is_null($newBillEntry)){
             $syncController = new SyncController();
            $syncResult = $syncController->billEntry($billEntryDto->userId, 
                     json_encode($newBillEntry), 
                     $this->insert, 
                     $billEntryDto->restaurantId);
             Log::debug(' New bill entry successfully place in sync table');
             return $syncResult;
         }
         Log::error('Error occured in sync entry of new bill');
         return ;
    }
    
    
}
