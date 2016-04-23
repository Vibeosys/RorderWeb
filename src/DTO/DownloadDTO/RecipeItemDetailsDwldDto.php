<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DTO\DownloadDTO;

/**
 * Description of RecipeItemDetailsDwldDto
 *
 * @author niteen
 */
class RecipeItemDetailsDwldDto {
   
    public $brandCode;
    public $brand;
    public $stock;
    public $rstock;
    public $unit;
    public $item;


    public function __construct($brandCode = null, $brand = null, $stock = null,
            $rstock = null, $unit = null, $item = null) {
        $this->brandCode = $brandCode;
        $this->brand = $brand;
        $this->stock = $stock;
        $this->rstock = $rstock;
        $this->unit = $unit;
        $this->item = $item;
                
    }
}
