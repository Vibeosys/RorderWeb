<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;

use App\Model\Table;
use Cake\Log\Log;
/**
 * Description of CustomerController
 *
 * @author anand
 */
define('CS_INS_QRY', 
        "INSERT INTO customer (CustId,CustName,CustPhone,CustEmail)"
        . " VALUES (\"@CustId\",\"@CustName\",\"@CustPhone\",\"@CustEmail\");");
class CustomerController extends ApiController{
    //put your code here
    private function getTableObj() {
        return new Table\CustomerTable();
    }
    
    public function getCustomers($restaurantId) {
        
        $result = $this->getTableObj()->getCustomers($restaurantId);
        if($result){
            return $result;
        }
        return false;
    }
    
    public function prepareInsertStatements($restaurantId) {
    
        $allCustomers = $this->getCustomers($restaurantId);
        if (!$allCustomers) {
            return false;
        }
        $preparedStatements = '';

        foreach ($allCustomers as $customer) {
            $preparedStatements .= CS_INS_QRY;
            $preparedStatements = str_replace('@CustId', $customer->custId, $preparedStatements);
            $preparedStatements = str_replace('@CustName', $customer->custName, $preparedStatements);
            $preparedStatements = str_replace('@CustPhone', $customer->custPhone, $preparedStatements);
            $preparedStatements = str_replace('@CustEmail', $customer->custEmail, $preparedStatements);            
        }
        return $preparedStatements;
    }
}