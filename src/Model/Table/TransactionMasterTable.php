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
 * Description of TransactionMasterTable
 *
 * @author niteen
 */
class TransactionMasterTable extends Table{
    
    private function connect() {
        return TableRegistry::get('transaction_master');
    }
    
    public function insert(UploadDTO\TransactionMasterInsertDto $request) {
        $tableObj = $this->connect();
        $newEntity = $tableObj->newEntity();
        try{
            $newEntity->RestaurantId = $request->restaurantId;
            $newEntity->Day = $request->day;
            $newEntity->Month = $request->month;
            $newEntity->Year = $request->year;
            $newEntity->TotalSales = $request->amount;
            if($tableObj->save($newEntity)){
                return $newEntity->TransactionId;
            } 
            return FALSE;    
        } catch (Exception $ex) {
            return FALSE;    
        }
    }
    
    public function update(UploadDTO\TransactionMasterInsertDto $request, $transactionId) {
        $tableObj = $this->connect();
        
        try{
            $oldEntity  = $tableObj->get($transactionId);
            $oldEntity->TotalSales = $oldEntity->TotalSales + $request->amount;
            if($tableObj->save($oldEntity)){
               return $transactionId;
            }
           return FALSE;
        } catch (Exception $ex) {
            return FALSE;    
        }
    }
    
    public function getTransactionId(UploadDTO\TransactionMasterInsertDto $request) {
        $conditions = [
            'RestaurantId =' => $request->restaurantId,
            'Day =' => $request->day,
            'Month =' => $request->month,
            'Year =' => $request->year
        ];
        $field = ['transaction_master.TransactionId'];
        try{
            $result = json_decode(json_encode($this->connect()->find('all',['fields' => $field])->where($conditions)));
            if(empty($result)){
                return FALSE;
            }  else {
                return $result[0]->TransactionId;
            }
        } catch (Exception $ex) {
            return FALSE;
        }
    }
}
