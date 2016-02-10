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
/**
 * Description of BillTable
 *
 * @author niteen
 */
class BillTable extends Table{
    
    public function connect() {
        
        return TableRegistry::get('bill');
    }
    
    public function insert(UploadDTO\BillEntryDto $billEntry) {
        
        $tableObj  =  $this->connect();
        $newBill = $tableObj->newEntity();
        $newBill->BillNo  = $billEntry->billNo;
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
        Log::error('error ocurred in Bill creating for BillNo :-' .
                $billEntry->billNo);
        return 0;
        
        
    }
    public function getBillNo($restaurantId) {
        $conditions = array(
            'conditions' => array('bill.RestaurantId =' => $restaurantId),
            'fields' => array('maxBillNo' => 'MAX(bill.BillNo)'));
        $billTableEntry = $this->connect()->find('all', $conditions)->toArray();
        if ($billTableEntry) {
            $maxBillNo = $billTableEntry[0]['maxBillNo'];
            if(is_null($maxBillNo)){
                $maxBillNo = 0;
            }
        }
        Log::debug('Order Number generated for new order orderNo is :- ' . $maxBillNo);
        return $maxBillNo;
    }
    
    
    
}
