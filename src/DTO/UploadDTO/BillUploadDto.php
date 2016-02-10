<?php
namespace App\DTO\UploadDTO;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use App\DTO;
/**
 * Description of BillUploadDto
 *
 * @author niteen
 */
class BillUploadDto extends DTO\JsonDeserializer{
    
    public $tableId;
    public $custId;
    
    
    
    public function __construct($tableId = null, $custId = null) {

        $this->tableId = $tableId;
        $this->custId = $custId;
       
    }
}
