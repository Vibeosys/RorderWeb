<?php
namespace App\DTO\UploadDTO;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use App\DTO;
/**
 * Description of OrderStatusUploadDto
 *
 * @author niteen
 */
class OrderStatusUploadDto extends DTO\JsonDeserializer{
    
    public  $orderId;
    
    public function __construct($orderId = null) {
        $this->orderId = $orderId;
    }
}
