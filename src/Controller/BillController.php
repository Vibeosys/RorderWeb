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
 * Description of BillController
 *
 * @author niteen
 */
class BillController  extends ApiController{
    
    private function getTableObj() {
        
        return new Table\BillTable();
    }
    
    public function getMaxBillNo($restaurantId) {
        $billNo = $this->getTableObj()->getBillNo($restaurantId);
        if ($billNo) {
            return $billNo + 1;
        } else {
            return 1;
        }
    }
    public function addBillEntry($billEntryDto) {
        $billEntryResult = $this->getTableObj()->insert($billEntryDto);
        if($billEntryResult){
            Log::debug('you bill is generated');
            return $billEntryResult;
        }
        return false;
    }
    
    
}
