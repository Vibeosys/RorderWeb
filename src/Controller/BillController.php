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
use App\DTO\DownloadDTO;
use App\DTO;
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
             $billEntryDto->tableId = $this->isNull($billEntryDto->tableId);
            $billEntryDto->takeawayNo = $this->isNull($billEntryDto->takeawayNo);
            $billEntryDto->deliveryNo = $this->isNull($billEntryDto->deliveryNo);
            $result = $this->makeSyncEntry($billEntryDto);
            return $billEntryResult;
        }
        return false;
    }
    
    public function getBill($tableId, $takeawayNo) {
        Log::debug('Bill request arrived for tableId :- '.$tableId);
        if(isset($tableId)){
            return $this->getTableObj()->getCustomerBill($tableId, $takeawayNo);
        }
        return null;
    }
    
    public function changeBillPaymetStatus($billPaymentRequest, $userInfo) {
        $chagePaymentStatusResult = $this->getTableObj()->changePaymentStatus(
                $billPaymentRequest, $userInfo->restaurantId);
          if($chagePaymentStatusResult){
             $syncController = new SyncController();
             $newBillEntry = $this->getTableObj()->getNewBill(
                  $billPaymentRequest->billNo, 
                  $userInfo->restaurantId, 
                  $userInfo->userId);
             $syncController->billEntry($userInfo->userId, 
                     json_encode($newBillEntry), 
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
    
    public function displayBill() {
        $restId = parent::readCookie('cri');
        Log::debug('Current restaurantId in order controller :- '.$restId);
        if(isset($restId)){
            $tableId = parent::readCookie('cti');
            $takeawayNo = parent::readCookie('ctn');
            Log::debug('Now bill list shows for table :-'.$tableId .'or for takeawayNo :- '.$takeawayNo);
            $latestBill = $this->getTableObj()->getTableBill($tableId, $takeawayNo, $restId);
            if(is_null($latestBill)){
                $this->set([MESSAGE => DTO\ErrorDto::prepareMessage(126)]);
                return;
            }
            $userController = new UserController();
            $rtableController = new RTablesController();
            foreach ($latestBill as $bill){
                $user = $userController->getUserName($bill->user);
                $bill->user = $user->userName;
                $bill->tableNo = $rtableController->getBillTableNo($bill->tableNo);
                $bill->date = date('d-m-Y H:i',strtotime('+330 minutes',strtotime($bill->date)));  
            }
            $this->set(['bills' => $latestBill,
                        'tableId' => $tableId,
                        'takeawayNo' => $takeawayNo]);
        }
        $this->set([MESSAGE => DTO\ErrorDto::prepareMessage(126)]);
    }
}
