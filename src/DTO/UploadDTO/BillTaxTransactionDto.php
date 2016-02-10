<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DTO\UploadDTO;

/**
 * Description of BillTaxTransactionDto
 *
 * @author niteen
 */
class BillTaxTransactionDto {
    public $billNo;
    public $taxId;
    public $taxAmt;
    
    public function __construct($billNo = null, $taxId = null, $taxAmt = null) {
        
        $this->billNo = $billNo;
        $this->taxId  = $taxId;
        $this->taxAmt = $taxAmt;
    }
}
