<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DTO\UploadDTO;

/**
 * Description of MenuRecipeInsertDto
 *
 * @author niteen
 */
class MenuRecipeInsertDto {
    
    public $menuId;
    public $itemId;
    public $qty;
    public $unitId;
    
    public function __construct($menuId = null, $itemId = null, $qty = null, 
            $unitId = null) {
        $this->menuId = $menuId;
        $this->itemId = $itemId;
        $this->qty = $qty;
        $this->unitId = $unitId;
    } 
}
