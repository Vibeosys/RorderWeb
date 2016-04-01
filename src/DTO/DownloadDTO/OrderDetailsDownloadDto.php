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
    
    public $orderDetailsId;
    public $orderPrice;
    public $orderQuantity;
    public $orderId;
    public $menuId;
    public $subMenuId;
    public $menuTitle;
    public $note;

    public function __construct($orderDetailsId = null, $orderPrice = null, 
            $orderQuantity = null,$orderId = null,$menuId = null, 
            $subMenuId = null, $menuTitle = null, $note = null) {
     
        $this->orderDetailsId = $orderDetailsId;
        $this->orderPrice = $orderPrice;
        $this->orderQuantity = $orderQuantity;
        $this->orderId = $orderId;
        $this->menuId = $menuId;
        $this->subMenuId = $subMenuId;
        $this->menuTitle = $menuTitle;
        $this->note = $note;
    }
}
