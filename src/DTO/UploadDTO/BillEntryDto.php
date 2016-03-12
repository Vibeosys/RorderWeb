<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DTO\UploadDTO;

/**
 * Description of BillEntryDto
 *  used for bill entry in mysql table
 * @author niteen
 */
class BillEntryDto {
    public $billNo;
    public $netAmt;
    public $totalTaxAmt;
    public $totalPayAmt;
    public $userId;
    public $restaurantId;
    public $custId;
    public $tableId;
    public $takeawayNo;


    public function __construct($billNo = null, $netAmt = null, $totalTaxAmt = null, 
            $totalPayAmt = null, $userId = null, $restaurantId = null, 
            $custId = null, $tableId = null, $takeawayNo = null) {
        $this->billNo = $billNo;
        $this->netAmt = $netAmt;
        $this->totalTaxAmt = $totalTaxAmt;
        $this->totalPayAmt = $totalPayAmt;
        $this->userId = $userId;
        $this->restaurantId = $restaurantId;
        $this->custId = $custId;
        $this->tableId = $tableId;
        $this->takeawayNo = $takeawayNo;
    }
    
}
