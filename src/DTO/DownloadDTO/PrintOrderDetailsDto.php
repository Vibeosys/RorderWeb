<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DTO\DownloadDTO;

/**
 * Description of PrintOrderDetailsDto
 *
 * @author niteen
 */
class PrintOrderDetailsDto {

    public $menuId;
    public $qty;
    
    public function __construct($menuId = null, $qty = null) {
        $this->menuId = $menuId;
        $this->qty = $qty;
    }
}
