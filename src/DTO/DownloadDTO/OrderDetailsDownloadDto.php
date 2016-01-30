<?php
namespace App\DTO\DownloadDTO;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of OrderDetailsDownloadDto
 *
 * @author niteen
 */
class OrderDetailsDownloadDto {
    
    private $orderDetailsId;
    private $orderPrice;
    private $orderQuantity;
    private $createdDate;
    private $updatedDate;
    private $orderId;
    private $menuId;
    private $menuTitle;
    
    public function __construct($orderDetailsId = null, $orderPrice = null, $orderQuantity = null,
            $createdDate = null, $updatedDate = null,  $orderId = null, $menuId = null, $menuTitle = null) {
     
        $this->orderDetailsId = $orderDetailsId;
        $this->orderPrice = $orderPrice;
        $this->orderQuantity = $orderQuantity;
        $this->createdDate = $createdDate;
        $this->updatedDate = $updatedDate;
        $this->orderId = $orderId;
        $this->menuId = $menuId;
        $this->menuTitle = $menuTitle;
    }
}
