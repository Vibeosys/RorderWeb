<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DTO\DownloadDTO;

/**
 * Description of TableBillDownloadDto
 *
 * @author niteen
 */
class TableBillDownloadDto {

    public $billNo;
    public $tableNo;
    public $user;
    public $date;
    
    public function __construct($billNo = null, $tableNo = null, $user = null, 
            $date = null) {
        $this->billNo = $billNo;
        $this->tableNo = $tableNo;
        $this->user = $user;
        $this->date = $date;
    }
}
