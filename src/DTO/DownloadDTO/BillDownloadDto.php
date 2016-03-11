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
    public $userId;
    public $custId;
    public $tableId;
    public $isPayed;
    public $payedBy;
    public $discount;
    public $takeawayNo;
    public function __construct($billNo = null, $billDate = null, 
            $billTime = null, $netAmt = null, $totalTaxAmt = null, 
            $totalPayAmt = null,$userId = null, $custId = null, 
            $tableId = null, $isPayed = null, $payedBy = null,$discount = null,
            $takeawayNo = null) {
        
        $this->billNo = $billNo;
        $this->billDate = $billDate;
        $this->billTime = $billTime;
        $this->netAmt = $netAmt;
        $this->totalTaxAmt = $totalTaxAmt;
        $this->totalPayAmt = $totalPayAmt;
        $this->userId = $userId;
        $this->custId = $custId;
        $this->tableId = $tableId;
        $this->isPayed = $isPayed;
        $this->payedBy = $payedBy;
        $this->discount = $discount;
        $this->takeawayNo = $takeawayNo;
    }
    
}
