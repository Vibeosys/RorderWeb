<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DTO\UploadDTO;

/**
 * Description of OrderDetailEntryDto
 *
 * @author anand
 */
class OrderDetailEntryDto {

    public $orderId;
    public $orderQty;
    public $orderPrice;
    public $menuId;
    public $subMenuId;
    public $menuTitle;
    public $menuUnitPrice;
    public $note;


    public function __construct($orderId = NULL, $orderQty = NULL, 
            $orderPrice = NULL,$menuId = NULL, $subMenuId = null, 
            $menuTitle = NULL, $menuUnitPrice = null, $note = null) {
        $this->orderId = $orderId;
        $this->orderQty = $orderQty;
        $this->orderPrice = $orderPrice;
        $this->menuId = $menuId;
        $this->menuTitle = $menuTitle;
        $this->menuUnitPrice = $menuUnitPrice;
        $this->note = $note;
        $this->subMenuId = $subMenuId;
    }

}
