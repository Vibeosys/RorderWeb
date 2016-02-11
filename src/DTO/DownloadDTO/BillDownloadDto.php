<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DTO\DownloadDTO;

/**
 * Description of BillDownloadDto
 *
 * @author niteen
 */
class BillDownloadDto {
   
    public $billNo;
    public $billDate;
    public $billTime;
    public $netAmt;
    public $totalTaxAmt;
    public $totalPayAmt;
    public $createdDate;
    public $updatedDate;
    public $userId;
    
    public function __construct($billNo = null, $billDate = null, 
            $billTime = null, $netAmt = null, $totalTaxAmt = null, 
            $totalPayAmt = null, $createdDate = null, $updatedDate = null, 
            $userId = null) {
        
        $this->billNo = $billNo;
        $this->billDate = $billDate;
        $this->billTime = $billTime;
        $this->netAmt = $netAmt;
        $this->totalTaxAmt = $totalTaxAmt;
        $this->totalPayAmt = $totalPayAmt;
        $this->createdDate = $createdDate;
        $this->updatedDate = $updatedDate;
        $this->userId = $userId;
    }
    
}
