<?php
namespace App\DTO\DownloadDTO;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of OrderDownloadDto
 *
 * @author niteen
 */
class OrderDownloadDto {
    
    public $orderId;
    public $orderNo;
    public $orderStatus;
    public $orderDate;
    public $orderTime;
    public $createdDate;
    public $updatedDate;
    public $orderAmount;
    public $userId;
    public $tableId;
    public $custId;


    public function __construct($orderId = null, $orderNo = null, $custId = null, $orderStatus = null, $orderDate = null ,$orderTime = null, 
            $createdDate = null, $updatedDate = null, $orderAmount = null, $userId = null, $tableId = null) {
        
        $this->orderId = $orderId;
        $this->orderNo = $orderNo;
        $this->custId = $custId;
        $this->orderStatus = $orderStatus;
        $this->orderDate = $orderDate;
        $this->orderTime = $orderTime;
        $this->createdDate =$createdDate;
        $this->updatedDate = $updatedDate;
        $this->orderAmount  =$orderAmount;
        $this->userId = $userId;
        $this->tableId = $tableId;
    }
}
