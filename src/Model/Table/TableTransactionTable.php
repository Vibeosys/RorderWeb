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

    public function getTableTransactions($restaurantId) {
        $tableTransactions = $this->connect()->find()->where(['restaurantId =' => $restaurantId]);
        $count = $tableTransactions->count();
        if (!$count) {
            Log::debug('Table transactions are not found');
            return false;
        }
        $tableTransactionArray[] = null;
        $i = 0;
        foreach ($tableTransactions as $tableTransaction) {

            $tableTransactionDto = new DownloadDTO\TableTransactionDownloadDto(
                    $tableTransaction -> TableId, 
                    $tableTransaction -> UserId, 
                    $tableTransaction -> CustId, 
                    $tableTransaction -> IsWaiting, 
                    $tableTransaction -> ArrivalTime);
            $tableTransactionArray[$i] = $tableTransactionDto;
            $i++;
        }
        Log::debug('Table transactions are successfully returned');
        return $tableTransactionArray;
    }

}
