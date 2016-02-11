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
    public $createdDate;
    public $updatedDate;
   
    public function __construct($autoId = null, $orderId = null, $billNo = null, 
            $createdDate = null, $updatedDate = null) {
        $this->autoId = $autoId;
        $this->orderId = $orderId;
        $this->billNo = $billNo;
        $this->createdDate = $createdDate;
        $this->updatedDate = $updatedDate;
    }
}
