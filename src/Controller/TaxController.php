<?php
namespace App\Controller;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use App\Model\Table;
use App\DTO\UploadDTO;
use Cake\Log\Log;
/**
 * Description of TaxController
 *
 * @author niteen
 */
class TaxController extends ApiController{
    
    private function getTableObj() {
        return new Table\TaxTable();
    }
    
    public function getTax($billNetAmount) {
        
        Log::debug('Taxes are calculated on Bill Net Amount : '.$billNetAmount);
        $billTaxTransactionList = null;
        $billTaxListCounter = 0;
        $taxList = $this->getTableObj()->getTaxes();
        if($taxList){
            $billTaxTransactionList = array();
        foreach ($taxList as $tax){
            $taxValue = $tax->percentage/100;
            $taxAmt = $billNetAmount * $taxValue;
            $billTaxTransactionDto = new UploadDTO\BillTaxTransactionDto(
                    NULL, 
                    $tax->taxId, 
                    $taxAmt);
            $billTaxTransactionList[$billTaxListCounter++] = $billTaxTransactionDto;
         Log::debug('Taxes are calculated for Bill precentage : '.$tax->percentage);   
        }}
        
        return $billTaxTransactionList;
    }
    
    
}
