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
class OrderUploadDto extends DTO\JsonDeserializer{
    
    public $orderId;
    public $tableId;
    public $custId;
    public $orderDetails;
    public $takeawayNo;
    public $deliveryNo;
    public $orderType;

    public function __construct($orderId = null, $custId = null, 
            $tableId = null, $orderDetails = null, $takeawayNo = null,$deliveryNo = null,
            $orderType = null) {
        
        $this->orderId = $orderId;
        $this->custId = $custId;
        $this->orderDetails = $orderDetails;
        $this->tableId = $tableId;
        $this->takeawayNo = $takeawayNo;
        $this->deliveryNo = $deliveryNo;
        $this->orderType = $orderType;
    }
}
