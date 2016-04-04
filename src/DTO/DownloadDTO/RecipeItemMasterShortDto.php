<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DTO\DownloadDTO;

/**
 * Description of RecipeItemMasterShortDto
 *
 * @author niteen
 */
class RecipeItemMasterShortDto {
    
    public $itemId;
    public $itemName;
    
    public function __construct($itemId = null, $itemName = null) {
        $this->itemId = $itemId;
        $this->itemName = $itemName;
    }
}
