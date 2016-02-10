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
 * Description of BillTaxTransactionsController
 *
 * @author niteen
 */
class BillTaxTransactionsController {
    
    
    private function getTableObj() {
        return new Table\BillTaxTransactionsTable();
    }
    
    public function addBillTaxTransactions($billTaxList) {
        $billTaxEntryResult = 0;
        if(is_array($billTaxList)){
            foreach ($billTaxList as $billTax){
                $billTaxEntryResult = $this->getTableObj()->insert($billTax);   
            }
        }
        return $billTaxEntryResult;
        
        
    }
}
