<?php
namespace App\DTO\UploadDTO;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use App\DTO;
/**
 * Description of RTableUploadDto
 *
 * @author niteen
 */
class RTableUploadDto extends DTO\JsonDeserializer{
    public $tableId;
    public $isOccupied;
    
    
    public function __construct($tableId = null , $isOccupied = null) {
        
        $this->tableId = $tableId;
        $this->isOccupied = $isOccupied;
        
    }
    
}
