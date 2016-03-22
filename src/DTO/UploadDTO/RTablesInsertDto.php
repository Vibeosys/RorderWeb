<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DTO\UploadDTO;

/**
 * Description of RTablesInsertDto
 *
 * @author niteen
 */
class RTablesInsertDto {
    
    public $tableNo;
    public $tableCategoryId;
    public $capacity;
    public $isOccupied;
    public $restaurantId;
    public $tableId;


    public function __construct($tableNo = null, $tableCategoryId = null, 
            $capacity = null, $isOccupied = null, $restaurantId = null,$tableId = null) {
        $this->tableNo = $tableNo;
        $this->tableCategoryId = $tableCategoryId;
        $this->capacity = $capacity;
        $this->isOccupied = $isOccupied;
        $this->restaurantId = $restaurantId;
        $this->tableId = $tableId;
    }
}
