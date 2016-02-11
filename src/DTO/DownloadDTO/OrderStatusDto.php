<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DTO\DownloadDTO;

/**
 * Description of OrderStatusDto
 *
 * @author niteen
 */
class OrderStatusDto {
    
    public $orderId;
    public $orderStatus;
    
    public function __construct($orderId = null, $orderStatus = null) {
        $this->orderId = $orderId;
        $this->orderStatus = $orderStatus;
    }
}
