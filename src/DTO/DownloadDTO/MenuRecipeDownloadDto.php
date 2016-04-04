<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DTO\DownloadDTO;

/**
 * Description of MenuRecipeDownloadDto
 *
 * @author niteen
 */
class MenuRecipeDownloadDto {
    
    public $itemId;
    public $itemName;
    public $qty;
    public $unitId;
    public $unitTitle;
    
    public function __construct($itemId = null,$itemName = null,$qty = null, 
            $unitId = null, $unitTitle = null) {
        $this->itemId = $itemId;
        $this->itemName = $itemName;
        $this->qty = $qty;
        $this->unitId = $unitId;
        $this->unitTitle = $unitTitle;
    }
}
