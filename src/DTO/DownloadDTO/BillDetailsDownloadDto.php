<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DTO\DownloadDTO;

/**
 * Description of BillDetailsDownloadDto
 *
 * @author niteen
 */
class BillDetailsDownloadDto {
    
    public $autoId;
    public $orderId;
    public $billNo;
   
    public function __construct($autoId = null, $orderId = null, $billNo = null) {
        $this->autoId = $autoId;
        $this->orderId = $orderId;
        $this->billNo = $billNo;
    }
}
