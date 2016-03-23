<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DTO\UploadDTO;
use App\DTO;

/**
 * Description of TransactionMasterInsertDto
 *
 * @author niteen
 */
class TransactionMasterInsertDto extends DTO\JsonDeserializer{
    
    public $restaurantId;
    public $day;
    public $month;
    public $year;
    public $amount;
    
    public function __construct($restaurantId = null,$day = null, 
            $month = null, $year = null, $amount = null) {
        $this->restaurantId = $restaurantId;
        $this->day = $day;
        $this->month = $month;
        $this->year = $year;
        $this->amount = $amount;
    }
}
