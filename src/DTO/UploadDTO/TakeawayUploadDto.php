<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DTO\UploadDTO;
use App\DTO;
/**
 * Description of TakeawayUploadDto
 *
 * @author niteen
 */
class TakeawayUploadDto extends DTO\JsonDeserializer{

    public $takeawayId;
    public $sourceId;
    public $discount;
    public $deliveryCharges;
    public $custId;
    public $takeawayNo;
    public $userId;
    public $createdDate;
    

    public function __construct($takeawayId = null, $sourceId = null, 
            $discount = null, $deliveryCharges = null, $custId = null,
            $takeawayNo = null, $userId = null, $createdDate = null) {
        $this->takeawayId = $takeawayId;
        $this->sourceId = $sourceId;
        $this->discount = $discount;
        $this->deliveryCharges = $deliveryCharges;
        $this->custId = $custId;
        $this->takeawayNo = $takeawayNo;
        $this->userId = $userId;
        $this->createdDate = $createdDate;
    }
}
