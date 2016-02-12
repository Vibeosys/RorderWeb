<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DTO\UploadDTO;
use App\DTO;
/**
 * Description of TableTransactionUploadDto
 *
 * @author niteen
 */
class TableTransactionUploadDto extends DTO\JsonDeserializer{
    
    public $tableId;
    public $userId;
    public $custId;
    public $isWaiting;
    public $arrivalTime;
    public $occupancy;
    
    public function __construct($tableId = null, $userId = null, $custId = null, 
            $isWaiting = null, $arrivalTime = null, $occupancy = null) {
        $this->tableId = $tableId;
        $this->userId = $userId;
        $this->custId = $custId;
        $this->isWaiting = $isWaiting;
        $this->arrivalTime = $arrivalTime;
        $this->occupancy  = $occupancy;
    }
    
    
}
