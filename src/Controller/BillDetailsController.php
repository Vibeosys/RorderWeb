<?php
namespace App\Controller;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use App\Model\Table;
use Cake\Log\Log;
/**
 * Description of BillDetailsController
 *
 * @author niteen
 */
class BillDetailsController {
    
    private function getTableObj() {
        
        return new Table\BillDetailsTable();
    }
    
    
    public function addBillDetails($billDetailsEntryList) {
        $billDetailsEntryResult = 0;
        if(is_array($billDetailsEntryList)){
            foreach ($billDetailsEntryList as $billDetailsEntry){
                $billDetailsEntryResult = $this->getTableObj()->insert($billDetailsEntry);   
            }
        }
        return $billDetailsEntryResult;
    }
    
}
