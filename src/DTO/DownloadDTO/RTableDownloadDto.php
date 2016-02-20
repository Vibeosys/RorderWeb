<?php
namespace App\DTO\DownloadDTO;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RTableDownloadDto
 *
 * @author niteen
 */
class RTableDownloadDto {
    
    public $tableId;
    public $tableNo;
    public $tableCategoryId;
    public $capacity;
    public $isOccupied;
    
    public function __construct($tableId, $tableNo, $tableCategoryId, $capacity, $isOccupied) {
        $this->tableId = $tableId;
        $this->tableNo = $tableNo;
        $this->tableCategoryId = $tableCategoryId;
        $this->capacity = $capacity;
        $this->isOccupied = $isOccupied;
    }
}
