<?php
namespace App\DTO\DownloadDTO;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SyncDownloadDto
 *
 * @author niteen
 */
class SyncDownloadDto {
    
    public $tableName;
    public $tableData;
    public $operation;
    
    public function __construct($tabelName, $jsonSync, $operation) {
        
        $this->tableName = $tabelName;
        $this->tableData = $jsonSync;
        $this->operation = $operation;
    }
    
}
