<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DTO\DownloadDTO;

/**
 * Description of OrderShowDownloadDto
 *
 * @author niteen
 */
class OrderShowDownloadDto {

    public $orderId;
    public $orderNo;
    public $orderTime;
    public $user;
    public $tableId;
    public $takeawayNo;
    public $orderType;
    
    public function __construct($orderId = null, $orderNo = null, 
            $orderTime = null, $user = null, $tableId = null, 
            $takeawayNo = null, $orderType = null) {
        $this->orderId = $orderId;
        $this->orderNo = $orderNo;
        $this->orderTime = $orderTime;
        $this->user = $user;
        $this->tableId = $tableId;
        $this->takeawayNo = $takeawayNo;
        $this->orderType = $orderType;
    }
}
