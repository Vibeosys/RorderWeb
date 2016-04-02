<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DTO\UploadDTO;

/**
 * Description of OpenStockUploadDto
 *
 * @author niteen
 */
class OpenStockUploadDto {
    
    public $itemId;
    public $stock;
    public $day;
    public $month;
    public $year;
    public $unitId;
    public $restaurantId;

    public function __construct($itemId = null, $stock = null, $day = null, 
            $month = null, $year = null,$unitId = null, $restaurantId = null) {
        $this->itemId = $itemId;
        $this->stock = $stock;
        $this->day = $day;
        $this->month = $month;
        $this->year = $year;
        $this->unitId = $unitId;
        $this->restaurantId = $restaurantId;
    }
}
