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
 * Description of OrderTypeController
 *
 * @author niteen
 */

define('OTP_INS_QRY', "INSERT INTO order_type (OrderTypeId,OrderTypeTitle,"
        . "Active) VALUES (@Id,\"@Title\",@Active);");
class OrderTypeController extends ApiController{
    
    private function getTableObj() {
        return new Table\OrderTypeTable();
    }
    
    public function getOrderType() {
        return $this->getTableObj()->getType();
    }
    
    public function prepareInsertStatements() {
        $allSource = $this->getOrderType();
        if (!$allSource) {
            return false;
        }
        $preparedStatements = '';

        foreach ($allSource as $source) {
            $preparedStatements .= OTP_INS_QRY;
            $preparedStatements = str_replace('@Id', $source->id, $preparedStatements);
            $preparedStatements = str_replace('@Title', $source->title, $preparedStatements);
            $preparedStatements = str_replace('@Active', $source->active, $preparedStatements);
        }
        return $preparedStatements;
    }
    
    
    
    
}
