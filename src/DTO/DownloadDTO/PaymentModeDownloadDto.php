<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DTO\DownloadDTO;

/**
 * Description of PaymentModeDownloadDto
 *
 * @author niteen
 */
class PaymentModeDownloadDto {
    
    public $paymentMOdeId;
    public $paymentModeTitle;
    public $active;


    public function __construct($paymentModeId = null, $paymentModeTitle = null, 
            $active = null) {
        
        $this->paymentMOdeId = $paymentModeId;
        $this->paymentModeTitle = $paymentModeTitle;
        $this->active = $active;
    }
}
