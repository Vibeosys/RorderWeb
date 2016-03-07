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
 * Description of BillTable
 *
 * @author niteen
 */
class BillTable extends Table {

    public function connect() {

        return TableRegistry::get('bill');
    }

    public function insert(UploadDTO\BillEntryDto $billEntry) {
        $conn = ConnectionManager::get('default');
        $conn->begin();
        try {
            $tableObj = $this->connect();
            $newBill = $tableObj->newEntity();
            $newBill->BillNo = $billEntry->billNo;
            $newBill->BillDate = date(VB_DATE_FORMAT);
            $newBill->BillTime = date(VB_TIME_FORMAT);
            $newBill->NetAmount = $billEntry->netAmt;
            $newBill->TotalTaxAmount = $billEntry->totalTaxAmt;
            $newBill->TotalPayAmount = $billEntry->totalPayAmt;
            $newBill->CreatedDate = date(VB_DATE_TIME_FORMAT);
            $newBill->UpdatedDate = date(VB_DATE_TIME_FORMAT);
            $newBill->UserId = $billEntry->userId;
            $newBill->RestaurantId = $billEntry->restaurantId;
            $newBill->CustId = $billEntry->custId;
            $newBill->TableId = $billEntry->tableId;

            if ($tableObj->save($newBill)) {
                Log::debug('Bill has been created for BillNo :-' .
                        $billEntry->billNo);
                return $billEntry->billNo;
            }
            $conn->rollback();
            Log::error('error ocurred in Bill creating for BillNo :-' .
                    $billEntry->billNo);
            return 0;
        } catch (Exception $ex) {
             $conn->rollback();
            return 0;
        }
    }

    public function getBillNo($restaurantId) {
        $conditions = array(
            'conditions' => array('bill.RestaurantId =' => $restaurantId),
            'fields' => array('maxBillNo' => 'MAX(bill.BillNo)'));
        $billTableEntry = $this->connect()->find('all', $conditions)->toArray();
        if ($billTableEntry) {
            $maxBillNo = $billTableEntry[0]['maxBillNo'];
            if (is_null($maxBillNo)) {
                $maxBillNo = 0;
            }
        }
        Log::debug('Order Number generated for new order orderNo is :- ' . $maxBillNo);
        return $maxBillNo;
    }

    public function getNewBill($billNo, $restuarantId, $userId) {
        try{
            $billDownloadDto = null;
            $conditions = ['BillNo =' =>$billNo, 
                'RestaurantId =' => $restuarantId, 
                'UserId =' =>$userId];
            $newBill = $this->connect()->find()->where($conditions);
            if($newBill->count()){
                foreach ($newBill as $bill){
                    $billDownloadDto = new DownloadDTO\BillDownloadDto(
                            $bill->BillNo, 
                            $bill->BillDate, 
                            $bill->BillTime, 
                            $bill->NetAmount, 
                            $bill->TotalTaxAmount, 
                            $bill->TotalPayAmount, 
                            $bill->UserId,
                            $bill->CustId,
                            $bill->TableId,
                            $bill->IsPayed,
                            $bill->PayedBy,
                            $bill->Discount);
                }
            }
            return $billDownloadDto;
        } catch (Exception $ex) {
            echo 'bill table database error'.$ex;
        }
    }
    
    public function changePaymentStatus(UploadDTO\BillPaymentUploadDto 
        $billPaymentRequest, $restaurantId) {
        $primaryKey = $billPaymentRequest->billNo;
        try{
            $tableObj = $this->connect();
            $oldBill = $tableObj->get($primaryKey);
            $oldBill->TotalPayAmount = $oldBill->TotalPayAmount - $billPaymentRequest->discount;
            $oldBill->IsPayed = $billPaymentRequest->isPayed;
            $oldBill->PayedBy = $billPaymentRequest->payedBy;
            $oldBill->Discount = $billPaymentRequest->discount;
          if($tableObj->save($oldBill)){
                Log::debug('Bill Payment Status has been changed for BillNo : '
                        .$billPaymentRequest->billNo);
                return $billPaymentRequest->billNo;
            }
            Log::error('Error occured in changing bill Payment for BillNo : '
                    .$billPaymentRequest->billNo);
            return false;    
        } catch (Exception $ex) {
            return false;
        }
    }
    
    public function getCustomerBill($tableId) {
          try{
            $billDownloadDto = null;
            $conditions = [
                'TableId =' => $tableId];
            $order = ['BillNo' => 'DESC'];
            $newBill = $this->connect()->find()->where($conditions)->order($order);
            if($newBill){
                foreach ($newBill as $bill){
                    $billDownloadDto = new DownloadDTO\BillDownloadDto(
                            $bill->BillNo, 
                            $bill->BillDate, 
                            $bill->BillTime, 
                            $bill->NetAmount, 
                            $bill->TotalTaxAmount, 
                            $bill->TotalPayAmount, 
                            $bill->UserId,
                            $bill->CustId,
                            $bill->TableId,
                            $bill->IsPayed,
                            $bill->PayedBy,
                            $bill->Discount);
                }
            }
            return $billDownloadDto;
        } catch (Exception $ex) {
            echo 'bill table database error'.$ex;
        }
    }
}
