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
 * Description of CustomerTable
 *
 * @author anand
 */
class CustomerTable extends Table {

    //put your code here
    private function connect() {
        return TableRegistry::get('customer');
    }

    public function getCustomers($restaurantId) {
        $customers = $this->connect()->find()->where(['restaurantId =' => $restaurantId]);
        $count = $customers->count();
        if (!$count) {
            Log::debug('Customers are not found');
            return false;
        }
        $resultCustomers[] = null;
        $i = 0;
        foreach ($customers as $customer) {

            $customerDto = new DownloadDTO\CustomerDownloadDto(
                    $customer->CustId, 
                    $customer->CustName, 
                    $customer->CustPhone, 
                    $customer->CustEmail);
            $resultCustomers[$i] = $customerDto;
            $i++;
        }
        Log::debug('Customers are successfully returned');
        return $resultCustomers;
    }

}
