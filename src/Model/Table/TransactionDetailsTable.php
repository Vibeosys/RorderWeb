<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model\Table;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Log\Log;
use App\DTO\UploadDTO;
use App\DTO\DownloadDTO;
/**
 * Description of TransactionDetailsTable
 *
 * @author niteen
 */
class TransactionDetailsTable extends Table{
    
   
    private function connect() {
        return TableRegistry::get('transaction_details');
    }
    
    public function insert(UploadDTO\TransactionDetailsInsertDto $request) {
        $tableObj = $this->connect();
        $newEntity = $tableObj->newEntity();
        try{
            $newEntity->PaymentModeId = $request->paymentModeId;
            $newEntity->Amount = $request->amount;
            $newEntity->TransactionId = $request->transactionId;
            if($tableObj->save($newEntity)){
                return $newEntity->TransactionDetailsId;
            }
            return FALSE;
        } catch (Exception $ex) {
            return FALSE;
        }
    }
    
    public function update(UploadDTO\TransactionDetailsInsertDto $request,$transactionDetailsId) {
         $tableObj = $this->connect();
        try{
            $oldEntity  = $tableObj->get($transactionDetailsId);
            $oldEntity->Amount = $oldEntity->Amount + $request->amount;
            if($tableObj->save($oldEntity)){
               return $transactionDetailsId;
            }
           return FALSE;
        } catch (Exception $ex) {
            return FALSE;    
        }
    }
    
    public function getTransactionDetailsId(UploadDTO\TransactionDetailsInsertDto $request) {
        $conditions = [
            'PaymentModeId =' => $request->paymentModeId,
            'TransactionId =' => $request->transactionId
        ];
        $field = ['transaction_details.TransactionDetailsId'];
        try{
            $result = json_decode(json_encode($this->connect()->find('all',['fields' => $field])->where($conditions)));
            if(empty($result)){
                return FALSE;
            }  else {
                return $result[0]->TransactionDetailsId;
            }
        } catch (Exception $ex) {
            return FALSE;
        }
    }
    
    public function getReport($restaurantId) {
        $reportData = null;
        $counter = 0;
        $day = date('d') -1;
        $day = '0'.$day;
        $month = date('m');
        $year = date('Y');
        Log::debug('date:- '.$day.$month.$year);
        $joins = [
                     'a' => 
                        [
                            'table' => 'transaction_master', 
                            'type' => 'INNER', 
                            'conditions' => "a.TransactionId = transaction_details."
                            . "TransactionId and a.RestaurantId =".$restaurantId 
                            ." and a.Day ='".$day ."' and a.Month ='".$month."' "
                            . "and a.Year ='".$year."'"
                        ],
                        'b' => 
                        [
                            'table' => 'payment_mode_master', 
                            'type' => 'INNER', 
                            'conditions' => "b.PaymentModeId = transaction_details.PaymentModeId"
                        ]  
                ];
        $field =[
            'title' => 'b.PaymentModeTitle',
            'amount' => 'transaction_details.Amount'
            ];
        try{
            $records = $this->connect()->find('all',array('fields' => $field))
                    ->join($joins);
            foreach ($records as $record){
               $reportData[$counter++] = new DownloadDTO\transactionReportDto(
                       $record->title, $record->amount);
            }
            return $reportData;
        } catch (Exception $ex) {
            return null;
        }
    }
}
