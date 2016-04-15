<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model\Table;

use App\DTO\DownloadDTO;
use Cake\Log\Log;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use App\DTO\UploadDTO;

/**
 * Description of TableTransactionDto
 *
 * @author anand
 */
class TableTransactionTable extends Table {

    //put your code here

    private function connect() {
        return TableRegistry::get('table_transactions');
    }
    
    public function insert(UploadDTO\TableTransactionUploadDto $newWaitingEntry, $restaurantId) {
        try{
            $tableObj = $this->connect();
            $newWaiting = $tableObj->newEntity();
            if(!$newWaitingEntry->tableId){
                $newWaiting->TableId = null;
            }  else {
                $newWaiting->TableId = $newWaitingEntry->tableId;
            }
            if(!$newWaitingEntry->userId){
                $newWaiting->UserId = null;
            }  else {
                $newWaiting->UserId = $newWaitingEntry->userId;
            }
            $newWaiting->CustId = $newWaitingEntry->custId;
            $newWaiting->IsWaiting = $newWaitingEntry->isWaiting;
            $newWaiting->ArrivalTime = date(VB_DATE_TIME_FORMAT);
            $newWaiting->Occupancy = $newWaitingEntry->occupancy;
            $newWaiting->RestaurantId = $restaurantId;
            if($tableObj->save($newWaiting)){
                return true;
            }
            return false;
        } catch (Exception $ex) {
            return false;
        }
    }
    
    public function isCustomerWaiting($custId, $restaurantId) {
        $result = false;
        $conditions = [
            'CustId =' => $custId,
            'IsWaiting =' => ACTIVE, 
            'RestaurantId =' =>$restaurantId];
        try{
            $waitingList = $this->connect()->find()->where($conditions);
            $count = $waitingList->count();
            Log::debug( 'count for Customer waiting list:'.$count);
            if($waitingList->count()){
                $result = true;
            }
            return $result;
        } catch (Exception $ex) {

        }
    }
    public function update(UploadDTO\TableTransactionUploadDto $newWaitingEntry) {
        $key = [
            'IsWaiting' => $newWaitingEntry->isWaiting, 
            'TableId' => $newWaitingEntry->tableId, 
            'UserId' => $newWaitingEntry->userId];
        $conditions = ['CustId =' => $newWaitingEntry->custId];
        try{
            $oldWaiting = $this->connect()->query()->update();
            $oldWaiting->set($key);
            $oldWaiting->where($conditions);
            if($oldWaiting->execute()){
                return true;
            }
            return false;
        } catch (Exception $ex) {
            return false;
        }
    }
    
    public function deleteEnrty(UploadDTO\TableTransactionUploadDto $deleteWaitingEntry, $restaurantId) {
        $conditions = ['CustId =' => $deleteWaitingEntry->custId,
                      
                       'RestaurantId =' => $restaurantId];
        try{
            $deleteResult = $this->connect()->deleteAll($conditions);
            if($deleteResult){
                Log::debug('Customer deleted from waiting list transaction');
                return true;
            }
            Log::error('Error in table transaction waiting customer deletion');
            return false;
        } catch (Exception $ex) {
            return false;
        }
    }
    
    public function getTableTransaction($custId, $restaurantId) {
      $result = false;
        $conditions = [
            'CustId =' => $custId,
            'RestaurantId =' =>$restaurantId];
        try{
            $waitingList = $this->connect()->find()->where($conditions);
            if($waitingList->count()){
                foreach ($waitingList as $waiting){
                    $result = new DownloadDTO\TableTransactionDownloadDto(
                            $this->getNull($waiting->TableId), 
                            $this->getNull($waiting->UserId), 
                            $waiting->CustId, 
                            $this->getNull($waiting->IsWaiting), 
                            $waiting->ArrivalTime);
                }
            }
            return $result;
        } catch (Exception $ex) {

        }
        
    }
    public function getTableTransactions($restaurantId) {
        $conditions = ['RestaurantId =' => $restaurantId];
        $tableTransactions = $this->connect()->find()->where($conditions);
        $count = $tableTransactions->count();
        if (!$count) {
            Log::debug('Table transactions are not found');
            return false;
        }
        $tableTransactionArray[] = null;
        $i = 0;
        foreach ($tableTransactions as $tableTransaction) {

            $tableTransactionDto = new DownloadDTO\TableTransactionDownloadDto(
                    $this->getNull($tableTransaction -> TableId), 
                    $this->getNull($tableTransaction -> UserId), 
                    $tableTransaction -> CustId, 
                    $this->getNull($tableTransaction -> IsWaiting), 
                    $tableTransaction -> ArrivalTime);
            $tableTransactionArray[$i] = $tableTransactionDto;
            $i++;
        }
        Log::debug('Table transactions are successfully returned');
        return $tableTransactionArray;
    }
    
    public function isEntryPresent($tableId, $restaurantId) {
        $conditions = [
            'TableId =' => $tableId,
            'RestaurantId =' =>$restaurantId];
        $transactionEntry = $this->connect()->find()->where($conditions);
        return $transactionEntry->count();
    }
    
    public function getCustomer($tableId,$restaurantId = null) {
        $conditions = [
            'TableId =' => $tableId];
        if(!is_null($restaurantId)){
            $conditions['RestaurantId'] = $restaurantId;
        }
        $result = $this->connect()->find('all', ['conditions' => $conditions, 'contains' => array('CustId')]);
        if($result->count()){
            Log::debug($result->first()->CustId);
            return $result->first()->CustId ;
        }  else {
            return null;
        }
        
    }

}
