<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model\Table;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Log\Log;
use App\DTO\UploadDTO;
use Cake\Datasource\ConnectionManager;
/**
 * Description of BillTaxTransactionsTable
 *
 * @author niteen
 */
class BillTaxTransactionsTable extends Table{
    
    private function connect() {
        return TableRegistry::get('bill_tax_transactions');
    }
    
    public function insert(UploadDTO\BillTaxTransactionDto $billTaxTransactions) {
        $conn = ConnectionManager::get('default');
        $tableObj = $this->connect();
        $newBillTax = $tableObj->newEntity();
        $newBillTax->BillNo = $billTaxTransactions->billNo;
        $newBillTax->TaxId = $billTaxTransactions->taxId;
        $newBillTax->TaxAmount = $billTaxTransactions->taxAmt;
        $newBillTax->CreatedDate = date(VB_DATE_TIME_FORMAT);
         if ($tableObj->save($newBillTax)) {
            Log::debug('Bill Tax Transactions has been created for BillNo :-' .
                    $billTaxTransactions->billNo);
            $conn->commit();
            return $billTaxTransactions->billNo;
        }
        $conn->rollback();
        Log::error('error ocurred in Bill Tax Transactions creating for BillNo :-' .
                $billTaxTransactions->billNo);
        return 0;
        
        
        
    }
}
