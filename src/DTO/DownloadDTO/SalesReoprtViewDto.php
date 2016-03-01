<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DTO\DownloadDTO;

/**
 * Description of SalesReoprtViewDto
 *
 * @author niteen
 */
class SalesReoprtViewDto {
    public $restaurantId;
    public $month;
    public $year;
    public $billTotalAmt;
    public function __construct($restaurantId = null, $month = null, 
            $year = null,$billTotalAmt = null) {
        $this->restaurantId = $restaurantId;
        $this->month = $month;
        $this->year = $year;
        $this->billTotalAmt = $billTotalAmt;
    }
}
