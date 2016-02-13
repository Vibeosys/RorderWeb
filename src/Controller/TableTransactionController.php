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
        $syncController = new SyncController();
        if($updateResult){
            $newEntry = $this->getTableObj()->getTableTransaction(
                    $addWaitingCustomerEntry->custId, $userInfo->restaurantId);
            $syncController->tableTransactionEntry(
                    $userInfo->userId, 
                    json_encode($newEntry), 
                    UPDATE, 
                    $userInfo->restaurantId);
            return $updateResult;
        }elseif ($insertResult) {
             $newEntry = $this->getTableObj()->getTableTransaction(
                    $addWaitingCustomerEntry->custId, $userInfo->restaurantId);
            $syncController->tableTransactionEntry(
                    $userInfo->userId, 
                    json_encode($newEntry), 
                    INSERT, 
                    $userInfo->restaurantId);
            return $insertResult;
        }  else {
            return false;
        }
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

}
