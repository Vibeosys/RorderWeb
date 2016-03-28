<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DTO\UploadDTO;

/**
 * Description of RecipeItemMaterInsertDto
 *
 * @author niteen
 */
class RecipeItemMaterInsertDto {
    
    public $itemName;
    public $unitId;
    public $sLevel;
    public $rLevel;
    public $qty;
    public $itemId;
    public $unit;


    public function __construct($itemName = null, $unitId = null, 
            $sLevel = null, $rLevel = null, $qty = null, $itemId = null,$unit = null) {
        $this->itemName = $itemName;
        $this->unitId = $unitId;
        $this->sLevel = $sLevel;
        $this->rLevel = $rLevel;
        $this->qty = $qty;
        $this->itemId = $itemId;
        $this->unit = $unit;
    }
}
