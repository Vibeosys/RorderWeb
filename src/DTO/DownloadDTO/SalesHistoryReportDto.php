<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DTO\DownloadDTO;

/**
 * Description of SalesHistoryReportDto
 *
 * @author niteen
 */
class SalesHistoryReportDto {
   
    public $restaurantId;
    public $month;
    public $year;
    public $billNetAmt;
    public $taxAmt;
    public $billTotalAmt;
    public function __construct($restaurantId = null, $month = null, 
            $year = null, $billNetAmt = null, $taxAmt = null, 
            $billTotalAmt = null) {
        $this->restaurantId = $restaurantId;
        $this->month = $month;
        $this->year = $year;
        $this->billNetAmt = $billNetAmt;
        $this->taxAmt = $taxAmt;
        $this->billTotalAmt = $billTotalAmt;
    }
}
