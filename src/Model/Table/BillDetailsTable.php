<?php
namespace App\Model\Table;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use Cake\ORM\TableRegistry;
use Cake\ORM\Table;
use Cake\Log\Log;
use App\DTO\UploadDTO;
use App\DTO\DownloadDTO;
use Cake\Datasource\ConnectionManager;
/**
 * Description of BillDetailsTable
 *
 * @author niteen
 */
class BillDetailsTable extends Table{
    
    
    public function connect() {
        return TableRegistry::get('bill_details');
    }
    
    public function insert(UploadDTO\BillDetailsUploadDto $billDetails) {
        $conn = ConnectionManager::get('default');
        $tableObj = $this->connect();
        $newBillDetails = $tableObj->newEntity();
        $newBillDetails->OrderId = $billDetails->orderId;
        $newBillDetails->BillNo = $billDetails->billNo;
        $newBillDetails->CreatedDate = date(VB_DATE_TIME_FORMAT);
        $newBillDetails->UpdatedDate = date(VB_DATE_TIME_FORMAT);
        $newBillDetails->OrderNo = $billDetails->orderNo;
        $newBillDetails->OrderAmount = $billDetails->orderAmt;
         if ($tableObj->save($newBillDetails)) {
            Log::debug('bill details has been created for BillNo :-' .
                    $billDetails->billNo);
            return $billDetails->billNo;
        }
        $conn->rollback();
        Log::error('error ocurred in Bill details creating for BillNo :-' .
                $billDetails->billNo);
        return 0;
    }
    
    public function getNewDetails($billNo) {
        try{
            $newBillDetials = NULL;
            $conditions = ['BillNo =' => $billNo];
            $billDetails = $this->connect()->find()->where($conditions);
            if($billDetails->count()){
                $newBillDetials = array();
                $newBillDetialsCounter = 0;
                foreach ($billDetails as $details){
                    $billDetailsDownloadDto = new DownloadDTO\BillDetailsDownloadDto(
                            $details->AutoId, 
                            $details->OrderId, 
                            $details->BillNo, 
                            $details->CreatedDate, 
                            $details->UpdatedDate);
                    $newBillDetials[$newBillDetialsCounter++] = $billDetailsDownloadDto;
                }
            }
            return $newBillDetials;
        } catch (Exception $ex) {
            echo 'Error occured in bill details table during retriving new Bill details'.$ex;
        }
    }
}
