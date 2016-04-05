<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DTO\UploadDTO;

/**
 * Description of OrderEntryDto
 *
 * @author anand
 */
class OrderEntryDto {
    public $orderId;
    public $orderNo;
    public $custId;
    public $tableId;
    public $restaurantId;
    public $orderDt;
    public $orderTm;
    public $orderAmt;
    public $orderStatus;
    public $userId;
    public $takeawayNo;
    public $deliveryNo;
    public $orderType;

    public function __construct($orderId = NULL, $orderNo= NULL, $orderAmt = NULL, 
            $restaurantId = NULL, $custId = NULL, $tableId = NULL, 
            $orderStatus = NULL, $userId = NULL, $takeawayNo = null,$deliveryNo = null, 
            $orderType = null) {
        $this->orderId = $orderId;
        $this->orderNo = $orderNo;
        $this->orderStatus = $orderStatus;
        $this->orderAmt = $orderAmt;
        $this->restaurantId = $restaurantId;
        $this->custId = $custId;
        $this->tableId = $tableId;
        $this->orderDt = date('Y-m-d');
        $this->orderTm = date('H:i:s');        
        $this->userId = $userId;
        $this->takeawayNo = $takeawayNo;
        $this->deliveryNo = $deliveryNo;
        $this->orderType = $orderType;
    }
}
