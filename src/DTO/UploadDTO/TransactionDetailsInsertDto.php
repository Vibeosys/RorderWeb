<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DTO\UploadDTO;

/**
 * Description of TransactionDetailsInsertDto
 *
 * @author niteen
 */
class TransactionDetailsInsertDto {
    
    public $paymentModeId;
    public $amount;
    public $transactionId;
    
    public function __construct($paymentModeId = null, $amount = null, 
            $transactionId = null) {
        $this->paymentModeId = $paymentModeId;
        $this->amount = $amount;
        $this->transactionId = $transactionId;
    }
}
