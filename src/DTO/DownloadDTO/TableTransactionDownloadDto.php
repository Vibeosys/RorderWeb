<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DTO\DownloadDTO;

/**
 * Description of TableTransactionDownloadDto
 *
 * @author anand
 */
class TableTransactionDownloadDto {

    //put your code here
    public $tableId;
    public $userId;
    public $custId;
    public $isWaiting;
    public $arrivalTime;    

    public function __construct($tableId, $userId, $custId, $isWaiting, $arrivalTime) {
        $this->custId = $custId;
        $this->userId = $userId;
        $this->tableId = $tableId;
        $this->isWaiting = $isWaiting;
        $this->arrivalTime = $arrivalTime;
    }

}
