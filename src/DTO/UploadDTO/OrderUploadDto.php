<?php
namespace App\DTO\UploadDTO;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use App\DTO;
/**
 * Description of OrderUploadDto
 *
 * @author niteen
 */
class OrderUploadDto {
    
    public $orderId;
    public $orderStatus;
    public $orderDate;
    public $orderTime;
    public $orderAmount;
    public $userId;
    public $tableId;
    public $orderNo;
    
    public function __construct($orderId = null, $orderStatus = null, $orderDate = null ,$orderTime = null, 
           $orderAmount = null, $userId = null, $tableId = null, $orderNo = null) {
        
        $this->orderId = $orderId;
        $this->orderNo = $orderNo;
        $this->orderStatus = $orderStatus;
        $this->orderDate = $orderDate;
        $this->orderTime = $orderTime;
        $this->orderAmount  =$orderAmount;
        $this->userId = $userId;
        $this->tableId = $tableId;
    }
}
