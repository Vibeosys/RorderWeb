<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DTO\UploadDTO;
use App\DTO;
/**
 * Description of DeliveryUploadDto
 *
 * @author niteen
 */
class DeliveryUploadDto extends DTO\JsonDeserializer{
    
    public $deliveryId;
    public $sourceId;
    public $discount;
    public $deliveryCharges;
    public $custId;
    public $deliveryNo;
    public $userId;
    public $createdDate;
    

    public function __construct($deliveryId = null, $sourceId = null, 
            $discount = null, $deliveryCharges = null, $custId = null,
            $deliveryNo = null, $userId = null, $createdDate = null) {
        $this->deliveryId = $deliveryId;
        $this->sourceId = $sourceId;
        $this->discount = $discount;
        $this->deliveryCharges = $deliveryCharges;
        $this->custId = $custId;
        $this->deliveryNo = $deliveryNo;
        $this->userId = $userId;
        $this->createdDate = $createdDate;
    }
}
