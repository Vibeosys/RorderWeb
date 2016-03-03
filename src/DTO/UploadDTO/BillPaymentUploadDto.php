<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DTO\UploadDTO;
use App\DTO;
/**
 * Description of BillPaymentUploadDto
 *
 * @author niteen
 */
class BillPaymentUploadDto extends DTO\JsonDeserializer{
    
    public $billNo;
    public $isPayed;
    public $payedBy;
    public $discount;


    public function __construct($billNo = null, $isPayed = null, 
            $payedBy = null, $discount = null) {
        
        $this->billNo = $billNo;
        $this->isPayed = $isPayed;
        $this->payedBy = $payedBy;
        $this->discount = $discount;
    }
}
