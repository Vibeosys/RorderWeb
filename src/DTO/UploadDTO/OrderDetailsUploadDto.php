<?php
namespace App\DTO\UploadDTO;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of OrderDetailsUploadDto
 *
 * @author niteen
 */
class OrderDetailsUploadDto {
    
    public $orderDetailsId;
    public $orderPrice;
    public $orderQuantity;
    public $orderId;
    public $menuId;
    public $menuTitle;
    
    public function __construct($orderDetailsId = null, $orderPrice = null, $orderQuantity = null,
            $orderId = null, $menuId = null, $menuTitle = null) {
     
        $this->orderDetailsId = $orderDetailsId;
        $this->orderPrice = $orderPrice;
        $this->orderQuantity = $orderQuantity;
        $this->orderId = $orderId;
        $this->menuId = $menuId;
        $this->menuTitle = $menuTitle;
    }
}
