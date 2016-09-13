<?php
namespace App\DTO\DownloadDTO;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RecipeItemRestoreDto
 *
 * @author niteen
 */
class RecipeItemRestoreDto {
    
    public $itemId;
    public $menuQty;
    public $itemQty;
    public $factor;
    
    public function __construct($itemId = null, $mQty = null, $iQty = null, $factor = null) {
        $this->itemId = $itemId;
        $this->menuQty = $mQty;
        $this->itemQty = $iQty;
        $this->factor = $factor;
    }
}
