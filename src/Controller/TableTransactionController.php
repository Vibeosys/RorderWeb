<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;

use App\Model\Table;
use Cake\Log\Log;
use App\DTO\UploadDTO;
use App\DTO;

/**
 * Description of TableTransactionController
 *
 * @author anand
 */
define('TBL_TRN_INS_QRY', "INSERT INTO table_transaction (TableId,CustId,UserId,IsWaiting,ArrivalTime)"
        . "VALUES (@TableId,\"@CustId\",\"@UserId\",@IsWaiting,\"@ArrivalTime\");");

class TableTransactionController extends ApiController {

    //put your code here
    private function getTableObj() {
        return new Table\TableTransactionTable();
    }
    
    public function addNewEntry(UploadDTO\TableTransactionUploadDto $addWaitingCustomerEntry, $userInfo) {
        if(isset($addWaitingCustomerEntry->tableId)and 
                $this->getTableObj()->isEntryPresent(
                        $addWaitingCustomerEntry->tableId, $userInfo->restaurantId)){
            $this->response->body(DTO\ErrorDto::prepareError(113));
            return;
        }
        $isWaitingResult = $this->getTableObj()->isCustomerWaiting(
                $addWaitingCustomerEntry->custId,
                $userInfo->restaurantId);
        $updateResult = $insertResult = false;
        if($isWaitingResult){
            $updateResult = $this->getTableObj()->update($addWaitingCustomerEntry);
        }else{
            $insertResult = $this->getTableObj()->insert(
                    $addWaitingCustomerEntry, $userInfo->restaurantId);
        }
        if($updateResult){
            $newEntry = $this->getTableObj()->getTableTransaction(
                    $addWaitingCustomerEntry->custId, $userInfo->restaurantId);
            $this->makeSyncEntry($userInfo, json_encode($newEntry), UPDATE_OPERATION);
            return $updateResult;
        }elseif ($insertResult) {
             $newEntry = $this->getTableObj()->getTableTransaction(
                    $addWaitingCustomerEntry->custId, $userInfo->restaurantId);
           $this->makeSyncEntry($userInfo, json_encode($newEntry), INSERT_OPERATION);
            return $insertResult;
        }  else {
            return false;
        }
    }
    
    public function deleteTransactionEntry(UploadDTO\TableTransactionUploadDto $deleteWaitingCustomer, $userInfo) {
        $deletedEntry = $this->getTableObj()->getTableTransaction($deleteWaitingCustomer->custId, $userInfo->restaurantId);
        $deleteResult = $this->getTableObj()->deleteEnrty($deleteWaitingCustomer, $userInfo->restaurantId);
        if($deleteResult){
             $this->makeSyncEntry($userInfo, json_encode($deletedEntry), DELETE_OPERATION);
            return true;
        }
        return false;
    }
    
    public function getTableTransactions($restaurantId) {
        $result = $this->getTableObj()->getTableTransactions($restaurantId);
        if ($result) {
            return $result;
        }
        return false;
    }

    public function prepareInsertStatements($restaurantId) {

        $allTableTransactions = $this->getTableTransactions($restaurantId);
        if (!$allTableTransactions) {
            return false;
        }
        $preparedStatements = '';

        foreach ($allTableTransactions as $tableTransaction) {
            $preparedStatements .= TBL_TRN_INS_QRY;
            $preparedStatements = str_replace('@TableId', $tableTransaction->tableId, $preparedStatements);
            $preparedStatements = str_replace('@UserId', $tableTransaction->userId, $preparedStatements);
            $preparedStatements = str_replace('@CustId', $tableTransaction->custId, $preparedStatements);
            $preparedStatements = str_replace('@ArrivalTime', $tableTransaction->arrivalTime, $preparedStatements);
            $preparedStatements = str_replace('@IsWaiting', $tableTransaction->isWaiting, $preparedStatements);
        }
        return $preparedStatements;
    }
    
    private function makeSyncEntry($userInfo, $json, $operation) {
         $syncController = new SyncController();
         $syncController->tableTransactionEntry(
                    $userInfo->userId, 
                    $json, 
                    $operation, 
                    $userInfo->restaurantId);
            Log::debug('Sync update save for table_transaction table deletion');
    }
    
    public function getCurrentCustomer($tableId) {
        return $this->getTableObj()->getCustomer($tableId);
    }

}
